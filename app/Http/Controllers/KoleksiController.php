<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KoleksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->input('user');

        $koleksi = Koleksi::with(['buku', 'buku.kategori'])
            ->where('user_id', $user)
            ->latest()
            ->get();

        return view('koleksi.index', compact('koleksi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
        ]);

        Koleksi::create([
            'user_id' => $request->input('user_id'),
            'buku_id' => $request->input('buku_id'),
        ]);

        return redirect()->back()->with('success', 'Buku berhasil ditambahkan ke koleksi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Koleksi::find($id);
    
        if ($data) {
            $data->delete();
            return redirect()->back()->with('success', 'Buku berhasil dihapus dari koleksi.');
        }
    
        return redirect()->back()->with('error', 'Gagal menghapus buku dari koleksi.');
    }   
}