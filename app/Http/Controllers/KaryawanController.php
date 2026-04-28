<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $karyawan = Karyawan::paginate(5);
        return view('karyawan.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip'      => 'required|unique:karyawan,nip',
            'nama'     => 'required',
            'alamat'   => 'required',
            'no_telp'  => 'required',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required'    => 'NIP wajib diisi!',
            'nip.unique'      => 'NIP sudah terdaftar!',
            'nama.required'   => 'Nama wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'no_telp.required' => 'Nomor Telepon wajib diisi!',
            'image.image'     => 'File harus berupa gambar!',
            'image.mimes'     => 'Format gambar harus jpeg, png, jpg, atau gif!',
            'image.max'       => 'Ukuran gambar maksimal 2MB!'
        ]);

        $karyawan = new Karyawan();
        $karyawan->nip     = $request->nip;
        $karyawan->nama    = $request->nama;
        $karyawan->alamat  = $request->alamat;
        $karyawan->no_telp = $request->no_telp;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('karyawan', 'public');
            $karyawan->image = $imagePath;
        }

        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil ditambahkan!');
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
        $karyawan = Karyawan::findOrFail($id);
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        $request->validate([
            'nip' => 'required|unique:karyawan,nip,' . $id . ',id_karyawan',
            'nama'     => 'required',
            'alamat'   => 'required',
            'no_telp'  => 'required',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required'    => 'NIP wajib diisi!',
            'nip.unique'      => 'NIP sudah terdaftar oleh karyawan lain!',
            'nama.required'   => 'Nama wajib diisi!',
            'alamat.required' => 'Alamat wajib diisi!',
            'no_telp.required' => 'Nomor Telepon wajib diisi!',
            'image.image'     => 'File harus berupa gambar!',
            'image.mimes'     => 'Format gambar harus jpeg, png, jpg, atau gif!',
            'image.max'       => 'Ukuran gambar maksimal 2MB!'
        ]);

        $karyawan->nip     = $request->nip;
        $karyawan->nama    = $request->nama;
        $karyawan->alamat  = $request->alamat;
        $karyawan->no_telp = $request->no_telp;

        if ($request->hasFile('image')) {
            if ($karyawan->image && Storage::disk('public')->exists($karyawan->image)) {
                Storage::disk('public')->delete($karyawan->image);
            }

            $imagePath = $request->file('image')->store('karyawan', 'public');
            $karyawan->image = $imagePath;
        }

        $karyawan->save();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $karyawan = Karyawan::findOrFail($id);

        if ($karyawan->image && Storage::disk('public')->exists($karyawan->image)) {
            Storage::disk('public')->delete($karyawan->image);
        }

        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus!');
    }
}
