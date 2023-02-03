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
        Schema::create('jenisbahan',function(Blueprint $table){
            $table->id();
            $table->string('jenis',25);

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('listitemwaste', function (Blueprint $table) {
            $table->id();

            $table->string('Item',25);
            
            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->unsignedBigInteger('idJenisBahan');
            $table->foreign('idJenisBahan')->references('id')->on('jenisbahan');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reqitemwaste', function (Blueprint $table) {
            $table->id();

            $table->string('Item');
            
            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('idJenisBahan');
            $table->foreign('idJenisBahan')->references('id')->on('jenisbahan');

            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('dbrand');

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalall');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->timestamps();
        });

        Schema::create('brandwaste', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('dbrand');

            $table->unsignedBigInteger('idListItem');
            $table->foreign('idListItem')->references('id')->on('listitemwaste');

            $table->timestamps();
        });

        Schema::create('wasteharian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalall');

            $table->unsignedBigInteger('idSesi');
            $table->foreign('idSesi')->references('id')->on('listsesi');
            
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('wastefill', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idWaste');
            $table->foreign('idWaste')->references('id')->on('wasteharian');

            $table->unsignedBigInteger('idListItem');
            $table->foreign('idListItem')->references('id')->on('listitemwaste');

            $table->smallInteger('quantity')->unsigned()->nullable(false);
            $table->smallInteger('quantityRevisi')->unsigned()->default('0');

            $table->unsignedBigInteger('idRevQuantity')->default('1');
            $table->foreign('idRevQuantity')->references('id')->on('revisi');

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
