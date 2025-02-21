<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perusahaan');
            $table->string('nib');
            $table->text('alamat_perusahaan');
            $table->string('email');
            $table->string('nomor_telepon');
            $table->string('nama_pic');
            $table->string('nomor_hp_pic');
            $table->string('bidang_usaha');
            $table->string('kategori_vendor');
            $table->year('tahun_berdiri');
            $table->string('sertifikasi_legalitas');
            $table->integer('jumlah_proyek_terselesaikan');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
