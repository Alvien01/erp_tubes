<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_produk';
    protected $table = 'tb_produk';
    protected $fillable =  ['nama_produk', 'biaya_produksi', 'harga_produksi', 'internal_referensi', 'id_kategori', 'barcode', 'gambar_produk'];


    public function bom()
    {
        return $this->hasMany(Bom::class, 'id_produk', 'id_produk');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'id_produk');
    }

}
