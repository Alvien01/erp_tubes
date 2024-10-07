<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'tb_quotation';
    protected $fillable =  ['id_customer_indivudal', 'expiration', 'payment_terms', 'nama_produk', 'jumlah', 'satuan_biaya', 'total_biaya', 'status'];
    public $timestamps = false;

    use HasFactory;

    
}
