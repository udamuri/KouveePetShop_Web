<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengadaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengadaans', function (Blueprint $table) {
            $table->string('no_order');
            $table->date('tgl_pesan')->nullable();
            $table->date('tgl_Cetak')->nullable();
            
            // $table->unsignedBigInteger('id_pegawai_fk');
            // $table->foreign('id_pegawai_fk')->references('id_pegawai')->on('pegawais');
            $table->string('nama_stock');
            $table->string('satuan_stock');
            $table->integer('id_supplier')->unsigned();
            $table->string('status_pengadaan')->default('Belum Datang');
            $table->double('total_harga')->default(0);
            // $table->string('createLog_by')->nullable();
            // $table->string('updateLog_by')->nullable();
            // $table->string('deleteLog_by')->nullable();
            $table->datetime('createLog_at');
            $table->datetime('updateLog_at')->nullable();
            // $table->datetime('deleteLog_at')->nullable();

            $table->primary('no_order');
            $table->foreign('id_supplier')->references('id_supplier')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengadaans');
    }
}
