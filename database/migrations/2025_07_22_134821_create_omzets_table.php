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
        Schema::create('omzets', function (Blueprint $table) {
            $table->id();
            $table->string('tujuan_domes')->nullable(); // Tujuan Domestik
            $table->decimal('nilai_domes', 15, 2)->nullable(); // Nilai Omzet Domestik
            $table->decimal('volume_domes', 10, 2)->nullable(); // Volume Omzet Domestik
            $table->string('tujuan_luarnegeri')->nullable(); // Tujuan Luar Negeri
            $table->decimal('nilai_luarnegeri', 15, 2)->nullable(); // Nilai Omzet Luar Negeri
            $table->decimal('volume_luarnegeri', 10, 2)->nullable(); // Volume Omzet Luar Negeri
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
        Schema::dropIfExists('omzets');
    }
};
