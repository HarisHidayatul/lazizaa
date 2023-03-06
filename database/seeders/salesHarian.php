<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class salesHarian extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('type_sales')->insert(
            array(
                [
                    'type' => 'Organik',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'type' => 'Non Organik',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'type' => 'E-Commerce',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ]
            )    
        );
        DB::table('list_sales')->insert(
            array(
                [
                    'typeSales' => '1',
                    'sales'     => 'NULL',
                    'id_channel_bee_cloud' => '0',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '1',
                    'sales'     => 'Dine In',
                    'id_channel_bee_cloud' => '1',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '1',
                    'sales'     => 'Take Away',
                    'id_channel_bee_cloud' => '2',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Delivery Order',
                    'id_channel_bee_cloud' => '3',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '3',
                    'sales'     => 'Gojek',
                    'id_channel_bee_cloud' => '4',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '3',
                    'sales'     => 'Grab',
                    'id_channel_bee_cloud' => '5',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '3',
                    'sales'     => 'Shopee',
                    'id_channel_bee_cloud' => '6',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '3',
                    'sales'     => 'Shopeefood',
                    'id_channel_bee_cloud' => '7',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Big Order',
                    'id_channel_bee_cloud' => '8',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Bazar',
                    'id_channel_bee_cloud' => '9',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Telemarketing',
                    'id_channel_bee_cloud' => '10',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Fun Class',
                    'id_channel_bee_cloud' => '11',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Reseller',
                    'id_channel_bee_cloud' => '12',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Party',
                    'id_channel_bee_cloud' => '13',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '3',
                    'sales'     => 'Traveloka',
                    'id_channel_bee_cloud' => '14',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Mall',
                    'id_channel_bee_cloud' => '15',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            )
        );
    }
}
