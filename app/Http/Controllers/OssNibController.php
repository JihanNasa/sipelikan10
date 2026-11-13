<?php

namespace App\Http\Controllers;

use App\Services\Oss\OssNibResult;
use App\Services\Oss\OssService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Endpoint cek NIB untuk formulir registrasi (dipanggil lewat JavaScript).
 * Endpoint ini publik (dipakai calon pengguna yang belum login), jadi:
 *  - dibatasi jumlah permintaannya (throttle, lihat routes/stisla-web.php);
 *  - hanya mengembalikan data seperlunya: status, nama perusahaan, kab/kota.
 */
class OssNibController extends Controller
{
    public function cek(Request $request, OssService $oss): JsonResponse
    {
        $data = $request->validate(['nib' => ['required', 'digits:13']], [
            'nib.required' => 'NIB wajib diisi.',
            'nib.digits' => 'NIB harus 13 digit angka.',
        ]);

        if (! $oss->enabled()) {
            return response()->json(['enabled' => false]);
        }

        $result = $oss->cek($data['nib'], OssService::SUMBER_FORM);

        $message = match ($result->status) {
            OssNibResult::TERDAFTAR => 'NIB terdaftar di OSS RBA.',
            OssNibResult::TIDAK_DITEMUKAN => $oss->strict()
                ? 'NIB tidak ditemukan di OSS RBA. Registrasi tidak dapat dilanjutkan dengan NIB ini.'
                : 'NIB tidak ditemukan di OSS RBA. Anda tetap dapat mendaftar; admin akan memeriksa data Anda.',
            default => 'Layanan OSS sedang tidak dapat diakses. Anda tetap dapat mendaftar; admin akan memeriksa NIB Anda.',
        };

        return response()->json([
            'enabled' => true,
            'status' => $result->status,
            'message' => $message,
            'nama_perusahaan' => $result->isTerdaftar() ? $result->namaPerusahaan : null,
            'kab_kota' => $result->isTerdaftar() ? $result->kabKota : null,
        ]);
    }
}
