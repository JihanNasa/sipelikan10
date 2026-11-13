<?php

namespace App\Rules;

use App\Services\Oss\OssService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Hanya menolak bila OSS_STRICT=true DAN OSS menyatakan NIB tidak ditemukan.
 * Gangguan koneksi atau fitur nonaktif tidak pernah menghalangi registrasi.
 * Dalam mode longgar (bawaan), NIB yang tidak ditemukan diterima lalu ditandai untuk admin.
 */
class NibTerdaftarOss implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $service = app(OssService::class);

        if (! $service->enabled() || ! $service->strict() || ! preg_match('/^\d{13}$/', (string) $value)) {
            return;
        }

        $result = $service->cek((string) $value, OssService::SUMBER_REGISTRASI);

        if ($result->isTidakDitemukan()) {
            $fail('NIB tidak terdaftar di OSS RBA. Periksa kembali NIB Anda atau hubungi admin SiPelikan.');
        }
    }
}
