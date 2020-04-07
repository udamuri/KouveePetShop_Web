<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHewan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hewans', function (Blueprint $table) {
            $table->increments('id_hewan');
            // $table->unsignedBigInteger('id_customer_fk');
            // $table->unsignedBigInteger('id_pegawai_fk');
            $table->string('nama_hewan');
            $table->date('tglLahir_hewan');
            // $table->string('nama_customer');
            // $table->string('nama_cs');
            $table->integer('id_customer')->unsigned();
            $table->integer('id_jenisHewan')->unsigned();
            // $table->string('createLog_by')->nullable();
            $table->string('updateLog_by');
            // $table->string('deleteLog_by')->nullable();
            $table->datetime('createLog_at');
            $table->datetime('updateLog_at')->nullable();
            $table->datetime('deleteLog_at')->nullable();
            // $table->unsignedBigInteger('id_jenisHewan_fk');
            // $table->foreign('id_jenisHewan_fk')->references('id_jenisHewan')->on('jenisHewans');
            // $table->unsignedBigInteger('id_ukuranHewan_fk');
            
            $table->foreign('id_customer')->references('id_customer')->on('customers');
            $table->foreign('id_jenisHewan')->references('id_jenisHewan')->on('jenisHewans');
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
        Schema::dropIfExists('hewans');
    }
}
