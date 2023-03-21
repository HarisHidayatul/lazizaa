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

    public function showOnDate($id, $date, $idSesi)
    {
        $dataDate = tanggalAll::where('Tanggal', '=', $date)->first()->fsoHarians
            ->where('idOutlet', '=', $id)
            ->where('idSesi', '=', $idSesi)
            ->first();
        // @dd($dataDate);
        $itemArray = [];
        $pengisi = '';
        if ($dataDate != null) {
            $pengisi = $dataDate->dUsers['Nama Lengkap'];
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
        }
        return response()->json([
            // 'countItem' => $datafso->count(),
            'pengisi' => $pengisi,
            'itemfso' => $itemArray
        ]);
    }

    public function showOnDateLastSesi($id, $date, $idSesi)
    {
        $dataDate = null;
        $dataDateTengahAkhirBulan = null;

        $tengahBulan = false;
        $akhirBulan = false;

        if (date('d', strtotime($date)) == 15) {
            $tengahBulan = true;
        }
        if (date("Y-m-d", strtotime($date)) == date("Y-m-t", strtotime($date))) {
            $akhirBulan = true;
        }
        // @dd($akhirBulan);

        if ($tengahBulan) {
            if ($idSesi == 1) {
                try {
                    $tanggalSebelum = date("Y-m-t", strtotime(date("Y-m-d", strtotime($date)) . " -1 month"));
                    $dataDateTengahAkhirBulan = tanggalAll::where('Tanggal', '=', $tanggalSebelum)->first()->fsoHarians
                        ->where('idOutlet', '=', $id)->sortByDesc('idSesi')->first();
                } catch (Exception $e) {
                    $dataDateTengahAkhirBulan = null;
                }
            }
        }
        if ($akhirBulan) {
            if ($idSesi == 1) {
                try {
                    $tanggalSebelum = date('Y-m-15', strtotime($date));
                    $dataDateTengahAkhirBulan = tanggalAll::where('Tanggal', '=', $tanggalSebelum)->first()->fsoHarians
                        ->where('idOutlet', '=', $id)->sortByDesc('idSesi')->first();
                } catch (Exception $e) {
                    $dataDateTengahAkhirBulan = null;
                }
            }
        }
        // @dd($dataDateTengahAkhirBulan);


        //mengambil data dari hari kemarin jika $idSesi = 1 dan ambil di sesi terakhir mengisi
        if ($idSesi == 1) {
            $dateYesterday = date('Y-m-d', strtotime($date . ' -1 day'));
            try {
                $dataDate = tanggalAll::where('Tanggal', '=', $dateYesterday)->first()->fsoHarians
                    ->where('idOutlet', '=', $id)->sortByDesc('idSesi')->first();
            } catch (Exception $e) {
            }
            // @dd($dataDate);
        } else {
            //Mengambil data dari sesi sebelumnya jika data merupakan hari ini
            try {
                $dataDate = tanggalAll::where('Tanggal', '=', $date)->first()->fsoHarians
                    ->where('idOutlet', '=', $id)->where('idSesi', '=', ($idSesi - 1))->first();
            } catch (Exception $e) {
            }
            // @dd($dataDate);
        }

        $itemArray = [];
        if ($dataDate != null) {
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
        }

        if ($dataDateTengahAkhirBulan != null) {
            for ($j = 0; $j < ($dataDateTengahAkhirBulan->listItemSOs->count()); $j++) {
                $idSoRevisi = $dataDateTengahAkhirBulan->listItemSOs[$j]->pivot->idRevisi;
                if (($dataDateTengahAkhirBulan->listItemSOs[$j]->munculMingguan > 0) && ($dataDateTengahAkhirBulan->listItemSOs[$j]->munculHarian == 0)) {
                    if ($idSoRevisi == '2') {
                        //Jika statusnya revisi
                        array_push($itemArray, (object)[
                            'idItem' => $dataDateTengahAkhirBulan->listItemSOs[$j]->id,
                            'item'   => $dataDateTengahAkhirBulan->listItemSOs[$j]->Item,
                            'satuan' => $dataDateTengahAkhirBulan->listItemSOs[$j]->satuans->Satuan,
                            'icon' => $dataDateTengahAkhirBulan->listItemSOs[$j]->icon,
                            'idRev' => $dataDateTengahAkhirBulan->listItemSOs[$j]->pivot->idRevisi,
                            'qty'    => $dataDateTengahAkhirBulan->listItemSOs[$j]->pivot->quantityRevisi,
                            'idSoFill' => $dataDateTengahAkhirBulan->listItemSOs[$j]->pivot->id
                        ]);
                    } else {
                        //Jika statusnya tidak direvisi maupun sudah direvisi
                        array_push($itemArray, (object)[
                            'idItem' => $dataDateTengahAkhirBulan->listItemSOs[$j]->id,
                            'item'   => $dataDateTengahAkhirBulan->listItemSOs[$j]->Item,
                            'satuan' => $dataDateTengahAkhirBulan->listItemSOs[$j]->satuans->Satuan,
                            'icon' => $dataDateTengahAkhirBulan->listItemSOs[$j]->icon,
                            'idRev' => $dataDateTengahAkhirBulan->listItemSOs[$j]->pivot->idRevisi,
                            'qty'    => $dataDateTengahAkhirBulan->listItemSOs[$j]->pivot->quantity,
                            'idSoFill' => $dataDateTengahAkhirBulan->listItemSOs[$j]->pivot->id
                        ]);
                    }
                }
            }
        }

        return response()->json([
            // 'countItem' => $datafso->count(),
            // 'pengisi' => $dataDate->dUsers['Nama Lengkap'],
            'itemfso' => $itemArray
        ]);
    }

    public function showAllDataSesi($idOutlet, $date)
    {
        $tanggalAll = tanggalAll::where('Tanggal', '=', $date)->first();
        // @dd($tanggalAll);
        $allDataArray = [];
        $tempDataArray = [];
        $dataFound = false;
        $idSesi = 0;
        if ($tanggalAll != null) {
            $fsoharian = fsoharian::orderBy('idSesi', 'DESC')->where('idOutlet', '=', $idOutlet)->where('idTanggal', '=', $tanggalAll['id'])->get();
            // @dd($fsoharian);
            $tempIdSesi = null;
            for ($i = 0; $i < $fsoharian->count(); $i++) {
                $datasoHarian = $fsoharian[$i];
                $idSesi = $datasoHarian->idSesi;
                // if ($i == 0) {
                //     $tempIdSesi = $idSesi;
                // }
                $dataOnSesi = [];

                // @dd($fsoharian[1]->listItemSOs);

                for ($j = 0; $j < $datasoHarian->listItemSOs->count(); $j++) {
                    $idRevisi = $datasoHarian->listItemSOs[$j]->pivot->idRevisi;
                    $quantity = $datasoHarian->listItemSOs[$j]->pivot->quantity;

                    $userPengisi = dUser::find($datasoHarian->idPengisi);
                    if ($idRevisi == '2') {
                        //Jika statusnya revisi pada CU
                        $quantity = $datasoHarian->listItemSOs[$j]->pivot->quantityRevisi;
                    }

                    array_push($dataOnSesi, (object)[
                        'idSoFill' => $datasoHarian->listItemSOs[$j]->pivot->id,
                        'Item' => $datasoHarian->listItemSOs[$j]->Item,
                        'idRevisi' => $idRevisi,
                        'quantity' => $quantity,
                        'namaPengisi' => $userPengisi['Nama Lengkap'],
                        'satuan' => $datasoHarian->listItemSOs[$j]->satuans->Satuan
                    ]);
                }
                // @dd($datasoHarian->listItemSOs);

                if ($tempIdSesi != $idSesi) {
                    if ($i == 0) {
                        array_push($tempDataArray, $dataOnSesi);
                    } else {
                        array_push($allDataArray, (object)[
                            'idSesi' => $tempIdSesi,
                            'dataSoHarian' => $tempDataArray
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
            'dataSoHarian' => $tempDataArray
        ]);
        return response()->json($allDataArray);
    }

    public function showAndCreateID(Request $request)
    {
        $idOutlet = $request->idOutlet;
        $idSesi = $request->idSesi;
        $idPengisi = $request->idPengisi;
        $tanggalAll = tanggalAll::where('Tanggal', '=', $request->tanggal)->first();
        $tanggalID = null;
        if ($tanggalAll == null) {
            $tanggalID = tanggalAll::create([
                'Tanggal' => $request->tanggal,
            ])->id;
        } else {
            $tanggalID = $tanggalAll['id'];
        }
        $dataDate = fsoHarian::where('idTanggal', '=', $tanggalID)->get();
        $dataa = null;
        if ($dataDate->count() == 0) {
            $dataArray = [
                'idTanggal' => $tanggalID,
                'idOutlet' => $idOutlet,
                'idSesi' => $idSesi,
                'idPengisi' => $idPengisi
            ];
            $dataa = fsoHarian::create($dataArray)->id;
        } else {
            $dataOutlet = $dataDate->where('idOutlet', '=', $idOutlet);
            // @dd($dataOutlet->count());
            if ($dataOutlet->count() == 0) {
                $dataArray = [
                    'idTanggal' => $tanggalID,
                    'idOutlet' => $idOutlet,
                    'idSesi' => $idSesi,
                    'idPengisi' => $idPengisi
                ];
                $dataa = fsoHarian::create($dataArray)->id;
            } else {
                $dataSesi = $dataOutlet->where('idSesi', '=', $idSesi)->first();
                if ($dataSesi == null) {
                    $dataArray = [
                        'idTanggal' => $tanggalID,
                        'idOutlet' => $idOutlet,
                        'idSesi' => $idSesi,
                        'idPengisi' => $idPengisi
                    ];
                    $dataa = fsoHarian::create($dataArray)->id;
                } else {
                    $dataa = $dataSesi->id;
                }
            }
        }
        echo $dataa;
    }

    public function showDateRevision($fromDate, $toDate)
    {
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($fromDate, $toDate))->orderBy('Tanggal', 'DESC')->get();
        $soDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $dataso = $tanggalAll[$h]->fsoharians;
            $revisionDateFound = false;
            $soOutlet = [];
            for ($i = 0; $i < $dataso->count(); $i++) {
                $soArray = [];
                $revisionFound = false;
                $idSesi = $dataso[$i]->idSesi;
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
                            'qtyAwal' => $dataso[$i]->listItemSOs[$j]->pivot->quantity,
                            'namaPengisi' => $userPengisi['Username'],
                            'idSesi' => $idSesi
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

    public function showDateRevisionDone($fromDate, $toDate)
    {
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($fromDate, $toDate))->orderBy('Tanggal', 'DESC')->get();
        $soDate = [];
        for ($h = 0; $h < $tanggalAll->count(); $h++) {
            $dataso = $tanggalAll[$h]->fsoharians;
            $revisionDateFound = false;
            $soOutlet = [];
            for ($i = 0; $i < $dataso->count(); $i++) {
                $soArray = [];
                $revisionFound = false;
                $idSesi = $dataso[$i]->idSesi;
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
                            'idSesi' => $idSesi,
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
                for ($i = 0; $i < $listItemSO->count(); $i++) {
                    $limSoHarian = $soHarianBatas->where('idItemSo', '=', $listItemSO[$i]->id)->first()->quantity;
                    $valSoHarian = $listItemSO[$i]->pivot->quantity;
                    if ($listItemSO[$i]->pivot->idRevisi == '2') {
                        $valSoHarian = $listItemSO[$i]->pivot->quantityRevisi;
                    }
                    if ($valSoHarian < $limSoHarian) {
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

    public function showHistory(Request $request)
    {
        $idOutlet = $request->idOutlet;
        $countData = $request->countData;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $accessRole = $request->accessRole;

        $now = Carbon::now();
        $outletArray = [];
        $allData = [];

        $dataItemSo = [];
        $allItemSo = listItemSO::all();
        foreach($allItemSo as $eachItemSO){
            array_push($dataItemSo,(object)[
                'id' => $eachItemSO->id,
                'Item' => $eachItemSO->Item,
                'Satuan' => $eachItemSO->satuans->Satuan
            ]);
        }

        if ($idOutlet == 0) {
            $tempOutlet = doutlet::all();
            for ($i = 0; $i < $tempOutlet->count(); $i++) {
                array_push($outletArray, $tempOutlet[$i]->id);
            }
        } else {
            array_push($outletArray, $idOutlet);
        }
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'ASC')->with(['fsoharians.listItemSOs.satuans'])->get();

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

        // @dd($allDate[2]->fsoharians);

        for ($indexOutletLoop = 0; $indexOutletLoop < count($outletArray); $indexOutletLoop++) {
            $dataFound = false;

            $allHistory = [];
            $namaOutlet = doutlet::find($outletArray[$indexOutletLoop])['Nama Store'];
            foreach ($allDate as $loopTanggal) {
                $allDataSesi = [];
                $soHarianAll = $loopTanggal->fsoharians->where('idOutlet', '=', $outletArray[$indexOutletLoop]);

                $tengahBulan = false;
                $akhirBulan = false;

                if (date('d', strtotime($loopTanggal->Tanggal)) == 15) {
                    $tengahBulan = true;
                }
                if (date("Y-m-d", strtotime($loopTanggal->Tanggal)) == date("Y-m-t", strtotime($loopTanggal->Tanggal))) {
                    $akhirBulan = true;
                }

                if ($accessRole == 'accounting') {
                    if(!$tengahBulan){
                        if(!$akhirBulan){
                            continue;
                        }
                    }
                }

                $loopSesi = 0;
                foreach ($soHarianAll as $soHarian) {
                    $dataSoHarian = [];
                    if($loopSesi > 0){
                        continue;
                    }
                    foreach ($soHarian->listItemSOs as $itemSo) {
                        $quantity = $itemSo->pivot->quantity;
                        if ($itemSo->pivot->idRevisi == 2) {
                            $quantity = $itemSo->pivot->quantityRevisi;
                        }
                        array_push($dataSoHarian, (object)[
                            'idItem' => $itemSo->id,
                            'Item' => $itemSo->Item,
                            'Satuan' => $itemSo->satuans->Satuan,
                            'quantity' => $quantity,
                            'idRevisi' => $itemSo->pivot->idRevisi
                        ]);
                        $dataFound = true;
                    }
                    array_push($allDataSesi, (object)[
                        'idSesi' => $soHarian->idSesi,
                        'dataSo' => $dataSoHarian
                    ]);
                    $loopSesi++;
                }
                array_push($allHistory, (object)[
                    'Tanggal' => $loopTanggal->Tanggal,
                    'dataSo' => $allDataSesi
                ]);
            }
            // $allHistory = array_reverse($allHistory, false);

            if($dataFound){
                array_push($allData, (object)[
                    'dataHistory' => $allHistory,
                    'outlet' => $namaOutlet
                ]);
            }
        }
        // @dd($allData);
        return response()->json([
            'allData' => $allData,
            'dataItemSO'=> $dataItemSo
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

    public function editSoFill(Request $request)
    {
        // $request->dataEdit memiliki struktur data [idSoFill,Edit]
        // @dd($request->dataEdit);
        $arrayEdit = $request->dataEdit;
        if($arrayEdit != null){
            for($i =0;$i<count($arrayEdit);$i++){
                soFill::find($arrayEdit[$i][0])->update([
                    'quantityRevisi' => $arrayEdit[$i][1],
                    'idRevisi'      => '2'
                ]);
            }
        }
        echo 'berhasil';
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
