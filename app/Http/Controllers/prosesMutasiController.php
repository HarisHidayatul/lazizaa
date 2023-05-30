<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\listSales;
use App\Models\mutasi_aksi;
use App\Models\mutasi_detail;
use App\Models\mutasi_klasifikasi;
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

    public function createMutasiDetail(Request $request)
    {
        $mutasiDetail = new mutasi_detail();
        $mutasiDetail->idMutasiAksi = $request->idMutasiAksi;
        $mutasiDetail->idMutasiTransaksi = $request->idMutasiTransaksi;
        $mutasiDetail->idMutasiKlasifikasi = $request->idMutasiKlasifikasi;
        $mutasiDetail->idOutlet = $request->idOutlet;
        $mutasiDetail->selisihHari = $request->selisihHari;
        $mutasiDetail->save();
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

        $statusArray = [];

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

                $statusUpload = 0; // 0 untuk data gagal
                $error = '';
                try {
                    $mutasiTransaksi = new mutasi_transaksi();
                    $mutasiTransaksi->idPenerimaList = $idNomorRekening;
                    $mutasiTransaksi->idTanggal = $tanggalID;
                    $mutasiTransaksi->trxNotes = $dataInput[1];
                    $mutasiTransaksi->total = $dataInput[2];
                    $mutasiTransaksi->save();
                    $dataBerhasil = $dataBerhasil + 1;
                    $statusUpload = 1;
                } catch (Exception $e) {
                    $dataGagal = $dataGagal + 1;
                    // array_push($logError, $e->getMessage());
                    // array_push($mutasiGagal, $dataInput[1]);
                    $error = $e->getMessage();
                }
                array_push($statusArray, (object)[
                    'status' => $statusUpload,
                    'error' => $error
                ]);
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
                'statusUpload' => $statusArray
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

        $tanggalAlls = $tanggalAlls->with([
            'mutasiTransaksis.mutasiDetails.mutasiKlasifikasis',
            'salesharians.listSaless',
            'mutasiTransaksis.pelunasanMutasiSaless'
        ])->get();
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
                                $idTotalRevisi = $listSalesHarian->pivot->idRevisiTotal;
                                $totalQtyTemp = $listSalesHarian->pivot->total;
                                if ($idTotalRevisi == '2') {
                                    $totalQtyTemp = $listSalesHarian->pivot->totalRevisi;
                                }
                                $totalQty = $totalQty + $totalQtyTemp;
                                array_push($arrayIdSalesFill, $listSalesHarian->pivot->id);
                                // 
                                if ($totalQty > 0) {
                                    $listFound = true;
                                    break;
                                }
                            }
                        }
                        if ($listFound) {
                            break;
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
            $tanggal = $eachTanggal->Tanggal;
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            if ($mutasiTransaksis->count() > 0) {
                //Hanya ambil di rekening 455 saja
                $mutasiTransaksis = $mutasiTransaksis->where('idPenerimaList', '=', 4);
            }
            foreach ($mutasiTransaksis as $mutasiTransaksi) {
                $mutasiDetail = $mutasiTransaksi->mutasiDetails;
                if ($mutasiDetail != null) {
                    $selisihHari = (-1) * $mutasiDetail->selisihHari;
                    $tanggalBaru = date('Y-m-d', strtotime("$selisihHari days", strtotime($tanggal)));
                    $idListSalesTemp = $mutasiDetail->mutasiKlasifikasis->idListSalesTemp;
                    $idListSalesTemp2 = $mutasiDetail->mutasiKlasifikasis->idListSalesTemp2;
                    $idOutlet = $mutasiDetail->idOutlet;
                    foreach ($arrayDataSales as $eachDataSales) {
                        $tanggalPembanding = $eachDataSales->Tanggal;
                        $listSalesIdPembanding = $eachDataSales->listSalesId;
                        $idOutletPembanding =  $eachDataSales->outletId;

                        if (strtotime($tanggalBaru) == strtotime($tanggalPembanding)) {
                            if (($listSalesIdPembanding == $idListSalesTemp)||($listSalesIdPembanding == $idListSalesTemp2)) {
                                if ($idOutlet == $idOutletPembanding) {
                                    $idSalesFill = $eachDataSales->salesFillId;
                                    try {
                                        $pelunasanMutasiSales = new pelunasan_mutasi_sales();
                                        $pelunasanMutasiSales->idSalesFill = $idSalesFill;
                                        $pelunasanMutasiSales->idMutasiTransaksi = $mutasiTransaksi->id;
                                        $pelunasanMutasiSales->save();
                                    } catch (Exception $e) {
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    function generateMutasiDetail(Request $request)
    {
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $idPenerimaList = $request->idPenerimaList;
        if ($idPenerimaList == 4) {
            //Jika idPenerima mengarah ke rekening 455 maka
            $this->generate455($startDate, $stopDate);
        }
    }

    function generate455($startDate, $stopDate)
    {
        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));
        $tanggalAlls = $tanggalAlls->with(['mutasiTransaksis'])->get();
        $outletAll = doutlet::all();
        $mutasiKlasifikasi = mutasi_klasifikasi::all();
        foreach ($tanggalAlls as $eachTanggal) {
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            foreach ($mutasiTransaksis as $mutasiTransaksi) {
                //Cari berdasarkan nama JUDDI INDRIARI KRI maka masukkan ke pembayaran sukodono h+0
                if (strpos($mutasiTransaksi->trxNotes, 'JUDDI INDRIARI KRI') !== false) {
                    try {
                        $mutasiDetail = new mutasi_detail();
                        $mutasiDetail->idMutasiAksi = 1; //Id mutasi pembayaran 1
                        $mutasiDetail->idMutasiTransaksi = $mutasiTransaksi->id;
                        $mutasiDetail->idMutasiKlasifikasi = 1; //Klasifikasi 1 untuk sukodono
                        $mutasiDetail->idOutlet = 17; //17 untuk outlet sukodono
                        $mutasiDetail->selisihHari = 0;
                        $mutasiDetail->save();
                    } catch (Exception $e) {
                    }
                }

                //Cari id salesFill berdasarkan listsalesId, outletId dan tanggal. Dengan ketentuan tanggal - 1 hari dari mutasi
                $searchMutasi = $this->cariKlasifikasiNotes($mutasiTransaksi->trxNotes, $outletAll);
                print_r($searchMutasi);
                $idOutletSearch = $searchMutasi['idOutlet'];
                $idListSalesSearch = $searchMutasi['idListSales'];
                if ($idOutletSearch == 0) {
                    continue;
                }
                if ($idListSalesSearch == 0) {
                    continue;
                }
                $idMutasiKlasifikasi = $mutasiKlasifikasi->where('idListSalesTemp', '=', $idListSalesSearch)->first()->id;
                try {
                    $mutasiDetail = new mutasi_detail();
                    $mutasiDetail->idMutasiAksi = 4; //Id mutasi transfer kas ke 4
                    $mutasiDetail->idMutasiTransaksi = $mutasiTransaksi->id;
                    $mutasiDetail->idMutasiKlasifikasi = $idMutasiKlasifikasi;
                    $mutasiDetail->idOutlet = $idOutletSearch;
                    $mutasiDetail->selisihHari = 1;
                    $mutasiDetail->save();
                } catch (Exception $e) {
                }
            }
        }
    }

    function cariKlasifikasiNotes($trxNotes, $dOutlet)
    {
        $idOutlet = 0;
        $idListSales = 0;
        $klasifikasi = [];
        $array_klasifikasi = preg_split('/\s+/', $trxNotes);
        print_r($array_klasifikasi);

        //Cari klasifikasi shopeefood
        $shopeeFound = false;
        if (count($array_klasifikasi) > 6) {
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
                    // print_r($array_klasifikasi[5]);
                    $idOutlet = $loopOutlet->id;
                    $idListSales = 6;
                    $klasifikasi['idOutlet'] = $idOutlet;
                    $klasifikasi['idListSales'] = $idListSales;
                    return $klasifikasi;
                }
            }
        }

        //Cari klasifikasi grab
        if (strpos($trxNotes, 'YANTO') !== false) {
            $idOutlet = 2;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, 'MOHAMAD ZAINUDIN') !== false) {
            $idOutlet = 3;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, 'MUHAMMAD NAJIB') !== false) {
            $idOutlet = 4;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, "LAILY SA ADAH, SE") !== false) {
            $idOutlet = 5;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, "YUDHA SETYAWAN IR") !== false) {
            $idOutlet = 7;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, "RAKHMAWATI EKA PUT") !== false) {
            $idOutlet = 8;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, "PRASIDHA WIDIANTO") !== false) {
            $idOutlet = 9;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, "SINGGIH WAHYUTI") !== false) {
            $idOutlet = 10;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, "MUHAMAD FAUJI") !== false) {
            $idOutlet = 11;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, "ANDI AFRADIN") !== false) {
            $idOutlet = 13;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, "DIKO YURIDIKA WIDA") !== false) {
            $idOutlet = 21;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
        }
        if (strpos($trxNotes, "YUDHA SETYAWAN") !== false) {
            $idOutlet = 19;
            $idListSales = 7;
            $klasifikasi['idOutlet'] = $idOutlet;
            $klasifikasi['idListSales'] = $idListSales;
            return $klasifikasi;
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

    public function showMutasi($id)
    {
        $mutasiTransaksi = mutasi_transaksi::find($id);
        $mutasiAksi = mutasi_aksi::all();
        $mutasiKlasifikasi = mutasi_klasifikasi::all();
        $dOutlet = doutlet::all();

        $mutasiAksiArray = [];
        $mutasiKlasifikasiArray = [];
        $outletArray = [];

        foreach ($dOutlet as $loopOutlet) {
            array_push($outletArray, (object)[
                'id' => $loopOutlet->id,
                'outlet' => $loopOutlet['Nama Store']
            ]);
        }

        foreach ($mutasiKlasifikasi as $loopKlasifikasi) {
            array_push($mutasiKlasifikasiArray, (object)[
                'id' => $loopKlasifikasi->id,
                'klasifikasi' => $loopKlasifikasi->klasifikasi
            ]);
        }

        foreach ($mutasiAksi as $loopMutasiAksi) {
            array_push($mutasiAksiArray, (object)[
                'id' => $loopMutasiAksi->id,
                'aksi' => $loopMutasiAksi->aksi
            ]);
        }

        return response()->json([
            'id' => $mutasiTransaksi->id,
            'keterangan' => $mutasiTransaksi->trxNotes,
            'total' => $mutasiTransaksi->total,
            'outlet' => $outletArray,
            'mutasiAksi' => $mutasiAksiArray,
            'mutasiKlasifikasi' => $mutasiKlasifikasiArray
        ]);
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

    public function showMutasiSales(Request $request)
    {
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $idPenerimaList = $request->idPenerimaList;

        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));

        $tanggalAlls = $tanggalAlls->with([
            'mutasiTransaksis.pelunasanMutasiSaless.salesFills.listSaless',
            'mutasiTransaksis.pelunasanMutasiSaless.salesFills.salesHarians.dOutlets',
            'mutasiTransaksis.mutasiDetails.mutasiAksis',
            'mutasiTransaksis.mutasiDetails.mutasiKlasifikasis',
            'mutasiTransaksis.mutasiDetails.doutlets',
        ])->get();
        // @dd($tanggalAlls);
        $dataMutasi = [];

        foreach ($tanggalAlls as $eachTanggal) {
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            if (count($mutasiTransaksis) > 0) {
                $mutasiTransaksis = $mutasiTransaksis->where('idPenerimaList', '=', $idPenerimaList);
                // @dd($mutasiTransaksis);
                foreach ($mutasiTransaksis as $mutasiTransaksi) {
                    $tanggalBaru = date('d/m/Y', strtotime($eachTanggal->Tanggal));
                    $debit = 0;
                    $kredit = 0;
                    $klasifikasi = '';
                    $cabang = '';
                    $aksi = '';
                    $selisihHari = '';
                    $idKlasifikasi = '';

                    $robotStatus = [];
                    $terkaitStatus = [];

                    //Jika action 0, maka user dapat melakukan add
                    //Jika action 1, maka user hanya dapat melakukan delete
                    //Jika action 2, maka user tidak dapat melakukan add maupun delete
                    $action = 0;

                    $mutasiDetail = $mutasiTransaksi->mutasiDetails;
                    if ($mutasiDetail != null) {
                        $idKlasifikasi = $mutasiDetail->mutasiKlasifikasis->id;
                        $klasifikasi = $mutasiDetail->mutasiKlasifikasis->klasifikasi;
                        $aksi = $mutasiDetail->mutasiAksis->aksi;
                        $cabang = $mutasiDetail->doutlets['Nama Store'];
                        $action = 1;
                        $selisihHari = $mutasiDetail->selisihHari;
                    }

                    $pelunasanMutasiSales = $mutasiTransaksi->pelunasanMutasiSaless;
                    if ($pelunasanMutasiSales != null) {
                        array_push($terkaitStatus, 'Pelunasan');

                        $robotMutasi455TfKasStatus = $pelunasanMutasiSales->robotMutasi455TfKasStatus;
                        foreach ($robotMutasi455TfKasStatus as $robotMutasi455kas) {
                            array_push($robotStatus, (object)[
                                'robot' => 'Mutasi 455 Tf Kas',
                                'status' => $robotMutasi455kas->statusRobots->status
                            ]);
                        }

                        $robotMutasi455TfKasPenerimaanStatus = $pelunasanMutasiSales->robotMutasi455TfKasPenerimaanStatus;
                        foreach ($robotMutasi455TfKasPenerimaanStatus as $robotMutasi455kas) {
                            array_push($robotStatus, (object)[
                                'robot' => '455 Sukodono Tf Kas',
                                'status' => $robotMutasi455kas->statusRobots->status
                            ]);
                        }
                    }

                    // 
                    $robotMutasi455Pembayaran = $mutasiTransaksi->robotMutasi455Pembayaran;
                    foreach ($robotMutasi455Pembayaran as $robotMutasi455kas) {
                        array_push($robotStatus, (object)[
                            'robot' => '455 Pembayaran',
                            'status' => $robotMutasi455kas->statusRobots->status
                        ]);
                    }

                    if ($mutasiTransaksi->total < 0) {
                        $kredit = (-1) * $mutasiTransaksi->total;
                    } else {
                        $debit = $mutasiTransaksi->total;
                    }
                    array_push($dataMutasi, (object)[
                        'id' => $mutasiTransaksi->id,
                        'keterangan' => $mutasiTransaksi->trxNotes,
                        'kredit' => $kredit,
                        'debit' => $debit,
                        'tanggalBaru' => $tanggalBaru,
                        'klasifikasi' => $klasifikasi,
                        'idKlasifikasi' => $idKlasifikasi,
                        'cabang' => $cabang,
                        'aksi' => $aksi,
                        'action' => $action,
                        'selisihHari' => $selisihHari,
                        'terkaitStatus' => $terkaitStatus,
                        'robot' => $robotStatus
                    ]);
                }
            } else {
                continue;
            }
        }
        return response()->json([
            'dataMutasi' => $dataMutasi,
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

            if ($idRevisiTotal == '2') {
                $total = $salesFill->totalRevisi;
            }

            $itemSales = $salesFill->listSaless->sales;
            $tanggal = $salesFill->salesHarians->tanggalAlls->Tanggal;
            $tanggalBaru = date('d/m/Y', strtotime($tanggal));
            $outlet = $salesFill->salesHarians->dOutlets['Nama Store'];
            $sesi = $salesFill->salesHarians->idSesi;

            array_push($dataSales, (object)[
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

    public function deleteMutasiDetail(Request $request)
    {
        $mutasiDetails = mutasi_detail::where('idMutasiTransaksi', '=', $request->idMutasiTransaksi)->get();
        foreach ($mutasiDetails as $mutasiDetail) {
            $mutasiDetail->delete();
        }
    }
}
