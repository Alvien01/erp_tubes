<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorIndividual extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tb_vendor_individual';
    protected $fillable = [
        'nama', 'nama_perusahaan', 'alamat','telp','email','posisi_pekerjaan'
    ];
}
