<div class="form-group">
  <label for="{{ $id ?? 'address2' }}">{{ $label ?? __('Alamat Kabupaten') }}</label>
  <select id="{{ $id ?? 'address2' }}"
          name="{{ $name ?? 'address2' }}"
          class="form-control selectric @error('address2') is-invalid @enderror">
    <option value="" disabled selected>-- Alamat Kabupaten --</option>
    @php $user = $user ?? Auth::user(); @endphp

    <option value="Kabupaten Bandung" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Bandung' ? 'selected' : '' }}>Kabupaten Bandung</option>
    <option value="Kabupaten Bandung Barat" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Bandung Barat' ? 'selected' : '' }}>Kabupaten Bandung Barat</option>
    <option value="Kabupaten Bekasi" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Bekasi' ? 'selected' : '' }}>Kabupaten Bekasi</option>
    <option value="Kabupaten Bogor" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Bogor' ? 'selected' : '' }}>Kabupaten Bogor</option>
    <option value="Kabupaten Ciamis" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Ciamis' ? 'selected' : '' }}>Kabupaten Ciamis</option>
    <option value="Kabupaten Cianjur" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Cianjur' ? 'selected' : '' }}>Kabupaten Cianjur</option>
    <option value="Kabupaten Cirebon" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Cirebon' ? 'selected' : '' }}>Kabupaten Cirebon</option>
    <option value="Kabupaten Garut" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Garut' ? 'selected' : '' }}>Kabupaten Garut</option>
    <option value="Kabupaten Indramayu" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Indramayu' ? 'selected' : '' }}>Kabupaten Indramayu</option>
    <option value="Kabupaten Karawang" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Karawang' ? 'selected' : '' }}>Kabupaten Karawang</option>
    <option value="Kabupaten Kuningan" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Kuningan' ? 'selected' : '' }}>Kabupaten Kuningan</option>
    <option value="Kabupaten Majalengka" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Majalengka' ? 'selected' : '' }}>Kabupaten Majalengka</option>
    <option value="Kabupaten Pangandaran" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Pangandaran' ? 'selected' : '' }}>Kabupaten Pangandaran</option>
    <option value="Kabupaten Purwakarta" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Purwakarta' ? 'selected' : '' }}>Kabupaten Purwakarta</option>
    <option value="Kabupaten Subang" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Subang' ? 'selected' : '' }}>Kabupaten Subang</option>
    <option value="Kabupaten Sukabumi" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Sukabumi' ? 'selected' : '' }}>Kabupaten Sukabumi</option>
    <option value="Kabupaten Sumedang" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Sumedang' ? 'selected' : '' }}>Kabupaten Sumedang</option>
    <option value="Kabupaten Tasikmalaya" {{ old('address2', $user->address2 ?? '') == 'Kabupaten Tasikmalaya' ? 'selected' : '' }}>Kabupaten Tasikmalaya</option>
    <option value="Kota Bandung" {{ old('address2', $user->address2 ?? '') == 'Kota Bandung' ? 'selected' : '' }}>Kota Bandung</option>
    <option value="Kota Banjar" {{ old('address2', $user->address2 ?? '') == 'Kota Banjar' ? 'selected' : '' }}>Kota Banjar</option>
    <option value="Kota Bekasi" {{ old('address2', $user->address2 ?? '') == 'Kota Bekasi' ? 'selected' : '' }}>Kota Bekasi</option>
    <option value="Kota Bogor" {{ old('address2', $user->address2 ?? '') == 'Kota Bogor' ? 'selected' : '' }}>Kota Bogor</option>
    <option value="Kota Cimahi" {{ old('address2', $user->address2 ?? '') == 'Kota Cimahi' ? 'selected' : '' }}>Kota Cimahi</option>
    <option value="Kota Cirebon" {{ old('address2', $user->address2 ?? '') == 'Kota Cirebon' ? 'selected' : '' }}>Kota Cirebon</option>
    <option value="Kota Depok" {{ old('address2', $user->address2 ?? '') == 'Kota Depok' ? 'selected' : '' }}>Kota Depok</option>
    <option value="Kota Sukabumi" {{ old('address2', $user->address2 ?? '') == 'Kota Sukabumi' ? 'selected' : '' }}>Kota Sukabumi</option>
    <option value="Kota Tasikmalaya" {{ old('address2', $user->address2 ?? '') == 'Kota Tasikmalaya' ? 'selected' : '' }}>Kota Tasikmalaya</option>

  </select>

  {{-- Pesan error --}}
  @error('address2')
    <div class="invalid-feedback d-block">{{ $message }}</div>
  @enderror
</div>
