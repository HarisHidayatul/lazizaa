<?php

namespace App\Http\Controllers;

use App\Models\dBrand;
use App\Models\doutlet;
use App\Models\satuan;
use Illuminate\Http\Request;

class commonController extends Controller
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

    public function storeOutlet(Request $request){
        $outlet = doutlet::create([
            'Nama Store' => $request->namaStore,
            'Alamat Lengkap' => $request->alamatStore,
            'idBrand' => $request->idBrand
        ]);
    }

    public function storeBrand(Request $request){
        $brand = dBrand::create([
            'Nama Brand' => $request->namaBrand,
            'Keterangan' => $request->keterangan,
            'Image' => $request->logoBrand
        ]);
    }

    public function storeSatuan(Request $request){
        $satuan = satuan::create([
            'Satuan' => $request->satuan
        ]);
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

    public function showOutlet($idBrand){
        $outlet = doutlet::where('idBrand','=',$idBrand)->get();
        $brand = dBrand::all();
        $array = [];
        $arrayBrand = [];
        for($i =0;$i<$brand->count();$i++){
            array_push($arrayBrand, (object)[
                'id' => $brand[$i]->id,
                'brand' => $brand[$i]['Nama Brand']
            ]);
        }
        for($i=0;$i<$outlet->count();$i++){
            array_push($array, (object)[
                'id' => $outlet[$i]['id'],
                'store' => $outlet[$i]['Nama Store'],
                'alamat' => $outlet[$i]['Alamat Lengkap'],
                'brand' => $outlet[$i]->dBrands['Nama Brand'],
                'idBrand' => $outlet[$i]->idBrand
            ]);
        }
        return response()->json([
            'countItem' => $outlet->count(),
            'dataItem' => $array,
            'brand' => $arrayBrand
        ]);
    }

    public function showSatuan()
    {
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

    public function showBrand(){
        $brand = dBrand::all();
        $array = [];
        for($i=0;$i<$brand->count();$i++){
            array_push($array, (object)[
                'id' => $brand[$i]->id,
                'brand' => $brand[$i]['Nama Brand'],
                'keterangan' => $brand[$i]->Keterangan,
                'logo' => $brand[$i]->Image
            ]);
        }
        return response()->json([
            'countItem' => $brand->count(),
            'dataItem' => $array
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

    public function updateOutlet(Request $request, $id){
        $outlet = doutlet::find($id)->update([
            'Nama Store' => $request->namaStore,
            'Alamat Lengkap' => $request->alamatStore,
            'idBrand' => $request->idBrand
        ]);
    }

    public function updateBrand(Request $request, $id){
        $brand = dBrand::find($id)->update([
            'Nama Brand' => $request->namaBrand,
            'Keterangan' => $request->keterangan,
            'Image' => $request->logoBrand
        ]);
    }

    public function updateSatuan(Request $request, $id)
    {
        $satuan = satuan::find($id)->update([
            'Satuan' => $request->satuan
        ]);
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
