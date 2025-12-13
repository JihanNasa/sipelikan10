<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laporan'; // Pastikan nama tabel sesuai

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'jenis_sarana',
        'kapasitas',
        'pengolahan_teknologi',
        'warga_negara',
        'jenis_kelamin',
        'jenis_ikan',
        'volume_bahanbaku',
        'asal_bahanbaku',
        'jenis_produk',
        'volume_produk',
        'pemasaran',
        'tujuan_domes',
        'nilai_domes',
        'volume_domes',
        'tujuan_luarnegeri',
        'nilai_luarnegeri',
        'volume_luarnegeri',
        'tahun',
        'triwulan',
    ];
}

