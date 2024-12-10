<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PembayaranBill extends Model
{
    use HasFactory;

    protected $table = 'tb_pembayaran_bill';
    protected $primaryKey = 'id_pembayaran_bill';
    protected $fillable = [
        'nama_vendor',
        'referensi_vendor',
        'deadline_order',
        'accounting_date',
        'jenis_pembayaran',
        'bahan',
        'jumlah_bahan',
        'satuan_biaya',
        'total_biaya',
        'journal',
        'jumlah_pembayaran',
        'payment_date',
        'catatan',
    ];
    public $timestamps = false;

    
    public static function enumOptions($column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM " . (new static)->getTable() . " WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum[] = ['value' => $v, 'label' => $v];
        }
        return $enum;
    }

        
}
