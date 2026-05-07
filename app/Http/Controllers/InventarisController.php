<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Jenis;
use App\Models\Ruang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventaris = Inventaris::with(['jenis', 'ruang'])->latest('id_inventaris')->paginate(10);
        return view('inventaris.index', compact('inventaris'));
    }

    private function getKodeInventaris()
    {
        $latest = Inventaris::latest('id_inventaris')->first();
        if (!$latest) {
            return 'INV0001';
        }
        $string = str_replace('INV', '', $latest->kode_inventaris);
        $number = (int)$string + 1;
        return 'INV' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode_inventaris = $this->getKodeInventaris();
        $jenis = Jenis::all();
        $ruang = Ruang::all();
        return view('inventaris.create', compact('kode_inventaris', 'jenis', 'ruang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_inventaris' => 'required|unique:inventaris,kode_inventaris',
            'nama'            => 'required|string|max:255',
            'id_jenis'        => 'required',
            'id_ruang'        => 'required',
            'kondisi'         => 'required',
            'jumlah'          => 'required|integer|min:1',
            'tgl_register'    => 'required|date',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $inventaris = new Inventaris();
        $inventaris->kode_inventaris = $request->kode_inventaris;
        $inventaris->nama            = $request->nama;
        $inventaris->id_jenis        = $request->id_jenis;
        $inventaris->id_ruang        = $request->id_ruang;
        $inventaris->kondisi         = $request->kondisi;
        $inventaris->jumlah          = $request->jumlah;
        $inventaris->tgl_register    = $request->tgl_register;
        $inventaris->keterangan      = $request->keterangan;

        if ($request->hasFile('image')) {
            $inventaris->image = $request->file('image')->store('inventaris', 'public');
        }

        $inventaris->save();
        return redirect()->route('inventaris.index')->with('success', 'Data Inventaris berhasil ditambahkan!');
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
        $inventaris = Inventaris::findOrFail($id);
        $jenis = Jenis::all();
        $ruang = Ruang::all();
        return view('inventaris.edit', compact('inventaris', 'jenis', 'ruang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inventaris = Inventaris::findOrFail($id);

        $request->validate([
            'kode_inventaris' => 'required|unique:inventaris,kode_inventaris,' . $id . ',id_inventaris',
            'nama'            => 'required|string|max:255',
            'id_jenis'        => 'required',
            'id_ruang'        => 'required',
            'kondisi'         => 'required',
            'jumlah'          => 'required|integer|min:1',
            'tgl_register'    => 'required|date',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $inventaris->nama         = $request->nama;
        $inventaris->id_jenis     = $request->id_jenis;
        $inventaris->id_ruang     = $request->id_ruang;
        $inventaris->kondisi      = $request->kondisi;
        $inventaris->jumlah       = $request->jumlah;
        $inventaris->tgl_register = $request->tgl_register;
        $inventaris->keterangan   = $request->keterangan;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($inventaris->image && Storage::disk('public')->exists($inventaris->image)) {
                Storage::disk('public')->delete($inventaris->image);
            }
            $inventaris->image = $request->file('image')->store('inventaris', 'public');
        }

        $inventaris->save();
        return redirect()->route('inventaris.index')->with('success', 'Data Inventaris berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventaris = Inventaris::findOrFail($id);
        if ($inventaris->image && Storage::disk('public')->exists($inventaris->image)) {
            Storage::disk('public')->delete($inventaris->image);
        }

        $inventaris->delete();
        return redirect()->route('inventaris.index')->with('success', 'Data Inventaris berhasil dihapus!');
    }
}
