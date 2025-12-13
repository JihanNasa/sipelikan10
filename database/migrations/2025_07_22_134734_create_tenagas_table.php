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
        Schema::create('tenagas', function (Blueprint $table) {
            $table->id();
            $table->string('warga_negara'); // Contoh: 'WNI', 'WNA'
            $table->string('jenis_kelamin'); // Contoh: 'Laki-laki', 'Perempuan'
            $table->integer('jumlah'); // Menambahkan kolom jumlah untuk tenaga kerja
            $table->integer('tahun');
            $table->integer('triwulan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenagas');
    }
};
