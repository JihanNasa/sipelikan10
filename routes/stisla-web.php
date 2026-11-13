<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VerifikasiAkunController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\YoutubeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'landingpage'])->name('landing.index');

# DASHBOARD
Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
// Route::get('/', [DashboardController::class, 'home'])->name('home');
Route::get('/landing/chart-data', [DashboardController::class, 'landingChartData'])->name('landing.chart-data');

// Auth routes (login, register, etc.) - pastikan tidak di-cache
Route::middleware(['guest.only'])->group(function () {
  Route::get('login', [AuthController::class, 'loginForm'])->name('login');
  Route::post('login', [AuthController::class, 'login'])->name('login.post');
  Route::get('register', [AuthController::class, 'registerForm'])->name('register');
  Route::post('register', [AuthController::class, 'register'])->name('register.post');
  Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});
# AUTH
Route::get('auth/landing', [AuthController::class, 'landingpage'])->name('landing');
Route::get('auth/login', [AuthController::class, 'loginForm'])->name('login');
Route::get('auth/login2', [AuthController::class, 'loginForm'])->name('login2');
Route::post('auth/login', [AuthController::class, 'login'])->name('login-post');
Route::get('auth/send-email-verification', [AuthController::class, 'verificationForm'])->name('send-email-verification');
Route::post('auth/verification', [AuthController::class, 'sendEmailVerification']);
Route::get('auth/verify/{token}', [AuthController::class, 'verify'])->name('verify');
Route::get('auth/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('auth/register', [AuthController::class, 'register']);
Route::get('auth/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('auth/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('forgot-password');
Route::post('auth/forgot-password', [AuthController::class, 'forgotPassword']);
Route::get('auth/reset-password/{token}', [AuthController::class, 'resetPasswordForm'])->name('reset-password');
Route::post('auth/reset-password/{token}', [AuthController::class, 'resetPassword']);

# SOCIAL LOGIN AND REGISTER
Route::get('auth/social-login/{provider}', [AuthController::class, 'socialLogin'])->name('social-login');
Route::get('auth/social-register/{provider}', [AuthController::class, 'socialRegister'])->name('social-register');
Route::get('auth/social/{provider}/callback', [AuthController::class, 'socialCallback'])->name('social-callback');

# CRUD GENERATOR
Route::get('crud-generator', [CrudController::class, 'index'])->middleware('auth');
Route::post('crud-generator', [CrudController::class, 'generateJson'])->middleware('auth');

# YOUTUBE
Route::get('youtube/view-sync', [YoutubeController::class, 'viewSync'])->name('youtube.view-sync')->middleware('auth');

# TEST
Route::get('test', [TestingController::class, 'test'])->name('test');

// routes/web.php
Route::get('/test-mail', function(\App\Services\EmailService $svc){
  $svc->testing('sipelikan.dkpjabar@gmail.com', 'Tes kirim email dari SiPelikan');
  return 'OK';
});

// routes/web.php atau routes/stisla-web.php

# VERIFIKASI AKUN
Route::prefix('verifikasi')->name('verifikasi.')->group(function () {
    // Halaman daftar verifikasi
    Route::get('/', [VerifikasiAkunController::class, 'index'])->name('index');

    // Verifikasi user (POST)
    Route::post('{id}/verify', [VerifikasiAkunController::class, 'verify'])->name('verify');

    // Tolak user (POST)
    Route::post('{id}/reject', [VerifikasiAkunController::class, 'reject'])->name('reject');

    // Nonaktifkan user (POST)
    Route::post('{id}/deactivate', [VerifikasiAkunController::class, 'deactivate'])->name('deactivate');

    // Aktifkan user (POST)
    Route::post('{id}/activate', [VerifikasiAkunController::class, 'activate'])->name('activate');

    // Cek ulang NIB ke OSS RBA (POST)
    Route::post('{id}/cek-oss', [VerifikasiAkunController::class, 'cekOss'])->name('cek-oss');
});

# CEK NIB OSS RBA (formulir registrasi; publik, dibatasi jumlah permintaannya)
Route::post('oss/cek-nib', [\App\Http\Controllers\OssNibController::class, 'cek'])
    ->middleware('throttle:oss-nib')
    ->name('oss.cek-nib');
