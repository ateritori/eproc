<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendor'; // Nama tabel

    protected $primaryKey = 'id_vendor'; // Primary key

    protected $fillable = [
        'id_user',
        'pemilik',
        'alamat',
        'telepon',
        'pic',
        'hp_pic',
        'bidang',
        'berdiri',
        'legalitas',
        'total_proyek',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
