<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bom extends Model
{
    protected $table = 'tb_bom';
    protected $primaryKey = 'id_bom';

    protected $fillable = [
        'id_produk',  // Sesuaikan dengan nama kolom di tabel 'tb_bom'
        'id_kategori', // Sesuaikan dengan nama kolom di tabel 'tb_bom'
        'nama_produk',
        'nama_kategori',
        'jumlah_produk',
        'internal_referensi',
        'nama_bahan',
        'jumlah_bahan',
        'total_biaya_produk',
        'total_biaya_bahan',
        'total_bom',
    ];

    use HasFactory;

    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'id_bahan', 'id_bahan');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
}

