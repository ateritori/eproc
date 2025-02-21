<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use App\Models\User;

class VendorSeeder extends Seeder
{
    public function run()
    {
        $user = User::first(); // Ambil user pertama (pastikan sudah ada user)

        Vendor::create([
            'id_user' => $user->id,
            'nib' => '123456789',
            'alamat' => 'Jl. Contoh No. 1',
            'nomor_telepon' => '021123456',
            'nomor_hp_pic' => '081234567890',
            'bidang_usaha' => 'Konstruksi',
            'tahun_berdiri' => 2010,
            'legalitas' => 'SIUP, TDP, NPWP',
            'total_proyek' => 15,
        ]);
    }
}
