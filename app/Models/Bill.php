<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    protected $primaryKey = 'id_bills';
    protected $table = 'tb_bills';
    protected $fillable =  ['nama_vendor', 'referensi_vendor', 'deadline_order', 'accounting_date', 'jenis_pembayaran', 'bahan', 'jumlah_bahan', 'satuan_biaya', 'total_biaya', 'status'];
    public $timestamps = false;
    use HasFactory;

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

    // public function pembayaranBill()
    // {
    //     return $this->hasOne(PembayaranBill::class, 'id_bills');
    // }
}
