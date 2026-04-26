<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard')->with('success', 'Selamat datang Admin!');
            } else {
                return redirect()->route('home')->with('success', 'Berhasil Login!');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email atau Password salah!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'nama'     => 'required',
            'username' => 'required|unique:pengguna,username',
            'email'    => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi file maksimal 2MB
        ], [
            'username.unique' => 'Username sudah digunakan, cari yang lain!',
            'email.unique'    => 'Email sudah terdaftar!',
            'password.min'    => 'Password minimal 6 karakter!',
            'image.image'     => 'File harus berupa gambar!',
            'image.mimes'     => 'Format gambar harus jpeg, png, jpg, atau gif!',
            'image.max'       => 'Ukuran gambar maksimal 2MB!'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengguna', 'public');
        }

        Pengguna::create([
            'nama'     => $request->nama,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'user',
            'image'    => $imagePath
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
