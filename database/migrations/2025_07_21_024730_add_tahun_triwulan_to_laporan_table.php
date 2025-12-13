<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('laporan', function (Blueprint $table) {
        $table->integer('tahun')->nullable()->after('id'); // Atau posisi lain yang Anda inginkan
        $table->string('triwulan')->nullable()->after('tahun');
    });
}

public function down()
{
    Schema::table('laporan', function (Blueprint $table) {
        $table->dropColumn('tahun');
        $table->dropColumn('triwulan');
    });
}

};
