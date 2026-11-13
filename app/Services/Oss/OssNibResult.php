<?php

namespace App\Services\Oss;

/**
 * Hasil pengecekan satu NIB ke OSS RBA (melalui JELITA DPMPTSP / SPLPD Jabar).
 * Formatnya seragam untuk semua driver, sehingga bagian lain aplikasi
 * tidak perlu tahu dari mana data berasal.
 */
class OssNibResult
{
    public const TERDAFTAR = 'terdaftar';
    public const TIDAK_DITEMUKAN = 'tidak_ditemukan';
    public const GAGAL = 'gagal';
    public const NONAKTIF = 'nonaktif';

    public function __construct(
        public string $status,
        public string $nib,
        public ?string $namaPerusahaan = null,
        public ?string $jenisPerusahaan = null,
        public ?string $kabKota = null,
        public ?string $kbli = null,
        public ?string $judulKbli = null,
        public ?string $skalaUsaha = null,
        public ?string $risiko = null,
        public ?string $idProyek = null,
        public ?string $statusPm = null,
        public ?int $httpCode = null,
        public ?string $message = null,
        public array $raw = [],
    ) {
    }

    public static function nonaktif(string $nib): self
    {
        return new self(self::NONAKTIF, $nib, message: 'Pengecekan OSS tidak diaktifkan (OSS_DRIVER=disabled).');
    }

    public static function gagal(string $nib, string $message, ?int $httpCode = null, array $raw = []): self
    {
        return new self(self::GAGAL, $nib, httpCode: $httpCode, message: $message, raw: $raw);
    }

    public static function tidakDitemukan(string $nib, ?int $httpCode = null, ?string $message = null, array $raw = []): self
    {
        return new self(self::TIDAK_DITEMUKAN, $nib, httpCode: $httpCode, message: $message, raw: $raw);
    }

    public function isTerdaftar(): bool
    {
        return $this->status === self::TERDAFTAR;
    }

    public function isTidakDitemukan(): bool
    {
        return $this->status === self::TIDAK_DITEMUKAN;
    }

    /** Hasil yang pasti (terdaftar / tidak ditemukan) boleh disimpan di cache; gangguan koneksi tidak. */
    public function isDefinitive(): bool
    {
        return in_array($this->status, [self::TERDAFTAR, self::TIDAK_DITEMUKAN], true);
    }

    public function label(): string
    {
        return self::labelFor($this->status);
    }

    public static function labelFor(?string $status): string
    {
        return match ($status) {
            self::TERDAFTAR => 'Terdaftar di OSS',
            self::TIDAK_DITEMUKAN => 'Tidak ditemukan di OSS',
            self::GAGAL => 'Gagal dicek',
            self::NONAKTIF => 'Pengecekan nonaktif',
            default => 'Belum dicek',
        };
    }

    /**
     * Bandingkan nama UPI dengan nama di OSS tanpa memperhitungkan huruf besar/kecil,
     * tanda baca, dan awalan/akhiran badan usaha (PT, CV, UD, Koperasi, Yayasan, Tbk, dll).
     * Contoh: "PT Aneka Dasuib Jaya" dianggap sama dengan "ANEKA DASUIB JAYA".
     */
    public static function namaSama(?string $a, ?string $b): bool
    {
        $na = self::normalisasiNama($a);
        $nb = self::normalisasiNama($b);

        if ($na === '' || $nb === '') {
            return true; // tidak ada pembanding, jangan tampilkan peringatan
        }

        return $na === $nb;
    }

    public static function normalisasiNama(?string $nama): string
    {
        $nama = mb_strtolower((string) $nama);
        $nama = preg_replace('/[^\p{L}\p{N}\s]+/u', ' ', $nama);
        $kataBadanUsaha = ['pt', 'cv', 'ud', 'fa', 'firma', 'tbk', 'persero', 'perum', 'perumda', 'koperasi', 'kop', 'ksu', 'kud', 'yayasan', 'pd'];
        $kata = array_filter(
            preg_split('/\s+/u', trim($nama)) ?: [],
            fn ($k) => $k !== '' && ! in_array($k, $kataBadanUsaha, true)
        );

        return implode(' ', $kata);
    }

    /** Kelas badge Bootstrap/Stisla untuk tiap status. */
    public static function badgeFor(?string $status): string
    {
        return match ($status) {
            self::TERDAFTAR => 'badge-success',
            self::TIDAK_DITEMUKAN => 'badge-danger',
            self::GAGAL => 'badge-warning',
            default => 'badge-light',
        };
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public static function fromArray(array $data): self
    {
        return new self(...$data);
    }
}
