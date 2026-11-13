<?php

namespace App\Services\Oss;

/**
 * Driver uji coba, tanpa koneksi ke luar. Datanya FIKTIF.
 *  - NIB berakhiran 0     : gagal koneksi (mensimulasikan layanan OSS tidak dapat diakses)
 *  - NIB berakhiran ganjil: terdaftar
 *  - NIB berakhiran genap : tidak ditemukan
 */
class DummyOssClient implements OssClientInterface
{
    public function cekNib(string $nib): OssNibResult
    {
        $last = (int) substr($nib, -1);

        if ($last === 0) {
            return OssNibResult::gagal($nib, 'Simulasi: layanan OSS tidak dapat diakses.');
        }

        if ($last % 2 === 0) {
            return OssNibResult::tidakDitemukan($nib, 200, 'Simulasi: NIB tidak ditemukan.');
        }

        return new OssNibResult(
            status: OssNibResult::TERDAFTAR,
            nib: $nib,
            namaPerusahaan: 'CONTOH OLAHAN IKAN (DATA UJI COBA)',
            jenisPerusahaan: 'Perseroan Terbatas (PT)',
            kabKota: 'Kab. Contoh',
            kbli: '10213',
            judulKbli: 'Data uji coba',
            skalaUsaha: 'Usaha Mikro',
            risiko: 'Menengah Rendah',
            idProyek: 'R-UJICOBA',
            statusPm: 'PMDN',
            httpCode: 200,
            message: 'Data uji coba (OSS_DRIVER=dummy).',
        );
    }
}
