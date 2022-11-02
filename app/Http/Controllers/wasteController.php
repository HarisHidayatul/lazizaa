<?php

namespace App\Http\Controllers;

use App\Models\brandWaste;
use App\Models\dBrand;
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
        $data = wasteFill::where('idWaste','=',$request->idWaste)
                ->where('idListItem','=',$request->idListItem)->first();
        if($data == null){
            $dataArray = [
                'idWaste' => $request->idWaste,
                'idListItem' => $request->idListItem,
                'quantity' => $request->quantity,
                'total' => $request->total,
                'idPengisi' => $request->idPengisi
            ];
            wasteFill::create($dataArray);
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
            'idSatuan' => $request->idSatuan,
            'idJenisBahan' => $request->idJenisBahan
        ];
        listItemWaste::create($dataArray);
    }

    public function storeItemRevision(Request $request)
    {
        $dataArray = [
            'Item' => $request->Item,
            'idSatuan' => $request->idSatuan,
            'idOutlet' => $request->idOutlet,
            'idJenisBahan' => $request->idJenisBahan
        ];
        reqItemWaste::create($dataArray);
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
                'idJenisBahan' =>$idJenisBahan
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
        $sales = [];
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
                    'idListSales' => $dataWaste[$i]->listItemWastes[$j]->id,
                    'Satuan' => $satuan->Satuan,
                    'jenis' => $jenis->jenis,
                    'idQtyRev' => $idQuantityRevisi,
                    'qty' => $qty,
                    'namaPengisi' => $userPengisi['Username'],
                ]);
            }
            array_push($sales, (object)[
                'idWaste' => $dataWaste[$i]['id'],
                'Item' => $WasteArray,
            ]);
        }
        return response()->json([
            'countItem' => $dataWaste->count(),
            'itemWaste' => $sales
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

    public function showAllRevisi()
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

    public function showItemOnBrand(Request $request)
    {
        $dataa = dBrand::find($request->idBrand)->listItemWastes;
        $jenisBahan = jenisBahan::all();
        $jenisBahanArray = array();

        for ($i = 0; $i < $jenisBahan->count(); $i++) {
            array_push($jenisBahanArray, array($jenisBahan[$i]->id,$jenisBahan[$i]->jenis));
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
        $arraySortData =[];
        for($i=0;$i<count($jenisBahanArray);$i++){
            $arrayItem = [];
            for($j=0;$j<count($arrayData);$j++){
                if($jenisBahanArray[$i][0]==$arrayData[$j]->idJenisBahan){
                    array_push($arrayItem,$arrayData[$j]);
                }
            }
            array_push($arraySortData,(object)[
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
        //tampilkan seluruh listSales
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
