@extends('stisla.layouts.app-auth')

@section('title')
  {{ __('Daftar') }}
@endsection

@section('content')
  <div class="p-4 m-3">
    <div class="align-self-center">
      @include('stisla.includes.auth.auth-header')
      <p class="text-muted">
        {{ __('Sebelum memulai, anda harus mendaftar terlebih dahulu.') }}
      </p>
    </div>

    {{-- FORM REGISTER --}}
    <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate id="formAuth">
      @csrf

      {{-- Nama UPI --}}
      @include('stisla.includes.forms.inputs.input-name', ['required' => true])

      {{-- Nama Penanggung Jawab --}}
      @include('stisla.includes.forms.inputs.input', [
          'id' => 'name2',
          'name' => 'name2',
          'label' => __('Nama Penanggung Jawab'),
          'type' => 'text', 
          'required' => true,
          'icon' => 'fas fa-user',
      ])

      {{-- Jabatan --}}
      @include('stisla.includes.forms.inputs.input-jabatan', [
          'id' => 'jabatan',
          'name' => 'jabatan',
          'label' => __('Jabatan'),
          'type' => 'text',
          'value' => old('jabatan', $user->jabatan ?? ''),
          'required' => true,
          'icon' => 'fas fa-map-marker-alt',
          'placeholder' => '--Pilih Jabatan--',
      ])

      {{-- NIB --}}
      @include('stisla.includes.forms.inputs.input', [
        'id' => 'nib',
        'name' => 'nib',
        'label' => __('NIB'),
        'type' => 'text',
        'value' => old('nib'),
        'required' => true,
        'icon' => 'fas fa-pen',
    ])
      @if (config('services.oss.driver', 'disabled') !== 'disabled')
        {{-- Hasil cek NIB ke OSS RBA (diisi oleh script di bawah) --}}
        <div id="oss-nib-feedback" class="small mb-3" style="margin-top:-12px" role="status" aria-live="polite"></div>
      @endif

      {{-- No HP --}}
      @include('stisla.includes.forms.inputs.input', [
          'id' => 'phone_number',
          'name' => 'phone_number',
          'label' => __('No HP'),
          'type' => 'number',
          'required' => true,
          'icon' => 'fas fa-phone',
      ])

      {{-- Alamat Kabupaten --}}
      @include('stisla.includes.forms.inputs.input-alamat2', [
          'id' => 'address2',
          'name' => 'address2',
          'label' => __('Alamat Kabupaten'),
          'type' => 'text',
          'required' => true,
          'icon' => 'fas fa-map-marker-alt',
      ])

      {{-- Alamat Perusahaan --}}
      @include('stisla.includes.forms.inputs.input', [
          'id' => 'address',
          'name' => 'address',
          'label' => __('Alamat Lengkap Perusahaan'),
          'type' => 'text',
          'required' => true,
          'icon' => 'fas fa-map-marker-alt',
      ])

      {{-- Email --}}
      @include('stisla.includes.forms.inputs.input-email')

      {{-- Password --}}
      @include('stisla.includes.forms.inputs.input-password')

      {{-- Konfirmasi Password --}}
      @include('stisla.includes.forms.inputs.input-password', [
          'id' => 'password_confirmation',
          'label' => 'Konfirmasi Password',
      ])

      {{-- Captcha --}}
      <div class="form-group">
        @include('stisla.auth.gcaptcha')
      </div>

      <div class="form-group text-right">
        @include('stisla.includes.forms.buttons.btn-success', [
            'icon' => 'fas fa-sign-in-alt',
            'label' => __('Sudah punya akun'),
            'link' => route('login'),
        ])
        @include('stisla.includes.forms.buttons.btn-primary', [
            'icon' => 'fas fa-sign-in-alt',
            'label' => __('Daftar'),
            'type' => 'submit'
        ])
      </div>
    </form>

    @include('stisla.includes.auth.auth-footer')
  </div>
@endsection

@include('stisla.auth.script-gcaptcha')

@if (config('services.oss.driver', 'disabled') !== 'disabled')
  @push('scripts')
    <script>
      (function () {
        var input = document.getElementById('nib');
        var box = document.getElementById('oss-nib-feedback');
        var nameInput = document.getElementById('name');
        if (!input || !box) return;
        var lastChecked = null;

        function show(text, cls) {
          box.className = 'small mb-3 ' + cls;
          box.textContent = text;
        }

        function cek() {
          var nib = (input.value || '').trim();
          if (!/^\d{13}$/.test(nib)) { box.textContent = ''; lastChecked = null; return; }
          if (nib === lastChecked) return;
          lastChecked = nib;
          show('Memeriksa NIB ke OSS RBA…', 'text-muted');

          fetch(@json(route('oss.cek-nib')), {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': @json(csrf_token())
            },
            body: JSON.stringify({ nib: nib })
          })
            .then(function (r) {
              if (r.status === 429) throw new Error('limit');
              return r.json();
            })
            .then(function (res) {
              if (!res.enabled) { box.textContent = ''; return; }
              if (res.status === 'terdaftar') {
                var detail = [res.nama_perusahaan, res.kab_kota].filter(Boolean).join(' · ');
                show('✔ ' + res.message + (detail ? ' ' + detail : ''), 'text-success');
                if (nameInput && !nameInput.value && res.nama_perusahaan) {
                  nameInput.value = res.nama_perusahaan;
                }
              } else if (res.status === 'tidak_ditemukan') {
                show(res.message, 'text-danger');
              } else {
                show(res.message, 'text-warning');
              }
            })
            .catch(function (e) {
              lastChecked = null;
              show(e.message === 'limit'
                ? 'Terlalu banyak percobaan. Tunggu sebentar lalu coba lagi.'
                : 'NIB belum dapat dicek saat ini. Anda tetap dapat mendaftar.', 'text-warning');
            });
        }

        input.addEventListener('input', cek);
        input.addEventListener('blur', cek);
        if (input.value) cek();
      })();
    </script>
  @endpush
@endif
