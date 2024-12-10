<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPembayaranBill extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pembayaran_bill', function (Blueprint $table) {
            $table->id('id_pembayaran_bill');
            $table->string('nama_vendor');
            $table->string('referensi_vendor');
            $table->date('deadline_order');
            $table->date('accounting_date');
            $table->enum('jenis_pembayaran',['Pembayaran Langsung']);
            $table->string('bahan');
            $table->Integer('jumlah_bahan');
            $table->Integer('satuan_biaya');
            $table->Integer('total_biaya')->nullable();
            $table->enum('journal',['Cash (IDR)', 'Bank']);
            $table->Integer('jumlah_pembayaran');
            $table->date('payment_date');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_pembayaran_bill');
    }
}
