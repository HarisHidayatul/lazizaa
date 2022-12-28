<?php

namespace App\Http\Controllers;

use App\Models\dBrand;
use App\Models\doutlet;
use App\Models\dUser;
use App\Models\fsoHarian;
use App\Models\listItemSO;
use App\Models\soFill;
use App\Models\soHarianBatas;
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

    public function storeBatas($idOutlet, Request $request)
    {
        $soHarianBatas = soHarianBatas::where('idOutlet', '=', $idOutlet)->get();
        // @dd($soHarianBatas->count() == 0);
        if ($soHarianBatas->count() == 0) {
            $soHarianBatas = soHarianBatas::create([
                'idOutlet' => $idOutlet,
                'idPengisi' => $request->idPengisi,
                'quantity' => $request->quantity,
                'idItemSo' => $request->idItemSo
            ]);
        } else {
            $soHarianBatas = $soHarianBatas->where('idItemSo', '=', $request->idItemSo);
            // @dd();
            if ($soHarianBatas->count() == 0) {
                $soHarianBatas = soHarianBatas::create([
                    'idOutlet' => $idOutlet,
                    'idPengisi' => $request->idPengisi,
                    'quantity' => $request->quantity,
                    'idItemSo' => $request->idItemSo
                ]);
            } else {
                $soHarianBatas = $soHarianBatas->first()->update([
                    'quantity' => $request->quantity,
                    'idPengisi' => $request->idPengisi
                ]);
            }
        }
        echo 1;
        // @dd($soHarianBatas);
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

    public function showOnDate($id, $date)
    {
        $dataDate = tanggalAll::where('Tanggal', '=', $date)->first()->fsoHarians->where('idOutlet', '=', $id)->first();
        // @dd($dataDate);
        $itemArray = [];
        for ($j = 0; $j < ($dataDate->listItemSOs->count()); $j++) {
            $idSoRevisi = $dataDate->listItemSOs[$j]->pivot->idRevisi;
            if ($idSoRevisi == '2') {
                //Jika statusnya revisi
                array_push($itemArray, (object)[
                    'idItem' => $dataDate->listItemSOs[$j]->id,
                    'item'   => $dataDate->listItemSOs[$j]->Item,
                    'satuan' => $dataDate->listItemSOs[$j]->satuans->Satuan,
                    'icon' => $dataDate->listItemSOs[$j]->icon,
                    'idRev' => $dataDate->listItemSOs[$j]->pivot->idRevisi,
                    'qty'    => $dataDate->listItemSOs[$j]->pivot->quantityRevisi,
                    'idSoFill' => $dataDate->listItemSOs[$j]->pivot->id
                ]);
            } else {
                //Jika statusnya tidak direvisi maupun sudah direvisi
                array_push($itemArray, (object)[
                    'idItem' => $dataDate->listItemSOs[$j]->id,
                    'item'   => $dataDate->listItemSOs[$j]->Item,
                    'satuan' => $dataDate->listItemSOs[$j]->satuans->Satuan,
                    'icon' => $dataDate->listItemSOs[$j]->icon,
                    'idRev' => $dataDate->listItemSOs[$j]->pivot->idRevisi,
                    'qty'    => $dataDate->listItemSOs[$j]->pivot->quantity,
                    'idSoFill' => $dataDate->listItemSOs[$j]->pivot->id
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datafso->count(),
            'pengisi' => $dataDate->dUsers['Nama Lengkap'],
            'itemfso' => $itemArray
        ]);
    }

    public function showAllDataSo()
    {
        $outletShow = dBrand::all();
        for ($i = 0; $i < $outletShow->count(); $i++) {
            for ($j = 0; $j < $outletShow->doutlets->count(); $j++) {
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

    public function showDateRevision()
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        $soDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $dataso = $tanggalAll[$h]->fsoharians;
            $revisionDateFound = false;
            $soOutlet = [];
            for ($i = 0; $i < $dataso->count(); $i++) {
                $soArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($dataso[$i]->listItemSOs->count()); $j++) {
                    $idRevisi = $dataso[$i]->listItemSOs[$j]->pivot->idRevisi;
                    if ($idRevisi == '2') {
                        $revisionFound = true;
                        $qty = 0;
                        $qty = $dataso[$i]->listItemSOs[$j]->pivot->quantityRevisi;
                        $userPengisi = dUser::find($dataso[$i]->idPengisi);
                        array_push($soArray, (object)[
                            'idSoFill' => $dataso[$i]->listItemSOs[$j]->pivot->id,
                            // 'idListSo' => $dataso[$i]->listItemSOs[$j]->id,
                            'Item' => $dataso[$i]->listItemSOs[$j]->Item,
                            'satuan' => $dataso[$i]->listItemSOs[$j]->satuans['Satuan'],
                            'idRev' => $idRevisi,
                            'qty' => $qty,
                            'namaPengisi' => $userPengisi['Username'],
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($dataso[$i]['idOutlet']);
                    array_push($soOutlet, (object)[
                        // 'Tanggal' => $dataso[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $soArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($soDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $soOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $dataso->count(),
            'itemSo' => $soDate
        ]);
    }

    public function showDateRevisionDone()
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        $soDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $dataso = $tanggalAll[$h]->fsoharians;
            $revisionDateFound = false;
            $soOutlet = [];
            for ($i = 0; $i < $dataso->count(); $i++) {
                $soArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($dataso[$i]->listItemSOs->count()); $j++) {
                    $idRevisi = $dataso[$i]->listItemSOs[$j]->pivot->idRevisi;
                    if ($idRevisi == '3') {
                        $revisionFound = true;
                        $qty = 0;
                        $qty = $dataso[$i]->listItemSOs[$j]->pivot->quantity;
                        $perevisi = dUser::find($dataso[$i]->listItemSOs[$j]->pivot->idPerevisi);
                        array_push($soArray, (object)[
                            'idSoFill' => $dataso[$i]->listItemSOs[$j]->pivot->id,
                            // 'idListSo' => $dataso[$i]->listItemSOs[$j]->id,
                            'Item' => $dataso[$i]->listItemSOs[$j]->Item,
                            'satuan' => $dataso[$i]->listItemSOs[$j]->satuans['Satuan'],
                            'idRev' => $idRevisi,
                            'qty' => $qty,
                            'namaPengisi' => $dataso[$i]->dUsers->Username,
                            'namaPerevisi' => $perevisi['Username'],
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($dataso[$i]['idOutlet']);
                    array_push($soOutlet, (object)[
                        // 'Tanggal' => $dataso[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $soArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($soDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $soOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $dataso->count(),
            'itemSo' => $soDate
        ]);
    }

    public function showBatas($idOutlet)
    {
        $soHarianBatas = soHarianBatas::where('idOutlet', '=', $idOutlet)->get();
        $dataSoHarian = [];
        for ($i = 0; $i < $soHarianBatas->count(); $i++) {
            array_push($dataSoHarian, (object)[
                'idItem' => $soHarianBatas[$i]->listItemSOs->id,
                'item' => $soHarianBatas[$i]->listItemSOs->Item,
                'quantity' => $soHarianBatas[$i]->quantity
            ]);
        }
        return response()->json([
            'dataSo' => $dataSoHarian
        ]);
    }

    public function showDataBatasOnDate($idOutlet, $date)
    {
        $dataLimitSo = [];
        $soHarianBatas = soHarianBatas::where('idOutlet', '=', $idOutlet)->get();
        // @dd($soHarianBatas->where('idItemSo','=',1)->first());
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        if ($tanggalAll != null) {
            $fsoharian = $tanggalAll->fsoharians->where('idOutlet', '=', $idOutlet)->first();
            if ($fsoharian != null) {
                $listItemSO = $fsoharian->listItemSOs;
                // @dd($listItemSO[0]->pivot);
                for ($i = 0; $i < $listItemSO->count(); $i++){
                    $limSoHarian = $soHarianBatas->where('idItemSo','=',$listItemSO[$i]->id)->first()->quantity;
                    $valSoHarian = $listItemSO[$i]->pivot->quantity;
                    if($listItemSO[$i]->pivot->idRevisi == '2'){
                        $valSoHarian = $listItemSO[$i]->pivot->quantityRevisi;
                    }
                    if($valSoHarian < $limSoHarian){
                        array_push($dataLimitSo, (object)[
                            'quantity' => $valSoHarian,
                            'item' => $listItemSO[$i]->Item,
                            'icon' => $listItemSO[$i]->icon,
                            'satuan' => $listItemSO[$i]->satuans->Satuan
                        ]);
                    }
                }
            }
        }
        return response()->json([
            'dataLimitSo' => $dataLimitSo
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

    public function editQtyRev(Request $request)
    {
        soFill::find($request->idSoFill)->update([
            'quantity' => $request->qty,
            'idRevisi'      => '3',
            'idPerevisi' => $request->idPerevisi,
        ]);
    }

    public function editSoFill($id, Request $request)
    {
        soFill::find($id)->update([
            'quantityRevisi' => $request->quantityRevisi,
            'idRevisi'      => '2'
        ]);
    }
    public function editFsoHarian($id, Request $request)
    {
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
