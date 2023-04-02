<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\dUser;
use App\Models\listSales;
use App\Models\listSesi;
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
        $arraySend = $request->dataSend;
        // @dd($arraySend);
        foreach ($arraySend as $dataSend) {
            $data = salesFill::where('idSales', '=', $dataSend['idSales'])
                ->where('idListSales', '=', $dataSend['idListSales'])->first();
            if(is_numeric($dataSend['total'])){
                if ($data == null) {
                    $dataArray = [
                        'idSales' => $dataSend['idSales'],
                        'idListSales' => $dataSend['idListSales'],
                        'total' => $dataSend['total'],
                        'idPengisi' => $dataSend['idPengisi'],
                        'idPerevisi' => $dataSend['idPengisi']
                    ];
                    salesFill::create($dataArray);
                } else {
                    $tempTotal = $data->total;
                    if($tempTotal != $dataSend['total']){
                        $data->update([
                            'idPengisi' => $dataSend['idPengisi'],
                            'totalRevisi' => $dataSend['total'],
                            'idRevisiTotal' => '2'
                        ]);
                    }
                }
            }
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
                'idTanggal' => $request->idTanggal,
                'idPengisi' => $request->idPengisi
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
    public function show($id, $date, $idSesi)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        // @dd($tanggalAll);
        $datasales = null;
        $sales = [];
        $totalManual = 0;
        if ($tanggalAll != null) {
            $datasales = salesharian::where('idOutlet', '=', $id)
                ->where('idTanggal', '=', $tanggalAll['id'])
                ->where('idSesi', '=', $idSesi)
                ->get();
            for ($i = 0; $i < $datasales->count(); $i++) {
                $salesArray = [];
                $totalManual = $datasales[$i]->totalManual;
                for ($j = 0; $j < ($datasales[$i]->listSaless->count()); $j++) {
                    $idTotalRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiTotal;
                    $totalQty = $datasales[$i]->listSaless[$j]->pivot->total;
                    $userPengisi = dUser::find($datasales[$i]->listSaless[$j]->pivot->idPengisi);
                    if ($idTotalRevisi == '2') {
                        $totalQty = $datasales[$i]->listSaless[$j]->pivot->totalRevisi;
                    }
                    array_push($salesArray, (object)[
                        'idSalesFill' => $datasales[$i]->listSaless[$j]->pivot->id,
                        'idListSales' => $datasales[$i]->listSaless[$j]->id,
                        'idTotalRev' => $idTotalRevisi,
                        'totalQty' => $totalQty,
                        'namaPengisi' => $userPengisi['Nama Lengkap'],
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
            'itemSales' => $sales,
            'totalManual' => $totalManual
        ]);
    }

    public function showReimburseSales($idOutlet, $countData, $startDate, $stopDate)
    {
        $now = Carbon::now();
        $outletArray = [];
        $allData = [];
        $allDate = new tanggalAll();

        if ($idOutlet == 0) {
            $tempOutlet = doutlet::all();
            for ($i = 0; $i < $tempOutlet->count(); $i++) {
                array_push($outletArray, $tempOutlet[$i]->id);
            }
        } else {
            array_push($outletArray, $idOutlet);
        }
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'ASC')->with(['salesharians.listSaless', 'salesHarianReimburses.sales_reimburses', 'setorans'])->get();

        if ($countData == 'today') {
            $allDate = $tanggalAll->where('Tanggal', '=', $now->format('Y-m-d'));
        } else if ($countData == '7day') {
            $from = $now->format('Y-m-d');
            $to = $now->subDays(7)->format('Y-m-d');
            $allDate = $tanggalAll->whereBetween('Tanggal', array($to, $from));
        } else if ($countData == '30day') {
            $from = $now->format('Y-m-d');
            $to = $now->subDays(30)->format('Y-m-d');
            $allDate = $tanggalAll->whereBetween('Tanggal', array($to, $from));
        } else if ($countData == 'between') {
            $allDate = $tanggalAll->whereBetween('Tanggal', array($startDate, $stopDate));
        } else if ($countData == 'all') {
            $allDate = $tanggalAll;
        }

        $dataOutletArray = [];
        for ($i = 0; $i < count($outletArray); $i++) {
            $dataPerTanggalArray = [];
            foreach ($allDate as $dataTanggal) {
                $dataPerSesi = [];
                $dataReimburse = [];
                $dataSetoran = [];
                $salesHarian = $dataTanggal->salesharians->where('idOutlet', '=', $outletArray[$i]);
                $salesHarianReimburse = $dataTanggal->salesHarianReimburses->where('idOutlet', '=', $outletArray[$i])->first();
                $setoranHarians = $dataTanggal->setorans->where('idOutlet', '=', $outletArray[$i]);
                // foreach()
                foreach ($setoranHarians as $setoranHarian) {
                    array_push($dataSetoran, (object)[
                        'total' => $setoranHarian->qtySetor,
                        'idReivisiTotal' => $setoranHarian->idRevisi
                    ]);
                }
                if ($salesHarianReimburse != null) {
                    $totalTemp = $salesHarianReimburse->sales_reimburses->total;
                    $idRevisiTotal = $salesHarianReimburse->sales_reimburses->idRevisiTotal;
                    if ($idRevisiTotal == '2') {
                        $totalTemp = $salesHarianReimburse->sales_reimburses->totalRevisi;
                    }
                    array_push($dataReimburse, (object)[
                        'total' => $totalTemp,
                        'idRevisiTotal' => $idRevisiTotal
                    ]);
                }
                foreach ($salesHarian as $salesHarianSesi) {
                    $salesLists = $salesHarianSesi->listSaless;
                    $dataPerSalesArray = [];
                    foreach ($salesLists as $salesList) {
                        $totalTemp = $salesList->pivot->total;
                        $idTotalRevisi = $salesList->pivot->idRevisiTotal;
                        if ($idTotalRevisi == '2') {
                            $totalTemp = $salesList->pivot->totalRevisi;
                        }
                        array_push($dataPerSalesArray, (object)[
                            'sales' => $salesList->sales,
                            'totalDiterima' => $salesList->pivot->totalDiterima,
                            'total' => $totalTemp,
                            'idRevisiTotal' => $idTotalRevisi
                        ]);
                    }
                    array_push($dataPerSesi, (object)[
                        'sesi' => $salesHarianSesi->idSesi,
                        'data' => $dataPerSalesArray,
                        'totalManual' => $salesHarianSesi->totalManual
                    ]);
                }
                array_push($dataPerTanggalArray, (object)[
                    'tanggal' => $dataTanggal->Tanggal,
                    'dataSales' => $dataPerSesi,
                    'dataReimburse' => $dataReimburse,
                    'dataSetor' => $dataSetoran
                ]);
            }
            $dataPerTanggalArray = array_reverse($dataPerTanggalArray, false);
            $outletNama = doutlet::find($outletArray[$i])['Nama Store'];
            array_push($dataOutletArray, (object)[
                'idOutlet' => $outletArray[$i],
                'Outlet' => $outletNama,
                'data' => $dataPerTanggalArray
            ]);
        }
        // @dd($dataOutletArray);
        return response()->json([
            'dataSales' => $dataOutletArray
        ]);
    }

    public function showVerifOutlet($idOutlet, $fromDate, $toDate)
    {
        $tanggalAll = tanggalAll::with('salesharians.listSaless')->whereBetween('Tanggal', array($fromDate, $toDate))->orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->salesharians);
        $salesDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $datasaless = $tanggalAll[$h]->salesharians;
            if ($idOutlet != 0) {
                $datasaless = $datasaless->where('idOutlet', '=', $idOutlet);
            }
            $revisionDateFound = false;
            // @dd($datasales[0]->listsaless);
            $salesOutlet = [];
            foreach($datasaless as $datasales){
                $salesArray = [];
                $revisionFound = false;
                $idSesi = $datasales->idSesi;
                for ($j = 0; $j < ($datasales->listSaless->count()); $j++) {
                    if ($datasales->listSaless[$j]->butuhVerifikasi > 0) {
                        $idTotalRevisi = $datasales->listSaless[$j]->pivot->idRevisiTotal;
                        $revisionFound = true;

                        $totalQty = $datasales->listSaless[$j]->pivot->total;
                        $totalSblm = $totalQty;

                        if ($idTotalRevisi == '2') {
                            $totalQty = $datasales->listSaless[$j]->pivot->totalRevisi;
                        }

                        $jumlahDiterima = $datasales->listSaless[$j]->pivot->totalDiterima;
                        $selisih = $totalQty - $jumlahDiterima;

                        array_push($salesArray, (object)[
                            'idSalesFill' => $datasales->listSaless[$j]->pivot->id,
                            // 'idListSales' => $datasales->listSaless[$j]->id,
                            'sales' => $datasales->listSaless[$j]->sales,
                            'idTotalRev' => $idTotalRevisi,

                            'totalQty' => $totalQty,
                            'totalSblm' => $totalSblm,

                            'jumlahDiterima' => $jumlahDiterima,
                            'idRevJumlah' => $datasales->listSaless[$j]->pivot->idRevDiterima,
                            'selisih' => $selisih,

                            'idSesi' => $idSesi
                        ]);
                    }
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($datasales['idOutlet']);
                    array_push($salesOutlet, (object)[
                        // 'Tanggal' => $datasales['Tanggal'],
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
        // salesHarian;
        return response()->json([
            // 'countItem' => $datasales->count(),
            'itemSales' => $salesDate
        ]);
    }

    public function showAllData($id, $date, $idSesi)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        // @dd($tanggalAll);
        $datasales = null;
        $allDataArray = [];
        if ($tanggalAll != null) {
            $datasales = salesharian::where('idOutlet', '=', $id)->where('idTanggal', '=', $tanggalAll['id'])->where('idSesi', '=', $idSesi)->first();
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
                            $idTotalRevisi = $datasales->listSaless[$j]->pivot->idRevisiTotal;
                            $totalQty = $datasales->listSaless[$j]->pivot->total;
                            $userPengisi = dUser::find($datasales->listSaless[$j]->pivot->idPengisi);
                            if ($idTotalRevisi == '2') {
                                $totalQty = $datasales->listSaless[$j]->pivot->totalRevisi;
                            }
                            array_push($dataOnType, (object)[
                                'idSalesFill' => $datasales->listSaless[$j]->pivot->id,
                                'sales' => $datasales->listSaless[$j]->sales,
                                'idTotalRev' => $idTotalRevisi,
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
                array_push($allDataArray, (object)[
                    'totalManual' => $datasales->totalManual
                ]);
            }
        }
        return response()->json($allDataArray);
    }

    public function showAllDataSesi($idOutlet, $date)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        // @dd($tanggalAll);
        $allDataArray = [];
        $tempDataArray = [];
        $idSesi = 0;
        if ($tanggalAll != null) {
            $allsales = salesharian::orderBy('idSesi', 'ASC')->where('idOutlet', '=', $idOutlet)->where('idTanggal', '=', $tanggalAll['id'])->get();
            // @dd($allsales);
            $tempIdSesi = null;
            for ($i = 0; $i < $allsales->count(); $i++) {
                $datasales = $allsales[$i];
                $idSesi = $datasales->idSesi;
                $dataOnSesi = [];

                for ($j = 0; $j < $datasales->listSaless->count(); $j++) {
                    $idTotalRevisi = $datasales->listSaless[$j]->pivot->idRevisiTotal;
                    $totalQty = $datasales->listSaless[$j]->pivot->total;
                    $userPengisi = dUser::find($datasales->listSaless[$j]->pivot->idPengisi);
                    if ($idTotalRevisi == '2') {
                        $totalQty = $datasales->listSaless[$j]->pivot->totalRevisi;
                    }
                    array_push($dataOnSesi, (object)[
                        'idSalesFill' => $datasales->listSaless[$j]->pivot->id,
                        'sales' => $datasales->listSaless[$j]->sales,
                        'idTotalRev' => $idTotalRevisi,
                        'totalQty' => $totalQty,
                        'namaPengisi' => $userPengisi['Nama Lengkap'],
                    ]);
                }
                // @dd($datasales->listSaless);

                if ($tempIdSesi != $idSesi) {
                    if ($i == 0) {
                        array_push($tempDataArray, $dataOnSesi);
                    } else {
                        array_push($allDataArray, (object)[
                            'idSesi' => $tempIdSesi,
                            'dataSales' => $tempDataArray
                        ]);
                        $tempDataArray = [];
                        array_push($tempDataArray, $dataOnSesi);
                    }
                    $tempIdSesi = $idSesi;
                } else {
                    array_push($tempDataArray, $dataOnSesi);
                }
            }
        }
        array_push($allDataArray, (object)[
            'idSesi' => $tempIdSesi,
            'dataSales' => $tempDataArray
        ]);
        return response()->json($allDataArray);
    }

    public function showAllDataSesi2($idOutlet, $date)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        // @dd($tanggalAll);
        $allsales = null;
        $allDataArray = [];
        $allTotalManual = [];
        $setoranArray = [];
        $salesReimburseArray = [];
        if ($tanggalAll != null) {
            //hitung rincian untuk cash
            $allsales = salesharian::orderBy('idSesi', 'ASC')->where('idOutlet', '=', $idOutlet)->where('idTanggal', '=', $tanggalAll['id'])->get();
            $allTypeSales = typeSales::all();
            // @dd($allTypeSales);
            for ($i = 0; $i < $allsales->count(); $i++) {
                $listSaless = $allsales[$i]->listSaless;
                $arrayListSales = [];
                for ($j = 0; $j < $listSaless->count(); $j++) {
                    $total = $listSaless[$j]->pivot->total;
                    $idRevisiTotal = $listSaless[$j]->pivot->idRevisiTotal;
                    if ($idRevisiTotal == '2') {
                        $total = $listSaless[$j]->pivot->totalRevisi;
                    }
                    array_push($arrayListSales, (object)[
                        'sales' => $listSaless[$j]->sales,
                        'total' => $total,
                        'idRevisiTotal' => $idRevisiTotal
                    ]);
                }
                array_push($allTotalManual, (object)[
                    'sesi' => $allsales[$i]->idSesi,
                    'total' => $allsales[$i]->totalManual,
                    'sales' => $arrayListSales
                ]);
            }
            for ($i = 0; $i < $allTypeSales->count(); $i++) {
                $idType = $allTypeSales[$i]->id;
                $dataOnType = [];
                for ($k = 0; $k < $allsales->count(); $k++) {
                    $datasales = $allsales[$k];
                    for ($j = 0; $j < $datasales->listSaless->count(); $j++) {
                        if ($datasales->listSaless[$j]->typeSales == $idType) {
                            $indexSales = 0;
                            $foundSales = false;
                            $idSales = $datasales->listSaless[$j]->id;
                            $namaSales = $datasales->listSaless[$j]->sales;
                            for ($indexSales = 0; $indexSales < count($dataOnType); $indexSales++) {
                                if ($dataOnType[$indexSales][0] == $idSales) {
                                    $foundSales = true;
                                    break;
                                }
                            }
                            if ($foundSales == false) {
                                array_push($dataOnType, [$idSales, $namaSales, array()]);
                            }
                            // @dd($dataOnType[0][2]);

                            $idTotalRevisi = $datasales->listSaless[$j]->pivot->idRevisiTotal;
                            $totalQty = $datasales->listSaless[$j]->pivot->total;
                            // $userPengisi = dUser::find($datasales->listSaless[$j]->pivot->idPengisi);

                            if ($idTotalRevisi == '2') {
                                $totalQty = $datasales->listSaless[$j]->pivot->totalRevisi;
                            }
                            array_push($dataOnType[$indexSales][2], (object)[
                                'idSalesFill' => $datasales->listSaless[$j]->pivot->id,
                                // 'sales' => $namaSales,
                                'sesi' => $datasales->idSesi,
                                'idTotalRev' => $idTotalRevisi,
                                'totalQty' => $totalQty,
                                // 'namaPengisi' => $userPengisi['Nama Lengkap'],
                            ]);
                        }
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

        if ($tanggalAll != null) {
            //hitung untuk mengkalkulasi setoran dan reimburse sales
            $setoran = $tanggalAll->setorans->where('idOutlet', '=', $idOutlet);
            // @dd($setoran);
            $salesReimburse = $tanggalAll->salesHarianReimburses->where('idOutlet', '=', $idOutlet)->first();
            if ($salesReimburse != null) {
                $salesReimburse = $salesReimburse->sales_reimburses;
                // @dd($salesReimburse);
                $totalReimburse = $salesReimburse->total;
                if ($salesReimburse->idRevisiTotal == '2') {
                    $totalReimburse = $salesReimburse->totalRevisi;
                }
                array_push($salesReimburseArray, (object)[
                    'idRevisi' => $salesReimburse->idRevisiTotal,
                    'total' => $totalReimburse
                ]);
                // @dd($salesHarianReimburse);
            }
            foreach($setoran as $loopSetoran){
                array_push($setoranArray, (object)[
                    'idRevisi' => $loopSetoran->idRevisi,
                    'qtySetor' => $loopSetoran->qtySetor
                ]);
            }
            // @dd($setoranArray);
        }
        return response()->json([
            'dataSales' => $allDataArray,
            'dataTotal' => $allTotalManual,
            'dataSetor' => $setoranArray,
            'dataReimburseSales' => $salesReimburseArray
        ]);
    }

    public function showOnSalesFill($id)
    {
        $salesFill = salesFill::find($id);
        // @dd($salesFill->salesHarians->tanggalAlls);
        // @dd($tanggalAll);
        $datasales = null;
        $allDataArray = [];
        $datasales = $salesFill->salesHarians;

        $total = $salesFill->total;

        if ($salesFill->idRevisiTotal == '2') {
            $total = $salesFill->totalRevisi;
        }
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
                        $idTotalRevisi = $datasales->listSaless[$j]->pivot->idRevisiTotal;
                        $totalQty = $datasales->listSaless[$j]->pivot->total;
                        $userPengisi = dUser::find($datasales->listSaless[$j]->pivot->idPengisi);
                        if ($idTotalRevisi == '2') {
                            $totalQty = $datasales->listSaless[$j]->pivot->totalRevisi;
                        }
                        array_push($dataOnType, (object)[
                            'idSalesFill' => $datasales->listSaless[$j]->pivot->id,
                            'sales' => $datasales->listSaless[$j]->sales,
                            'idTotalRev' => $idTotalRevisi,
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
        return response()->json([
            'sales' => $allDataArray,
            'tanggal' => $salesFill->salesHarians->tanggalAlls->Tanggal,
            'total' => $total,
        ]);
    }

    public function showDateRevision($fromDate, $toDate)
    {
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($fromDate, $toDate))->orderBy('Tanggal', 'DESC')->get();
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
                $idSesi = $datasales[$i]->idSesi;
                for ($j = 0; $j < ($datasales[$i]->listSaless->count()); $j++) {;
                    $idTotalRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiTotal;
                    if (($idTotalRevisi == '2')) {
                        $revisionFound = true;

                        $totalQty = $datasales[$i]->listSaless[$j]->pivot->total;
                        $totalSblm = $totalQty;


                        if ($idTotalRevisi == '2') {
                            $totalQty = $datasales[$i]->listSaless[$j]->pivot->totalRevisi;
                        }

                        $userPengisi = dUser::find($datasales[$i]->listSaless[$j]->pivot->idPengisi);
                        array_push($salesArray, (object)[
                            'idSalesFill' => $datasales[$i]->listSaless[$j]->pivot->id,
                            // 'idListSales' => $datasales[$i]->listSaless[$j]->id,
                            'sales' => $datasales[$i]->listSaless[$j]->sales,
                            'idTotalRev' => $idTotalRevisi,

                            'totalQty' => $totalQty,
                            'totalSblm' => $totalSblm,

                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                            'idSesi' => $idSesi
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

    public function showRevisionOutlet($id)
    {
        // menampilkan revisi berdasarkan idOutlet
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->salesharians);
        $salesDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $datasales = $tanggalAll[$h]->salesharians->where('idOutlet', '=', $id);
            // @dd($datasales[2]);
            $revisionDateFound = false;
            // @dd($datasales[0]->listsaless);
            $salesOutlet = [];
            for ($i = 0; $i < $datasales->count(); $i++) {
                $salesArray = [];
                $revisionFound = false;
                try {
                    for ($j = 0; $j < ($datasales[$i]->listSaless->count()); $j++) {
                        $idTotalRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiTotal;
                        if (($idTotalRevisi == '2')) {
                            $revisionFound = true;
                            $totalQty = 0;

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
                                'idTotalRev' => $idTotalRevisi,
                                'totalQty' => $totalQty,
                                'namaPengisi' => $userPengisi['Nama Lengkap'],
                            ]);
                        }
                    }
                } catch (Exception $e) {
                }
                if ($revisionFound) {
                    $outlet = doutlet::find($datasales[$i]['idOutlet']);
                    array_push($salesOutlet, (object)[
                        // 'Tanggal' => $datasales[$i]['Tanggal'],
                        // 'Outlet' => $outlet['Nama Store'],
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

    public function showAllRequest()
    {
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

    public function showReqOutlet($id)
    {
        //menampilkan revisi berdasarkan idOutlet => $id
        $tanggalAll = tanggalAll::all();
        // @dd($tanggalAll[0]->reqItemSaless[0]);
        $dataAllSales = [];
        for ($i = 0; $i < $tanggalAll->count(); $i++) {
            $dataReq = [];
            $dataFound = false;
            $reqSales = $tanggalAll[$i]->reqItemSaless->where('idOutlet', '=', $id);
            for ($j = 0; $j < $reqSales->count(); $j++) {
                $dataFound = true;
                array_push($dataReq, (object)[
                    'sales' => $reqSales[$j]->listSaless->sales,
                    'namaPengisi' => $reqSales[$j]->dUsers['Nama Lengkap'],
                    'typeSales' => $reqSales[$j]->listSaless->typeSaless->type
                ]);
            }
            if ($dataFound) {
                array_push($dataAllSales, (object)[
                    'Tanggal' => $tanggalAll[$i]->Tanggal,
                    'reqSales' => $dataReq
                ]);
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'reqSales' => $dataAllSales
        ]);
    }

    public function showRevisionDoneOutlet($id)
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        // @dd($tanggalAll[0]->salesharians);
        $salesDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $datasales = $tanggalAll[$h]->salesharians->where('idOutlet', '=', $id);
            // @dd($datasales[0]->listsaless);
            $salesOutlet = [];
            $revisionDateFound = false;
            for ($i = 0; $i < $datasales->count(); $i++) {
                $salesArray = [];
                $revisionFound = false;
                for ($j = 0; $j < ($datasales[$i]->listSaless->count()); $j++) {;
                    $idTotalRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiTotal;
                    if (($idTotalRevisi == '3')) {
                        $revisionFound = true;
                        $totalQty = 0;
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
                            'idTotalRev' => $idTotalRevisi,
                            'totalQty' => $totalQty,
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                            'namaPerevisi' => $userPerevisi['Nama Lengkap']
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

    public function showDateRevisionDone($fromDate, $toDate)
    {
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($fromDate, $toDate))->orderBy('Tanggal', 'DESC')->get();
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
                $idSesi = $datasales[$i]->idSesi;
                for ($j = 0; $j < ($datasales[$i]->listSaless->count()); $j++) {;
                    $idTotalRevisi = $datasales[$i]->listSaless[$j]->pivot->idRevisiTotal;
                    if (($idTotalRevisi == '3')) {
                        $revisionFound = true;
                        $totalQty = 0;
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
                            'idTotalRev' => $idTotalRevisi,
                            'totalQty' => $totalQty,
                            'namaPengisi' => $userPengisi['Nama Lengkap'],
                            'namaPerevisi' => $userPerevisi['Nama Lengkap'],
                            'idSesi' => $idSesi
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
        $idOutlet = $request->idOutlet;
        $idSesi = $request->idSesi;
        $tanggalAll = tanggalAll::where('Tanggal', '=', $request->tanggal)->first();
        $tanggalID = null;
        if ($tanggalAll == null) {
            $tanggalID = tanggalAll::create([
                'Tanggal' => $request->tanggal,
            ])->id;
        } else {
            $tanggalID = $tanggalAll['id'];
        }
        $dataDate = salesharian::where('idTanggal', '=', $tanggalID)->get();
        $dataa = null;
        if ($dataDate->count() == 0) {
            $dataArray = [
                'idTanggal' => $tanggalID,
                'idOutlet' => $idOutlet,
                'idSesi' => $idSesi,
                'totalManual' => $request->totalManual
            ];
            $dataa = salesharian::create($dataArray)->id;
        } else {
            $dataOutlet = $dataDate->where('idOutlet', '=', $idOutlet);
            // @dd($dataOutlet->count());
            if ($dataOutlet->count() == 0) {
                $dataArray = [
                    'idTanggal' => $tanggalID,
                    'idOutlet' => $idOutlet,
                    'idSesi' => $idSesi,
                    'totalManual' => $request->totalManual
                ];
                $dataa = salesharian::create($dataArray)->id;
            } else {
                $dataSesi = $dataOutlet->where('idSesi', '=', $idSesi)->first();
                if ($dataSesi == null) {
                    $dataArray = [
                        'idTanggal' => $tanggalID,
                        'idOutlet' => $idOutlet,
                        'idSesi' => $idSesi,
                        'totalManual' => $request->totalManual
                    ];
                    $dataa = salesharian::create($dataArray)->id;
                } else {
                    $dataSesi->update([
                        'totalManual' => $request->totalManual
                    ]);
                    $dataa = $dataSesi->id;
                }
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

    public function updateVerifOutlet(Request $request, $idSalesFill)
    {
        salesFill::find($idSalesFill)->update([
            'totalDiterima' => $request->totalDiterima
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
