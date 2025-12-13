<!DOCTYPE html>
<html lang="en">

<head>

  @include('stisla.includes.others.meta-title')
    <!-- Anti cache - diperkuat -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate, private" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta http-equiv="X-Accel-Expires" content="0" />
    
    <!-- Security headers -->
    <meta http-equiv="X-Content-Type-Options" content="nosniff" />
    <meta http-equiv="X-Frame-Options" content="DENY" />
    <meta http-equiv="X-XSS-Protection" content="1; mode=block" />
    <meta name="referrer" content="strict-origin-when-cross-origin" />
  @include('stisla.includes.others.css')

</head>
{{-- {{ dd($_stisla_sidebar_mini) }} --}}

<body class="{{ $_stisla_sidebar_mini == 1 ? 'sidebar-mini' : '' }}">
  <div id="app">
    <div class="main-wrapper">
      @include('stisla.includes.others.navbar')
      @include('stisla.includes.others.sidebar')

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @yield('content')
        </section>
      </div>
      @include('stisla.includes.others.footer')
    </div>
  </div>

  @include('stisla.includes.others.js')

</body>

</html>
