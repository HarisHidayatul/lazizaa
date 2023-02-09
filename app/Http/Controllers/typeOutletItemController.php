<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\listItemSO;
use App\Models\outlet_type;
use App\Models\type_item;
use App\Models\typeOutlet;
use Illuminate\Http\Request;

class typeOutletItemController extends Controller
{
    // Controller ini digunakan untuk CRUD tipe outlet pada masing masing outlet
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listType = typeOutlet::all();
        $arrayType = [];
        for ($i = 0; $i < $listType->count(); $i++) {
            array_push($arrayType, (object)[
                'id' => $listType[$i]['id'],
                'type' => $listType[$i]['Nama Type'],
            ]);
        }
        return response()->json([
            'countItem' => $listType->count(),
            'listType' => $arrayType
        ]);
    }
    public function indexOutlet()
    {
        $allOutlet = doutlet::all();
        $arrayOutlet = [];
        for ($i = 0; $i < $allOutlet->count(); $i++) {
            array_push($arrayOutlet, (object)[
                'id' => $allOutlet[$i]['id'],
                'Outlet' => $allOutlet[$i]['Nama Store'],
            ]);
        }
        return response()->json([
            'countItem' => $allOutlet->count(),
            'Outlet' => $arrayOutlet
        ]);
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
        //Tambahkan nama nama tipe outlet
        typeOutlet::create(
            [
                'Nama Type' => $request->NamaType,
            ]
        );
    }
    public function storeItem(Request $request)
    {
        $data = type_item::where('idBahanBaku', '=', $request->idType)->where('idItem', '=', $request->idItem)->first();
        if ($data == null) {
            type_item::create(
                [
                    'idBahanBaku' => $request->idType,
                    'idItem'      => $request->idItem
                ]
            );
        }
    }
    public function storeOutletOnType(Request $request)
    {
        $data = outlet_type::where('idOutlet', '=', $request->idOutlet)->where('idType', '=', $request->idType)->first();
        if ($data == null) {
            outlet_type::create(
                [
                    'idOutlet' => $request->idOutlet,
                    'idType'      => $request->idType
                ]
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function showByItem($id)
    {
        $data = typeOutlet::find($id)->listItemSOs;
        // @dd($data);
        $dataArray = [];
        for ($i = 0; $i < $data->count(); $i++) {
            array_push($dataArray, (object)[
                'id' => $data[$i]['id'],
                'Item' => $data[$i]['Item'],
                'Satuan' => $data[$i]->satuans->Satuan,
                'icon' => $data[$i]['icon']
            ]);
        }
        return response()->json([
            'countItem' => $data->count(),
            'itemfso' => $dataArray
        ]);
    }
    public function showByOutlet($id)
    {
        $data = typeOutlet::find($id)->doutlets;
        // @dd($data);
        $dataArray = [];
        for ($i = 0; $i < $data->count(); $i++) {
            array_push($dataArray, (object)[
                'id' => $data[$i]['id'],
                'Outlet' => $data[$i]['Nama Store'],
            ]);
        }
        return response()->json([
            'countItem' => $data->count(),
            'OutletData' => $dataArray
        ]);
    }
    public function showItemByOutlet($id, Request $request)
    {
        $tanggal = $request->tanggal;
        // @dd($tanggal);
        $midDate = 15;
        $endDate = date("t", strtotime($tanggal));
        // @dd($endDate);
        $dateNow = date_format(date_create($tanggal),"d");
        // @dd($dateNow);
        // @dd(($dateNow == $midDate)or($dateNow==$endDate));
        $data = doutlet::find($id)->typeOutlets;
        $listItemSo = listItemSO::all();
        $countItem = 0;
        // @dd($data[0]['id']);
        $dataArray = [];
        $tipeArray = [];
        $dataId = [];
        for ($i = 0; $i < $data->count(); $i++) {
            $data2 = typeOutlet::find($data[$i]['id'])->listItemSOs;
            for ($j = 0; $j < $data2->count(); $j++) {
                $findSame = false;
                for ($k = 0; $k < count($dataId); $k++) {
                    if ($dataId[$k] == $data2[$j]['id']) {
                        $findSame = true;
                        break;
                    }
                }
                if (!$findSame) {
                    $countItem += 1;
                    array_push($dataArray, (object)[
                        'id' => $data2[$j]['id'],
                        'Item' => $data2[$j]['Item'],
                        'satuan' => $data2[$j]->satuans['Satuan'],
                        'icon' => $data2[$j]['icon']
                    ]);
                    array_push($dataId, $data2[$j]['id']);
                }
            }
            array_push($tipeArray, (object)[
                'id' => $data[$i]['id'],
                'type' => $data[$i]['Nama Type']
            ]);
        }
        if (($dateNow == $midDate) or ($dateNow == $endDate)) {
            for ($i = 0; $i < $listItemSo->count(); $i++) {
                if ($listItemSo[$i]['munculMingguan'] > 0) {
                    $newItemSo = $listItemSo[$i];
                    $findSame = false;
                    for ($k = 0; $k < count($dataId); $k++) {
                        if ($dataId[$k] == $newItemSo['id']) {
                            $findSame = true;
                            break;
                        }
                    }
                    if (!$findSame) {
                        $countItem += 1;
                        array_push($dataArray, (object)[
                            'id' => $newItemSo['id'],
                            'Item' => $newItemSo['Item'],
                            'satuan' => $newItemSo->satuans['Satuan'],
                            'icon' => $newItemSo['icon']
                        ]);
                        array_push($dataId, $newItemSo['id']);
                    }
                }
            }
        }
        return response()->json([
            'countItem' => $countItem,
            'DataItem' => $dataArray,
            'Type' => $tipeArray
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

    public function updateType($id, Request $request)
    {
        $typeOutlet = typeOutlet::find($id);
        $typeOutlet->update([
            'Nama Type' => $request->NamaType
        ]);
        echo 1;
        // @dd($typeOutlet);
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
        //delete type

    }

    public function destroyItemOnType(Request $request)
    {
        $dataDestroy = type_item::where('idBahanBaku', '=', $request->idType)
            ->where('idItem', '=', $request->idItem)->firstOrFail();
        $dataDestroy->delete();
    }
    public function destroyOutletOnType(Request $request)
    {
        $dataDestroy = outlet_type::where('idOutlet', '=', $request->idOutlet)
            ->where('idType', '=', $request->idType)->firstOrFail();
        $dataDestroy->delete();
    }
}
