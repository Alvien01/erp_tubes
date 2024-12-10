<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sales_order', function (Blueprint $table) {
            $table->id();
            $table->id('id_quotation');
            $table->string('customer');
            $table->string('expiration');
            $table->string('nama_produk');
            $table->string('jumlah');
            $table->string('satuan_biaya');
            $table->string('total_biaya');
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
        Schema::dropIfExists('s_o_s');
    }
}
