<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\Oss\OssNibResult;
use App\Services\Oss\OssService;
use Illuminate\Console\Command;

/**
 * Cek ulang NIB seluruh UPI ke OSS RBA.
 *   php artisan oss:cek-ulang                 # semua UPI yang punya NIB
 *   php artisan oss:cek-ulang --user=12       # satu UPI
 *   php artisan oss:cek-ulang --hanya-belum   # hanya yang belum terverifikasi OSS
 * Dijadwalkan otomatis di routes/console.php (perlu cron "schedule:run" di server).
 */
class OssCekUlang extends Command
{
    protected $signature = 'oss:cek-ulang
        {--user= : ID user tertentu}
        {--hanya-belum : Hanya UPI yang statusnya belum "terdaftar"}
        {--jeda=500 : Jeda antar permintaan dalam milidetik, agar tidak melebihi batas SPLP}';

    protected $description = 'Cek ulang NIB UPI ke OSS RBA (JELITA DPMPTSP via SPLPD Jabar)';

    public function handle(OssService $oss): int
    {
        if (! $oss->enabled()) {
            $this->warn('OSS_DRIVER=disabled, pengecekan tidak dijalankan.');

            return self::SUCCESS;
        }

        $query = User::query()->whereNotNull('nib')->where('nib', '!=', '');
        if ($id = $this->option('user')) {
            $query->whereKey($id);
        }
        if ($this->option('hanya-belum')) {
            $query->where(fn ($q) => $q->whereNull('oss_status')->orWhere('oss_status', '!=', OssNibResult::TERDAFTAR));
        }

        $jeda = max(0, (int) $this->option('jeda'));
        $ringkasan = ['terdaftar' => 0, 'tidak_ditemukan' => 0, 'gagal' => 0, 'berubah' => 0];

        $query->orderBy('id')->chunkById(100, function ($users) use ($oss, $jeda, &$ringkasan) {
            foreach ($users as $user) {
                [$lama, $hasil] = $oss->cekUser($user, OssService::SUMBER_JADWAL);
                $ringkasan[$hasil->status] = ($ringkasan[$hasil->status] ?? 0) + 1;

                if ($lama && $hasil->isDefinitive() && $lama !== $hasil->status) {
                    $ringkasan['berubah']++;
                    $this->line("Status berubah: {$user->name} (NIB {$user->nib}) {$lama} -> {$hasil->status}");
                }
                if ($jeda) {
                    usleep($jeda * 1000);
                }
            }
        });

        $this->table(['Terdaftar', 'Tidak ditemukan', 'Gagal', 'Status berubah'], [[
            $ringkasan['terdaftar'], $ringkasan['tidak_ditemukan'], $ringkasan['gagal'], $ringkasan['berubah'],
        ]]);

        return self::SUCCESS;
    }
}
