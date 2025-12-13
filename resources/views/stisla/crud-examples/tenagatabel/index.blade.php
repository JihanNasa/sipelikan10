@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Data Tenaga Kerja' }}
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

    <h2 class="section-title">Daftar Data Tenaga Kerja</h2>
    <p class="section-lead">Daftar data tenaga kerja perikanan yang telah diinput.</p>
    
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4><i class="fas fa-users"></i> {{ $title }}</h4>
            <div class="card-header-action">
              <a href="{{ route('input.tenagas.form') }}" class="btn btn-primary">Tambah Data</a>
            </div>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-bordered table-striped" id="datatable">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Warga Negara Indonesia (Laki-laki)</th>
                  <th>Warga Negara Indonesia (Perempuan)</th>
                  <th>Warga Negara Asing (Laki-laki)</th>
                  <th>Warga Negara Asing (Perempuan)</th>
                  <th>Tahun</th>
                  <th>Triwulan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($tenagas as $tenaga)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $tenaga->jumlah_wni_laki }}</td>
                  <td>{{ $tenaga->jumlah_wni_perempuan }}</td>
                  <td>{{ $tenaga->jumlah_wna_laki }}</td>
                  <td>{{ $tenaga->jumlah_wna_perempuan }}</td>
                  <td>{{ $tenaga->tahun }}</td>
                  <td>{{ $tenaga->triwulan }}</td>
                  <td>
                    <a href="{{ route('tenagas.edit', $tenaga->id) }}" class="btn btn-sm btn-icon icon-left btn-info edit-confirm">
                      <i class="far fa-edit"></i>Edit
                    </a>
                    <form action="{{ route('tenagas.destroy', $tenaga->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-icon icon-left btn-danger"><i class="fas fa-trash-alt"></i>Hapus</button>
                    </form>
                  </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data tenaga kerja.</td>
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
