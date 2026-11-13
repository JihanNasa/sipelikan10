{{-- Status pengecekan NIB ke OSS RBA untuk satu UPI (dipakai di tabel verifikasi akun) --}}
@php
  $ossStatus = $user->oss_status;
  $ossAktif = config('services.oss.driver', 'disabled') !== 'disabled';
  $namaBeda = $user->oss_nama_perusahaan
      && mb_strtolower(trim($user->oss_nama_perusahaan)) !== mb_strtolower(trim((string) $user->name));
@endphp
<span class="badge {{ \App\Services\Oss\OssNibResult::badgeFor($ossStatus) }}">{{ \App\Services\Oss\OssNibResult::labelFor($ossStatus) }}</span>
@if ($user->oss_nama_perusahaan)
  <div class="small mt-1">
    <strong>{{ $user->oss_nama_perusahaan }}</strong><br>
    @if ($user->oss_kbli) KBLI {{ $user->oss_kbli }}@endif
    @if ($user->oss_kab_kota) · {{ $user->oss_kab_kota }}@endif
  </div>
  @if ($user->oss_judul_kbli)
    <div class="small text-muted">{{ $user->oss_judul_kbli }}</div>
  @endif
  @if ($namaBeda)
    <div class="small text-warning"><i class="fas fa-exclamation-triangle"></i> Berbeda dengan nama UPI yang diisi</div>
  @endif
@endif
@if ($user->oss_checked_at)
  <div class="small text-muted">Dicek {{ $user->oss_checked_at->timezone('Asia/Jakarta')->format('d/m/Y H:i') }}</div>
@endif
@if ($ossAktif && $user->nib)
  <form method="POST" action="{{ route('verifikasi.cek-oss', $user->id) }}" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline-primary btn-sm mt-1">
      <i class="fas fa-sync-alt"></i> Cek OSS
    </button>
  </form>
@endif
