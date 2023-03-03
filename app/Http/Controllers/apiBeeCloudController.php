<?php

namespace App\Http\Controllers;

use App\Models\listItemSO;
use App\Models\satuan;
use Illuminate\Http\Request;

class apiBeeCloudController extends Controller
{
    //
    public function refreshAPISoHarian()
    {
        $satuanAll = [];
        $itemSOAll = [];

        // Token atau kunci API yang diperlukan untuk autentikasi
        $token = 'eyJ0eXAiOiJKV1MiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcHAuYmVlY2xvdWQuaWQiLCJqdGkiOiI4MjcwZWM0MGRlN2NmMmMwNjRkODgzOGEyZWIwMDk2NyIsImRibmFtZSI6IjE4NDAyYXJpc3RyYXZlbG9rYSIsImRiaG9zdCI6IjEwLjEzMC4yLjE1NyIsInVzZXJfaWQiOiIzIn0.BpU5CqCQY8wWNGhjzDc3YpRhmQ6Z_POt8KsBLXGCGXo';

        // Menambahkan header Authorization pada permintaan GET
        $options = array(
            'http' => array(
                'header' => "Authorization: Bearer $token\r\n"
            )
        );

        // Mengambil data dari API dengan stream_context_create() dan file_get_contents()
        $context = stream_context_create($options);

        //Dapatkan semua satuan pada database
        $satuanDB = satuan::all();

        for ($i = 0; $i < $satuanDB->count(); $i++) {
            $satuan = [];
            array_push($satuan, $satuanDB[$i]->Satuan, $satuanDB[$i]->id);

            array_push($satuanAll, $satuan);
        }
        // @dd($satuanAll);

        ///   Program Berikut Untuk Update Satuan Agar Sama Dengan Unit Satuan Pada Bee Cloud ////
        $urlSatuan = 'https://private-anon-d985942e71-beecloud.apiary-proxy.com/api/v1/unit';
        $data = file_get_contents($urlSatuan, false, $context);
        $result = json_decode($data);

        // print_r(json_encode($result));
        foreach ($result->data as $item) {
            $satuanBeeCloud = $item->unit;
            $dataFound = false;
            for ($i = 0; $i < count($satuanAll); $i++) {
                if (strcmp($satuanAll[$i][0], $satuanBeeCloud) == 0) {
                    $dataFound = true;
                    break;
                }
            }
            if (!$dataFound) {
                $satuanDatabase = new satuan();
                $satuanDatabase->Satuan = $satuanBeeCloud;
                $satuanDatabase->save();

                $satuan = [];
                array_push($satuan, $satuanBeeCloud, $satuanDatabase->id);

                array_push($satuanAll, $satuan);
            }
            // echo ($item->unit);
            // echo '<br>';
        }

        // $satuanDB = satuan::all();
        // for ($i = 0; $i < $satuanDB->count(); $i++) {
        //     echo $satuanDB[$i]->Satuan;
        //     echo '<br>';
        // }


        $list_item_so = listItemSO::all();
        for ($i = 0; $i< $list_item_so->count(); $i++) {
            $dataFound = false;
            for ($j = 0; $j < count($itemSOAll); $j++) {
                if ($itemSOAll[$j][0] == $list_item_so[$i]->id_bee_cloud_item) {
                    $dataFound = true;
                    break;
                }
            }
            if (!$dataFound) {
                $itemso = [];
                array_push($itemso, $list_item_so[$i]->id_bee_cloud_item, $list_item_so[$i]->id);

                array_push($itemSOAll, $itemso);
            }
        }

        ///   Program Berikut Untuk Update Item Agar Sama Dengan Item Pada Bee Cloud ////
        // URL API yang ingin diambil datanya
        $urlItem = 'https://private-anon-b3487e89e5-beecloud.apiary-proxy.com/api/v1/item';

        // Mengambil data dari API dengan stream_context_create() dan file_get_contents()
        $context = stream_context_create($options);
        $data = file_get_contents($urlItem, false, $context);

        // Mengubah respons JSON menjadi objek PHP dengan json_decode()
        $result = json_decode($data);

        // $result2 = json_encode($result);
        // echo $result2;
        // print_r($result->data[0]->name1);
        foreach ($result->data as $item) {
            // echo($item->name1);
            // echo(' ');
            $dataFoundSO = false;
            $indexIfFoundSO = 1;

            for ($i = 0; $i < count($itemSOAll); $i++) {
                if($itemSOAll[$i][0] == $item->id){
                    $indexIfFoundSO = $i;
                    $dataFoundSO = true;
                    break;
                }
            }

            $indexSatuan = 1;

            for ($j = 0; $j < count($satuanAll); $j++) {
                if (strcmp($satuanAll[$j][0], $item->unitdesc) == 0) {
                    $indexSatuan = $j;
                    break;
                }
            }

            if($dataFoundSO){
                listItemSO::find($itemSOAll[$indexIfFoundSO][1])->update([
                    'Item' => $item->name1,
                    'idSatuan' => $satuanAll[$indexSatuan][1]
                ]);
            }else{
                $list_so_db = new listItemSO();
                $list_so_db->Item = $item->name1;
                $list_so_db->idSatuan = $satuanAll[$indexSatuan][1];
                $list_so_db->icon = 'defaultItem.svg';
                $list_so_db->id_bee_cloud_item = $item->id;
                $list_so_db->save();

                
                $itemso = [];
                array_push($itemso, $list_so_db->id_bee_cloud_item, $list_so_db->id);

                array_push($itemSOAll, $itemso);
            }
            // echo($item->unitdesc);
            // echo '<br>';
        }
        print_r($itemSOAll);
    }
}
