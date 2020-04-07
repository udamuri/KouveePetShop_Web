<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailPengadaans', function (Blueprint $table) {
            $table->string('no_order');
            $table->string('id_produk');
            // $table->bigIncrements('id_detail_pengadaan');
            // $table->unsignedBigInteger('id_produk_fk');
            // $table->foreign('id_produk_fk')->references('id_produk')->on('produks');
            // $table->unsignedBigInteger('id_stock_fk');
            // $table->foreign('id_stock_fk')->references('id_stock')->on('orderStocks');
            // $table->string('kode_stok')->nullable();
            $table->integer('jml_stok_pengadaan')->nullable();
            $table->string('status_pengadaan_produk')->nullable();
            $table->double('subTotal');

            $table->primary('no_order', 'id_produk');
            $table->foreign('id_produk')->references('id_produk')->on('produks');
            $table->foreign('no_order')->references('no_order')->on('pengadaans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detailPengadaans');
    }
}
