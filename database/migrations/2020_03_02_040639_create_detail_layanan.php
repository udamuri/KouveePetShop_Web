<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailLayanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailLayanans', function (Blueprint $table) {
            $table->string('kode_penjualan');
            $table->string('id_layanan');
            // $table->unsignedBigInteger('id_layanan_fk');
            // $table->unsignedBigInteger('id_transaksi_penjualan_fk');
            $table->datetime('tgl_transaksi_layanan');
            $table->integer('jml_transaksi_layanan');
            $table->float('subtotal');

            $table->primary('kode_penjualan', 'id_layanan');
            $table->foreign('id_layanan')->references('id_layanan')->on('layanans');
            $table->foreign('kode_penjualan')->references('kode_penjualan')->on('transaksiPenjualans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailLayanans');
    }
}
