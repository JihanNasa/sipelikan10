<div class="container-fluid container-xl position-relative d-flex align-items-center">

  <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
    <img src="{{ asset('landingpage/img/logo_sipelikan.png') }}" alt="">
  </a>

  <nav id="navmenu" class="navmenu">
    <ul>
      <li><a href="#hero" class="active">Beranda<br></a></li>
      <li><a href="#values">Regulasi</a></li>
      <li><a href="#statistik">Statistik</a></li>
      <li><a href="#contact">Kontak</a></li>
    </ul>
    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
  </nav>

  <a class="btn-getstarted flex-md-shrink-0 me-2" href="{{ route('login') }}">Masuk</a>
  <a class="btn btn-outline-primary flex-md-shrink-0" href="{{ route('register') }}">Daftar</a>

</div>
