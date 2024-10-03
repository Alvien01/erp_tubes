<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_order', function (Blueprint $table) {
            $table->id('id_order');
            $table->unsignedBigInteger('id_bom');
            $table->foreign('id_bom')->references('id_bom')->on('tb_bom')->onDelete('cascade');
            $table->unsignedBigInteger('id_produk'); // Tambahkan kolom id_produk di sini
            $table->foreign('id_produk')->references('id_produk')->on('tb_produk')->onDelete('cascade');
            $table->integer('id_bahan')->nullable(); // Menambahkan kolom id_bahan
            // $table->foreign('id_bahan')->references('id_bahan')->on('tb_bahan')->onDelete('cascade');
            $table->string('nama_produk');
            $table->integer('jumlah_produk');
            $table->string('nama_bahan');
            $table->string('jumlah_bahan');
            $table->enum('status', ['Draft', 'Konfirmasi', 'Dalam Proses', 'Selesai'])->default('Draft');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_order');
    }
}
