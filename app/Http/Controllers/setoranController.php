<?php

namespace App\Http\Controllers;

use App\Models\jenisBank;
use App\Models\listBank;
use Illuminate\Http\Request;

class setoranController extends Controller
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
    public function showType(){
        $jenisBank = jenisBank::all();
        $jenisAll = [];
        for($i = 0; $i < $jenisBank->count(); $i++){
            array_push($jenisAll, (object)[
                'id' => $jenisBank[$i]->id,
                'jenis' => $jenisBank[$i]->jenis
            ]);
        }
        return response()->json([
            'jenis' => $jenisAll
        ]);
    }

    public function showBank($idJenisBank){
        $listBank = listBank::where('idJenisBank','=',$idJenisBank)->get();
        // @dd($listBank);
        $allBank = [];
        for($i =0; $i < $listBank->count(); $i++){
            array_push($allBank,(object)[
                'id' => $listBank[$i]->id,
                'bank' => $listBank[$i]->bank,
                'img' => $listBank[$i]->imageBank
            ]);
        }
        return response()->json([
            'listBank' => $allBank
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
}
