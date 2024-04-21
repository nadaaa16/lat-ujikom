<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $role = request('role', 'all');

        $users = User::query();

        if ($role === 'pembaca') {
            $users->where('role', 'pembaca');
        } elseif ($role === 'petugas') {
            $users->whereIn('role', ['admin', 'pustakawan']);
        }

        $users = $users->orderBy('name')->get();

        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255', 'unique:users,name'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required'],
            'telepon' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'alamat' => ['nullable'],
            'foto_profil' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,gif,svg,webp']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = [
            'name' => $request->input('nama'),
            'slug' => Str::slug($request->input('nama')),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'telepon' => $request->input('telepon'),
            'role' => $request->input('role'),
            'alamat' => $request->input('alamat'),
        ];

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $gambar = time() . '.' . $file->extension();
            $destinationPath = public_path('storage/user');
            $file->move($destinationPath, $gambar);

            $user['gambar'] = '/storage/user/' . $gambar;
        }

        try {
            User::create($user);
            return redirect()->route('user.index')->with('success', 'Pengguna berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pengguna gagal dibuat');
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255', 'unique:users,name,' . $id],
            'username' => ['required', 'string', 'max:255', 'unique:users,username,' . $id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'telepon' => ['required', 'string', 'max:255'],
            'role' => ['required'],
            'alamat' => ['nullable'],
            'foto_profil' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,gif,svg,webp']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = User::findOrFail($id);
        $user->name = $request->input('nama');
        $user->slug = Str::slug($request->input('nama'));
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->telepon = $request->input('telepon');
        $user->role = $request->input('role');
        $user->alamat = $request->input('alamat');

        if ($request->hasFile('foto_profil')) {
            $file = $request->file('foto_profil');
            $gambar = time() . '.' . $file->extension();
            $destinationPath = public_path('storage/user');
            $file->move($destinationPath, $gambar);

            $user->gambar = '/storage/user/' . $gambar;
        }

        try {
            $user->save();
            return redirect()->route('user.index')->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Pengguna gagal diperbarui');
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            if ($user->gambar && $user->gambar !== '/images/user.png') {
                File::delete(public_path($user->gambar));
            }
            $user->delete();
        }

        return redirect()->route('user.index')->with('success', 'Pengguna berhasil dihapus');
    }
}