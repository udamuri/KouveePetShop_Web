<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->string('id_produk');
            // $table->unsignedBigInteger('id_pegawai_fk');
            $table->string('nama_produk');
            $table->float('harga_produk');
            $table->integer('stok_produk');
            $table->integer('min_stok_produk');
            $table->string('satuan_produk');
            $table->binary('gambar');
            $table->string('updateLog_by')->nullable();
            $table->datetime('createLog_at');
            $table->datetime('updateLog_at')->nullable();
            $table->datetime('deleteLog_at')->nullable();

            $table->primary('id_produk');
            $table->foreign('updateLog_by')->references('NIP')->on('pegawais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produks');
    }
}
