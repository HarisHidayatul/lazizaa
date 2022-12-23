<?php

use GuzzleHttp\Promise\Create;
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
        //one to one relationship database
        Schema::create('revisi',function(Blueprint $table){
            $table->id();
            $table->string('status')->unique()->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tanggalAll',function(Blueprint $table){
            $table->id();
            $table->date('Tanggal'); //format yyyy-mm-dd

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('satuan',function(Blueprint $table){
            $table->id();
            $table->string('Satuan')->unique()->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('drole', function (Blueprint $table) {
            $table->id();
            $table->string("Role")->unique()->nullable(false);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dBrand',function(Blueprint $table){
            $table->id();
            $table->string('Nama Brand')->nullable(false);
            $table->string('Keterangan');
            $table->string('Image');
            // $table->string('Logo URL');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('doutlet', function (Blueprint $table) {
            $table->id();
            $table->string('Nama Store')->nullable(false);
            $table->string('Alamat Lengkap')->nullable(false);
            
            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('dBrand');
            
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('typeOutlet',function(Blueprint $table){
            $table->id();
            $table->string('Nama Type');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('outlet_type',function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');
            $table->unsignedBigInteger('idType');
            $table->foreign('idType')->references('id')->on('typeOutlet');
            $table->timestamps();
            // $table->softDeletes();
        });

        
        Schema::create('duser', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idRole');
            $table->foreign('idRole')->references('id')->on('drole');

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->string('Username')->unique();
            $table->string('Password')->nullable(false);
            $table->string('Nama Lengkap')->nullable(false);
            $table->string('Email')->unique()->nullable(false);
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('listItemSO', function (Blueprint $table) {
            $table->id();
            $table->string('Item');
            $table->string('icon');
            
            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('type_item', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idBahanBaku');
            $table->foreign('idBahanBaku')->references('id')->on('typeOutlet'); 
            
            $table->unsignedBigInteger('idItem');
            $table->foreign('idItem')->references('id')->on('listItemSO'); 

            $table->timestamps();
            // $table->softDeletes();
        });//ini yang benar untuk type itemm, yang atas salah

        Schema::create('fsoharian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet'); //membuat relasi ke tabel dOutlet


            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalAll');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('soFill',function(Blueprint $table){
            $table->id();

            $table->unsignedBigInteger('idSo');
            $table->foreign('idSo')->references('id')->on('fsoharian');

            $table->unsignedBigInteger('idItemSo');
            $table->foreign('idItemSo')->references('id')->on('listItemSO');

            $table->integer('quantity')->unsigned()->nullable(false);

            $table->integer('quantityRevisi')->unsigned()->default('0');

            $table->unsignedBigInteger('idRevisi')->default('1');
            $table->foreign('idRevisi')->references('id')->on('revisi');

            $table->unsignedBigInteger('idPerevisi');
            $table->foreign('idPerevisi')->references('id')->on('dUser');

            $table->timestamps();
            // $table->softDeletes();
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
        Schema::dropIfExists('outlet_type');
        Schema::dropIfExists('type_item');
        Schema::dropIfExists('typeOutlet');
        Schema::dropIfExists('soFill');
        Schema::dropIfExists('fsoharian');
        Schema::dropIfExists('listItemSO');        
        
        Schema::dropIfExists('reqItemSales');
        Schema::dropIfExists('outletListSales');
        Schema::dropIfExists('salesFill');
        Schema::dropIfExists('listSales');
        Schema::dropIfExists('typeSales');

        //
        Schema::dropIfExists('reqItemPattyCash');
        Schema::dropIfExists('pattyCashFill');
        Schema::dropIfExists('brandPattyCash');
        Schema::dropIfExists('pattyCashHarian');
        Schema::dropIfExists('listItemPattyCash');

        Schema::dropIfExists('reqItemWaste');
        Schema::dropIfExists('wasteFill');
        Schema::dropIfExists('brandWaste');
        Schema::dropIfExists('wasteHarian');
        Schema::dropIfExists('listItemWaste');
        Schema::dropIfExists('jenisBahan');
        
        Schema::dropIfExists('penerimaReimburse');
        Schema::dropIfExists('reimburse');

        Schema::dropIfExists('setoran');
        Schema::dropIfExists('pengirimList');
        Schema::dropIfExists('penerimaList');
        Schema::dropIfExists('listBank');
        Schema::dropIfExists('jenisBank');
        
        Schema::dropIfExists('salesharian');
        Schema::dropIfExists('duser');
        Schema::dropIfExists('drole');
        Schema::dropIfExists('doutlet');
        Schema::dropIfExists('dBrand');
        Schema::dropIfExists('revisi');
        Schema::dropIfExists('satuan');
        Schema::dropIfExists('tanggalAll');
    }
};
