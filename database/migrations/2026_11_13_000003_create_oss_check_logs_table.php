<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/** Riwayat setiap pengecekan NIB ke OSS (jejak audit). */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oss_check_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('nib', 20)->index();
            $table->string('status', 20);
            $table->unsignedSmallInteger('http_code')->nullable();
            $table->string('sumber', 20);          // form | registrasi | admin | jadwal
            $table->string('message', 255)->nullable();
            $table->foreignId('checked_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oss_check_logs');
    }
};
