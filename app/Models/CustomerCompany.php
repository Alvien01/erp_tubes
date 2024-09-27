<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerCompany extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'tb_customer_company';
    protected $fillable = [
        'nama', 'alamat', 'telp', 'email'
    ];
}
