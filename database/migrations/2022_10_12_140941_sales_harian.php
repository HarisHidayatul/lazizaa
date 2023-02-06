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
        Schema::create('type_sales', function (Blueprint $table) {
            $table->id();
            $table->string('type',25)->nullable(false);

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('list_sales', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('typeSales');
            $table->foreign('typeSales')->references('id')->on('type_sales');

            $table->string('sales',25)->nullable(false);
            $table->boolean('butuhVerifikasi')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('sales_harian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet'); //membuat relasi ke tabel dOutlet

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggal_all');

            $table->unsignedBigInteger('idSesi');
            $table->foreign('idSesi')->references('id')->on('list_sesi');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sales_fill',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idListSales');
            $table->foreign('idListSales')->references('id')->on('list_sales');

            $table->unsignedBigInteger('idSales');
            $table->foreign('idSales')->references('id')->on('sales_harian');

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

        Schema::create('outlet_list_sales',function(Blueprint $table){
            $table->id();
            
            $table->unsignedBigInteger('idListSales');
            $table->foreign('idListSales')->references('id')->on('list_sales');
            
            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->timestamps();
        });

        Schema::create('req_item_sales', function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');
            
            $table->unsignedBigInteger('idSales');
            $table->foreign('idSales')->references('id')->on('list_sales');

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggal_all');

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
