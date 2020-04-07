<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->string('id_layanan');
            // $table->unsignedBigInteger('id_pegawai_fk');
            $table->string('nama_layanan');
            $table->float('harga_layanan');
            // $table->string('jenis_layanan');
            $table->integer('id_ukuranHewan')->unsigned();
            // $table->string('createLog_by')->nullable();
            $table->string('updateLog_by');
            // $table->string('deleteLog_by')->nullable();
            $table->datetime('createLog_at');
            $table->datetime('updateLog_at')->nullable();
            $table->datetime('deleteLog_at')->nullable();

            $table->primary('id_layanan');
            // $table->unsignedBigInteger('id_ukuranHewan_fk');
            $table->foreign('id_ukuranHewan')->references('id_ukuranHewan')->on('ukuranHewans');
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
        Schema::dropIfExists('layanans');
    }
}
