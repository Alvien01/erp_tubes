<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SO extends Model
{
    use HasFactory;
    protected $table = 'tb_sales_order';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id_quotation',
        'id_customer_individual ',
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
}
