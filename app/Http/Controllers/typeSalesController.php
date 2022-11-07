<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\listSales;
use App\Models\outletListSales;
use App\Models\typeSales;
use Illuminate\Http\Request;

class typeSalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $typeSales = typeSales::all();
        $arrayTypeSales = [];
        for ($i = 0; $i < $typeSales->count(); $i++) {
            array_push($arrayTypeSales, (object)[
                'id' => $typeSales[$i]['id'],
                'type' => $typeSales[$i]['type'],
            ]);
        }
        return response()->json([
            'countItem' => $typeSales->count(),
            'typeSales' => $arrayTypeSales
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
        //
        typeSales::create(
            [
                'type' => $request->NamaType,
            ]
        );
    }
    public function storeItem(Request $request)
    {
        listSales::create(
            [
                'typeSales' => $request->idType,
                'sales' => $request->NamaItem
            ]
        );
    }
    public function storeItemOnOutlet(Request $request)
    {
        $data = outletListSales::where('idOutlet', '=', $request->idOutlet)->where('idListSales', '=', $request->idListSales)->first();
        if ($data == null) {
            outletListSales::create(
                [
                    'idOutlet' => $request->idOutlet,
                    'idListSales'      => $request->idListSales
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
        //Tampilkan listSales dengan parameter type id ini
        $listSales = typeSales::find($id)->listSaless;
        $arrayListSales = [];
        for ($i = 0; $i < $listSales->count(); $i++) {
            array_push($arrayListSales, (object)[
                'id' => $listSales[$i]['id'],
                'sales' => $listSales[$i]['sales'],
            ]);
        }
        return response()->json([
            'countItem' => $listSales->count(),
            'listSales' => $arrayListSales
        ]);
    }
    public function showItemType()
    {
        //Tampilkan listSales dengan parameter type id ini
        // $listSales = typeSales::find($id)->listSaless;
        $typeSales = typeSales::all();
        $arrayTypeSales = [];
        for ($i = 0; $i < $typeSales->count(); $i++) {
            $arrayListSales = [];
            for ($j = 0; $j < $typeSales[$i]->listSaless->count(); $j++) {
                array_push($arrayListSales, (object)[
                    'id' => $typeSales[$i]->listSaless[$j]['id'],
                    'sales' => $typeSales[$i]->listSaless[$j]['sales'],
                ]);
            }
            array_push($arrayTypeSales, (object)[
                'id' => $typeSales[$i]['id'],
                'type' => $typeSales[$i]['type'],
                'listSales' => $arrayListSales
            ]);
        }

        return response()->json([
            'listType' => $arrayTypeSales
        ]);
    }
    public function showAll()
    {
        //tampilkan seluruh listSales
        $listSales = listSales::all();
        $arrayListSales = [];
        for ($i = 0; $i < $listSales->count(); $i++) {
            array_push($arrayListSales, (object)[
                'id' => $listSales[$i]['id'],
                'sales' => $listSales[$i]['sales'],
            ]);
        }
        return response()->json([
            'countItem' => $listSales->count(),
            'listSales' => $arrayListSales
        ]);
    }
    public function showListOnOutlet($id)
    {
        //tampilkan list sale dalam setiap item berdasarkan id outlet
        $listSales = doutlet::find($id)->outletListSaless;
        $arrayListSales = [];
        for ($i = 0; $i < $listSales->count(); $i++) {
            array_push($arrayListSales, (object)[
                'id' => $listSales[$i]['id'],
                'sales' => $listSales[$i]['sales'],
            ]);
        }
        return response()->json([
            'countItem' => $listSales->count(),
            'listSales' => $arrayListSales
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
    public function destroyItemOnOutlet(Request $request)
    {
        $dataDestroy = outletListSales::where('idOutlet', '=', $request->idOutlet)
            ->where('idListSales', '=', $request->idListSales)->firstOrFail();
        $dataDestroy->delete();
    }
}
