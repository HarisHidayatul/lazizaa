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
        $dataSend = $request->dataSend;
        if($dataSend != null){
            $idSo = $request->idSo;
            $idPengisi = fsoHarian::find($idSo)->idPengisi;
            for($i =0;$i<count($dataSend);$i++){
                $dataArray = [
                    'idSo' => $idSo,
                    'idItemSo' => $dataSend[$i][0],
                    'quantity' => $dataSend[$i][1],
                    'idPerevisi' =>  $idPengisi,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
                soFill::create($dataArray);
            }
        }
        echo 'berhasil';
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
