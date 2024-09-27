<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('nama_produk', 255);
            $table->float('harga_produksi');
            $table->float('biaya_produksi')->nullable();
            $table->string('internal_referensi', 255);
            $table->string('nama_kategori', 255)->nullable();
            $table->string('barcode', 255)->nullable();
            $table->string('gambar_produk', 255)->nullable();
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
        Schema::dropIfExists('tb_produk');
    }
}
