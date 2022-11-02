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
        DB::table('typeSales')->insert(
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
        DB::table('listSales')->insert(
            array(
                [
                    'typeSales' => '1',
                    'sales'     => 'Dine In',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '1',
                    'sales'     => 'Take Away',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Bazar',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Cooking Class',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '2',
                    'sales'     => 'Event',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '3',
                    'sales'     => 'Go Jek',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '3',
                    'sales'     => 'Grab',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
                [
                    'typeSales' => '3',
                    'sales'     => 'Shopee',
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ],
            )
        );
    }
}
