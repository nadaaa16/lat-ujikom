<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $fillable = [
        'id', 
        'judul',
        'penulis', 
        'penerbit',
        'tahun_terbit', 
        'deskripsi',
        'stok', 
        'kategori'
    ];

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
