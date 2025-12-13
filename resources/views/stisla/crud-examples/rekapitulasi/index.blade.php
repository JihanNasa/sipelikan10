@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Rekapitulasi Laporan' }}
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
    <h2 class="section-title">Rekapitulasi Laporan Keseluruhan</h2>
    <p class="section-lead">Menampilkan ringkasan data agregat tahunan dan triwulanan.</p>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><i class="fas fa-file-alt"></i> {{ $title }}</h4>
            {{--  <div class="card-header-action">
              <a href="{{ route('rekapitulasi.export-pdf') }}" target="_blank" class="btn btn-danger mb-3">
                <i class="fas fa-file-pdf"></i> Export PDF
              </a>
              <a href="{{ route('laporan.rekap.export') }}" class="btn btn-success mb-3">
                <i class="fas fa-file-excel"></i> Export Excel
             </a> 
            </div>--}}
          </div>         
          <div class="card-body">
            @forelse ($availableYears as $year)
              <div class="card mb-4">
                  <div class="card-header">
                      <h5>Tahun {{ $year }}</h5>
                  </div>
                  <div class="card-body">
                      <h6>Ringkasan Tahunan:</h6>
                      <div class="table-responsive mb-3">
                        <table class="table table-bordered w-100" style="min-width:1200px">
                          <thead>
                            <tr>
                              <th>Jenis Sarana</th>
                              <th>Kapasitas</th>
                              <th>Pengolahan Teknologi</th>
                              <th>Warga Negara indonesia (L)</th>
                              <th>Warga Negara Indonesia (P)</th>
                              <th>Warga Negara Asing (L)</th>
                              <th>Warga Negara Asing (P)</th>
                              <th>Total Tenaga Kerja</th>
                              <th>Jenis Ikan</th>
                              <th>Total Volume Bahan Baku</th>
                              <th>Asal Bahan Baku</th>
                              <th>Jenis Produk</th>
                              <th>Tujuan Domestik</th>
                              <th>Total Nilai Omzet Domestik</th>
                              <th>Total Volume Omzet Domestik</th>
                              <th>Tujuan Luar Negeri</th>
                              <th>Total Nilai Omzet Luar Negeri</th>
                              <th>Total Volume Omzet Luar Negeri</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $tenaga = $rekapData[$year]['tenaga_data'];
                              $sarana = $rekapData[$year]['sarana_data'];
                              $bahan = $rekapData[$year]['bahan_data'];
                              $produk = $rekapData[$year]['produk_data'];
                              $omzet = $rekapData[$year]['omzet_data'];
                              $max = max(
                                $sarana->count(),
                                $tenaga->count(),
                                $bahan->count(),
                                $produk->count(),
                                $omzet->count(),
                                1
                              );
                            @endphp
                            @for ($i = 0; $i < $max; $i++)
                              <tr>
                                <td>{{ $sarana[$i]->jenis_sarana ?? '-' }}</td>
                                <td>{{ $sarana[$i]->kapasitas ?? '-' }}</td>
                                <td>{{ $sarana[$i]->pengolahan_teknologi ?? '-' }}</td>
                                <td>{{ $tenaga[$i]->jumlah_wni_laki ?? '-' }}</td>
                                <td>{{ $tenaga[$i]->jumlah_wni_perempuan ?? '-' }}</td>
                                <td>{{ $tenaga[$i]->jumlah_wna_perempuan ?? '-' }}</td>
                                <td>{{ $tenaga[$i]->jumlah_wna_perempuan ?? '-' }}</td>
                                <td>{{ isset($tenaga[$i]) ? number_format($tenaga[$i]->jumlah_wni_laki + $tenaga[$i]->jumlah_wni_perempuan + $tenaga[$i]->jumlah_wna_laki + $tenaga[$i]->jumlah_wna_perempuan, 0) : '-' }}</td>
                                <td>{{ $bahan[$i]->jenis_ikan ?? '-' }}</td>
                                <td>{{ isset($bahan[$i]) ? number_format($bahan[$i]->volume_bahanbaku,0) : '-' }}</td>
                                <td>{{ $bahan[$i]->asal_bahanbaku ?? '-' }}</td>
                                <td>{{ $omzet[$i]->jenis_produk ?? '-' }}</td>
                                <td>{{ $omzet[$i]->tujuan_domes ?? '-' }}</td>
                                <td>Rp {{ isset($omzet[$i]) ? number_format($omzet[$i]->nilai_domes,2) : '-' }}</td>
                                <td>{{ isset($omzet[$i]) ? number_format($omzet[$i]->volume_domes,0) : '-' }}</td>
                                <td>{{ $omzet[$i]->tujuan_luarnegeri ?? '-' }}</td>
                                <td>$ {{ isset($omzet[$i]) ? number_format($omzet[$i]->nilai_luarnegeri,0) : '-' }}</td>
                                <td>{{ isset($omzet[$i]) ? number_format($omzet[$i]->volume_luarnegeri,0) : '-' }}</td>
                              </tr>
                            @endfor
                          </tbody>
                        </table>
                      </div>
                      <h6>Detail per Triwulan:</h6>
                      <div class="row">
                        @for ($i = 1; $i <= 4; $i++)
                          <div class="col-md-6">
                            <div class="card mb-2">
                              <div class="card-header">
                                <h6>Triwulan {{ $i }}</h6>
                              </div>
                              <div class="card-body p-2">
                                <ul class="list-group list-group-flush">
                                  <li class="list-group-item">Total Volume Bahan Baku: <strong>{{ number_format($rekapData[$year]['triwulan_data'][$i]['bahan_baku'], 0) }}</strong></li>
                                  <li class="list-group-item">Total Nilai Omzet Domestik: <strong>Rp {{ number_format($rekapData[$year]['triwulan_data'][$i]['omzet_domes'], 2) }}</strong></li>
                                  <li class="list-group-item">Total Volume Omzet Domestik: <strong>{{ number_format($rekapData[$year]['triwulan_data'][$i]['volume_omzet_domes'] ?? 0, 0) }}</strong></li>
                                  <li class="list-group-item">Total Nilai Omzet Luar Negeri: <strong>$ {{ number_format($rekapData[$year]['triwulan_data'][$i]['omzet_luarnegeri'], 0) }}</strong></li>
                                  <li class="list-group-item">Total Volume Omzet Luar Negeri: <strong>{{ number_format($rekapData[$year]['triwulan_data'][$i]['volume_omzet_luarnegeri'] ?? 0, 0) }}</strong></li>
                                  <li class="list-group-item">Total Tenaga Kerja: <strong>{{ number_format($rekapData[$year]['triwulan_data'][$i]['tenaga_kerja']) }}</strong></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        @endfor
                      </div>
                  </div>
              </div>
            @empty
                <div class="alert alert-info">Tidak ada data rekapitulasi yang tersedia.</div>
            @endforelse
          </div>
        </div>
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
      // Jika ingin inisialisasi DataTables pada tabel ringkasan, tambahkan id pada tabel dan inisialisasi di sini.
    });
  </script>
@endpush
