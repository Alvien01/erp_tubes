<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SO extends Model
{
    protected $table = 'tb_sales_order';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_quotation',
        'customer',
        'expiration',
        'nama_produk',
        'jumlah',
        'satuan_biaya',
        'total_biaya'
    ];

    public function quotation()
    {
        return $this->belongsTo(quotation::class, 'id');
    }
    // public function bahan()
    // {
    //     return $this->belongsTo(Bahan::class, 'id_bahan', 'id_bahan');
    // }
}
