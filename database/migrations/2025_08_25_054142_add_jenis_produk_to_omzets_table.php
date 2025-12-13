<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('omzets', function (Blueprint $table) {
            $table->string('jenis_produk')->nullable();
        });        
    }

    public function down(): void
    {
        Schema::table('omzets', function (Blueprint $table) {
            $table->dropColumn('jenis_produk');
        });
    }
};
