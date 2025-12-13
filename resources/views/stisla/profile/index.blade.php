@php
  $_superadmin_account = \App\Models\User::find(1);
  $_is_superadmin = auth()->id() == $_superadmin_account->id;
@endphp

@extends('stisla.layouts.app')

@section('title')
  {{ $title = 'Profil' }}
@endsection

@section('content')
    @include('stisla.includes.breadcrumbs.breadcrumb-table')

    <div class="section-body">
    <h2 class="section-title">{{ $title }}</h2>
    <p class="section-lead">{{ __('Perbarui kapan saja profil anda di halaman ini') }}.</p>
    <div class="row">
      <div class="col-12">
      {{-- Form utama untuk memperbarui profil --}}
      <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="needs-validation">
        <div class="card">
        <div class="card-header">
          <h4> <i class="fa fa-user"></i> {{ $title }}</h4>
        </div>
        <div class="card-body">
          @method('PUT')
          @csrf
          <div class="row">
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-name', ['value' => $user->name, 'required' => true])
          </div>
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input', [
              'id' => 'name2',
              'name' => 'name2',
              'label' => __('Nama Penanggung Jawab'),
              'type' => 'text',
              'value' => old('nama2', $user->name2 ?? ''),
              'required' => false,
              'icon' => 'fas fa-user',
            ])
          </div>
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-jabatan', [
              'id' => 'jabatan',
              'name' => 'jabatan',
              'label' => __('Jabatan'),
              'type' => 'text',
              'value' => old('jabatan', $user->jabatan ?? ''),
              'required' => false,
              'icon' => 'fas fa-map-marker-alt',
              'placeholder' => '--Pilih Jabatan--',
            ])
          </div>
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-nib', [
            'id' => 'nib',
            'name' => 'nib',
            'label' => __('NIB'),
            'type' => 'text',
            'value' => old('nib', $user->nib ?? ''),
            'required' => false,
            'icon' => 'fas fa-pen',
            ])
            </div>
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-avatar', ['required' => false])
          </div>
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-kopsurat', ['required' => false])
          </div>

          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input', [
              'id' => 'phone_number',
              'name' => 'phone_number',
              'label' => __('No HP'),
              'type' => 'text',
              'value' => old('phone_number', $user->phone_number ?? ''),
              'required' => false,
              'icon' => 'fas fa-phone',
            ])

          </div>

          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input', [
              'id' => 'address',
              'name' => 'address',
              'label' => __('Alamat Lengkap Perusahaan'),
              'type' => 'text',
              'value' => old('address', $user->address ?? ''),
             'required' => false,
              'icon' => 'fas fa-map-marker-alt',
            ])
          </div>

            <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-alamat2', [
              'id' => 'address2',
              'name' => 'address2',
              'label' => __('Alamat Kabupaten'),
              'type' => 'text',
              'value' => old('address2', $user->address2 ?? ''),
              'required' => false,
              'icon' => 'fas fa-map-marker-alt',
              'placeholder' => '--Pilih Kabupaten--',
            ])
            </div>
            <div class="col-md-6">
            {{-- Input untuk Lokasi Kantor (Google Maps URL) --}}
            @include('stisla.includes.forms.inputs.input', [
              'id' => 'lokasi_kantor_url',
              'name' => 'lokasi_kantor_url',
              'label' => __('Lokasi Kantor (Google Maps URL)'),
              'type' => 'url',
              'value' => old('lokasi_kantor_url', $user->lokasi_kantor_url ?? ''),
              'required' => false,
              'icon' => 'fas fa-map-marker-alt',
              'placeholder' => 'Contoh: https://maps.app.goo.gl/xxxxxxxxxxxxxx',
            ])
            </div>
          <div class="col-md-12">
            @include('stisla.includes.forms.buttons.btn-save')
            @include('stisla.includes.forms.buttons.btn-reset')
          </div>
          </div>
        </div>
        </div>
      </form>
      </div>



      {{-- Bagian untuk menampilkan lokasi kantor (opsional) --}}
      {{-- Ini adalah kode yang Anda minta untuk diintegrasikan --}}
      @if ($user->cop_surat)
    <div class="col-12 mt-4"> {{-- Menggunakan col-12 dan mt-4 untuk spasi --}}
      <div class="card">
      <div class="card-header">
      <h4>{{ __('Logo UPI') }}</h4>
      </div>
      <div class="card-body">
      <p>
      <a href="{{ $user->cop_surat }}" target="_blank" class="btn btn-info">
        <i class="fas fa-file-image"></i> {{ __('Lihat Logo UPI Anda!') }}
      </a>
      </p>
      {{-- Jika Anda ingin menyematkan peta langsung, gunakan iframe (hanya jika URL adalah embed link) --}}
      @if (Str::contains($user->cop_surat, 'google.com/maps/embed'))
      <div class="embed-responsive embed-responsive-16by9">
        <iframe class="embed-responsive-item" src="{{ $user->cop_surat }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      @else
    <p class="text-muted">{{ __('Ini adalah Logo UPI anda yang sudah diupload. Klik tombol di atas untuk melihatnya.') }}</p>
    @endif
      </div>
      </div>
    </div>
    @endif

      @if ($user->lokasi_kantor_url)
      <div class="col-12 mt-4"> {{-- Menggunakan col-12 dan mt-4 untuk spasi --}}
        <div class="card">
        <div class="card-header">
          <h4>{{ __('Lokasi Kantor Anda') }}</h4>
        </div>
        <div class="card-body">
          <p>
          <a href="{{ $user->lokasi_kantor_url }}" target="_blank" class="btn btn-info">
            <i class="fas fa-map-marker-alt"></i> {{ __('Lihat di Google Maps') }}
          </a>
          </p>
          {{-- Jika Anda ingin menyematkan peta langsung, gunakan iframe (hanya jika URL adalah embed link) --}}
          @if (Str::contains($user->lokasi_kantor_url, 'google.com/maps/embed'))
          <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive-item" src="{{ $user->lokasi_kantor_url }}" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          @else
          <p class="text-muted">{{ __('Untuk menampilkan peta interaktif langsung di sini, silakan masukkan link pada --Lokasi Kantor (Google Maps URL)-- atau (Embed a map) yang Anda dapatkan dari Google Maps.') }}</p>
          @endif
        </div>
        </div>
      </div>
      @endif

      <div class="col-12">
      @if (config('app.is_demo') && $_is_superadmin)
        <div class="alert alert-info alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
          <div class="alert-title">{{ __('Informasi') }}</div>
          Dalam versi demo email dan password tidak bisa diubah
        </div>
        </div>
      @endif
      </div>

      <div class="col-12">
      <form action="{{ route('profile.update-email') }}" method="post" class="needs-validation" id="formEmail">
        <div class="card">
        <div class="card-header">
          <h4> <i class="fa fa-envelope"></i> {{ __('Perbarui Email') }}</h4>
        </div>
        <div class="card-body">
          @method('PUT')
          @csrf
          <div class="row">
          @if ($user->twitter_id)
            <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input', ['value' => $user->twitter_id, 'label' => 'Twitter ID', 'disabled' => true])
            </div>
          @endif
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-email', ['value' => $user->email])
          </div>

          @if (!($_is_superadmin && config('app.is_demo')))
            <div class="col-md-12">
            @include('stisla.includes.forms.buttons.btn-save')
            @include('stisla.includes.forms.buttons.btn-reset')
            </div>
          @endif
          </div>
        </div>
        </div>

      </form>
      </div>

      <div class="col-12">
      <div class="alert alert-{{ $totalDay > 30 ? 'danger' : 'info' }} alert-has-icon">
        <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
        <div class="alert-body">
        <div class="alert-title">{{ __('Informasi') }}</div>
        {{ __('Password terakhir kali diperbarui pada ') . $user->last_password_change }}
        @if ($totalDay > 30)
          <br>
          {{ __('Kami merekomendasikan password diganti per 30 hari') }}
        @endif
        </div>
      </div>
      <form action="{{ route('profile.update-password') }}" method="post" class="needs-validation" id="formPassword">
        <div class="card">
        <div class="card-header">
          <h4> <i class="fa fa-key"></i> {{ __('Perbarui Password') }}</h4>
        </div>
        <div class="card-body">
          @method('PUT')
          @csrf
          <div class="row">
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-password', ['value' => '', 'id' => 'old_password', 'label' => __('Password Lama')])
          </div>
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-password', ['value' => '', 'id' => 'new_password', 'label' => __('Password Baru')])
          </div>
          <div class="col-md-6">
            @include('stisla.includes.forms.inputs.input-password', ['value' => '', 'id' => 'new_password_confirmation', 'label' => __('Konfirmasi Password Baru')])
          </div>

          @if (!($_is_superadmin && config('app.is_demo')))
            <div class="col-md-12">
            @include('stisla.includes.forms.buttons.btn-save')
            @include('stisla.includes.forms.buttons.btn-reset')
            </div>
          @endif

          </div>
        </div>
        </div>

      </form>
      </div>
    </div>
    </div>
@endsection

@push('css')
<style>
    .custom-file-label::after {
        content: "{{ __('Pilih file') }}";
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        bsCustomFileInput.init()
    });
</script>
@if ($_is_superadmin && config('app.is_demo'))
  @push('scripts')
    <script>
      $(function() {
        $('#formEmail').find('input').attr('disabled', true)
        $('#formPassword').find('input').attr('disabled', true)
      })
    </script>
  @endpush
@endif
