<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksiPenjualans', function (Blueprint $table) {
            $table->string('kode_penjualan');
            $table->date('tgl_transaksi_penjualan');
            // $table->unsignedBigInteger('id_pegawai_fk');
            // $table->foreign('id_pegawai_fk')->references('id_pegawai')->on('pegawais');
            // $table->unsignedBigInteger('id_hewan_fk');
            // $table->foreign('id_hewan_fk')->references('id_hewan')->on('hewans');
            $table->string('nama_kasir')->nullable();
            // $table->float('subtotal')->nullable();
            // $table->float('diskon')->nullable();
            $table->float('total')->default(0);
            $table->string('status_transaksi')->default("Belum Selesai");
            $table->string('status_pembayaran')->default("Belum Dibayar");
            $table->integer('id_customer')->unsigned();
            $table->string('id_CS');
            $table->string('id_Kasir')->nullable();;
            // $table->string('createLog_by')->nullable();
            // $table->string('updateLog_by')->nullable();
            $table->datetime('createLog_at');
            $table->datetime('updateLog_at')->nullable();

            $table->primary('kode_penjualan');
            $table->foreign('id_customer')->references('id_customer')->on('customers');
            $table->foreign('id_CS')->references('NIP')->on('pegawais');
            $table->foreign('id_Kasir')->references('NIP')->on('pegawais');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksiPenjualans');
    }
}
