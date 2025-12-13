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
