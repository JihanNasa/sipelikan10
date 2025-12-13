<div class="form-group">
  <label for="{{ $id ?? 'password' }}">{{ $label ?? 'Password' }}</label>
  <div class="input-group">
    <div class="input-group-prepend">
      <div class="input-group-text">
        <i class="fas fa-key"></i>
      </div>
    </div>
    <input id="{{ $id ?? 'password' }}" 
           type="password" 
           class="form-control" 
           name="{{ $id ?? 'password' }}" 
           {{ ($required ?? true) ? 'required' : '' }}
           onkeyup="validatePassword(this.value, '{{ $id ?? 'password' }}')">

    {{-- Show/Hide password --}}
    <div class="input-group-append">
      <span class="input-group-text bg-transparent border-0" style="cursor: pointer;"
      onclick="togglePassword('{{ $id ?? 'password' }}')">
          <i class="fas fa-eye" id="toggleIcon-{{ $id ?? 'password' }}"></i>
        </a>
      </span>
    </div>
  </div>

  {{-- Tempat pesan error --}}
  <small id="passwordHelp-{{ $id ?? 'password' }}" class="form-text text-danger"></small>
</div>

@once
  @push('scripts')
  <script>
    function togglePassword(id) {
      const input = document.getElementById(id);
      const icon = document.getElementById('toggleIcon-' + id);
      if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
      }
    }

    function validatePassword(password, id) {
      const help = document.getElementById("passwordHelp-" + id);
      let errors = [];

      if (password.length < 8) {
        errors.push("Minimal 8 karakter");
      }
      if (!/[a-z]/.test(password)) {
        errors.push("Harus ada huruf kecil");
      }
      if (!/[A-Z]/.test(password)) {
        errors.push("Harus ada huruf besar");
      }
      if (!/[0-9]/.test(password)) {
        errors.push("Harus ada angka");
      }
      if (!/[@$!%*?&]/.test(password)) {
        errors.push("Harus ada karakter spesial (@$!%*?&)");
      }

      help.innerHTML = errors.length > 0 ? errors.join("<br>") : "";
    }
  </script>
  @endpush
@endonce
