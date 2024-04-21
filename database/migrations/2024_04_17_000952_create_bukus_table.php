<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->string('kategori');
            $table->timestamps();
        });

        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->nullable()->unique();
            $table->string('penulis');
            $table->string('penerbit');
            $table->string('tahun_terbit');
            $table->text('deskripsi');
            $table->text('img')->nullable()->default('/images/buku.png');
            $table->unsignedBigInteger('kategori_id');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
            // $table->integer('stock')->default(0);
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
