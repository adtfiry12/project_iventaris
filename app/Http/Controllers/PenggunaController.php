<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = Pengguna::paginate(10);
        return view('pengguna.index', compact('pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pengguna.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:pengguna,username',
            'nama'     => 'required',
            'email'    => 'required|email|unique:pengguna,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,user',
        ], [
            'username.unique' => 'Username sudah digunakan!',
            'email.unique'    => 'Email sudah terdaftar!',
            'password.min'    => 'Password minimal 6 karakter!'
        ]);

        $pengguna = new Pengguna();
        $pengguna->username = $request->username;
        $pengguna->nama     = $request->nama;
        $pengguna->email    = $request->email;
        $pengguna->password = Hash::make($request->password);
        $pengguna->role     = $request->role;
        $pengguna->save();

        return redirect()->route('pengguna.index')->with('success', 'Data pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
