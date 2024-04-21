<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->input('user');

        $ulasan = Ulasan::with(['user', 'buku'])
            ->when(strlen($user), function ($query) use ($user) {
                return $query->where('user_id', $user);
            })
            ->latest()
            ->get();

        strlen($user) ? $title = 'Ulasan Kamu' : $title = 'Ulasan Buku';
        strlen($user) ? $view = 'dashboard.ulasan.index' : $view = 'dashboard.ulasan.admin.index';

        confirmDelete('Hapus Ulasan?', 'Anda yakin ingin hapus Ulasan?');

        return redirect()->back()->with('success', 'Ulasan berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'ulasan' => 'required',
            'rating' => 'required',
        ]);

        Ulasan::create([
            'user_id' => $request->input('user_id'),
            'buku_id' => $request->input('buku_id'),
            'ulasan' => $request->input('ulasan'),
            'rating' => $request->input('rating'),
        ]);

        return redirect()->back()->with('success', 'Berhasil Menambahkan Review!');
    }

    // public function show(Ulasan $ulasan)
    // {
    //     $ulasan->load(['user', 'buku']);

    //     confirmDelete('Hapus Ulasan?', 'Anda yakin ingin hapus Ulasan?');

    //     return view('dashboard.ulasan.admin.show');
    // }
}
