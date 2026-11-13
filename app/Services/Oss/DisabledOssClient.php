<?php

namespace App\Services\Oss;

/** Driver bawaan: tidak ada pengecekan, perilaku aplikasi sama seperti sebelum fitur ini ada. */
class DisabledOssClient implements OssClientInterface
{
    public function cekNib(string $nib): OssNibResult
    {
        return OssNibResult::nonaktif($nib);
    }
}
