<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\listItemSO;
use App\Models\listSales;
use App\Models\listSesi;
use App\Models\salesharian;
use App\Models\satuan;
use App\Models\tanggalAll;
use App\Models\transaksi_bee_cloud;
use DateTime;
use Illuminate\Http\Request;

class apiBeeCloudController extends Controller
{
    //
    // Token atau kunci API yang diperlukan untuk autentikasi
    private $token = 'eyJ0eXAiOiJKV1MiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9hcHAuYmVlY2xvdWQuaWQiLCJqdGkiOiI4MjcwZWM0MGRlN2NmMmMwNjRkODgzOGEyZWIwMDk2NyIsImRibmFtZSI6IjE4NDAyYXJpc3RyYXZlbG9rYSIsImRiaG9zdCI6IjEwLjEzMC4yLjE1NyIsInVzZXJfaWQiOiIzIn0.BpU5CqCQY8wWNGhjzDc3YpRhmQ6Z_POt8KsBLXGCGXo';
    private $context;

    //$satuanAll memiliki value [namaSatuan]
    private $satuanAll;

    //$itemSOAll memiliki value [idBeeCloud,idDiLaporta]
    private $itemSOAll;

    //$outletAll memiliki value [idBeeCloud, idDiLaporta]
    private $outletAll;

    //$sesiAll ini memiliki value [startTime, stopTime, idSesi]
    private $sesiAll;

    //$tanggalAll ini memiliki value [tanggal, idTanggal]
    private $tanggalAll;

    function __construct()
    {
        // Menambahkan header Authorization pada permintaan GET
        $options = array(
            'http' => array(
                'header' => "Authorization: Bearer $this->token\r\n"
            )
        );

        // Mengambil data dari API dengan stream_context_create() dan file_get_contents()
        $this->context = stream_context_create($options);

        $this->satuanAll = [];
        $this->itemSOAll = [];
        $this->outletAll = [];

        //Dapatkan semua satuan pada database
        $satuanDB = satuan::all();

        for ($i = 0; $i < $satuanDB->count(); $i++) {
            $satuan = [];
            array_push($satuan, $satuanDB[$i]->Satuan, $satuanDB[$i]->id);

            array_push($this->satuanAll, $satuan);
        }

        //Dapatkan semua item so dan masukkan ke array
        $list_item_so = listItemSO::all();
        for ($i = 0; $i < $list_item_so->count(); $i++) {
            $itemso = [];
            array_push($itemso, $list_item_so[$i]->id_bee_cloud_item, $list_item_so[$i]->id);
            array_push($this->itemSOAll, $itemso);
        }

        //dapatkan semua outlet dan masukkan ke array
        $doutlet = doutlet::all();
        for ($i = 0; $i < $doutlet->count(); $i++) {
            $outletTemp = [];
            array_push($outletTemp, $doutlet[$i]->branch_id_bee_cloud, $doutlet[$i]->id);
            array_push($this->outletAll, $outletTemp);
        }

        //Dapatkan semua sesi dan masukkan ke array
        $this->sesiAll = [];
        $list_sesi = listSesi::all();
        for ($i = 0; $i < $list_sesi->count(); $i++) {
            $sesiTemp = [];
            array_push($sesiTemp, $list_sesi[$i]->startTime, $list_sesi[$i]->stopTime, $list_sesi[$i]->id);
            array_push($this->sesiAll, $sesiTemp);
        }

        //Dapatkan semua tanggal dan masukkan ke array
        $this->tanggalAll = [];
        $tanggal_all = tanggalAll::all();
        for ($i = 0; $i < $tanggal_all->count(); $i++) {
            $tempTanggal = [];
            array_push($tempTanggal, $tanggal_all[$i]->Tanggal, $tanggal_all[$i]->id);
            array_push($this->tanggalAll, $tempTanggal);
        }
    }

    public function refreshTransaksi()
    {
        $urlGetTransaksi = 'https://private-anon-b3487e89e5-beecloud.apiary-proxy.com/api/v1/sale';
        $data = file_get_contents($urlGetTransaksi, false, $this->context);
        $result = json_decode($data);
        // print_r(json_encode($result));

        //Dapatkan semua list_sales dan masukkan ke variabel $listSalesAll dengan format (id_channel_bee_cloud,id)
        $listSalesAll = [];
        $list_sales = listSales::all();
        for ($i = 0; $i < $list_sales->count(); $i++) {
            $listSalesTemp = [];
            array_push($listSalesTemp, $list_sales[$i]->id_channel_bee_cloud, $list_sales[$i]->id);
            array_push($listSalesAll, $listSalesTemp);
        }

        //$transaksiAll berisi semua idBeeCloud yang sudah diambil dari server, dan data yang sudah diambil, tidak dapat dimasukkan kembali ke database
        $transaksiAll = [];
        $transaksi_bee_cloud = transaksi_bee_cloud::all();
        for ($i = 0; $i < $transaksi_bee_cloud->count(); $i++) {
            array_push($transaksiAll, $transaksi_bee_cloud[$i]->id_transaksi_bee_cloud);
        }

        //Lakukan looping untuk semua transaksi, dan jangan dimasukkan ke database jika data tersebut sudah ada
        foreach ($result->data as $item) {
            //Cari didalam transaksi ada atau tidak data untuk id tertentu berdasarkan id transaksi dalam bee cloud
            $dataFoundTransaksiId = false;
            for ($i = 0; $i < count($transaksiAll); $i++) {
                if ($transaksiAll[$i] == $item->id) {
                    $dataFoundTransaksiId = true;
                    break;
                }
            }
            if (!$dataFoundTransaksiId) {
                $id_sales_harian = $this->getIDSalesHarian($item->branch_id, $item->trxdate);
                $id_transaksi_bee_cloud = $item->id;
                $trxdate_bee_cloud = $item->trxdate;
                $total = $item->total;
                $trxno_bee_cloud = $item->trxno;
                $id_list_sales = 1;// id 1 merujuk pada null value => error pada saat dalam API
                for ($i = 0; $i < count($listSalesAll); $i++) {
                    if($listSalesAll[$i][0] == $item->channel_id){
                        $id_list_sales = $listSalesAll[$i][1];
                        break;
                    }
                }
                $transaksi_insert = new transaksi_bee_cloud();
                $transaksi_insert->id_sales = $id_sales_harian;
                $transaksi_insert->id_transaksi_bee_cloud = $id_transaksi_bee_cloud;
                $transaksi_insert->trxdate_bee_cloud = $trxdate_bee_cloud;
                $transaksi_insert->total = $total;
                $transaksi_insert->id_list_sales = $id_list_sales;
                $transaksi_insert->trxno_bee_cloud = $trxno_bee_cloud;
                $transaksi_insert->save();
            }
            echo $item->trxdate;
            echo ' ';
            echo $item->branch_id;
            echo ' ';

            // if ($dataFoundTanggal) {
            //     echo 'TanggalFound';
            // }

            // if ($dataFoundOutlet) {
            //     echo $this->outletAll[$indexIfFoundOutlet][1];
            // }
            echo '<br>';
        }
    }

    public function refreshAPISoHarian()
    {
        ///   Program Berikut Untuk Update Satuan Agar Sama Dengan Unit Satuan Pada Bee Cloud ////
        $urlSatuan = 'https://private-anon-d985942e71-beecloud.apiary-proxy.com/api/v1/unit';
        $data = file_get_contents($urlSatuan, false, $this->context);
        $result = json_decode($data);

        // print_r(json_encode($result));
        foreach ($result->data as $item) {
            $satuanBeeCloud = $item->unit;
            $dataFound = false;
            for ($i = 0; $i < count($this->satuanAll); $i++) {
                if (strcmp($this->satuanAll[$i][0], $satuanBeeCloud) == 0) {
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

                array_push($this->satuanAll, $satuan);
            }
            // echo ($item->unit);
            // echo '<br>';
        }

        ///   Program Berikut Untuk Update Item Agar Sama Dengan Item Pada Bee Cloud ////
        // URL API yang ingin diambil datanya
        $urlItem = 'https://private-anon-b3487e89e5-beecloud.apiary-proxy.com/api/v1/item';

        // Mengambil data dari API dengan stream_context_create() dan file_get_contents()
        $data = file_get_contents($urlItem, false, $this->context);

        // Mengubah respons JSON menjadi objek PHP dengan json_decode()
        $result = json_decode($data);

        foreach ($result->data as $item) {
            $dataFoundSO = false;
            $indexIfFoundSO = 1;

            for ($i = 0; $i < count($this->itemSOAll); $i++) {
                if ($this->itemSOAll[$i][0] == $item->id) {
                    $indexIfFoundSO = $i;
                    $dataFoundSO = true;
                    break;
                }
            }

            $indexSatuan = 1;

            for ($j = 0; $j < count($this->satuanAll); $j++) {
                if (strcmp($this->satuanAll[$j][0], $item->unitdesc) == 0) {
                    $indexSatuan = $j;
                    break;
                }
            }

            if ($dataFoundSO) {
                listItemSO::find($this->itemSOAll[$indexIfFoundSO][1])->update([
                    'Item' => $item->name1,
                    'idSatuan' => $this->satuanAll[$indexSatuan][1]
                ]);
            } else {
                $list_so_db = new listItemSO();
                $list_so_db->Item = $item->name1;
                $list_so_db->idSatuan = $this->satuanAll[$indexSatuan][1];
                $list_so_db->icon = 'defaultItem.svg';
                $list_so_db->id_bee_cloud_item = $item->id;
                $list_so_db->save();


                $itemso = [];
                array_push($itemso, $list_so_db->id_bee_cloud_item, $list_so_db->id);

                array_push($this->itemSOAll, $itemso);
            }
            // echo($item->unitdesc);
            // echo '<br>';
        }
        print_r(json_encode($this->itemSOAll));
    }

    private function getIDSalesHarian($branch_id_bee_cloud, $trxdate_bee_cloud)
    {
        //fungsi untuk mengembalikan nilai id sales harian
        $timestamp = strtotime($trxdate_bee_cloud);
        $time = date('H:i:s', $timestamp);
        $date = date('Y-m-d', $timestamp);

        $dataFoundOutlet = false;
        $indexIfFoundOutlet = 0;

        $dataFoundSesi = false;
        $indexIfFoundSesi = 0;

        $dataFoundTanggal = false;
        $indexIfFoundTanggal = 0;

        for ($i = 0; $i < count($this->outletAll); $i++) {
            //Perulangan untuk menemukan outlet mana di id berapa
            if ($this->outletAll[$i][0] == $branch_id_bee_cloud) {
                $dataFoundOutlet = true;
                $indexIfFoundOutlet = $i;
                break;
            }
        }
        for ($i = 0; $i < count($this->sesiAll); $i++) {
            //Perulangan untuk menemukan ada di sesi berapa
            $compareTime = strtotime($time);
            $startTime = strtotime($this->sesiAll[$i][0]);
            $stopTime = strtotime($this->sesiAll[$i][1]);
            if ($compareTime >= $startTime && $compareTime <= $stopTime) {
                $dataFoundSesi = true;
                $indexIfFoundSesi = $i;
                break;
            }
        }

        for ($i = 0; $i < count($this->tanggalAll); $i++) {
            //Perulangan untuk menemukan ada di tanggal berapa
            $compareDate = strtotime($date);
            $dateLoop = strtotime($this->tanggalAll[$i][0]);
            if ($compareDate == $dateLoop) {
                $dataFoundTanggal = true;
                $indexIfFoundTanggal = $i;
                break;
            }
        }

        if (!$dataFoundTanggal) {
            $tempArray = [];
            $tanggalTemp = new tanggalAll();
            $tanggalTemp->Tanggal = $date;
            $tanggalTemp->save();
            array_push($tempArray, $tanggalTemp->Tanggal, $tanggalTemp->id);
            array_push($this->tanggalAll, $tempArray);
            for ($i = 0; $i < count($this->tanggalAll); $i++) {
                //Perulangan untuk menemukan ada di tanggal berapa
                $compareDate = strtotime($date);
                $dateLoop = strtotime($this->tanggalAll[$i][0]);
                if ($compareDate == $dateLoop) {
                    $dataFoundTanggal = true;
                    $indexIfFoundTanggal = $i;
                    break;
                }
            }
        }

        //Mulai mencari id sales harian
        $dataDate = salesharian::where('idTanggal', '=', $this->tanggalAll[$indexIfFoundTanggal][1])->get();
        $dataa = null;
        if ($dataDate->count() == 0) {
            $dataArray = [
                'idTanggal' => $this->tanggalAll[$indexIfFoundTanggal][1],
                'idOutlet' => $this->outletAll[$indexIfFoundOutlet][1],
                'idSesi' => $this->sesiAll[$indexIfFoundSesi][2]
            ];
            $dataa = salesharian::create($dataArray)->id;
        } else {
            $dataOutlet = $dataDate->where('idOutlet', '=', $this->outletAll[$indexIfFoundOutlet][1]);
            // @dd($dataOutlet->count());
            if ($dataOutlet->count() == 0) {
                $dataArray = [
                    'idTanggal' => $this->tanggalAll[$indexIfFoundTanggal][1],
                    'idOutlet' => $this->outletAll[$indexIfFoundOutlet][1],
                    'idSesi' => $this->sesiAll[$indexIfFoundSesi][2]
                ];
                $dataa = salesharian::create($dataArray)->id;
            } else {
                $dataSesi = $dataOutlet->where('idSesi', '=', $this->sesiAll[$indexIfFoundSesi][2])->first();
                if ($dataSesi == null) {
                    $dataArray = [
                        'idTanggal' => $this->tanggalAll[$indexIfFoundTanggal][1],
                        'idOutlet' => $this->outletAll[$indexIfFoundOutlet][1],
                        'idSesi' => $this->sesiAll[$indexIfFoundSesi][2]
                    ];
                    $dataa = salesharian::create($dataArray)->id;
                } else {
                    $dataa = $dataSesi->id;
                }
            }
        }
        return $dataa;
    }
}
