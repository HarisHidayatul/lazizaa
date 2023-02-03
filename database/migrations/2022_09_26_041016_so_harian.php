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
        Schema::create('revisi', function (Blueprint $table) {
            $table->id();
            $table->string('status')->unique()->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('tanggalall', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); //format yyyy-mm-dd

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('satuan', function (Blueprint $table) {
            $table->id();
            $table->string('Satuan', 10)->unique()->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('listsesi', function (Blueprint $table) {
            $table->id();
            $table->string('sesi', 10);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('drole', function (Blueprint $table) {
            $table->id();
            $table->string("Role", 10)->unique()->nullable(false);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('dbrand', function (Blueprint $table) {
            $table->id();
            $table->string('Nama Brand',25)->nullable(false);
            $table->string('Keterangan',50);
            $table->string('Image',50);
            // $table->string('Logo URL');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('doutlet', function (Blueprint $table) {
            $table->id();
            $table->string('Nama Store',50)->nullable(false);
            $table->string('Alamat Lengkap',100)->nullable(false);

            $table->unsignedBigInteger('idBrand');
            $table->foreign('idBrand')->references('id')->on('dbrand');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('typeoutlet', function (Blueprint $table) {
            $table->id();
            $table->string('Nama Type',25);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('outlet_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');
            $table->unsignedBigInteger('idType');
            $table->foreign('idType')->references('id')->on('typeoutlet');
            $table->timestamps();
            // $table->softDeletes();
        });


        Schema::create('duser', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idRole');
            $table->foreign('idRole')->references('id')->on('drole');

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet');

            $table->string('Username',25)->unique()->nullable(false);
            $table->string('Password',25)->nullable(false);
            $table->string('Nama Lengkap',50)->nullable(false);
            $table->string('Email',35)->unique()->nullable(false);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('listitemso', function (Blueprint $table) {
            $table->id();
            $table->string('Item',25);
            $table->string('icon',50);

            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('type_item', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idBahanBaku');
            $table->foreign('idBahanBaku')->references('id')->on('typeoutlet');

            $table->unsignedBigInteger('idItem');
            $table->foreign('idItem')->references('id')->on('listitemso');

            $table->timestamps();
            // $table->softDeletes();
        }); //ini yang benar untuk type itemm, yang atas salah

        Schema::create('fsoharian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet'); //membuat relasi ke tabel dOutlet

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggalall');

            $table->unsignedBigInteger('idSesi');
            $table->foreign('idSesi')->references('id')->on('listsesi');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sofill', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idSo');
            $table->foreign('idSo')->references('id')->on('fsoharian');

            $table->unsignedBigInteger('idItemSo');
            $table->foreign('idItemSo')->references('id')->on('listitemso');

            $table->smallInteger('quantity')->unsigned()->nullable(false);

            $table->smallInteger('quantityRevisi')->unsigned()->default('0');

            $table->unsignedBigInteger('idRevisi')->default('1');
            $table->foreign('idRevisi')->references('id')->on('revisi');

            $table->unsignedBigInteger('idPerevisi');
            $table->foreign('idPerevisi')->references('id')->on('duser');

            $table->timestamps();
            // $table->softDeletes();
        });

        Schema::create('soharianbatas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idItemSo');
            $table->foreign('idItemSo')->references('id')->on('listitemso');

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet'); //membuat relasi ke tabel dOutlet

            $table->smallInteger('quantity')->unsigned();

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
        Schema::dropIfExists('soharianbatas');
        Schema::dropIfExists('outlet_type');
        Schema::dropIfExists('type_item');
        Schema::dropIfExists('typeoutlet');
        Schema::dropIfExists('sofill');
        Schema::dropIfExists('fsoharian');
        Schema::dropIfExists('listitemso');

        Schema::dropIfExists('reqitemsales');
        Schema::dropIfExists('outletlistsales');
        Schema::dropIfExists('salesfill');
        Schema::dropIfExists('listsales');
        Schema::dropIfExists('typesales');

        //
        Schema::dropIfExists('reqitempattycash');
        Schema::dropIfExists('pattycashfill');
        Schema::dropIfExists('brandpattycash');
        Schema::dropIfExists('pattycashharian');
        Schema::dropIfExists('listitempattycash');

        Schema::dropIfExists('reqitemwaste');
        Schema::dropIfExists('wastefill');
        Schema::dropIfExists('brandwaste');
        Schema::dropIfExists('wasteharian');
        Schema::dropIfExists('listitemwaste');
        Schema::dropIfExists('jenisbahan');

        Schema::dropIfExists('penerimareimburse');
        Schema::dropIfExists('reimburse');

        Schema::dropIfExists('setoran');
        Schema::dropIfExists('pengirimlist');
        Schema::dropIfExists('penerimalist');
        Schema::dropIfExists('listbank');
        Schema::dropIfExists('jenisbank');

        Schema::dropIfExists('salesharian');
        Schema::dropIfExists('duser');
        Schema::dropIfExists('drole');
        Schema::dropIfExists('doutlet');
        Schema::dropIfExists('dbrand');
        Schema::dropIfExists('revisi');
        Schema::dropIfExists('satuan');
        Schema::dropIfExists('tanggalall');
        Schema::dropIfExists('listsesi');
    }
};
