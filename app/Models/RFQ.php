<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFQ extends Model
{
    protected $primaryKey = 'id_rfq';
    protected $table = 'tb_rfq';
    protected $fillable =  ['nama_vendor', 'referensi_vendor', 'deadline_order', 'bahan', 'jumlah_bahan', 'satuan_biaya', 'total_biaya', 'status'];
    public $timestamps = false;

    use HasFactory;

    
}
