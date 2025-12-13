@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Data Omzet' }}
@endsection

@section('content')
  <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
        <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
      <div class="breadcrumb-item active">Daftar Data Laporan</div>
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

    <h2 class="section-title">Daftar Data Omzet</h2>
    <p class="section-lead">Daftar data omzet perikanan yang telah diinput.</p>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-money-bill-wave"></i> {{ $title }}</h4>
            <div class="card-header-action">
              <a href="{{ route('input.omzets.form') }}" class="btn btn-primary">Tambah Data</a>
            </div>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-bordered table-striped w-100" id="datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Produk</th>
                  <th>Tujuan Domestik</th>
                  <th>Nilai Domestik (Rp)</th>
                  <th>Volume Domestik (Kg)</th>
                  <th>Tujuan Luar Negeri</th>
                  <th>Nilai Luar Negeri ($)</th>
                  <th>Volume Luar Negeri (Kg)</th>
                  <th>Tahun</th>
                  <th>Triwulan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($omzets as $omzet)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $omzet->jenis_produk }}</td>
                  <td>{{ $omzet->tujuan_domes }}</td>
                  <td>{{ number_format($omzet->nilai_domes, 2) }}</td>
                  <td>{{ number_format($omzet->volume_domes, 0) }}</td>
                  <td>{{ $omzet->tujuan_luarnegeri }}</td>
                  <td>{{ number_format($omzet->nilai_luarnegeri, 0) }}</td>
                  <td>{{ number_format($omzet->volume_luarnegeri, 0) }}</td>
                  <td>{{ $omzet->tahun }}</td>
                  <td>{{ $omzet->triwulan }}</td>
                  <td>
                    <a href="{{ route('omzets.edit', $omzet->id) }}" class="btn btn-sm btn-icon icon-left btn-info edit-confirm">
                      <i class="far fa-edit"></i>Edit
                    </a>
                    <form action="{{ route('omzets.destroy', $omzet->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-icon icon-left btn-danger">
                        <i class="fas fa-trash-alt"></i>Hapus
                      </button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="text-center">Tidak ada data omzet.</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('css')
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/selectric/public/selectric.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
  <style>
    .card-header {
      flex-wrap: wrap;
    }
    .dataTables_wrapper .row {
      width: 100%;
      margin: 0;
    }
  </style>
@endpush

@push('js')
  <script src="{{ asset('stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/cleave.js/dist/cleave.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>
@endpush

@push('scripts')
  <script>
    $(document).ready(function() {
      if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
      }
      $('#datatable').DataTable({
        "scrollX": true
      });

      // Konfirmasi pada tombol Edit
      $('.edit-confirm').on('click', function(e) {
        if(!confirm('Anda yakin ingin melakukan perubahan data ini?')) {
          e.preventDefault();
        }
      });
    });
  </script>
@endpush