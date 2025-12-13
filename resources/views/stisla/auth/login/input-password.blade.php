<div class="form-group">
  <label for="password">Password
    <span class="text-danger">*</span>
  </label>
  @if ($_is_forgot_password_send_to_email)
    <div class="float-right">
      <a href="{{ route('forgot-password') }}" class="text-small">
        {{ __('Lupa Password?') }}
      </a>
    </div>
  @endif

  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text {{ $errors->has('password') ? 'border-danger' : '' }}">
        <i class="fas fa-key"></i>
      </div>
    </div>
    <input id="password" name="password" required type="password"
      class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" aria-autocomplete="list">

    {{-- Tombol toggle password --}}
    <div class="input-group-append">
      <button type="button" class="btn btn-outline-secondary" id="togglePassword">
        <i class="fas fa-eye"></i>
      </button>
    </div>
  </div>

  @error('password')
    <div id="password-error-feedback" class="text-danger" for="password">
      {{ $message }}
    </div>
  @enderror
</div>

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggleBtn = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    toggleBtn.addEventListener("click", function () {
      const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);

      // Ganti icon
      this.querySelector("i").classList.toggle("fa-eye");
      this.querySelector("i").classList.toggle("fa-eye-slash");
    });
  });
</script>
@endpush
