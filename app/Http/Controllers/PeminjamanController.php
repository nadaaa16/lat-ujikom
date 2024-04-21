<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Buku;
use App\Models\peminjam;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        
        $peminjaman = Peminjam::where('user_id', $user->id)->get();

        return view('peminjam.index', compact('peminjaman'));

    }

    public function admin(Request $request)
    {
       
        $peminjaman = Peminjam::all();

        return view('peminjamanAdmin', compact('peminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_pinjam' => 'nullable',
            'tanggal_kembali' => 'nullable',
        ]);

        $peminjaman = Peminjam::create([
            'user_id' => $request->input('user_id'),
            'buku_id' => $request->input('buku_id'),
            'status' => 'Dipinjam',
            'tanggal_pinjam' => $request->input('tanggal_pinjam'),
            'tanggal_kembali' => $request->input('tanggal_kembali'),
        ]);
        
        if ($peminjaman) {
            return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
        } else {
            return redirect()->back()->with('error', 'Buku tidak dapat dipinjam.');
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required',
            'tanggal_kembali' => 'required'
        ]);

        try {
            $peminjaman = Peminjam::findOrFail($request->peminjaman);

            $peminjaman->update([
                'tanggal_kembali' => $request->input('tanggal_kembali'),
                'status' => 'Dikembalikan',
            ]);

            return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Peminjaman tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengembalikan buku.');
        }
    }
    
    //STOCK
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'user_id' => 'required',
    //         'buku_id' => 'required',
    //         'tanggal_pinjam' => 'nullable',
    //         'tanggal_kembali' => 'nullable',
    //     ]);

    //     $bukuId = $request->input('buku_id');
    //     $buku = Buku::find($bukuId);

    //     if ($buku->stock > 0) {
    //         $buku->decrement('stock', 1);
    //         Peminjam::create([
    //             'user_id' => $request->input('user_id'),
    //             'buku_id' => $bukuId,
    //             'status' => 'Dipinjam',
    //             'tanggal_pinjam' => $request->input('tanggal_pinjam'),
    //             'tanggal_kembali' => $request->input('tanggal_kembali'),
    //         ]);

    //         return redirect()->back()->with('success', 'Buku berhasil dipinjam.');
    //     } else {
    //         return redirect()->back()->with('error', 'Buku tidak dapat dipinjam');
    //     }
    // }

    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'status' => 'required',
    //         'tanggal_kembali' => 'required'
    //     ]);

    //     $peminjaman = Peminjam::findOrFail($request->peminjaman);
    //     $bukuId = $peminjaman->buku_id;

    //     if ($request->input('status') === 'Dikembalikan') {
    //         Buku::where('id', $bukuId)->increment('stock', 1);
    //     }

    //     $peminjaman->update([
    //         'tanggal_kembali' => $request->input('tanggal_kembali'),
    //         'status' => 'Dikembalikan',
    //     ]);

    //     return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->back()->with('success', 'Peminjaman berhasil dihapus.');
    }

    public function exportPdf(Request $request)
    {
        $status = $request->input('status');
        $peminjaman = $status ? Peminjam::where('status', $status)->get() : Peminjam::all();
        $pdf = PDF::loadView('pdf.export-peminjaman', ['peminjaman' => $peminjaman]);

        return $pdf->download('peminjaman.pdf');
    }
}