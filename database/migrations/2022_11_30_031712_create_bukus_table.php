<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('isbn')->unique();
            $table->string('judul');
            $table->text('sinopsis');
            $table->string('penerbit');
            $table->string('cover');
            $table->enum('status', ['tampil', 'sembunyi'])->default('tampil');
            $table->foreignId('kategori_id')->constrained('kategori');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukus');
    }
};
