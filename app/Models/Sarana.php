<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    use HasFactory;

    protected $table = 'saranas';

    protected $fillable = [
        'jenis_sarana',
        'kapasitas',
        'pengolahan_teknologi',
        'tahun',
        'triwulan',
        'user_id', // <-- Tambahkan ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
