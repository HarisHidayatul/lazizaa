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
        Schema::create('kategori_patty_cash', function (Blueprint $table){
            $table->id();

            $table->string('namaKategori');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('jenis_patty_cash',function(Blueprint $table){
            $table->id();
            $table->string('namaJenis');

            $table->unsignedBigInteger('idKategori');
            $table->foreign('idKategori')->references('id')->on('kategori_patty_cash');

            $table->string('kodeAkun')->nullable(true)->change();

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('list_item_patty_cash', function (Blueprint $table) {
            $table->id();

            $table->string('Item');

            $table->string('kodeBeeCloud')->nullable(true)->change();
            
            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->unsignedBigInteger('idJenisItem');
            $table->foreign('idJenisItem')->references('id')->on('jenis_patty_cash');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('req_item_patty_cash', function (Blueprint $table) {
            $table->id();

            $table->string('Item',25);
            
            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('dbrand');

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggal_all');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->timestamps();
        });

        Schema::create('brand_patty_cash', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('dbrand');

            $table->unsignedBigInteger('idListItem');
            $table->foreign('idListItem')->references('id')->on('list_item_patty_cash');

            $table->timestamps();
        });

        Schema::create('patty_cash_harian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggal_all');

            $table->unsignedBigInteger('idSesi');
            $table->foreign('idSesi')->references('id')->on('list_sesi');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('patty_cash_fill', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idPattyCash');
            $table->foreign('idPattyCash')->references('id')->on('patty_cash_harian');

            $table->unsignedBigInteger('idListItem');
            $table->foreign('idListItem')->references('id')->on('list_item_patty_cash');

            $table->smallInteger('quantity')->unsigned()->nullable(false);
            $table->smallInteger('quantityRevisi')->unsigned()->default('0');

            $table->mediumInteger('total')->unsigned()->nullable(false);
            $table->mediumInteger('totalRevisi')->unsigned()->default('0');

            $table->unsignedBigInteger('idRevQuantity')->default('1');
            $table->foreign('idRevQuantity')->references('id')->on('revisi');

            $table->unsignedBigInteger('idRevTotal')->default('1');
            $table->foreign('idRevTotal')->references('id')->on('revisi');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->unsignedBigInteger('idPerevisi');
            $table->foreign('idPerevisi')->references('id')->on('duser');
            
            $table->timestamps();
            
        });

        Schema::create('status_robot', function (Blueprint $table) {
            $table->id();
            $table->string('status');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('robot_pembelian_status',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idPattyCashHarian');
            $table->foreign('idPattyCashHarian')->references('id')->on('patty_cash_harian');
            
            $table->unsignedBigInteger('idPemverifikasi');
            $table->foreign('idPemverifikasi')->references('id')->on('duser');
            
            $table->timestamps();
        });

        Schema::create('robot_pembayaran_status',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idPattyCashHarian');
            $table->foreign('idPattyCashHarian')->references('id')->on('patty_cash_harian');
            
            $table->unsignedBigInteger('idPemverifikasi');
            $table->foreign('idPemverifikasi')->references('id')->on('duser');
            
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
