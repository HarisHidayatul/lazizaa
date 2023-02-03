<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('reimburse', function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalall');
            
            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');
            
            $table->integer('saldoTerakhir');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('penerimareimburse', function(Blueprint $table){
            $table->id();
            
            $table->unsignedBigInteger('idPengirim');
            $table->foreign('idPengirim')->references('id')->on('penerimalist');

            $table->unsignedBigInteger('idReimburse');
            $table->foreign('idReimburse')->references('id')->on('reimburse');

            $table->unsignedBigInteger('idRevisi');
            $table->foreign('idRevisi')->references('id')->on('revisi');

            $table->unsignedBigInteger('idTujuan');
            $table->foreign('idTujuan')->references('id')->on('pengirimlist');

            $table->string('pesan');
            $table->string('imgTransfer');
            $table->mediumInteger('qty')->unsigned();

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
