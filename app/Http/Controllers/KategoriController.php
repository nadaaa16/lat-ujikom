<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::withCount('buku')
            ->orderBy('kategori')
            ->get();
        return view('kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required'
        ]);

        Kategori::create([
            'kategori' => $request->kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);
        
        $request->validate([
            'kategori' => 'required'
        ]);

        $kategori->update([
            'kategori' => $request->kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Kategori::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
        }

        return redirect()->route('kategori.index')->with('error', 'Gagal menghapus kategori.');
    }
}