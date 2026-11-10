@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Edit Data Bahan Baku' }}
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

    <h2 class="section-title">Form Edit Bahan Baku</h2>
    <p class="section-lead">Pastikan data yang Anda masukkan sudah benar sebelum menyimpan perubahan data.</p>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Bahan Baku</h4>
        </div>
        <div class="card-body">
        <div class="section-body">
                <form action="{{ route('bahans.update', $bahan->id) }}" method="POST" data-edit-confirm>
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="jenis_ikan">Jenis bahan baku</label>
                        <select class="form-control @error('jenis_ikan') is-invalid @enderror select2" id="jenis_ikan" name="jenis_ikan" required>
                            <option value="" disabled selected>Pilih Jenis Bahan Baku</option>
                            <option value="Albakora (Thunnus alalunga)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Albakora (Thunnus alalunga)' ? 'selected' : '' }}>Albakora (Thunnus alalunga)</option>
                            <option value="Alu-alu Besar; Barakuda Besar (Sphyraena barracuda)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Alu-alu Besar; Barakuda Besar (Sphyraena barracuda)' ? 'selected' : '' }}>Alu-alu Besar; Barakuda Besar (Sphyraena barracuda)</option>
                            <option value="Alu-alu Obtuse; Barakuda Obtuse (Sphyraena obtusata)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Alu-alu Obtuse; Barakuda Obtuse (Sphyraena obtusata)' ? 'selected' : '' }}>Alu-alu Obtuse; Barakuda Obtuse (Sphyraena obtusata)</option>
                            <option value="Alu-alu Sirip Hitam; Barakuda Sirip Hitam (Sphyraena qenie)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Alu-alu Sirip Hitam; Barakuda Sirip Hitam (Sphyraena qenie)' ? 'selected' : '' }}>Alu-alu Sirip Hitam; Barakuda Sirip Hitam (Sphyraena qenie)</option>
                            <option value="Ayam-ayam; Kambing-kambing (Abalistes filamentosus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Ayam-ayam; Kambing-kambing (Abalistes filamentosus)' ? 'selected' : '' }}>Ayam-ayam; Kambing-kambing (Abalistes filamentosus)</option>
                            <option value="Ayam-ayam; Kambing-kambing (Abalistes stellaris)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Ayam-ayam; Kambing-kambing (Abalistes stellaris)' ? 'selected' : '' }}>Ayam-ayam; Kambing-kambing (Abalistes stellaris)</option>
                            <option value="Ayam-ayam; Kambing-kambing (Rhinecanthus verrucosus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Ayam-ayam; Kambing-kambing (Rhinecanthus verrucosus)' ? 'selected' : '' }}>Ayam-ayam; Kambing-kambing (Rhinecanthus verrucosus)</option>
                            <option value="Bambangan (Lutjanus erythropterus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bambangan (Lutjanus erythropterus)' ? 'selected' : '' }}>Bambangan (Lutjanus erythropterus)</option>
                            <option value="Bambangan (Lutjanus malabaricus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bambangan (Lutjanus malabaricus)' ? 'selected' : '' }}>Bambangan (Lutjanus malabaricus)</option>
                            <option value="Bandeng (Chanos chanos)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bandeng (Chanos chanos)' ? 'selected' : '' }}>Bandeng (Chanos chanos)</option>
                            <option value="Baronang (Siganus canaliculatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Baronang (Siganus canaliculatus)' ? 'selected' : '' }}>Baronang (Siganus canaliculatus)</option>
                            <option value="Bawal Air Tawar (Colossoma macropomum)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bawal Air Tawar (Colossoma macropomum)' ? 'selected' : '' }}>Bawal Air Tawar (Colossoma macropomum)</option>
                            <option value="Bawal Bintang (Trachinotus blochii)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bawal Bintang (Trachinotus blochii)' ? 'selected' : '' }}>Bawal Bintang (Trachinotus blochii)</option>
                            <option value="Bawal Hitam (Parastromateus niger)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bawal Hitam (Parastromateus niger)' ? 'selected' : '' }}>Bawal Hitam (Parastromateus niger)</option>
                            <option value="Bawal Putih (Pampus argenteus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bawal Putih (Pampus argenteus)' ? 'selected' : '' }}>Bawal Putih (Pampus argenteus)</option>
                            <option value="Bawal Sabit (Taractichthys steindachneri)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bawal Sabit (Taractichthys steindachneri)' ? 'selected' : '' }}>Bawal Sabit (Taractichthys steindachneri)</option>
                            <option value="Belanak (Mugil cephalus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Belanak (Mugil cephalus)' ? 'selected' : '' }}>Belanak (Mugil cephalus)</option>
                            <option value="Belanak (Valamugil seheli)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Belanak (Valamugil seheli)' ? 'selected' : '' }}>Belanak (Valamugil seheli)</option>
                            <option value="Beloso (Saurida longimanus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Beloso (Saurida longimanus)' ? 'selected' : '' }}>Beloso (Saurida longimanus)</option>
                            <option value="Beloso (Saurida tumbil)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Beloso (Saurida tumbil)' ? 'selected' : '' }}>Beloso (Saurida tumbil)</option>
                            <option value="Beloso (Synodus variegatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Beloso (Synodus variegatus)' ? 'selected' : '' }}>Beloso (Synodus variegatus)</option>
                            <option value="Belut Moray Besar (Gymnothorax javanicus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Belut Moray Besar (Gymnothorax javanicus)' ? 'selected' : '' }}>Belut Moray Besar (Gymnothorax javanicus)</option>
                            <option value="Biji Nangka Karang (Parupeneus barberinus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Biji Nangka Karang (Parupeneus barberinus)' ? 'selected' : '' }}>Biji Nangka Karang (Parupeneus barberinus)</option>
                            <option value="Bilis (Herklotsichthys dispilonotus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bilis (Herklotsichthys dispilonotus)' ? 'selected' : '' }}>Bilis (Herklotsichthys dispilonotus)</option>
                            <option value="Bulan-bulan (Elops hawaiensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Bulan-bulan (Elops hawaiensis)' ? 'selected' : '' }}>Bulan-bulan (Elops hawaiensis)</option>
                            <option value="Cakalang (Katsuwonus pelamis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Cakalang (Katsuwonus pelamis)' ? 'selected' : '' }}>Cakalang (Katsuwonus pelamis)</option>
                            <option value="Cendro (Lestrolepis japonica)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Cendro (Lestrolepis japonica)' ? 'selected' : '' }}>Cendro (Lestrolepis japonica)</option>
                            <option value="Cendro (Tylosurus crocodilus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Cendro (Tylosurus crocodilus)' ? 'selected' : '' }}>Cendro (Tylosurus crocodilus)</option>
                            <option value="Cucut Lanjam (Carcharhinus Fitzroyensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Cucut Lanjam (Carcharhinus Fitzroyensis)' ? 'selected' : '' }}>Cucut Lanjam (Carcharhinus Fitzroyensis)</option>
                            <option value="Cumi-cumi (Loligo chinensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Cumi-cumi (Loligo chinensis)' ? 'selected' : '' }}>Cumi-cumi (Loligo chinensis)</option>
                            <option value="Ekor Kuning (Paracaesio brevidentata)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Ekor Kuning (Paracaesio brevidentata)' ? 'selected' : '' }}>Ekor Kuning (Paracaesio brevidentata)</option>
                            <option value="Gabus (Channa striata)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Gabus (Channa striata)' ? 'selected' : '' }}>Gabus (Channa striata)</option>
                            <option value="Gabus Laut (Rachycentron canadum)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Gabus Laut (Rachycentron canadum)' ? 'selected' : '' }}>Gabus Laut (Rachycentron canadum)</option>
                            <option value="Gerot-gerot (Pomadasys andamanensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Gerot-gerot (Pomadasys andamanensis)' ? 'selected' : '' }}>Gerot-gerot (Pomadasys andamanensis)</option>
                            <option value="Gindara (Cubiceps capensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Gindara (Cubiceps capensis)' ? 'selected' : '' }}>Gindara (Cubiceps capensis)</option>
                            <option value="Golok-golok (Chirocentrus dorab)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Golok-golok (Chirocentrus dorab)' ? 'selected' : '' }}>Golok-golok (Chirocentrus dorab)</option>
                            <option value="Gulamah (Gymnocranius griseus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Gulamah (Gymnocranius griseus)' ? 'selected' : '' }}>Gulamah (Gymnocranius griseus)</option>
                            <option value="Gulamah (Johnius amblycephalus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Gulamah (Johnius amblycephalus)' ? 'selected' : '' }}>Gulamah (Johnius amblycephalus)</option>
                            <option value="Gulamah (Johnius borneensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Gulamah (Johnius borneensis)' ? 'selected' : '' }}>Gulamah (Johnius borneensis)</option>
                            <option value="Gurame; Gurami (Osphronemus goramy)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Gurame; Gurami (Osphronemus goramy)' ? 'selected' : '' }}>Gurame; Gurami (Osphronemus goramy)</option>
                            <option value="Gurita (Octopus aegina)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Gurita (Octopus aegina)' ? 'selected' : '' }}>Gurita (Octopus aegina)</option>
                            <option value="Hiu Biru (Prionace glauca)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Biru (Prionace glauca)' ? 'selected' : '' }}>Hiu Biru (Prionace glauca)</option>
                            <option value="Hiu Botol (Centroscymnus crepidater)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Botol (Centroscymnus crepidater)' ? 'selected' : '' }}>Hiu Botol (Centroscymnus crepidater)</option>
                            <option value="Hiu Jenggot; Wobbegong Berbintik (Orectolobus maculatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Jenggot; Wobbegong Berbintik (Orectolobus maculatus)' ? 'selected' : '' }}>Hiu Jenggot; Wobbegong Berbintik (Orectolobus maculatus)</option>
                            <option value="Hiu Kacang (Hemitriakis leucoperiptera)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Kacang (Hemitriakis leucoperiptera)' ? 'selected' : '' }}>Hiu Kacang (Hemitriakis leucoperiptera)</option>
                            <option value="Hiu Lanjaman (Carcharhinus altimus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Lanjaman (Carcharhinus altimus)' ? 'selected' : '' }}>Hiu Lanjaman (Carcharhinus altimus)</option>
                            <option value="Hiu Lanjaman (Carcharhinus dussumieri)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Lanjaman (Carcharhinus dussumieri)' ? 'selected' : '' }}>Hiu Lanjaman (Carcharhinus dussumieri)</option>
                            <option value="Hiu Mako Sirip Pendek (Isurus glaucus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Mako Sirip Pendek (Isurus glaucus)' ? 'selected' : '' }}>Hiu Mako Sirip Pendek (Isurus glaucus)</option>
                            <option value="Hiu Martil (Eusphyra blochii)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Martil (Eusphyra blochii)' ? 'selected' : '' }}>Hiu Martil (Eusphyra blochii)</option>
                            <option value="Hiu Pilus (Rhizoprionodon acutus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Pilus (Rhizoprionodon acutus)' ? 'selected' : '' }}>Hiu Pilus (Rhizoprionodon acutus)</option>
                            <option value="Hiu Sonteng (Carcharhinus albimarginatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Sonteng (Carcharhinus albimarginatus)' ? 'selected' : '' }}>Hiu Sonteng (Carcharhinus albimarginatus)</option>
                            <option value="Hiu Taji (Squalus megalops)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Taji (Squalus megalops)' ? 'selected' : '' }}>Hiu Taji (Squalus megalops)</option>
                            <option value="Hiu Tikus (Alopias pelagicus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Hiu Tikus (Alopias pelagicus)' ? 'selected' : '' }}>Hiu Tikus (Alopias pelagicus)</option>
                            <option value="Ikan Demersal Lainnya (Ikan Demersal Lainnya)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Ikan Demersal Lainnya (Ikan Demersal Lainnya)' ? 'selected' : '' }}>Ikan Demersal Lainnya (Ikan Demersal Lainnya)</option>
                            <option value="Ikan Lainnya (Ikan Lainnya)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Ikan Lainnya (Ikan Lainnya)' ? 'selected' : '' }}>Ikan Lainnya (Ikan Lainnya)</option>
                            <option value="Japuh (Dussumieria acuta)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Japuh (Dussumieria acuta)' ? 'selected' : '' }}>Japuh (Dussumieria acuta)</option>
                            <option value="Jenaha (Lutjanus russellii)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Jenaha (Lutjanus russellii)' ? 'selected' : '' }}>Jenaha (Lutjanus russellii)</option>
                            <option value="Julung-julung (Hemiramphus far)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Julung-julung (Hemiramphus far)' ? 'selected' : '' }}>Julung-julung (Hemiramphus far)</option>
                            <option value="Kaci-kaci (Diagramma pictum)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kaci-kaci (Diagramma pictum)' ? 'selected' : '' }}>Kaci-kaci (Diagramma pictum)</option>
                            <option value="Kakap (Liopropoma randalli)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap (Liopropoma randalli)' ? 'selected' : '' }}>Kakap (Liopropoma randalli)</option>
                            <option value="Kakap Balong (Diagramma melanacrum)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Balong (Diagramma melanacrum)' ? 'selected' : '' }}>Kakap Balong (Diagramma melanacrum)</option>
                            <option value="Kakap Batu (Lobotes surinamensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Batu (Lobotes surinamensis)' ? 'selected' : '' }}>Kakap Batu (Lobotes surinamensis)</option>
                            <option value="Kakap Batu (Plectorhinchus polytaenia)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Batu (Plectorhinchus polytaenia)' ? 'selected' : '' }}>Kakap Batu (Plectorhinchus polytaenia)</option>
                            <option value="Kakap Hitam (Macolor niger)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Hitam (Macolor niger)' ? 'selected' : '' }}>Kakap Hitam (Macolor niger)</option>
                            <option value="Kakap Merah (Etelis coruscans)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Merah (Etelis coruscans)' ? 'selected' : '' }}>Kakap Merah (Etelis coruscans)</option>
                            <option value="Kakap Merah (Lutjanus bitaeniatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Merah (Lutjanus bitaeniatus)' ? 'selected' : '' }}>Kakap Merah (Lutjanus bitaeniatus)</option>
                            <option value="Kakap Merah Bakau (Lutjanus argentimaculatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Merah Bakau (Lutjanus argentimaculatus)' ? 'selected' : '' }}>Kakap Merah Bakau (Lutjanus argentimaculatus)</option>
                            <option value="Kakap Putih (Plectorhinchus gibbosus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Putih (Plectorhinchus gibbosus)' ? 'selected' : '' }}>Kakap Putih (Plectorhinchus gibbosus)</option>
                            <option value="Kakap Putih; Baramundi (Lates calcarifer)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Putih; Baramundi (Lates calcarifer)' ? 'selected' : '' }}>Kakap Putih; Baramundi (Lates calcarifer)</option>
                            <option value="Kakap Tambak (Lutjanus fulvus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kakap Tambak (Lutjanus fulvus)' ? 'selected' : '' }}>Kakap Tambak (Lutjanus fulvus)</option>
                            <option value="Kantung Semar (Mene maculata)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kantung Semar (Mene maculata)' ? 'selected' : '' }}>Kantung Semar (Mene maculata)</option>
                            <option value="Kapasan (Prionurus chrysurus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kapasan (Prionurus chrysurus)' ? 'selected' : '' }}>Kapasan (Prionurus chrysurus)</option>
                            <option value="Kapas-kapas (Gerres erythrourus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kapas-kapas (Gerres erythrourus)' ? 'selected' : '' }}>Kapas-kapas (Gerres erythrourus)</option>
                            <option value="Kapas-kapas (Gerres filamentosus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kapas-kapas (Gerres filamentosus)' ? 'selected' : '' }}>Kapas-kapas (Gerres filamentosus)</option>
                            <option value="Kembung (Rastrelliger faughni)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kembung (Rastrelliger faughni)' ? 'selected' : '' }}>Kembung (Rastrelliger faughni)</option>
                            <option value="Kembung Lelaki (Rastrelliger kanagurta)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kembung Lelaki (Rastrelliger kanagurta)' ? 'selected' : '' }}>Kembung Lelaki (Rastrelliger kanagurta)</option>
                            <option value="Kepiting (Carpilius maculatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kepiting (Carpilius maculatus)' ? 'selected' : '' }}>Kepiting (Carpilius maculatus)</option>
                            <option value="Kepiting Bakau (Scylla olivacea)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kepiting Bakau (Scylla olivacea)' ? 'selected' : '' }}>Kepiting Bakau (Scylla olivacea)</option>
                            <option value="Kepiting Bakau (Scylla serrata)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kepiting Bakau (Scylla serrata)' ? 'selected' : '' }}>Kepiting Bakau (Scylla serrata)</option>
                            <option value="Kerang Bulu (Anadara antiquata)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerang Bulu (Anadara antiquata)' ? 'selected' : '' }}>Kerang Bulu (Anadara antiquata)</option>
                            <option value="Kerang Darah (Anadara granosa)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerang Darah (Anadara granosa)' ? 'selected' : '' }}>Kerang Darah (Anadara granosa)</option>
                            <option value="Kerang Hijau (Perna viridis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerang Hijau (Perna viridis)' ? 'selected' : '' }}>Kerang Hijau (Perna viridis)</option>
                            <option value="Kerapu Balong (Epinephelus bleekeri)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerapu Balong (Epinephelus bleekeri)' ? 'selected' : '' }}>Kerapu Balong (Epinephelus bleekeri)</option>
                            <option value="Kerapu Batu (Cephalopholis aitha)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerapu Batu (Cephalopholis aitha)' ? 'selected' : '' }}>Kerapu Batu (Cephalopholis aitha)</option>
                            <option value="Kerapu Karang (Chephalopholis boenack)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerapu Karang (Chephalopholis boenack)' ? 'selected' : '' }}>Kerapu Karang (Chephalopholis boenack)</option>
                            <option value="Kerapu Lumpur (Epinephelus amblycephalus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerapu Lumpur (Epinephelus amblycephalus)' ? 'selected' : '' }}>Kerapu Lumpur (Epinephelus amblycephalus)</option>
                            <option value="Kerapu Lumpur (Epinephelus faveatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerapu Lumpur (Epinephelus faveatus)' ? 'selected' : '' }}>Kerapu Lumpur (Epinephelus faveatus)</option>
                            <option value="Kerapu Macan (Epinephelus fuscoguttatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerapu Macan (Epinephelus fuscoguttatus)' ? 'selected' : '' }}>Kerapu Macan (Epinephelus fuscoguttatus)</option>
                            <option value="Kerapu Macan (Epinephelus maculatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerapu Macan (Epinephelus maculatus)' ? 'selected' : '' }}>Kerapu Macan (Epinephelus maculatus)</option>
                            <option value="Kerapu Macan (Epinephelus spilotoceps)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerapu Macan (Epinephelus spilotoceps)' ? 'selected' : '' }}>Kerapu Macan (Epinephelus spilotoceps)</option>
                            <option value="Kerapu Tutul (Epinephelus quoyanus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerapu Tutul (Epinephelus quoyanus)' ? 'selected' : '' }}>Kerapu Tutul (Epinephelus quoyanus)</option>
                            <option value="Kerisi (Nemipterus aurora)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerisi (Nemipterus aurora)' ? 'selected' : '' }}>Kerisi (Nemipterus aurora)</option>
                            <option value="Kerong-kerong (Helotes sexlineatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerong-kerong (Helotes sexlineatus)' ? 'selected' : '' }}>Kerong-kerong (Helotes sexlineatus)</option>
                            <option value="Kerong-kerong (Terapon jarbua)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kerong-kerong (Terapon jarbua)' ? 'selected' : '' }}>Kerong-kerong (Terapon jarbua)</option>
                            <option value="Ketang-ketang (Drepane punctata)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Ketang-ketang (Drepane punctata)' ? 'selected' : '' }}>Ketang-ketang (Drepane punctata)</option>
                            <option value="Kuniran; Biji Nangka (Parupeneus cyclostomus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kuniran; Biji Nangka (Parupeneus cyclostomus)' ? 'selected' : '' }}>Kuniran; Biji Nangka (Parupeneus cyclostomus)</option>
                            <option value="Kuniran; Biji Nangka (Parupeneus heptacanthus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kuniran; Biji Nangka (Parupeneus heptacanthus)' ? 'selected' : '' }}>Kuniran; Biji Nangka (Parupeneus heptacanthus)</option>
                            <option value="Kurisi (Argyrops spinifer)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kurisi (Argyrops spinifer)' ? 'selected' : '' }}>Kurisi (Argyrops spinifer)</option>
                            <option value="Kurisi (Nemipterus balinensoides)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kurisi (Nemipterus balinensoides)' ? 'selected' : '' }}>Kurisi (Nemipterus balinensoides)</option>
                            <option value="Kurisi (Nemipterus japonicus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kurisi (Nemipterus japonicus)' ? 'selected' : '' }}>Kurisi (Nemipterus japonicus)</option>
                            <option value="Kurisi (Pentapodus setosus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kurisi (Pentapodus setosus)' ? 'selected' : '' }}>Kurisi (Pentapodus setosus)</option>
                            <option value="Kuro; Senangin (Eleutheronema tetradactylum)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kuro; Senangin (Eleutheronema tetradactylum)' ? 'selected' : '' }}>Kuro; Senangin (Eleutheronema tetradactylum)</option>
                            <option value="Kuro; Senangin (Polydactylus microstomus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kuro; Senangin (Polydactylus microstomus)' ? 'selected' : '' }}>Kuro; Senangin (Polydactylus microstomus)</option>
                            <option value="Kuwe (Carangoides armatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kuwe (Carangoides armatus)' ? 'selected' : '' }}>Kuwe (Carangoides armatus)</option>
                            <option value="Kuwe Gerong (Caranx ignobilis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kuwe Gerong (Caranx ignobilis)' ? 'selected' : '' }}>Kuwe Gerong (Caranx ignobilis)</option>
                            <option value="Kuwe Semar (Carangoides hedlandensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Kuwe Semar (Carangoides hedlandensis)' ? 'selected' : '' }}>Kuwe Semar (Carangoides hedlandensis)</option>
                  <option value="Krill (Euphausia superba)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Krill (Euphausia superba)' ? 'selected' : '' }}>Krill (Euphausia superba)</option>
                            <option value="Layang (Decapterus maruadsi)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Layang (Decapterus maruadsi)' ? 'selected' : '' }}>Layang (Decapterus maruadsi)</option>
                            <option value="Layang Anggur (Decapterus kurroides)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Layang Anggur (Decapterus kurroides)' ? 'selected' : '' }}>Layang Anggur (Decapterus kurroides)</option>
                            <option value="Layang Benggol (Decapterus russelli)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Layang Benggol (Decapterus russelli)' ? 'selected' : '' }}>Layang Benggol (Decapterus russelli)</option>
                            <option value="Layang Biru (Decapterus macarellus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Layang Biru (Decapterus macarellus)' ? 'selected' : '' }}>Layang Biru (Decapterus macarellus)</option>
                            <option value="Layang Lidi; Layar Deles (Decapterus macrosoma)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Layang Lidi; Layar Deles (Decapterus macrosoma)' ? 'selected' : '' }}>Layang Lidi; Layar Deles (Decapterus macrosoma)</option>
                            <option value="Layaran (Istiophorus platypterus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Layaran (Istiophorus platypterus)' ? 'selected' : '' }}>Layaran (Istiophorus platypterus)</option>
                            <option value="Layur (Trichiurus lepturus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Layur (Trichiurus lepturus)' ? 'selected' : '' }}>Layur (Trichiurus lepturus)</option>
                            <option value="Lele (Clarias batrachus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lele (Clarias batrachus)' ? 'selected' : '' }}>Lele (Clarias batrachus)</option>
                            <option value="Lemadang (Coryphaena hippurus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lemadang (Coryphaena hippurus)' ? 'selected' : '' }}>Lemadang (Coryphaena hippurus)</option>
                            <option value="Lemuru (Sardinella albella)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lemuru (Sardinella albella)' ? 'selected' : '' }}>Lemuru (Sardinella albella)</option>
                            <option value="Lidah (Cynoglossus arel)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lidah (Cynoglossus arel)' ? 'selected' : '' }}>Lidah (Cynoglossus arel)</option>
                            <option value="Lidah (Cynoglossus lingua)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lidah (Cynoglossus lingua)' ? 'selected' : '' }}>Lidah (Cynoglossus lingua)</option>
                            <option value="Lobster (Panulirus argus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lobster (Panulirus argus)' ? 'selected' : '' }}>Lobster (Panulirus argus)</option>
                            <option value="Lobster (Scylaroies squamosus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lobster (Scylaroies squamosus)' ? 'selected' : '' }}>Lobster (Scylaroies squamosus)</option>
                            <option value="Lobster Bambu (Panulirus versicolor)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lobster Bambu (Panulirus versicolor)' ? 'selected' : '' }}>Lobster Bambu (Panulirus versicolor)</option>
                            <option value="Lobster Mutiara (Panulirus ornatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lobster Mutiara (Panulirus ornatus)' ? 'selected' : '' }}>Lobster Mutiara (Panulirus ornatus)</option>
                            <option value="Lobster Pasir (Panulirus homarus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Lobster Pasir (Panulirus homarus)' ? 'selected' : '' }}>Lobster Pasir (Panulirus homarus)</option>
                            <option value="Manyung Besar (Arius thalassinus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Manyung Besar (Arius thalassinus)' ? 'selected' : '' }}>Manyung Besar (Arius thalassinus)</option>
                            <option value="Manyung Besar (Netuma thalassina)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Manyung Besar (Netuma thalassina)' ? 'selected' : '' }}>Manyung Besar (Netuma thalassina)</option>
                            <option value="Manyung Hitam (Plicofollis dussumieri)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Manyung Hitam (Plicofollis dussumieri)' ? 'selected' : '' }}>Manyung Hitam (Plicofollis dussumieri)</option>
                            <option value="Manyung Jahal (Plicofollis argyropleuron)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Manyung Jahal (Plicofollis argyropleuron)' ? 'selected' : '' }}>Manyung Jahal (Plicofollis argyropleuron)</option>
                            <option value="Marlin Biru (Makaira nigricans)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Marlin Biru (Makaira nigricans)' ? 'selected' : '' }}>Marlin Biru (Makaira nigricans)</option>
                            <option value="Marlin Hitam (Istiompax indica)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Marlin Hitam (Istiompax indica)' ? 'selected' : '' }}>Marlin Hitam (Istiompax indica)</option>
                            <option value="Marlin loreng (Tetrapturus audax)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Marlin loreng (Tetrapturus audax)' ? 'selected' : '' }}>Marlin loreng (Tetrapturus audax)</option>
                            <option value="Mas (Cyprinus carpio)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Mas (Cyprinus carpio)' ? 'selected' : '' }}>Mas (Cyprinus carpio)</option>
                            <option value="Mujair (Oreochromis mossambicus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Mujair (Oreochromis mossambicus)' ? 'selected' : '' }}>Mujair (Oreochromis mossambicus)</option>
                            <option value="Nila (Oreochromis niloticus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Nila (Oreochromis niloticus)' ? 'selected' : '' }}>Nila (Oreochromis niloticus)</option>
                            <option value="Nilem (Osteochilus vittatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Nilem (Osteochilus vittatus)' ? 'selected' : '' }}>Nilem (Osteochilus vittatus)</option>
                            <option value="Pari Burung (Aetomylaeus nichofii)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pari Burung (Aetomylaeus nichofii)' ? 'selected' : '' }}>Pari Burung (Aetomylaeus nichofii)</option>
                            <option value="Pari Kekeh (Rhynchobatus djiddensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pari Kekeh (Rhynchobatus djiddensis)' ? 'selected' : '' }}>Pari Kekeh (Rhynchobatus djiddensis)</option>
                            <option value="Pari Kelapa (Trygon sephen)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pari Kelapa (Trygon sephen)' ? 'selected' : '' }}>Pari Kelapa (Trygon sephen)</option>
                            <option value="Pari Kelelawar (Gymnura micrura)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pari Kelelawar (Gymnura micrura)' ? 'selected' : '' }}>Pari Kelelawar (Gymnura micrura)</option>
                            <option value="Pari Kembang (Neotrygon kuhlii)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pari Kembang (Neotrygon kuhlii)' ? 'selected' : '' }}>Pari Kembang (Neotrygon kuhlii)</option>
                            <option value="Pari Lemer (Pteroplatytrygon violacea)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pari Lemer (Pteroplatytrygon violacea)' ? 'selected' : '' }}>Pari Lemer (Pteroplatytrygon violacea)</option>
                            <option value="Pari Mobula (Mobula japanica)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pari Mobula (Mobula japanica)' ? 'selected' : '' }}>Pari Mobula (Mobula japanica)</option>
                            <option value="Pari Mobula (Mobula kuhlii)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pari Mobula (Mobula kuhlii)' ? 'selected' : '' }}>Pari Mobula (Mobula kuhlii)</option>
                            <option value="Pari Muara (Hemitrygon fluviorum)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pari Muara (Hemitrygon fluviorum)' ? 'selected' : '' }}>Pari Muara (Hemitrygon fluviorum)</option>
                            <option value="Patin (Pangasius Pangasius)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Patin (Pangasius Pangasius)' ? 'selected' : '' }}>Patin (Pangasius Pangasius)</option>
                            <option value="Paut-paut (Grammoplites scaber)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Paut-paut (Grammoplites scaber)' ? 'selected' : '' }}>Paut-paut (Grammoplites scaber)</option>
                            <option value="Pedang (Xiphias gladius)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pedang (Xiphias gladius)' ? 'selected' : '' }}>Pedang (Xiphias gladius)</option>
                            <option value="Peperek Bondolan (Leiognathus bindus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Peperek Bondolan (Leiognathus bindus)' ? 'selected' : '' }}>Peperek Bondolan (Leiognathus bindus)</option>
                            <option value="Peperek Calingcing (Leiognathus leuciscus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Peperek Calingcing (Leiognathus leuciscus)' ? 'selected' : '' }}>Peperek Calingcing (Leiognathus leuciscus)</option>
                            <option value="Peperek Topang (Leiognathus equulus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Peperek Topang (Leiognathus equulus)' ? 'selected' : '' }}>Peperek Topang (Leiognathus equulus)</option>
                            <option value="Petek (Aurigequula fasciata)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Petek (Aurigequula fasciata)' ? 'selected' : '' }}>Petek (Aurigequula fasciata)</option>
                            <option value="Petek (Equulites laterofenestra)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Petek (Equulites laterofenestra)' ? 'selected' : '' }}>Petek (Equulites laterofenestra)</option>
                            <option value="Pucuk Nipah (Muraenesox bagio)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Pucuk Nipah (Muraenesox bagio)' ? 'selected' : '' }}>Pucuk Nipah (Muraenesox bagio)</option>
                            <option value="Rajungan (Portunus pelagicus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Rajungan (Portunus pelagicus)' ? 'selected' : '' }}>Rajungan (Portunus pelagicus)</option>
                            <option value="Remang (Congresox talabon)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Remang (Congresox talabon)' ? 'selected' : '' }}>Remang (Congresox talabon)</option>
                            <option value="Rumput Laut" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Rumput Laut' ? 'selected' : '' }}>Rumput Laut</option>
                            <option value="Rumput Laut" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Rumput Laut' ? 'selected' : '' }}>Rumput Laut</option>
                            <option value="Samgeh (Chrysochir aureus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Samgeh (Chrysochir aureus)' ? 'selected' : '' }}>Samgeh (Chrysochir aureus)</option>
                            <option value="Sebelah (Psettodes erumei)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Sebelah (Psettodes erumei)' ? 'selected' : '' }}>Sebelah (Psettodes erumei)</option>
                            <option value="Selanget (Anodontostoma chacunda)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Selanget (Anodontostoma chacunda)' ? 'selected' : '' }}>Selanget (Anodontostoma chacunda)</option>
                            <option value="Selar Bentong (Selar crumenophthalmus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Selar Bentong (Selar crumenophthalmus)' ? 'selected' : '' }}>Selar Bentong (Selar crumenophthalmus)</option>
                            <option value="Selar Hijau (Atule mate)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Selar Hijau (Atule mate)' ? 'selected' : '' }}>Selar Hijau (Atule mate)</option>
                            <option value="Selar Kuning (Selaroides leptolepis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Selar Kuning (Selaroides leptolepis)' ? 'selected' : '' }}>Selar Kuning (Selaroides leptolepis)</option>
                            <option value="Semar (Lampris guttatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Semar (Lampris guttatus)' ? 'selected' : '' }}>Semar (Lampris guttatus)</option>
                            <option value="Sembilang Betul (Plotosus canius)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Sembilang Betul (Plotosus canius)' ? 'selected' : '' }}>Sembilang Betul (Plotosus canius)</option>
                            <option value="Sembilang Karang (Plotosus lineatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Sembilang Karang (Plotosus lineatus)' ? 'selected' : '' }}>Sembilang Karang (Plotosus lineatus)</option>
                            <option value="Sepat Siam (Trichopodus pectoralis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Sepat Siam (Trichopodus pectoralis)' ? 'selected' : '' }}>Sepat Siam (Trichopodus pectoralis)</option>
                            <option value="Sidat (Anguilla anguilla)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Sidat (Anguilla anguilla)' ? 'selected' : '' }}>Sidat (Anguilla anguilla)</option>
                            <option value="Simping (Amusium pleuronectes)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Simping (Amusium pleuronectes)' ? 'selected' : '' }}>Simping (Amusium pleuronectes)</option>
                            <option value="Siro (Amblygaster sirm)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Siro (Amblygaster sirm)' ? 'selected' : '' }}>Siro (Amblygaster sirm)</option>
                            <option value="Sotong (Pharaoh cuttlefish)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Sotong (Pharaoh cuttlefish)' ? 'selected' : '' }}>Sotong (Pharaoh cuttlefish)</option>
                            <option value="Sunglir (Elagatis bipinnulata)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Sunglir (Elagatis bipinnulata)' ? 'selected' : '' }}>Sunglir (Elagatis bipinnulata)</option>
                            <option value="Swanggi (Priacanthus hamrur)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Swanggi (Priacanthus hamrur)' ? 'selected' : '' }}>Swanggi (Priacanthus hamrur)</option>
                            <option value="Swanggi (Priacanthus tayenus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Swanggi (Priacanthus tayenus)' ? 'selected' : '' }}>Swanggi (Priacanthus tayenus)</option>
                            <option value="Talang-talang (Scomberoides lysan)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Talang-talang (Scomberoides lysan)' ? 'selected' : '' }}>Talang-talang (Scomberoides lysan)</option>
                            <option value="Talang-talang (Scomberoides tala)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Talang-talang (Scomberoides tala)' ? 'selected' : '' }}>Talang-talang (Scomberoides tala)</option>
                            <option value="Talang-talang Lima Jari (Scomberoides commersonnianus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Talang-talang Lima Jari (Scomberoides commersonnianus)' ? 'selected' : '' }}>Talang-talang Lima Jari (Scomberoides commersonnianus)</option>
                            <option value="Tambakan (Helostoma temminckii)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tambakan (Helostoma temminckii)' ? 'selected' : '' }}>Tambakan (Helostoma temminckii)</option>
                            <option value="Tawes (Barbodes gonionotus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tawes (Barbodes gonionotus)' ? 'selected' : '' }}>Tawes (Barbodes gonionotus)</option>
                            <option value="Tawes (Barbodes priacanthus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tawes (Barbodes priacanthus)' ? 'selected' : '' }}>Tawes (Barbodes priacanthus)</option>
                            <option value="Tawes (Puntius javanicus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tawes (Puntius javanicus)' ? 'selected' : '' }}>Tawes (Puntius javanicus)</option>
                            <option value="Tembang (Sardinella gibbosa)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tembang (Sardinella gibbosa)' ? 'selected' : '' }}>Tembang (Sardinella gibbosa)</option>
                            <option value="Tenggiri (Scomberomorus commerson)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tenggiri (Scomberomorus commerson)' ? 'selected' : '' }}>Tenggiri (Scomberomorus commerson)</option>
                            <option value="Tenggiri Batang; Tenggiri India (Scomberomorus lineolatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tenggiri Batang; Tenggiri India (Scomberomorus lineolatus)' ? 'selected' : '' }}>Tenggiri Batang; Tenggiri India (Scomberomorus lineolatus)</option>
                            <option value="Tenggiri Papan (Scomberomorus guttatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tenggiri Papan (Scomberomorus guttatus)' ? 'selected' : '' }}>Tenggiri Papan (Scomberomorus guttatus)</option>
                            <option value="Teri Gepeng (Stolephorus waitei)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Teri Gepeng (Stolephorus waitei)' ? 'selected' : '' }}>Teri Gepeng (Stolephorus waitei)</option>
                            <option value="Teri Indian (Stolephorus indicus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Teri Indian (Stolephorus indicus)' ? 'selected' : '' }}>Teri Indian (Stolephorus indicus)</option>
                            <option value="Teri Jengki (Stolephorus insularis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Teri Jengki (Stolephorus insularis)' ? 'selected' : '' }}>Teri Jengki (Stolephorus insularis)</option>
                            <option value="Teri Nasi (Encrasicholina devisi)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Teri Nasi (Encrasicholina devisi)' ? 'selected' : '' }}>Teri Nasi (Encrasicholina devisi)</option>
                            <option value="Tetengkek (Megalaspis cordyla)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tetengkek (Megalaspis cordyla)' ? 'selected' : '' }}>Tetengkek (Megalaspis cordyla)</option>
                            <option value="Tigawaja (Otolithes ruber)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tigawaja (Otolithes ruber)' ? 'selected' : '' }}>Tigawaja (Otolithes ruber)</option>
                            <option value="Tongkol (Auxis thazard)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tongkol (Auxis thazard)' ? 'selected' : '' }}>Tongkol (Auxis thazard)</option>
                            <option value="Tongkol Abu-abu (Thunnus tonggol)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tongkol Abu-abu (Thunnus tonggol)' ? 'selected' : '' }}>Tongkol Abu-abu (Thunnus tonggol)</option>
                            <option value="Tongkol Banyar (Euthynnus lineatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tongkol Banyar (Euthynnus lineatus)' ? 'selected' : '' }}>Tongkol Banyar (Euthynnus lineatus)</option>
                            <option value="Tongkol Komo (Euthynnus affinis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tongkol Komo (Euthynnus affinis)' ? 'selected' : '' }}>Tongkol Komo (Euthynnus affinis)</option>
                            <option value="Tongkol Lisong (Auxis rochei)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tongkol Lisong (Auxis rochei)' ? 'selected' : '' }}>Tongkol Lisong (Auxis rochei)</option>
                            <option value="Tuna Mata Besar (Thunnus obesus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tuna Mata Besar (Thunnus obesus)' ? 'selected' : '' }}>Tuna Mata Besar (Thunnus obesus)</option>
                            <option value="Tuna Sirip Kuning; Madidihang (Thunnus albacares)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Tuna Sirip Kuning; Madidihang (Thunnus albacares)' ? 'selected' : '' }}>Tuna Sirip Kuning; Madidihang (Thunnus albacares)</option>
                            <option value="Udang Aloha (Penaeus marginatus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Aloha (Penaeus marginatus)' ? 'selected' : '' }}>Udang Aloha (Penaeus marginatus)</option>
                            <option value="Udang Brintik (Metapenaeus lysianassa)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Brintik (Metapenaeus lysianassa)' ? 'selected' : '' }}>Udang Brintik (Metapenaeus lysianassa)</option>
                            <option value="Udang Danau (Palaemon paucidens)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Danau (Palaemon paucidens)' ? 'selected' : '' }}>Udang Danau (Palaemon paucidens)</option>
                            <option value="Udang Dogol (Metapenaeus endeavouri)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Dogol (Metapenaeus endeavouri)' ? 'selected' : '' }}>Udang Dogol (Metapenaeus endeavouri)</option>
                            <option value="Udang dogol (Metapenaeus monoceros)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang dogol (Metapenaeus monoceros)' ? 'selected' : '' }}>Udang dogol (Metapenaeus monoceros)</option>
                            <option value="Udang Galah (Macrobrachium rosenbergii)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Galah (Macrobrachium rosenbergii)' ? 'selected' : '' }}>Udang Galah (Macrobrachium rosenbergii)</option>
                            <option value="Udang Galah (Macrobranchium assamensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Galah (Macrobranchium assamensis)' ? 'selected' : '' }}>Udang Galah (Macrobranchium assamensis)</option>
                            <option value="Udang Grogo (Acetes indicus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Grogo (Acetes indicus)' ? 'selected' : '' }}>Udang Grogo (Acetes indicus)</option>
                            <option value="Udang Harimau (Parapenaeopsis sculptilis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Harimau (Parapenaeopsis sculptilis)' ? 'selected' : '' }}>Udang Harimau (Parapenaeopsis sculptilis)</option>
                            <option value="Udang Jerbung (Penaeus merguiensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Jerbung (Penaeus merguiensis)' ? 'selected' : '' }}>Udang Jerbung (Penaeus merguiensis)</option>
                            <option value="Udang Krosok (Metapenaeopsis novaeguineae)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Krosok (Metapenaeopsis novaeguineae)' ? 'selected' : '' }}>Udang Krosok (Metapenaeopsis novaeguineae)</option>
                            <option value="Udang Krosok Kuning (Megokris granulosus)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Krosok Kuning (Megokris granulosus)' ? 'selected' : '' }}>Udang Krosok Kuning (Megokris granulosus)</option>
                            <option value="Udang Putih; Udang Api-api (Metapenaeus eboracensis)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Putih; Udang Api-api (Metapenaeus eboracensis)' ? 'selected' : '' }}>Udang Putih; Udang Api-api (Metapenaeus eboracensis)</option>
                            <option value="Udang Vaname (Penaeus vannamei)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Vaname (Penaeus vannamei)' ? 'selected' : '' }}>Udang Vaname (Penaeus vannamei)</option>
                            <option value="Udang Windu (Penaeus monodon)" {{ old('jenis_ikan', $bahan->jenis_ikan) == 'Udang Windu (Penaeus monodon)' ? 'selected' : '' }}>Udang Windu (Penaeus monodon)</option>                            
                        </select>
                        @error('jenis_ikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Volume Bahan Baku (Kg)</label>
                        <input type="number" name="volume_bahanbaku" class="form-control" value="{{ old('volume_bahanbaku', $bahan->volume_bahanbaku) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="asal_bahanbaku">Asal Bahan Baku</label>
                        <select class="form-control @error('asal_bahanbaku') is-invalid @enderror" id="asal_bahanbaku" name="asal_bahanbaku" required>
                            <option value="" disabled selected>Pilih Asal Bahan Baku</option>
                            <option value="Tangkap" {{ old('asal_bahanbaku', $bahan->asal_bahanbaku) == 'Tangkap' ? 'selected' : '' }}>Tangkap</option>  
                            <option value="Budidaya" {{ old('asal_bahanbaku', $bahan->asal_bahanbaku) == 'Budidaya' ? 'selected' : '' }}>Budidaya</option>  
                            <option value="Impor" {{ old('asal_bahanbaku', $bahan->asal_bahanbaku) == 'Impor' ? 'selected' : '' }}>Impor</option>  
                        </select>
                        @error('asal_bahanbaku')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $bahan->tahun) }}" required>
                    </div>
                    <div class="form-group">
                        <label>Triwulan</label>
                        <select name="triwulan" class="form-control @error('triwulan') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Triwulan</option>
                            <option value="1" {{ old('triwulan', $bahan->triwulan) == 1 ? 'selected' : '' }}>(Januari - Maret)</option>
                            <option value="2" {{ old('triwulan', $bahan->triwulan) == 2 ? 'selected' : '' }}>(April - Juni)</option>
                            <option value="3" {{ old('triwulan', $bahan->triwulan) == 3 ? 'selected' : '' }}>(Juli - September)</option>
                            <option value="4" {{ old('triwulan', $bahan->triwulan) == 4 ? 'selected' : '' }}>(Oktober - Desember)</option>
                        </select>
                        @error('triwulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info"><i class="far fa-edit"></i>Simpan</button>
                    <a href="{{ route('bahantabel.index') }}" class="btn btn btn-icon icon-left btn-warning" data-cancel-confirm><i class="fas fa-times"></i>Batal</a>
                </form>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('scripts')
<script>
$(document).ready(function() {
    $('.select2').select2({
        width: '100%',
        placeholder: "Pilih Jenis Bahan Baku",
        allowClear: true
    });

    // Konfirmasi update & batal
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