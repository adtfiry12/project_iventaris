<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $fillable = [
        'nip',
        'nama',
        'alamat',
        'no_telp',
        'image',
    ];

    public function pinjam()
    {
        return $this->hasMany(Pinjam::class, 'id_karyawan', 'id_karyawan');
    }
}
