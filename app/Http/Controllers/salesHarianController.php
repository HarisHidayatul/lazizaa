<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\dUser;
use App\Models\listSales;
use App\Models\outletListSales;
use App\Models\perevisiSales;
use App\Models\reqItemSales;
use App\Models\salesFill;
use App\Models\salesharian;
use App\Models\tanggalAll;
use App\Models\typeSales;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class salesHarianController extends Controller
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
        $data = salesFill::where('idSales', '=', $request->idSales)
            ->where('idListSales', '=', $request->idListSales)->first();
        if ($data == null) {
            $dataArray = [
                'idSales' => $request->idSales,
                'idListSales' => $request->idListSales,
                'cu' => $request->cu,
                'total' => $request->total,
                'idPengisi' => $request->idPengisi,
                'idPerevisi' => $request->idPengisi
            ];
            salesFill::create($dataArray);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function storeItemRevision(Request $request)
    {
        // @dd($request);
        $checkRevisi = reqItemSales::where('idOutlet', '=', $request->idOutlet)
            ->where('idSales', '=', $request->idSales)
            ->first();
        // @dd($checkRevisi);
        if ($checkRevisi == null) {
            $dataArray = [
                'idOutlet' => $request->idOutlet,
                'idSales' => $request->idSales,
            ];
            reqItemSales::create($dataArray);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function storeRevisionCheck(Request $request)
    {
        $status = $request->status;
        $idRev = $request->idRev;

        $reqSales = reqItemSales::find($idRev);
        
        if ($status == '1') {
            //status 1 untuk accept
            $checkExist = outletListSales::where('idOutlet', '=', $reqSales->idOutlet)
            ->where('idListSales', '=', $reqSales->idSales)
            ->first();
            if ($checkExist == null) {
                $dataArray = [
                    'idOutlet' => $reqSales->idOutlet,
                    'idListSales' => $reqSales->idSales,
                ];
                outletListSales::create($dataArray);
            }
            $reqSales->delete();
        }
        if ($status == '2') {
            //status 2 untuk delete
            $reqSales->delete();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $date)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        // @dd($tanggalAll);
        $datasales = null;
        $sales = [];
        if ($tanggalAll != null) {
            $datasales = salesharian::where('idOutlet', '=', $id)->where('idTanggal', '=', $tanggalAll['id'])->get();
            for ($i = 0; $i < $datasales->count(); $i++) {
                $salesArray = [];
                for ($j = 0; $j < ($datasales[$i]->listSaless->count()); $j++) {
                    $idCuRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiCu;
                    $idTotalRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiTotal;
                    $cuQty = $datasales[$i]->listSaless[$j]->pivot->cu;
                    $totalQty = $datasales[$i]->listSaless[$j]->pivot->total;
                    $userPengisi = dUser::find($datasales[$i]->listSaless[$j]->pivot->idPengisi);
                    if ($idCuRevisi == '2') {
                        //Jika statusnya revisi pada CU
                        $cuQty = $datasales[$i]->listSaless[$j]->pivot->cuRevisi;
                    }
                    if ($idTotalRevisi == '2') {
                        $totalQty = $datasales[$i]->listSaless[$j]->pivot->totalRevisi;
                    }
                    array_push($salesArray, (object)[
                        'idSalesFill' => $datasales[$i]->listSaless[$j]->pivot->id,
                        'idListSales' => $datasales[$i]->listSaless[$j]->id,
                        'idCuRev' => $idCuRevisi,
                        'idTotalRev' => $idTotalRevisi,
                        'cuQty' => $cuQty,
                        'totalQty' => $totalQty,
                        'namaPengisi' => $userPengisi['Username'],
                    ]);
                }
                array_push($sales, (object)[
                    // 'Tanggal' => $datasales[$i]['Tanggal'],
                    'idSales' => $datasales[$i]['id'],
                    'Item' => $salesArray,
                ]);
            }
        }
        // @dd($datasales);
        // @dd($datasales[0]->listSaless[0]->pivot->total);
        return response()->json([
            // 'countItem' => $datasales->count(),
            'itemSales' => $sales
        ]);
    }

    public function showAllData($id, $date)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        // @dd($tanggalAll);
        $datasales = null;
        $allDataArray = [];
        if ($tanggalAll != null) {
            $datasales = salesharian::where('idOutlet', '=', $id)->where('idTanggal', '=', $tanggalAll['id'])->first();
            if ($datasales != null) {
                // @dd($datasales->listSaless[0]->typeSaless);
                //Collect based on typeSales
                $allTypeSales = typeSales::all();
                // @dd($allTypeSales);
                for ($i = 0; $i < $allTypeSales->count(); $i++) {
                    $idType = $allTypeSales[$i]->id;
                    $dataOnType = [];
                    for ($j = 0; $j < $datasales->listSaless->count(); $j++) {
                        if ($datasales->listSaless[$j]->typeSales == $idType) {
                            $idCuRevisi = $datasales->listSaless[$j]->pivot->idRevisiCu;
                            $idTotalRevisi = $datasales->listSaless[$j]->pivot->idRevisiTotal;
                            $cuQty = $datasales->listSaless[$j]->pivot->cu;
                            $totalQty = $datasales->listSaless[$j]->pivot->total;
                            $userPengisi = dUser::find($datasales->listSaless[$j]->pivot->idPengisi);
                            if ($idCuRevisi == '2') {
                                //Jika statusnya revisi pada CU
                                $cuQty = $datasales->listSaless[$j]->pivot->cuRevisi;
                            }
                            if ($idTotalRevisi == '2') {
                                $totalQty = $datasales->listSaless[$j]->pivot->totalRevisi;
                            }
                            array_push($dataOnType, (object)[
                                'idSalesFill' => $datasales->listSaless[$j]->pivot->id,
                                'sales' => $datasales->listSaless[$j]->sales,
                                'idCuRev' => $idCuRevisi,
                                'idTotalRev' => $idTotalRevisi,
                                'cuQty' => $cuQty,
                                'totalQty' => $totalQty,
                                'namaPengisi' => $userPengisi['Nama Lengkap'],
                            ]);
                        }
                    }
                    if ($dataOnType != null) {
                        array_push($allDataArray, (object)[
                            'type' => $allTypeSales[$i]->type,
                            'sales' => $dataOnType
                        ]);
                    }
                }
            }
        }
        return response()->json($allDataArray);
    }

    public function showDateRevision()
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->salesharians);
        $salesDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $datasales = $tanggalAll[$h]->salesharians;
            $revisionDateFound = false;
            // @dd($datasales[0]->listsaless);
            $salesOutlet = [];
            for ($i = 0; $i < $datasales->count(); $i++) {
                $salesArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($datasales[$i]->listSaless->count()); $j++) {
                    $idCuRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiCu;
                    $idTotalRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiTotal;
                    if (($idCuRevisi == '2') or ($idTotalRevisi == '2')) {
                        $revisionFound = true;
                        $cuQty = 0;
                        $totalQty = 0;
                        if ($idCuRevisi == '2') {
                            $cuQty = $datasales[$i]->listSaless[$j]->pivot->cuRevisi;
                        } else {
                            $cuQty = $datasales[$i]->listSaless[$j]->pivot->cu;
                        }
                        if ($idTotalRevisi == '2') {
                            $totalQty = $datasales[$i]->listSaless[$j]->pivot->totalRevisi;
                        } else {
                            $totalQty = $datasales[$i]->listSaless[$j]->pivot->total;
                        }
                        $userPengisi = dUser::find($datasales[$i]->listSaless[$j]->pivot->idPengisi);
                        array_push($salesArray, (object)[
                            'idSalesFill' => $datasales[$i]->listSaless[$j]->pivot->id,
                            // 'idListSales' => $datasales[$i]->listSaless[$j]->id,
                            'sales' => $datasales[$i]->listSaless[$j]->sales,
                            'idCuRev' => $idCuRevisi,
                            'idTotalRev' => $idTotalRevisi,
                            'cuQty' => $cuQty,
                            'totalQty' => $totalQty,
                            'namaPengisi' => $userPengisi['Username'],
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($datasales[$i]['idOutlet']);
                    array_push($salesOutlet, (object)[
                        // 'Tanggal' => $datasales[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $salesArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($salesDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $salesOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'itemSales' => $salesDate
        ]);
    }

    public function showAllRequest(){
        $reqSales = reqItemSales::all();
        $arrayreqSales = [];
        // @dd($reqSales[0]->satuans);
        for ($i = 0; $i < $reqSales->count(); $i++) {
            $outlet = $reqSales[$i]->doutlets;
            $brand = $outlet->dBrands;
            array_push($arrayreqSales, (object)[
                'id' => $reqSales[$i]['id'],
                'sales' => $reqSales[$i]->listSaless->sales,
                'outlet' => $outlet['Nama Store'],
                'brand' => $brand['Nama Brand']
            ]);
        }
        return response()->json([
            'countItem' => $reqSales->count(),
            'reqSales' => $arrayreqSales
        ]);
    }

    public function showDateRevisionDone()
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->salesharians);
        $salesDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $datasales = $tanggalAll[$h]->salesharians;
            // @dd($datasales[0]->listsaless);
            $salesOutlet = [];
            $revisionDateFound = false;
            for ($i = 0; $i < $datasales->count(); $i++) {
                $salesArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($datasales[$i]->listSaless->count()); $j++) {
                    $idCuRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiCu;
                    $idTotalRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiTotal;
                    if (($idCuRevisi == '3') or ($idTotalRevisi == '3')) {
                        $revisionFound = true;
                        $cuQty = 0;
                        $totalQty = 0;
                        if ($idCuRevisi == '2') {
                            $cuQty = $datasales[$i]->listSaless[$j]->pivot->cuRevisi;
                        } else {
                            $cuQty = $datasales[$i]->listSaless[$j]->pivot->cu;
                        }
                        if ($idTotalRevisi == '2') {
                            $totalQty = $datasales[$i]->listSaless[$j]->pivot->totalRevisi;
                        } else {
                            $totalQty = $datasales[$i]->listSaless[$j]->pivot->total;
                        }
                        $userPengisi = dUser::find($datasales[$i]->listSaless[$j]->pivot->idPengisi);
                        $userPerevisi = dUser::find($datasales[$i]->listSaless[$j]->pivot->idPerevisi);
                        array_push($salesArray, (object)[
                            'idSalesFill' => $datasales[$i]->listSaless[$j]->pivot->id,
                            // 'idListSales' => $datasales[$i]->listSaless[$j]->id,
                            'sales' => $datasales[$i]->listSaless[$j]->sales,
                            'idCuRev' => $idCuRevisi,
                            'idTotalRev' => $idTotalRevisi,
                            'cuQty' => $cuQty,
                            'totalQty' => $totalQty,
                            'namaPengisi' => $userPengisi['Username'],
                            'namaPerevisi' => $userPerevisi['Username']
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($datasales[$i]['idOutlet']);
                    array_push($salesOutlet, (object)[
                        // 'Tanggal' => $datasales[$i]['Tanggal'],
                        'Outlet' => $outlet['Nama Store'],
                        'Item' => $salesArray,
                    ]);
                    $revisionDateFound = true;
                }
            }
            if ($revisionDateFound) {
                array_push($salesDate, (object)[
                    'Tanggal' => $tanggalAll[$h]->Tanggal,
                    'Item' => $salesOutlet
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'itemSales' => $salesDate
        ]);
    }

    public function showList($id)
    {
        //tampilkan list beserta type berdasarkan id outlet
        $listSales = doutlet::find($id)->outletListSaless()->get();
        $arrayListSales = [];
        for ($i = 0; $i < $listSales->count(); $i++) {
            array_push($arrayListSales, (object)[
                'id' => $listSales[$i]['id'],
                'sales' => $listSales[$i]['sales'],
                'typeSales' => $listSales[$i]['typeSales']
            ]);
        }
        return response()->json([
            'countItem' => $listSales->count(),
            'listSales' => $arrayListSales
        ]);
    }
    public function showListBasedType()
    {
        $listSales = listSales::all();
        $allTypeSales = typeSales::all();
        $arrayListSales = [];
        $arrayIdType = [];
        $newListSales = [];
        for ($i = 0; $i < $listSales->count(); $i++) {
            array_push($arrayListSales, (object)[
                'id' => $listSales[$i]['id'],
                'sales' => $listSales[$i]['sales'],
                'typeSales' => $listSales[$i]['typeSales']
            ]);
            array_push($arrayIdType, $listSales[$i]['typeSales']);
        }
        // @dd($allTypeSales);
        for ($i = 0; $i < $allTypeSales->count(); $i++) {
            $idType = $allTypeSales[$i]->id;
            $tempArray = [];
            for ($j = 0; $j < count($arrayIdType); $j++) {
                if ($idType == $arrayIdType[$j]) {
                    array_push($tempArray, $arrayListSales[$j]);
                    // break;
                }
            }
            if ($tempArray != null) {
                array_push($newListSales, (object)[
                    'id' => $idType,
                    'type' => $allTypeSales[$i]->type,
                    'sales' => $tempArray
                ]);
            }
        }
        return response()->json([
            'countItem' => $listSales->count(),
            'listSales' => $newListSales
        ]);
    }

    public function showRevisiOutlet($id)
    {
        $listSales = reqItemSales::where('idOutlet', '=', $id)->orderBy('id', 'DESC')->get();
        $arraylistSales = [];
        // @dd($listSales[0]->satuans);
        for ($i = 0; $i < $listSales->count(); $i++) {
            array_push($arraylistSales, (object)[
                'id' => $listSales[$i]->listSaless->id,
                'sales' => $listSales[$i]->listSaless->sales
            ]);
        }
        return response()->json([
            'countItem' => $listSales->count(),
            'listSales' => $arraylistSales
        ]);
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
        $idOutlet = $request->idOutlet;
        $dataDate = salesharian::where('idTanggal', '=', $tanggalID)->get();
        $dataa = null;
        if ($dataDate == null) {
            $dataArray = [
                'idTanggal' => $tanggalID,
                'idOutlet' => $idOutlet,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
            $dataa = salesharian::create($dataArray)->id;
        } else {
            $dataOutlet = $dataDate->where('idOutlet', '=', $idOutlet)->first();
            if ($dataOutlet == null) {
                $dataArray = [
                    'idTanggal' => $tanggalID,
                    'idOutlet' => $idOutlet,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
                $dataa = salesharian::create($dataArray)->id;
            } else {
                $dataa = $dataOutlet->id;
            }
        }
        echo $dataa;
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

    public function editCu($id, Request $request)
    {
        salesFill::find($id)->update([
            'idPengisi' => $request->idPengisi,
            'cuRevisi' => $request->cuRevisi,
            'idRevisiCu'      => '2'
        ]);
    }

    public function editCuRev(Request $request)
    {
        salesFill::find($request->idSalesFill)->update([
            'cu' => $request->cuRevisi,
            'idRevisiCu'      => '3',
            'idPerevisi' => $request->idPerevisi,
        ]);
    }

    public function editTotal($id, Request $request)
    {
        salesFill::find($id)->update([
            'idPengisi' => $request->idPengisi,
            'totalRevisi' => $request->totalRevisi,
            'idRevisiTotal' => '2'
        ]);
    }

    public function editTotalRev(Request $request)
    {
        salesFill::find($request->idSalesFill)->update([
            'total' => $request->totalRevisi,
            'idRevisiTotal'      => '3',
            'idPerevisi' => $request->idPerevisi,
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
