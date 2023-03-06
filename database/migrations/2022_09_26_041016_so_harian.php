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

        Schema::create('tanggal_all', function (Blueprint $table) {
            $table->id();
            $table->date('Tanggal'); //format yyyy-mm-dd
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('satuan', function (Blueprint $table) {
            $table->id();
            $table->string('Satuan', 10)->unique()->nullable(false);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('list_sesi', function (Blueprint $table) {
            $table->id();
            $table->string('sesi', 10);

            $table->time('startTime');
            $table->time('stopTime');

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

            $table->unsignedBigInteger('branch_id_bee_cloud')->default('0');

            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('type_outlet', function (Blueprint $table) {
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
            $table->foreign('idType')->references('id')->on('type_outlet');
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

        Schema::create('list_item_so', function (Blueprint $table) {
            $table->id();
            $table->string('Item',50);
            $table->string('icon',50);

            $table->unsignedBigInteger('idSatuan');
            $table->foreign('idSatuan')->references('id')->on('satuan');
            
            $table->boolean('munculMingguan')->default(false);
            $table->boolean('munculHarian')->default(false);

            $table->integer('id_bee_cloud_item')->unsigned()->default('0');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('type_item', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idBahanBaku');
            $table->foreign('idBahanBaku')->references('id')->on('type_outlet');

            $table->unsignedBigInteger('idItem');
            $table->foreign('idItem')->references('id')->on('list_item_so');

            $table->timestamps();
            // $table->softDeletes();
        }); //ini yang benar untuk type itemm, yang atas salah

        Schema::create('fso_harian', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idPengisi');
            $table->foreign('idPengisi')->references('id')->on('duser'); //membuat relasi ke tabel dUser

            $table->unsignedBigInteger('idOutlet');
            $table->foreign('idOutlet')->references('id')->on('doutlet'); //membuat relasi ke tabel dOutlet

            $table->unsignedBigInteger('idTanggal');
            $table->foreign('idTanggal')->references('id')->on('tanggal_all');

            $table->unsignedBigInteger('idSesi');
            $table->foreign('idSesi')->references('id')->on('list_sesi');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('so_fill', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idSo');
            $table->foreign('idSo')->references('id')->on('fso_harian');

            $table->unsignedBigInteger('idItemSo');
            $table->foreign('idItemSo')->references('id')->on('list_item_so');

            $table->smallInteger('quantity')->unsigned()->nullable(false);

            $table->smallInteger('quantityRevisi')->unsigned()->default('0');

            $table->unsignedBigInteger('idRevisi')->default('1');
            $table->foreign('idRevisi')->references('id')->on('revisi');

            $table->unsignedBigInteger('idPerevisi');
            $table->foreign('idPerevisi')->references('id')->on('duser');

            $table->timestamps();
            // $table->softDeletes();
        });

        Schema::create('so_harian_batas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('idItemSo');
            $table->foreign('idItemSo')->references('id')->on('list_item_so');

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
        Schema::dropIfExists('temp_img_all');

        Schema::dropIfExists('so_harian_batas');
        Schema::dropIfExists('outlet_type');
        Schema::dropIfExists('type_item');
        Schema::dropIfExists('type_outlet');
        Schema::dropIfExists('so_fill');
        Schema::dropIfExists('fso_harian');

        Schema::dropIfExists('req_item_sales');
        Schema::dropIfExists('outlet_list_sales');
        Schema::dropIfExists('sales_fill');
        Schema::dropIfExists('detail_transaksi_bee_cloud');
        Schema::dropIfExists('transaksi_bee_cloud');

        //
        Schema::dropIfExists('req_item_patty_cash');
        Schema::dropIfExists('patty_cash_fill');
        Schema::dropIfExists('brand_patty_cash');
        Schema::dropIfExists('patty_cash_harian');
        Schema::dropIfExists('list_item_patty_cash');
        Schema::dropIfExists('kategori_patty_cash');

        Schema::dropIfExists('req_item_waste');
        Schema::dropIfExists('waste_fill');
        Schema::dropIfExists('brand_waste');
        Schema::dropIfExists('waste_harian');
        Schema::dropIfExists('list_item_waste');
        Schema::dropIfExists('jenis_bahan');

        Schema::dropIfExists('penerima_reimburse');
        Schema::dropIfExists('reimburse');

        Schema::dropIfExists('setoran');
        Schema::dropIfExists('pengirim_list');
        Schema::dropIfExists('penerima_list');
        Schema::dropIfExists('list_bank');
        Schema::dropIfExists('jenis_bank');

        Schema::dropIfExists('list_sales');
        Schema::dropIfExists('type_sales');

        Schema::dropIfExists('list_item_so');

        Schema::dropIfExists('sales_harian');
        
        Schema::dropIfExists('duser');
        Schema::dropIfExists('drole');
        Schema::dropIfExists('doutlet');
        Schema::dropIfExists('dbrand');
        Schema::dropIfExists('revisi');
        Schema::dropIfExists('satuan');
        Schema::dropIfExists('tanggal_all');
        Schema::dropIfExists('list_sesi');
    }
};
