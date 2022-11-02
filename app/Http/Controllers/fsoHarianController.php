<?php

namespace App\Http\Controllers;

use App\Models\dBrand;
use App\Models\dUser;
use App\Models\fsoHarian;
use App\Models\listItemSO;
use App\Models\soFill;
use App\Models\tanggalAll;
use Carbon\Carbon;
use Database\Seeders\soHarian;
use Exception;
use Illuminate\Http\Request;

class fsoHarianController extends Controller
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
        $dataArray = [
            'idPengisi' => $request->idPengisi,
            'idOutlet' => $request->idOutlet,
            'Tanggal' => $request->tanggal,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        fsoHarian::create($dataArray);
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
        $datafso = fsoHarian::where('idOutlet', '=', $id)->orderBy('idTanggal', 'DESC')->get();
        $fsoArray = [];
        // @dd($datafso[2]->soFills->quantity);
        // @dd($datafso[2]->listItemSOs[0]->pivot->quantity);
        // @dd($datafso[1]->listItemSOs->count());
        // @dd(soFill::where('idSo','=','1')->get());
        // @dd($datafso[0]->dusers);
        for ($i = 0; $i < $datafso->count(); $i++) {
            $itemArray = [];
            for ($j = 0; $j < ($datafso[$i]->listItemSOs->count()); $j++) {
                $idSoRevisi = $datafso[$i]->listItemSOs[$j]->pivot->idRevisi;
                if ($idSoRevisi == '2') {
                    //Jika statusnya revisi
                    array_push($itemArray, (object)[
                        'idItem' => $datafso[$i]->listItemSOs[$j]->id,
                        // 'item'   => $datafso[$i]->listItemSOs[$j]->Item,
                        // 'satuan' => $datafso[$i]->listItemSOs[$j]->Satuan,
                        'idRev' => $datafso[$i]->listItemSOs[$j]->pivot->idRevisi,
                        'qty'    => $datafso[$i]->listItemSOs[$j]->pivot->quantityRevisi,
                        'idSoFill' => $datafso[$i]->listItemSOs[$j]->pivot->id
                    ]);
                } else {
                    //Jika statusnya tidak direvisi maupun sudah direvisi
                    array_push($itemArray, (object)[
                        'idItem' => $datafso[$i]->listItemSOs[$j]->id,
                        // 'item'   => $datafso[$i]->listItemSOs[$j]->Item,
                        // 'satuan' => $datafso[$i]->listItemSOs[$j]->Satuan,
                        'idRev' => $datafso[$i]->listItemSOs[$j]->pivot->idRevisi,
                        'qty'    => $datafso[$i]->listItemSOs[$j]->pivot->quantity,
                        'idSoFill' => $datafso[$i]->listItemSOs[$j]->pivot->id
                    ]);
                }
            }
            array_push($fsoArray, (object)[
                'Tanggal' => $datafso[$i]->tanggalAlls->Tanggal,
                'idSo' => $datafso[$i]['id'],
                // 'Item' => json_encode($itemArray),
                'pengisi' => $datafso[$i]->dusers['Username'],
                // 'idPengisi' => $datafso[$i]->dusers['id'],
                'Item' => $itemArray,
            ]);
        }
        return response()->json([
            'countItem' => $datafso->count(),
            'itemfso' => $fsoArray
        ]);
    }

    public function showAllDataSo()
    {
        $outletShow = dBrand::all();
        for($i=0;$i<$outletShow->count();$i++){
            for($j=0;$j<$outletShow->doutlets->count();$j++){

            }
        }
        @dd($outletShow->doutlets);
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

        $idPengisi = $request->idPengisi;
        $idOutlet = dUser::find($idPengisi)->idOutlet;
        try {
            $dataa = fsoHarian::where('idTanggal', '=', $tanggalID)->where('idOutlet', '=', $idOutlet)->first()->id;
            echo $dataa;
        } catch (Exception $e) {
            //jika tidak ditemukan data, coba untuk create data, dan kembalikan ID
            try {
                $dataArray = [
                    'idTanggal' => $tanggalID,
                    'idPengisi' => $idPengisi,
                    'idOutlet' => $idOutlet,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
                fsoHarian::create($dataArray);
                $dataa = fsoHarian::where('idTanggal', '=', $tanggalID)->where('idOutlet', '=', $idOutlet)->first()->id;
                echo $dataa;
            } catch (Exception $e) {
                //tidak ditemukan userID atau format tanggal salah, return 0
                echo $e;
            }
        }
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

    public function editSoFill($id,Request $request){
        soFill::find($id)->update([
            'quantityRevisi'=> $request->quantityRevisi,
            'idRevisi'      => '2'
        ]);
    }
    public function editFsoHarian($id,Request $request){
        fsoHarian::find($id)->update([
            'idPengisi' => $request->idPengisi
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
}
