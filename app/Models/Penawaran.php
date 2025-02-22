<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'lelang_id',
        'user_id',
        'harga_penawaran',
        'file_dokumen',
        'status'
    ];

    // Relasi ke model Lelang (Many-to-One)
    public function lelang()
    {
        return $this->belongsTo(Lelang::class, 'lelang_id', 'id');
    }

    // Relasi ke model User (Many-to-One)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
