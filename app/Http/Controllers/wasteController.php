<?php

namespace App\Http\Controllers;

use App\Models\brandWaste;
use App\Models\dBrand;
use App\Models\doutlet;
use App\Models\dUser;
use App\Models\jenisBahan;
use App\Models\listItemWaste;
use App\Models\reqItemWaste;
use App\Models\satuan;
use App\Models\tanggalAll;
use App\Models\wasteFill;
use App\Models\wasteHarian;
use Exception;
use Illuminate\Http\Request;

class wasteController extends Controller
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
        $data = wasteFill::where('idWaste', '=', $request->idWaste)
            ->where('idListItem', '=', $request->idListItem)->first();
        if ($data == null) {
            $dataArray = [
                'idWaste' => $request->idWaste,
                'idListItem' => $request->idListItem,
                'quantity' => $request->quantity,
                'total' => $request->total,
                'idPengisi' => $request->idPengisi,
                'idPerevisi' => $request->idPengisi
            ];
            wasteFill::create($dataArray);
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
            'idJenisBahan' => $request->idJenisBahan
        ];
        listItemWaste::create($dataArray);
    }

    public function storeItemRevision(Request $request)
    {
        // @dd($request);
        $idBrand = doutlet::find($request->idOutlet)->dBrands->id;
        $checkRevisi = reqItemWaste::where('idBrand', '=', $idBrand)
            ->where('Item', '=', $request->Item)
            ->where('idSatuan', '=', $request->idSatuan)
            ->where('idJenisBahan', '=', $request->idJenisBahan)
            ->first();
        // @dd($checkRevisi);
        if ($checkRevisi == null) {
            $dataArray = [
                'Item' => $request->Item,
                'idSatuan' => $request->idSatuan,
                'idOutlet' => $request->idOutlet,
                'idBrand' => $idBrand,
                'idJenisBahan' => $request->idJenisBahan,
                'idTanggal'=> $request->idTanggal,
                'idPengisi' => $request->idPengisi
            ];
            reqItemWaste::create($dataArray);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function storeBrandItem(Request $request)
    {
        $checkData = brandWaste::where('idBrand', '=', $request->idBrand)->where('idListItem', '=', $request->idListItem)->get();
        // @dd($checkData);
        if ($checkData->count() == '0') {
            $dataArray = [
                'idBrand' => $request->idBrand,
                'idListItem' => $request->idListItem
            ];
            brandWaste::create($dataArray);
        }
    }

    public function storeRevisionCheck(Request $request)
    {
        $status = $request->status;
        $idRev = $request->idRev;

        $listWaste = reqItemWaste::find($idRev);
        $item = $listWaste->Item;
        $idSatuan = $listWaste->idSatuan;
        $idJenisBahan = $listWaste->idJenisBahan;
        $brand = $listWaste->dbrands['id'];

        if ($status == '1') {
            //status 1 untuk accept
            $dataArray = [
                'Item' => $item,
                'idSatuan' => $idSatuan,
                'idJenisBahan' => $idJenisBahan
            ];
            $id = listItemWaste::create($dataArray)->id;
            brandWaste::create([
                'idBrand' => $brand,
                'idListItem' => $id
            ]);
            $listWaste->delete();
        }
        if ($status == '2') {
            //status 2 untuk delete
            $listWaste->delete();
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
        $dataWaste = wasteHarian::where('idOutlet', '=', $id)->where('idTanggal', '=', $tanggalAll['id'])->get();
        // @dd($dataWaste[0]->listItemWastes[0]->pivot);
        $waste = [];
        for ($i = 0; $i < $dataWaste->count(); $i++) {
            $WasteArray = [];
            for ($j = 0; $j < ($dataWaste[$i]->listItemWastes->count()); $j++) {
                $idQuantityRevisi = $dataWaste[$i]->listItemWastes[$j]->pivot->idRevQuantity;
                $qty = $dataWaste[$i]->listItemWastes[$j]->pivot->quantity;
                $userPengisi = dUser::find($dataWaste[$i]->listItemWastes[$j]->pivot->idPengisi);
                $satuan = satuan::find($dataWaste[$i]->listItemWastes[$j]->idSatuan);
                $jenis = jenisBahan::find($dataWaste[$i]->listItemWastes[$j]->idJenisBahan);
                if ($idQuantityRevisi == '2') {
                    //Jika statusnya revisi pada CU
                    $qty = $dataWaste[$i]->listItemWastes[$j]->pivot->quantityRevisi;
                }
                array_push($WasteArray, (object)[
                    'idWasteFill' => $dataWaste[$i]->listItemWastes[$j]->pivot->id,
                    'Item' => $dataWaste[$i]->listItemWastes[$j]->Item,
                    'idListwaste' => $dataWaste[$i]->listItemWastes[$j]->id,
                    'Satuan' => $satuan->Satuan,
                    'jenis' => $jenis->jenis,
                    'idQtyRev' => $idQuantityRevisi,
                    'qty' => $qty,
                    'namaPengisi' => $userPengisi['Nama Lengkap'],
                ]);
            }
            array_push($waste, (object)[
                'idWaste' => $dataWaste[$i]['id'],
                'Item' => $WasteArray,
            ]);
        }
        return response()->json([
            'countItem' => $dataWaste->count(),
            'itemWaste' => $waste
        ]);
    }

    public function showAllData($id, $date)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        // @dd($tanggalAll);
        $dataWaste = null;
        $allDataArray = [];
        if ($tanggalAll != null) {
            $dataWaste = wasteHarian::where('idOutlet', '=', $id)->where('idTanggal', '=', $tanggalAll['id'])->first();
            // @dd($dataWaste);
            if ($dataWaste != null) {
                //Collect based on typeWaste
                $allTypeWaste = jenisBahan::all();

                for ($i = 0; $i < $allTypeWaste->count(); $i++) {
                    $idType = $allTypeWaste[$i]->id;
                    $dataOnType = [];
                    for ($j = 0; $j < $dataWaste->listItemWastes->count(); $j++) {
                        if ($dataWaste->listItemWastes[$j]->idJenisBahan == $idType) {
                            $userPengisi = dUser::find($dataWaste->listItemWastes[$j]->pivot->idPengisi);
                            $idRevQty = $dataWaste->listItemWastes[$j]->pivot->idRevQuantity;
                            $qty = $dataWaste->listItemWastes[$j]->pivot->quantity;
                            if ($idRevQty == 2) {
                                $qty = $dataWaste->listItemWastes[$j]->pivot->quantity;
                            }
                            array_push($dataOnType, (object)[
                                'idWasteFill' => $dataWaste->listItemWastes[$j]->pivot->id,
                                'item' => $dataWaste->listItemWastes[$j]->Item,
                                'satuan' => $dataWaste->listItemWastes[$j]->satuans->Satuan,
                                'idRevQty' => $idRevQty,
                                'qty' => $qty,
                                'namaPengisi' => $userPengisi['Nama Lengkap'],
                            ]);
                        }
                    }
                    if ($dataOnType != null) {
                        array_push($allDataArray, (object)[
                            'type' => $allTypeWaste[$i]->jenis,
                            'idTtype' => $allTypeWaste[$i]->id,
                            'waste' => $dataOnType
                        ]);
                    }
                }
            }
        }
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
        } else {
            $tanggalID = $tanggalAll['id'];
        }
        $idOutlet = $request->idOutlet;
        $dataDate = wasteHarian::where('idTanggal', '=', $tanggalID)->get();
        $dataa = null;
        if ($dataDate == null) {
            $dataArray = [
                'idTanggal' => $tanggalID,
                'idOutlet' => $idOutlet,
            ];
            $dataa = wasteHarian::create($dataArray)->id;
        } else {
            $dataOutlet = $dataDate->where('idOutlet', '=', $idOutlet)->first();
            if ($dataOutlet == null) {
                $dataArray = [
                    'idTanggal' => $tanggalID,
                    'idOutlet' => $idOutlet
                ];
                $dataa = wasteHarian::create($dataArray)->id;
            } else {
                $dataa = $dataOutlet->id;
            }
        }
        echo $dataa;
    }

    public function showAllRequest()
    {
        $listWaste = reqItemWaste::all();
        $arraylistWaste = [];
        // @dd($listWaste[0]->satuans);
        for ($i = 0; $i < $listWaste->count(); $i++) {
            $outlet = $listWaste[$i]->doutlets;
            $brand = $listWaste[$i]->dbrands;
            array_push($arraylistWaste, (object)[
                'id' => $listWaste[$i]['id'],
                'Item' => $listWaste[$i]['Item'],
                'Satuan' => $listWaste[$i]->satuans['Satuan'],
                'Outlet' => $outlet['Nama Store'],
                'Brand' => $brand['Nama Brand'],
                'jenisBahan' => $listWaste[$i]->jenisBahans['jenis']
            ]);
        }
        return response()->json([
            'countItem' => $listWaste->count(),
            'listWaste' => $arraylistWaste
        ]);
    }

    
    public function showReqOutlet($id)
    {
        //menampilkan revisi berdasarkan idOutlet => $id
        $tanggalAll = tanggalAll::all();
        $dataAllWaste = [];
        for ($i = 0; $i < $tanggalAll->count(); $i++) {
            $dataReq = [];
            $dataFound = false;
            $reqWaste = $tanggalAll[$i]->reqItemWastes->where('idOutlet', '=', $id);
            for ($j = 0; $j < $reqWaste->count(); $j++) {
                $dataFound = true;
                array_push($dataReq, (object)[
                    'namaPengisi' => $reqWaste[$j]->dUsers['Nama Lengkap'],
                    'Item' => $reqWaste[$j]->Item,
                    'satuan' => $reqWaste[$j]->satuans->Satuan,
                    'jenis' => $reqWaste[$j]->jenisBahans->jenis
                ]);
            }
            if ($dataFound) {
                array_push($dataAllWaste, (object)[
                    'Tanggal' => $tanggalAll[$i]->Tanggal,
                    'reqWaste' => $dataReq
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'reqWaste' => $dataAllWaste
        ]);
    }

    public function showRevisiOutlet($id)
    {
        $listWaste = reqItemWaste::where('idOutlet', '=', $id)->orderBy('id', 'DESC')->get();
        $arraylistWaste = [];
        // @dd($listWaste[0]->satuans);
        for ($i = 0; $i < $listWaste->count(); $i++) {
            $outlet = $listWaste[$i]->doutlets;
            $brand = $listWaste[$i]->dbrands;
            array_push($arraylistWaste, (object)[
                'id' => $listWaste[$i]['id'],
                'Item' => $listWaste[$i]['Item'],
                'Satuan' => $listWaste[$i]->satuans['Satuan'],
                'jenisBahan' => $listWaste[$i]->jenisBahans['jenis']
            ]);
        }
        return response()->json([
            'countItem' => $listWaste->count(),
            'listWaste' => $arraylistWaste
        ]);
    }

    public function showItemOnBrand(Request $request)
    {
        $dataa = dBrand::find($request->idBrand)->listItemWastes;
        $jenisBahan = jenisBahan::all();
        $jenisBahanArray = array();

        for ($i = 0; $i < $jenisBahan->count(); $i++) {
            array_push($jenisBahanArray, array($jenisBahan[$i]->id, $jenisBahan[$i]->jenis));
        }
        // @dd($jenisBahanArray[1][1]);
        // @dd($dataa);
        $arrayData = [];
        for ($i = 0; $i < $dataa->count(); $i++) {
            $satuan = satuan::find($dataa[$i]['idSatuan']);
            array_push($arrayData, (object)[
                'id' => $dataa[$i]['id'],
                'Item' => $dataa[$i]['Item'],
                'Satuan' => $satuan['Satuan'],
                'idJenisBahan' => $dataa[$i]['idJenisBahan']
            ]);
        }
        // @dd($arrayData[0]->Item);
        $arraySortData = [];
        for ($i = 0; $i < count($jenisBahanArray); $i++) {
            $arrayItem = [];
            for ($j = 0; $j < count($arrayData); $j++) {
                if ($jenisBahanArray[$i][0] == $arrayData[$j]->idJenisBahan) {
                    array_push($arrayItem, $arrayData[$j]);
                }
            }
            array_push($arraySortData, (object)[
                'jenisBahan' => $jenisBahanArray[$i][1],
                'idJenis' => $jenisBahanArray[$i][0],
                'waste' => $arrayItem
            ]);
        }
        return response()->json([
            'countItem' => $dataa->count(),
            'listWaste' => $arraySortData
        ]);
    }

    public function showAll()
    {
        //tampilkan seluruh listwaste
        $listWaste = jenisBahan::all();
        $arraylistWaste = [];
        // @dd($listWaste[0]->listItemWastes);
        for ($i = 0; $i < $listWaste->count(); $i++) {
            $arrayWaste = [];
            for ($j = 0; $j < $listWaste[$i]->listItemWastes->count(); $j++) {
                array_push($arrayWaste, (object)[
                    'id' => $listWaste[$i]->listItemWastes[$j]['id'],
                    'Item' => $listWaste[$i]->listItemWastes[$j]['Item'],
                    'Satuan' => $listWaste[$i]->listItemWastes[$j]->satuans['Satuan'],
                ]);
            }
            array_push($arraylistWaste, (object)[
                'jenisBahan' => $listWaste[$i]['jenis'],
                'idJenis' => $listWaste[$i]['id'],
                'waste' => $arrayWaste
            ]);
        }
        return response()->json([
            'countItem' => $listWaste->count(),
            'listWaste' => $arraylistWaste
        ]);
    }

    public function showDateRevision()
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->wasteharians);
        $wasteDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $datawaste = $tanggalAll[$h]->wasteHarians;
            $revisionDateFound = false;
            // @dd($datawaste[0]->listItemWastes);
            $wasteOutlet = [];
            for ($i = 0; $i < $datawaste->count(); $i++) {
                $wasteArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($datawaste[$i]->listItemWastes->count()); $j++) {
                    $idQtyRevisi = $datawaste[$i]->listItemWastes[$j]->pivot->idRevQuantity;
                    if (($idQtyRevisi == '2')) {
                        $revisionFound = true;
                        $quantity = 0;
                        if ($idQtyRevisi == '2') {
                            $quantity = $datawaste[$i]->listItemWastes[$j]->pivot->quantityRevisi;
                        } else {
                            $quantity = $datawaste[$i]->listItemWastes[$j]->pivot->quantity;
                        }
                        $userPengisi = dUser::find($datawaste[$i]->listItemWastes[$j]->pivot->idPengisi);
                        array_push($wasteArray, (object)[
                            'idWasteFill' => $datawaste[$i]->listItemWastes[$j]->pivot->id,
                            // 'idListwaste' => $datawaste[$i]->listItemWastes[$j]->id,
                            'satuan' => $datawaste[$i]->listItemWastes[$j]->satuans['Satuan'],
                            'waste' => $datawaste[$i]->listItemWastes[$j]->Item,
                            'idQty' => $idQtyRevisi,
                            'quantity' => $quantity,
                            'jenis' => $datawaste[$i]->listItemWastes[$j]->jenisBahans['jenis'],
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($datawaste[$i]['idOutlet']);
                    array_push($wasteOutlet, (object)[
                        // 'Tanggal' => $datawaste[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $wasteArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($wasteDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $wasteOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datawaste->count(),
            'itemWaste' => $wasteDate
        ]);
    }

    public function showRevisionOutlet($id)
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->wasteharians);
        $wasteDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $datawaste = $tanggalAll[$h]->wasteHarians->where('idOutlet', '=', $id);
            $revisionDateFound = false;
            // @dd($datawaste[0]->listItemWastes);
            $wasteOutlet = [];
            for ($i = 0; $i < $datawaste->count(); $i++) {
                $wasteArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($datawaste[$i]->listItemWastes->count()); $j++) {
                    $idQtyRevisi = $datawaste[$i]->listItemWastes[$j]->pivot->idRevQuantity;
                    if (($idQtyRevisi == '2')) {
                        $revisionFound = true;
                        $quantity = 0;
                        if ($idQtyRevisi == '2') {
                            $quantity = $datawaste[$i]->listItemWastes[$j]->pivot->quantityRevisi;
                        } else {
                            $quantity = $datawaste[$i]->listItemWastes[$j]->pivot->quantity;
                        }
                        $userPengisi = dUser::find($datawaste[$i]->listItemWastes[$j]->pivot->idPengisi);
                        array_push($wasteArray, (object)[
                            'idWasteFill' => $datawaste[$i]->listItemWastes[$j]->pivot->id,
                            // 'idListwaste' => $datawaste[$i]->listItemWastes[$j]->id,
                            'satuan' => $datawaste[$i]->listItemWastes[$j]->satuans['Satuan'],
                            'waste' => $datawaste[$i]->listItemWastes[$j]->Item,
                            'idRevQty' => $idQtyRevisi,
                            'quantity' => $quantity,
                            'jenis' => $datawaste[$i]->listItemWastes[$j]->jenisBahans['jenis'],
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($datawaste[$i]['idOutlet']);
                    array_push($wasteOutlet, (object)[
                        // 'Tanggal' => $datawaste[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $wasteArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($wasteDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $wasteOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datawaste->count(),
            'itemWaste' => $wasteDate
        ]);
    }

    public function showDateRevisionDone()
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->wasteharians);
        $wasteDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $datawaste = $tanggalAll[$h]->wasteHarians;
            $revisionDateFound = false;
            // @dd($datawaste[0]->listItemWastes);
            $wasteOutlet = [];
            for ($i = 0; $i < $datawaste->count(); $i++) {
                $wasteArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($datawaste[$i]->listItemWastes->count()); $j++) {
                    $idQtyRevisi = $datawaste[$i]->listItemWastes[$j]->pivot->idRevQuantity;
                    if (($idQtyRevisi == '3')) {
                        $revisionFound = true;
                        $quantity = 0;
                        if ($idQtyRevisi == '3') {
                            $quantity = $datawaste[$i]->listItemWastes[$j]->pivot->quantity;
                        } else {
                            $quantity = $datawaste[$i]->listItemWastes[$j]->pivot->quantityRevisi;
                        }
                        $userPengisi = dUser::find($datawaste[$i]->listItemWastes[$j]->pivot->idPengisi);
                        $userPerevisi = dUser::find($datawaste[$i]->listItemWastes[$j]->pivot->idPerevisi);
                        array_push($wasteArray, (object)[
                            'idWasteFill' => $datawaste[$i]->listItemWastes[$j]->pivot->id,
                            // 'idListwaste' => $datawaste[$i]->listItemWastes[$j]->id,
                            'satuan' => $datawaste[$i]->listItemWastes[$j]->satuans['Satuan'],
                            'waste' => $datawaste[$i]->listItemWastes[$j]->Item,
                            'idQty' => $idQtyRevisi,
                            'quantity' => $quantity,
                            'jenis' => $datawaste[$i]->listItemWastes[$j]->jenisBahans['jenis'],
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                            'namaPerevisi' => $userPerevisi['Nama Lengkap']
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($datawaste[$i]['idOutlet']);
                    array_push($wasteOutlet, (object)[
                        // 'Tanggal' => $datawaste[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $wasteArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($wasteDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $wasteOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datawaste->count(),
            'itemWaste' => $wasteDate
        ]);
    }

    public function showRevisionDoneOutlet($id)
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->wasteharians);
        $wasteDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $datawaste = $tanggalAll[$h]->wasteHarians->where('idOutlet', '=', $id);
            $revisionDateFound = false;
            // @dd($datawaste[0]->listItemWastes);
            $wasteOutlet = [];
            for ($i = 0; $i < $datawaste->count(); $i++) {
                $wasteArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($datawaste[$i]->listItemWastes->count()); $j++) {
                    $idQtyRevisi = $datawaste[$i]->listItemWastes[$j]->pivot->idRevQuantity;
                    if (($idQtyRevisi == '3')) {
                        $revisionFound = true;
                        $quantity = 0;
                        if ($idQtyRevisi == '3') {
                            $quantity = $datawaste[$i]->listItemWastes[$j]->pivot->quantityRevisi;
                        } else {
                            $quantity = $datawaste[$i]->listItemWastes[$j]->pivot->quantity;
                        }
                        $userPengisi = dUser::find($datawaste[$i]->listItemWastes[$j]->pivot->idPengisi);
                        array_push($wasteArray, (object)[
                            'idWasteFill' => $datawaste[$i]->listItemWastes[$j]->pivot->id,
                            // 'idListwaste' => $datawaste[$i]->listItemWastes[$j]->id,
                            'satuan' => $datawaste[$i]->listItemWastes[$j]->satuans['Satuan'],
                            'waste' => $datawaste[$i]->listItemWastes[$j]->Item,
                            'idRevQty' => $idQtyRevisi,
                            'quantity' => $quantity,
                            'jenis' => $datawaste[$i]->listItemWastes[$j]->jenisBahans['jenis'],
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($datawaste[$i]['idOutlet']);
                    array_push($wasteOutlet, (object)[
                        // 'Tanggal' => $datawaste[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $wasteArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($wasteDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $wasteOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datawaste->count(),
            'itemWaste' => $wasteDate
        ]);
    }

    public function showOnWasteFill($id)
    {
        $wasteFill = wasteFill::find($id);
        $dataWaste = $wasteFill->wasteHarians;
        $allDataArray = [];
        $allTypeWaste = jenisBahan::all();
        $qtyWaste = $wasteFill->quantity;
        if($wasteFill->idRevQuantity == 2){
            $qtyWaste = $wasteFill->quantityRevisi;
        }
        for ($i = 0; $i < $allTypeWaste->count(); $i++) {
            $idType = $allTypeWaste[$i]->id;
            $dataOnType = [];
            for ($j = 0; $j < $dataWaste->listItemWastes->count(); $j++) {
                if ($dataWaste->listItemWastes[$j]->idJenisBahan == $idType) {
                    $userPengisi = dUser::find($dataWaste->listItemWastes[$j]->pivot->idPengisi);
                    $idRevQty = $dataWaste->listItemWastes[$j]->pivot->idRevQuantity;
                    $qty = $dataWaste->listItemWastes[$j]->pivot->quantity;
                    if ($idRevQty == 2) {
                        $qty = $dataWaste->listItemWastes[$j]->pivot->quantity;
                    }
                    array_push($dataOnType, (object)[
                        'idWasteFill' => $dataWaste->listItemWastes[$j]->pivot->id,
                        'item' => $dataWaste->listItemWastes[$j]->Item,
                        'satuan' => $dataWaste->listItemWastes[$j]->satuans->Satuan,
                        'idRevQty' => $idRevQty,
                        'qty' => $qty,
                        'namaPengisi' => $userPengisi['Nama Lengkap'],
                    ]);
                }
            }
            if ($dataOnType != null) {
                array_push($allDataArray, (object)[
                    'type' => $allTypeWaste[$i]->jenis,
                    'idTtype' => $allTypeWaste[$i]->id,
                    'waste' => $dataOnType
                ]);
            }
        }
        return response()->json([
            'waste' => $allDataArray,
            'tanggal' => $wasteFill->wasteHarians->tanggalAlls->Tanggal,
            'qty' => $qtyWaste,
            'item' => $wasteFill->listItemWastes->Item,
            'satuan' => $wasteFill->listItemWastes->satuans->Satuan,
            'jenis' => $wasteFill->listItemWastes->jenisBahans->jenis
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
        wasteFill::find($id)->update([
            'idPengisi' => $request->idPengisi,
            'quantityRevisi' => $request->quantityRevisi,
            'idRevQuantity'  => '2'
        ]);
    }
    public function editQtyRev(Request $request)
    {
        wasteFill::find($request->idWasteFill)->update([
            'quantity' => $request->qtyRevisi,
            'idRevQuantity'      => '3',
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
        $dataDestroy = brandWaste::where('idBrand', '=', $request->idBrand)
            ->where('idListItem', '=', $request->idListItem)->firstOrFail();
        $dataDestroy->delete();
    }
}
