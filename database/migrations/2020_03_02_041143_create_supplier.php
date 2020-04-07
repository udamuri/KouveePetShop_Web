<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id_supplier');
            // $table->unsignedBigInteger('id_pegawai_fk');
            // $table->unsignedBigInteger('id_stock_fk');
            // $table->foreign('id_stock_fk')->references('id_stock')->on('orderStocks');
            $table->string('nama_supplier');
            $table->string('alamat_supplier');
            $table->double('telepon_supplier');
            $table->integer('stok_supplier');
            // $table->string('createLog_by')->nullable();
            $table->string('updateLog_by');
            // $table->string('deleteLog_by')->nullable();
            $table->datetime('createLog_at');
            $table->datetime('updateLog_at')->nullable();
            $table->datetime('deleteLog_at')->nullable();

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
        Schema::dropIfExists('suppliers');
    }
}
