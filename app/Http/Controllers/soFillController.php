<?php

namespace App\Http\Controllers;

use App\Models\fsoHarian;
use App\Models\soFill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class soFillController extends Controller
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
        $data = soFill::where('idSo','=',$request->idSo)
                ->where('idItemSo','=',$request->idItemSo)->first();
        if($data == null){
            $idPengisi = fsoHarian::find($request->idSo)->idPengisi;
            $dataArray = [
                'idSo' => $request->idSo,
                'idItemSo' => $request->idItemSo,
                'quantity' => $request->quantity,
                'idPerevisi' =>  $idPengisi,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
            soFill::create($dataArray);
            echo 1;
        }else{
            echo 0;
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
