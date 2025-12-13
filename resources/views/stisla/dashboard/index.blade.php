@extends('stisla.layouts.app-table')

@section('title')
  Dashboard
@endsection

@if ($mustUpdateProfile)
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
      document.addEventListener("DOMContentLoaded", function() {
          Swal.fire({
              title: 'Lengkapi Profil Anda',
              html: `
                  <p>Harap lengkapi profil Anda terlebih dahulu sebelum melanjutkan.</p>
                  <ul style="text-align:left;">
                      @if (empty($user->cop_surat))
                          <li>Upload <b>Logo UPI</b></li>
                      @endif
                      @if (empty($user->avatar))
                          <li>Isi <b>Profile</b></li>
                      @endif
                      @if (empty($user->lokasi_kantor_url))
                          <li>Isi <b>Lokasi Kantor (Google Maps URL)</b></li>
                      @endif
                  </ul>
              `,
              icon: 'warning',
              confirmButtonText: 'Perbarui Profil',
              allowOutsideClick: false,
          }).then((result) => {
              if (result.isConfirmed) {
                  window.location.href = "{{ route('profile.index', $user->id) }}";
              }
          });
      });
  </script>
@endif


@section('content')
  <div class="section-header">
    <h1>{{ __('Dashboard') }}</h1>
  </div>
  <div class="row">
    {{-- Hero --}}
    <div class="col-12 mb-2">
      <div class="hero text-white hero-bg-image" data-background="{{ $_stisla_bg_home }}">
        <div class="hero-inner">
          <h2>{{ __('Selamat Datang') }}, {{ Auth::user()->name ?? 'Your Name' }}</h2>
          <p class="lead">{{ $_app_description }}</p>
          @if (auth()->user()->can('Profil'))
            <div class="mt-4">
              <a href="{{ route('profile.index') }}" class="btn btn-outline-white btn-lg btn-icon icon-left">
                <i class="far fa-user"></i> {{ __('Lihat Profil') }}
              </a>
            </div>
          @endif
        </div>
      </div>
    </div>

    {{-- Widget Card --}}
    {{-- @foreach ($widgets ?? range(1, 8) as $item)
      <div class="col-lg-3 col-md-3 col-sm-6 col-12">
        <div class="card card-statistic-1" @if ($item->route ?? false) onclick="openTo('{{ $item->route }}')" style="cursor: pointer;" @endif>
          @if (isset($item->bg_color))
            <div class="card-icon" style="background-color: {{ $item->bg_color }};">
              <i class="fas fa-{{ $item->icon ?? 'fire' }}"></i>
            </div>
          @else
            <div class="card-icon bg-{{ $item->bg }}">
              <i class="fas fa-{{ $item->icon ?? 'fire' }}"></i>
            </div>
          @endif
          <div class="card-wrap">
            <div class="card-header">
              <h4>{{ $item->title ?? 'Nama Modul' }}</h4>
            </div>
            <div class="card-body">
              {{ $item->count ?? $loop->iteration . '00' }}
            </div>
          </div>
        </div>
      </div>
    @endforeach --}}

    {{-- Dropdown Pilihan User untuk Admin/Superadmin --}}
    
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin'))
    <div class="col-12 mb-4">
      <div class="form-group">
        <label for="userSelect">Lihat Data User:</label>
        <div class="input-group">
          <select id="userSelect" class="form-control">
            <option value="">Gabungan Semua User</option>
          </select>
          <div class="input-group-append">
            <button id="userSelectBtn" class="btn btn-primary" type="button">Lihat</button>
          </div>
        </div>
      </div>
    </div>
    @endif

    {{-- Dropdown Tahun --}}
    <div class="col-12 mb-4">
      <div class="form-group">
        <label for="tahunSelect">Pilih Tahun:</label>
        <select id="tahunSelect" class="form-control" style="width:auto; display:inline-block"></select>
      </div>
    </div>

    <!-- CHART AREA -->
    {{-- SARANA & PRASARANA --}}
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header"><h4>Sarana & Prasarana</h4></div>
        <div class="card-body">
          <canvas id="saranaChart" style="min-height: 350px; height: 350px;"></canvas>
        </div>
      </div>
    </div>

    {{-- TENAGA KERJA  --}}
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header"><h4>Tenaga Kerja</h4></div>
        <div class="card-body">
          <canvas id="tenagaChart" style="min-height: 350px; height: 350px;"></canvas>
        </div>
      </div>
    </div>

    {{-- BAHAN BAKU --}}
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header"><h4>Bahan Baku Top 10</h4></div>
        <div class="card-body">
          <canvas id="bahanChart" style="min-height: 350px; height: 350px;"></canvas>
        </div>
      </div>
    </div>

    {{-- OMZET --}}
    <div class="col-12 col-md-12 col-lg-12">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h4>Omzet Top 10 Produk</h4>
          <select id="omzetType" class="form-control form-control-sm" style="width:auto">
            <option value="nilai" selected>Berdasarkan Nilai</option>
            <option value="volume">Berdasarkan Volume</option>
          </select>
        </div>
        <div class="card-body">
          <canvas id="omzetChart" style="min-height: 350px; height: 350px;"></canvas>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js" defer></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const ChartDataLabels = window.ChartDataLabels;

  let users = [];
  let selectedUserId = "";
  let chartData = {};
  let tahunList = [];
  let tahunAktif = "";

  let saranaChart, tenagaChart, bahanChart, omzetChart;

  async function fetchChartData(userId = "") {
    let url = '{{ route('dashboard.chart-data') }}';
    if (userId) url += '?user_id=' + userId;
    const res = await fetch(url);
    const data = await res.json();
    if (data.chartData && data.users) {
      users = data.users; selectedUserId = data.selectedUserId || "";
      return data.chartData;
    }
    return data;
  }

  function populateUserDropdown() {
    const sel = document.getElementById('userSelect');
    if (!sel) return;
    sel.innerHTML = '<option value="">Gabungan Semua User</option>';
    users.forEach(u => {
      sel.innerHTML += `<option value="${u.id}" ${selectedUserId == u.id ? 'selected' : ''}>${u.name}</option>`;
    });
  }

  function getTahunList(data) {
    const tahunSet = new Set();
    if (data.sarana) Object.keys(data.sarana).forEach(tahun => tahunSet.add(tahun));
    if (data.tenaga) Object.keys(data.tenaga).forEach(tahun => tahunSet.add(tahun));
    return Array.from(tahunSet).sort((a,b)=>b-a);
  }

  function updateTahunDropdown() {
    const tahunSelect = document.getElementById('tahunSelect');
    tahunSelect.innerHTML = '';
    tahunList.forEach(tahun => {
      tahunSelect.innerHTML += `<option value="${tahun}" ${tahun==tahunAktif?'selected':''}>${tahun}</option>`;
    });
  }

  function getLatestYearData(byYearMap, tahun) {
    if (!byYearMap || !tahun) return {};
    return byYearMap[tahun] || {};
  }

  function formatNumberLabel(v){ try { return Number(v).toLocaleString('id-ID'); } catch(e){ return v; } }
  function niceStep(raw){ if(raw<=0)return 1; const m=Math.pow(10,Math.floor(Math.log10(raw))); const n=raw/m; if(n<=1)return 1*m; if(n<=2)return 2*m; if(n<=5)return 5*m; return 10*m; }
  function chartOptions(title, xLabel, yLabel, arrays){
    const flat=(arrays||[]).flat().map(v=>Number(v)||0);
    const max=flat.length?Math.max(...flat):0;
    const rawStep=Math.ceil(max/10)||1;
    const step=niceStep(rawStep);
    const maxTick=step*10;
    return {
      responsive:true, maintainAspectRatio:false,
      plugins:{
        legend:{ position:'bottom' },
        title:{ display:true, text:title },
        datalabels: {
          anchor: 'end',
          align: 'top',
          color: '#333',
          font: { weight: 'bold' },
          formatter: formatNumberLabel
        }
      },
      scales:{
        x:{ title:{ display:true, text:xLabel } },
        y:{ beginAtZero:true, title:{ display:true, text:yLabel },
            ticks:{ stepSize:step, max:maxTick, callback:v=>formatNumberLabel(v) } }
      }
    };
  }

  function sum(arr){ return (arr||[]).reduce((a,b)=>a+Number(b||0),0); }

  function generateColors(count, alpha = 0.7) {
    const colors = [];
    for (let i = 0; i < count; i++) {
      colors.push(`hsla(${(i * 360 / count)}, 70%, 60%, ${alpha})`);
    }
    return colors;
  }

  function updateCharts() {
    if (saranaChart) saranaChart.destroy();
    if (tenagaChart) tenagaChart.destroy();
    if (bahanChart)  bahanChart.destroy();
    if (omzetChart)  omzetChart.destroy();

    const triwulans = ['Triwulan 1','Triwulan 2','Triwulan 3','Triwulan 4'];

    // --- SARANA & PRASARANA ---
    const saranaYear = getLatestYearData(chartData.sarana, tahunAktif);
    const dingin = [1,2,3,4].map(q => saranaYear[q]?.gudang_dingin ?? 0);
    const beku   = [1,2,3,4].map(q => saranaYear[q]?.gudang_beku   ?? 0);
    const kering = [1,2,3,4].map(q => saranaYear[q]?.gudang_kering ?? 0);

    saranaChart = new Chart(document.getElementById('saranaChart'), {
      type:'bar',
      data:{ labels:triwulans,
        datasets:[
          {label:'Gudang Dingin', data:dingin, backgroundColor:'rgba(54,162,235,0.5)'},
          {label:'Gudang Beku',   data:beku,   backgroundColor:'rgba(255,99,132,0.5)'},
          {label:'Gudang Kering', data:kering, backgroundColor:'rgba(255,206,86,0.5)'},
        ]},
      options: chartOptions('', 'Triwulan', 'Kapasitas', [dingin,beku,kering]),
      plugins: [ChartDataLabels]
    });

    // --- TENAGA KERJA ---
    const tenagaYear = getLatestYearData(chartData.tenaga, tahunAktif);
    const tenagaWNI = [1,2,3,4].map(q => tenagaYear[q]?.wni ?? 0);
    const tenagaWNA = [1,2,3,4].map(q => tenagaYear[q]?.wna ?? 0);

    tenagaChart = new Chart(document.getElementById('tenagaChart'), {
      type:'bar',
      data:{ labels:triwulans,
        datasets:[
          {label:'WNI', data:tenagaWNI, backgroundColor:'rgba(54,162,235,0.5)'},
          {label:'WNA', data:tenagaWNA, backgroundColor:'rgba(255,206,86,0.5)'}
        ]},
      options: chartOptions('', 'Triwulan', 'Jumlah', [tenagaWNI,tenagaWNA]),
      plugins: [ChartDataLabels]
    });

    // --- BAHAN BAKU TOP 10 ---
    let bahanTop10 = chartData.bahan_top10;
    if (typeof bahanTop10 === 'object' && bahanTop10[tahunAktif]) {
      bahanTop10 = bahanTop10[tahunAktif];
    }
    const bahanLabels = Object.keys(bahanTop10 || {});
    const bahanValues = Object.values(bahanTop10 || {});
    const bahanColors = generateColors(bahanLabels.length);

    bahanChart = new Chart(document.getElementById('bahanChart'), {
      type:'bar',
      data:{
        labels: bahanLabels,
        datasets: [{
          label: 'Volume',
          data: bahanValues,
          backgroundColor: bahanColors
        }]
      },
      options: chartOptions('', 'Jenis Ikan', 'Volume', [bahanValues]),
      plugins: [ChartDataLabels]
    });

    // --- OMZET TOP 10 (toggle) + RINGKASAN TOTAL ---
    function buildOmzetDataset(type){
      let src = (type==='nilai') ? chartData.omzet_nilai : chartData.omzet_volume;
      if (typeof src === 'object' && src[tahunAktif]) {
        src = src[tahunAktif];
      }
      const labels = Object.keys(src || {});
      const domestik = labels.map(k => src[k]?.domestik ?? 0);
      const ln       = labels.map(k => src[k]?.luarnegeri ?? 0);
      return { labels, domestik, ln };
    }

    function getChartConfig(type){
      const {labels, domestik, ln} = buildOmzetDataset(type);
      const domColors = generateColors(labels.length, 0.7);
      const lnColors  = generateColors(labels.length, 0.4);
      return {
        type:'bar',
        data:{
          labels,
          datasets:[
            { label: (type==='nilai'?'Nilai Domestik':'Volume Domestik'), data:domestik, backgroundColor: domColors },
            { label: (type==='nilai'?'Nilai LN':'Volume LN'),             data:ln,       backgroundColor: lnColors }
          ]
        },
        options: chartOptions('', 'Produk', (type==='nilai'?'Nilai':'Volume'), [domestik, ln]),
        plugins: [ChartDataLabels]
      };
    }

    const initialType = (document.getElementById('omzetType')?.value) || 'nilai';
    omzetChart = new Chart(document.getElementById('omzetChart'), getChartConfig(initialType));

    const omzetTypeSelect = document.getElementById('omzetType');
    if (omzetTypeSelect){
      omzetTypeSelect.onchange = null; // Remove previous listener
      omzetTypeSelect.addEventListener('change', function(e){
        const t = e.target.value;
        omzetChart.destroy();
        omzetChart = new Chart(document.getElementById('omzetChart'), getChartConfig(t));
      });
    }
  }

  async function initAll(userId = "") {
    const data = await fetchChartData(userId);
    if (data.chartData && data.users) {
      users = data.users;
      selectedUserId = data.selectedUserId || "";
      chartData = data.chartData;
    } else {
      chartData = data;
    }
    tahunList = getTahunList(chartData);
    tahunAktif = tahunList.length ? tahunList[0] : '';
    if (users.length) populateUserDropdown();
    updateTahunDropdown();
    updateCharts();

    // Remove previous listener before adding new one
    const tahunSelect = document.getElementById('tahunSelect');
    tahunSelect.onchange = null;
    tahunSelect.addEventListener('change', function() {
      tahunAktif = this.value;
      updateCharts();
    });
  }

  // Inisialisasi pertama
  initAll();

  // Filter user
  const userSelectBtn = document.getElementById('userSelectBtn');
  if (userSelectBtn) {
    userSelectBtn.addEventListener('click', function() {
      const userId = document.getElementById('userSelect').value;
      initAll(userId);
    });
  }
});
</script>
@push('js')
<script>
// Clear browser cache on page load
if (window.performance && window.performance.navigation.type === 2) {
    // Browser back button was used
    window.location.reload(true);
}

// Disable back button for authenticated pages
@if(Auth::check())
document.addEventListener('DOMContentLoaded', function() {
    // Clear any cached data
    if ('caches' in window) {
        caches.keys().then(function(names) {
            names.forEach(function(name) {
                caches.delete(name);
            });
        });
    }
    
    // Prevent back button
    window.history.pushState(null, null, window.location.href);
    window.onpopstate = function() {
        window.history.pushState(null, null, window.location.href);
    };
});
@endif
</script>
@endpush
