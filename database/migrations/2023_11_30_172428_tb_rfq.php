<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbRfq extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_rfq', function (Blueprint $table) {
            $table->id('id_rfq');
            $table->string('nama_vendor');
            $table->string('referensi_vendor');
            $table->date('deadline_order');
            $table->string('bahan');
            $table->Integer('jumlah_bahan');
            $table->Integer('satuan_biaya');
            $table->Integer('total_biaya')->nullable();
            $table->enum('status', ['RFQ', 'Pesanan Pembelian', 'Nothing To Bills', 'Waiting Bills'])->default('RFQ');
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
        //
    }
}
