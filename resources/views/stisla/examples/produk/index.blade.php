@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Input Data Produk' }}
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

    <h2 class="section-title">Form Input Produk</h2>
    <p class="section-lead">Isi data-data terkait produk perikanan.</p>

    {{-- Menggunakan named route 'input.produks.store' --}}
    <form action="{{ route('input.produks.store') }}" method="POST">
      @csrf
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Produk</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="jenis_produk">Jenis Produk</label>
                <select class="form-control @error('jenis_produk') is-invalid @enderror select2" id="jenis_produk" name="jenis_produk" required>
                    <option value="">Pilih Jenis Produk</option>
                    <option value="Abalone Beku" {{ old('jenis_produk') == 'Abalone Beku' ? 'selected' : '' }}>Abalone Beku</option>
                    <option value="Abalone Kering" {{ old('jenis_produk') == 'Abalone Kering' ? 'selected' : '' }}>Abalone Kering</option>
                    <option value="Abon Ikan">{{ old('jenis_produk') == 'Abon Ikan' ? 'selected' : '' }}Abon Ikan</option>
                    <option value="Abon Ikan">{{ old('jenis_produk') == 'Abon Ikan' ? 'selected' : '' }}Abon Ikan</option>
                    <option value="Abon Ikan Cakalang">{{ old('jenis_produk') == 'Abon Ikan Cakalang' ? 'selected' : '' }}Abon Ikan Cakalang</option>
                    <option value="Abon Ikan Nila">{{ old('jenis_produk') == 'Abon Ikan Nila' ? 'selected' : '' }}Abon Ikan Nila</option>
                    <option value="Abon Lele">{{ old('jenis_produk') == 'Abon Lele' ? 'selected' : '' }}Abon Lele</option>
                    <option value="Abon Patin">{{ old('jenis_produk') == 'Abon Patin' ? 'selected' : '' }}Abon Patin</option>
                    <option value="Abon Rumput Laut">{{ old('jenis_produk') == 'Abon Rumput Laut' ? 'selected' : '' }}Abon Rumput Laut</option>
                    <option value="Agar-agar Strip">{{ old('jenis_produk') == 'Agar-agar Strip' ? 'selected' : '' }}Agar-agar Strip</option>
                    <option value="Amplang Ikan">{{ old('jenis_produk') == 'Amplang Ikan' ? 'selected' : '' }}Amplang Ikan</option>
                    <option value="Baby Fish">{{ old('jenis_produk') == 'Baby Fish' ? 'selected' : '' }}Baby Fish</option>
                    <option value="Bakso Ikan">{{ old('jenis_produk') == 'Bakso Ikan' ? 'selected' : '' }}Bakso Ikan</option>
                    <option value="Bandeng Beku">{{ old('jenis_produk') == 'Bandeng Beku' ? 'selected' : '' }}Bandeng Beku</option>
                    <option value="Bandeng Dalam Saus Tomat">{{ old('jenis_produk') == 'Bandeng Dalam Saus Tomat' ? 'selected' : '' }}Bandeng Dalam Saus Tomat</option>
                    <option value="Bandeng Duri Lunak">{{ old('jenis_produk') == 'Bandeng Duri Lunak' ? 'selected' : '' }}Bandeng Duri Lunak</option>
                    <option value="Bandeng Isi">{{ old('jenis_produk') == 'Bandeng Isi' ? 'selected' : '' }}Bandeng Isi</option>
                    <option value="Bandeng Presto">{{ old('jenis_produk') == 'Bandeng Presto' ? 'selected' : '' }}Bandeng Presto</option>
                    <option value="Bandeng Segar">{{ old('jenis_produk') == 'Bandeng Segar' ? 'selected' : '' }}Bandeng Segar</option>
                    <option value="Bandeng Tanpa Duri">{{ old('jenis_produk') == 'Bandeng Tanpa Duri' ? 'selected' : '' }}Bandeng Tanpa Duri</option>
                    <option value="Batagor Ikan">{{ old('jenis_produk') == 'Batagor Ikan' ? 'selected' : '' }}Batagor Ikan</option>
                    <option value="Bekicot Kaleng">{{ old('jenis_produk') == 'Bekicot Kaleng' ? 'selected' : '' }}Bekicot Kaleng</option>
                    <option value="Belut Beku">{{ old('jenis_produk') == 'Belut Beku' ? 'selected' : '' }}Belut Beku</option>
                    <option value="Bola Arteri Beku">{{ old('jenis_produk') == 'Bola Arteri Beku' ? 'selected' : '' }}Bola Arteri Beku</option>
                    <option value="Bubuk Jeli, Bubuk Puding">{{ old('jenis_produk') == 'Bubuk Jeli, Bubuk Puding' ? 'selected' : '' }}Bubuk Jeli, Bubuk Puding</option>
                    <option value="Bulu Babi Beku">{{ old('jenis_produk') == 'Bulu Babi Beku' ? 'selected' : '' }}Bulu Babi Beku</option>
                    <option value="Bulu Babi Segar">{{ old('jenis_produk') == 'Bulu Babi Segar' ? 'selected' : '' }}Bulu Babi Segar</option>
                    <option value="Bumbu berbahan terasi">{{ old('jenis_produk') == 'Bumbu berbahan terasi' ? 'selected' : '' }}Bumbu berbahan terasi</option>
                    <option value="Cephalopoda Beku (Cumi Karet, Cumi-cumi)">{{ old('jenis_produk') == 'Cephalopoda Beku (Cumi Karet, Cumi-cumi)' ? 'selected' : '' }}Cephalopoda Beku (Cumi Karet, Cumi-cumi)</option>
                    <option value="Cephalopoda Bernilai Tambah Beku">{{ old('jenis_produk') == 'Cephalopoda Bernilai Tambah Beku' ? 'selected' : '' }}Cephalopoda Bernilai Tambah Beku</option>
                    <option value="Cephalopoda Kaleng (Sotong, Gurita, Cumi-cumi)">{{ old('jenis_produk') == 'Cephalopoda Kaleng (Sotong, Gurita, Cumi-cumi)' ? 'selected' : '' }}Cephalopoda Kaleng (Sotong, Gurita, Cumi-cumi)</option>
                    <option value="Cephalopoda Kering (Teri, Sotong, Cumi-cumi)">{{ old('jenis_produk') == 'Cephalopoda Kering (Teri, Sotong, Cumi-cumi)' ? 'selected' : '' }}Cephalopoda Kering (Teri, Sotong, Cumi-cumi)</option>
                    <option value="Cephalopoda Mentah Beku (Sotong, Gurita, Cumi-cumi)">{{ old('jenis_produk') == 'Cephalopoda Mentah Beku (Sotong, Gurita, Cumi-cumi)' ? 'selected' : '' }}Cephalopoda Mentah Beku (Sotong, Gurita, Cumi-cumi)</option>
                    <option value="Cephalopoda Rebus Beku (Sotong, Gurita, Cumi-cumi)">{{ old('jenis_produk') == 'Cephalopoda Rebus Beku (Sotong, Gurita, Cumi-cumi)' ? 'selected' : '' }}Cephalopoda Rebus Beku (Sotong, Gurita, Cumi-cumi)</option>
                    <option value="Cephalopoda Segar (Cumi Karet, Cumi-cumi)">{{ old('jenis_produk') == 'Cephalopoda Segar (Cumi Karet, Cumi-cumi)' ? 'selected' : '' }}Cephalopoda Segar (Cumi Karet, Cumi-cumi)</option>
                    <option value="Cephalopoda Semi Kering">{{ old('jenis_produk') == 'Cephalopoda Semi Kering' ? 'selected' : '' }}Cephalopoda Semi Kering</option>
                    <option value="Chitin Chitosan">{{ old('jenis_produk') == 'Chitin Chitosan' ? 'selected' : '' }}Chitin Chitosan</option>
                    <option value="Chuka Idako">{{ old('jenis_produk') == 'Chuka Idako' ? 'selected' : '' }}Chuka Idako</option>
                    <option value="Cireng Ikan">{{ old('jenis_produk') == 'Cireng Ikan' ? 'selected' : '' }}Cireng Ikan</option>
                    <option value="Cumi Krispi">{{ old('jenis_produk') == 'Cumi Krispi' ? 'selected' : '' }}Cumi Krispi</option>
                    <option value="Cumi Panggang">{{ old('jenis_produk') == 'Cumi Panggang' ? 'selected' : '' }}Cumi Panggang</option>
                    <option value="Cumi-cumi asin">{{ old('jenis_produk') == 'Cumi-cumi asin' ? 'selected' : '' }}Cumi-cumi asin</option>
                    <option value="Cumi-Cumi Beku">{{ old('jenis_produk') == 'Cumi-Cumi Beku' ? 'selected' : '' }}Cumi-Cumi Beku</option>
                    <option value="Cumi-cumi Kering">{{ old('jenis_produk') == 'Cumi-cumi Kering' ? 'selected' : '' }}Cumi-cumi Kering</option>
                    <option value="Daging Hiu Kering (Hiu)">{{ old('jenis_produk') == 'Daging Hiu Kering (Hiu)' ? 'selected' : '' }}Daging Hiu Kering (Hiu)</option>
                    <option value="Daging Kepiting Beku">{{ old('jenis_produk') == 'Daging Kepiting Beku' ? 'selected' : '' }}Daging Kepiting Beku</option>
                    <option value="Daging Kepiting Sterilisasi">{{ old('jenis_produk') == 'Daging Kepiting Sterilisasi' ? 'selected' : '' }}Daging Kepiting Sterilisasi</option>
                    <option value="Daging Kerang Beku">{{ old('jenis_produk') == 'Daging Kerang Beku' ? 'selected' : '' }}Daging Kerang Beku</option>
                    <option value="Daging Rajungan Beku">{{ old('jenis_produk') == 'Daging Rajungan Beku' ? 'selected' : '' }}Daging Rajungan Beku</option>
                    <option value="Daging Rajungan Pasteurisasi">{{ old('jenis_produk') == 'Daging Rajungan Pasteurisasi' ? 'selected' : '' }}Daging Rajungan Pasteurisasi</option>
                    <option value="Daging Rajungan Pasteurisasi Beku">{{ old('jenis_produk') == 'Daging Rajungan Pasteurisasi Beku' ? 'selected' : '' }}Daging Rajungan Pasteurisasi Beku</option>
                    <option value="Daging Rajungan Pasteurisasi Kaleng">{{ old('jenis_produk') == 'Daging Rajungan Pasteurisasi Kaleng' ? 'selected' : '' }}Daging Rajungan Pasteurisasi Kaleng</option>
                    <option value="Daging Rajungan Rebus Dingin">{{ old('jenis_produk') == 'Daging Rajungan Rebus Dingin' ? 'selected' : '' }}Daging Rajungan Rebus Dingin</option>
                    <option value="Daging Rajungan Sterilisasi Kaleng">{{ old('jenis_produk') == 'Daging Rajungan Sterilisasi Kaleng' ? 'selected' : '' }}Daging Rajungan Sterilisasi Kaleng</option>
                    <option value="Daging Tuna Beku">{{ old('jenis_produk') == 'Daging Tuna Beku' ? 'selected' : '' }}Daging Tuna Beku</option>
                    <option value="Daging Udang Kipas Beku">{{ old('jenis_produk') == 'Daging Udang Kipas Beku' ? 'selected' : '' }}Daging Udang Kipas Beku</option>
                    <option value="Daging Udang Sterilisasi Kaleng">{{ old('jenis_produk') == 'Daging Udang Sterilisasi Kaleng' ? 'selected' : '' }}Daging Udang Sterilisasi Kaleng</option>
                    <option value="Dendeng Belut">{{ old('jenis_produk') == 'Dendeng Belut' ? 'selected' : '' }}Dendeng Belut</option>
                    <option value="Dimsum Ikan Rumput Laut">{{ old('jenis_produk') == 'Dimsum Ikan Rumput Laut' ? 'selected' : '' }}Dimsum Ikan Rumput Laut</option>
                    <option value="Dimsum Ikan, Dimsum Udang (Baby Tuna, Tongkol, Udang, Tenggiri)">{{ old('jenis_produk') == 'Dimsum Ikan, Dimsum Udang (Baby Tuna, Tongkol, Udang, Tenggiri)' ? 'selected' : '' }}Dimsum Ikan, Dimsum Udang (Baby Tuna, Tongkol, Udang, Tenggiri)</option>
                    <option value="Egg Roll Ikan">{{ old('jenis_produk') == 'Egg Roll Ikan' ? 'selected' : '' }}Egg Roll Ikan</option>
                    <option value="Ekstrak Ikan">{{ old('jenis_produk') == 'Ekstrak Ikan' ? 'selected' : '' }}Ekstrak Ikan</option>
                    <option value="Ekstrak Krill">{{ old('jenis_produk') == 'Ekstrak Krill' ? 'selected' : '' }}Ekstrak Krill</option>
                    <option value="Ekstrak Minuman Rumput Laut Jahe">{{ old('jenis_produk') == 'Ekstrak Minuman Rumput Laut Jahe' ? 'selected' : '' }}Ekstrak Minuman Rumput Laut Jahe</option>
                    <option value="Ekstrak Udang">{{ old('jenis_produk') == 'Ekstrak Udang' ? 'selected' : '' }}Ekstrak Udang</option>
                    <option value="Fillet Hiu Beku">{{ old('jenis_produk') == 'Fillet Hiu Beku' ? 'selected' : '' }}Fillet Hiu Beku</option>
                    <option value="Fillet Ikan Beku">{{ old('jenis_produk') == 'Fillet Ikan Beku' ? 'selected' : '' }}Fillet Ikan Beku</option>
                    <option value="Fillet Ikan Demersal Beku (Anggoli, Kerapu, Jenaha, Kakap Merah, Kakap)">{{ old('jenis_produk') == 'Fillet Ikan Demersal Beku (Anggoli, Kerapu, Jenaha, Kakap Merah, Kakap)' ? 'selected' : '' }}Fillet Ikan Demersal Beku (Anggoli, Kerapu, Jenaha, Kakap Merah, Kakap)</option>
                    <option value="Fillet Ikan Segar">{{ old('jenis_produk') == 'Fillet Ikan Segar' ? 'selected' : '' }}Fillet Ikan Segar</option>
                    <option value="Fillet Nila Beku">{{ old('jenis_produk') == 'Fillet Nila Beku' ? 'selected' : '' }}Fillet Nila Beku</option>
                    <option value="Fillet Patin Beku">{{ old('jenis_produk') == 'Fillet Patin Beku' ? 'selected' : '' }}Fillet Patin Beku</option>
                    <option value="Fillet Salmon Beku">{{ old('jenis_produk') == 'Fillet Salmon Beku' ? 'selected' : '' }}Fillet Salmon Beku</option>
                    <option value="Fillet Salmon Segar">{{ old('jenis_produk') == 'Fillet Salmon Segar' ? 'selected' : '' }}Fillet Salmon Segar</option>
                    <option value="Fillet Sidat Beku">{{ old('jenis_produk') == 'Fillet Sidat Beku' ? 'selected' : '' }}Fillet Sidat Beku</option>
                    <option value="Gelatin Ikan">{{ old('jenis_produk') == 'Gelatin Ikan' ? 'selected' : '' }}Gelatin Ikan</option>
                    <option value="Gelembung Ikan Kering">{{ old('jenis_produk') == 'Gelembung Ikan Kering' ? 'selected' : '' }}Gelembung Ikan Kering</option>
                    <option value="Gurame Bumbu Kuning">{{ old('jenis_produk') == 'Gurame Bumbu Kuning' ? 'selected' : '' }}Gurame Bumbu Kuning</option>
                    <option value="Gurita Rebus Beku">{{ old('jenis_produk') == 'Gurita Rebus Beku' ? 'selected' : '' }}Gurita Rebus Beku</option>
                    <option value="Hati Ikan Beku">{{ old('jenis_produk') == 'Hati Ikan Beku' ? 'selected' : '' }}Hati Ikan Beku</option>
                    <option value="Hati Ikan Segar">{{ old('jenis_produk') == 'Hati Ikan Segar' ? 'selected' : '' }}Hati Ikan Segar</option>
                    <option value="Hidrolisat Ikan">{{ old('jenis_produk') == 'Hidrolisat Ikan' ? 'selected' : '' }}Hidrolisat Ikan</option>
                    <option value="Hidrolisat Protein Ikan">{{ old('jenis_produk') == 'Hidrolisat Protein Ikan' ? 'selected' : '' }}Hidrolisat Protein Ikan</option>
                    <option value="Hiu Beku">{{ old('jenis_produk') == 'Hiu Beku' ? 'selected' : '' }}Hiu Beku</option>
                    <option value="Ikan Air Tawar Beku (Gurami, Patin, Nila)">{{ old('jenis_produk') == 'Ikan Air Tawar Beku (Gurami, Patin, Nila)' ? 'selected' : '' }}Ikan Air Tawar Beku (Gurami, Patin, Nila)</option>
                    <option value="Ikan Air Tawar Bumbu Kuning (Lele)">{{ old('jenis_produk') == 'Ikan Air Tawar Bumbu Kuning (Lele)' ? 'selected' : '' }}Ikan Air Tawar Bumbu Kuning (Lele)</option>
                    <option value="Ikan Air Tawar Bumbu Marinasi Beku">{{ old('jenis_produk') == 'Ikan Air Tawar Bumbu Marinasi Beku' ? 'selected' : '' }}Ikan Air Tawar Bumbu Marinasi Beku</option>
                    <option value="Ikan Air Tawar Segar (Gurami, Nila)">{{ old('jenis_produk') == 'Ikan Air Tawar Segar (Gurami, Nila)' ? 'selected' : '' }}Ikan Air Tawar Segar (Gurami, Nila)</option>
                    <option value="Ikan Asap">{{ old('jenis_produk') == 'Ikan Asap' ? 'selected' : '' }}Ikan Asap</option>
                    <option value="Ikan Asap Beku">{{ old('jenis_produk') == 'Ikan Asap Beku' ? 'selected' : '' }}Ikan Asap Beku</option>
                    <option value="Ikan Asin">{{ old('jenis_produk') == 'Ikan Asin' ? 'selected' : '' }}Ikan Asin</option>
                    <option value="Ikan Asin Beku">{{ old('jenis_produk') == 'Ikan Asin Beku' ? 'selected' : '' }}Ikan Asin Beku</option>
                    <option value="Ikan Asin Kering">{{ old('jenis_produk') == 'Ikan Asin Kering' ? 'selected' : '' }}Ikan Asin Kering</option>
                    <option value="Ikan Asin Segar">{{ old('jenis_produk') == 'Ikan Asin Segar' ? 'selected' : '' }}Ikan Asin Segar</option>
                    <option value="Ikan Bandeng Beku">{{ old('jenis_produk') == 'Ikan Bandeng Beku' ? 'selected' : '' }}Ikan Bandeng Beku</option>
                    <option value="Ikan Berlapis Tepung Beku">{{ old('jenis_produk') == 'Ikan Berlapis Tepung Beku' ? 'selected' : '' }}Ikan Berlapis Tepung Beku</option>
                    <option value="Ikan Bumbu Beku">{{ old('jenis_produk') == 'Ikan Bumbu Beku' ? 'selected' : '' }}Ikan Bumbu Beku</option>
                    <option value="Ikan Demersal Beku (Alaska Pollock, Hoki, Pollock)">{{ old('jenis_produk') == 'Ikan Demersal Beku (Alaska Pollock, Hoki, Pollock)' ? 'selected' : '' }}Ikan Demersal Beku (Alaska Pollock, Hoki, Pollock)</option>
                    <option value="Ikan Demersal Segar (Barakuda, Kakap Putih, Kuwe, Kakap Merah)">{{ old('jenis_produk') == 'Ikan Demersal Segar (Barakuda, Kakap Putih, Kuwe, Kakap Merah)' ? 'selected' : '' }}Ikan Demersal Segar (Barakuda, Kakap Putih, Kuwe, Kakap Merah)</option>
                    <option value="Ikan Demersal Utuh Beku">{{ old('jenis_produk') == 'Ikan Demersal Utuh Beku' ? 'selected' : '' }}Ikan Demersal Utuh Beku</option>
                    <option value="Ikan Hasil Budidaya Beku">{{ old('jenis_produk') == 'Ikan Hasil Budidaya Beku' ? 'selected' : '' }}Ikan Hasil Budidaya Beku</option>
                    <option value="Ikan Kaleng">{{ old('jenis_produk') == 'Ikan Kaleng' ? 'selected' : '' }}Ikan Kaleng</option>
                    <option value="Ikan Kering">{{ old('jenis_produk') == 'Ikan Kering' ? 'selected' : '' }}Ikan Kering</option>
                    <option value="Ikan Makerel Masak Beku">{{ old('jenis_produk') == 'Ikan Makerel Masak Beku' ? 'selected' : '' }}Ikan Makerel Masak Beku</option>
                    <option value="Ikan Mas Presto">{{ old('jenis_produk') == 'Ikan Mas Presto' ? 'selected' : '' }}Ikan Mas Presto</option>
                    <option value="Ikan Nike Beku">{{ old('jenis_produk') == 'Ikan Nike Beku' ? 'selected' : '' }}Ikan Nike Beku</option>
                    <option value="Ikan Pelagis Beku (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)">{{ old('jenis_produk') == 'Ikan Pelagis Beku (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)' ? 'selected' : '' }}Ikan Pelagis Beku (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)</option>
                    <option value="Ikan Pelagis Bernilai Tambah Beku">{{ old('jenis_produk') == 'Ikan Pelagis Bernilai Tambah Beku' ? 'selected' : '' }}Ikan Pelagis Bernilai Tambah Beku</option>
                    <option value="Ikan Pelagis Fillet Beku (Lemadang, Gindara, Tenggiri, Pedang)">{{ old('jenis_produk') == 'Ikan Pelagis Fillet Beku (Lemadang, Gindara, Tenggiri, Pedang)' ? 'selected' : '' }}Ikan Pelagis Fillet Beku (Lemadang, Gindara, Tenggiri, Pedang)</option>
                    <option value="Ikan Pelagis Kering Asin (Teri, Lemuru, Kembung, Marlin, Talang-talang, Muroaji, Sarden, Cakalang, Tenggiri)">{{ old('jenis_produk') == 'Ikan Pelagis Kering Asin (Teri, Lemuru, Kembung, Marlin, Talang-talang, Muroaji, Sarden, Cakalang, Tenggiri)' ? 'selected' : '' }}Ikan Pelagis Kering Asin (Teri, Lemuru, Kembung, Marlin, Talang-talang, Muroaji, Sarden, Cakalang, Tenggiri)</option>
                    <option value="Ikan Pelagis Rebus Beku">{{ old('jenis_produk') == 'Ikan Pelagis Rebus Beku' ? 'selected' : '' }}Ikan Pelagis Rebus Beku</option>
                    <option value="Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)">{{ old('jenis_produk') == 'Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)' ? 'selected' : '' }}Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel Pasifik, Saba Mackerel, Salmon, Trout, Ekor Kuning)</option>
                    <option value="Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel, Makerel Pasifik, Saba Mackerel, Ekor Kuning)">{{ old('jenis_produk') == 'Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel, Makerel Pasifik, Saba Mackerel, Ekor Kuning)' ? 'selected' : '' }}Ikan Pelagis Segar (Amberjack, Makerel Atlantik, Hamachi, Makerel, Makerel Pasifik, Saba Mackerel, Ekor Kuning)</option>
                    <option value="Ikan Pindang">{{ old('jenis_produk') == 'Ikan Pindang' ? 'selected' : '' }}Ikan Pindang</option>
                    <option value="Ikan Renyah">{{ old('jenis_produk') == 'Ikan Renyah' ? 'selected' : '' }}Ikan Renyah</option>
                    <option value="Ikan Scombroid Beku">{{ old('jenis_produk') == 'Ikan Scombroid Beku' ? 'selected' : '' }}Ikan Scombroid Beku</option>
                    <option value="Ikan Teri Nasi">{{ old('jenis_produk') == 'Ikan Teri Nasi' ? 'selected' : '' }}Ikan Teri Nasi</option>
                    <option value="Ikan Trout Beku">{{ old('jenis_produk') == 'Ikan Trout Beku' ? 'selected' : '' }}Ikan Trout Beku</option>
                    <option value="Jambal Roti">{{ old('jenis_produk') == 'Jambal Roti' ? 'selected' : '' }}Jambal Roti</option>
                    <option value="Kakap Beku">{{ old('jenis_produk') == 'Kakap Beku' ? 'selected' : '' }}Kakap Beku</option>
                    <option value="Kebab Ikan">{{ old('jenis_produk') == 'Kebab Ikan' ? 'selected' : '' }}Kebab Ikan</option>
                    <option value="Kekerangan Sterilisasi Dalam Kaleng">{{ old('jenis_produk') == 'Kekerangan Sterilisasi Dalam Kaleng' ? 'selected' : '' }}Kekerangan Sterilisasi Dalam Kaleng</option>
                    <option value="Kentang Ebi Goreng">{{ old('jenis_produk') == 'Kentang Ebi Goreng' ? 'selected' : '' }}Kentang Ebi Goreng</option>
                    <option value="Kentang Teri">{{ old('jenis_produk') == 'Kentang Teri' ? 'selected' : '' }}Kentang Teri</option>
                    <option value="Keong Beku">{{ old('jenis_produk') == 'Keong Beku' ? 'selected' : '' }}Keong Beku</option>
                    <option value="Kepiting Beku">{{ old('jenis_produk') == 'Kepiting Beku' ? 'selected' : '' }}Kepiting Beku</option>
                    <option value="Kepiting Bernilai Tambah Beku">{{ old('jenis_produk') == 'Kepiting Bernilai Tambah Beku' ? 'selected' : '' }}Kepiting Bernilai Tambah Beku</option>
                    <option value="Kepiting Krispi">{{ old('jenis_produk') == 'Kepiting Krispi' ? 'selected' : '' }}Kepiting Krispi</option>
                    <option value="Kepiting Lunak Beku">{{ old('jenis_produk') == 'Kepiting Lunak Beku' ? 'selected' : '' }}Kepiting Lunak Beku</option>
                    <option value="Kepiting Segar">{{ old('jenis_produk') == 'Kepiting Segar' ? 'selected' : '' }}Kepiting Segar</option>
                    <option value="Kerang Beku">{{ old('jenis_produk') == 'Kerang Beku' ? 'selected' : '' }}Kerang Beku</option>
                    <option value="Kerang Bernilai Tambah Beku">{{ old('jenis_produk') == 'Kerang Bernilai Tambah Beku' ? 'selected' : '' }}Kerang Bernilai Tambah Beku</option>
                    <option value="Kerang Segar">{{ old('jenis_produk') == 'Kerang Segar' ? 'selected' : '' }}Kerang Segar</option>
                    <option value="Keripik Bakso Goreng Ikan">{{ old('jenis_produk') == 'Keripik Bakso Goreng Ikan' ? 'selected' : '' }}Keripik Bakso Goreng Ikan</option>
                    <option value="Keripik Basreng">{{ old('jenis_produk') == 'Keripik Basreng' ? 'selected' : '' }}Keripik Basreng</option>
                    <option value="Keripik Ikan">{{ old('jenis_produk') == 'Keripik Ikan' ? 'selected' : '' }}Keripik Ikan</option>
                    <option value="Keripik Kulit Ikan">{{ old('jenis_produk') == 'Keripik Kulit Ikan' ? 'selected' : '' }}Keripik Kulit Ikan</option>
                    <option value="Keripik Udang Rebon">{{ old('jenis_produk') == 'Keripik Udang Rebon' ? 'selected' : '' }}Keripik Udang Rebon</option>
                    <option value="Kerupuk Cumi">{{ old('jenis_produk') == 'Kerupuk Cumi' ? 'selected' : '' }}Kerupuk Cumi</option>
                    <option value="Kerupuk Ikan">{{ old('jenis_produk') == 'Kerupuk Ikan' ? 'selected' : '' }}Kerupuk Ikan</option>
                    <option value="Kerupuk Ikan Goreng">{{ old('jenis_produk') == 'Kerupuk Ikan Goreng' ? 'selected' : '' }}Kerupuk Ikan Goreng</option>
                    <option value="Kerupuk Ikan Rumput Laut">{{ old('jenis_produk') == 'Kerupuk Ikan Rumput Laut' ? 'selected' : '' }}Kerupuk Ikan Rumput Laut</option>
                    <option value="Kerupuk Ikan Tenggiri">{{ old('jenis_produk') == 'Kerupuk Ikan Tenggiri' ? 'selected' : '' }}Kerupuk Ikan Tenggiri</option>
                    <option value="Kerupuk Ikan, Kerupuk Udang">{{ old('jenis_produk') == 'Kerupuk Ikan, Kerupuk Udang' ? 'selected' : '' }}Kerupuk Ikan, Kerupuk Udang</option>
                    <option value="Kerupuk Kepiting">{{ old('jenis_produk') == 'Kerupuk Kepiting' ? 'selected' : '' }}Kerupuk Kepiting</option>
                    <option value="Kerupuk Kulit Ikan">{{ old('jenis_produk') == 'Kerupuk Kulit Ikan' ? 'selected' : '' }}Kerupuk Kulit Ikan</option>
                    <option value="Kerupuk Rajungan">{{ old('jenis_produk') == 'Kerupuk Rajungan' ? 'selected' : '' }}Kerupuk Rajungan</option>
                    <option value="Kerupuk Rumput Laut">{{ old('jenis_produk') == 'Kerupuk Rumput Laut' ? 'selected' : '' }}Kerupuk Rumput Laut</option>
                    <option value="Kerupuk Tulang Ikan">{{ old('jenis_produk') == 'Kerupuk Tulang Ikan' ? 'selected' : '' }}Kerupuk Tulang Ikan</option>
                    <option value="Kerupuk Udang">{{ old('jenis_produk') == 'Kerupuk Udang' ? 'selected' : '' }}Kerupuk Udang</option>
                    <option value="Kolagen Ikan">{{ old('jenis_produk') == 'Kolagen Ikan' ? 'selected' : '' }}Kolagen Ikan</option>
                    <option value="Konsentrat Ikan">{{ old('jenis_produk') == 'Konsentrat Ikan' ? 'selected' : '' }}Konsentrat Ikan</option>
                    <option value="Krispi Ikan">{{ old('jenis_produk') == 'Krispi Ikan' ? 'selected' : '' }}Krispi Ikan</option>
                    <option value="Krispi Kulit Ikan">{{ old('jenis_produk') == 'Krispi Kulit Ikan' ? 'selected' : '' }}Krispi Kulit Ikan</option>
                    <option value="Krispi Rumput Laut">{{ old('jenis_produk') == 'Krispi Rumput Laut' ? 'selected' : '' }}Krispi Rumput Laut</option>
                    <option value="Kue Ikan">{{ old('jenis_produk') == 'Kue Ikan' ? 'selected' : '' }}Kue Ikan</option>
                    <option value="Kukis Ikan">{{ old('jenis_produk') == 'Kukis Ikan' ? 'selected' : '' }}Kukis Ikan</option>
                    <option value="Kukis Udang Rebon">{{ old('jenis_produk') == 'Kukis Udang Rebon' ? 'selected' : '' }}Kukis Udang Rebon</option>
                    <option value="Kulit Ikan Hiu, Kulit Ikan Pari">{{ old('jenis_produk') == 'Kulit Ikan Hiu, Kulit Ikan Pari' ? 'selected' : '' }}Kulit Ikan Hiu, Kulit Ikan Pari</option>
                    <option value="Lele Asap">{{ old('jenis_produk') == 'Lele Asap' ? 'selected' : '' }}Lele Asap</option>
                    <option value="Lele Asap Bumbu Kuning">{{ old('jenis_produk') == 'Lele Asap Bumbu Kuning' ? 'selected' : '' }}Lele Asap Bumbu Kuning</option>
                    <option value="Lele Beku">{{ old('jenis_produk') == 'Lele Beku' ? 'selected' : '' }}Lele Beku</option>
                    <option value="Lele Bumbu Beku">{{ old('jenis_produk') == 'Lele Bumbu Beku' ? 'selected' : '' }}Lele Bumbu Beku</option>
                    <option value="Lele Bumbu Kuning">{{ old('jenis_produk') == 'Lele Bumbu Kuning' ? 'selected' : '' }}Lele Bumbu Kuning</option>
                    <option value="Lele Krispi">{{ old('jenis_produk') == 'Lele Krispi' ? 'selected' : '' }}Lele Krispi</option>
                    <option value="Lobster Beku">{{ old('jenis_produk') == 'Lobster Beku' ? 'selected' : '' }}Lobster Beku</option>
                    <option value="Lobster Segar">{{ old('jenis_produk') == 'Lobster Segar' ? 'selected' : '' }}Lobster Segar</option>
                    <option value="Makarel Beku">{{ old('jenis_produk') == 'Makarel Beku' ? 'selected' : '' }}Makarel Beku</option>
                    <option value="Makerel dalam Kaleng">{{ old('jenis_produk') == 'Makerel dalam Kaleng' ? 'selected' : '' }}Makerel dalam Kaleng</option>
                    <option value="Mie Rumput Laut">{{ old('jenis_produk') == 'Mie Rumput Laut' ? 'selected' : '' }}Mie Rumput Laut</option>
                    <option value="Minyak Hati Cod">{{ old('jenis_produk') == 'Minyak Hati Cod' ? 'selected' : '' }}Minyak Hati Cod</option>
                    <option value="Minyak Ikan">{{ old('jenis_produk') == 'Minyak Ikan' ? 'selected' : '' }}Minyak Ikan</option>
                    <option value="Minyak Ikan (Mata Tuna dan Cakalang)">{{ old('jenis_produk') == 'Minyak Ikan (Mata Tuna dan Cakalang)' ? 'selected' : '' }}Minyak Ikan (Mata Tuna dan Cakalang)</option>
                    <option value="Minyak Ikan Tuna Mentah">{{ old('jenis_produk') == 'Minyak Ikan Tuna Mentah' ? 'selected' : '' }}Minyak Ikan Tuna Mentah</option>
                    <option value="Minyak Krill">{{ old('jenis_produk') == 'Minyak Krill' ? 'selected' : '' }}Minyak Krill</option>
                    <option value="Minyak Salmon">{{ old('jenis_produk') == 'Minyak Salmon' ? 'selected' : '' }}Minyak Salmon</option>
                    <option value="Nila Bernilai Tambah Beku">{{ old('jenis_produk') == 'Nila Bernilai Tambah Beku' ? 'selected' : '' }}Nila Bernilai Tambah Beku</option>
                    <option value="Nila Krispi">{{ old('jenis_produk') == 'Nila Krispi' ? 'selected' : '' }}Nila Krispi</option>
                    <option value="Nori">{{ old('jenis_produk') == 'Nori' ? 'selected' : '' }}Nori</option>
                    <option value="Nori Bubuk">{{ old('jenis_produk') == 'Nori Bubuk' ? 'selected' : '' }}Nori Bubuk</option>
                    <option value="Nori Goreng">{{ old('jenis_produk') == 'Nori Goreng' ? 'selected' : '' }}Nori Goreng</option>
                    <option value="Nori Kering">{{ old('jenis_produk') == 'Nori Kering' ? 'selected' : '' }}Nori Kering</option>
                    <option value="Nori Panggang">{{ old('jenis_produk') == 'Nori Panggang' ? 'selected' : '' }}Nori Panggang</option>
                    <option value="Nugget Ikan">{{ old('jenis_produk') == 'Nugget Ikan' ? 'selected' : '' }}Nugget Ikan</option>
                    <option value="Omega-3 Acid Ethyl Ester 90 Oil">{{ old('jenis_produk') == 'Omega-3 Acid Ethyl Ester 90 Oil' ? 'selected' : '' }}Omega-3 Acid Ethyl Ester 90 Oil</option>
                    <option value="Otak-Otak Bandeng">{{ old('jenis_produk') == 'Otak-Otak Bandeng' ? 'selected' : '' }}Otak-Otak Bandeng</option>
                    <option value="Otak-Otak Ikan">{{ old('jenis_produk') == 'Otak-Otak Ikan' ? 'selected' : '' }}Otak-Otak Ikan</option>
                    <option value="Oyster Beku">{{ old('jenis_produk') == 'Oyster Beku' ? 'selected' : '' }}Oyster Beku</option>
                    <option value="Oyster Segar">{{ old('jenis_produk') == 'Oyster Segar' ? 'selected' : '' }}Oyster Segar</option>
                    <option value="Paha Kodok Beku">{{ old('jenis_produk') == 'Paha Kodok Beku' ? 'selected' : '' }}Paha Kodok Beku</option>
                    <option value="Pari Asin Kering">{{ old('jenis_produk') == 'Pari Asin Kering' ? 'selected' : '' }}Pari Asin Kering</option>
                    <option value="Pari Beku">{{ old('jenis_produk') == 'Pari Beku' ? 'selected' : '' }}Pari Beku</option>
                    <option value="Pari Kering">{{ old('jenis_produk') == 'Pari Kering' ? 'selected' : '' }}Pari Kering</option>
                    <option value="Patin Beku">{{ old('jenis_produk') == 'Patin Beku' ? 'selected' : '' }}Patin Beku</option>
                    <option value="Pempek Ikan">{{ old('jenis_produk') == 'Pempek Ikan' ? 'selected' : '' }}Pempek Ikan</option>
                    <option value="Pempek Kriuk">{{ old('jenis_produk') == 'Pempek Kriuk' ? 'selected' : '' }}Pempek Kriuk</option>
                    <option value="Pepes Ikan">{{ old('jenis_produk') == 'Pepes Ikan' ? 'selected' : '' }}Pepes Ikan</option>
                    <option value="Perut Ikan Beku">{{ old('jenis_produk') == 'Perut Ikan Beku' ? 'selected' : '' }}Perut Ikan Beku</option>
                    <option value="Petis Udang">{{ old('jenis_produk') == 'Petis Udang' ? 'selected' : '' }}Petis Udang</option>
                    <option value="Peyek Rebon">{{ old('jenis_produk') == 'Peyek Rebon' ? 'selected' : '' }}Peyek Rebon</option>
                    <option value="Pilus Ikan">{{ old('jenis_produk') == 'Pilus Ikan' ? 'selected' : '' }}Pilus Ikan</option>
                    <option value="Pindang Ikan">{{ old('jenis_produk') == 'Pindang Ikan' ? 'selected' : '' }}Pindang Ikan</option>
                    <option value="Pindang Patin">{{ old('jenis_produk') == 'Pindang Patin' ? 'selected' : '' }}Pindang Patin</option>
                    <option value="Produk Perikanan Bernilai Tambah Beku">{{ old('jenis_produk') == 'Produk Perikanan Bernilai Tambah Beku' ? 'selected' : '' }}Produk Perikanan Bernilai Tambah Beku</option>
                    <option value="Produk Salmon Bernilai Tambah Beku">{{ old('jenis_produk') == 'Produk Salmon Bernilai Tambah Beku' ? 'selected' : '' }}Produk Salmon Bernilai Tambah Beku</option>
                    <option value="Rajungan Beku">{{ old('jenis_produk') == 'Rajungan Beku' ? 'selected' : '' }}Rajungan Beku</option>
                    <option value="Rajungan Krispi">{{ old('jenis_produk') == 'Rajungan Krispi' ? 'selected' : '' }}Rajungan Krispi</option>
                    <option value="Rajungan Segar">{{ old('jenis_produk') == 'Rajungan Segar' ? 'selected' : '' }}Rajungan Segar</option>
                    <option value="Rendang Ikan">{{ old('jenis_produk') == 'Rendang Ikan' ? 'selected' : '' }}Rendang Ikan</option>
                    <option value="Rendang Tuna">{{ old('jenis_produk') == 'Rendang Tuna' ? 'selected' : '' }}Rendang Tuna</option>
                    <option value="Rengginang Ikan">{{ old('jenis_produk') == 'Rengginang Ikan' ? 'selected' : '' }}Rengginang Ikan</option>
                    <option value="Risol Ikan">{{ old('jenis_produk') == 'Risol Ikan' ? 'selected' : '' }}Risol Ikan</option>
                    <option value="Risol Tuna">{{ old('jenis_produk') == 'Risol Tuna' ? 'selected' : '' }}Risol Tuna</option>
                    <option value="Roti Ikan">{{ old('jenis_produk') == 'Roti Ikan' ? 'selected' : '' }}Roti Ikan</option>
                    <option value="Rumput Laut Beku">{{ old('jenis_produk') == 'Rumput Laut Beku' ? 'selected' : '' }}Rumput Laut Beku</option>
                    <option value="Rumput Laut Kering">{{ old('jenis_produk') == 'Rumput Laut Kering' ? 'selected' : '' }}Rumput Laut Kering</option>
                    <option value="Rumput Laut Panggang">{{ old('jenis_produk') == 'Rumput Laut Panggang' ? 'selected' : '' }}Rumput Laut Panggang</option>
                    <option value="Rumput Laut Segar">{{ old('jenis_produk') == 'Rumput Laut Segar' ? 'selected' : '' }}Rumput Laut Segar</option>
                    <option value="Salmon Asap Beku, Trout Asap Beku">{{ old('jenis_produk') == 'Salmon Asap Beku, Trout Asap Beku' ? 'selected' : '' }}Salmon Asap Beku, Trout Asap Beku</option>
                    <option value="Salmon Beku">{{ old('jenis_produk') == 'Salmon Beku' ? 'selected' : '' }}Salmon Beku</option>
                    <option value="Salmon Beku, Trout Beku">{{ old('jenis_produk') == 'Salmon Beku, Trout Beku' ? 'selected' : '' }}Salmon Beku, Trout Beku</option>
                    <option value="Salmon Segar">{{ old('jenis_produk') == 'Salmon Segar' ? 'selected' : '' }}Salmon Segar</option>
                    <option value="Salmon Segar, Trout Segar">{{ old('jenis_produk') == 'Salmon Segar, Trout Segar' ? 'selected' : '' }}Salmon Segar, Trout Segar</option>
                    <option value="Sambal Cumi">{{ old('jenis_produk') == 'Sambal Cumi' ? 'selected' : '' }}Sambal Cumi</option>
                    <option value="Sambal Ikan">{{ old('jenis_produk') == 'Sambal Ikan' ? 'selected' : '' }}Sambal Ikan</option>
                    <option value="Sambal Ikan Asin">{{ old('jenis_produk') == 'Sambal Ikan Asin' ? 'selected' : '' }}Sambal Ikan Asin</option>
                    <option value="Sambal Ikan Cakalang">{{ old('jenis_produk') == 'Sambal Ikan Cakalang' ? 'selected' : '' }}Sambal Ikan Cakalang</option>
                    <option value="Sambal Ikan Cakalang Asap">{{ old('jenis_produk') == 'Sambal Ikan Cakalang Asap' ? 'selected' : '' }}Sambal Ikan Cakalang Asap</option>
                    <option value="Sambal Pasta Udang">{{ old('jenis_produk') == 'Sambal Pasta Udang' ? 'selected' : '' }}Sambal Pasta Udang</option>
                    <option value="Sambal Roa">{{ old('jenis_produk') == 'Sambal Roa' ? 'selected' : '' }}Sambal Roa</option>
                    <option value="Sambal Serundeng Ikan Cakalang">{{ old('jenis_produk') == 'Sambal Serundeng Ikan Cakalang' ? 'selected' : '' }}Sambal Serundeng Ikan Cakalang</option>
                    <option value="Sambal Terasi Udang">{{ old('jenis_produk') == 'Sambal Terasi Udang' ? 'selected' : '' }}Sambal Terasi Udang</option>
                    <option value="Sambal Teri">{{ old('jenis_produk') == 'Sambal Teri' ? 'selected' : '' }}Sambal Teri</option>
                    <option value="Sambal Udang">{{ old('jenis_produk') == 'Sambal Udang' ? 'selected' : '' }}Sambal Udang</option>
                    <option value="Sarden Kaleng, Makerel Kaleng">{{ old('jenis_produk') == 'Sarden Kaleng, Makerel Kaleng' ? 'selected' : '' }}Sarden Kaleng, Makerel Kaleng</option>
                    <option value="Sate Bandeng">{{ old('jenis_produk') == 'Sate Bandeng' ? 'selected' : '' }}Sate Bandeng</option>
                    <option value="Saus Tiram">{{ old('jenis_produk') == 'Saus Tiram' ? 'selected' : '' }}Saus Tiram</option>
                    <option value="Scallop Beku">{{ old('jenis_produk') == 'Scallop Beku' ? 'selected' : '' }}Scallop Beku</option>
                    <option value="Scallop Segar">{{ old('jenis_produk') == 'Scallop Segar' ? 'selected' : '' }}Scallop Segar</option>
                    <option value="Seaweed Flakes / Powder">{{ old('jenis_produk') == 'Seaweed Flakes / Powder' ? 'selected' : '' }}Seaweed Flakes / Powder</option>
                    <option value="Semi Refined Carrageenan">{{ old('jenis_produk') == 'Semi Refined Carrageenan' ? 'selected' : '' }}Semi Refined Carrageenan</option>
                    <option value="Serundeng Ikan Tuna">{{ old('jenis_produk') == 'Serundeng Ikan Tuna' ? 'selected' : '' }}Serundeng Ikan Tuna</option>
                    <option value="Sidat Beku">{{ old('jenis_produk') == 'Sidat Beku' ? 'selected' : '' }}Sidat Beku</option>
                    <option value="Sidat Panggang Beku Berbumbu">{{ old('jenis_produk') == 'Sidat Panggang Beku Berbumbu' ? 'selected' : '' }}Sidat Panggang Beku Berbumbu</option>
                    <option value="Siomay Ikan">{{ old('jenis_produk') == 'Siomay Ikan' ? 'selected' : '' }}Siomay Ikan</option>
                    <option value="Siput Beku">{{ old('jenis_produk') == 'Siput Beku' ? 'selected' : '' }}Siput Beku</option>
                    <option value="Siput Gonggong Beku">{{ old('jenis_produk') == 'Siput Gonggong Beku' ? 'selected' : '' }}Siput Gonggong Beku</option>
                    <option value="Siput Segar (Siput)">{{ old('jenis_produk') == 'Siput Segar (Siput)' ? 'selected' : '' }}Siput Segar (Siput)</option>
                    <option value="Sirip Hiu Kering, Kulit Hiu Kering, Tulang Hiu Kering">{{ old('jenis_produk') == 'Sirip Hiu Kering, Kulit Hiu Kering, Tulang Hiu Kering' ? 'selected' : '' }}Sirip Hiu Kering, Kulit Hiu Kering, Tulang Hiu Kering</option>
                    <option value="Sirip Pari Kering, Kulit Pari Kering, Tulang Pari Kering">{{ old('jenis_produk') == 'Sirip Pari Kering, Kulit Pari Kering, Tulang Pari Kering' ? 'selected' : '' }}Sirip Pari Kering, Kulit Pari Kering, Tulang Pari Kering</option>
                    <option value="Snack Ikan">{{ old('jenis_produk') == 'Snack Ikan' ? 'selected' : '' }}Snack Ikan</option>
                    <option value="Snack Rumput Laut">{{ old('jenis_produk') == 'Snack Rumput Laut' ? 'selected' : '' }}Snack Rumput Laut</option>
                    <option value="Steak Ikan Beku">{{ old('jenis_produk') == 'Steak Ikan Beku' ? 'selected' : '' }}Steak Ikan Beku</option>
                    <option value="Stik Ikan">{{ old('jenis_produk') == 'Stik Ikan' ? 'selected' : '' }}Stik Ikan</option>
                    <option value="Stik Kepiting Analog Beku">{{ old('jenis_produk') == 'Stik Kepiting Analog Beku' ? 'selected' : '' }}Stik Kepiting Analog Beku</option>
                    <option value="Stik Lele">{{ old('jenis_produk') == 'Stik Lele' ? 'selected' : '' }}Stik Lele</option>
                    <option value="Stik Tulang Ikan">{{ old('jenis_produk') == 'Stik Tulang Ikan' ? 'selected' : '' }}Stik Tulang Ikan</option>
                    <option value="Stik Udang">{{ old('jenis_produk') == 'Stik Udang' ? 'selected' : '' }}Stik Udang</option>
                    <option value="Sumpia Udang">{{ old('jenis_produk') == 'Sumpia Udang' ? 'selected' : '' }}Sumpia Udang</option>
                    <option value="Surimi Beku">{{ old('jenis_produk') == 'Surimi Beku' ? 'selected' : '' }}Surimi Beku</option>
                    <option value="Surimi Bumbu Beku">{{ old('jenis_produk') == 'Surimi Bumbu Beku' ? 'selected' : '' }}Surimi Bumbu Beku</option>
                    <option value="Sushi Ikan">{{ old('jenis_produk') == 'Sushi Ikan' ? 'selected' : '' }}Sushi Ikan</option>
                    <option value="Sushi Nori">{{ old('jenis_produk') == 'Sushi Nori' ? 'selected' : '' }}Sushi Nori</option>
                    <option value="Susu Rumput Laut">{{ old('jenis_produk') == 'Susu Rumput Laut' ? 'selected' : '' }}Susu Rumput Laut</option>
                    <option value="Tahu Bakso Ikan">{{ old('jenis_produk') == 'Tahu Bakso Ikan' ? 'selected' : '' }}Tahu Bakso Ikan</option>
                    <option value="Takoyaki Beku">{{ old('jenis_produk') == 'Takoyaki Beku' ? 'selected' : '' }}Takoyaki Beku</option>
                    <option value="Tekwan">{{ old('jenis_produk') == 'Tekwan' ? 'selected' : '' }}Tekwan</option>
                    <option value="Telur Bulu Babi Beku">{{ old('jenis_produk') == 'Telur Bulu Babi Beku' ? 'selected' : '' }}Telur Bulu Babi Beku</option>
                    <option value="Telur Bulu Babi Segar">{{ old('jenis_produk') == 'Telur Bulu Babi Segar' ? 'selected' : '' }}Telur Bulu Babi Segar</option>
                    <option value="Telur Ikan Beku">{{ old('jenis_produk') == 'Telur Ikan Beku' ? 'selected' : '' }}Telur Ikan Beku</option>
                    <option value="Telur Ikan Segar">{{ old('jenis_produk') == 'Telur Ikan Segar' ? 'selected' : '' }}Telur Ikan Segar</option>
                    <option value="Telur Ikan Terbang Beku">{{ old('jenis_produk') == 'Telur Ikan Terbang Beku' ? 'selected' : '' }}Telur Ikan Terbang Beku</option>
                    <option value="Telur Ikan Terbang Kering">{{ old('jenis_produk') == 'Telur Ikan Terbang Kering' ? 'selected' : '' }}Telur Ikan Terbang Kering</option>
                    <option value="Tepung Agar-agar">{{ old('jenis_produk') == 'Tepung Agar-agar' ? 'selected' : '' }}Tepung Agar-agar</option>
                    <option value="Tepung Alginat">{{ old('jenis_produk') == 'Tepung Alginat' ? 'selected' : '' }}Tepung Alginat</option>
                    <option value="Tepung Ikan">{{ old('jenis_produk') == 'Tepung Ikan' ? 'selected' : '' }}Tepung Ikan</option>
                    <option value="Tepung Ikan Teri">{{ old('jenis_produk') == 'Tepung Ikan Teri' ? 'selected' : '' }}Tepung Ikan Teri</option>
                    <option value="Tepung Karagenan">{{ old('jenis_produk') == 'Tepung Karagenan' ? 'selected' : '' }}Tepung Karagenan</option>
                    <option value="Tepung Karaginan">{{ old('jenis_produk') == 'Tepung Karaginan' ? 'selected' : '' }}Tepung Karaginan</option>
                    <option value="Tepung Tulang Ikan">{{ old('jenis_produk') == 'Tepung Tulang Ikan' ? 'selected' : '' }}Tepung Tulang Ikan</option>
                    <option value="Tepung Udang">{{ old('jenis_produk') == 'Tepung Udang' ? 'selected' : '' }}Tepung Udang</option>
                    <option value="Terasi Bubuk">{{ old('jenis_produk') == 'Terasi Bubuk' ? 'selected' : '' }}Terasi Bubuk</option>
                    <option value="Terasi Udang">{{ old('jenis_produk') == 'Terasi Udang' ? 'selected' : '' }}Terasi Udang</option>
                    <option value="Teri Asin Kering">{{ old('jenis_produk') == 'Teri Asin Kering' ? 'selected' : '' }}Teri Asin Kering</option>
                    <option value="Teri Goreng Kering">{{ old('jenis_produk') == 'Teri Goreng Kering' ? 'selected' : '' }}Teri Goreng Kering</option>
                    <option value="Teripang Beku">{{ old('jenis_produk') == 'Teripang Beku' ? 'selected' : '' }}Teripang Beku</option>
                    <option value="Teripang Kering">{{ old('jenis_produk') == 'Teripang Kering' ? 'selected' : '' }}Teripang Kering</option>
                    <option value="Teripang Rebus Beku">{{ old('jenis_produk') == 'Teripang Rebus Beku' ? 'selected' : '' }}Teripang Rebus Beku</option>
                    <option value="Teripang Segar">{{ old('jenis_produk') == 'Teripang Segar' ? 'selected' : '' }}Teripang Segar</option>
                    <option value="Tortilla Rumput Laut">{{ old('jenis_produk') == 'Tortilla Rumput Laut' ? 'selected' : '' }}Tortilla Rumput Laut</option>
                    <option value="Tulang Hiu Kering">{{ old('jenis_produk') == 'Tulang Hiu Kering' ? 'selected' : '' }}Tulang Hiu Kering</option>
                    <option value="Tulang Ikan Kering">{{ old('jenis_produk') == 'Tulang Ikan Kering' ? 'selected' : '' }}Tulang Ikan Kering</option>
                    <option value="Tulang Pari Kering">{{ old('jenis_produk') == 'Tulang Pari Kering' ? 'selected' : '' }}Tulang Pari Kering</option>
                    <option value="Tuna Beku">{{ old('jenis_produk') == 'Tuna Beku' ? 'selected' : '' }}Tuna Beku</option>
                    <option value="Tuna Kaleng">{{ old('jenis_produk') == 'Tuna Kaleng' ? 'selected' : '' }}Tuna Kaleng</option>
                    <option value="Tuna Loin Beku">{{ old('jenis_produk') == 'Tuna Loin Beku' ? 'selected' : '' }}Tuna Loin Beku</option>
                    <option value="Tuna Loin Masak Beku">{{ old('jenis_produk') == 'Tuna Loin Masak Beku' ? 'selected' : '' }}Tuna Loin Masak Beku</option>
                    <option value="Tuna Pouch">{{ old('jenis_produk') == 'Tuna Pouch' ? 'selected' : '' }}Tuna Pouch</option>
                    <option value="Tuna Segar">{{ old('jenis_produk') == 'Tuna Segar' ? 'selected' : '' }}Tuna Segar</option>
                    <option value="Ubur-ubur Kering">{{ old('jenis_produk') == 'Ubur-ubur Kering' ? 'selected' : '' }}Ubur-ubur Kering</option>
                    <option value="Udang Beku">{{ old('jenis_produk') == 'Udang Beku' ? 'selected' : '' }}Udang Beku</option>
                    <option value="Udang Berlapis Tepung Beku">{{ old('jenis_produk') == 'Udang Berlapis Tepung Beku' ? 'selected' : '' }}Udang Berlapis Tepung Beku</option>
                    <option value="Udang Kering">{{ old('jenis_produk') == 'Udang Kering' ? 'selected' : '' }}Udang Kering</option>
                    <option value="Udang Kipas Beku">{{ old('jenis_produk') == 'Udang Kipas Beku' ? 'selected' : '' }}Udang Kipas Beku</option>
                    <option value="Udang Krispi">{{ old('jenis_produk') == 'Udang Krispi' ? 'selected' : '' }}Udang Krispi</option>
                    <option value="Udang Kupas Beku">{{ old('jenis_produk') == 'Udang Kupas Beku' ? 'selected' : '' }}Udang Kupas Beku</option>
                    <option value="Udang Masak Beku">{{ old('jenis_produk') == 'Udang Masak Beku' ? 'selected' : '' }}Udang Masak Beku</option>
                    <option value="Udang Mentah Beku">{{ old('jenis_produk') == 'Udang Mentah Beku' ? 'selected' : '' }}Udang Mentah Beku</option>
                    <option value="Udang Rebus Beku">{{ old('jenis_produk') == 'Udang Rebus Beku' ? 'selected' : '' }}Udang Rebus Beku</option>
                    <option value="Udang Segar">{{ old('jenis_produk') == 'Udang Segar' ? 'selected' : '' }}Udang Segar</option>
                    <option value="Wakame Produk">{{ old('jenis_produk') == 'Wakame Produk' ? 'selected' : '' }}Wakame Produk</option>
                    <option value="Yoghurt Rumput Laut">{{ old('jenis_produk') == 'Yoghurt Rumput Laut' ? 'selected' : '' }}Yoghurt Rumput Laut</option>
                    {{-- Tambahkan opsi lain jika ada --}}
                </select>
                @error('jenis_produk')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="volume_produk">Volume Produk (Kg)</label>
                <input type="number" step="0.01" class="form-control @error('volume_produk') is-invalid @enderror" id="volume_produk" name="volume_produk" placeholder="Contoh: 300 (dalam ton per Triwulan)" value="{{ old('volume_produk') }}" required min="0">
                @error('volume_produk')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <div class="form-group">
                <label for="pemasaran">Pemasaran</label>
                <select class="form-control @error('pemasaran') is-invalid @enderror" id="pemasaran" name="pemasaran" required>
                    <option value="">Pilih Pemasaran</option>
                    <option value="Domestik" {{ old('pemasaran') == 'Domestik' ? 'selected' : '' }}>Domestik</option>
                    <option value="Ekspor" {{ old('pemasaran') == 'Ekspor' ? 'selected' : '' }}>Ekspor</option>
                </select>
                @error('pemasaran')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Menambahkan input Tahun --}}
              <div class="form-group">
                <label for="tahun">Tahun</label>
                <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" placeholder="Contoh: 2024" value="{{ old('tahun', date('Y')) }}" required>
                @error('tahun')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>

              {{-- Menambahkan input Triwulan --}}
              <div class="form-group">
                <label for="triwulan">Triwulan</label>
                <select class="form-control @error('triwulan') is-invalid @enderror" id="triwulan" name="triwulan" required>
                  <option value="">Pilih Triwulan</option>
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

      <div class="row">
        <div class="col-12 text-right">
          <button type="submit" class="btn btn-primary">Simpan Data Produk</button>
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
