<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\listSales;
use App\Models\mutasi_sales;
use App\Models\mutasi_transaksi;
use App\Models\pelunasan_mutasi_sales;
use App\Models\penerimaList;
use App\Models\salesFill;
use App\Models\tanggalAll;
use Exception;
use Illuminate\Http\Request;

class prosesMutasiController extends Controller
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

    public function createMutasi(Request $request)
    {
        $data = json_decode($request->input('data'), true); // ambil data dari POST request
        // print_r($data);
        // olah data disini
        $tahun = $data['tahun'];
        $nomorRekening = $data['nomorRekening'];
        $allDataInput = $data['data'];
        $idNomorRekening = 0;

        $dataBerhasil = 0;
        $dataGagal = 0;

        $tanggalBefore = '';
        $firstTangalFound = false;
        $tanggalID = 0;

        $mutasiGagal = [];
        $logError = [];
        //Cari id nomor rekening
        try {
            $idNomorRekening = penerimaList::where('nomorRekening', '=', $nomorRekening)->first()->id;
        } catch (Exception $e) {
        }

        if ($idNomorRekening > 0) {
            foreach ($allDataInput as $dataInput) {
                //Convert data ke tanggal sql
                $tanggal = $dataInput[0];
                $tanggal_array = explode("/", $tanggal);
                $bulan = str_pad($tanggal_array[1], 2, "0", STR_PAD_LEFT);
                $tanggal_sql = date("Y-m-d", strtotime("$tahun-$bulan-$tanggal_array[0]"));

                if (!$firstTangalFound) {
                    $firstTangalFound = true;
                    $tanggalBefore = $tanggal_sql;
                    $tanggalAll = tanggalAll::where('Tanggal', '=', $tanggal_sql)->first();
                    if ($tanggalAll == null) {
                        $tanggalID = tanggalAll::create([
                            'Tanggal' => $request->tanggal,
                        ])->id;
                    } else {
                        $tanggalID = $tanggalAll['id'];
                    }
                } else {
                    $timeStampCompare1 = strtotime($tanggal_sql);
                    $timeStampCompare2 = strtotime($tanggalBefore);
                    if ($timeStampCompare1 != $timeStampCompare2) {
                        $tanggalAll = tanggalAll::where('Tanggal', '=', $tanggal_sql)->first();
                        if ($tanggalAll == null) {
                            $tanggalID = tanggalAll::create([
                                'Tanggal' => $request->tanggal,
                            ])->id;
                        } else {
                            $tanggalID = $tanggalAll['id'];
                        }
                    }
                }
                try {
                    $mutasiTransaksi = new mutasi_transaksi();
                    $mutasiTransaksi->idPenerimaList = $idNomorRekening;
                    $mutasiTransaksi->idTanggal = $tanggalID;
                    $mutasiTransaksi->trxNotes = $dataInput[1];
                    $mutasiTransaksi->total = $dataInput[2];
                    $mutasiTransaksi->save();
                    $dataBerhasil = $dataBerhasil + 1;
                } catch (Exception $e) {
                    $dataGagal = $dataGagal + 1;
                    array_push($logError, $e->getMessage());
                    array_push($mutasiGagal, $dataInput[1]);
                }
            }
            // ($allDataInput);
        }

        // print_r($data);
        return response()->json(
            [
                'success' => true,
                'message' => 'Data berhasil diposting!',
                'dataBerhasil' => $dataBerhasil,
                'dataGagal' => $dataGagal,
                'logError' => $logError,
                'dataError' => $mutasiGagal
            ]
        );
    }

    public function createPelunasanMutasiSales(Request $request)
    {
        $data = json_decode($request->input('data'), true); // ambil data dari POST request
        $idSalesFill = $data['idSalesFill'][0];
        $idMutasiTransaksis = $data['idSendMutasi'];
        $logError = [];
        if ($idSalesFill != null) {
            foreach ($idMutasiTransaksis as $idMutasiTransaksi) {
                try {
                    $pelunasanMutasiSales = new pelunasan_mutasi_sales();
                    $pelunasanMutasiSales->idSalesFill = $idSalesFill;
                    $pelunasanMutasiSales->idMutasiTransaksi = $idMutasiTransaksi;
                    $pelunasanMutasiSales->save();
                } catch (Exception $e) {
                    array_push($logError, $e->getMessage());
                }
            }
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Data berhasil diposting!',
                'logError' => $logError,
            ]
        );
    }

    public function generateMutasiPelunasan(Request $request)
    {
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;

        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));

        $tanggalAlls = $tanggalAlls->with(['mutasiTransaksis.mutasiSaless.listSaless', 'salesharians.listSaless'])->get();
        // tanggalAll;
        $listSaless = listSales::all();
        $outletAll = doutlet::all();

        $arrayDataSales = [];

        foreach ($tanggalAlls as $eachTanggal) {
            foreach ($outletAll as $eachOutlet) {
                $salesHarians = $eachTanggal->salesharians->where('idOutlet', '=', $eachOutlet->id);
                foreach ($listSaless as $listSales) {
                    $listFound = false;
                    $arrayIdSalesFill = [];
                    $totalQty = 0;
                    foreach ($salesHarians as $salesHarian) {
                        $listSalesHarians = $salesHarian->listSaless;
                        foreach ($listSalesHarians as $listSalesHarian) {
                            if ($listSalesHarian->id == $listSales->id) {
                                $listFound = true;
                                $idTotalRevisi = $listSalesHarian->pivot->idRevisiTotal;
                                $totalQtyTemp = $listSalesHarian->pivot->total;
                                if ($idTotalRevisi == '2') {
                                    $totalQtyTemp = $listSalesHarian->pivot->totalRevisi;
                                }
                                $totalQty = $totalQty + $totalQtyTemp;
                                array_push($arrayIdSalesFill, $listSalesHarian->pivot->id);
                            }
                        }
                    }
                    if ($listFound) {
                        if ($totalQty > 0) {
                            $idSalesFill = $arrayIdSalesFill[0];
                            array_push($arrayDataSales, (object)[
                                'Tanggal' => $eachTanggal->Tanggal,
                                'salesFillId' => $idSalesFill,
                                'listSalesId' => $listSales->id,
                                'outletId' => $eachOutlet->id
                            ]);
                        }
                    }
                }
            }
        }

        // print_r($arrayDataSales);

        foreach ($tanggalAlls as $eachTanggal) {
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            foreach ($mutasiTransaksis as $mutasiTransaksi) {
                $mutasiSales = $mutasiTransaksi->mutasiSaless;
                if($mutasiSales != null){
                    $idOutletMutasi = $mutasiSales->idOutlet;
                    //Cari id salesFill berdasarkan listsalesId, outletId dan tanggal. Dengan ketentuan tanggal - 1 hari dari mutasi
                    $tanggal = $eachTanggal->Tanggal;
                    $tanggal_baru = date('Y-m-d', strtotime($tanggal . ' -1 day'));
                    foreach ($arrayDataSales as $eachDataSales) {
                        print_r($eachDataSales);
                        $tanggalPembanding = $eachDataSales->Tanggal;
                        $outletIdPembanding = $eachDataSales->outletId;
                        $listSalesIdPembanding = $eachDataSales->listSalesId;
                        if (strtotime($tanggal_baru) == strtotime($tanggalPembanding)) {
                            if($outletIdPembanding == $idOutletMutasi){
                                if($listSalesIdPembanding == $mutasiSales->idListSales){
                                    $idSalesFill = $eachDataSales->salesFillId;
                                    try{
                                        $pelunasanMutasiSales = new pelunasan_mutasi_sales();
                                        $pelunasanMutasiSales->idSalesFill = $idSalesFill;
                                        $pelunasanMutasiSales->idMutasiTransaksi = $mutasiTransaksi->id;
                                        $pelunasanMutasiSales->save();
                                    }catch(Exception $e){
    
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function generateMutasiPenjualan(Request $request)
    {
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $idPenerimaList = $request->idPenerimaList;

        $outletAlls = doutlet::all();
        $listSalesAlls = listSales::all();

        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));

        $tanggalAlls = $tanggalAlls->with(['mutasiTransaksis.penerimaLists', 'mutasiTransaksis.mutasiSaless.listSaless'])->get();
        // tanggalAll;
        foreach ($tanggalAlls as $eachTanggal) {
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            if (count($mutasiTransaksis) > 0) {
                $mutasiTransaksis = $mutasiTransaksis->where('idPenerimaList', '=', $idPenerimaList);
                if (count($mutasiTransaksis) > 0) {
                    foreach ($mutasiTransaksis as $mutasiTransaksi) {
                        $mutasiSales = $mutasiTransaksi->mutasiSaless;
                        $mutasiNote = $mutasiTransaksi->trxNotes;
                        $searchMutasi = $this->cariKlasifikasiNotes($mutasiNote, $outletAlls);
                        $idOutletSearch = $searchMutasi['idOutlet'];
                        $idListSalesSearch = $searchMutasi['idListSales'];
                        if ($idOutletSearch == 0) {
                            continue;
                        }
                        if ($idListSalesSearch == 0) {
                            continue;
                        }
                        if ($mutasiSales == null) {
                            $mutasiSales = new mutasi_sales();
                        }
                        $mutasiSales->idMutasiTransaksi = $mutasiTransaksi->id;
                        $mutasiSales->idOutlet = $idOutletSearch;
                        $mutasiSales->idListSales = $idListSalesSearch;
                        $mutasiSales->save();
                    }
                }
            }
        }
    }

    function cariKlasifikasiNotes($trxNotes, $dOutlet)
    {
        $idOutlet = 0;
        $idListSales = 0;
        $klasifikasi = [];
        $array_klasifikasi = explode(" ", $trxNotes);

        //Cari klasifikasi shopeefood
        $shopeeFound = false;
        if (strcmp($array_klasifikasi[5], 'SF') == 0) {
            //ID Shopeefood = 8
            $idListSales = 8;
            $shopeeFound = true;
        }
        if (strcmp($array_klasifikasi[5], 'MC') == 0) {
            //ID Shopeepay = 9
            $idListSales = 9;
            $shopeeFound = true;
        }
        if ($shopeeFound) {
            foreach ($dOutlet as $loopOutlet) {
                if (intval($loopOutlet->kodeShopee) == intval($array_klasifikasi[7])) {
                    $idOutlet = $loopOutlet->id;
                    $klasifikasi['idOutlet'] = $idOutlet;
                    $klasifikasi['idListSales'] = $idListSales;
                    return $klasifikasi;
                }
            }
        }

        foreach ($dOutlet as $loopOutlet) {
            //Cari klasifikasi gojek
            //Kode gofood 3 untuk id list sales
            if (strcmp($array_klasifikasi[5], $loopOutlet->kodeGoresto) == 0) {
                $idOutlet = $loopOutlet->id;
                $idListSales = 6;
                $klasifikasi['idOutlet'] = $idOutlet;
                $klasifikasi['idListSales'] = $idListSales;
                return $klasifikasi;
            }
        }

        $klasifikasi['idOutlet'] = $idOutlet;
        $klasifikasi['idListSales'] = $idListSales;
        return $klasifikasi;
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

    public function showMutasiAll(Request $request)
    {
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $idPenerimaList = $request->idPenerimaList;

        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));

        $tanggalAlls = $tanggalAlls->with(['mutasiTransaksis.penerimaLists'])->get();
        // tanggalAll;
        $dataMutasi = [];
        $outletAll = [];
        foreach ($tanggalAlls as $eachTanggal) {
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            if (count($mutasiTransaksis) > 0) {
                $mutasiTransaksis = $mutasiTransaksis->where('idPenerimaList', '=', $idPenerimaList);
                if (count($mutasiTransaksis) > 0) {
                    foreach ($mutasiTransaksis as $mutasiTransaksi) {
                        $tanggalBaru = date('d/m/Y', strtotime($eachTanggal->Tanggal));
                        array_push($dataMutasi, (object)[
                            'id' => $mutasiTransaksi->id,
                            'trxNotes' => $mutasiTransaksi->trxNotes,
                            'total' => $mutasiTransaksi->total,
                            'tanggal' => $eachTanggal->Tanggal,
                            'tanggalBaru' => $tanggalBaru
                        ]);
                    }
                } else {
                    continue;
                }
            } else {
                continue;
            }
        }
        return response()->json([
            'dataMutasi' => $dataMutasi,
        ]);
    }

    public function showMutasiPenjualan(Request $request)
    {
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $idPenerimaList = $request->idPenerimaList;

        $outletAlls = doutlet::all()->sortBy('Nama Store');
        $listSalesAlls = listSales::all();

        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));

        $tanggalAlls = $tanggalAlls->with(['mutasiTransaksis.penerimaLists', 'mutasiTransaksis.mutasiSaless.listSaless'])->get();
        // tanggalAll;
        $dataMutasi = [];
        $outletAll = [];
        $listSalesAll = [];
        foreach ($tanggalAlls as $eachTanggal) {
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            if (count($mutasiTransaksis) > 0) {
                $mutasiTransaksis = $mutasiTransaksis->where('idPenerimaList', '=', $idPenerimaList);
                if (count($mutasiTransaksis) > 0) {
                    foreach ($mutasiTransaksis as $mutasiTransaksi) {
                        $tanggalBaru = date('d/m/Y', strtotime($eachTanggal->Tanggal));
                        $idListSales = 0;
                        $idOutlet = 0;
                        $idMutasiSales = 0;
                        $mutasiSales = $mutasiTransaksi->mutasiSaless;
                        if ($mutasiSales != null) {
                            // @dd($mutasiSales);
                            $idListSales = $mutasiSales->idListSales;
                            $idOutlet = $mutasiSales->idOutlet;
                            $idMutasiSales = $mutasiSales->id;
                        }
                        array_push($dataMutasi, (object)[
                            'id' => $mutasiTransaksi->id,
                            'trxNotes' => $mutasiTransaksi->trxNotes,
                            'total' => $mutasiTransaksi->total,
                            'tanggal' => $eachTanggal->Tanggal,
                            'tanggalBaru' => $tanggalBaru,
                            'idMutasiSales' => $idMutasiSales,
                            'idListSales' => $idListSales,
                            'idOutlet' => $idOutlet
                        ]);
                    }
                } else {
                    continue;
                }
            } else {
                continue;
            }
        }
        foreach ($outletAlls as $eachOutlet) {
            array_push($outletAll, (object)[
                'id' => $eachOutlet->id,
                'outlet' => $eachOutlet['Nama Store']
            ]);
        }
        foreach ($listSalesAlls as $eachListSales) {
            array_push($listSalesAll, (object)[
                'id' => $eachListSales->id,
                'listSales' => $eachListSales->sales
            ]);
        }
        return response()->json([
            'dataMutasi' => $dataMutasi,
            'outlet' => $outletAll,
            'listSales' => $listSalesAll
        ]);
    }

    public function showPelunasanMutasiSales(Request $request)
    {
        $idSalesFills = json_decode($request->input('idSalesFill'), true); //idSalesFill disini dalam berbentu array
        // @dd($idSalesFills);
        $dataMutasi = [];
        $dataSales = [];
        foreach ($idSalesFills as $idSalesFill) {
            $pelunasanMutasiSaless = pelunasan_mutasi_sales::where('idSalesFill', '=', $idSalesFill)->get();
            foreach ($pelunasanMutasiSaless as $pelunasanMutasiSales) {
                $mutasiTransaksi = $pelunasanMutasiSales->mutasiTransaksis;
                $tanggal = $mutasiTransaksi->tanggalAlls->Tanggal;
                $tanggalBaru = date('d/m/Y', strtotime($tanggal));
                array_push($dataMutasi, (object)[
                    'id' => $mutasiTransaksi->id,
                    'idPelunasanMutasiSales' => $pelunasanMutasiSales->id,
                    'trxNotes' => $mutasiTransaksi->trxNotes,
                    'total' => $mutasiTransaksi->total,
                    'tanggalBaru' => $tanggalBaru
                ]);
            }

            $salesFill = salesFill::find($idSalesFill);
            $total = $salesFill->total;
            $idRevisiTotal = $salesFill->idRevisiTotal;

            if($idRevisiTotal == '2'){
                $total = $salesFill->totalRevisi;
            }

            $itemSales = $salesFill->listSaless->sales;
            $tanggal = $salesFill->salesHarians->tanggalAlls->Tanggal;
            $tanggalBaru = date('d/m/Y', strtotime($tanggal));
            $outlet = $salesFill->salesHarians->dOutlets['Nama Store'];
            $sesi = $salesFill->salesHarians->idSesi;

            array_push($dataSales,(object)[
                'sesi' => $sesi,
                'itemSales' => $itemSales,
                'Tanggal' => $tanggal,
                'TanggalBaru' => $tanggalBaru,
                'outlet' => $outlet,
                'total' => $total,
                'idRevisiTotal' => $idRevisiTotal
            ]);
        }
        return response()->json([
            'dataMutasi' => $dataMutasi,
            'dataSales' => $dataSales
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

    public function editMutasiPenjualan(Request $request)
    {
        $idListSales = $request->idListSales;
        $idOutlet = $request->idOutlet;
        $idMutasi = $request->idMutasi;
        $idMutasiSales = $request->idMutasiSales;

        if (($idListSales == 0) && ($idOutlet == 0)) {
            if ($idMutasiSales > 0) {
                $mutasiSales = mutasi_sales::find($idMutasiSales);
                $mutasiSales->delete();
            }
        }

        if (($idListSales > 0) && ($idOutlet > 0)) {
            if ($idMutasiSales == 0) {
                try {
                    $mutasiSales = new mutasi_sales();
                    $mutasiSales->idMutasiTransaksi = $idMutasi;
                    $mutasiSales->idOutlet = $idOutlet;
                    $mutasiSales->idListSales = $idListSales;
                    $mutasiSales->save();
                } catch (Exception $e) {
                    $mutasiSales = mutasi_sales::onlyTrashed()->where('idMutasiTransaksi', '=', $idMutasi)->restore();
                    $mutasiSales = mutasi_sales::where('idMutasiTransaksi', '=', $idMutasi)->first();
                    $mutasiSales->idMutasiTransaksi = $idMutasi;
                    $mutasiSales->idOutlet = $idOutlet;
                    $mutasiSales->idListSales = $idListSales;
                    $mutasiSales->save();
                }
            }
        }
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

    public function delMutasiFromSales(Request $request)
    {
        $logError = [];
        $idPelunasanMutasiSales = $request->idPelunasanMutasiSales;
        try {
            $pelunasanMutasiSales = pelunasan_mutasi_sales::find($idPelunasanMutasiSales);
            $pelunasanMutasiSales->delete();
        } catch (Exception $e) {
            array_push($logError, $e->getMessage());
        }
        return response()->json(
            [
                'success' => true,
                'message' => 'Data berhasil diposting!',
                'logError' => $logError,
            ]
        );
    }
}
