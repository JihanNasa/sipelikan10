@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Input Data Sarana dan Prasarana' }}
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
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        swal({
          title: "Berhasil!",
          text: "{{ session('success') }}",
          icon: "success",
          button: "OK",
        });
      });
    </script>
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

    <h2 class="section-title">Form Input Sarana dan Prasarana</h2>
    <p class="section-lead">Isi data-data terkait sarana dan prasarana perikanan.</p>

    {{-- Menggunakan named route 'input.saranas.store' sesuai dengan definisi di routes/web.php --}}
    <form method="POST" action="{{ route('input.saranas.store') }}">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Sarana dan Prasarana</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="jenis_sarana">Jenis Sarana</label>
                <select class="form-control @error('jenis_sarana') is-invalid @enderror" id="jenis_sarana" name="jenis_sarana" required>
                  <option value="" disabled selected>Pilih Jenis Sarana</option>
                  <option value="Gudang Dingin" {{ old('jenis_sarana') == 'Gudang Dingin' ? 'selected' : '' }}>Gudang Dingin</option>
                  <option value="Gudang Beku" {{ old('jenis_sarana') == 'Gudang Beku' ? 'selected' : '' }}>Gudang Beku</option>
                  <option value="Gudang Kering" {{ old('jenis_sarana') == 'Gudang Kering' ? 'selected' : '' }}>Gudang Kering</option>
                </select>
                @error('jenis_sarana')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="kapasitas">Kapasitas (Kg)</label>
                {{-- Menambahkan old() untuk mempertahankan nilai input --}}
                <input type="text" class="form-control @error('kapasitas') is-invalid @enderror" id="kapasitas" name="kapasitas" placeholder="Contoh: 1000 (dalam ton per triwulan)"
                  value="{{ old('kapasitas') }}">
                @error('kapasitas')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="pengolahan_teknologi">Teknologi Pengolahan</label>
                {{-- Menambahkan old() untuk mempertahankan nilai textarea --}}
                <textarea class="form-control @error('pengolahan_teknologi') is-invalid @enderror" id="pengolahan_teknologi" name="pengolahan_teknologi" rows="3"
                  placeholder="Jelaskan teknologi pengolahan yang digunakan">{{ old('pengolahan_teknologi') }}</textarea>
                @error('pengolahan_teknologi')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label for="tahun">Tahun</label>
                {{-- Menambahkan old() dan default ke tahun saat ini --}}
                <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" placeholder="Contoh: 2025" required value="{{ old('tahun', date('Y')) }}">
                @error('tahun')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              <div class="form-group">
                <label>Triwulan</label>
                {{-- Mengubah value option menjadi numerik (1, 2, 3, 4) dan menambahkan old() serta default ke triwulan saat ini --}}
                <select name="triwulan" class="form-control @error('triwulan') is-invalid @enderror" required>
                  <option value="" disabled selected>Pilih Triwulan</option>
                  <option value="1" {{ old('triwulan', ceil(date('n') / 3)) == 1 ? 'selected' : '' }}>(Januari - Maret)</option>
                  <option value="2" {{ old('triwulan', ceil(date('n') / 3)) == 2 ? 'selected' : '' }}>(April - Juni)</option>
                  <option value="3" {{ old('triwulan', ceil(date('n') / 3)) == 3 ? 'selected' : '' }}>(Juli - September)</option>
                  <option value="4" {{ old('triwulan', ceil(date('n') / 3)) == 4 ? 'selected' : '' }}>(Oktober - Desember)</option>
                </select>
                @error('triwulan')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 text-right">
          <button type="submit" class="btn btn-primary">Simpan Data Sarana dan Prasarana</button>
        </div>
      </div>
    </form>
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
