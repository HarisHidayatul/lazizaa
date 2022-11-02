<?php

namespace App\Http\Controllers;

use App\Models\listItemSO;
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
            'idSatuan' => $request->idSatuan
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
