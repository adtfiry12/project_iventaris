<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JenisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = Jenis::paginate(10);
        return view('jenis.index', compact('jenis'));
    }
    private function kode_jenis()
    {
        $latest = Jenis::latest('id_jenis')->first();
        if (!$latest) {
            return 'JNS0001';
        }
        $string = str_replace('JNS', '', $latest->kode_jenis);
        $number = (int)$string + 1;
        return 'JNS' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kode_jenis = $this->kode_jenis();
        return view('jenis.create', compact('kode_jenis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_jenis' => 'required|unique:jenis,kode_jenis',
            'nama_jenis' => 'required',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $jenis = new Jenis();
        $jenis->kode_jenis = $request->kode_jenis;
        $jenis->nama_jenis = $request->nama_jenis;
        $jenis->keterangan = $request->keterangan;

        if ($request->hasFile('image')) {
            $jenis->image = $request->file('image')->store('jenis', 'public');
        }

        $jenis->save();
        return redirect()->route('jenis.index')->with('success', 'Data jenis berhasil ditambah!');
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
        $jenis = Jenis::findOrFail($id);
        return view('jenis.edit', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenis = Jenis::findOrFail($id);
        $request->validate([
            'kode_jenis' => 'required|unique:jenis,kode_jenis,' . $id . ',id_jenis',
            'nama_jenis' => 'required',
            'image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $jenis->nama_jenis = $request->nama_jenis;
        $jenis->keterangan = $request->keterangan;

        if ($request->hasFile('image')) {
            if ($jenis->image) Storage::disk('public')->delete($jenis->image);
            $jenis->image = $request->file('image')->store('jenis', 'public');
        }

        $jenis->save();
        return redirect()->route('jenis.index')->with('success', 'Data jenis diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis = Jenis::findOrFail($id);
        if ($jenis->image) Storage::disk('public')->delete($jenis->image);
        $jenis->delete();
        return redirect()->route('jenis.index')->with('success', 'Data jenis dihapus!');
    }
}
