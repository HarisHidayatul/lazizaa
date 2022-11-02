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
        $data = pattyCashFill::where('idPattyCash','=',$request->idPattyCash)
                ->where('idListItem','=',$request->idListItem)->first();
        if($data == null){
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
        }else{
            echo 0;
        }
    }
    public function storeItem(Request $request)
    {
        //
        $dataArray = [
            'Item' => $request->item,
            'idSatuan' => $request->idSatuan
        ];
        listItemPattyCash::create($dataArray);
    }
    public function storeBrandItem(Request $request)
    {
        $checkData = brandPattyCash::where('idBrand', '=', $request->idBrand)->where('idListItem', '=', $request->idListItem)->get();
        // @dd($checkData);
        if ($checkData->count() == '0') {
            $dataArray = [
                'idBrand' => $request->idBrand,
                'idListItem' => $request->idListItem
            ];
            brandPattyCash::create($dataArray);
        }
    }

    public function storeItemRevision(Request $request)
    {
        $dataArray = [
            'Item' => $request->Item,
            'idSatuan' => $request->idSatuan,
            'idOutlet' => $request->idOutlet
        ];
        reqItemPattyCash::create($dataArray);
    }
    public function storeRevisionCheck(Request $request)
    {
        $status = $request->status;
        $idRev = $request->idRev;

        $listPattyCash = reqItemPattyCash::find($idRev);
        $item = $listPattyCash->Item;
        $idSatuan = $listPattyCash->idSatuan;
        $brand = $listPattyCash->dbrands['id'];

        if ($status == '1') {
            //status 1 untuk accept
            $dataArray = [
                'Item' => $item,
                'idSatuan' => $idSatuan
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
                    'idPattyCashFill' => $dataPattyCash[$i]->listItemPattyCashs[$j]->pivot->id,
                    'Item' => $dataPattyCash[$i]->listItemPattyCashs[$j]->Item,
                    'Satuan' => $dataPattyCash[$i]->listItemPattyCashs[$j]->Satuan,
                    'idListpattyCash' => $dataPattyCash[$i]->listItemPattyCashs[$j]->id,
                    'idQtyRev' => $idQuantityRevisi,
                    'idTotalRev' => $idTotalRevisi,
                    'qty' => $qty,
                    'total' => $total,
                    'namaPengisi' => $userPengisi['Username'],
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
        $dataDate = pattyCashHarian::where('idTanggal', '=', $tanggalID)->get();
        $dataa = null;
        if ($dataDate == null) {
            $dataArray = [
                'idTanggal' => $tanggalID,
                'idOutlet' => $idOutlet,
            ];
            $dataa = pattyCashHarian::create($dataArray)->id;
        } else {
            $dataOutlet = $dataDate->where('idOutlet', '=', $idOutlet)->first();
            if ($dataOutlet == null) {
                $dataArray = [
                    'idTanggal' => $tanggalID,
                    'idOutlet' => $idOutlet
                ];
                $dataa = pattyCashHarian::create($dataArray)->id;
            } else {
                $dataa = $dataOutlet->id;
            }
        }
        echo $dataa;
    }

    public function showAllRevisi()
    {
        $listPattyCash = reqItemPattyCash::all();
        $arraylistPattyCash = [];
        // @dd($listPattyCash[0]->satuans);
        for ($i = 0; $i < $listPattyCash->count(); $i++) {
            $outlet = $listPattyCash[$i]->doutlets;
            $brand = $listPattyCash[$i]->dbrands;
            array_push($arraylistPattyCash, (object)[
                'id' => $listPattyCash[$i]['id'],
                'Item' => $listPattyCash[$i]['Item'],
                'Satuan' => $listPattyCash[$i]->satuans['Satuan'],
                'Outlet' => $outlet['Nama Store'],
                'Brand' => $brand['Nama Brand']
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
        $listPattyCash = listItemPattyCash::all();
        $arraylistPattyCash = [];
        for ($i = 0; $i < $listPattyCash->count(); $i++) {
            array_push($arraylistPattyCash, (object)[
                'id' => $listPattyCash[$i]['id'],
                'Item' => $listPattyCash[$i]['Item'],
                'Satuan' => $listPattyCash[$i]->satuans['Satuan'],
            ]);
        }
        return response()->json([
            'countItem' => $listPattyCash->count(),
            'listPattyCash' => $arraylistPattyCash
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

    public function showSatuan(){
        $dataa = satuan::all();
        // @dd($dataa);
        $array = [];
        for ($i = 0; $i < $dataa->count(); $i++) {
            array_push($array, (object)[
                'id' => $dataa[$i]['id'],
                'Satuan' => $dataa[$i]['Satuan']
            ]);
        }
        return response()->json([
            'countItem' => $dataa->count(),
            'dataItem' => $array
        ]);
    }

    public function showDateRevision()
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
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
                            'namaPengisi' => $userPengisi['Username'],
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

    public function showDateRevisionDone()
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
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
                            'namaPengisi' => $userPengisi['Username'],
                            'namaPerevisi' => $userPerevisi['Username']
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
