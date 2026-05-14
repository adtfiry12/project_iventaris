<?php

namespace App\Http\Controllers;

use App\Models\Pinjam;
use App\Models\Detailpinjam; // Menyesuaikan nama modelmu
use App\Models\Pengguna;
use App\Models\Karyawan;
use App\Models\Inventaris;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamController extends Controller
{
    public function index()
    {
        $pinjam = Pinjam::with(['karyawan', 'pengguna'])->latest('id_pinjam')->paginate(10);
        return view('pinjam.index', compact('pinjam'));
    }

    private function generateKodePinjam()
    {
        $latest = Pinjam::latest('id_pinjam')->first();
        if (!$latest) {
            return 'PNJ0001';
        }
        $string = str_replace('PNJ', '', $latest->kode_pinjam);
        $number = (int)$string + 1;
        return 'PNJ' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    public function create()
    {
        $kode_pinjam = $this->generateKodePinjam();
        $karyawan = Karyawan::all();
        $inventaris = Inventaris::with(['jenis', 'ruang'])->get();

        return view('pinjam.create', compact('kode_pinjam', 'karyawan', 'inventaris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pinjam'   => 'required|unique:pinjam,kode_pinjam',
            'id_karyawan'   => 'required',
            'tgl_pinjam'    => 'required|date',
            'id_inventaris' => 'required|array',
        ]);

        DB::beginTransaction();
        try {
            $pinjam = new Pinjam();
            $pinjam->kode_pinjam = $request->kode_pinjam;
            // Otomatis ambil ID pengguna dari session yang login
            $pinjam->id_pengguna = auth()->user()->id_pengguna;
            $pinjam->id_karyawan = $request->id_karyawan;
            $pinjam->tgl_pinjam  = $request->tgl_pinjam;
            $pinjam->tgl_kembali = $request->tgl_kembali;
            $pinjam->save();

            foreach ($request->id_inventaris as $key => $id_inv) {
                $detail = new Detailpinjam();
                $detail->id_pinjam     = $pinjam->id_pinjam;
                $detail->id_inventaris = $id_inv;
                $detail->jumlah        = $request->qty_pinjam[$key];
                $detail->kondisi       = $request->kondisi_pinjam[$key];
                $detail->status        = $request->status_pinjam;
                $detail->save();
            }

            DB::commit();
            return redirect()->route('pinjam.index')->with('success', 'Transaksi berhasil disimpan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }

    public function show(String $id)
    {
        $pinjam = Pinjam::with(['karyawan', 'pengguna', 'detail_pinjam.inventaris.jenis', 'detail_pinjam.inventaris.ruang'])->findOrFail($id);
        return view('pinjam.show', compact('pinjam'));
    }

    public function destroy(String $id)
    {
        Pinjam::findOrFail($id)->delete();
        Detailpinjam::where('id_pinjam', $id)->delete();
        return back()->with('success', 'Transaksi dihapus!');
    }

    public function cetakStruk(String $id)
    {
        $pinjam = Pinjam::with(['karyawan', 'pengguna', 'detail_pinjam.inventaris'])->findOrFail($id);
        return view('pinjam.struk', compact('pinjam'));
    }
}
