<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('laporan', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_sarana')->nullable();
            $table->string('kapasitas')->nullable();
            $table->string('pengolahan_teknologi')->nullable();
            $table->string('warga_negara')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('jenis_ikan')->nullable();
            $table->string('volume_bahanbaku')->nullable();
            $table->string('asal_bahanbaku')->nullable();
            $table->string('jenis_produk')->nullable();
            $table->string('volume_produk')->nullable();
            $table->string('pemasaran')->nullable();
            $table->string('tujuan_domes')->nullable();
            $table->string('nilai_domes')->nullable();
            $table->string('volume_domes')->nullable();
            $table->string('tujuan_luarnegeri')->nullable();
            $table->string('nilai_luarnegeri')->nullable();
            $table->string('volume_luarnegeri')->nullable();
            $table->string('tahun')->nullable();
            $table->string('triwulan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan');
    }
};
