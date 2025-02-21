<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_pekerjaan',
        'pagu',
        'rincian',
        'file',
        'tahun' // Tambahkan tahun
    ];
}