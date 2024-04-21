<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Ulasan;
use App\Models\Koleksi;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PustakaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $buku = Buku::with('kategori')
            ->when(strlen($search), function ($query) use ($search) {
                return $query->where('judul', 'like', "%$search%")
                    ->orWhere('penulis', 'like', "%$search%")
                    ->orWhere('penerbit', 'like', "%$search%")
                    ->orWhere('tahun_terbit', 'like', "%$search%")
                    ->orWhereHas('kategori', function ($query) use ($search) {
                        $query->where('kategori', 'like', "%$search%");
                    });
            })
            ->withAvg('ulasan', 'rating') // anbil rata-rata rating dari ulasan
            ->orderBy('judul')
            ->get();

        return view('pustaka.index', compact('buku'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
{
    $buku->load(['kategori', 'ulasan', 'ulasan.user'])
        ->withAvg('ulasan', 'rating');

        $rating = $buku->ulasan_avg_rating;
        

    if (Auth::check()) {
        $userId = Auth::user()->id;

        $koleksi = Koleksi::where('user_id', Auth::user()->id)
            ->where('buku_id', $buku->id)
            ->exists();

        $peminjaman = Peminjam::where('user_id', $userId)
            ->where('buku_id', $buku->id)
            ->exists();
        
        $ulasan = Ulasan::where('user_id', $userId)
            ->where('buku_id', $buku->id)
            ->exists();
    } else {
        $peminjaman = false;
        $ulasan = false;
    }

    return view('pustaka.show', compact('buku', 'peminjaman', 'ulasan', 'koleksi', 'rating'));
}


}
