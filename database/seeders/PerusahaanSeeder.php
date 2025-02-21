<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PerusahaanSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Asumsikan user_id yang digunakan adalah 1
        DB::table('perusahaans')->insert([
            'user_id' => 1, // Pastikan ini sesuai dengan ID pengguna yang valid
            'nama_perusahaan' => $faker->company,
            'nib' => $faker->uuid,
            'alamat_perusahaan' => $faker->address,
            'email' => $faker->companyEmail,
            'nomor_telepon' => $faker->phoneNumber,
            'nama_pic' => $faker->name,
            'nomor_hp_pic' => $faker->phoneNumber,
            'bidang_usaha' => $faker->word,
            'kategori_vendor' => $faker->randomElement(['Barang', 'Jasa', 'Konsultan']),
            'tahun_berdiri' => $faker->year,
            'sertifikasi_legalitas' => $faker->word,
            'jumlah_proyek_terselesaikan' => $faker->numberBetween(1, 100),
        ]);
    }
}