@extends('stisla.layouts.app-form')

@section('rowForm')
  @isset($d)
    @method('PUT')
  @endisset

  @csrf
  <div class="row">
      <div class="col-md-6">
        @include('stisla.includes.forms.inputs.input-name', ['required' => true])
      </div>
      <div class="col-md-6">
        @include('stisla.includes.forms.inputs.input', [
            'id' => 'name2',
            'name' => 'name2',
            'label' => __('Contact Person'),
            'type' => 'text',
            'required' => false,
            'icon' => 'fas fa-user',
        ])
      </div>
      <div class="col-md-6">
          @include('stisla.includes.forms.inputs.input', [
              'id' => 'phone_number',
              'name' => 'phone_number',
              'label' => __('No HP'),
              'type' => 'text',
              'required' => false,
              'icon' => 'fas fa-phone',
          ])
      </div>
      <div class="col-md-6">
        @include('stisla.includes.forms.inputs.input', [
            'id' => 'address',
            'name' => 'address',
            'label' => __('Alamat Lengkap Perusahanan'),
            'type' => 'text',
            'required' => false,
            'icon' => 'fas fa-map-marker-alt',
        ])
      </div>
      <div class="col-md-6">
        @include('stisla.includes.forms.inputs.input-nib', [
            'id' => 'nib',
            'name' => 'nib',
            'label' => __('NIB'),
            'type' => 'text',
            'required' => false,
            'icon' => 'fas fa-pen',
        ])
      </div>
      <div class="col-md-6">
        <label for="lokasi_kantor_url">{{ __('Lokasi Kantor (Google Maps URL)') }}</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <i class="fas fa-map-marker-alt"></i>
            </div>
          </div>
          <input
            id="lokasi_kantor_url"
            name="lokasi_kantor_url"
            type="url"
            class="form-control"
            value="{{ old('lokasi_kantor_url', $d->lokasi_kantor_url ?? '') }}"
            placeholder="Contoh: https://maps.app.goo.gl/xxxxxxxxxxxxxx"
          >
          @if (!empty($d->lokasi_kantor_url ?? old('lokasi_kantor_url')))
            <div class="input-group-append">
              <a
                href="{{ $d->lokasi_kantor_url ?? old('lokasi_kantor_url') }}"
                class="btn btn-primary"
                target="_blank"
              >
                <i class="fas fa-map-marked-alt"></i>
                Lihat Lokasi
              </a>
            </div>
          @endif
        </div>
      </div>
      
      @if (count($roleOptions) > 1)
        <div class="col-md-6">
          @include('stisla.includes.forms.selects.select', ['id' => 'role', 'name' => 'role', 'options' => $roleOptions, 'label' => 'Role', 'required' => true])
        </div>
        <div class="col-md-6">
          @include('stisla.includes.forms.selects.select2', [
              'id' => 'role',
              'name' => 'role',
              'options' => $roleOptions,
              'label' => __('Pilih Role'),
              'required' => true,
              'multiple' => true,
          ])
        </div>
          
      @elseif(count($roleOptions) == 1)
        <input type="hidden" name="role" value="{{ collect($roleOptions)->first() }}">
      @endif
      <div class="col-md-6">
        @include('stisla.includes.forms.inputs.input-email')
      </div>
      <div class="col-md-6">
        @include('stisla.includes.forms.inputs.input-password', [
            'hint' => isset($d) ? 'Password bisa dikosongi' : false,
            'required' => !isset($d),
            'value' => isset($d) ? '' : null,
        ])
      </div>
    </div>
  </div>
@endsection
