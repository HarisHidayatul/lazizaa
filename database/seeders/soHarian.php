<?php

namespace Database\Seeders;

use App\Models\dUser;
use App\Models\itemWaste;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class soHarian extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();
        $satuan = array("Gram","Kilogram","Potong","Buah");
        for($i=0;$i<count($satuan);$i++){
            DB::table('satuan')->insert([
                'Satuan' => $satuan[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        DB::table('revisi')->insert(
            array(
                [
                    'status' => 'Tidak Ada Revisi',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'status' => 'Menunggu Revisi',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'status' => 'Sudah Di Revisi',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            )    
        );
        DB::table('dBrand')->insert(
            array(
                [
                    'Nama Brand' => 'Lazizaa',
                    'Image'      => '/img/lazizaa.jpg',
                    'Keterangan' => $faker->text(),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'Nama Brand' => 'Babarafi',
                    'Image'      => '/img/babarafi.jpg',
                    'Keterangan' => $faker->text(),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'Nama Brand' => 'Kopi Ambyar',
                    'Image'      => '/img/kopiambyar.jpg',
                    'Keterangan' => $faker->text(),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            )
        );
        $outletLazizaa = array(
            "Lazizaa Kedungturi",
            "Lazizaa Wadung Asri",
            "Lazizaa Jambangan",
            "Lazizaa Sukodono",
            "Lazizaa Wonoayu",
            "Lazizaa Nyamplungan",
            "Lazizaa Krian",
            "Lazizaa Tulangan",
            "Lazizaa Trunojoyo",
            "Lazizaa Suhat"
        );
        for ($i = 1; $i <= 10; $i++) {
            DB::table('doutlet')->insert([
                'Nama Store' => $outletLazizaa[$i-1],
                'Alamat Lengkap' => $faker->address(),
                'idBrand' => $faker->numberBetween(1,3),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        DB::table('drole')->insert(
            array(
                [
                    'Role' => 'Accounting',

                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'Role'  => 'Supervisor',

                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            )
        );
        for ($i = 1; $i <= 50; $i++) {
            DB::table('duser')->insert(
                [
                    'idRole' => $faker->numberBetween(1,2),
                    'idOutlet' => $faker->numberBetween(1,10),
                    'Nama Lengkap' => $faker->name(),
                    'username' => $faker->userName(),
                    'password' => '1234',
                    'Email' => $faker->email(),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            );
        }
        $itemSO = array(
            'Beras', 'French Fries', 'Milo', 'Tepung Ori', 'Minyak Padat',
            'Ayam Reg Besar', 'Ayam Reg Kecil', 'Ayam Utuh', 'Ayam Fillet',
            'Ayam Small', 'Dori Triming', 'Chili Sachet', 'Tomat Sachet',
            'Sambal Bawang', 'Sambal Korek', 'Sambal Bajak', 'Saus BBQ',
            'Saus BP', 'Lunch Box', 'Rame Box', 'Box Geprek', 'Bubuk Candy',
            'Buble Gum', 'SKM'
        );
        for ($i = 0; $i < 24; $i++) {
            DB::table('listItemSO')->insert([
                'Item' => $itemSO[$i],
                'idSatuan' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        DB::table('jenisBahan')->insert(
            array
            (
                [
                    'jenis' => 'Menu'
                ],
                [
                    'jenis' => 'Bahan Baku'
                ]
            )
        );       
    }
}
