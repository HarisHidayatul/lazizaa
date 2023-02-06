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
        $satuan = array("gr","kg","pcs","scht");
        for($i=0;$i<count($satuan);$i++){
            DB::table('satuan')->insert([
                'Satuan' => $satuan[$i],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
        DB::table('list_sesi')->insert(
            array(
                [
                    'sesi' => 'Sesi 1'
                ],
                [
                    'sesi' => 'Sesi 2'
                ],
                [
                    'sesi' => 'Sesi 3'
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

        DB::table('doutlet')->insert([
            'Nama Store' => "Central Office HO",
            'Alamat Lengkap' => "Dsn. Ketapang, Suko, Kec Sukodono, Sidoarjo",
            'idBrand' => '1',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

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

        $itemSO = array(
            'Beras', 'Milo', 'French Fries', 'Tepung Ori', 'Minyak Padat', 'Ayam Reg Kecil',
            'Ayam Reg Besar', 'Ayam Utuh', 'Ayam Fillet', 'Ayam Small', 'Dori Triming',
            'Chili Sachet', 'Tomat Sachet', 'Sambal Bawang','Sambal Korek','Sambal Bajak',
            'Saus BBQ', 'Saus BP', 'Lunch Box', 'Rame Box', 'Box Geprek','Bubuk Candy', 'Bubble Gum',
            'SKM'
        );
        $itemIcon = array(
            'beras.svg','milo.svg','frenchfries.svg','tepungOri.svg','minyakpadat.svg','ayamRegKecil.svg',
            'ayamRegBesar.svg', 'ayamUtuh.svg', 'ayamFillet.svg','ayamSmall.svg','doriTriming.svg',
            'chiliSachet.svg','tomat.svg', 'sambalBawang.svg','sambalKorek.svg','sambalBajak.svg',
            'sausBBQ.svg','sausBP.svg','lunchBox.svg','rameBox.svg','boxGeprek.svg','bubukCandy.svg','bubbleGum.svg',
            'skm.svg'
        );
        for ($i = 0; $i < 24; $i++) {
            DB::table('list_item_so')->insert([
                'Item' => $itemSO[$i],
                'icon' => $itemIcon[$i],
                'idSatuan' => '1',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
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
