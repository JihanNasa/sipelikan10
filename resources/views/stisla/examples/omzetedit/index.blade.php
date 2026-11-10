@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Edit Data Omzet' }}
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

    <h2 class="section-title">Form Edit Omzet</h2>
    <p class="section-lead">Pastikan data yang Anda masukkan sudah benar sebelum menyimpan perubahan data.</p>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Omzet</h4>
          </div>
          <div class="card-body">
            <div class="section-body">
              <form action="{{ route('omzets.update', $omzet->id) }}" method="POST" data-edit-confirm>
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="jenis_produk">Jenis Produk</label>
                  <select class="form-control select2 @error('jenis_produk') is-invalid @enderror" id="jenis_produk" name="jenis_produk" required>
                    <option value="" disabled selected>Pilih Jenis Produk</option>
                    <option value="Abalone Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Abalone Beku' ? 'selected' : '' }}>Abalone Beku</option>
                    <option value="Abalone Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Abalone Kering' ? 'selected' : '' }}>Abalone Kering</option>
                    <option value="Abon Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Abon Ikan' ? 'selected' : '' }}>Abon Ikan</option>
                    <option value="Abon Ikan Cakalang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Abon Ikan Cakalang' ? 'selected' : '' }}>Abon Ikan Cakalang</option>
                    <option value="Abon Ikan Nila" {{ old('jenis_produk', $omzet->jenis_produk) == 'Abon Ikan Nila' ? 'selected' : '' }}>Abon Ikan Nila</option>
                    <option value="Abon Lele" {{ old('jenis_produk', $omzet->jenis_produk) == 'Abon Lele' ? 'selected' : '' }}>Abon Lele</option>
                    <option value="Abon Patin" {{ old('jenis_produk', $omzet->jenis_produk) == 'Abon Patin' ? 'selected' : '' }}>Abon Patin</option>
                    <option value="Abon Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Abon Rumput Laut' ? 'selected' : '' }}>Abon Rumput Laut</option>
                    <option value="Agar-agar Strip" {{ old('jenis_produk', $omzet->jenis_produk) == 'Agar-agar Strip' ? 'selected' : '' }}>Agar-agar Strip</option>
                    <option value="Amplang Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Amplang Ikan' ? 'selected' : '' }}>Amplang Ikan</option>
                    <option value="Baby Fish" {{ old('jenis_produk', $omzet->jenis_produk) == 'Baby Fish' ? 'selected' : '' }}>Baby Fish</option>
                    <option value="Bakso Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bakso Ikan' ? 'selected' : '' }}>Bakso Ikan</option>
                    <option value="Bandeng Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bandeng Beku' ? 'selected' : '' }}>Bandeng Beku</option>
                    <option value="Bandeng Dalam Saus Tomat" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bandeng Dalam Saus Tomat' ? 'selected' : '' }}>Bandeng Dalam Saus Tomat</option>
                    <option value="Bandeng Duri Lunak" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bandeng Duri Lunak' ? 'selected' : '' }}>Bandeng Duri Lunak</option>
                    <option value="Bandeng Isi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bandeng Isi' ? 'selected' : '' }}>Bandeng Isi</option>
                    <option value="Bandeng Presto" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bandeng Presto' ? 'selected' : '' }}>Bandeng Presto</option>
                    <option value="Bandeng Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bandeng Segar' ? 'selected' : '' }}>Bandeng Segar</option>
                    <option value="Bandeng Tanpa Duri" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bandeng Tanpa Duri' ? 'selected' : '' }}>Bandeng Tanpa Duri</option>
                    <option value="Batagor Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Batagor Ikan' ? 'selected' : '' }}>Batagor Ikan</option>
                    <option value="Bekicot Kaleng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bekicot Kaleng' ? 'selected' : '' }}>Bekicot Kaleng</option>
                    <option value="Belut Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Belut Beku' ? 'selected' : '' }}>Belut Beku</option>
                    <option value="Bola Arteri Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bola Arteri Beku' ? 'selected' : '' }}>Bola Arteri Beku</option>
                    <option value="Bubuk Jeli, Bubuk Puding" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bubuk Jeli, Bubuk Puding' ? 'selected' : '' }}>Bubuk Jeli, Bubuk Puding</option>
                    <option value="Bubuk Udang" {{ old("jenis_produk", $omzet->jenis_produk) == "Bubuk Udang" ? "selected" : "" }}>Bubuk Udang</option>
                    <option value="Bulu Babi Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bulu Babi Beku' ? 'selected' : '' }}>Bulu Babi Beku</option>
                    <option value="Bulu Babi Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bulu Babi Segar' ? 'selected' : '' }}>Bulu Babi Segar</option>
                    <option value="Bumbu berbahan terasi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Bumbu berbahan terasi' ? 'selected' : '' }}>Bumbu berbahan terasi</option>
                    <option value="Cephalopoda Beku (Cumi Karet, Cumi-cumi)" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cephalopoda Beku (Cumi Karet, Cumi-cumi)' ? 'selected' : '' }}>Cephalopoda
                      Beku (Cumi Karet, Cumi-cumi)</option>
                    <option value="Cephalopoda Bernilai Tambah Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cephalopoda Bernilai Tambah Beku' ? 'selected' : '' }}>Cephalopoda Bernilai Tambah
                      Beku</option>
                    <option value="Cephalopoda Kaleng (Sotong, Gurita, Cumi-cumi)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Cephalopoda Kaleng (Sotong, Gurita, Cumi-cumi)' ? 'selected' : '' }}>
                      Cephalopoda Kaleng (Sotong, Gurita, Cumi-cumi)</option>
                    <option value="Cephalopoda Kering (Teri, Sotong, Cumi-cumi)" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cephalopoda Kering (Teri, Sotong, Cumi-cumi)' ? 'selected' : '' }}>
                      Cephalopoda Kering (Teri, Sotong, Cumi-cumi)</option>
                    <option value="Cephalopoda Mentah Beku (Sotong, Gurita, Cumi-cumi)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Cephalopoda Mentah Beku (Sotong, Gurita, Cumi-cumi)' ? 'selected' : '' }}>Cephalopoda Mentah Beku (Sotong, Gurita, Cumi-cumi)
                    </option>
                    <option value="Cephalopoda Rebus Beku (Sotong, Gurita, Cumi-cumi)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Cephalopoda Rebus Beku (Sotong, Gurita, Cumi-cumi)' ? 'selected' : '' }}>Cephalopoda Rebus Beku (Sotong, Gurita, Cumi-cumi)
                    </option>
                    <option value="Cephalopoda Segar (Cumi Karet, Cumi-cumi)" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cephalopoda Segar (Cumi Karet, Cumi-cumi)' ? 'selected' : '' }}>
                      Cephalopoda
                      Segar (Cumi Karet, Cumi-cumi)</option>
                    <option value="Cephalopoda Semi Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cephalopoda Semi Kering' ? 'selected' : '' }}>Cephalopoda Semi Kering</option>
                    <option value="Chitin Chitosan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Chitin Chitosan' ? 'selected' : '' }}>Chitin Chitosan</option>
                    <option value="Chuka Idako" {{ old('jenis_produk', $omzet->jenis_produk) == 'Chuka Idako' ? 'selected' : '' }}>Chuka Idako</option>
                    <option value="Cireng Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cireng Ikan' ? 'selected' : '' }}>Cireng Ikan</option>
                    <option value="Cumi Krispi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cumi Krispi' ? 'selected' : '' }}>Cumi Krispi</option>
                    <option value="Cumi Panggang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cumi Panggang' ? 'selected' : '' }}>Cumi Panggang</option>
                    <option value="Cumi-cumi asin" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cumi-cumi asin' ? 'selected' : '' }}>Cumi-cumi asin</option>
                    <option value="Cumi-Cumi Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cumi-Cumi Beku' ? 'selected' : '' }}>Cumi-Cumi Beku</option>
                    <option value="Cumi-cumi Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Cumi-cumi Kering' ? 'selected' : '' }}>Cumi-cumi Kering</option>
                    <option value="Daging Hiu Kering (Hiu)" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Hiu Kering (Hiu)' ? 'selected' : '' }}>Daging Hiu Kering (Hiu)</option>
                    <option value="Daging Kepiting Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Kepiting Beku' ? 'selected' : '' }}>Daging Kepiting Beku</option>
                    <option value="Daging Kepiting Sterilisasi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Kepiting Sterilisasi' ? 'selected' : '' }}>Daging Kepiting Sterilisasi</option>
                    <option value="Daging Kerang Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Kerang Beku' ? 'selected' : '' }}>Daging Kerang Beku</option>
                    <option value="Daging Rajungan Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Rajungan Beku' ? 'selected' : '' }}>Daging Rajungan Beku</option>
                    <option value="Daging Rajungan Pasteurisasi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Rajungan Pasteurisasi' ? 'selected' : '' }}>Daging Rajungan Pasteurisasi
                    </option>
                    <option value="Daging Rajungan Pasteurisasi Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Rajungan Pasteurisasi Beku' ? 'selected' : '' }}>Daging Rajungan
                      Pasteurisasi Beku</option>
                    <option value="Daging Rajungan Pasteurisasi Kaleng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Rajungan Pasteurisasi Kaleng' ? 'selected' : '' }}>Daging Rajungan
                      Pasteurisasi Kaleng</option>
                    <option value="Daging Rajungan Rebus Dingin" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Rajungan Rebus Dingin' ? 'selected' : '' }}>Daging Rajungan Rebus Dingin
                    </option>
                    <option value="Daging Rajungan Sterilisasi Kaleng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Rajungan Sterilisasi Kaleng' ? 'selected' : '' }}>Daging Rajungan
                      Sterilisasi Kaleng</option>
                    <option value="Daging Tuna Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Tuna Beku' ? 'selected' : '' }}>Daging Tuna Beku</option>
                    <option value="Daging Udang Kipas Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Udang Kipas Beku' ? 'selected' : '' }}>Daging Udang Kipas Beku</option>
                    <option value="Daging Udang Sterilisasi Kaleng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Daging Udang Sterilisasi Kaleng' ? 'selected' : '' }}>Daging Udang Sterilisasi
                      Kaleng
                    </option>
                    <option value="Dendeng Belut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Dendeng Belut' ? 'selected' : '' }}>Dendeng Belut</option>
                    <option value="Dimsum Ikan Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Dimsum Ikan Rumput Laut' ? 'selected' : '' }}>Dimsum Ikan Rumput Laut</option>
                    <option value="Dimsum Ikan, Dimsum Udang (Baby Tuna, Tongkol, Udang, Tenggiri)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Dimsum Ikan, Dimsum Udang (Baby Tuna, Tongkol, Udang, Tenggiri)' ? 'selected' : '' }}>Dimsum Ikan, Dimsum Udang (Baby Tuna,
                      Tongkol, Udang, Tenggiri)</option>
                    <option value="Egg Roll Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Egg Roll Ikan' ? 'selected' : '' }}>Egg Roll Ikan</option>
                    <option value="Ekstrak Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ekstrak Ikan' ? 'selected' : '' }}>Ekstrak Ikan</option>
                    <option value="Ekstrak Krill" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ekstrak Krill' ? 'selected' : '' }}>Ekstrak Krill</option>
                    <option value="Ekstrak Minuman Rumput Laut Jahe" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ekstrak Minuman Rumput Laut Jahe' ? 'selected' : '' }}>Ekstrak Minuman Rumput Laut
                      Jahe</option>
                    <option value="Ekstrak Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ekstrak Udang' ? 'selected' : '' }}>Ekstrak Udang</option>
                    <option value="Fillet Hiu Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Fillet Hiu Beku' ? 'selected' : '' }}>Fillet Hiu Beku</option>
                    <option value="Fillet Ikan Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Fillet Ikan Beku' ? 'selected' : '' }}>Fillet Ikan Beku</option>
                    <option value="Fillet Ikan Demersal Beku (Anggoli, Kerapu, Jenaha, Kakap Merah, Kakap)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Fillet Ikan Demersal Beku (Anggoli, Kerapu, Jenaha, Kakap Merah, Kakap)' ? 'selected' : '' }}>Fillet Ikan Demersal Beku (Anggoli,
                      Kerapu, Jenaha, Kakap Merah, Kakap)</option>
                    <option value="Fillet Ikan Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Fillet Ikan Segar' ? 'selected' : '' }}>Fillet Ikan Segar</option>
                    <option value="Fillet Nila Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Fillet Nila Beku' ? 'selected' : '' }}>Fillet Nila Beku</option>
                    <option value="Fillet Patin Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Fillet Patin Beku' ? 'selected' : '' }}>Fillet Patin Beku</option>
                    <option value="Fillet Salmon Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Fillet Salmon Beku' ? 'selected' : '' }}>Fillet Salmon Beku</option>
                    <option value="Fillet Salmon Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Fillet Salmon Segar' ? 'selected' : '' }}>Fillet Salmon Segar</option>
                    <option value="Fillet Sidat Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Fillet Sidat Beku' ? 'selected' : '' }}>Fillet Sidat Beku</option>
                    <option value="Gelatin Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Gelatin Ikan' ? 'selected' : '' }}>Gelatin Ikan</option>
                    <option value="Gelembung Ikan Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Gelembung Ikan Kering' ? 'selected' : '' }}>Gelembung Ikan Kering</option>
                    <option value="Gurame Bumbu Kuning" {{ old('jenis_produk', $omzet->jenis_produk) == 'Gurame Bumbu Kuning' ? 'selected' : '' }}>Gurame Bumbu Kuning</option>
                    <option value="Gurita Rebus Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Gurita Rebus Beku' ? 'selected' : '' }}>Gurita Rebus Beku</option>
                    <option value="Hati Ikan Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Hati Ikan Beku' ? 'selected' : '' }}>Hati Ikan Beku</option>
                    <option value="Hati Ikan Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Hati Ikan Segar' ? 'selected' : '' }}>Hati Ikan Segar</option>
                    <option value="Hidrolisat Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Hidrolisat Ikan' ? 'selected' : '' }}>Hidrolisat Ikan</option>
                    <option value="Hidrolisat Protein Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Hidrolisat Protein Ikan' ? 'selected' : '' }}>Hidrolisat Protein Ikan</option>
                    <option value="Hiu Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Hiu Beku' ? 'selected' : '' }}>Hiu Beku</option>
                    <option value="Ikan Air Tawar Beku (Gurami, Patin, Nila)" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Air Tawar Beku (Gurami, Patin, Nila)' ? 'selected' : '' }}>Ikan Air
                      Tawar Beku (Gurami, Patin, Nila)</option>
                    <option value="Ikan Air Tawar Bumbu Kuning (Lele)" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Air Tawar Bumbu Kuning (Lele)' ? 'selected' : '' }}>Ikan Air Tawar Bumbu
                      Kuning (Lele)</option>
                    <option value="Ikan Air Tawar Bumbu Marinasi Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Air Tawar Bumbu Marinasi Beku' ? 'selected' : '' }}>Ikan Air Tawar Bumbu
                      Marinasi Beku</option>
                    <option value="Ikan Air Tawar Segar (Gurami, Nila)" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Air Tawar Segar (Gurami, Nila)' ? 'selected' : '' }}>Ikan Air Tawar Segar
                      (Gurami, Nila)</option>
                    <option value="Ikan Asap" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Asap' ? 'selected' : '' }}>Ikan Asap</option>
                    <option value="Ikan Asap Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Asap Beku' ? 'selected' : '' }}>Ikan Asap Beku</option>
                    <option value="Ikan Asin" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Asin' ? 'selected' : '' }}>Ikan Asin</option>
                    <option value="Ikan Asin Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Asin Beku' ? 'selected' : '' }}>Ikan Asin Beku</option>
                    <option value="Ikan Asin Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Asin Kering' ? 'selected' : '' }}>Ikan Asin Kering</option>
                    <option value="Ikan Asin Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Asin Segar' ? 'selected' : '' }}>Ikan Asin Segar</option>
                    <option value="Ikan Bandeng Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Bandeng Beku' ? 'selected' : '' }}>Ikan Bandeng Beku</option>
                    <option value="Ikan Berlapis Tepung Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Berlapis Tepung Beku' ? 'selected' : '' }}>Ikan Berlapis Tepung Beku</option>
                    <option value="Ikan Bumbu Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Bumbu Beku' ? 'selected' : '' }}>Ikan Bumbu Beku</option>
                    <option value="Ikan Demersal Beku (Alaska Pollock, Hoki, Pollock)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Demersal Beku (Alaska Pollock, Hoki, Pollock)' ? 'selected' : '' }}>Ikan Demersal Beku (Alaska Pollock, Hoki, Pollock)
                    </option>
                    <option value="Ikan Demersal Segar (Barakuda, Kakap Putih, Kuwe, Kakap Merah)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Demersal Segar (Barakuda, Kakap Putih, Kuwe, Kakap Merah)' ? 'selected' : '' }}>Ikan Demersal Segar (Barakuda, Kakap Putih,
                      Kuwe, Kakap Merah)</option>
                    <option value="Ikan Demersal Utuh Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Demersal Utuh Beku' ? 'selected' : '' }}>Ikan Demersal Utuh Beku</option>
                    <option value="Ikan Hasil Budidaya Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Hasil Budidaya Beku' ? 'selected' : '' }}>Ikan Hasil Budidaya Beku</option>
                    <option value="Ikan Kaleng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Kaleng' ? 'selected' : '' }}>Ikan Kaleng</option>
                    <option value="Ikan Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Kering' ? 'selected' : '' }}>Ikan Kering</option>
                    <option value="Ikan Makerel Masak Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Makerel Masak Beku' ? 'selected' : '' }}>Ikan Makerel Masak Beku</option>
                    <option value="Ikan Mas Presto" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Mas Presto' ? 'selected' : '' }}>Ikan Mas Presto</option>
                    <option value="Ikan Nike Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Nike Beku' ? 'selected' : '' }}>Ikan Nike Beku</option>
                    <option value="Ikan Pelagis Beku (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Pelagis Beku (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)' ? 'selected' : '' }}>
                      Ikan Pelagis Beku (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)</option>
                    <option value="Ikan Pelagis Bernilai Tambah Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Pelagis Bernilai Tambah Beku' ? 'selected' : '' }}>Ikan Pelagis Bernilai
                      Tambah Beku</option>
                    <option value="Ikan Pelagis Fillet Beku (Lemadang, Gindara, Tenggiri, Pedang)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Pelagis Fillet Beku (Lemadang, Gindara, Tenggiri, Pedang)' ? 'selected' : '' }}>Ikan Pelagis Fillet Beku (Lemadang,
                      Gindara,
                      Tenggiri, Pedang)</option>
                    <option value="Ikan Pelagis Kering Asin (Teri, Lemuru, Kembung, Marlin, Talang-talang, Muroaji, Sarden, Cakalang, Tenggiri)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Pelagis Kering Asin (Teri, Lemuru, Kembung, Marlin, Talang-talang, Muroaji, Sarden, Cakalang, Tenggiri)' ? 'selected' : '' }}>
                      Ikan Pelagis Kering Asin (Teri, Lemuru, Kembung, Marlin, Talang-talang, Muroaji, Sarden, Cakalang, Tenggiri)</option>
                    <option value="Ikan Pelagis Rebus Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Pelagis Rebus Beku' ? 'selected' : '' }}>Ikan Pelagis Rebus Beku</option>
                    <option value="Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)' ? 'selected' : '' }}>
                      Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)</option>
                    <option value="Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel, Makerel Pasifik, Saba Mackerel, Ekor Kuning)"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel, Makerel Pasifik, Saba Mackerel, Ekor Kuning)' ? 'selected' : '' }}>
                      Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel, Makerel Pasifik, Saba Mackerel, Ekor Kuning)</option>
                    <option value="Ikan Pindang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Pindang' ? 'selected' : '' }}>Ikan Pindang</option>
                    <option value="Ikan Renyah" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Renyah' ? 'selected' : '' }}>Ikan Renyah</option>
                    <option value="Ikan Scombroid Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Scombroid Beku' ? 'selected' : '' }}>Ikan Scombroid Beku</option>
                    <option value="Ikan Teri Nasi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Teri Nasi' ? 'selected' : '' }}>Ikan Teri Nasi</option>
                    <option value="Ikan Trout Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ikan Trout Beku' ? 'selected' : '' }}>Ikan Trout Beku</option>
                    <option value="Jambal Roti" {{ old('jenis_produk', $omzet->jenis_produk) == 'Jambal Roti' ? 'selected' : '' }}>Jambal Roti</option>
                    <option value="Kakap Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kakap Beku' ? 'selected' : '' }}>Kakap Beku</option>
                    <option value="Kebab Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kebab Ikan' ? 'selected' : '' }}>Kebab Ikan</option>
                    <option value="Kekerangan Sterilisasi Dalam Kaleng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kekerangan Sterilisasi Dalam Kaleng' ? 'selected' : '' }}>Kekerangan
                      Sterilisasi Dalam Kaleng</option>
                    <option value="Kentang Ebi Goreng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kentang Ebi Goreng' ? 'selected' : '' }}>Kentang Ebi Goreng</option>
                    <option value="Kentang Teri" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kentang Teri' ? 'selected' : '' }}>Kentang Teri</option>
                    <option value="Keong Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Keong Beku' ? 'selected' : '' }}>Keong Beku</option>
                    <option value="Kepiting Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kepiting Beku' ? 'selected' : '' }}>Kepiting Beku</option>
                    <option value="Kepiting Bernilai Tambah Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kepiting Bernilai Tambah Beku' ? 'selected' : '' }}>Kepiting Bernilai Tambah Beku
                    </option>
                    <option value="Kepiting Krispi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kepiting Krispi' ? 'selected' : '' }}>Kepiting Krispi</option>
                    <option value="Kepiting Lunak Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kepiting Lunak Beku' ? 'selected' : '' }}>Kepiting Lunak Beku</option>
                    <option value="Kepiting Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kepiting Segar' ? 'selected' : '' }}>Kepiting Segar</option>
                    <option value="Kerang Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerang Beku' ? 'selected' : '' }}>Kerang Beku</option>
                    <option value="Kerang Bernilai Tambah Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerang Bernilai Tambah Beku' ? 'selected' : '' }}>Kerang Bernilai Tambah Beku
                    </option>
                    <option value="Kerang Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerang Segar' ? 'selected' : '' }}>Kerang Segar</option>
                    <option value="Keripik Bakso Goreng Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Keripik Bakso Goreng Ikan' ? 'selected' : '' }}>Keripik Bakso Goreng Ikan</option>
                    <option value="Keripik Basreng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Keripik Basreng' ? 'selected' : '' }}>Keripik Basreng</option>
                    <option value="Keripik Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Keripik Ikan' ? 'selected' : '' }}>Keripik Ikan</option>
                    <option value="Keripik Kulit Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Keripik Kulit Ikan' ? 'selected' : '' }}>Keripik Kulit Ikan</option>
                    <option value="Keripik Udang Rebon" {{ old('jenis_produk', $omzet->jenis_produk) == 'Keripik Udang Rebon' ? 'selected' : '' }}>Keripik Udang Rebon</option>
                    <option value="Kerupuk Cumi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Cumi' ? 'selected' : '' }}>Kerupuk Cumi</option>
                    <option value="Kerupuk Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Ikan' ? 'selected' : '' }}>Kerupuk Ikan</option>
                    <option value="Kerupuk Ikan Goreng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Ikan Goreng' ? 'selected' : '' }}>Kerupuk Ikan Goreng</option>
                    <option value="Kerupuk Ikan Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Ikan Rumput Laut' ? 'selected' : '' }}>Kerupuk Ikan Rumput Laut</option>
                    <option value="Kerupuk Ikan Tenggiri" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Ikan Tenggiri' ? 'selected' : '' }}>Kerupuk Ikan Tenggiri</option>
                    <option value="Kerupuk Ikan, Kerupuk Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Ikan, Kerupuk Udang' ? 'selected' : '' }}>Kerupuk Ikan, Kerupuk Udang
                    </option>
                    <option value="Kerupuk Kepiting" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Kepiting' ? 'selected' : '' }}>Kerupuk Kepiting</option>
                    <option value="Kerupuk Kulit Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Kulit Ikan' ? 'selected' : '' }}>Kerupuk Kulit Ikan</option>
                    <option value="Kerupuk Rajungan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Rajungan' ? 'selected' : '' }}>Kerupuk Rajungan</option>
                    <option value="Kerupuk Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Rumput Laut' ? 'selected' : '' }}>Kerupuk Rumput Laut</option>
                    <option value="Kerupuk Tulang Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Tulang Ikan' ? 'selected' : '' }}>Kerupuk Tulang Ikan</option>
                    <option value="Kerupuk Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kerupuk Udang' ? 'selected' : '' }}>Kerupuk Udang</option>
                    <option value="Kolagen Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kolagen Ikan' ? 'selected' : '' }}>Kolagen Ikan</option>
                    <option value="Konsentrat Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Konsentrat Ikan' ? 'selected' : '' }}>Konsentrat Ikan</option>
                    <option value="Krispi Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Krispi Ikan' ? 'selected' : '' }}>Krispi Ikan</option>
                    <option value="Krispi Kulit Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Krispi Kulit Ikan' ? 'selected' : '' }}>Krispi Kulit Ikan</option>
                    <option value="Krispi Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Krispi Rumput Laut' ? 'selected' : '' }}>Krispi Rumput Laut</option>
                    <option value="Kue Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kue Ikan' ? 'selected' : '' }}>Kue Ikan</option>
                    <option value="Kukis Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kukis Ikan' ? 'selected' : '' }}>Kukis Ikan</option>
                    <option value="Kukis Udang Rebon" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kukis Udang Rebon' ? 'selected' : '' }}>Kukis Udang Rebon</option>
                    <option value="Kulit Ikan Hiu, Kulit Ikan Pari" {{ old('jenis_produk', $omzet->jenis_produk) == 'Kulit Ikan Hiu, Kulit Ikan Pari' ? 'selected' : '' }}>Kulit Ikan Hiu, Kulit Ikan
                      Pari</option>
                    <option value="Lele Asap" {{ old('jenis_produk', $omzet->jenis_produk) == 'Lele Asap' ? 'selected' : '' }}>Lele Asap</option>
                    <option value="Lele Asap Bumbu Kuning" {{ old('jenis_produk', $omzet->jenis_produk) == 'Lele Asap Bumbu Kuning' ? 'selected' : '' }}>Lele Asap Bumbu Kuning</option>
                    <option value="Lele Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Lele Beku' ? 'selected' : '' }}>Lele Beku</option>
                    <option value="Lele Bumbu Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Lele Bumbu Beku' ? 'selected' : '' }}>Lele Bumbu Beku</option>
                    <option value="Lele Bumbu Kuning" {{ old('jenis_produk', $omzet->jenis_produk) == 'Lele Bumbu Kuning' ? 'selected' : '' }}>Lele Bumbu Kuning</option>
                    <option value="Lele Krispi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Lele Krispi' ? 'selected' : '' }}>Lele Krispi</option>
                    <option value="Lobster Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Lobster Beku' ? 'selected' : '' }}>Lobster Beku</option>
                    <option value="Lobster Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Lobster Segar' ? 'selected' : '' }}>Lobster Segar</option>
                    <option value="Makarel Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Makarel Beku' ? 'selected' : '' }}>Makarel Beku</option>
                    <option value="Makerel dalam Kaleng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Makerel dalam Kaleng' ? 'selected' : '' }}>Makerel dalam Kaleng</option>
                    <option value="Mie Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Mie Rumput Laut' ? 'selected' : '' }}>Mie Rumput Laut</option>
                    <option value="Minyak Hati Cod" {{ old('jenis_produk', $omzet->jenis_produk) == 'Minyak Hati Cod' ? 'selected' : '' }}>Minyak Hati Cod</option>
                    <option value="Minyak Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Minyak Ikan' ? 'selected' : '' }}>Minyak Ikan</option>
                    <option value="Minyak Ikan (Mata Tuna dan Cakalang)" {{ old('jenis_produk', $omzet->jenis_produk) == 'Minyak Ikan (Mata Tuna dan Cakalang)' ? 'selected' : '' }}>Minyak Ikan (Mata
                      Tuna dan Cakalang)</option>
                    <option value="Minyak Ikan Tuna Mentah" {{ old('jenis_produk', $omzet->jenis_produk) == 'Minyak Ikan Tuna Mentah' ? 'selected' : '' }}>Minyak Ikan Tuna Mentah</option>
                    <option value="Minyak Krill" {{ old('jenis_produk', $omzet->jenis_produk) == 'Minyak Krill' ? 'selected' : '' }}>Minyak Krill</option>
                    <option value="Minyak Salmon" {{ old('jenis_produk', $omzet->jenis_produk) == 'Minyak Salmon' ? 'selected' : '' }}>Minyak Salmon</option>
                    <option value="Nila Bernilai Tambah Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Nila Bernilai Tambah Beku' ? 'selected' : '' }}>Nila Bernilai Tambah Beku</option>
                    <option value="Nila Krispi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Nila Krispi' ? 'selected' : '' }}>Nila Krispi</option>
                    <option value="Nori" {{ old('jenis_produk', $omzet->jenis_produk) == 'Nori' ? 'selected' : '' }}>Nori</option>
                    <option value="Nori Bubuk" {{ old('jenis_produk', $omzet->jenis_produk) == 'Nori Bubuk' ? 'selected' : '' }}>Nori Bubuk</option>
                    <option value="Nori Goreng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Nori Goreng' ? 'selected' : '' }}>Nori Goreng</option>
                    <option value="Nori Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Nori Kering' ? 'selected' : '' }}>Nori Kering</option>
                    <option value="Nori Panggang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Nori Panggang' ? 'selected' : '' }}>Nori Panggang</option>
                    <option value="Nugget Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Nugget Ikan' ? 'selected' : '' }}>Nugget Ikan</option>
                    <option value="Omega-3 Acid Ethyl Ester 90 Oil" {{ old('jenis_produk', $omzet->jenis_produk) == 'Omega-3 Acid Ethyl Ester 90 Oil' ? 'selected' : '' }}>Omega-3 Acid Ethyl Ester 90
                      Oil</option>
                    <option value="Otak-Otak Bandeng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Otak-Otak Bandeng' ? 'selected' : '' }}>Otak-Otak Bandeng</option>
                    <option value="Otak-Otak Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Otak-Otak Ikan' ? 'selected' : '' }}>Otak-Otak Ikan</option>
                    <option value="Oyster Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Oyster Beku' ? 'selected' : '' }}>Oyster Beku</option>
                    <option value="Oyster Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Oyster Segar' ? 'selected' : '' }}>Oyster Segar</option>
                    <option value="Paha Kodok Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Paha Kodok Beku' ? 'selected' : '' }}>Paha Kodok Beku</option>
                    <option value="Pari Asin Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Pari Asin Kering' ? 'selected' : '' }}>Pari Asin Kering</option>
                    <option value="Pari Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Pari Beku' ? 'selected' : '' }}>Pari Beku</option>
                    <option value="Pari Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Pari Kering' ? 'selected' : '' }}>Pari Kering</option>
                    <option value="Patin Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Patin Beku' ? 'selected' : '' }}>Patin Beku</option>
                    <option value="Pasta Udang/Shrimp Sauce" {{ old("jenis_produk", $omzet->jenis_produk) == "Pasta Udang/Shrimp Sauce" ? "selected" : "" }}>Pasta Udang/Shrimp Sauce</option>
                    <option value="Pempek Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Pempek Ikan' ? 'selected' : '' }}>Pempek Ikan</option>
                    <option value="Pempek Kriuk" {{ old('jenis_produk', $omzet->jenis_produk) == 'Pempek Kriuk' ? 'selected' : '' }}>Pempek Kriuk</option>
                    <option value="Pepes Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Pepes Ikan' ? 'selected' : '' }}>Pepes Ikan</option>
                    <option value="Perut Ikan Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Perut Ikan Beku' ? 'selected' : '' }}>Perut Ikan Beku</option>
                    <option value="Petis Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Petis Udang' ? 'selected' : '' }}>Petis Udang</option>
                    <option value="Peyek Rebon" {{ old('jenis_produk', $omzet->jenis_produk) == 'Peyek Rebon' ? 'selected' : '' }}>Peyek Rebon</option>
                    <option value="Pilus Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Pilus Ikan' ? 'selected' : '' }}>Pilus Ikan</option>
                    <option value="Pindang Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Pindang Ikan' ? 'selected' : '' }}>Pindang Ikan</option>
                    <option value="Pindang Patin" {{ old('jenis_produk', $omzet->jenis_produk) == 'Pindang Patin' ? 'selected' : '' }}>Pindang Patin</option>
                    <option value="Produk Perikanan Bernilai Tambah Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Produk Perikanan Bernilai Tambah Beku' ? 'selected' : '' }}>Produk
                      Perikanan
                      Bernilai Tambah Beku</option>
                    <option value="Produk Salmon Bernilai Tambah Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Produk Salmon Bernilai Tambah Beku' ? 'selected' : '' }}>Produk Salmon
                      Bernilai
                      Tambah Beku</option>
                    <option value="Rajungan Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rajungan Beku' ? 'selected' : '' }}>Rajungan Beku</option>
                    <option value="Rajungan Krispi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rajungan Krispi' ? 'selected' : '' }}>Rajungan Krispi</option>
                    <option value="Rajungan Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rajungan Segar' ? 'selected' : '' }}>Rajungan Segar</option>
                    <option value="Rendang Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rendang Ikan' ? 'selected' : '' }}>Rendang Ikan</option>
                    <option value="Rendang Tuna" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rendang Tuna' ? 'selected' : '' }}>Rendang Tuna</option>
                    <option value="Rengginang Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rengginang Ikan' ? 'selected' : '' }}>Rengginang Ikan</option>
                    <option value="Risol Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Risol Ikan' ? 'selected' : '' }}>Risol Ikan</option>
                    <option value="Risol Tuna" {{ old('jenis_produk', $omzet->jenis_produk) == 'Risol Tuna' ? 'selected' : '' }}>Risol Tuna</option>
                    <option value="Roti Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Roti Ikan' ? 'selected' : '' }}>Roti Ikan</option>
                    <option value="Rumput Laut Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rumput Laut Beku' ? 'selected' : '' }}>Rumput Laut Beku</option>
                    <option value="Rumput Laut Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rumput Laut Kering' ? 'selected' : '' }}>Rumput Laut Kering</option>
                    <option value="Rumput Laut Panggang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rumput Laut Panggang' ? 'selected' : '' }}>Rumput Laut Panggang</option>
                    <option value="Rumput Laut Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Rumput Laut Segar' ? 'selected' : '' }}>Rumput Laut Segar</option>
                    <option value="Salmon Asap Beku, Trout Asap Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Salmon Asap Beku, Trout Asap Beku' ? 'selected' : '' }}>Salmon Asap Beku, Trout
                      Asap Beku</option>
                    <option value="Salmon Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Salmon Beku' ? 'selected' : '' }}>Salmon Beku</option>
                    <option value="Salmon Beku, Trout Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Salmon Beku, Trout Beku' ? 'selected' : '' }}>Salmon Beku, Trout Beku</option>
                    <option value="Salmon Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Salmon Segar' ? 'selected' : '' }}>Salmon Segar</option>
                    <option value="Salmon Segar, Trout Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Salmon Segar, Trout Segar' ? 'selected' : '' }}>Salmon Segar, Trout Segar</option>
                    <option value="Sambal Cumi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Cumi' ? 'selected' : '' }}>Sambal Cumi</option>
                    <option value="Sambal Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Ikan' ? 'selected' : '' }}>Sambal Ikan</option>
                    <option value="Sambal Ikan Asin" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Ikan Asin' ? 'selected' : '' }}>Sambal Ikan Asin</option>
                    <option value="Sambal Ikan Cakalang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Ikan Cakalang' ? 'selected' : '' }}>Sambal Ikan Cakalang</option>
                    <option value="Sambal Ikan Cakalang Asap" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Ikan Cakalang Asap' ? 'selected' : '' }}>Sambal Ikan Cakalang Asap</option>
                    <option value="Sambal Pasta Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Pasta Udang' ? 'selected' : '' }}>Sambal Pasta Udang</option>
                    <option value="Sambal Roa" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Roa' ? 'selected' : '' }}>Sambal Roa</option>
                    <option value="Sambal Serundeng Ikan Cakalang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Serundeng Ikan Cakalang' ? 'selected' : '' }}>Sambal Serundeng Ikan
                      Cakalang
                    </option>
                    <option value="Sambal Terasi Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Terasi Udang' ? 'selected' : '' }}>Sambal Terasi Udang</option>
                    <option value="Sambal Teri" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Teri' ? 'selected' : '' }}>Sambal Teri</option>
                    <option value="Sambal Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sambal Udang' ? 'selected' : '' }}>Sambal Udang</option>
                    <option value="Sarden Kaleng, Makerel Kaleng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sarden Kaleng, Makerel Kaleng' ? 'selected' : '' }}>Sarden Kaleng, Makerel Kaleng
                    </option>
                    <option value="Sate Bandeng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sate Bandeng' ? 'selected' : '' }}>Sate Bandeng</option>
                    <option value="Saus Tiram" {{ old('jenis_produk', $omzet->jenis_produk) == 'Saus Tiram' ? 'selected' : '' }}>Saus Tiram</option>
                    <option value="Scallop Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Scallop Beku' ? 'selected' : '' }}>Scallop Beku</option>
                    <option value="Scallop Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Scallop Segar' ? 'selected' : '' }}>Scallop Segar</option>
                    <option value="Seaweed Flakes / Powder" {{ old('jenis_produk', $omzet->jenis_produk) == 'Seaweed Flakes / Powder' ? 'selected' : '' }}>Seaweed Flakes / Powder</option>
                    <option value="Semi Refined Carrageenan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Semi Refined Carrageenan' ? 'selected' : '' }}>Semi Refined Carrageenan</option>
                    <option value="Serundeng Ikan Tuna" {{ old('jenis_produk', $omzet->jenis_produk) == 'Serundeng Ikan Tuna' ? 'selected' : '' }}>Serundeng Ikan Tuna</option>
                    <option value="Sidat Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sidat Beku' ? 'selected' : '' }}>Sidat Beku</option>
                    <option value="Sidat Panggang Beku Berbumbu" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sidat Panggang Beku Berbumbu' ? 'selected' : '' }}>Sidat Panggang Beku Berbumbu
                    </option>
                    <option value="Siomay Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Siomay Ikan' ? 'selected' : '' }}>Siomay Ikan</option>
                    <option value="Siput Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Siput Beku' ? 'selected' : '' }}>Siput Beku</option>
                    <option value="Siput Gonggong Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Siput Gonggong Beku' ? 'selected' : '' }}>Siput Gonggong Beku</option>
                    <option value="Siput Segar (Siput)" {{ old('jenis_produk', $omzet->jenis_produk) == 'Siput Segar (Siput)' ? 'selected' : '' }}>Siput Segar (Siput)</option>
                    <option value="Sirip Hiu Kering, Kulit Hiu Kering, Tulang Hiu Kering"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Sirip Hiu Kering, Kulit Hiu Kering, Tulang Hiu Kering' ? 'selected' : '' }}>Sirip Hiu Kering, Kulit Hiu Kering, Tulang Hiu
                      Kering
                    </option>
                    <option value="Sirip Pari Kering, Kulit Pari Kering, Tulang Pari Kering"
                      {{ old('jenis_produk', $omzet->jenis_produk) == 'Sirip Pari Kering, Kulit Pari Kering, Tulang Pari Kering' ? 'selected' : '' }}>Sirip Pari Kering, Kulit Pari Kering, Tulang Pari
                      Kering</option>
                    <option value="Snack Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Snack Ikan' ? 'selected' : '' }}>Snack Ikan</option>
                    <option value="Snack Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Snack Rumput Laut' ? 'selected' : '' }}>Snack Rumput Laut</option>
                    <option value="Steak Ikan Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Steak Ikan Beku' ? 'selected' : '' }}>Steak Ikan Beku</option>
                    <option value="Stik Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Stik Ikan' ? 'selected' : '' }}>Stik Ikan</option>
                    <option value="Stik Kepiting Analog Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Stik Kepiting Analog Beku' ? 'selected' : '' }}>Stik Kepiting Analog Beku</option>
                    <option value="Stik Lele" {{ old('jenis_produk', $omzet->jenis_produk) == 'Stik Lele' ? 'selected' : '' }}>Stik Lele</option>
                    <option value="Stik Tulang Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Stik Tulang Ikan' ? 'selected' : '' }}>Stik Tulang Ikan</option>
                    <option value="Stik Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Stik Udang' ? 'selected' : '' }}>Stik Udang</option>
                    <option value="Sumpia Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sumpia Udang' ? 'selected' : '' }}>Sumpia Udang</option>
                    <option value="Surimi Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Surimi Beku' ? 'selected' : '' }}>Surimi Beku</option>
                    <option value="Surimi Bumbu Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Surimi Bumbu Beku' ? 'selected' : '' }}>Surimi Bumbu Beku</option>
                    <option value="Sushi Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sushi Ikan' ? 'selected' : '' }}>Sushi Ikan</option>
                    <option value="Sushi Nori" {{ old('jenis_produk', $omzet->jenis_produk) == 'Sushi Nori' ? 'selected' : '' }}>Sushi Nori</option>
                    <option value="Susu Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Susu Rumput Laut' ? 'selected' : '' }}>Susu Rumput Laut</option>
                    <option value="Tahu Bakso Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tahu Bakso Ikan' ? 'selected' : '' }}>Tahu Bakso Ikan</option>
                    <option value="Takoyaki Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Takoyaki Beku' ? 'selected' : '' }}>Takoyaki Beku</option>
                    <option value="Tekwan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tekwan' ? 'selected' : '' }}>Tekwan</option>
                    <option value="Telur Bulu Babi Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Telur Bulu Babi Beku' ? 'selected' : '' }}>Telur Bulu Babi Beku</option>
                    <option value="Telur Bulu Babi Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Telur Bulu Babi Segar' ? 'selected' : '' }}>Telur Bulu Babi Segar</option>
                    <option value="Telur Ikan Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Telur Ikan Beku' ? 'selected' : '' }}>Telur Ikan Beku</option>
                    <option value="Telur Ikan Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Telur Ikan Segar' ? 'selected' : '' }}>Telur Ikan Segar</option>
                    <option value="Telur Ikan Terbang Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Telur Ikan Terbang Beku' ? 'selected' : '' }}>Telur Ikan Terbang Beku</option>
                    <option value="Telur Ikan Terbang Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Telur Ikan Terbang Kering' ? 'selected' : '' }}>Telur Ikan Terbang Kering</option>
                    <option value="Tepung Agar-agar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tepung Agar-agar' ? 'selected' : '' }}>Tepung Agar-agar</option>
                    <option value="Tepung Alginat" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tepung Alginat' ? 'selected' : '' }}>Tepung Alginat</option>
                    <option value="Tepung Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tepung Ikan' ? 'selected' : '' }}>Tepung Ikan</option>
                    <option value="Tepung Ikan Teri" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tepung Ikan Teri' ? 'selected' : '' }}>Tepung Ikan Teri</option>
                    <option value="Tepung Karagenan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tepung Karagenan' ? 'selected' : '' }}>Tepung Karagenan</option>
                    <option value="Tepung Karaginan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tepung Karaginan' ? 'selected' : '' }}>Tepung Karaginan</option>
                    <option value="Tepung Tulang Ikan" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tepung Tulang Ikan' ? 'selected' : '' }}>Tepung Tulang Ikan</option>
                    <option value="Tepung Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tepung Udang' ? 'selected' : '' }}>Tepung Udang</option>
                    <option value="Terasi Bubuk" {{ old('jenis_produk', $omzet->jenis_produk) == 'Terasi Bubuk' ? 'selected' : '' }}>Terasi Bubuk</option>
                    <option value="Terasi Udang" {{ old('jenis_produk', $omzet->jenis_produk) == 'Terasi Udang' ? 'selected' : '' }}>Terasi Udang</option>
                    <option value="Teri Asin Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Teri Asin Kering' ? 'selected' : '' }}>Teri Asin Kering</option>
                    <option value="Teri Goreng Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Teri Goreng Kering' ? 'selected' : '' }}>Teri Goreng Kering</option>
                    <option value="Teripang Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Teripang Beku' ? 'selected' : '' }}>Teripang Beku</option>
                    <option value="Teripang Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Teripang Kering' ? 'selected' : '' }}>Teripang Kering</option>
                    <option value="Teripang Rebus Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Teripang Rebus Beku' ? 'selected' : '' }}>Teripang Rebus Beku</option>
                    <option value="Teripang Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Teripang Segar' ? 'selected' : '' }}>Teripang Segar</option>
                    <option value="Tortilla Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tortilla Rumput Laut' ? 'selected' : '' }}>Tortilla Rumput Laut</option>
                    <option value="Tulang Hiu Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tulang Hiu Kering' ? 'selected' : '' }}>Tulang Hiu Kering</option>
                    <option value="Tulang Ikan Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tulang Ikan Kering' ? 'selected' : '' }}>Tulang Ikan Kering</option>
                    <option value="Tulang Pari Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tulang Pari Kering' ? 'selected' : '' }}>Tulang Pari Kering</option>
                    <option value="Tuna Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tuna Beku' ? 'selected' : '' }}>Tuna Beku</option>
                    <option value="Tuna Kaleng" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tuna Kaleng' ? 'selected' : '' }}>Tuna Kaleng</option>
                    <option value="Tuna Loin Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tuna Loin Beku' ? 'selected' : '' }}>Tuna Loin Beku</option>
                    <option value="Tuna Loin Masak Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tuna Loin Masak Beku' ? 'selected' : '' }}>Tuna Loin Masak Beku</option>
                    <option value="Tuna Pouch" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tuna Pouch' ? 'selected' : '' }}>Tuna Pouch</option>
                    <option value="Tuna Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Tuna Segar' ? 'selected' : '' }}>Tuna Segar</option>
                    <option value="Ubur-ubur Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Ubur-ubur Kering' ? 'selected' : '' }}>Ubur-ubur Kering</option>
                    <option value="Udang Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Beku' ? 'selected' : '' }}>Udang Beku</option>
                    <option value="Udang Berlapis Tepung Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Berlapis Tepung Beku' ? 'selected' : '' }}>Udang Berlapis Tepung Beku</option>
                    <option value="Udang Kering" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Kering' ? 'selected' : '' }}>Udang Kering</option>
                    <option value="Udang Kipas Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Kipas Beku' ? 'selected' : '' }}>Udang Kipas Beku</option>
                    <option value="Udang Krispi" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Krispi' ? 'selected' : '' }}>Udang Krispi</option>
                    <option value="Udang Kupas Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Kupas Beku' ? 'selected' : '' }}>Udang Kupas Beku</option>
                    <option value="Udang Masak Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Masak Beku' ? 'selected' : '' }}>Udang Masak Beku</option>
                    <option value="Udang Mentah Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Mentah Beku' ? 'selected' : '' }}>Udang Mentah Beku</option>
                    <option value="Udang Rebus Beku" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Rebus Beku' ? 'selected' : '' }}>Udang Rebus Beku</option>
                    <option value="Udang Segar" {{ old('jenis_produk', $omzet->jenis_produk) == 'Udang Segar' ? 'selected' : '' }}>Udang Segar</option>
                    <option value="Wakame Produk" {{ old('jenis_produk', $omzet->jenis_produk) == 'Wakame Produk' ? 'selected' : '' }}>Wakame Produk</option>
                    <option value="Yoghurt Rumput Laut" {{ old('jenis_produk', $omzet->jenis_produk) == 'Yoghurt Rumput Laut' ? 'selected' : '' }}>Yoghurt Rumput Laut</option>
                  </select>
                  @error('jenis_produk')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="tujuan_domes">Tujuan Domestik</label>
                  <select class="form-control @error('tujuan_domes') is-invalid @enderror select2" id="tujuan_domes" name="tujuan_domes">
                    <option value="" disabled selected>Pilih Tujuan Domestik</option>
                    <option value="Tidak Ada" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="Nanggroe Aceh Darussalam" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Nanggroe Aceh Darussalam' ? 'selected' : '' }}>Nanggroe Aceh Darussalam</option>
                    <option value="Sumatera Utara" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                    <option value="Sumatera Barat" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Sumatera Barat' ? 'selected' : '' }}>Sumatera Barat</option>
                    <option value="Sumatera Selatan" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Sumatera Selatan' ? 'selected' : '' }}>Sumatera Selatan</option>
                    <option value="Riau" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Riau' ? 'selected' : '' }}>Riau</option>
                    <option value="Kepulauan Riau" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Kepulauan Riau' ? 'selected' : '' }}>Kepulauan Riau</option>
                    <option value="Jambi" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Jambi' ? 'selected' : '' }}>Jambi</option>
                    <option value="Bengkulu" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Bengkulu' ? 'selected' : '' }}>Bengkulu</option>
                    <option value="Lampung" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Lampung' ? 'selected' : '' }}>Lampung</option>
                    <option value="Banten" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Banten' ? 'selected' : '' }}>Banten</option>
                    <option value="Bangka Belitung" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Bangka Belitung' ? 'selected' : '' }}>Bangka Belitung</option>
                    <option value="DKI Jakarta" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                    <option value="Jawa Barat" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                    <option value="Jawa Timur" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                    <option value="Jawa Tengah" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                    <option value="Yogyakarta" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Yogyakarta' ? 'selected' : '' }}>Yogyakarta</option>
                    <option value="Bali" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Bali' ? 'selected' : '' }}>Bali</option>
                    <option value="Nusa Tenggara Barat" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Nusa Tenggara Barat' ? 'selected' : '' }}>Nusa Tenggara Barat</option>
                    <option value="Nusa Tenggara Timur" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Nusa Tenggara Timur' ? 'selected' : '' }}>Nusa Tenggara Timur</option>
                    <option value="Kalimantan Barat" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Kalimantan Barat' ? 'selected' : '' }}>Kalimantan Barat</option>
                    <option value="Kalimantan Tengah" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Kalimantan Tengah' ? 'selected' : '' }}>Kalimantan Tengah</option>
                    <option value="Kalimantan Selatan" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Kalimantan Selatan' ? 'selected' : '' }}>Kalimantan Selatan</option>
                    <option value="Kalimantan Timur" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Kalimantan Timur' ? 'selected' : '' }}>Kalimantan Timur</option>
                    <option value="Kalimantan Utara" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Kalimantan Utara' ? 'selected' : '' }}>Kalimantan Utara</option>
                    <option value="Sulawesi Utara" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Sulawesi Utara' ? 'selected' : '' }}>Sulawesi Utara</option>
                    <option value="Sulawesi Tengah" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Sulawesi Tengah' ? 'selected' : '' }}>Sulawesi Tengah</option>
                    <option value="Sulawesi Selatan" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                    <option value="Sulawesi Tenggara" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Sulawesi Tenggara' ? 'selected' : '' }}>Sulawesi Tenggara</option>
                    <option value="Sulawesi Barat" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Sulawesi Barat' ? 'selected' : '' }}>Sulawesi Barat</option>
                    <option value="Gorontalo" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Gorontalo' ? 'selected' : '' }}>Gorontalo</option>
                    <option value="Maluku" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Maluku' ? 'selected' : '' }}>Maluku</option>
                    <option value="Maluku Utara" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Maluku Utara' ? 'selected' : '' }}>Maluku Utara</option>
                    <option value="Papua Barat" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Papua Barat' ? 'selected' : '' }}>Papua Barat</option>
                    <option value="Papua" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Papua' ? 'selected' : '' }}>Papua</option>
                    <option value="Papua Barat Daya" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Papua Barat Daya' ? 'selected' : '' }}>Papua Barat Daya</option>
                    <option value="Papua Selatan" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Papua Selatan' ? 'selected' : '' }}>Papua Selatan</option>
                    <option value="Papua Tengah" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Papua Tengah' ? 'selected' : '' }}>Papua Tengah</option>
                    <option value="Papua Pegunungan" {{ old('tujuan_domes', $omzet->tujuan_domes) == 'Papua Pegunungan' ? 'selected' : '' }}>Papua Pegunungan</option>
                  </select>
                  @error('tujuan_domes')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Nilai Domestik (Rp)</label>
                  <input type="text" id="nilai_domes" name="nilai_domes" class="form-control" value="{{ old('nilai_domes', $omzet->nilai_domes) }}">
                </div>
                <div class="form-group">
                  <label>Volume Domestik (Kg)</label>
                  <input type="number" name="volume_domes" class="form-control" value="{{ old('volume_domes', $omzet->volume_domes) }}">
                </div>
                <div class="form-group">
                  <label for="tujuan_luarnegeri">Tujuan Luar Negeri</label>
                  <select class="form-control @error('tujuan_luarnegeri') is-invalid @enderror select2" id="tujuan_luarnegeri" name="tujuan_luarnegeri" required>
                    <option value="" disabled selected>Pilih Negara Tujuan</option>
                    <option value="Tidak Ada" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    <option value="Afghanistan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                    <option value="Albania" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Albania' ? 'selected' : '' }}>Albania</option>
                    <option value="Algeria" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                    <option value="Andorra" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                    <option value="Angola" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Angola' ? 'selected' : '' }}>Angola</option>
                    <option value="Antigua and Barbuda" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Antigua and Barbuda' ? 'selected' : '' }}>Antigua and Barbuda</option>
                    <option value="Argentina" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                    <option value="Armenia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                    <option value="Australia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Australia' ? 'selected' : '' }}>Australia</option>
                    <option value="Austria" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Austria' ? 'selected' : '' }}>Austria</option>
                    <option value="Azerbaijan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                    <option value="Bahamas" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                    <option value="Bahrain" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                    <option value="Bangladesh" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                    <option value="Barbados" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                    <option value="Belarus" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                    <option value="Belgium" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                    <option value="Belize" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Belize' ? 'selected' : '' }}>Belize</option>
                    <option value="Benin" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Benin' ? 'selected' : '' }}>Benin</option>
                    <option value="Bhutan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                    <option value="Bolivia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                    <option value="Bosnia and Herzegovina" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                    <option value="Botswana" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                    <option value="Brazil" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                    <option value="Brunei" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                    <option value="Bulgaria" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                    <option value="Burkina Faso" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                    <option value="Burundi" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                    <option value="Cabo Verde" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Cabo Verde' ? 'selected' : '' }}>Cabo Verde</option>
                    <option value="Cambodia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                    <option value="Cameroon" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                    <option value="Canada" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Canada' ? 'selected' : '' }}>Canada</option>
                    <option value="Central African Republic" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                    <option value="Chad" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Chad' ? 'selected' : '' }}>Chad</option>
                    <option value="Chile" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Chile' ? 'selected' : '' }}>Chile</option>
                    <option value="China" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'China' ? 'selected' : '' }}>China</option>
                    <option value="Colombia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                    <option value="Comoros" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                    <option value="Congo (Congo-Brazzaville)" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Congo (Congo-Brazzaville)' ? 'selected' : '' }}>Congo (Congo-Brazzaville)
                    </option>
                    <option value="Costa Rica" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                    <option value="Croatia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                    <option value="Cuba" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                    <option value="Cyprus" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                    <option value="Czech Republic" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                    <option value="Democratic Republic of the Congo" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Democratic Republic of the Congo' ? 'selected' : '' }}>Democratic
                      Republic of the Congo</option>
                    <option value="Denmark" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                    <option value="Djibouti" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                    <option value="Dominica" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                    <option value="Dominican Republic" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                    <option value="Ecuador" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                    <option value="Egypt" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                    <option value="El Salvador" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                    <option value="Equatorial Guinea" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
                    <option value="Eritrea" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                    <option value="Estonia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                    <option value="Eswatini" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Eswatini' ? 'selected' : '' }}>Eswatini</option>
                    <option value="Ethiopia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                    <option value="Fiji" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                    <option value="Finland" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Finland' ? 'selected' : '' }}>Finland</option>
                    <option value="France" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'France' ? 'selected' : '' }}>France</option>
                    <option value="Gabon" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                    <option value="Gambia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Gambia' ? 'selected' : '' }}>Gambia</option>
                    <option value="Georgia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                    <option value="Germany" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Germany' ? 'selected' : '' }}>Germany</option>
                    <option value="Ghana" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                    <option value="Greece" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Greece' ? 'selected' : '' }}>Greece</option>
                    <option value="Grenada" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Grenada' ? 'selected' : '' }}>Grenada</option>
                    <option value="Guatemala" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                    <option value="Guinea" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Guinea' ? 'selected' : '' }}>Guinea</option>
                    <option value="Guinea-Bissau" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>
                    <option value="Guyana" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Guyana' ? 'selected' : '' }}>Guyana</option>
                    <option value="Haiti" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                    <option value="Honduras" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                    <option value="Hungary" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                    <option value="Iceland" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                    <option value="India" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'India' ? 'selected' : '' }}>India</option>
                    <option value="Indonesia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                    <option value="Iran" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Iran' ? 'selected' : '' }}>Iran</option>
                    <option value="Iraq" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                    <option value="Ireland" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                    <option value="Israel" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Israel' ? 'selected' : '' }}>Israel</option>
                    <option value="Italy" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Italy' ? 'selected' : '' }}>Italy</option>
                    <option value="Jamaica" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                    <option value="Japan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Japan' ? 'selected' : '' }}>Japan</option>
                    <option value="Jordan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                    <option value="Kazakhstan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                    <option value="Kenya" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                    <option value="Kiribati" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
                    <option value="Kuwait" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                    <option value="Kyrgyzstan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                    <option value="Laos" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Laos' ? 'selected' : '' }}>Laos</option>
                    <option value="Latvia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                    <option value="Lebanon" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                    <option value="Lesotho" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                    <option value="Liberia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                    <option value="Libya" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Libya' ? 'selected' : '' }}>Libya</option>
                    <option value="Liechtenstein" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
                    <option value="Lithuania" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                    <option value="Luxembourg" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                    <option value="Madagascar" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                    <option value="Malawi" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                    <option value="Malaysia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                    <option value="Maldives" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                    <option value="Mali" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Mali' ? 'selected' : '' }}>Mali</option>
                    <option value="Malta" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Malta' ? 'selected' : '' }}>Malta</option>
                    <option value="Marshall Islands" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>
                    <option value="Mauritania" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                    <option value="Mauritius" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                    <option value="Mexico" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                    <option value="Micronesia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Micronesia' ? 'selected' : '' }}>Micronesia</option>
                    <option value="Moldova" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Moldova' ? 'selected' : '' }}>Moldova</option>
                    <option value="Monaco" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                    <option value="Mongolia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                    <option value="Montenegro" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
                    <option value="Morocco" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                    <option value="Mozambique" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                    <option value="Myanmar" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                    <option value="Namibia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                    <option value="Nauru" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Nauru' ? 'selected' : '' }}>Nauru</option>
                    <option value="Nepal" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                    <option value="Netherlands" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                    <option value="New Zealand" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                    <option value="Nicaragua" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                    <option value="Niger" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Niger' ? 'selected' : '' }}>Niger</option>
                    <option value="Nigeria" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                    <option value="North Korea" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'North Korea' ? 'selected' : '' }}>North Korea</option>
                    <option value="North Macedonia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'North Macedonia' ? 'selected' : '' }}>North Macedonia</option>
                    <option value="Norway" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Norway' ? 'selected' : '' }}>Norway</option>
                    <option value="Oman" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Oman' ? 'selected' : '' }}>Oman</option>
                    <option value="Pakistan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                    <option value="Palau" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Palau' ? 'selected' : '' }}>Palau</option>
                    <option value="Palestine" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Palestine' ? 'selected' : '' }}>Palestine</option>
                    <option value="Panama" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Panama' ? 'selected' : '' }}>Panama</option>
                    <option value="Papua New Guinea" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>
                    <option value="Paraguay" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                    <option value="Peru" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Peru' ? 'selected' : '' }}>Peru</option>
                    <option value="Philippines" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                    <option value="Poland" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Poland' ? 'selected' : '' }}>Poland</option>
                    <option value="Portugal" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                    <option value="Qatar" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                    <option value="Romania" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Romania' ? 'selected' : '' }}>Romania</option>
                    <option value="Russia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Russia' ? 'selected' : '' }}>Russia</option>
                    <option value="Rwanda" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                    <option value="Saint Kitts and Nevis" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                    <option value="Saint Lucia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
                    <option value="Saint Vincent and the Grenadines" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>Saint Vincent
                      and the Grenadines</option>
                    <option value="Samoa" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Samoa' ? 'selected' : '' }}>Samoa</option>
                    <option value="San Marino" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'San Marino' ? 'selected' : '' }}>San Marino</option>
                    <option value="Sao Tome and Principe" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and Principe</option>
                    <option value="Saudi Arabia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                    <option value="Senegal" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                    <option value="Serbia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                    <option value="Seychelles" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                    <option value="Sierra Leone" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                    <option value="Singapore" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                    <option value="Slovakia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                    <option value="Slovenia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                    <option value="Solomon Islands" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>
                    <option value="Somalia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                    <option value="South Africa" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                    <option value="South Korea" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                    <option value="South Sudan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
                    <option value="Spain" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Spain' ? 'selected' : '' }}>Spain</option>
                    <option value="Sri Lanka" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                    <option value="Sudan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                    <option value="Suriname" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Suriname' ? 'selected' : '' }}>Suriname</option>
                    <option value="Sweden" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                    <option value="Switzerland" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                    <option value="Syria" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Syria' ? 'selected' : '' }}>Syria</option>
                    <option value="Taiwan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
                    <option value="Tajikistan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                    <option value="Tanzania" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                    <option value="Thailand" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                    <option value="Timor-Leste" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Timor-Leste' ? 'selected' : '' }}>Timor-Leste</option>
                    <option value="Togo" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Togo' ? 'selected' : '' }}>Togo</option>
                    <option value="Tonga" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Tonga' ? 'selected' : '' }}>Tonga</option>
                    <option value="Trinidad and Tobago" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
                    <option value="Tunisia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                    <option value="Turkey" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                    <option value="Turkmenistan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                    <option value="Tuvalu" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
                    <option value="Uganda" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                    <option value="Ukraine" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                    <option value="United Arab Emirates" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                    <option value="United Kingdom" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                    <option value="United States of America" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'United States of America' ? 'selected' : '' }}>United States of America
                    </option>
                    <option value="Uruguay" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                    <option value="Uzbekistan" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                    <option value="Vanuatu" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
                    <option value="Vatican City" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Vatican City' ? 'selected' : '' }}>Vatican City</option>
                    <option value="Venezuela" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                    <option value="Vietnam" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                    <option value="Yemen" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                    <option value="Zambia" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                    <option value="Zimbabwe" {{ old('tujuan_luarnegeri', $omzet->tujuan_luarnegeri) == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                  </select>
                  @error('tujuan_luarnegeri')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Nilai Luar Negeri ($)</label>
                  <input type="text" id="nilai_luarnegeri" name="nilai_luarnegeri" class="form-control" value="{{ old('nilai_luarnegeri', $omzet->nilai_luarnegeri) }}">
                </div>
                <div class="form-group">
                  <label>Volume Luar Negeri (Kg)</label>
                  <input type="number" name="volume_luarnegeri" class="form-control" value="{{ old('volume_luarnegeri', $omzet->volume_luarnegeri) }}">
                </div>
                <div class="form-group">
                  <label>Tahun</label>
                  <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $omzet->tahun) }}" required>
                </div>
                <div class="form-group">
                  <label>Triwulan</label>
                  <select name="triwulan" class="form-control @error('triwulan') is-invalid @enderror" required>
                    <option value="" disabled selected>Pilih Triwulan</option>
                    <option value="1" {{ old('triwulan', $omzet->triwulan) == 1 ? 'selected' : '' }}>(Januari - Maret)</option>
                    <option value="2" {{ old('triwulan', $omzet->triwulan) == 2 ? 'selected' : '' }}>(April - Juni)</option>
                    <option value="3" {{ old('triwulan', $omzet->triwulan) == 3 ? 'selected' : '' }}>(Juli - September)</option>
                    <option value="4" {{ old('triwulan', $omzet->triwulan) == 4 ? 'selected' : '' }}>(Oktober - Desember)</option>
                  </select>
                  @error('triwulan')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <button type="submit" class="btn btn-info"><i class="far fa-edit"></i>Update</button>
                <a href="{{ route('omzettabel.index') }}" class="btn btn btn-icon icon-left btn-warning" data-cancel-confirm><i class="fas fa-times"></i>Batal</a>
              </form>
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
    <script>
      function formatRupiah(angka) {
          let number_string = angka.replace(/[^,\d]/g, '').toString(),
              split = number_string.split(','),
              sisa = split[0].length % 3,
              rupiah = split[0].substr(0, sisa),
              ribuan = split[0].substr(sisa).match(/\d{3}/gi);
      
          if (ribuan) {
              let separator = sisa ? '.' : '';
              rupiah += separator + ribuan.join('.');
          }
          rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
          return rupiah;
      }
      
      document.addEventListener('DOMContentLoaded', function() {
          // Untuk input Nilai Domestik
          const domesInput = document.getElementById('nilai_domes');
          if (domesInput) {
              domesInput.addEventListener('input', function(e) {
                  let value = this.value.replace(/\./g, '');
                  this.value = formatRupiah(value);
              });
          }
          // Untuk input Nilai Luar Negeri
          const luarInput = document.getElementById('nilai_luarnegeri');
          if (luarInput) {
              luarInput.addEventListener('input', function(e) {
                  let value = this.value.replace(/\./g, '');
                  this.value = formatRupiah(value);
              });
          }
      
          // Bersihkan titik sebelum submit form
          document.querySelectorAll('form').forEach(function(form) {
              form.addEventListener('submit', function() {
                  if (domesInput) domesInput.value = domesInput.value.replace(/\./g, '');
                  if (luarInput) luarInput.value = luarInput.value.replace(/\./g, '');
              });
          });
      });
    </script>      
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
            if (!confirm('Ingin membatalkan perubahan data?')) {
              e.preventDefault();
            }
          });
        }
      });
    </script>
@endpush
