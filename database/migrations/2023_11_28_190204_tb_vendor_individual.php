<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbVendorIndividual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vendor_individual', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_perusahaan');
            $table->string('alamat');
            $table->bigInteger('telp')->nullable();
            $table->string('email');
            $table->string('posisi_pekerjaan')->nullable();
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
        Schema::dropIfExists('vendor_individual');
    }
}
