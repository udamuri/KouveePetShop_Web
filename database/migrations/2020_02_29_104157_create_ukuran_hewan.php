<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUkuranHewan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ukuranHewans', function (Blueprint $table) {
            $table->increments('id_ukuranHewan');
            // $table->unsignedBigInteger('id_pegawai_fk');
            $table->string('nama_ukuranHewan');
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
        Schema::dropIfExists('ukuranHewans');
    }
}
