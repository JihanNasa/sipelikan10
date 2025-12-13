@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Input Data Tenaga Kerja' }}
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

    <h2 class="section-title">Form Input Tenaga Kerja</h2>
    <p class="section-lead">Isi jumlah tenaga kerja perikanan berdasarkan kategori.</p>

    {{-- Menggunakan named route 'input.tenagas.store' --}}
    <form action="{{ route('input.tenagas.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Jumlah Tenaga Kerja per Kategori</h4>
            </div>
            <div class="card-body">
                {{-- Input untuk WNI --}}
                <div class="section-title mt-0">Warga Negara Indonesia (WNI)</div>
                <div class="form-group row"> {{-- Tambahkan class 'row' di form-group --}}
                    <label for="jumlah_wni_laki" class="col-sm-3 col-form-label">Jumlah Laki-laki (WNI) :</label>
                    <div class="col-sm-3"> {{-- Bungkus input dalam kolom --}}
                        <input type="number" placeholder="0" class="form-control @error('jumlah_wni_laki') is-invalid @enderror" id="jumlah_wni_laki" name="jumlah_wni_laki" value="{{ old('jumlah_wni_laki', ) }}" required min="0">
                        @error('jumlah_wni_laki')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row"> {{-- Tambahkan class 'row' di form-group --}}
                    <label for="jumlah_wni_perempuan" class="col-sm-3 col-form-label">Jumlah Perempuan (WNI) :</label>
                    <div class="col-sm-3"> {{-- Bungkus input dalam kolom --}}
                        <input type="number" placeholder="0" class="form-control @error('jumlah_wni_perempuan') is-invalid @enderror" id="jumlah_wni_perempuan" name="jumlah_wni_perempuan" value="{{ old('jumlah_wni_perempuan', ) }}" required min="0">
                        @error('jumlah_wni_perempuan')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Input untuk WNA --}}
                <div class="section-title mt-4">Warga Negara Asing (WNA)</div>
                <div class="form-group row"> {{-- Tambahkan class 'row' di form-group --}}
                    <label for="jumlah_wna_laki" class="col-sm-3 col-form-label">Jumlah Laki-laki (WNA) :</label>
                    <div class="col-sm-3"> {{-- Bungkus input dalam kolom --}}
                        <input type="number" placeholder="0" class="form-control @error('jumlah_wna_laki') is-invalid @enderror" id="jumlah_wna_laki" name="jumlah_wna_laki" value="{{ old('jumlah_wna_laki', ) }}" required min="0">
                        @error('jumlah_wna_laki')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row"> {{-- Tambahkan class 'row' di form-group --}}
                    <label for="jumlah_wna_perempuan" class="col-sm-3 col-form-label">Jumlah Perempuan (WNA) :</label>
                    <div class="col-sm-3"> {{-- Bungkus input dalam kolom --}}
                        <input type="number" placeholder="0"  class="form-control @error('jumlah_wna_perempuan') is-invalid @enderror" id="jumlah_wna_perempuan" name="jumlah_wna_perempuan" value="{{ old('jumlah_wna_perempuan', ) }}" required min="0">
                        @error('jumlah_wna_perempuan')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

              {{-- Input Tahun --}}
              <div class="form-group row"> {{-- Tambahkan class 'row' di form-group --}}
                <label for="tahun" class="col-sm-3 col-form-label">Tahun :</label>
                <div class="col-sm-3"> {{-- Bungkus input dalam kolom --}}
                    <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" placeholder="Contoh: 2024" value="{{ old('tahun', date('Y')) }}" required>
                    @error('tahun')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
              </div>

              {{-- Input Triwulan --}}
              <div class="form-group row"> {{-- Tambahkan class 'row' di form-group --}}
                <label for="triwulan" class="col-sm-3 col-form-label">Triwulan :</label>
                <div class="col-sm-3"> {{-- Bungkus input dalam kolom --}}
                    <select class="form-control @error('triwulan') is-invalid @enderror" id="triwulan" name="triwulan" required>
                      <option value="" disabled selected>Pilih Triwulan</option>
                      <option value="1" {{ old('triwulan', ceil(date('n') / 3)) == 1 ? 'selected' : '' }}>Triwulan 1 (Jan-Mar)</option>
                      <option value="2" {{ old('triwulan', ceil(date('n') / 3)) == 2 ? 'selected' : '' }}>Triwulan 2 (Apr-Jun)</option>
                      <option value="3" {{ old('triwulan', ceil(date('n') / 3)) == 3 ? 'selected' : '' }}>Triwulan 3 (Jul-Sep)</option>
                      <option value="4" {{ old('triwulan', ceil(date('n') / 3)) == 4 ? 'selected' : '' }}>Triwulan 4 (Okt-Des)</option>
                    </select>
                    @error('triwulan')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 text-right">
          <button type="submit" class="btn btn-primary">Simpan Data Tenaga Kerja</button>
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
