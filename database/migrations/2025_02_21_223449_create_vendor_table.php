<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('vendor', function (Blueprint $table) {
            $table->id('id_vendor'); // Primary Key
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Foreign Key
            $table->string('pemilik');
            $table->text('alamat');
            $table->string('telepon');
            $table->string('pic');
            $table->string('hp_pic');
            $table->string('bidang');
            $table->year('berdiri');
            $table->string('legalitas');
            $table->integer('total_proyek')->default(0);
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('vendor');
    }
};
