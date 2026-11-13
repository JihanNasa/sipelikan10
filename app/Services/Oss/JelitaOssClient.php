<?php

namespace App\Services\Oss;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Driver produksi: API JELITA DPMPTSP Jabar melalui SPLPD Jawa Barat.
 *
 *   GET {base_url}/dpmptsp-jelita/1.00/nib/proyek/?nib=<NIB>&token=<JELITA token>
 *   Header: apikey: <API key SPLP>
 *
 * Contoh respons sukses (dari Postman collection DPMPTSP, 11 Nov 2026):
 *   {"status":"success","source":"data_oss","data":{"nib":"...","id_proyek":"...",
 *    "nama_perusahaan":"...","uraian_jenis_perusahaan":"...","status_pm":"PMDN",
 *    "skala_usaha":"Usaha Mikro","kab_kota":"Kab. ...","kbli":1499,
 *    "judul_kbli":"...","uraian_resiko_proyek":"Menengah Rendah", ...}}
 *
 * BELUM TERKONFIRMASI (tanyakan ke DPMPTSP/Diskominfo):
 *   - bentuk respons bila NIB tidak ditemukan (saat ini: HTTP 404, atau data kosong);
 *   - apakah satu NIB dengan banyak proyek mengembalikan array (saat ini: ambil yang pertama).
 *
 * Kredensial hanya dibaca dari .env, tidak pernah ditulis ke log.
 */
class JelitaOssClient implements OssClientInterface
{
    public function __construct(private array $config)
    {
    }

    public function cekNib(string $nib): OssNibResult
    {
        $baseUrl = rtrim((string) ($this->config['base_url'] ?? ''), '/');
        $path = '/' . ltrim((string) ($this->config['path'] ?? '/dpmptsp-jelita/1.00/nib/proyek/'), '/');
        $apikey = (string) ($this->config['apikey'] ?? '');
        $token = (string) ($this->config['token'] ?? '');

        if ($baseUrl === '' || $apikey === '' || $token === '') {
            return OssNibResult::gagal($nib, 'Konfigurasi API JELITA belum lengkap (OSS_JELITA_BASE_URL / OSS_JELITA_APIKEY / OSS_JELITA_TOKEN).');
        }

        try {
            $response = Http::withHeaders(['apikey' => $apikey])
                ->acceptJson()
                ->timeout((int) ($this->config['timeout'] ?? 10))
                ->get($baseUrl . $path, ['nib' => $nib, 'token' => $token]);
        } catch (ConnectionException $e) {
            return OssNibResult::gagal($nib, 'Tidak dapat terhubung ke layanan SPLP/JELITA (timeout atau jaringan).');
        } catch (Throwable $e) {
            return OssNibResult::gagal($nib, 'Kesalahan saat memanggil layanan SPLP/JELITA.');
        }

        $code = $response->status();
        $json = $response->json();
        $json = is_array($json) ? $json : [];

        if ($code === 401 || $code === 403) {
            return OssNibResult::gagal($nib, 'Kredensial SPLP/JELITA ditolak (HTTP ' . $code . ').', $code);
        }
        if ($code === 429) {
            return OssNibResult::gagal($nib, 'Melebihi batas permintaan SPLP (HTTP 429).', $code);
        }
        if ($code === 404) {
            return OssNibResult::tidakDitemukan($nib, $code, $this->messageFrom($json) ?? 'NIB tidak ditemukan.', $json);
        }
        if ($code >= 500 || ! $response->successful()) {
            return OssNibResult::gagal($nib, 'Layanan SPLP/JELITA mengembalikan HTTP ' . $code . '.', $code);
        }

        $data = $json['data'] ?? null;
        if (is_array($data) && array_is_list($data)) {
            $data = $data[0] ?? null; // banyak proyek: ambil proyek pertama
        }

        $status = strtolower((string) ($json['status'] ?? ''));
        if (! is_array($data) || empty($data['nib'] ?? null) || ($status !== '' && $status !== 'success')) {
            return OssNibResult::tidakDitemukan($nib, $code, $this->messageFrom($json) ?? 'NIB tidak ditemukan pada data OSS.', $json);
        }

        if ((string) $data['nib'] !== $nib) {
            return OssNibResult::gagal($nib, 'NIB pada respons tidak sama dengan NIB yang dicek.', $code, $json);
        }

        return new OssNibResult(
            status: OssNibResult::TERDAFTAR,
            nib: $nib,
            namaPerusahaan: $this->clean($data['nama_perusahaan'] ?? null),
            jenisPerusahaan: $this->clean($data['uraian_jenis_perusahaan'] ?? null),
            kabKota: $this->clean($data['kab_kota'] ?? null),
            kbli: self::normalizeKbli($data['kbli'] ?? null),
            judulKbli: $this->clean($data['judul_kbli'] ?? null),
            skalaUsaha: $this->clean($data['skala_usaha'] ?? null),
            risiko: $this->clean($data['uraian_resiko_proyek'] ?? null),
            idProyek: $this->clean($data['id_proyek'] ?? null),
            statusPm: $this->clean($data['status_pm'] ?? null),
            httpCode: $code,
            message: null,
            raw: $json,
        );
    }

    /** KBLI dikirim sebagai angka (mis. 1499), sehingga nol di depan hilang. KBLI selalu 5 digit. */
    public static function normalizeKbli(mixed $kbli): ?string
    {
        if ($kbli === null || $kbli === '') {
            return null;
        }
        $kbli = trim((string) $kbli);

        return ctype_digit($kbli) ? str_pad($kbli, 5, '0', STR_PAD_LEFT) : $kbli;
    }

    private function clean(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }
        $value = trim((string) $value);

        return $value === '' ? null : $value;
    }

    private function messageFrom(array $json): ?string
    {
        foreach (['message', 'msg', 'keterangan', 'error'] as $key) {
            if (! empty($json[$key]) && is_string($json[$key])) {
                return mb_substr($json[$key], 0, 250);
            }
        }

        return null;
    }
}
