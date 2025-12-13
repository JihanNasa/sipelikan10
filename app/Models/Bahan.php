<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = 'bahans';

    protected $fillable = [
        'jenis_ikan',
        'volume_bahanbaku',
        'asal_bahanbaku',
        'tahun',
        'triwulan',
        'user_id', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}