<?php

namespace App\Http\Controllers;

use App\Models\dBrand;
use App\Models\doutlet;
use App\Models\drole;
use App\Models\dUser;
use App\Models\satuan;
use App\Models\tempImgAll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function postImageAndGetID(Request $request){
        // ddd($request);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:1048'
        ]);
        $pathFile = $request->file('image')->store('tempImgAll');
        $idSaveTempID = tempImgAll::create([
            'imagePath' => $pathFile
        ])->id;
        return $idSaveTempID;
    }
    public function moveImage($fromPathFile,$toPathFile){
        Storage::move('post-images\oYTnOi0pgnWBvqVj5nIg0O7n3wscjD3w8l8v83am.png','temp-images\1.png');
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

    public function storeUser(Request $request){
        $user = dUser::create([
            'Username' => $request->username,
            'Password' => $request->password,
            'Email' => $request->email,
            'Nama Lengkap' => $request->namaLengkap,
            'idRole' => $request->idRole,
            'idOutlet' => $request->idOutlet
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

    public function showImageTemp($idTempImgAll){
        return tempImgAll::find($idTempImgAll)->imagePath;
    }

    public function showUser($idOutlet){
        $user = dUser::where('idOutlet','=',$idOutlet)->get();
        $outletAll = doutlet::all();
        $roleAll = drole::all();
        $outletArray = [];
        $roleArray = [];
        $userArray = [];
        for($i =0;$i<$outletAll->count();$i++){
            array_push($outletArray, (object)[
                'id' => $outletAll[$i]->id,
                'outlet' => $outletAll[$i]['Nama Store']
            ]);
        }
        for($i = 0;$i<$roleAll->count();$i++){
            array_push($roleArray, (object)[
                'id' => $roleAll[$i]->id,
                'role' => $roleAll[$i]->Role
            ]);
        }
        for($i=0;$i<$user->count();$i++){
            array_push($userArray,(object)[
                'id' => $user[$i]->id,
                'nama' => $user[$i]['Nama Lengkap'],
                'username' => $user[$i]['Username'],
                'password' => $user[$i]['Password'],
                'idRole' => $user[$i]['idRole'],
                'idOutlet' => $user[$i]['idOutlet'],
                'email' => $user[$i]['Email']
            ]);
        }
        return response()->json([
            'dataItem' => $userArray,
            'outlet' => $outletArray,
            'role' => $roleArray
        ]);
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

    public function showAllOutlet(){
        $outlet = doutlet::all();
        $arrayOutlet = [];
        for($i=0;$i<$outlet->count();$i++){
            array_push($arrayOutlet, (object)[
                'id' => $outlet[$i]['id'],
                'store' => $outlet[$i]['Nama Store'],
                'alamat' => $outlet[$i]['Alamat Lengkap'],
                'brand' => $outlet[$i]->dBrands['Nama Brand'],
                'idBrand' => $outlet[$i]->idBrand
            ]);
        }
        return response()->json([
            'countItem' => $outlet->count(),
            'dataItem' => $arrayOutlet
        ]);
    }

    public function showAllRole(){
        $role = drole::all();
        $arrayRole = [];
        for($i=0;$i<$role->count();$i++){
            array_push($arrayRole,(object)[
                'id' => $role[$i]->id,
                'role' => $role[$i]->Role
            ]);
        }
        return response()->json([
            'dataItem' => $arrayRole
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

    public function updateUser(Request $request, $id){
        $user = dUser::find($id)->update([
            'Username' => $request->username,
            'Password' => $request->password,
            'Email' => $request->email,
            'Nama Lengkap' => $request->namaLengkap,
            'idRole' => $request->idRole,
            'idOutlet' => $request->idOutlet            
        ]);
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

    public function deleteImageTemp($idTempImgAll){
        $imagePathTemp = tempImgAll::find($idTempImgAll)->imagePath;
        Storage::delete($imagePathTemp);
        return 1;
    }
}
