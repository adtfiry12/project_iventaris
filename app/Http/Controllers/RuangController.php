<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruang = Ruang::paginate(5);
        return view('ruang.index', compact('ruang'));
    }
    private function kode_ruang()
    {
        $latest = Ruang::latest('id_ruang')->first();

        if (!$latest) {
            return 'RNG0001';
        }
        $string = str_replace('RNG', '', $latest->kode_ruang);
        $number = (int)$string + 1;
        return 'RNG' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode_ruang = $this->kode_ruang();
        return view('ruang.create', compact('kode_ruang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_ruang' => 'required|unique:ruang,kode_ruang',
            'nama_ruang' => 'required',
            'keterangan' => 'nullable',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'kode_ruang.required' => 'Kode Ruang wajib diisi!',
            'kode_ruang.unique'   => 'Kode Ruang sudah digunakan!',
            'nama_ruang.required' => 'Nama Ruang wajib diisi!',
            'image.image'         => 'File harus berupa gambar!',
            'image.mimes'         => 'Format gambar harus jpeg, png, jpg, atau gif!',
            'image.max'           => 'Ukuran gambar maksimal 2MB!'
        ]);

        $ruang = new Ruang();
        $ruang->kode_ruang = $request->kode_ruang;
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->keterangan = $request->keterangan;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('ruang', 'public');
            $ruang->image = $imagePath;
        }

        $ruang->save();

        return redirect()->route('ruang.index')->with('success', 'Data ruang berhasil ditambahkan!');
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
        $ruang = Ruang::findOrFail($id);
        return view('ruang.edit', compact('ruang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $ruang = Ruang::findOrFail($id);

        $request->validate([
            'kode_ruang' => 'required|unique:ruang,kode_ruang,' . $id . ',id_ruang',
            'nama_ruang' => 'required',
            'keterangan' => 'nullable',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'kode_ruang.required' => 'Kode Ruang wajib diisi!',
            'kode_ruang.unique'   => 'Kode Ruang sudah digunakan ruangan lain!',
            'nama_ruang.required' => 'Nama Ruang wajib diisi!',
            'image.image'         => 'File harus berupa gambar!',
            'image.mimes'         => 'Format gambar harus jpeg, png, jpg, atau gif!',
            'image.max'           => 'Ukuran gambar maksimal 2MB!'
        ]);

        $ruang->kode_ruang = $request->kode_ruang;
        $ruang->nama_ruang = $request->nama_ruang;
        $ruang->keterangan = $request->keterangan;

        if ($request->hasFile('image')) {
            if ($ruang->image && Storage::disk('public')->exists($ruang->image)) {
                Storage::disk('public')->delete($ruang->image);
            }

            $imagePath = $request->file('image')->store('ruang', 'public');
            $ruang->image = $imagePath;
        }

        $ruang->save();

        return redirect()->route('ruang.index')->with('success', 'Data ruang berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ruang = Ruang::findOrFail($id);

        if ($ruang->image && Storage::disk('public')->exists($ruang->image)) {
            Storage::disk('public')->delete($ruang->image);
        }

        $ruang->delete();

        return redirect()->route('ruang.index')->with('success', 'Data ruang berhasil dihapus!');
    }
}
