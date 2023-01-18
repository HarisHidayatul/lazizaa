<?php

namespace App\Http\Controllers;

use App\Models\listItemSO;
use App\Models\satuan;
use Illuminate\Http\Request;

class itemSOController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $itemso = listItemSO::all();
        $arraySO = [];
        for($i=0;$i<$itemso->count();$i++)
        {
            array_push($arraySO,(object)[
                'id' => $itemso[$i]['id'],
                'item' => $itemso[$i]['Item'],
                'Satuan' => $itemso[$i]->satuans['Satuan']
            ]);
        }
        return response()->json([
            'countItem'=>$itemso->count(),
            'itemSO'=> $arraySO
        ]);
    }

    public function showAllItem(){
        $itemso = listItemSO::orderBy('id', 'DESC')->get();
        $satuanAll = satuan::all();
        $arraySO = [];
        $arrayAllSatuan = [];
        for($i =0; $i < $satuanAll->count();$i++){
            array_push($arrayAllSatuan, (object)[
                'id' => $satuanAll[$i]->id,
                'satuan' => $satuanAll[$i]->Satuan
            ]);
        }
        for($i=0;$i<$itemso->count();$i++)
        {
            array_push($arraySO,(object)[
                'id' => $itemso[$i]['id'],
                'item' => $itemso[$i]['Item'],
                'idSatuan' => $itemso[$i]['idSatuan'],
                'icon' => $itemso[$i]['icon']
            ]);
        }
        return response()->json([
            'satuan' => $arrayAllSatuan,
            'itemSO'=> $arraySO
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
        $dataArray = [
            'Item' => $request->item,
            'idSatuan' => $request->idSatuan,
            'icon' => $request->icon
        ];
        listItemSO::create($dataArray);
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
        $listItemSO = listItemSO::find($id);
        $listItemSO->update([
            'Item' => $request->item,
            'idSatuan' => $request->idSatuan,
            'icon' => $request->icon
        ]);
        echo 1;
        // @dd($listItemSO);
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
}
