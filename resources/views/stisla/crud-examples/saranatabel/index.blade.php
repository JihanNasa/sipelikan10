@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Data Sarana dan Prasarana' }}
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
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif
    
    <h2 class="section-title">Daftar Data Sarana dan Prasarana</h2>
    <p class="section-lead">Daftar data sarana dan prasarana perikanan yang telah diinput.</p>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h4><i class="fas fa-ship"></i> {{ $title }}</h4>
            <div class="card-header-action">
              <a href="{{ route('input.saranas.form') }}" class="btn btn-primary">Tambah Data</a>
            </div>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-bordered table-striped w-100" id="datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Jenis Sarana</th>
                  <th>Kapasitas (Kg)</th>
                  <th>Pengolahan Teknologi</th>
                  <th>Tahun</th>
                  <th>Triwulan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($saranas as $sarana)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $sarana->jenis_sarana }}</td>
                  <td>{{ $sarana->kapasitas }}</td>
                  <td>{{ $sarana->pengolahan_teknologi }}</td>
                  <td>{{ $sarana->tahun }}</td>
                  <td>{{ $sarana->triwulan }}</td>
                  <td>
                    <a href="{{ route('saranas.edit', $sarana->id) }}" class="btn btn-sm btn-icon icon-left btn-info edit-confirm">
                      <i class="far fa-edit"></i>Edit
                    </a>
                    <form action="{{ route('saranas.destroy', $sarana->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash-alt"></i>Hapus</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data sarana dan prasarana.</td>
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
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
  <style>
    /* Menyesuaikan tampilan agar tombol dan tabel rapi sejajar */
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
