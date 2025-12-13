@php
  $isAjax = $isAjax ?? false;
  $isYajra = $isYajra ?? false;
  $isAjaxYajra = $isAjaxYajra ?? false;
@endphp

<table class="table table-striped @if ($isYajra || $isAjaxYajra) yajra-datatable @endif"
  @if ($isYajra || $isAjaxYajra) data-ajax-url="{{ $routeYajra }}?isAjaxYajra={{ $isAjaxYajra }}" 
  @else id="datatable" 
  @endif>
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th>{{ __('Nama UPI') }}</th>
      <th>{{ __('Logo UPI') }}</th>
      <th>{{ __('Nama Penanggung Jawab') }}</th>
      <th>{{ __('Jabatan') }}</th>
      <th>{{ __('No HP') }}</th>
      <th>{{ __('Alamat Lengkap') }}</th>
      <th>{{ __('Alamat Kabupaten') }}</th> {{-- Kolom baru --}}
      <th>{{ __('NIB') }}</th> {{-- Kolom baru --}}
      <th>{{ __('Email') }}</th>
      <th>{{ __('Lokasi Kantor') }}</th> {{-- Kolom baru --}}
      @if ($roleCount > 1)
        <th>{{ __('Role') }}</th>
      @endif
      <th>{{ __('Terakhir Masuk') }}</th>
      @if ($_is_login_must_verified)
        <th>{{ __('Waktu Verifikasi') }}</th>
      @endif
      @if (($canUpdate || $canDelete || ($canForceLogin && $item->id != auth()->id())) && $isExport === false)
        <th>{{ __('Aksi') }}</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $item)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $item->name }}</td>
        <td style="text-align: center;">
          @if ($item->cop_surat)
            <img src="{{ asset($item->cop_surat) }}" width="60" alt="Logo UPI">
          @else
            -
          @endif
        </td>    
        <td>{{ $item->name2 }}</td>
        <td>{{ $item->jabatan }}</td>
        <td>{{ $item->phone_number }}</td>
        <td>{{ $item->address }}</td>
        <td>{{ $item->address2 }}</td> {{-- Data Alamat Kabupaten --}}
        <td>{{ $item->nib }}</td> {{-- Data NIB --}}
        <td>
          <a href="mailto:{{ $item->email }}" target="_blank">
            {{ $item->email }}
          </a>
        </td>
        <td>
          @if ($item->lokasi_kantor_url)
            <a href="{{ $item->lokasi_kantor_url }}" target="_blank" class="btn btn-sm btn-info">
              <i class="fas fa-map-marker-alt"></i> {{ __('Lihat Peta') }}
            </a>
          @else
            -
          @endif
        </td> {{-- Data Lokasi Kantor --}}
        @if ($roleCount > 1)
          <td>
            @foreach ($item->roles as $role)
              @if (auth()->user()->can('Role Ubah'))
                <a class="badge badge-primary mb-1" href="{{ route('user-management.roles.edit', $role->id) }}">{{ $role->name }}</a>
              @else
                <span class="badge badge-primary mb-1">{{ $role->name }}</span>
              @endif
            @endforeach
          </td>
        @endif
        <td>{{ $item->last_login ?? '-' }}</td>
        @if ($_is_login_must_verified)
          <td>{{ $item->email_verified_at ?? '-' }}</td>
        @endif
        @if (($canUpdate || $canDelete || ($canForceLogin && $item->id != auth()->id())) && $isExport === false)
          <td style="width: 150px;">
            @if ($canUpdate)
              @include('stisla.includes.forms.buttons.btn-edit', ['link' => route($routePrefix . '.edit', [$item->id])])
            @endif
            @if ($canDelete)
              @include('stisla.includes.forms.buttons.btn-delete', ['link' => route($routePrefix . '.destroy', [$item->id])])
            @endif
           @if ($canDetail)
              @include('stisla.includes.forms.buttons.btn-detail', ['link' => route($routePrefix . '.show', [$item->id])])
            @endif
            @if ($canForceLogin && $item->id != auth()->id())
              @include('stisla.includes.forms.buttons.btn-success', [
                  'link' => route($routePrefix . '.force-login', [$item->id]),
                  'icon' => 'fa fa-door-open',
                  'title' => 'Force Login',
                  'size' => 'sm',
              ])
            @endif
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>
</table>
