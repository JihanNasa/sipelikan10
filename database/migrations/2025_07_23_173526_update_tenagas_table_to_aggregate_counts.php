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
        Schema::table('tenagas', function (Blueprint $table) {
            // Hapus kolom lama yang tidak lagi diperlukan
            // Pastikan kolom 'jumlah' juga dihapus jika masih ada
            $table->dropColumn(['warga_negara', 'jenis_kelamin', 'jumlah']);

            // Tambahkan kolom baru untuk menyimpan jumlah agregat
            $table->integer('jumlah_wni_laki')->default(0)->after('id');
            $table->integer('jumlah_wni_perempuan')->default(0)->after('jumlah_wni_laki');
            $table->integer('jumlah_wna_laki')->default(0)->after('jumlah_wni_perempuan');
            $table->integer('jumlah_wna_perempuan')->default(0)->after('jumlah_wna_laki');

            // Pastikan kolom user_id sudah ada dari migrasi sebelumnya.
            // Jika belum, Anda bisa menambahkannya di sini atau melalui migrasi terpisah.
            // $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tenagas', function (Blueprint $table) {
            // Hapus kolom agregat yang baru ditambahkan
            $table->dropColumn(['jumlah_wni_laki', 'jumlah_wni_perempuan', 'jumlah_wna_laki', 'jumlah_wna_perempuan']);

            // Kembalikan kolom lama (jika diperlukan untuk rollback)
            // Perhatikan bahwa data yang ada di kolom lama akan hilang saat up()
            $table->string('warga_negara')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->integer('jumlah')->default(0);
        });
    }
};
