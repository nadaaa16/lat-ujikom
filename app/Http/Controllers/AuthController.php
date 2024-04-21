<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function inputRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255', 'unique:users,name'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required'],
            'telepon' => ['required', 'string', 'max:255'],
            'role' => ['required', Rule::in(['pembaca'])],
            'alamat' => ['nullable'],
            'foto_profil' => ['nullable', 'file', 'image', 'mimes:png,jpg,jpeg,gif,svg,webp']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)->with('error', 'Registrasi gagal, silakan coba lagi.');
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


    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard')->with('success', 'Anda sudah login!');
        } else {
            return redirect()->back()->withInput()->with('fail', 'Login gagal.');
        }
    }
    
    public function logout()
    {
       Auth::logout();
       return redirect('/login')->with('success', 'Logout berhasil.');
    }

}