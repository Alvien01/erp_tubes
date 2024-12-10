<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerIndividual extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tb_customer_individual';
    protected $fillable = [
        'nama', 'nama_perusahaan', 'alamat', 'telp', 'email', 'posisi_pekerjaan'
    ];
}
