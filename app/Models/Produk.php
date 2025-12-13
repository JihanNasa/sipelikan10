<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks';

    protected $fillable = [
        'jenis_produk',
        'volume_produk',
        'pemasaran',
        'tahun',
        'triwulan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}