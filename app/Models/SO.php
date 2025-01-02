<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SO extends Model
{
    use HasFactory;

    protected $table = 'tb_sales_order';
    protected $primaryKey = 'id';
    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan

    protected $fillable = [
        'id_quotation',
        'id_customer_individual',
        'id_customer_company', // Kolom ini harus ada di database jika digunakan
        'customer',            // Kolom ini harus ada di database jika digunakan
        'expiration',
        'nama_produk',
        'jumlah',
        'satuan_biaya',
        'total_biaya',
    ];

    /**
     * Relasi ke model Quotation
     */
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'id_quotation'); // Foreign key yang benar
    }

    /**
     * Relasi ke model CustomerIndividual
     */
    public function customerIndividual()
    {
        return $this->belongsTo(CustomerIndividual::class, 'id_customer_individual'); // Foreign key yang benar
    }

    /**
     * Relasi ke model CustomerCompany (opsional)
     */
    public function customerCompany()
    {
        return $this->belongsTo(CustomerCompany::class, 'id_customer_company'); // Foreign key yang benar
    }
}
