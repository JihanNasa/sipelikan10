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
        Schema::create('saranas', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_sarana');
            $table->string('kapasitas')->nullable(); // Contoh: '100 ton', '500 m2'
            $table->string('pengolahan_teknologi')->nullable(); // Contoh: 'Modern', 'Tradisional'
            $table->integer('tahun'); // Tahun data dicatat
            $table->integer('triwulan'); // Triwulan data dicatat (1, 2, 3, 4)
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saranas');
    }
};
