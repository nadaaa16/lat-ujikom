<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')
            ->orderBy('judul')
            ->get();

        return view('buku.index', compact('buku'));
    }


    public function create()
    {
        $kategori = Kategori::all();
        return view('buku.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'deskripsi' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required',
            // 'stock' => 'required|integer|min:0'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $image = $request->file('img');
        $imgName = time() . '_' . $image->getClientOriginalName();
        $destinationPath = public_path('/fotoCover');
        $image->move($destinationPath, $imgName);

        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kategori_id = $request->kategori;
        $buku->img = $imgName;
        // $buku->stock = $request->stock;
        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Berhasil menambahkan buku');
    }

    public function edit(Request $request, $id)
    {
        $data = Buku::find($id);
        $kategori = Kategori::all();
        return view('buku.edit', compact('data', 'kategori'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
            'deskripsi' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'required',
            // 'stock' => 'required|integer|min:0'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $buku = Buku::findOrFail($id);
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->tahun_terbit = $request->tahun_terbit;
        $buku->deskripsi = $request->deskripsi;
        $buku->kategori_id = $request->kategori;
    
        // if ($buku->stock != $request->stock) {
        //     $difference = $request->stock - $buku->stock;
        //     if ($buku->stock >= abs($difference)) {
        //         $buku->stock += $difference;
        //     } else {
        //         return redirect()->back()->with('error', 'Stok buku tidak mencukupi.');
        //     }
        // }
    
        if ($request->hasFile('img')) {
        }
    
        $buku->save();
    
        return redirect()->route('buku.index')->with('success', 'Berhasil memperbarui informasi buku.');
    }
    
    
    public function destroy($id)
    {
        $data = Buku::find($id);

        if ($data) {
            $data->delete();
            return redirect()->route('buku.index')->with('success', 'Berhasil menghapus buku.');
        }

        return redirect()->route('buku.index')->with('error', 'Gagal menghapus buku.');
    }
}