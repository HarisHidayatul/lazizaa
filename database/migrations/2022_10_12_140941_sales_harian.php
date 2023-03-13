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

            $table->integer('id_channel_bee_cloud')->unsigned()->default('0');

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

            $table->mediumInteger('totalManual')->unsigned()->default('0');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sales_fill',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idListSales');
            $table->foreign('idListSales')->references('id')->on('list_sales');

            $table->unsignedBigInteger('idSales');
            $table->foreign('idSales')->references('id')->on('sales_harian');

            $table->mediumInteger('total')->unsigned()->nullable(false);
            $table->mediumInteger('totalRevisi')->unsigned()->default('0');

            $table->mediumInteger('totalDiterima')->unsigned()->default('0');

            $table->unsignedBigInteger('idRevDiterima')->default('1');
            $table->foreign('idRevDiterima')->references('id')->on('revisi');

            $table->unsignedBigInteger('idRevisiTotal')->default('1');
            $table->foreign('idRevisiTotal')->references('id')->on('revisi');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->unsignedBigInteger('idPerevisi');
            $table->foreign('idPerevisi')->references('id')->on('duser');

            $table->timestamps();
            // $table->softDeletes();
        });

        Schema::create('sales_harian_transaksi_bee_cloud',function(Blueprint $table){
            $table->id();

            
            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet'); //membuat relasi ke tabel dOutlet

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggal_all');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('transaksi_bee_cloud',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('id_sales');
            $table->foreign('id_sales')->references('id')->on('sales_harian_transaksi_bee_cloud');

            $table->unsignedBigInteger('id_transaksi_bee_cloud');
            $table->timestamp('trxdate_bee_cloud');

            $table->string('trxno_bee_cloud',25);

            $table->integer('total')->unsigned();

            $table->unsignedBigInteger('id_list_sales');
            $table->foreign('id_list_sales')->references('id')->on('list_sales');

            $table->boolean('sinkronisasi')->default('0');

            $table->timestamps();
        });

        Schema::create('detail_transaksi_bee_cloud', function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('id_transaksi_bee_cloud');
            $table->foreign('id_transaksi_bee_cloud')->references('id')->on('transaksi_bee_cloud');

            $table->unsignedBigInteger('id_list_item_so');
            $table->foreign('id_list_item_so')->references('id')->on('list_item_so');

            $table->mediumInteger('qty');
            $table->integer('total')->unsigned();
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

        
        Schema::create('sales_harian_reimburse', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet'); //membuat relasi ke tabel dOutlet

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggal_all');

            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('sales_reimburse',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idSalesHarianReimburse');
            $table->foreign('idSalesHarianReimburse')->references('id')->on('sales_harian_reimburse');

            $table->mediumInteger('total')->unsigned()->nullable(false);
            $table->mediumInteger('totalRevisi')->unsigned()->default('0');

            $table->unsignedBigInteger('idRevisiTotal')->default('1');
            $table->foreign('idRevisiTotal')->references('id')->on('revisi');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->unsignedBigInteger('idPerevisi');
            $table->foreign('idPerevisi')->references('id')->on('duser');

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
