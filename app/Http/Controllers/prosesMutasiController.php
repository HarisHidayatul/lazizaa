<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\listSales;
use App\Models\mutasi_sales;
use App\Models\mutasi_transaksi;
use App\Models\penerimaList;
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
}
