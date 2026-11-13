<?php

namespace App\Services\Oss;

interface OssClientInterface
{
    /**
     * Cek satu NIB (13 digit) ke sumber data OSS.
     * Implementasi TIDAK boleh melempar exception untuk gangguan koneksi;
     * kembalikan OssNibResult::gagal(...) sebagai gantinya.
     */
    public function cekNib(string $nib): OssNibResult;
}
