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
        Schema::create('jenisBank',function(Blueprint $table){
            $table->id();
            $table->string('jenis');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('listBank',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idJenisBank');
            $table->foreign('idJenisBank')->references('id')->on('jenisBank');

            $table->string('bank');
            $table->string('imageBank');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('pengirimList',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idUser');
            $table->foreign('idUser')->references('id')->on('dUser');
            
            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');
            
            $table->unsignedBigInteger('idBank');
            $table->foreign('idBank')->references('id')->on('listBank');
            
            $table->string('namaRekening');
            $table->string('nomorRekening');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('pengirimList',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idBank');
            $table->foreign('idBank')->references('id')->on('listBank');
            
            $table->string('namaRekening');
            $table->string('nomorRekening');
        });
        Schema::create('pengirimList',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idBank');
            $table->foreign('idBank')->references('id')->on('listBank');
            
            $table->string('namaRekening');
            $table->string('nomorRekening');
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
