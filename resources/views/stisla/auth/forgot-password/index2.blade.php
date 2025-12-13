@extends('stisla.layouts.app-auth-simple')

@section('title')
  {{ $title = __('Lupa Password') }}
@endsection

@section('content')
    <div class="card-body">
        <p class="text-muted">Masukkan email Anda untuk mereset password</p>

        <form method="POST" action="{{ route('forgot-password') }}" class="needs-validation" novalidate id="formAuth">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        {{-- Captcha --}}
        <div class="form-group">
            @include('stisla.auth.gcaptcha')
        </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Kirim Link Reset
                </button>
            </div>

            {{-- 🔙 Tombol kembali --}}
            <div class="form-group text-center">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg btn-block">
                    <i class="fas fa-arrow-left"></i> Kembali ke Login
                </a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
(function () {
  'use strict';
  const form = document.getElementById('formAuth');
  form.addEventListener('submit', function (event) {
    if (!form.checkValidity()) {
      event.preventDefault();
      event.stopPropagation();
    }
    form.classList.add('was-validated');
  }, false);
})();
</script>
@endpush

@include('stisla.auth.script-gcaptcha')
