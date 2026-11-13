<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Kolom data UPI (nib, name2, jabatan, address2) sudah dipakai aplikasi tetapi belum
 * tercatat di migration (di server produksi kolom ini ditambahkan langsung ke database).
 * Migration ini hanya MENAMBAH kolom yang belum ada; di produksi tidak ada yang berubah.
 */
return new class extends Migration
{
    public function up(): void
    {
        $columns = ['nib' => 20, 'name2' => 191, 'jabatan' => 191, 'address2' => 191];

        foreach ($columns as $column => $length) {
            if (! Schema::hasColumn('users', $column)) {
                Schema::table('users', function (Blueprint $table) use ($column, $length) {
                    $table->string($column, $length)->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        // Sengaja kosong: kolom ini milik data produksi, tidak dihapus saat rollback.
    }
};
