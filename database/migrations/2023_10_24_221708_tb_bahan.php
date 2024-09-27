<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbBahan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_bahan', function (Blueprint $table) {
            $table->id('id_bahan');
            $table->string('nama_bahan', 255);
            $table->float('biaya_bahan')->nullable();
            $table->float('harga_bahan');
            $table->string('internal_referensi', 255);
            $table->string('gambar_bahan', 255)->nullable();
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
        Schema::dropIfExists('tb_bahan');
    }
}
