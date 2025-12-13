<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center">
    <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto">
      <img src="{{ asset('landingpage/img/logo_sipelikan.png') }}" alt="">
    </a>
    <nav id="navmenu" class="navmenu">
      <ul>
        <li><a href="#hero" class="active">Beranda</a></li>
        <li><a href="#about">Regulasi</a></li>
        <li><a href="#portfolio">Aktivitas</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
    <a class="btn-getstarted flex-md-shrink-0 me-2" href="{{ route('login') }}">Login</a>
    <a class="btn btn-outline-primary flex-md-shrink-0" href="{{ route('register') }}">Register</a>
  </div>
</header>
