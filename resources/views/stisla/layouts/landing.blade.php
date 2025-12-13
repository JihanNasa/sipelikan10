<!DOCTYPE html>
<html lang="en">

<head>
  @include('stisla.includes.others.landing-meta-title')
  @include('stisla.includes.others.landing-css')
</head>

<body class="index-page">
  <header id="header" class="header d-flex align-items-center fixed-top">
    @include('stisla.includes.others.landing-navbar')
  </header>

  <main class="main">
    @yield('content')
  </main>

  @include('stisla.includes.others.landing-footer')
  @include('stisla.includes.others.landing-js')
</body>

</html>
