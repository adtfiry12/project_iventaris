<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpinjam extends Model
{
    use HasFactory;
    protected $table = 'detail_pinjam';
    protected $primaryKey = 'id_detail_pinjam';

    protected $fillable = ['id_pinjam', 'id_inventaris', 'jumlah', 'status', 'kondisi'];

    public function inventaris()
    {
        return $this->belongsTo(Inventaris::class, 'id_inventaris', 'id_inventaris');
    }
}
