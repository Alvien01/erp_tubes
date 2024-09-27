<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorCompany extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tb_vendor_company';
    protected $fillable = [
        'nama','alamat','telp','email'
    ];
}
