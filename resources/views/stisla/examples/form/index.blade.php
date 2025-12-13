# File: resources/views/stisla/forms/data_perikanan_input.blade.php
@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Input Data Perikanan' }}
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
    <h2 class="section-title">Form Input Data Perikanan</h2>
    <p class="section-lead">Isi data-data terkait sarana, tenaga kerja, bahan baku, produk, dan omzet perikanan.</p>

    {{-- Pastikan Anda mengganti '#' dengan URL atau route yang sesuai untuk menyimpan data form ini --}}
    <form action="#" method="POST">
      @csrf {{-- Token CSRF untuk keamanan Laravel --}}
      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          {{-- Card untuk Sarana dan Prasaran --}}
          <div class="card">
            <div class="card-header">
              <h4>Sarana dan Prasaran</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="jenis_sarana">Jenis Sarana</label>
                <input type="text" class="form-control" id="jenis_sarana" name="jenis_sarana" placeholder="Contoh: Kapal, Tambak, Keramba">
              </div>
              <div class="form-group">
                <label for="kapasitas">Kapasitas</label>
                <input type="number" class="form-control" id="kapasitas" name="kapasitas" placeholder="Contoh: 1000 (dalam satuan yang relevan)">
              </div>
              <div class="form-group">
                <label for="pengolahan_teknologi">Pengolahan Teknologi</label>
                <textarea class="form-control" id="pengolahan_teknologi" name="pengolahan_teknologi" rows="3" placeholder="Jelaskan teknologi pengolahan yang digunakan"></textarea>
              </div>
            </div>
          </div>

          {{-- Card untuk Tenaga Kerja --}}
          <div class="card">
            <div class="card-header">
              <h4>Tenaga Kerja</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="warga_negara">Warga Negara</label>
                <input type="text" class="form-control" id="warga_negara" name="warga_negara" placeholder="Contoh: Indonesia, Asing">
              </div>
              <div class="form-group">
                <label class="form-label">Jenis Kelamin</label>
                <div class="selectgroup w-100">
                  <label class="selectgroup-item">
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" class="selectgroup-input" checked>
                    <span class="selectgroup-button">Laki-laki</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="jenis_kelamin" value="Perempuan" class="selectgroup-input">
                    <span class="selectgroup-button">Perempuan</span>
                  </label>
                </div>
              </div>
            </div>
          </div>

          {{-- Card untuk Bahan Baku --}}
          <div class="card">
            <div class="card-header">
              <h4>Bahan Baku</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="jenis_ikan">Jenis Ikan</label>
                <input type="text" class="form-control" id="jenis_ikan" name="jenis_ikan" placeholder="Contoh: Tuna, Udang, Nila">
              </div>
              <div class="form-group">
                <label for="volume_bk">Volume Bahan Baku</label>
                <input type="number" class="form-control" id="volume_bk" name="volume_bk" placeholder="Contoh: 500 (dalam kg/ton)">
              </div>
              <div class="form-group">
                <label for="asal_bahan">Asal Bahan</label>
                <input type="text" class="form-control" id="asal_bahan" name="asal_bahan" placeholder="Contoh: Laut, Budidaya, Impor">
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-6 col-lg-6">
          {{-- Card untuk Produk --}}
          <div class="card">
            <div class="card-header">
              <h4>Produk</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="jenis_produk">Jenis Produk</label>
                <input type="text" class="form-control" id="jenis_produk" name="jenis_produk" placeholder="Contoh: Fillet, Beku, Olahan">
              </div>
              <div class="form-group">
                <label for="volume_produk">Volume Produk</label>
                <input type="number" class="form-control" id="volume_produk" name="volume_produk" placeholder="Contoh: 300 (dalam kg/ton)">
              </div>
              <div class="form-group">
                <label for="pemasaran">Pemasaran</label>
                <input type="text" class="form-control" id="pemasaran" name="pemasaran" placeholder="Contoh: Lokal, Ekspor">
              </div>
            </div>
          </div>

          {{-- Card untuk Omzet --}}
          <div class="card">
            <div class="card-header">
              <h4>Omzet</h4>
            </div>
            <div class="card-body">
              <div class="section-title mt-0">Domestik</div>
              <div class="form-group">
                <label for="tujuan_domes">Tujuan Domestik</label>
                <input type="text" class="form-control" id="tujuan_domes" name="tujuan_domes" placeholder="Contoh: Jakarta, Surabaya">
              </div>
              <div class="form-group">
                <label for="nilai_domes">Nilai Domestik</label>
                <input type="number" class="form-control" id="nilai_domes" name="nilai_domes" placeholder="Contoh: 10000000 (dalam Rupiah)">
              </div>
              <div class="form-group">
                <label for="volume_domes">Volume Domestik</label>
                <input type="number" class="form-control" id="volume_domes" name="volume_domes" placeholder="Contoh: 100 (dalam kg/ton)">
              </div>

              <div class="section-title">Luar Negeri</div>
              <div class="form-group">
                <label for="tujuan_luarnegeri">Tujuan Luar Negeri</label>
                <input type="text" class="form-control" id="tujuan_luarnegeri" name="tujuan_luarnegeri" placeholder="Contoh: Malaysia, Jepang">
              </div>
              <div class="form-group">
                <label for="nilai_luarnegeri">Nilai Luar Negeri</label>
                <input type="number" class="form-control" id="nilai_luarnegeri" name="nilai_luarnegeri" placeholder="Contoh: 50000 (dalam USD)">
              </div>
              <div class="form-group">
                <label for="volume_luarnegeri">Volume Luar Negeri</label>
                <input type="number" class="form-control" id="volume_luarnegeri" name="volume_luarnegeri" placeholder="Contoh: 50 (dalam kg/ton)">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 text-right">
          <button type="submit" class="btn btn-primary">Simpan Data</button>
        </div>
      </div>
    </form>
  </div>
@endsection

@push('css')
  {{-- CSS dari node_modules yang umum digunakan di Stisla, dipertahankan untuk konsistensi --}}
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet"
    href="{{ asset('stisla/node_modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/select2/dist/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/selectric/public/selectric.css') }}">
  <link rel="stylesheet"
    href="{{ asset('stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@push('js')
  {{-- JS dari node_modules yang umum digunakan di Stisla, dipertahankan untuk konsistensi --}}
  <script src="{{ asset('stisla/node_modules/cleave.js/dist/cleave.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>

  {{-- Script page-specific 'forms-advanced-forms.js' tidak disertakan karena form ini tidak menggunakan fitur advanced tersebut. --}}
@endpush
