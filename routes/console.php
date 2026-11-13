<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Cek ulang NIB seluruh UPI ke OSS RBA setiap tanggal 1 pukul 02.00 WIB.
// Membutuhkan cron di server: * * * * * cd /path/aplikasi && php artisan schedule:run >> /dev/null 2>&1
Schedule::command('oss:cek-ulang')
    ->monthlyOn(1, '02:00')
    ->timezone('Asia/Jakarta')
    ->withoutOverlapping()
    ->when(fn () => config('services.oss.driver', 'disabled') !== 'disabled');
