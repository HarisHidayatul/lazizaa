<?php

namespace App\Http\Controllers;

use App\Models\brandPattyCash;
use App\Models\dBrand;
use App\Models\doutlet;
use App\Models\dUser;
use App\Models\listItemPattyCash;
use App\Models\pattyCashFill;
use App\Models\pattyCashHarian;
use App\Models\reqItemPattyCash;
use App\Models\kategori_patty_cash;
use App\Models\jenis_patty_cash;
use App\Models\satuan;
use App\Models\tanggalAll;
use Exception;
use Illuminate\Http\Request;

class pattyCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function initAllDataPattyCash()
    {
        //Fungsi ini merupakan fungsi untuk inisialisasi awal data patty cash, data ini berada didalam file csv pada folder public
        $filePath = public_path('initFile/initPattyCash.csv'); // path to the CSV file
        $csvData = [];
        $rowNum = 0;

        //Kategori patty cash array ini memiliki [namaKategori,id]
        $kategoriPattyCashArray = [];

        //Jenis patty cash array ini memiliki [namaJenis,id]
        $jenisPattyCashArray = [];

        //Satuan ini memiliki [Satuan,id]
        $satuanArray = [];

        //List item patty cash ini memilki [item,id]
        $itemPattyCashArray = [];

        if (($handle = fopen($filePath, "r")) !== false) {
            while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                $rowNum++;
                if ($rowNum == 1) {
                    continue; // Skip the first row
                }
                $csvData[] = $data;
            }
            fclose($handle);
        }

        //Dapatkan data kategori patty cash
        $kategori_patty_cash_all = kategori_patty_cash::all();
        for ($i = 0; $i < $kategori_patty_cash_all->count(); $i++) {
            $tempData = [$kategori_patty_cash_all[$i]->namaKategori, $kategori_patty_cash_all[$i]->id];
            array_push($kategoriPattyCashArray, $tempData);
        }

        //Dapatkan data jenis patty cash
        $jenis_patty_cash_all = jenis_patty_cash::all();
        for ($i = 0; $i < $jenis_patty_cash_all->count(); $i++) {
            $tempData = [$jenis_patty_cash_all[$i]->namaJenis, $jenis_patty_cash_all[$i]->id];
            array_push($jenisPattyCashArray, $tempData);
        }

        //Dapatkan data satuan
        $satuan_all = satuan::all();
        for ($i = 0; $i < $satuan_all->count(); $i++) {
            $tempData = [$satuan_all[$i]->Satuan, $satuan_all[$i]->id];
            array_push($satuanArray, $tempData);
        }

        //Dapatkan data patty cash
        $list_item_patty_cash_all = listItemPattyCash::all();
        for ($i = 0; $i < $list_item_patty_cash_all->count(); $i++) {
            $tempData = [$list_item_patty_cash_all[$i]->Item, $list_item_patty_cash_all[$i]->id];
            array_push($itemPattyCashArray, $tempData);
        }

        for ($i = 0; $i < count($csvData); $i++) {
            //Mulai perulangan untuk masing masing baris pada sebuah array

            $foundKategori = false;
            $indexIfFoundKategori = 0;

            $foundJenis = false;
            $indexIfFoundJenis = 0;

            $foundSatuan = false;
            $indexIfFoundSatuan = 0;

            $foundItem = false;
            $indexIfFoundItem = 0;

            //Mulai cari id kategori
            for ($j = 0; $j < count($kategoriPattyCashArray); $j++) {
                if ($kategoriPattyCashArray[$j][0] == $csvData[$i][3]) {
                    $foundKategori = true;
                    $indexIfFoundKategori = $j;
                    break;
                }
            }
            if (!$foundKategori) {
                $kategori_patty_cash_insert = new kategori_patty_cash();
                $kategori_patty_cash_insert->namaKategori = $csvData[$i][3];
                $kategori_patty_cash_insert->save();

                $tempData = [$csvData[$i][3], $kategori_patty_cash_insert->id];
                array_push($kategoriPattyCashArray, $tempData);
                for ($j = 0; $j < count($kategoriPattyCashArray); $j++) {
                    //Mulai cari id kategori
                    if ($kategoriPattyCashArray[$j][0] == $csvData[$i][3]) {
                        $foundKategori = true;
                        $indexIfFoundKategori = $j;
                        break;
                    }
                }
            }
            //End cari id kategori

            //Mulai cari jenis
            for ($j = 0; $j < count($jenisPattyCashArray); $j++) {
                if ($jenisPattyCashArray[$j][0] == $csvData[$i][2]) {
                    $foundJenis = true;
                    $indexIfFoundJenis = $j;
                    break;
                }
            }
            if (!$foundJenis) {
                $jenis_patty_cash_insert = new jenis_patty_cash();
                $jenis_patty_cash_insert->namaJenis = $csvData[$i][2];
                $jenis_patty_cash_insert->idKategori = $kategoriPattyCashArray[$indexIfFoundKategori][1];
                $jenis_patty_cash_insert->save();

                $tempData = [$csvData[$i][2], $jenis_patty_cash_insert->id];
                array_push($jenisPattyCashArray, $tempData);
                for ($j = 0; $j < count($jenisPattyCashArray); $j++) {
                    //Mulai cari id kategori
                    if ($jenisPattyCashArray[$j][0] == $csvData[$i][2]) {
                        $foundJenis = true;
                        $indexIfFoundJenis = $j;
                        break;
                    }
                }
            }
            //End cari jenis

            //Mulai cari satuan
            for ($j = 0; $j < count($satuanArray); $j++) {
                if (strtoupper($satuanArray[$j][0]) == strtoupper($csvData[$i][1])) {
                    $foundSatuan = true;
                    $indexIfFoundSatuan = $j;
                    break;
                }
            }
            if (!$foundSatuan) {
                $satuan_insert = new satuan();
                $satuan_insert->Satuan = $csvData[$i][1];
                $satuan_insert->save();

                $tempData = [$csvData[$i][1], $satuan_insert->id];
                array_push($satuanArray, $tempData);
                for ($j = 0; $j < count($satuanArray); $j++) {
                    //Mulai cari id kategori
                    if (strtoupper($satuanArray[$j][0]) == strtoupper($csvData[$i][1])) {
                        $foundSatuan = true;
                        $indexIfFoundSatuan = $j;
                        break;
                    }
                }
            }
            //End cari satuan

            //Mulai cari item
            for ($j = 0; $j < count($itemPattyCashArray); $j++) {
                if (strtoupper($itemPattyCashArray[$j][0]) == strtoupper($csvData[$i][0])) {
                    $foundItem = true;
                    $indexIfFoundItem = $j;
                    break;
                }
            }
            if (!$foundItem) {
                $item_insert = new listItemPattyCash();
                $item_insert->Item = $csvData[$i][0];
                $item_insert->idSatuan = $satuanArray[$indexIfFoundSatuan][1];
                $item_insert->idJenisItem = $jenisPattyCashArray[$indexIfFoundJenis][1];
                $item_insert->save();

                $tempData = [$csvData[$i][0], $item_insert->id];
                array_push($itemPattyCashArray, $tempData);
                for ($j = 0; $j < count($itemPattyCashArray); $j++) {
                    //Mulai cari id kategori
                    if (strtoupper($itemPattyCashArray[$j][0]) == strtoupper($csvData[$i][0])) {
                        $foundItem = true;
                        $indexIfFoundItem = $j;
                        break;
                    }
                }
            }
            //End cari item
        }

        $brandAll = dbrand::all();
        for ($i = 0; $i < $brandAll->count(); $i++) {
            for ($j = 0; $j < count($itemPattyCashArray); $j++) {
                $this->storeBrandItem2($brandAll[$i]->id, $itemPattyCashArray[$j][1]);
            }
        }
        print_r(json_encode($itemPattyCashArray));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = pattyCashFill::where('idPattyCash', '=', $request->idPattyCash)
            ->where('idListItem', '=', $request->idListItem)->first();
        if ($data == null) {
            $dataArray = [
                'idPattyCash' => $request->idPattyCash,
                'idListItem' => $request->idListItem,
                'quantity' => $request->quantity,
                'total' => $request->total,
                'idPengisi' => $request->idPengisi,
                'idPerevisi' => $request->idPengisi,
            ];
            pattyCashFill::create($dataArray);
            echo 1;
        } else {
            echo 0;
        }
    }
    public function storeItem(Request $request)
    {
        //
        $dataArray = [
            'Item' => $request->item,
            'idSatuan' => $request->idSatuan,
            'idJenisItem' => $request->idJenis
        ];
        listItemPattyCash::create($dataArray);
    }
    public function storeBrandItem(Request $request)
    {
        $this->storeBrandItem2($request->idBrand, $request->idListItem);
    }
    public function storeBrandItem2($idBrand, $idListItem)
    {
        $checkData = brandPattyCash::where('idBrand', '=', $idBrand)->where('idListItem', '=', $idListItem)->get();
        // @dd($checkData);
        if ($checkData->count() == '0') {
            $dataArray = [
                'idBrand' => $idBrand,
                'idListItem' => $idListItem
            ];
            brandPattyCash::create($dataArray);
        }
    }

    public function storeItemRevision(Request $request)
    {
        $idBrand = doutlet::find($request->idOutlet)->dBrands->id;
        $checkRevisi = reqItemPattyCash::where('idBrand', '=', $idBrand)
            ->where('Item', '=', $request->Item)
            ->where('idSatuan', '=', $request->idSatuan)
            ->first();
        // @dd($checkRevisi);
        if ($checkRevisi == null) {
            $dataArray = [
                'Item' => $request->Item,
                'idSatuan' => $request->idSatuan,
                'idBrand' => $idBrand,
                'idOutlet' => $request->idOutlet,
                'idTanggal' => $request->idTanggal,
                'idPengisi' => $request->idPengisi
            ];
            reqItemPattyCash::create($dataArray);
            echo 1;
        } else {
            echo 0;
        }
    }
    public function storeRevisionCheck(Request $request)
    {
        $status = $request->status;
        $idRev = $request->idRev;

        $listPattyCash = reqItemPattyCash::find($idRev);
        $brand = $listPattyCash->dbrands['id'];

        if ($status == '1') {
            //status 1 untuk accept
            $dataArray = [
                'Item' => $request->item,
                'idSatuan' => $request->idSatuan
            ];
            $id = listItemPattyCash::create($dataArray)->id;
            brandPattyCash::create([
                'idBrand' => $brand,
                'idListItem' => $id
            ]);
            $listPattyCash->delete();
        }
        if ($status == '2') {
            //status 2 untuk delete
            $listPattyCash->delete();
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $date)
    {
        //
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        $dataPattyCash = pattyCashHarian::where('idOutlet', '=', $id)->where('idTanggal', '=', $tanggalAll['id'])->get();
        // @dd($dataPattyCash[0]->listItemPattyCashs[0]->pivot);
        $pattyCash = [];
        for ($i = 0; $i < $dataPattyCash->count(); $i++) {
            $pattyCashArray = [];
            for ($j = 0; $j < ($dataPattyCash[$i]->listItemPattyCashs->count()); $j++) {
                $idQuantityRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevQuantity;
                $idTotalRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevTotal;
                $qty = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantity;
                $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->total;
                $userPengisi = dUser::find($dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idPengisi);
                if ($idQuantityRevisi == '2') {
                    //Jika statusnya revisi pada CU
                    $qty = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantityRevisi;
                }
                if ($idTotalRevisi == '2') {
                    $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->totalRevisi;
                }
                array_push($pattyCashArray, (object)[
                    'idSesi' => $dataPattyCash[$i]->idSesi,
                    'idPattyCashFill' => $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->id,
                    'Item' => $dataPattyCash[$i]->listItemPattyCashs[$j]->Item,
                    'Satuan' => $dataPattyCash[$i]->listItemPattyCashs[$j]->satuans->Satuan,
                    'idListpattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->id,
                    'idQtyRev' => $idQuantityRevisi,
                    'idTotalRev' => $idTotalRevisi,
                    'qty' => $qty,
                    'total' => $total,
                    'namaPengisi' => $userPengisi['Nama Lengkap'],
                ]);
            }
            array_push($pattyCash, (object)[
                'idPattyCash' => $dataPattyCash[$i]['id'],
                'Item' => $pattyCashArray,
            ]);
        }
        return response()->json([
            'countItem' => $dataPattyCash->count(),
            'itemPattyCash' => $pattyCash
        ]);
    }

    public function showAllData($id, $date, $idSesi)
    {
        //
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        $dataPattyCash = pattyCashHarian::where('idOutlet', '=', $id)
            ->where('idTanggal', '=', $tanggalAll['id'])
            ->where('idSesi', '=', $idSesi)
            ->get();
        // @dd($dataPattyCash[0]->listItemPattyCashs[0]->pivot);
        $pattyCash = [];
        for ($i = 0; $i < $dataPattyCash->count(); $i++) {
            $pattyCashArray = [];
            for ($j = 0; $j < ($dataPattyCash[$i]->listItemPattyCashs->count()); $j++) {
                $idQuantityRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevQuantity;
                $idTotalRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevTotal;
                $qty = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantity;
                $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->total;
                $userPengisi = dUser::find($dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idPengisi);
                if ($idQuantityRevisi == '2') {
                    //Jika statusnya revisi pada CU
                    $qty = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantityRevisi;
                }
                if ($idTotalRevisi == '2') {
                    $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->totalRevisi;
                }
                array_push($pattyCashArray, (object)[
                    'idSesi' => $dataPattyCash[$i]->idSesi,
                    'idPattyCashFill' => $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->id,
                    'Item' => $dataPattyCash[$i]->listItemPattyCashs[$j]->Item,
                    'Satuan' => $dataPattyCash[$i]->listItemPattyCashs[$j]->satuans->Satuan,
                    'idListpattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->id,
                    'idQtyRev' => $idQuantityRevisi,
                    'idTotalRev' => $idTotalRevisi,
                    'qty' => $qty,
                    'total' => $total,
                    'namaPengisi' => $userPengisi['Nama Lengkap'],
                ]);
            }
            array_push($pattyCash, (object)[
                'idPattyCash' => $dataPattyCash[$i]['id'],
                'Item' => $pattyCashArray,
            ]);
        }
        return response()->json([
            'countItem' => $dataPattyCash->count(),
            'itemPattyCash' => $pattyCash
        ]);
    }

    public function showAllDataSesi($idOutlet, $date)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        // @dd($tanggalAll);
        // $dataPattyCash = null;
        $allDataArray = [];
        $tempDataArray = [];
        $dataFound = false;
        $idSesi = 0;
        if ($tanggalAll != null) {
            $allPattyCash = pattyCashHarian::orderBy('idSesi', 'DESC')
                ->where('idOutlet', '=', $idOutlet)
                ->where('idTanggal', '=', $tanggalAll['id'])
                ->get();
            // @dd($dataPattyCash);
            $tempIdSesi = null;
            // echo($allPattyCash->count());
            for ($i = 0; $i < $allPattyCash->count(); $i++) {
                $dataPattyCash = $allPattyCash[$i];
                // @dd($dataPattyCash);
                $idSesi = $dataPattyCash->idSesi;
                // echo ($idSesi);
                $dataOnSesi = [];

                //Collect based on typeWaste
                // $allTypeWaste = jenisBahan::all();

                // for ($j = 0; $j < $allTypeWaste->count(); $j++) {
                // $idType = $allTypeWaste[$j]->id;
                $dataOnType = [];
                for ($k = 0; $k < $dataPattyCash->listItemPattyCashs->count(); $k++) {
                    // if ($dataPattyCash->listItemPattyCashs[$k]->idJenisBahan == $idType) {
                    $userPengisi = dUser::find($dataPattyCash->listItemPattyCashs[$k]->pivot->idPengisi);
                    $idRevQty = $dataPattyCash->listItemPattyCashs[$k]->pivot->idRevQuantity;
                    $idRevTotal = $dataPattyCash->listItemPattyCashs[$k]->pivot->idRevTotal;
                    $qty = $dataPattyCash->listItemPattyCashs[$k]->pivot->quantity;
                    $total = $dataPattyCash->listItemPattyCashs[$k]->pivot->total;
                    if ($idRevQty == 2) {
                        $qty = $dataPattyCash->listItemPattyCashs[$k]->pivot->quantityRevisi;
                    }
                    if ($idRevTotal == 2) {
                        $total = $dataPattyCash->listItemPattyCashs[$k]->pivot->totalRevisi;
                    }
                    array_push($dataOnType, (object)[
                        'idPattyCash' => $dataPattyCash->listItemPattyCashs[$k]->pivot->id,
                        'item' => $dataPattyCash->listItemPattyCashs[$k]->Item,
                        'satuan' => $dataPattyCash->listItemPattyCashs[$k]->satuans->Satuan,
                        'idRevQty' => $idRevQty,
                        'idRevTotal' => $idRevTotal,
                        'qty' => $qty,
                        'total' => $total,
                        'namaPengisi' => $userPengisi['Nama Lengkap'],
                    ]);
                    // }
                }
                if ($dataOnType != null) {
                    array_push($dataOnSesi, (object)[
                        // 'type' => $allTypeWaste[$j]->jenis,
                        // 'idTtype' => $allTypeWaste[$j]->id,
                        'pattyCash' => $dataOnType
                    ]);
                }
                // }

                if ($tempIdSesi != $idSesi) {
                    if ($i == 0) {
                        array_push($tempDataArray, $dataOnSesi);
                    } else {
                        array_push($allDataArray, (object)[
                            'idSesi' => $tempIdSesi,
                            'dataPattyCash' => $tempDataArray
                        ]);
                        $tempDataArray = [];
                        array_push($tempDataArray, $dataOnSesi);
                    }
                    $tempIdSesi = $idSesi;
                } else {
                    array_push($tempDataArray, $dataOnSesi);
                }
            }
        }

        array_push($allDataArray, (object)[
            'idSesi' => $tempIdSesi,
            'dataPattyCash' => $tempDataArray
        ]);

        return response()->json($allDataArray);
    }

    public function showAndCreateID(Request $request)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $request->tanggal)->first();
        $tanggalID = null;
        if ($tanggalAll == null) {
            $tanggalID = tanggalAll::create([
                'Tanggal' => $request->tanggal,
            ])->id;
            // echo 'a';
        } else {
            $tanggalID = $tanggalAll['id'];
            // echo 'b';
            // echo $tanggalID;
        }
        $idOutlet = $request->idOutlet;
        $idSesi = $request->idSesi;
        $dataDate = pattyCashHarian::where('idTanggal', '=', $tanggalID)->get();
        $dataa = null;
        if ($dataDate->count() == null) {
            $dataArray = [
                'idTanggal' => $tanggalID,
                'idOutlet' => $idOutlet,
                'idSesi' => $idSesi
            ];
            $dataa = pattyCashHarian::create($dataArray)->id;
            // echo 'c';
        } else {
            $dataOutlet = $dataDate->where('idOutlet', '=', $idOutlet);
            if ($dataOutlet->count() == null) {
                $dataArray = [
                    'idTanggal' => $tanggalID,
                    'idOutlet' => $idOutlet,
                    'idSesi' => $idSesi
                ];
                $dataa = pattyCashHarian::create($dataArray)->id;
                // echo 'd';
            } else {
                $dataSesi = $dataOutlet->where('idSesi', '=', $idSesi)->first();
                if ($dataSesi == null) {
                    $dataArray = [
                        'idTanggal' => $tanggalID,
                        'idOutlet' => $idOutlet,
                        'idSesi' => $idSesi
                    ];
                    $dataa = pattyCashHarian::create($dataArray)->id;
                    // echo 'e';
                } else {
                    $dataa = $dataSesi->id;
                    // echo 'f';
                }
            }
        }
        echo $dataa;
    }

    public function showAllRevisi()
    {
        $listPattyCash = reqItemPattyCash::all();
        $arraylistPattyCash = [];
        // @dd($listPattyCash[0]->satuans);
        $satuan = satuan::all();
        $satuanArray = [];
        for ($i = 0; $i < $satuan->count(); $i++) {
            array_push($satuanArray, (object)[
                'id' => $satuan[$i]->id,
                'satuan' => $satuan[$i]->Satuan
            ]);
        }
        for ($i = 0; $i < $listPattyCash->count(); $i++) {
            $outlet = $listPattyCash[$i]->doutlets;
            $brand = $listPattyCash[$i]->dbrands;
            array_push($arraylistPattyCash, (object)[
                'id' => $listPattyCash[$i]['id'],
                'Item' => $listPattyCash[$i]['Item'],
                'idSatuan' => $listPattyCash[$i]['idSatuan'],
                'Satuan' => $listPattyCash[$i]->satuans['Satuan'],
                'Outlet' => $outlet['Nama Store'],
                'Brand' => $brand['Nama Brand']
            ]);
        }
        return response()->json([
            'countItem' => $listPattyCash->count(),
            'listPattyCash' => $arraylistPattyCash,
            'satuan' => $satuanArray
        ]);
    }
    public function showRevisiOutlet($id)
    {
        $listPattyCash = reqItemPattyCash::where('idOutlet', '=', $id)->orderBy('id', 'DESC')->get();
        $arraylistPattyCash = [];
        // @dd($listPattyCash[0]->satuans);
        for ($i = 0; $i < $listPattyCash->count(); $i++) {
            $outlet = $listPattyCash[$i]->doutlets;
            $brand = $listPattyCash[$i]->dbrands;
            array_push($arraylistPattyCash, (object)[
                'id' => $listPattyCash[$i]['id'],
                'Item' => $listPattyCash[$i]['Item'],
                'Satuan' => $listPattyCash[$i]->satuans['Satuan']
            ]);
        }
        return response()->json([
            'countItem' => $listPattyCash->count(),
            'listPattyCash' => $arraylistPattyCash
        ]);
    }

    public function showAll()
    {
        //tampilkan seluruh listpattyCash
        $listPattyCash = listItemPattyCash::with('jenis_patty_cashs.kategori_patty_cashs', 'satuans')->get();
        $arraylistPattyCash = [];
        $satuan = satuan::all();
        $jenis = jenis_patty_cash::all();
        $arraySatuan = [];
        $arrayJenis = [];
        for ($i = 0; $i < $satuan->count(); $i++) {
            array_push($arraySatuan, (object)[
                'id' => $satuan[$i]->id,
                'satuan' => $satuan[$i]->Satuan
            ]);
        }
        for ($i = 0; $i < $jenis->count(); $i++) {
            array_push($arrayJenis,(object)[
                'id' => $jenis[$i]->id,
                'namaJenis' => $jenis[$i]->namaJenis
            ]);
        }
        for ($i = 0; $i < $listPattyCash->count(); $i++) {
            array_push($arraylistPattyCash, (object)[
                'id' => $listPattyCash[$i]->id,
                'Item' => $listPattyCash[$i]->Item,
                'Satuan' => $listPattyCash[$i]->satuans['Satuan'],
                'idSatuan' => $listPattyCash[$i]->idSatuan,
                'jenis' => $listPattyCash[$i]->jenis_patty_cashs->namaJenis,
                'idJenis' => $listPattyCash[$i]->jenis_patty_cashs->id,
                'kategori' => $listPattyCash[$i]->jenis_patty_cashs->kategori_patty_cashs->namaKategori
            ]);
        }
        return response()->json([
            'countItem' => $listPattyCash->count(),
            'listPattyCash' => $arraylistPattyCash,
            'satuan' => $arraySatuan,
            'jenis' => $arrayJenis
        ]);
    }

    public function showAllBrand()
    {
        $brand = dBrand::all();
        // @dd($brand[0]);
        $arrayBrand = [];
        for ($i = 0; $i < $brand->count(); $i++) {
            array_push($arrayBrand, (object)[
                'id' => $brand[$i]['id'],
                'namaBrand' => $brand[$i]['Nama Brand'],
            ]);
        }
        return response()->json([
            'countItem' => $brand->count(),
            'brand' => $arrayBrand
        ]);
    }

    public function showAllOutlet()
    {
        $Outlet = doutlet::all();
        $arrayOutlet = [];
        for ($i = 0; $i < $Outlet->count(); $i++) {
            array_push($arrayOutlet, (object)[
                'id' => $Outlet[$i]['id'],
                'namaOutlet' => $Outlet[$i]['Nama Store'],
            ]);
        }
        return response()->json([
            'countItem' => $Outlet->count(),
            'Outlet' => $arrayOutlet
        ]);
    }

    public function showItemOnBrand(Request $request)
    {
        $dataa = dBrand::find($request->idBrand)->listItemPattyCashs;
        // @dd($dataa);
        $array = [];
        for ($i = 0; $i < $dataa->count(); $i++) {
            $satuan = satuan::find($dataa[$i]['idSatuan']);
            array_push($array, (object)[
                'id' => $dataa[$i]['id'],
                'Item' => $dataa[$i]['Item'],
                'Satuan' => $satuan['Satuan']
            ]);
        }
        return response()->json([
            'countItem' => $dataa->count(),
            'dataItem' => $array
        ]);
    }

    public function showSatuan()
    {
        $dataa = satuan::all();
        $dataJenis = jenis_patty_cash::all();
        $dataKategori = kategori_patty_cash::all();
        // @dd($dataa);
        $array = [];
        $arrayJenis = [];
        $arrayKategori = [];
        for ($i = 0; $i < $dataa->count(); $i++) {
            array_push($array, (object)[
                'id' => $dataa[$i]['id'],
                'Satuan' => $dataa[$i]['Satuan']
            ]);
        }
        for($i=0;$i<$dataJenis->count();$i++){
            array_push($arrayJenis,(object)[
                'id' => $dataJenis[$i]->id,
                'namaJenis' => $dataJenis[$i]->namaJenis
            ]);
        }
        for($i = 0;$i<$dataKategori->count();$i++){
            array_push($arrayKategori,(object)[
                'id' => $dataKategori[$i]->id,
                'namaKategori' => $dataKategori[$i]->namaKategori
            ]);
        }
        return response()->json([
            'countItem' => $dataa->count(),
            'dataItem' => $array,
            'dataJenis' => $arrayJenis,
            'dataKategori' => $arrayKategori
        ]);
    }

    public function showDateRevision($fromDate, $toDate)
    {
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($fromDate, $toDate))->orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->pattyCashHarians);
        $pattyCashDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $dataPattyCash = $tanggalAll[$h]->pattyCashHarians;
            $revisionDateFound = false;
            // @dd($dataPattyCash[0]->listItemPattyCashs);
            $pattyCashOutlet = [];
            for ($i = 0; $i < $dataPattyCash->count(); $i++) {
                $pattyCashArray = [];
                $revisionFound = false;
                $idSesi = $dataPattyCash[$i]->idSesi;
                for ($j = 0; $j < ($dataPattyCash[$i]->listItemPattyCashs->count()); $j++) {
                    $idQtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevQuantity;
                    $idTotalRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevTotal;
                    if (($idQtyRevisi == '2') or ($idTotalRevisi == '2')) {
                        $revisionFound = true;
                        $qtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantity;
                        $qtyBefore = $qtyRevisi;
                        $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->total;
                        $totalBefore = $total;
                        if ($idQtyRevisi == '2') {
                            $qtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantityRevisi;
                        }
                        if ($idTotalRevisi == '2') {
                            $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->totalRevisi;
                        }
                        $userPengisi = dUser::find($dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idPengisi);
                        array_push($pattyCashArray, (object)[
                            'idPattyCashFill' => $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->id,
                            // 'idListpattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->id,
                            'pattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->Item,
                            'satuan' => $dataPattyCash[$i]->listItemPattyCashs[$j]->satuans['Satuan'],
                            'idQtyRev' => $idQtyRevisi,
                            'idTotalRev' => $idTotalRevisi,
                            'qty' => $qtyRevisi,
                            'qtyBefore' => $qtyBefore,
                            'total' => $total,
                            'totalBefore' => $totalBefore,
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                            'idSesi' => $idSesi,
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($dataPattyCash[$i]['idOutlet']);
                    array_push($pattyCashOutlet, (object)[
                        // 'Tanggal' => $dataPattyCash[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $pattyCashArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($pattyCashDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $pattyCashOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $dataPattyCash->count(),
            'itemPattyCash' => $pattyCashDate
        ]);
    }

    public function showRevisionOutlet($id)
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->pattyCashHarians);
        $pattyCashDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $dataPattyCash = $tanggalAll[$h]->pattyCashHarians->where('idOutlet', '=', $id);
            $revisionDateFound = false;
            // @dd($dataPattyCash[0]->listItemPattyCashs);
            $pattyCashOutlet = [];
            for ($i = 0; $i < $dataPattyCash->count(); $i++) {
                $pattyCashArray = [];
                $revisionFound = false;
                $idSesi = $dataPattyCash[$i]->idSesi;
                for ($j = 0; $j < ($dataPattyCash[$i]->listItemPattyCashs->count()); $j++) {
                    $idQtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevQuantity;
                    $idTotalRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevTotal;
                    if (($idQtyRevisi == '2') or ($idTotalRevisi == '2')) {
                        $revisionFound = true;
                        $qtyRevisi = 0;
                        $total = 0;
                        if ($idQtyRevisi == '2') {
                            $qtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantityRevisi;
                        } else {
                            $qtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantity;
                        }
                        if ($idTotalRevisi == '2') {
                            $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->totalRevisi;
                        } else {
                            $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->total;
                        }
                        $userPengisi = dUser::find($dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idPengisi);
                        array_push($pattyCashArray, (object)[
                            'idPattyCashFill' => $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->id,
                            // 'idListpattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->id,
                            'pattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->Item,
                            'satuan' => $dataPattyCash[$i]->listItemPattyCashs[$j]->satuans['Satuan'],
                            'idQtyRev' => $idQtyRevisi,
                            'idTotalRev' => $idTotalRevisi,
                            'qty' => $qtyRevisi,
                            'total' => $total,
                            'idSesi' => $idSesi,
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($dataPattyCash[$i]['idOutlet']);
                    array_push($pattyCashOutlet, (object)[
                        // 'Tanggal' => $dataPattyCash[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $pattyCashArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($pattyCashDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $pattyCashOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $dataPattyCash->count(),
            'itemPattyCash' => $pattyCashDate
        ]);
    }

    public function showDateRevisionDone($fromDate, $toDate)
    {
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($fromDate, $toDate))->orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->pattyCashharians);
        $pattyCashDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $dataPattyCash = $tanggalAll[$h]->pattyCashHarians;
            // @dd($dataPattyCash[0]->listItemPattyCashs);
            $pattyCashOutlet = [];
            $revisionDateFound = false;
            for ($i = 0; $i < $dataPattyCash->count(); $i++) {
                $pattyCashArray = [];
                $revisionFound = false;
                $idSesi = $dataPattyCash[$i]->idSesi;
                for ($j = 0; $j < ($dataPattyCash[$i]->listItemPattyCashs->count()); $j++) {
                    $idQtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevQuantity;
                    $idTotalRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevTotal;
                    if (($idQtyRevisi == '3') or ($idTotalRevisi == '3')) {
                        $revisionFound = true;
                        $qtyRevisi = 0;
                        $total = 0;
                        if ($idQtyRevisi == '2') {
                            $qtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantityRevisi;
                        } else {
                            $qtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantity;
                        }
                        if ($idTotalRevisi == '2') {
                            $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->totalRevisi;
                        } else {
                            $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->total;
                        }
                        $userPengisi = dUser::find($dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idPengisi);
                        $userPerevisi = dUser::find($dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idPerevisi);
                        array_push($pattyCashArray, (object)[
                            'idPattyCashFill' => $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->id,
                            // 'idListpattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->id,
                            'pattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->Item,
                            'satuan' => $dataPattyCash[$i]->listItemPattyCashs[$j]->satuans['Satuan'],
                            'idQtyRev' => $idQtyRevisi,
                            'idTotalRev' => $idTotalRevisi,
                            'qty' => $qtyRevisi,
                            'total' => $total,
                            'idSesi' => $idSesi,
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                            'namaPerevisi' => $userPerevisi['Nama Lengkap']
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($dataPattyCash[$i]['idOutlet']);
                    array_push($pattyCashOutlet, (object)[
                        // 'Tanggal' => $dataPattyCash[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $pattyCashArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($pattyCashDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $pattyCashOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $dataPattyCash->count(),
            'itemPattyCash' => $pattyCashDate
        ]);
    }

    public function showRevisionDoneOutlet($id)
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->pattyCashharians);
        $pattyCashDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $dataPattyCash = $tanggalAll[$h]->pattyCashHarians->where('idOutlet', '=', $id);
            // @dd($dataPattyCash[0]->listItemPattyCashs);
            $pattyCashOutlet = [];
            $revisionDateFound = false;
            for ($i = 0; $i < $dataPattyCash->count(); $i++) {
                $pattyCashArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($dataPattyCash[$i]->listItemPattyCashs->count()); $j++) {
                    $idQtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevQuantity;
                    $idTotalRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idRevTotal;
                    if (($idQtyRevisi == '3') or ($idTotalRevisi == '3')) {
                        $revisionFound = true;
                        $qtyRevisi = 0;
                        $total = 0;
                        if ($idQtyRevisi == '2') {
                            $qtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantityRevisi;
                        } else {
                            $qtyRevisi = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->quantity;
                        }
                        if ($idTotalRevisi == '2') {
                            $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->totalRevisi;
                        } else {
                            $total = $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->total;
                        }
                        $userPengisi = dUser::find($dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idPengisi);
                        $userPerevisi = dUser::find($dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->idPerevisi);
                        array_push($pattyCashArray, (object)[
                            'idPattyCashFill' => $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->id,
                            // 'idListpattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->id,
                            'pattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->Item,
                            'satuan' => $dataPattyCash[$i]->listItemPattyCashs[$j]->satuans['Satuan'],
                            'idQtyRev' => $idQtyRevisi,
                            'idTotalRev' => $idTotalRevisi,
                            'qty' => $qtyRevisi,
                            'total' => $total,
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                            'namaPerevisi' => $userPerevisi['Nama Lengkap']
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($dataPattyCash[$i]['idOutlet']);
                    array_push($pattyCashOutlet, (object)[
                        // 'Tanggal' => $dataPattyCash[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $pattyCashArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($pattyCashDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $pattyCashOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $dataPattyCash->count(),
            'itemPattyCash' => $pattyCashDate
        ]);
    }

    public function showOnPattyCashFill($id)
    {
        $pattyCashFill = pattyCashFill::find($id);
        $dataPattyCash = $pattyCashFill->pattyCashHarians;
        // @dd($dataPattyCash);
        // @dd($dataPattyCash[0]->listItemPattyCashs[0]->pivot);
        $pattyCash = [];
        $qtyPattyCash = $pattyCashFill->quantity;
        $totalPattyCashs = $pattyCashFill->total;
        if ($pattyCashFill->idRevQuantity == 2) {
            $qtyPattyCash = $pattyCashFill->quantityRevisi;
        }
        if ($pattyCashFill->idRevTotal == 2) {
            $totalPattyCashs = $pattyCashFill->totalRevisi;
        }
        $pattyCashArray = [];
        for ($j = 0; $j < ($dataPattyCash->listItemPattyCashs->count()); $j++) {
            $idQuantityRevisi = $dataPattyCash->listItemPattyCashs[$j]->pivot->idRevQuantity;
            $idTotalRevisi = $dataPattyCash->listItemPattyCashs[$j]->pivot->idRevTotal;
            $qty = $dataPattyCash->listItemPattyCashs[$j]->pivot->quantity;
            $total = $dataPattyCash->listItemPattyCashs[$j]->pivot->total;
            $userPengisi = dUser::find($dataPattyCash->listItemPattyCashs[$j]->pivot->idPengisi);
            if ($idQuantityRevisi == '2') {
                //Jika statusnya revisi pada CU
                $qty = $dataPattyCash->listItemPattyCashs[$j]->pivot->quantityRevisi;
            }
            if ($idTotalRevisi == '2') {
                $total = $dataPattyCash->listItemPattyCashs[$j]->pivot->totalRevisi;
            }
            array_push($pattyCashArray, (object)[
                'idPattyCashFill' => $dataPattyCash->listItemPattyCashs[$j]->pivot->id,
                'Item' => $dataPattyCash->listItemPattyCashs[$j]->Item,
                'Satuan' => $dataPattyCash->listItemPattyCashs[$j]->satuans->Satuan,
                'idListpattyCash' => $dataPattyCash->listItemPattyCashs[$j]->id,
                'idQtyRev' => $idQuantityRevisi,
                'idTotalRev' => $idTotalRevisi,
                'qty' => $qty,
                'total' => $total,
                'namaPengisi' => $userPengisi['Nama Lengkap'],
            ]);
        }
        array_push($pattyCash, (object)[
            'idPattyCash' => $dataPattyCash['id'],
            'pattyCash' => $pattyCashArray,
        ]);
        return response()->json([
            'pattyCash' => $pattyCash,
            'tanggal' => $pattyCashFill->pattyCashHarians->tanggalAlls->Tanggal,
            'item' => $pattyCashFill->listItemPattyCashs->Item,
            'satuan' => $pattyCashFill->listItemPattyCashs->satuans->Satuan,
            'qty' => $qtyPattyCash,
            'total' => $totalPattyCashs
        ]);
    }
    public function showReqOutlet($id)
    {
        //menampilkan revisi berdasarkan idOutlet => $id
        $tanggalAll = tanggalAll::all();
        $dataAllPattyCash = [];
        for ($i = 0; $i < $tanggalAll->count(); $i++) {
            $dataReq = [];
            $dataFound = false;
            $reqPattyCash = $tanggalAll[$i]->reqItemPattyCashs->where('idOutlet', '=', $id);
            for ($j = 0; $j < $reqPattyCash->count(); $j++) {
                $dataFound = true;
                array_push($dataReq, (object)[
                    'namaPengisi' => $reqPattyCash[$j]->dUsers['Nama Lengkap'],
                    'Item' => $reqPattyCash[$j]->Item,
                    'satuan' => $reqPattyCash[$j]->satuans->Satuan
                ]);
            }
            if ($dataFound) {
                array_push($dataAllPattyCash, (object)[
                    'Tanggal' => $tanggalAll[$i]->Tanggal,
                    'reqPattyCash' => $dataReq
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'reqPattyCash' => $dataAllPattyCash
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    public function editQty($id, Request $request)
    {
        pattyCashFill::find($id)->update([
            'idPengisi' => $request->idPengisi,
            'quantityRevisi' => $request->quantityRevisi,
            'idRevQuantity'  => '2'
        ]);
    }

    public function editQtyRev(Request $request)
    {
        pattyCashFill::find($request->idPattyCashFill)->update([
            'quantity' => $request->qtyRevisi,
            'idRevQuantity'      => '3',
            'idPerevisi' => $request->idPerevisi,
        ]);
    }

    public function editTotal($id, Request $request)
    {
        pattyCashFill::find($id)->update([
            'idPengisi' => $request->idPengisi,
            'totalRevisi' => $request->totalRevisi,
            'idRevTotal' => '2'
        ]);
    }

    public function editTotalRev(Request $request)
    {
        pattyCashFill::find($request->idPattyCashFill)->update([
            'total' => $request->totalRevisi,
            'idRevTotal'      => '3',
            'idPerevisi' => $request->idPerevisi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updateItem(Request $request, $id)
    {
        $listPattyCash = listItemPattyCash::find($id);
        $listPattyCash->update([
            'Item' => $request->Item,
            'idSatuan' => $request->idSatuan,
            'idJenisItem' => $request->idJenis
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function destroyItemOnBrand(Request $request)
    {
        $dataDestroy = brandPattyCash::where('idBrand', '=', $request->idBrand)
            ->where('idListItem', '=', $request->idListItem)->firstOrFail();
        $dataDestroy->delete();
    }
}
