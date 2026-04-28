<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PenggunaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengguna = Pengguna::paginate(5);
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
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'username.unique' => 'Username sudah digunakan!',
            'email.unique'    => 'Email sudah terdaftar!',
            'password.min'    => 'Password minimal 6 karakter!',
            'image.image'     => 'File harus berupa gambar!',
            'image.mimes'     => 'Format gambar harus jpeg, png, jpg, atau gif!',
            'image.max'       => 'Ukuran gambar maksimal 2MB!'
        ]);

        $pengguna = new Pengguna();
        $pengguna->username = $request->username;
        $pengguna->nama     = $request->nama;
        $pengguna->email    = $request->email;
        $pengguna->password = Hash::make($request->password);
        $pengguna->role     = $request->role;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('pengguna', 'public');
            $pengguna->image = $imagePath;
        }

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
        $pengguna = Pengguna::findOrFail($id);
        return view('pengguna.edit', compact('pengguna'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:pengguna,username,' . $id . ',id_pengguna',
            'nama'     => 'required',
            'email'    => 'required|email|unique:pengguna,email,' . $id . ',id_pengguna',
            'role'     => 'required',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pengguna->username = $request->username;
        $pengguna->nama     = $request->nama;
        $pengguna->email    = $request->email;
        $pengguna->role     = $request->role;

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:6']);
            $pengguna->password = Hash::make($request->password);
        }

        if ($request->hasFile('image')) {
            if ($pengguna->image && Storage::disk('public')->exists($pengguna->image)) {
                Storage::disk('public')->delete($pengguna->image);
            }

            $imagePath = $request->file('image')->store('pengguna', 'public');
            $pengguna->image = $imagePath;
        }

        $pengguna->save();

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengguna = Pengguna::findOrFail($id);

        if ($pengguna->image && Storage::disk('public')->exists($pengguna->image)) {
            Storage::disk('public')->delete($pengguna->image);
        }

        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Data berhasil dihapus!');
    }
}
