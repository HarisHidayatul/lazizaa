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
        Schema::create('listItemPattyCash', function (Blueprint $table) {
            $table->id();

            $table->string('Item');
            
            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reqItemPattyCash', function (Blueprint $table) {
            $table->id();

            $table->string('Item');
            
            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('dBrand');

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalAll');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->timestamps();
        });

        Schema::create('brandPattyCash', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('dBrand');

            $table->unsignedBigInteger('idListItem');
            $table->foreign('idListItem')->references('id')->on('listItemPattyCash');

            $table->timestamps();
        });

        Schema::create('pattyCashHarian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalAll');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('pattyCashFill', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idPattyCash');
            $table->foreign('idPattyCash')->references('id')->on('pattyCashHarian');

            $table->unsignedBigInteger('idListItem');
            $table->foreign('idListItem')->references('id')->on('listItemPattyCash');

            $table->integer('quantity')->unsigned()->nullable(false);
            $table->integer('quantityRevisi')->unsigned()->default('0');

            $table->integer('total')->unsigned()->nullable(false);
            $table->integer('totalRevisi')->unsigned()->default('0');

            $table->unsignedBigInteger('idRevQuantity')->default('1');
            $table->foreign('idRevQuantity')->references('id')->on('revisi');

            $table->unsignedBigInteger('idRevTotal')->default('1');
            $table->foreign('idRevTotal')->references('id')->on('revisi');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->unsignedBigInteger('idPerevisi');
            $table->foreign('idPerevisi')->references('id')->on('dUser');
            
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
        
    }
};
