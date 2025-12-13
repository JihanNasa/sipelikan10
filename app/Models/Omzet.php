<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Omzet extends Model
{
    use HasFactory;

    protected $table = 'omzets';

    protected $fillable = [
        'jenis_produk',
        'tujuan_domes',
        'nilai_domes',
        'volume_domes',
        'tujuan_luarnegeri',
        'nilai_luarnegeri',
        'volume_luarnegeri',
        'tahun',
        'triwulan',
        'user_id', // <-- Tambahkan ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}