@extends('stisla.layouts.app-auth-simple')

@section('title')
  {{ $title = __('Reset Password') }}
@endsection

@section('content')
<div class="card-body">

    {{-- Pesan sukses atau error --}}
    @if (session('successMessage'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('successMessage') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('errorMessage'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errorMessage') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form method="POST" action="{{ route('reset-password', $token) }}" class="needs-validation" novalidate>
        @csrf

        {{-- Password Baru --}}
        <div class="form-group">
            <label for="password">Password Baru</label>
            <div class="input-group">
                <input id="password" type="password" 
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required autofocus>
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mt-2">
                <small id="passwordHelp" class="form-text text-muted">
                    Password harus memiliki minimal:
                    <ul class="mb-0">
                        <li id="rule-length">8 karakter</li>
                        <li id="rule-lower">Huruf kecil</li>
                        <li id="rule-upper">Huruf besar</li>
                        <li id="rule-number">Angka</li>
                        <li id="rule-special">Karakter spesial (@$!%*?&)</li>
                    </ul>
                </small>
            </div>
        </div>

        {{-- Konfirmasi Password --}}
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-group">
                <input id="password_confirmation" type="password" 
                       class="form-control" name="password_confirmation" required>
                <div class="input-group-append">
                    <button type="button" class="btn btn-outline-secondary toggle-password" data-target="#password_confirmation">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
                <div class="invalid-feedback">Konfirmasi password wajib diisi</div>
            </div>
        </div>

        {{-- Captcha --}}
        <div class="form-group">
            @include('stisla.auth.gcaptcha')
        </div>

        {{-- Submit --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Atur Ulang</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');

    // Validasi password rules
    const rules = {
        length: document.getElementById('rule-length'),
        lower: document.getElementById('rule-lower'),
        upper: document.getElementById('rule-upper'),
        number: document.getElementById('rule-number'),
        special: document.getElementById('rule-special'),
    };

    passwordInput.addEventListener('input', function() {
        const val = passwordInput.value;

        rules.length.style.color  = val.length >= 8 ? 'green' : 'red';
        rules.lower.style.color   = /[a-z]/.test(val) ? 'green' : 'red';
        rules.upper.style.color   = /[A-Z]/.test(val) ? 'green' : 'red';
        rules.number.style.color  = /[0-9]/.test(val) ? 'green' : 'red';
        rules.special.style.color = /[@$!%*?&]/.test(val) ? 'green' : 'red';
    });

    // Toggle show/hide password
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function() {
            const target = document.querySelector(this.getAttribute('data-target'));
            const type = target.getAttribute('type') === 'password' ? 'text' : 'password';
            target.setAttribute('type', type);

            const icon = this.querySelector('i');
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
});
</script>
@endpush
