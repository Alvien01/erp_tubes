<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SO extends Model
{
    use HasFactory;
    protected $table = 'tb_sales_order';

    protected $primaryKey = 'id';
    public $timestamps = false; // Nonaktifkan timestamps

    protected $fillable = [
        'id_quotation',
        'id_customer_individual',
        'id_customer_company', // Tambahkan jika kolom ini ada di database
        'customer',            // Tambahkan jika kolom ini ada di database
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
