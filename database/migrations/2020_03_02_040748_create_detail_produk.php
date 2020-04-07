<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailProduks', function (Blueprint $table) {
            $table->string('kode_penjualan');
            $table->string('id_produk');
            // $table->unsignedBigInteger('id_produk_fk');
            // $table->foreign('id_produk_fk')->references('id_produk')->on('produks');
            // $table->unsignedBigInteger('id_transaksi_penjualan_fk');
            // $table->foreign('id_transaksi_penjualan_fk')->references('id_transaksi_penjualan')->on('transaksiPenjualans');
            // $table->string('kode_produk')->nullabel();
            $table->datetime('tgl_transaksi_produk');
            $table->integer('jml_transaksi_produk');
            $table->float('subtotal');

            $table->primary('kode_penjualan', 'id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produks');
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
        Schema::dropIfExists('detailProduks');
    }
}
