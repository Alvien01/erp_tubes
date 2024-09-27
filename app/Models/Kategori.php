<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $primaryKey = 'id_kategori';
    protected $table = 'tb_kategori';
    protected $fillable = ['nama_kategori'];
    public $timestamps = true;

    use HasFactory;

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori', 'id_kategori');
    }

    public function bom()
    {
        return $this->hasMany(Bom::class, 'id_kategori', 'id_kategori');
    }
    
}
