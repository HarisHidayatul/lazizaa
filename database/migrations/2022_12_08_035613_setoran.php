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
        Schema::create('jenis_bank',function(Blueprint $table){
            $table->id();
            $table->string('jenis');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('list_bank',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idJenisBank');
            $table->foreign('idJenisBank')->references('id')->on('jenis_bank');

            $table->string('bank');
            $table->string('imageBank');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('pengirim_list',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('duser');
            
            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('idBank');
            $table->foreign('idBank')->references('id')->on('list_bank');
            
            $table->string('namaRekening');
            $table->string('nomorRekening');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('penerima_list',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idBank');
            $table->foreign('idBank')->references('id')->on('list_bank');
            
            $table->string('namaRekening');
            $table->string('nomorRekening');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('setoran', function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idPengirim');
            $table->foreign('idPengirim')->references('id')->on('pengirim_list');
            
            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');
            
            $table->unsignedBigInteger('idTujuan');
            $table->foreign('idTujuan')->references('id')->on('penerima_list');

            $table->unsignedBigInteger('idRevisi');
            $table->foreign('idRevisi')->references('id')->on('revisi');

            $table->mediumInteger('qtySetor')->unsigned();
            $table->string('imgTransfer',50);
            
            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggal_all');

            $table->timestamps();
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
