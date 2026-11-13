<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Hasil pengecekan NIB terakhir ke OSS RBA. Semua kolom boleh kosong, data lama tidak terganggu. */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('oss_status', 20)->nullable()->index();   // terdaftar | tidak_ditemukan | gagal
            $table->string('oss_nama_perusahaan')->nullable();
            $table->string('oss_kab_kota', 100)->nullable();
            $table->string('oss_kbli', 10)->nullable();
            $table->string('oss_judul_kbli')->nullable();
            $table->string('oss_skala_usaha', 100)->nullable();
            $table->string('oss_id_proyek', 50)->nullable();
            $table->timestamp('oss_checked_at')->nullable();
            $table->json('oss_payload')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['oss_status']);
            $table->dropColumn([
                'oss_status', 'oss_nama_perusahaan', 'oss_kab_kota', 'oss_kbli', 'oss_judul_kbli',
                'oss_skala_usaha', 'oss_id_proyek', 'oss_checked_at', 'oss_payload',
            ]);
        });
    }
};
