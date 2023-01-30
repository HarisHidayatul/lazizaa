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
        Schema::create('typeSales', function (Blueprint $table) {
            $table->id();
            $table->string('type',25)->nullable(false);

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('listSales', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('typeSales');
            $table->foreign('typeSales')->references('id')->on('typeSales');

            $table->string('sales',25)->nullable(false);
            $table->boolean('butuhVerifikasi')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('salesharian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet'); //membuat relasi ke tabel dOutlet

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalAll');

            $table->unsignedBigInteger('idSesi');
            $table->foreign('idSesi')->references('id')->on('listSesi');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('salesFill',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idListSales');
            $table->foreign('idListSales')->references('id')->on('listSales');

            $table->unsignedBigInteger('idSales');
            $table->foreign('idSales')->references('id')->on('salesharian');

            $table->smallInteger('cu')->unsigned()->nullable(false);
            $table->smallInteger('cuRevisi')->unsigned()->default('0');

            $table->mediumInteger('total')->unsigned()->nullable(false);
            $table->mediumInteger('totalRevisi')->unsigned()->default('0');

            $table->mediumInteger('totalDiterima')->unsigned()->default('0');
            $table->unsignedBigInteger('idRevDiterima')->default('1');
            $table->foreign('idRevDiterima')->references('id')->on('revisi');

            $table->unsignedBigInteger('idRevisiCu')->default('1');
            $table->foreign('idRevisiCu')->references('id')->on('revisi');

            $table->unsignedBigInteger('idRevisiTotal')->default('1');
            $table->foreign('idRevisiTotal')->references('id')->on('revisi');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->unsignedBigInteger('idPerevisi');
            $table->foreign('idPerevisi')->references('id')->on('duser');

            $table->timestamps();
            // $table->softDeletes();
        });

        Schema::create('outletListSales',function(Blueprint $table){
            $table->id();
            
            $table->unsignedBigInteger('idListSales');
            $table->foreign('idListSales')->references('id')->on('listSales');
            
            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->timestamps();
        });

        Schema::create('reqItemSales', function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');
            
            $table->unsignedBigInteger('idSales');
            $table->foreign('idSales')->references('id')->on('listSales');

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalAll');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

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
