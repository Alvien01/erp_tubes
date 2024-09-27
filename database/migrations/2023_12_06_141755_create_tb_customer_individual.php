<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbCustomerIndividual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_customer_individual', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nama_perusahaan');
            $table->string('alamat');
            $table->string('telp');
            $table->string('email');
            $table->string('posisi_pekerjaan');
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
        Schema::dropIfExists('tb_customer_individual');
    }
}
