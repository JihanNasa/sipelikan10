<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationAccountApprovedMail;
use App\Mail\VerificationAccountRejectedMail;
use App\Mail\AccountDeactivatedMail;
use App\Mail\AccountActivatedMail;

class VerifikasiAkunController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || (!auth()->user()->isAdmin() && !auth()->user()->isSuperAdmin())) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $usersUnverified = User::whereNull('email_verified_at')
            ->whereNull('verification_rejected_at')
            ->get();

        // Perbaikan: tampilkan semua user yang sudah diverifikasi, baik aktif maupun nonaktif
        $usersVerified = User::whereNotNull('email_verified_at')->get();

        return view('stisla.verifikasi.index', compact('usersUnverified', 'usersVerified'));
    }

    /** Cek ulang NIB satu UPI ke OSS RBA (tanpa cache), lalu simpan hasilnya. */
    public function cekOss(Request $request, $id, \App\Services\Oss\OssService $oss)
    {
        $user = User::findOrFail($id);

        if (! $oss->enabled()) {
            return redirect()->route('verifikasi.index')->with('error', 'Pengecekan OSS belum diaktifkan (OSS_DRIVER=disabled).');
        }
        if (empty($user->nib)) {
            return redirect()->route('verifikasi.index')->with('error', "UPI {$user->name} belum mengisi NIB.");
        }

        [, $hasil] = $oss->cekUser($user, \App\Services\Oss\OssService::SUMBER_ADMIN, auth()->id());

        $pesan = "NIB {$user->nib} ({$user->name}): " . $hasil->label() . '.';
        if ($hasil->isTerdaftar() && $hasil->namaPerusahaan) {
            $pesan .= " Nama di OSS: {$hasil->namaPerusahaan}.";
        }

        return redirect()->route('verifikasi.index')
            ->with($hasil->status === \App\Services\Oss\OssNibResult::GAGAL ? 'error' : 'success', $pesan);
    }

    public function verify(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->email_verified_at = now();
        $user->email_token = null;
        $user->verification_code = null;
        $user->verification_rejected_at = null;
        $user->save();

        Mail::to($user->email)->send(new VerificationAccountApprovedMail($user));

        return redirect()->route('verifikasi.index')->with('successMessage', 'User berhasil diverifikasi dan email notifikasi telah dikirim.');
    }

    public function reject(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $reason = $request->input('reason', 'Data yang Anda berikan tidak valid atau tidak sesuai.');

        // kirim email penolakan dulu
        Mail::to($user->email)->send(new VerificationAccountRejectedMail($user, $reason));

        // hapus user dari DB
        $user->delete();

        return redirect()->route('verifikasi.index')->with('successMessage', 'User ditolak, dihapus dari sistem, dan email notifikasi telah dikirim.');
    }

    public function deactivate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->is_active = 0;
        $user->save();

        // Kirim email notifikasi nonaktif
        Mail::to($user->email)->send(new AccountDeactivatedMail($user, $request->reason));

        return redirect()->route('verifikasi.index')->with(
            'successMessage',
            'Akun user berhasil dinonaktifkan sementara dan email notifikasi telah dikirim.'
        );
    }

    public function activate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->is_active = 1;
        $user->save();

        // Kirim email notifikasi aktif
        Mail::to($user->email)->send(new AccountActivatedMail($user));

        return redirect()->route('verifikasi.index')->with(
            'successMessage',
            'Akun user berhasil diaktifkan kembali dan email notifikasi telah dikirim.'
        );
    }
}
