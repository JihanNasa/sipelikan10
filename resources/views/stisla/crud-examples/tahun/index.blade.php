@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Laporan Tahunan' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item active">Laporan & Rekap</div>
      <div class="breadcrumb-item">{{ $title }}</div>
    </div>
  </div>

  <div class="section-body">
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <h2 class="section-title">Laporan Tahunan</h2>
    <p class="section-lead">Ringkasan data agregat perikanan berdasarkan tahun.</p>

    <div class="card">
      <div class="card-header">
        <h4><i class="fas fa-chart-bar"></i> Laporan untuk Tahun {{ $selectedYear }}</h4>
        <div class="card-header-action">
          <a href="{{ route('tahun.export-pdf', ['tahun' => $selectedYear, 'user_id' => $targetUser->id ?? null]) }}" target="_blank" class="btn btn-danger mb-3">
            <i class="fas fa-file-pdf"></i> Export PDF
          </a>
          <a href="{{ route('laporan.tahun.excel', ['tahun' => $selectedYear, 'user_id' => $targetUser->id ?? null]) }}" class="btn btn-success mb-3">
            <i class="fas fa-file-excel"></i> Export Excel
          </a>         
        </div>        
      </div>

      @php
      $isAdmin = auth()->user()->hasRole('admin') || auth()->user()->hasRole('superadmin');
      @endphp

      @if($isAdmin && isset($targetUser) && $targetUser->id !== auth()->id())
          <div class="card-body">
              <h6>Laporan Ini Dibuat Oleh : {{ $targetUser->name ?? '-' }}</h6>
          </div>
      @endif

      <div class="card-body">
        <form action="{{ route('laporan.tahunan.index') }}" method="GET" class="form-inline mb-4">
          <div class="form-group mr-2">
            <label for="tahun" class="mr-2">Pilih Tahun:</label>
            <select name="tahun" id="tahun" class="form-control">
              @for ($year = date('Y'); $year >= 2020; $year--)
                <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>{{ $year }}</option>
              @endfor
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Tampilkan</button>
        </form>

        @if(auth()->user()->cop_surat_url)
        <v class="text-center mb-4">
          <img src="{{ auth()->user()->cop_surat_url }}" alt="Cop Surat" width="300">
        </v>
        @endif

        <h5 class="mt-4">Ringkasan Agregat Tahunan</h5>
        <ul class="list-group mb-4">
          <li class="list-group-item">Total Volume Bahan Baku: <strong>{{ number_format($totalVolumeBahanTahun, 0) }} Kg</strong></li>
          <li class="list-group-item">Total Nilai Omzet Domestik: <strong>Rp {{ number_format($totalNilaiOmzetDomesTahun, 2) }}</strong></li>
          <li class="list-group-item">Total Volume Omzet Domestik: <strong>{{ number_format($totalVolumeOmzetDomesTahun, 0) }} Kg</strong></li>
          <li class="list-group-item">Total Nilai Omzet Luar Negeri: <strong>$ {{ number_format($totalNilaiOmzetLuarNegeriTahun, 0) }}</strong></li>
          <li class="list-group-item">Total Volume Omzet Luar Negeri: <strong>{{ number_format($totalVolumeOmzetLuarNegeriTahun, 0) }} Kg</strong></li>
          <li class="list-group-item">Total Tenaga Kerja (WNI + WNA): <strong>{{ number_format($totalTenagaKerjaTahun, 0) }} Orang</strong></li>
        </ul>

        @php
          $tables = [
            ['id' => 'datatableSarana', 'title' => 'Data Sarana', 'headers' => ['Jenis Sarana', 'Kapasitas (Kg)', 'Pengolahan Teknologi', 'Triwulan'], 'data' => $saranas],
            ['id' => 'datatableTenaga', 'title' => 'Data Tenaga Kerja', 'headers' => ['Warga Negara Indonesia (L)', 'Warga Negara Indonesia (P)', 'Warga Negara Asing (L)', 'Warga Negara Asing (P)', 'Triwulan'], 'data' => $tenagas],
            ['id' => 'datatableBahan', 'title' => 'Data Bahan Baku', 'headers' => ['Jenis Ikan', 'Volume Bahan Baku (Kg)', 'Asal Bahan Baku', 'Triwulan'], 'data' => $bahans],
            ['id' => 'datatableOmzet', 'title' => 'Data Omzet', 'headers' => ['Jenis Produk', 'Tujuan Domestik', 'Nilai Domestik (Rp)', 'Volume Domestik (Kg)', 'Tujuan Luar Negeri', 'Nilai Luar Negeri ($)', 'Volume Luar Negeri (Kg)', 'Triwulan'], 'data' => $omzets]
          ];
        @endphp

        @foreach ($tables as $table)
          <h5 class="mt-5">{{ $table['title'] }}</h5>
          <div class="table-responsive mb-4">
            <table class="table table-bordered table-striped w-100" id="{{ $table['id'] }}">
              <thead>
                <tr>
                  @foreach ($table['headers'] as $header)
                    <th>{{ $header }}</th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @forelse ($table['data'] as $item)
                  <tr>
                    @switch ($table['id'])
                      @case('datatableSarana')
                        <td>{{ $item->jenis_sarana }}</td>
                        <td>{{ number_format($item->kapasitas, 0) }}</td>
                        <td>{{ $item->pengolahan_teknologi }}</td>
                        <td>{{ $item->triwulan }}</td>
                        @break
                      @case('datatableTenaga')
                        <td>{{ number_format($item->jumlah_wni_laki, 0) }}</td>
                        <td>{{ number_format($item->jumlah_wni_perempuan, 0) }}</td>
                        <td>{{ number_format($item->jumlah_wna_laki, 0) }}</td>
                        <td>{{ number_format($item->jumlah_wna_perempuan, 0) }}</td>
                        <td>{{ $item->triwulan }}</td>
                        @break
                      @case('datatableBahan')
                        <td>{{ $item->jenis_ikan }}</td>
                        <td>{{ number_format($item->volume_bahanbaku, 0) }}</td>
                        <td>{{ $item->asal_bahanbaku }}</td>
                        <td>{{ $item->triwulan }}</td>
                        @break
                      @case('datatableOmzet')
                        <td>{{ $item->jenis_produk }}</td>
                        <td>{{ $item->tujuan_domes }}</td>
                        <td>{{ number_format($item->nilai_domes, 2) }}</td>
                        <td>{{ number_format($item->volume_domes, 0) }}</td>
                        <td>{{ $item->tujuan_luarnegeri }}</td>
                        <td>{{ number_format($item->nilai_luarnegeri, 0) }}</td>
                        <td>{{ number_format($item->volume_luarnegeri, 0) }}</td>
                        <td>{{ $item->triwulan }}</td>
                        @break
                    @endswitch
                  </tr>
                @empty
                  <tr>
                    <td colspan="{{ count($table['headers']) }}" class="text-center">Tidak ada data untuk {{ $table['title'] }} tahun ini.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        @endforeach

      </div>
    </div>
  </div>
@endsection

@push('css')
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endpush

@push('js')
  <script src="{{ asset('stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/jquery-ui/jquery-ui.min.js') }}"></script>
@endpush

@push('scripts')
  <script>
    $(document).ready(function() {
      // Inisialisasi DataTable
      ['#datatableSarana', '#datatableTenaga', '#datatableBahan', '#datatableOmzet'].forEach(function(id) {
        $(id).DataTable({
          scrollX: true

      // --- PENAMBAHAN SCRIPT UNTUK LINK PDF ---
      function updatePdfLinkTahun() {
        const tahun = $('#tahun').val();
        const baseUrl = "{{ route('tahun.export-pdf') }}";
        // Membuat URL baru dengan query parameter
        const newUrl = `${baseUrl}?tahun=${tahun}`;
        // Mengupdate atribut href pada link
        $('#exportPdfLinkTahun').attr('href', newUrl);
      }

      // Panggil fungsi saat halaman pertama kali dimuat
      updatePdfLinkTahun();

      // Panggil fungsi setiap kali nilai filter tahun berubah
      $('#tahun').on('change', function() {
        updatePdfLinkTahun();
      });
      // --- AKHIR PENAMBAHAN SCRIPT ---
    });
  </script>
@endpush