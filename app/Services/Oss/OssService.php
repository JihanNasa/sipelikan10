<?php

namespace App\Services\Oss;

use App\Models\OssCheckLog;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Satu-satunya pintu yang dipakai bagian lain aplikasi untuk cek NIB.
 * Mengatur cache, pencatatan riwayat (oss_check_logs), dan penyimpanan hasil ke tabel users.
 */
class OssService
{
    public const SUMBER_REGISTRASI = 'registrasi';
    public const SUMBER_FORM = 'form';
    public const SUMBER_ADMIN = 'admin';
    public const SUMBER_JADWAL = 'jadwal';

    public function __construct(private OssClientInterface $client, private array $config)
    {
    }

    public function enabled(): bool
    {
        return ($this->config['driver'] ?? 'disabled') !== 'disabled';
    }

    public function strict(): bool
    {
        return (bool) ($this->config['strict'] ?? false);
    }

    /**
     * Cek NIB. Hasil pasti (terdaftar / tidak ditemukan) disimpan di cache.
     * Tidak pernah melempar exception: gangguan apa pun menjadi status "gagal".
     */
    public function cek(string $nib, string $sumber, ?User $user = null, ?int $checkedBy = null, bool $fresh = false): OssNibResult
    {
        $nib = trim($nib);
        if (! preg_match('/^\d{13}$/', $nib)) {
            return OssNibResult::gagal($nib, 'Format NIB tidak valid (harus 13 digit angka).');
        }
        if (! $this->enabled()) {
            return OssNibResult::nonaktif($nib);
        }

        $key = 'oss:nib:' . $nib;
        $fromCache = false;
        $result = null;

        if (! $fresh && ($cached = Cache::get($key)) && is_array($cached)) {
            $result = OssNibResult::fromArray($cached);
            $fromCache = true;
        }

        if (! $result) {
            try {
                $result = $this->client->cekNib($nib);
            } catch (Throwable $e) {
                Log::warning('OSS cek NIB error: ' . $e->getMessage());
                $result = OssNibResult::gagal($nib, 'Kesalahan internal saat cek NIB.');
            }
            if ($result->isDefinitive()) {
                Cache::put($key, $result->toArray(), now()->addMinutes((int) ($this->config['cache_minutes'] ?? 720)));
            }
        }

        if (! $fromCache) {
            $this->catat($result, $sumber, $user, $checkedBy);
        }

        return $result;
    }

    /** Simpan hasil cek ke kolom oss_* milik user. Hasil "gagal" tidak menimpa data OSS yang sudah ada. */
    public function terapkanKeUser(User $user, OssNibResult $result): void
    {
        if ($result->status === OssNibResult::NONAKTIF) {
            return;
        }

        $user->oss_checked_at = now();

        if ($result->status === OssNibResult::GAGAL) {
            if (empty($user->oss_status)) {
                $user->oss_status = OssNibResult::GAGAL;
            }
            $user->save();

            return;
        }

        $user->oss_status = $result->status;
        $user->oss_nama_perusahaan = $result->namaPerusahaan;
        $user->oss_kab_kota = $result->kabKota;
        $user->oss_kbli = $result->kbli;
        $user->oss_judul_kbli = $result->judulKbli;
        $user->oss_skala_usaha = $result->skalaUsaha;
        $user->oss_id_proyek = $result->idProyek;
        $user->oss_payload = $result->isTerdaftar() ? $this->ringkas($result) : null;
        $user->save();
    }

    /** Cek NIB milik user lalu simpan hasilnya. Mengembalikan status lama dan baru (untuk deteksi perubahan). */
    public function cekUser(User $user, string $sumber, ?int $checkedBy = null, bool $fresh = true): array
    {
        $statusLama = $user->oss_status;
        $result = $this->cek((string) $user->nib, $sumber, $user, $checkedBy, $fresh);
        $this->terapkanKeUser($user, $result);

        return [$statusLama, $result];
    }

    /** Riwayat cek dari formulir registrasi dibuat sebelum akun ada; kaitkan ke akun yang baru dibuat. */
    public function kaitkanRiwayat(User $user): void
    {
        if (empty($user->nib)) {
            return;
        }

        OssCheckLog::whereNull('user_id')
            ->where('nib', $user->nib)
            ->whereIn('sumber', [self::SUMBER_FORM, self::SUMBER_REGISTRASI])
            ->where('created_at', '>=', now()->subDay())
            ->update(['user_id' => $user->id]);
    }

    /** Data yang disimpan untuk audit: hanya field perusahaan, tanpa data pribadi. */
    private function ringkas(OssNibResult $r): array
    {
        return array_filter([
            'nib' => $r->nib,
            'id_proyek' => $r->idProyek,
            'nama_perusahaan' => $r->namaPerusahaan,
            'jenis_perusahaan' => $r->jenisPerusahaan,
            'status_pm' => $r->statusPm,
            'skala_usaha' => $r->skalaUsaha,
            'kab_kota' => $r->kabKota,
            'kbli' => $r->kbli,
            'judul_kbli' => $r->judulKbli,
            'risiko' => $r->risiko,
        ], fn ($v) => $v !== null);
    }

    private function catat(OssNibResult $result, string $sumber, ?User $user, ?int $checkedBy): void
    {
        try {
            OssCheckLog::create([
                'user_id' => $user?->id,
                'nib' => $result->nib,
                'status' => $result->status,
                'http_code' => $result->httpCode,
                'sumber' => $sumber,
                'message' => $result->message ? mb_substr($result->message, 0, 250) : null,
                'checked_by' => $checkedBy,
            ]);
        } catch (Throwable $e) {
            Log::warning('Gagal mencatat oss_check_logs: ' . $e->getMessage());
        }
    }
}
