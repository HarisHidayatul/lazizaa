<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\listItemPattyCash;
use App\Models\listSales;
use App\Models\mutasi_aksi;
use App\Models\mutasi_detail;
use App\Models\mutasi_klasifikasi;
use App\Models\mutasi_reimburse;
use App\Models\mutasi_sales;
use App\Models\mutasi_setoran;
use App\Models\mutasi_transaksi;
use App\Models\mutasi_pembayaran;
use App\Models\pelunasan_mutasi_sales;
use App\Models\penerimaList;
use App\Models\penerimaReimburse;
use App\Models\salesFill;
use App\Models\setoran;
use App\Models\tanggalAll;
use Exception;
use Illuminate\Http\Request;

class prosesMutasiController extends Controller
{
    public function getSimilarityPercentage($str1, $str2)
    {
        $similarity = 0.0;
        similar_text($str1, $str2, $similarity);
        return $similarity;
    }

    public function findNameInText($name, $text)
    {
        $words = explode(' ', $text);
        $maxSimilarity = 0.0;
        foreach ($words as $word) {
            $similarity = $this->getSimilarityPercentage($name, $word);
            if ($similarity > $maxSimilarity) {
                $maxSimilarity = $similarity;
            }
        }
        return $maxSimilarity;
    }
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

        if($request->idMutasiKlasifikasi == 13){
            //Jika klasifikasi pilih lain-lain, inputkan juga di mutasi  pembayaran
            $idPattyCash = $request->idPattyCash;
            try{
                $mutasiPembayaran = new mutasi_pembayaran();
                $mutasiPembayaran->idPattyCash = $idPattyCash;
                $mutasiPembayaran->idMutasiDetail = $mutasiDetail->id;
                $mutasiPembayaran->save();
            }catch(Exception $e){
            }
        }
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
                            'Tanggal' => $tanggal_sql,
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
                                'Tanggal' => $tanggal_sql,
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

    public function generateMutasiReimburse(Request $request)
    {
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;

        $reimburseArray = [];

        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));

        $tanggalAlls = $tanggalAlls->with([
            'mutasiTransaksis.mutasiDetails',
            'reimburses.penerimaReimburses'
        ])->get();

        foreach ($tanggalAlls as $loopTanggal) {
            $reimburses = $loopTanggal->reimburses;
            foreach ($reimburses as $loopReimburse) {
                $penerimaReimburse = $loopReimburse->penerimaReimburses;
                foreach ($penerimaReimburse as $loopPenerimaReimburse) {
                    array_push($reimburseArray, (object)[
                        'idPenerimaReimburse' => $loopPenerimaReimburse->id,
                        'total' => $loopPenerimaReimburse->qty,
                        'idOutlet' => $loopReimburse->idOutlet,
                        'Tanggal' => $loopTanggal->Tanggal
                    ]);
                }
            }
        }

        // print_r($reimburseArray);

        foreach ($tanggalAlls as $loopTanggal) {
            $mutasiTransaksis = $loopTanggal->mutasiTransaksis;
            if ($mutasiTransaksis->count() > 0) {
                $mutasiTransaksis = $mutasiTransaksis->where('idPenerimaList', '=', '1');
            }
            foreach ($mutasiTransaksis as $loopMutasiTransaksi) {
                $mutasiDetail = $loopMutasiTransaksi->mutasiDetails;
                if ($mutasiDetail != null) {
                    $idMutasiAksi = $mutasiDetail->idMutasiAksi;
                    $idMutasiKlasifikasi = $mutasiDetail->idMutasiKlasifikasi;
                    if ($idMutasiKlasifikasi != 10) {
                        continue;
                    }
                    $idOutlet = $mutasiDetail->idOutlet;
                    $selisihHari = (-1) * $mutasiDetail->selisihHari;
                    $tanggalBaru = date('Y-m-d', strtotime("$selisihHari days", strtotime($loopTanggal->Tanggal)));
                    $totalMutasi = ($loopMutasiTransaksi->total) / 1000;
                    foreach ($reimburseArray as $loopReimburse) {
                        $tanggalPembanding = $loopReimburse->Tanggal;
                        $idOutletPembanding =  $loopReimburse->idOutlet;
                        $totalPembanding = ($loopReimburse->total) / 1000;
                        $totalPembanding = $totalPembanding * (-1);
                        if (strtotime($tanggalBaru) == strtotime($tanggalPembanding)) {
                            if ($idOutlet == $idOutletPembanding) {
                                if (floor($totalMutasi) == floor($totalPembanding)) {
                                    print_r($loopReimburse);
                                    try {
                                        $mutasiReimburse = new mutasi_reimburse();
                                        $mutasiReimburse->idMutasiTransaksi = $loopMutasiTransaksi->id;
                                        $mutasiReimburse->idPenerimaReimburse = $loopReimburse->idPenerimaReimburse;
                                        $mutasiReimburse->save();
                                    } catch (Exception $e) {
                                    }
                                    $penerimaReimburse = penerimaReimburse::find($loopReimburse->idPenerimaReimburse);
                                    $penerimaReimburse->idRevisi = '3';
                                    $penerimaReimburse->save();
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    public function generateMutasiSetoran(Request $request)
    {
        //Pemilihan /1000 agar sesuai batas toleransinya dengan kode outlet
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));

        $tanggalAlls = $tanggalAlls->with([
            'mutasiTransaksis.mutasiDetails.mutasiKlasifikasis',
            'mutasiTransaksis.mutasiSetorans',
            'setorans'
        ])->get();

        $arrayDataSetoran = [];

        foreach ($tanggalAlls as $loopTanggal) {
            $setorans = $loopTanggal->setorans;
            foreach ($setorans as $loopSetoran) {
                array_push($arrayDataSetoran, (object)[
                    'id' => $loopSetoran->id,
                    'Tanggal' => $loopTanggal->Tanggal,
                    'idOutlet' => $loopSetoran->idOutlet,
                    'total' => ($loopSetoran->qtySetor) / 1000
                ]);
            }
        }
        foreach ($tanggalAlls as $eachTanggal) {
            $tanggal = $eachTanggal->Tanggal;
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            // if ($mutasiTransaksis->count() > 0) {
            //     //Hanya ambil di rekening 1003 saja
            //     $mutasiTransaksis = $mutasiTransaksis->where('idPenerimaList', '=', 2);
            // }
            foreach ($mutasiTransaksis as $mutasiTransaksi) {
                $mutasiDetail = $mutasiTransaksi->mutasiDetails;
                if ($mutasiDetail != null) {
                    $idMutasiKlasifikasi = $mutasiDetail->idMutasiKlasifikasi;
                    if ($idMutasiKlasifikasi != 9) {
                        continue;
                    }
                    $selisihHari = (-1) * $mutasiDetail->selisihHari;
                    $tanggalBaru = date('Y-m-d', strtotime("$selisihHari days", strtotime($tanggal)));
                    $idOutlet = $mutasiDetail->idOutlet;
                    $totalMutasi = ($mutasiTransaksi->total) / 1000;
                    foreach ($arrayDataSetoran as $loopDataSetoran) {
                        $tanggalPembanding = $loopDataSetoran->Tanggal;
                        $idOutletPembanding =  $loopDataSetoran->idOutlet;
                        $totalPembanding = $loopDataSetoran->total;
                        if (strtotime($tanggalBaru) == strtotime($tanggalPembanding)) {
                            if ($idOutlet == $idOutletPembanding) {
                                if (floor($totalMutasi) == floor($totalPembanding)) {
                                    try {
                                        $mutasiSetoran = new mutasi_setoran();
                                        $mutasiSetoran->idMutasiTransaksi = $mutasiTransaksi->id;
                                        $mutasiSetoran->idSetoran = $loopDataSetoran->id;
                                        $mutasiSetoran->save();
                                    } catch (Exception $e) {
                                    }
                                    $setoran = setoran::find($loopDataSetoran->id);
                                    $setoran->idRevisi = '3';
                                    $setoran->save();
                                }
                            }
                        }
                    }
                }
            }
        }
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
                            if (($listSalesIdPembanding == $idListSalesTemp) || ($listSalesIdPembanding == $idListSalesTemp2)) {
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
        if ($idPenerimaList == 2) {
            //Jika rekening mengarah ke rekening 103 yang digunakan untuk setoran maka
            $this->generate103($startDate, $stopDate);
        }
        if ($idPenerimaList == 1) {
            $this->generate165($startDate, $stopDate);
        }
    }

    function generate165($startDate, $stopDate)
    {
        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));

        $tanggalAlls = $tanggalAlls->with([
            'mutasiTransaksis',
            'reimburses.penerimaReimburses.pengirimLists',
        ])->get();

        $arrayReimburse = [];

        foreach ($tanggalAlls as $eachTanggal) {
            foreach ($eachTanggal->reimburses as $eachReimburse) {
                foreach ($eachReimburse->penerimaReimburses as $eachPenerimaReimburse) {
                    array_push($arrayReimburse, (object)[
                        'idPenerimaReimburse' => $eachPenerimaReimburse->id,
                        'idOutlet' => $eachReimburse->idOutlet,
                        'Tanggal' => $eachTanggal->Tanggal,
                        'total' => $eachPenerimaReimburse->qty,
                        'nama' => strtoupper($eachPenerimaReimburse->pengirimLists->namaRekening),
                        'nomorRekening' => strtoupper($eachPenerimaReimburse->pengirimLists->nomorRekening)
                    ]);
                }
            }
        }

        foreach ($tanggalAlls as $eachTanggal) {
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            if ($mutasiTransaksis->count() > 0) {
                $mutasiTransaksiPindahSaldo = $mutasiTransaksis;
                $mutasiTransaksis = $mutasiTransaksis->where('idPenerimaList', '=', 1);
                //Cari data reimburse
                foreach ($mutasiTransaksis as $eachMutasi) {
                    $totalMutasi = (-1) * $eachMutasi->total;
                    foreach ($arrayReimburse as $loopReimburse) {
                        if ($loopReimburse->total == $totalMutasi) {
                            $similarity = $this->findNameInText($loopReimburse->nama, strtoupper($eachMutasi->trxNotes));
                            $similiartyNoRek = $this->findNameInText($loopReimburse->nomorRekening, strtoupper($eachMutasi->trxNotes));
                            print_r($similarity);
                            print_r('  ');
                            print_r($loopReimburse->nama);
                            print_r(' ');
                            print_r($loopReimburse->Tanggal);
                            print_r(' || ');
                            print_r(strtoupper($eachMutasi->trxNotes));
                            echo ('<br>');
                            echo ('<br>');
                            if (($similarity >= 40) || ($similiartyNoRek >= 40)) {
                                $tanggal1 = $loopReimburse->Tanggal; //Tanggal minta reimburse
                                $tanggal2 = $eachTanggal->Tanggal; //Tanggal Mutasi
                                $selisihTanggal = date_diff(date_create($tanggal1), date_create($tanggal2))->days;
                                $mutasiDetail = $eachMutasi->mutasiDetails;
                                if ($mutasiDetail == null) {
                                    try {
                                        $mutasiDetail = new mutasi_detail();
                                        $mutasiDetail->idMutasiTransaksi = $eachMutasi->id;
                                        $mutasiDetail->selisihHari = $selisihTanggal;
                                        $mutasiDetail->idOutlet = $loopReimburse->idOutlet;
                                        $mutasiDetail->idMutasiAksi = 4; //Pilih ke transfer kas
                                        $mutasiDetail->idMutasiKlasifikasi = 10; //Pilih klasifikasi ke pattycash
                                        $mutasiDetail->save();
                                    } catch (Exception $e) {
                                    }
                                }
                                try {
                                    $mutasiReimburse = new mutasi_reimburse();
                                    $mutasiReimburse->idMutasiTransaksi = $eachMutasi->id;
                                    $mutasiReimburse->idPenerimaReimburse = $loopReimburse->idPenerimaReimburse;
                                    $mutasiReimburse->save();
                                } catch (Exception $e) {
                                }

                                //Lakukan verifikasi untuk mensukseskan reimburse mutasi
                                $penerimaReimburse = penerimaReimburse::find($loopReimburse->idPenerimaReimburse);
                                $penerimaReimburse->idRevisi = '3';
                                $penerimaReimburse->save();
                            }
                        }
                    }
                }
                // Cari data pindah saldo
                foreach ($mutasiTransaksis as $eachMutasi) {
                    $mutasi1003 = $mutasiTransaksiPindahSaldo->where('idPenerimaList', '=', '2');
                    foreach ($mutasi1003 as $loop1003) {
                        if ($loop1003->total == (-1) * $eachMutasi->total) {
                            try {
                                $mutasiDetail = new mutasi_detail();
                                $mutasiDetail->idMutasiTransaksi = $eachMutasi->id;
                                $mutasiDetail->selisihHari = 0;
                                $mutasiDetail->idOutlet = '1';
                                $mutasiDetail->idMutasiAksi = 3; //Pilih ke pindah saldo
                                $mutasiDetail->idMutasiKlasifikasi = 11; //Pilih pindah saldo 1003 ke 165
                                $mutasiDetail->save();
                            } catch (Exception $e) {
                            }
                            echo $eachMutasi->id;
                            echo ' pindah 1003 ke 165 ';
                        }
                    }

                    $mutasi455 = $mutasiTransaksiPindahSaldo->where('idPenerimaList', '=', '4');
                    foreach ($mutasi455 as $loop455) {
                        if ($loop455->total == (-1) * $eachMutasi->total) {
                            try {
                                $mutasiDetail = new mutasi_detail();
                                $mutasiDetail->idMutasiTransaksi = $eachMutasi->id;
                                $mutasiDetail->selisihHari = 0;
                                $mutasiDetail->idOutlet = '1';
                                $mutasiDetail->idMutasiAksi = 3; //Pilih ke pindah saldo
                                $mutasiDetail->idMutasiKlasifikasi = 12; //Pilih pindah saldo 455 ke 165
                                $mutasiDetail->save();
                            } catch (Exception $e) {
                            }
                            echo $eachMutasi->id;
                            echo ' pindah 455 ke 165 ';
                        }
                    }
                }
            }
        }
    }

    function generate103($startDate, $stopDate)
    {
        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));

        $tanggalAlls = $tanggalAlls->with([
            'mutasiTransaksis.mutasiSetorans',
            'setorans.pengirimLists',
        ])->get();
        //Lakukan looping dengan ambil semua setoran di antara tanggal ini dan simpan setoran di array $allSetoran
        $allSetoran = [];
        foreach ($tanggalAlls as $eachTanggal) {
            $setorans = $eachTanggal->setorans;
            foreach ($setorans as $setoran) {
                array_push($allSetoran, (object)[
                    'id' => $setoran->id,
                    'Tanggal' => $eachTanggal->Tanggal,
                    'idOutlet' => $setoran->idOutlet,
                    'qtySetor' => $setoran->qtySetor,
                    'penyetor' => strtoupper($setoran->pengirimLists->namaRekening)
                ]);
            }
        }
        // @dd($allSetoran);
        foreach ($tanggalAlls as $eachTanggal) {
            $tanggal = $eachTanggal->Tanggal;
            $mutasiTransaksis = $eachTanggal->mutasiTransaksis;
            if ($mutasiTransaksis->count() > 0) {
                //Hanya filter penerima list yang digunakan untuk setoran
                $mutasiTransaksis = $mutasiTransaksis->where('idPenerimaList', '=', 2);
                foreach ($mutasiTransaksis as $mutasiTransaksi) {
                    $totalTransaksi = $mutasiTransaksi->total;
                    //Lakukan looping untuk menentukan setoran mana yang cocok sesuai H +1 dari setoran dan nilainya sama
                    //Cek juga untuk nama agar sesuai
                    $tanggalBaru = date('Y-m-d', strtotime($tanggal . ' -1 day'));
                    foreach ($allSetoran as $loopSetoran) {
                        if (strtotime($loopSetoran->Tanggal) == strtotime($tanggalBaru)) {
                            if (floor(($loopSetoran->qtySetor) / 1000) == floor(($totalTransaksi) / 1000)) {
                                $percentage = $this->findNameInText($loopSetoran->penyetor, strtoupper($mutasiTransaksi->trxNotes));;
                                print_r($percentage);
                                print_r('  ');
                                print_r($loopSetoran->penyetor);
                                print_r(' || ');
                                print_r(strtoupper($mutasiTransaksi->trxNotes));
                                echo '<br>';
                                if ($percentage >= 50) {
                                    $mutasiSetorans = $mutasiTransaksi->mutasiSetorans;
                                    echo 'Berhasil';
                                    echo '<br>';
                                    $idOutlet = 0;
                                    if ($mutasiSetorans == null) {
                                        $mutasiSetoran = new mutasi_setoran();
                                        $mutasiSetoran->idMutasiTransaksi = $mutasiTransaksi->id;
                                        $mutasiSetoran->idSetoran = $loopSetoran->id;
                                        $mutasiSetoran->save();
                                    }

                                    $mutasiDetail = $mutasiTransaksi->mutasiDetails;
                                    if ($mutasiDetail == null) {
                                        $mutasiDetail = new mutasi_detail();
                                        $mutasiDetail->idMutasiTransaksi = $mutasiTransaksi->id;
                                        $mutasiDetail->selisihHari = 1;
                                        $mutasiDetail->idOutlet = $loopSetoran->idOutlet;
                                        $mutasiDetail->idMutasiAksi = 4; //Pilih ke transfer kas
                                        $mutasiDetail->idMutasiKlasifikasi = 9; //Pilih klasifikasi ke sukodono
                                        $mutasiDetail->save();
                                    }

                                    $setoran = setoran::find($loopSetoran->id);
                                    $setoran->idRevisi = '3';
                                    $setoran->save();
                                }
                            }
                        }
                    }
                }
            }
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
        $pattyCash = listItemPattyCash::with('jenis_patty_cashs.kategori_patty_cashs')->get();

        $mutasiAksiArray = [];
        $mutasiKlasifikasiArray = [];
        $outletArray = [];
        $listPattyArray = [];

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

        foreach ($pattyCash as $loopPattyCash) {
            $idKategoriPatty = $loopPattyCash->jenis_patty_cashs->kategori_patty_cashs->id;
            // @dd($idKategoriPatty);
            if (($idKategoriPatty != 2)&&($idKategoriPatty != 5)) {
                array_push($listPattyArray, (object)[
                    'id' => $loopPattyCash->id,
                    'pattyCash' => $loopPattyCash->Item
                ]);
            }
        }

        return response()->json([
            'id' => $mutasiTransaksi->id,
            'keterangan' => $mutasiTransaksi->trxNotes,
            'total' => $mutasiTransaksi->total,
            'outlet' => $outletArray,
            'mutasiAksi' => $mutasiAksiArray,
            'mutasiKlasifikasi' => $mutasiKlasifikasiArray,
            'pattyCash' => $listPattyArray
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
            'mutasiTransaksis.mutasiSetorans.robotMutasi1003Setorans',
            'mutasiTransaksis.mutasiReimburses.robotMutasi165Reimburse',
            'mutasiTransaksis.mutasiDetails.robot165PindahSaldo',
            'mutasiTransaksis.mutasiDetails.mutasiPembayarans.listItemPattyCash',
            'mutasiTransaksis.mutasiDetails.mutasiPembayarans.robot165Pembayaran'
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
                    $idKlasifikasi = 99;

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

                        $robot165PindahSaldo = $mutasiDetail->robot165PindahSaldo;
                        foreach ($robot165PindahSaldo as $robotMutasi165) {
                            array_push($robotStatus, (object)[
                                'robot' => 'Mutasi 165 Pindah Saldo',
                                'status' => $robotMutasi165->statusRobots->status
                            ]);
                        }

                        $mutasiPembayaran = $mutasiDetail->mutasiPembayarans;
                        if($mutasiPembayaran != null){
                            $listItemPattyCash = $mutasiPembayaran->listItemPattyCash;
                            $klasifikasi = $listItemPattyCash->Item;

                            $robot165Pembayaran = $mutasiPembayaran->robot165Pembayaran;
                            foreach ($robot165Pembayaran as $robotMutasi165) {
                                array_push($robotStatus, (object)[
                                    'robot' => 'Mutasi 165 Pembayaran',
                                    'status' => $robotMutasi165->statusRobots->status
                                ]);
                            }
                        }
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

                    $mutasiReimburses = $mutasiTransaksi->mutasiReimburses;
                    if ($mutasiReimburses != null) {
                        array_push($terkaitStatus, 'Reimburse');
                        $robotMutasi165Reimburse = $mutasiReimburses->robotMutasi165Reimburse;
                        foreach ($robotMutasi165Reimburse as $robotMutasi) {
                            array_push($robotStatus, (object)[
                                'robot' => '165 Reimburse',
                                'status' => $robotMutasi->statusRobots->status
                            ]);
                        }
                    }

                    $mutasiSetorans = $mutasiTransaksi->mutasiSetorans;
                    if ($mutasiSetorans != null) {
                        array_push($terkaitStatus, 'Setoran');
                        $robotMutasi1003Setorans = $mutasiSetorans->robotMutasi1003Setorans;
                        foreach ($robotMutasi1003Setorans as $robotMutasi1003) {
                            array_push($robotStatus, (object)[
                                'robot' => '103 Setoran',
                                'status' => $robotMutasi1003->statusRobots->status
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

    public function deleteMutasiSetoran(Request $request)
    {
        $idSetoran = $request->idSetoran;
        $mutasiSetoran = mutasi_setoran::where('idSetoran', '=', $idSetoran)->get();
        foreach ($mutasiSetoran as $loopSetoran) {
            $loopSetoran->delete();
        }
        $setoran = setoran::find($idSetoran);
        $setoran->idRevisi = '2';
        $setoran->save();
    }

    public function deleteMutasiDetail(Request $request)
    {
        $mutasiDetails = mutasi_detail::where('idMutasiTransaksi', '=', $request->idMutasiTransaksi)->get();
        foreach ($mutasiDetails as $mutasiDetail) {
            $mutasiPembayaran = $mutasiDetail->mutasiPembayarans;
            if($mutasiPembayaran != null){
                $mutasiPembayaran->delete();
            }
            $mutasiDetail->delete();
        }
    }

    public function deleteMutasiFromId($idStart,$idStop){
        $mutasiTransaksi = mutasi_transaksi::withTrashed()->where('id','>=',$idStart)->where('id','<=',$idStop)->get();
        foreach($mutasiTransaksi as $loopMutasi){
            $loopMutasi->forceDelete();
        }
    }
}
