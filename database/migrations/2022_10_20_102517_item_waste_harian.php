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
        Schema::create('jenisBahan',function(Blueprint $table){
            $table->id();
            $table->string('jenis');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('listItemWaste', function (Blueprint $table) {
            $table->id();

            $table->string('Item');
            
            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->unsignedBigInteger('idJenisBahan');
            $table->foreign('idJenisBahan')->references('id')->on('jenisBahan');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reqItemWaste', function (Blueprint $table) {
            $table->id();

            $table->string('Item');
            
            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('idJenisBahan');
            $table->foreign('idJenisBahan')->references('id')->on('jenisBahan');

            $table->timestamps();
        });

        Schema::create('brandWaste', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('dBrand');

            $table->unsignedBigInteger('idListItem');
            $table->foreign('idListItem')->references('id')->on('listItemWaste');

            $table->timestamps();
        });

        Schema::create('wasteHarian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalAll');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('wasteFill', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idWaste');
            $table->foreign('idWaste')->references('id')->on('WasteHarian');

            $table->unsignedBigInteger('idListItem');
            $table->foreign('idListItem')->references('id')->on('listItemWaste');

            $table->integer('quantity')->unsigned()->nullable(false);
            $table->integer('quantityRevisi')->unsigned()->default('0');

            $table->unsignedBigInteger('idRevQuantity')->default('1');
            $table->foreign('idRevQuantity')->references('id')->on('revisi');

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
        //
    }
};
