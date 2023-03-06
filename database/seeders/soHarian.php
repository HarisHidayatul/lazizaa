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

        // $faker = Faker::create();
        // $satuan = array("gr","kg","pcs","scht");
        // for($i=0;$i<count($satuan);$i++){
        //     DB::table('satuan')->insert([
        //         'Satuan' => $satuan[$i],
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        //     ]);
        // }
        DB::table('list_sesi')->insert(
            array(
                [
                    'sesi' => 'Sesi 1',
                    'startTime' => '07:00:00',
                    'stopTime' => '13:59:00',
                ],
                [
                    'sesi' => 'Sesi 2',
                    'startTime' => '14:00:00',
                    'stopTime' => '21:59:00',
                ],
                [
                    'sesi' => 'Sesi 3',
                    'startTime' => '22:00:00',
                    'stopTime' => '06:59:00',
                ]
            )
        );
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
        DB::table('dbrand')->insert(
            array(
                [
                    'Nama Brand' => 'Lazizaa',
                    'Image'      => '/img/dashboard/lazizaaLogo.png',
                    'Keterangan' => 'Makan Ayam Rame-Rame',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                // [
                //     'Nama Brand' => 'Babarafi',
                //     'Image'      => '/img/dashboard/babarafiLogo.png',
                //     'Keterangan' => $faker->text(35),
                //     'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                // ],
                // [
                //     'Nama Brand' => 'Kopi Ambyar',
                //     'Image'      => '/img/dashboard/kopiAmbyarLogo.png',
                //     'Keterangan' => $faker->text(35),
                //     'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                // ]
            )
        );

        // DB::table('doutlet')->insert([
        //     'Nama Store' => "Central Office HO",
        //     'Alamat Lengkap' => "Dsn. Ketapang, Suko, Kec Sukodono, Sidoarjo",
        //     'idBrand' => '1',
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]);

        DB::table('drole')->insert(
            array(
                [
                    'Role' => 'Accounting',

                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'Role'  => 'Supervisor',
                    
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'Role' => 'Admin',
                    
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            )
        );

        DB::table('doutlet')->insert(
            array
            (
                [
                    'Nama Store' => 'Kedungturi',
                    'Alamat Lengkap' => 'Kedungturi',
                    'branch_id_bee_cloud' => '25',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Sumorame',
                    'Alamat Lengkap' => 'Sumorame',
                    'branch_id_bee_cloud' => '26',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Krian',
                    'Alamat Lengkap' => 'Krian',
                    'branch_id_bee_cloud' => '27',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Sekardangan',
                    'Alamat Lengkap' => 'Sekardangan',
                    'branch_id_bee_cloud' => '28',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Tulangan',
                    'Alamat Lengkap' => 'Tulangan',
                    'branch_id_bee_cloud' => '29',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Sidokare',
                    'Alamat Lengkap' => 'Sidokare',
                    'branch_id_bee_cloud' => '30',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Ganting',
                    'Alamat Lengkap' => 'Ganting',
                    'branch_id_bee_cloud' => '31',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Wadung Asri',
                    'Alamat Lengkap' => 'Wadung Asri',
                    'branch_id_bee_cloud' => '32',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Probolinggo',
                    'Alamat Lengkap' => 'Probolinggo',
                    'branch_id_bee_cloud' => '33',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Kusuma Bangsa',
                    'Alamat Lengkap' => 'Kusuma Bangsa',
                    'branch_id_bee_cloud' => '34',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'GK Kedungsari',
                    'Alamat Lengkap' => 'GK Kedungsari',
                    'branch_id_bee_cloud' => '35',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Ampel',
                    'Alamat Lengkap' => 'Ampel',
                    'branch_id_bee_cloud' => '36',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Bungkul',
                    'Alamat Lengkap' => 'Bungkul',
                    'branch_id_bee_cloud' => '37',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'RA Jombang',
                    'Alamat Lengkap' => 'RA Jombang',
                    'branch_id_bee_cloud' => '38',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'GK Darmo Permai',
                    'Alamat Lengkap' => 'GK Darmo Permai',
                    'branch_id_bee_cloud' => '39',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'CK Pondok Aren',
                    'Alamat Lengkap' => 'CK Pondok Aren',
                    'branch_id_bee_cloud' => '40',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'CK Mangonda',
                    'Alamat Lengkap' => 'CK Mangonda',
                    'branch_id_bee_cloud' => '41',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Suhat',
                    'Alamat Lengkap' => 'Suhat',
                    'branch_id_bee_cloud' => '42',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Ponorogo',
                    'Alamat Lengkap' => 'Ponorogo',
                    'branch_id_bee_cloud' => '43',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'PT. Lazizaa Rahmat Semesta',
                    'Alamat Lengkap' => 'PT. Lazizaa Rahmat Semesta',
                    'branch_id_bee_cloud' => '24',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Serua Jakarta',
                    'Alamat Lengkap' => 'Serua Jakarta',
                    'branch_id_bee_cloud' => '44',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Pati',
                    'Alamat Lengkap' => 'Pati',
                    'branch_id_bee_cloud' => '45',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Capiting KBA',
                    'Alamat Lengkap' => 'Capiting KBA',
                    'branch_id_bee_cloud' => '46',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'SCM',
                    'Alamat Lengkap' => 'SCM',
                    'branch_id_bee_cloud' => '48',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Trunojoyo',
                    'Alamat Lengkap' => 'Trunojoyo',
                    'branch_id_bee_cloud' => '49',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Pandaan',
                    'Alamat Lengkap' => 'Pandaan',
                    'branch_id_bee_cloud' => '50',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Bungkul Baru',
                    'Alamat Lengkap' => 'Bungkul Baru',
                    'branch_id_bee_cloud' => '51',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Gedangan',
                    'Alamat Lengkap' => 'Gedangan',
                    'branch_id_bee_cloud' => '52',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Tebel',
                    'Alamat Lengkap' => 'Tebel',
                    'branch_id_bee_cloud' => '53',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Sidayu',
                    'Alamat Lengkap' => 'Sidayu',
                    'branch_id_bee_cloud' => '54',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Wonoayu',
                    'Alamat Lengkap' => 'Wonoayu',
                    'branch_id_bee_cloud' => '55',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Sigura-gura',
                    'Alamat Lengkap' => 'Sigura-gura',
                    'branch_id_bee_cloud' => '56',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Pasuruan',
                    'Alamat Lengkap' => 'Pasuruan',
                    'branch_id_bee_cloud' => '57',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Sukun Baru',
                    'Alamat Lengkap' => 'Sukun Baru',
                    'branch_id_bee_cloud' => '58',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Keputih',
                    'Alamat Lengkap' => 'Keputih',
                    'branch_id_bee_cloud' => '59',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Bangil',
                    'Alamat Lengkap' => 'Bangil',
                    'branch_id_bee_cloud' => '60',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Batu',
                    'Alamat Lengkap' => 'Batu',
                    'branch_id_bee_cloud' => '61',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Madiun',
                    'Alamat Lengkap' => 'Madiun',
                    'branch_id_bee_cloud' => '62',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Magetan',
                    'Alamat Lengkap' => 'Magetan',
                    'branch_id_bee_cloud' => '63',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Ngawi',
                    'Alamat Lengkap' => 'Ngawi',
                    'branch_id_bee_cloud' => '64',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Ampel Baru',
                    'Alamat Lengkap' => 'Ampel Baru',
                    'branch_id_bee_cloud' => '65',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Petemon',
                    'Alamat Lengkap' => 'Petemon',
                    'branch_id_bee_cloud' => '66',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'BR Booth Bekasi',
                    'Alamat Lengkap' => 'BR Booth Bekasi',
                    'branch_id_bee_cloud' => '69',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'BR Phx Grogol',
                    'Alamat Lengkap' => 'BR Phx Grogol',
                    'branch_id_bee_cloud' => '68',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Panjaitan',
                    'Alamat Lengkap' => 'Panjaitan',
                    'branch_id_bee_cloud' => '70',
                    'idBrand' => '1'
                ],
                [
                    'Nama Store' => 'Trial',
                    'Alamat Lengkap' => 'Trial',
                    'branch_id_bee_cloud' => '71',
                    'idBrand' => '1'
                ],
            )
        );

        DB::table('duser')->insert(
            [
                'idRole' => '3',
                'idOutlet' => '1',
                'Nama Lengkap' => 'admin',
                'username' => 'admin',
                'password' => '1234',
                'Email' => 'hidayatulloh.haris@gmail.com',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        );

        // $itemSO = array(
        //     'Beras', 'Milo', 'French Fries', 'Tepung Ori', 'Minyak Padat', 'Ayam Reg Kecil',
        //     'Ayam Reg Besar', 'Ayam Utuh', 'Ayam Fillet', 'Ayam Small', 'Dori Triming',
        //     'Chili Sachet', 'Tomat Sachet', 'Sambal Bawang','Sambal Korek','Sambal Bajak',
        //     'Saus BBQ', 'Saus BP', 'Lunch Box', 'Rame Box', 'Box Geprek','Bubuk Candy', 'Bubble Gum',
        //     'SKM'
        // );
        // $itemIcon = array(
        //     'beras.svg','milo.svg','frenchfries.svg','tepungOri.svg','minyakpadat.svg','ayamRegKecil.svg',
        //     'ayamRegBesar.svg', 'ayamUtuh.svg', 'ayamFillet.svg','ayamSmall.svg','doriTriming.svg',
        //     'chiliSachet.svg','tomat.svg', 'sambalBawang.svg','sambalKorek.svg','sambalBajak.svg',
        //     'sausBBQ.svg','sausBP.svg','lunchBox.svg','rameBox.svg','boxGeprek.svg','bubukCandy.svg','bubbleGum.svg',
        //     'skm.svg'
        // );
        // for ($i = 0; $i < 24; $i++) {
        //     DB::table('list_item_so')->insert([
        //         'Item' => $itemSO[$i],
        //         'icon' => $itemIcon[$i],
        //         'idSatuan' => '1',
        //         'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        //     ]);
        // }
        DB::table('jenis_bahan')->insert(
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
        
        DB::table('jenis_bank')->insert(
            array
            (
                [
                    'jenis' => 'transfer'
                ],
                [
                    'jenis' => 'eWallet'
                ]
            )
        );
        DB::table('list_bank')->insert(
            array
            (
                [
                    'idJenisBank' => '1',
                    'bank' => 'BCA',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/bca.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'BNI',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/bni.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'BRI',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/bri.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'BSI',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/bsi.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'Bukopin',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/bukopin.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'CIMB',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/cimb.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'Danamon',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/danamon.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'Jago',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/jago.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'Jatim',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/jatim.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'Mandiri',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/mandiri.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'Muamalat',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/muamalat.png'
                ],
                [
                    'idJenisBank' => '1',
                    'bank' => 'Permata',
                    'imageBank' => 'img/pembayaran/logoBank/transfer/permata.png'
                ],
                [
                    'idJenisBank' => '2',
                    'bank' => 'Dana',
                    'imageBank' => 'img/pembayaran/logoBank/eWallet/dana.png'
                ],
                [
                    'idJenisBank' => '2',
                    'bank' => 'Gopay',
                    'imageBank' => 'img/pembayaran/logoBank/eWallet/gopay.png'
                ],
                [
                    'idJenisBank' => '2',
                    'bank' => 'Ovo',
                    'imageBank' => 'img/pembayaran/logoBank/eWallet/ovo.png'
                ],
                [
                    'idJenisBank' => '2',
                    'bank' => 'Shopeepay',
                    'imageBank' => 'img/pembayaran/logoBank/eWallet/shopeepay.png'
                ]
            )
        );
    }
}
