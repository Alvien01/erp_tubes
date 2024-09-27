<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'tb_order';

    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_bom',
        'referensi',
        'nama_produk',
        'jumlah_produk',
        'nama_bahan',
        'jumlah_bahan',
    ];

    protected $casts = [
        'nama_bahan' => 'json',
        'jumlah_bahan' => 'json',
    ];

    public function bom()
    {
        return $this->belongsTo(Bom::class, 'id_bom');
    }
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'id_bahan', 'id_bahan');
    }
}
