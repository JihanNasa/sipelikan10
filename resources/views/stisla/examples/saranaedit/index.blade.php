@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Edit Data Sarana dan Prasarana' }}
@endsection

@section('content')
    <div class="section-header">
    <h1>{{ $title }}</h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active">
      <a href="{{ route('dashboard.index') }}">{{ __('Dashboard') }}</a>
      </div>
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

    {{-- Menampilkan error validasi secara umum --}}
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        Mohon periksa kembali input Anda:
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    @endif

    <h2 class="section-title">Form Edit Sarana dan Prasarana</h2>
    <p class="section-lead">Pastikan data yang Anda masukkan sudah benar sebelum menyimpan perubahan data.</p>

  <div class="row">
    <div class="col-12">
      <div class="card">
      <div class="card-header">
        <h4>Sarana dan Prasarana</h4>
      </div>
      <div class="card-body">
      <div class="section-body">
        <form action="{{ route('saranas.update', $sarana->id) }}" method="POST" data-edit-confirm>
          @csrf
          @method('PUT')
          <div class="form-group">
            <label>Jenis Sarana*</label>
            <select name="jenis_sarana" class="form-control" required>
              <option value="" disabled selected>Pilih Jenis Sarana</option>
              <option value="Gudang Dingin" {{ old('jenis_sarana', $sarana->jenis_sarana) == 'Gudang Dingin' ? 'selected' : '' }}>Gudang Dingin</option>
              <option value="Gudang Beku" {{ old('jenis_sarana', $sarana->jenis_sarana) == 'Gudang Beku' ? 'selected' : '' }}>Gudang Beku</option>
              <option value="Gudang Kering" {{ old('jenis_sarana', $sarana->jenis_sarana) == 'Gudang Kering' ? 'selected' : '' }}>Gudang Kering</option>
            </select>
          </div>
          <div class="form-group">
            <label>Kapasitas (Kg)</label>
            <input type="text" name="kapasitas" class="form-control" value="{{ old('kapasitas', $sarana->kapasitas) }}">
          </div>
          <div class="form-group">
            <label>Teknologi Pengolahan</label>
            <input type="text" name="pengolahan_teknologi" class="form-control" value="{{ old('pengolahan_teknologi', $sarana->pengolahan_teknologi) }}">
          </div>
          <div class="form-group">
            <label>Tahun</label>
            <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $sarana->tahun) }}" required>
          </div>
          <div class="form-group">
            <label>Triwulan</label>
            <select name="triwulan" class="form-control @error('triwulan') is-invalid @enderror" required>
              <option value="" disabled selected>Pilih Triwulan</option>
              <option value="1" {{ old('triwulan', $sarana->triwulan) == 1 ? 'selected' : '' }}>(Januari - Maret)</option>
              <option value="2" {{ old('triwulan', $sarana->triwulan) == 2 ? 'selected' : '' }}>(April - Juni)</option>
              <option value="3" {{ old('triwulan', $sarana->triwulan) == 3 ? 'selected' : '' }}>(Juli - September)</option>
              <option value="4" {{ old('triwulan', $sarana->triwulan) == 4 ? 'selected' : '' }}>(Oktober - Desember)</option>
            </select>
            @error('triwulan')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
          <button type="submit" class="btn btn-info"><i class="far fa-edit"></i>Simpan</button>
          <a href="{{ route('produktabel.index') }}" class="btn btn btn-icon icon-left btn-warning" data-cancel-confirm><i class="fas fa-times"></i>Batal</a>
        </form>
      </div>
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
@endpush

@push('js')
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
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[data-edit-confirm]');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (!confirm('Pastikan data yang diubah sudah benar!')) {
                e.preventDefault();
            }
        });
    }
    const cancelBtn = document.querySelector('a[data-cancel-confirm]');
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function(e) {
            if (!confirm('Ingin membatalkan pengeditan data?')) {
                e.preventDefault();
            }
        });
    }
});
</script>
@endpush
