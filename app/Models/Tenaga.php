<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenaga extends Model
{
    use HasFactory;

    protected $table = 'tenagas';

    protected $fillable = [
        'jumlah_wni_laki',
        'jumlah_wni_perempuan',
        'jumlah_wna_laki',
        'jumlah_wna_perempuan',
        'tahun',
        'triwulan',
        'user_id', // Pastikan ini ada jika Anda sudah menambahkannya
    ];

    // Relasi ke model User (jika sudah ditambahkan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
