<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;
    protected $table = 'pengguna';
    protected $primaryKey = 'id_pengguna';
    protected $fillable = [
        'username',
        'nama',
        'password',
        'email',
        'role',
        'image'
    ];
    protected $hidden = [
        'password',
    ];

    public function pinjam()
    {
        return $this->hasMany(Pinjam::class, 'id_pengguna', 'id_pengguna');
    }
}
