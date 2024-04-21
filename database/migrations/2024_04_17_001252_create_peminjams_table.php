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
        Schema::create('peminjam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('buku_id');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('buku_id')->references('id')->on('buku')->onUpdate('cascade')->onDelete('cascade');
            $table->date('tanggal_pinjam');
            $table->string('tanggal_kembali');
            $table->enum('status', ['Dipinjam', 'Dikembalikan']);
            $table->timestamps();
        });
    }

    // public function tambahStok($jumlah)
    // {
    //     $this->stock += $jumlah;
    //     $this->save();
    // }

    // public function kurangiStok($jumlah)
    // {
    //     if ($this->stock >= $jumlah) {
    //         $this->stock -= $jumlah;
    //         $this->save();
    //         return true;
    //     }
    //     return false;
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
