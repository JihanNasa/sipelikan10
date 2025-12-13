<div class="form-group">
  <label for="{{ $id ?? 'jabatan' }}">{{ $label ?? __('Jabatan') }}</label>
  <select id="{{ $id ?? 'jabatan' }}"
          name="{{ $name ?? 'jabatan' }}"
          class="form-control selectric @error('jabatan') is-invalid @enderror">
    <option value="" disabled selected>-- Pilih Jabatan --</option>
    @php $user = $user ?? Auth::user(); @endphp

    <option value="Direktur" {{ old('jabatan', $user->jabatan ?? '') == 'Direktur' ? 'selected' : '' }}>Direktur</option>
    <option value="Admin Staff" {{ old('jabatan', $user->jabatan ?? '') == 'Admin Staff' ? 'selected' : '' }}>Admin Staff</option>
    <option value="Staff" {{ old('jabatan', $user->jabatan ?? '') == 'Staff' ? 'selected' : '' }}>Staff</option>
    <option value="Manager" {{ old('jabatan', $user->jabatan ?? '') == 'Manager' ? 'selected' : '' }}>Manager</option>
    <option value="Supervisor" {{ old('jabatan', $user->jabatan ?? '') == 'Supervisor' ? 'selected' : '' }}>Supervisor</option>
    <option value="Koordinator" {{ old('jabatan', $user->jabatan ?? '') == 'Koordinator' ? 'selected' : '' }}>Koordinator</option>
    <option value="Asisten" {{ old('jabatan', $user->jabatan ?? '') == 'Asisten' ? 'selected' : '' }}>Asisten</option>
  </select>
</div>
  {{-- Pesan error --}}
  @error('jabatan')
    <div class="invalid-feedback d-block">{{ $message }}</div>
  @enderror