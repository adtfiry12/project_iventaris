<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;
    protected $table = 'pinjam';
    protected $primaryKey = 'id_pinjam';

    // Sesuai struktur tabel kamu
    protected $fillable = ['id_pengguna', 'tgl_pinjam', 'tgl_kembali', 'id_karyawan'];

    public function detail_pinjam()
    {
        return $this->hasMany(Detailpinjam::class, 'id_pinjam', 'id_pinjam');
    }
    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan', 'id_karyawan');
    }
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna', 'id_pengguna');
    }
}
