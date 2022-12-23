<?php

namespace App\Http\Controllers;

use App\Models\penerimaReimburse;
use App\Models\reimburse;
use App\Models\tanggalAll;
use Carbon\Carbon;
use Illuminate\Http\Request;

class reimburseController extends Controller
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
    }

    public function storeDataReimburse(Request $request)
    {
        //tanggal, id outlet => reimburse (saldo terakhir = 0 jika tidak ada)
        //idPengirim (default 1), idBank, namaRekening, nomorRekening, pesan, idRevisi (default 2)
        //imgTransfer (default null), qty

        //searchTanggal
        $tanggalAll = tanggalAll::where('Tanggal','=',$request->tanggal)->first();
        if($tanggalAll == null){
            $tanggalAll = tanggalAll::create([
                'Tanggal' => $request->tanggal
            ]);
        }
        $reimburse = $tanggalAll->reimburses->where('idOutlet','=',$request->idOutlet)->first();
        if($reimburse == null){
            $reimburse = reimburse::create([
                'idTanggal' => $tanggalAll->id,
                'idOutlet' => $request->idOutlet,
                'saldoTerakhir' => '0'
            ]);
        }
        $penerimaReimburse = penerimaReimburse::create([
            'idPengirim' => '1', //default 1
            'idReimburse' => $reimburse->id,
            'idBank' => $request->idBank,
            'namaRekening' => $request->namaRekening,
            'nomorRekening' => $request->nomorRekening,
            'pesan' => $request->pesan,
            'idRevisi' => '2',
            'imgTransfer' => 'none',
            'qty' => $request->qty,
            'idPengisi' => $request->idPengisi
        ]);
        echo $penerimaReimburse->id;
        // @dd($reimburse);
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

    public function showDetail($idDetail)
    {
        $penerimaReimburse = penerimaReimburse::find($idDetail);
        // @dd($penerimaReimburse);
        $namaPengirim = '';
        $tanggal = '';
        $rekeningPengirim = '';
        $pesan = '';
        $namaPenerima = '';
        $rekeningPenerima = '';
        $imgBankPenerima = '';
        $idRevisi = null;
        $jumlahTransfer = 0;
        if ($penerimaReimburse != null) {
            // @dd($penerimaReimburse->tanggalAlls);
            $tanggal = $penerimaReimburse->tanggalAlls->Tanggal;
            $pesan = $penerimaReimburse->pesan;
            $namaPenerima = $penerimaReimburse->namaRekening;
            $rekeningPenerima = $penerimaReimburse->nomorRekening;
            $jumlahTransfer = $penerimaReimburse->qty;
            $idRevisi = $penerimaReimburse->idRevisi;
            if ($idRevisi != '2') {
                $namaPengirim = $penerimaReimburse->penerimaLists->namaRekening;
                $rekeningPengirim = $penerimaReimburse->penerimaLists->nomorRekening;
            }
            $imgBankPenerima = $penerimaReimburse->listBanks->imageBank;
        }
        return response()->json([
            'namaPengirim' => $namaPengirim,
            'tanggal' => $tanggal,
            'rekeningPengirim' => $rekeningPengirim,
            'pesan' => $pesan,
            'namaPenerima' => $namaPenerima,
            'rekeningPenerima' => $rekeningPenerima,
            'jumlahTransfer' => $jumlahTransfer,
            'imgBankPenerima' => $imgBankPenerima,
            'idRevisi' => $idRevisi
        ]);
    }

    public function showHistory($idOutlet, $countData)
    {
        $now = Carbon::now();
        $allDate = [];
        $allHistory = [];
        // @dd($now);
        if ($countData == 'today') {
            $allDate = tanggalAll::where('Tanggal', '=', $now->format('Y-m-d'))->get();
        } else if ($countData == '7day') {
            $from = $now->format('Y-m-d');
            $to = $now->subDays(7)->format('Y-m-d');
            $allDate = tanggalAll::whereBetween('Tanggal', array($to, $from))->orderBy('Tanggal', 'DESC')->get();
        } else if ($countData == '30day') {
            $from = $now->format('Y-m-d');
            $to = $now->subDays(30)->format('Y-m-d');
            $allDate = tanggalAll::whereBetween('Tanggal', array($to, $from))->orderBy('Tanggal', 'DESC')->get();
        } else if ($countData == 'all') {
            $allDate = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        }

        for ($i = 0; $i < $allDate->count(); $i++) {
            $reimburse = $allDate[$i]->reimburses;

            if ($reimburse != null) {
                $dataFound = false;
                $pattyCash = [];
                $reimburseTanggalIni = [];
                $reimburse = $reimburse->where('idOutlet', '=', $idOutlet);
                $tanggal = $allDate[$i]->Tanggal;

                // search reimburse untuk mendapatkan saldo terakhir di hari itu
                for ($j = 0; $j < $reimburse->count(); $j++) {
                    $saldoTerakhir = $reimburse[$j]->saldoTerakhir;
                    $saldoSaatIni = $saldoTerakhir;

                    $pembelianHarian = $allDate[$i]->pattyCashHarians;
                    $reimburseHarian = $reimburse[$j]->penerimaReimburses;
                    // @dd($reimburseHarian);
                    if ($reimburseHarian != null) {
                        for ($k = 0; $k < $reimburseHarian->count(); $k++) {
                            if ($reimburseHarian[$k]->idRevisi == '3') {
                                $saldoSaatIni = $saldoSaatIni + $reimburseHarian[$k]->qty;
                            }
                            $dataFound = true;
                            array_push($reimburseTanggalIni, (object)[
                                'id' => $reimburseHarian[$k]->id,
                                'reimburse' => $reimburseHarian[$k]->qty,
                                'saldo' => $saldoSaatIni,
                                'idRev' => $reimburseHarian[$k]->idRevisi
                            ]);
                        }
                    }

                    if ($pembelianHarian != null) {
                        $pembelianHarian = $pembelianHarian->where('idOutlet', '=', $idOutlet);
                        for ($k = 0; $k < $pembelianHarian->count(); $k++) {
                            $pembelianList = $pembelianHarian[$k]->listItemPattyCashs;
                            for ($l = 0; $l < $pembelianList->count(); $l++) {
                                $qtyPembelian = $pembelianList[$l]->pivot->quantity;
                                $totalPembelian = $pembelianList[$l]->pivot->total;
                                $saldoSaatIni = $saldoSaatIni - $totalPembelian;

                                $dataFound = true;
                                array_push($pattyCash, (object)[
                                    'item' => $pembelianList[$l]->Item,
                                    'total' => $totalPembelian,
                                    'qty' => $qtyPembelian,
                                    'satuan' => $pembelianList[$l]->satuans->Satuan,
                                    'saldo' => $saldoSaatIni
                                ]);
                            }
                        }
                        $pattyCash = array_reverse($pattyCash, false);
                    }
                    // array_push($allHistory,$saldoTerakhir);
                }
                if ($dataFound) {
                    array_push($allHistory, (object)[
                        'tanggal' => $tanggal,
                        'pattyCash' => $pattyCash,
                        'reimburse' => $reimburseTanggalIni
                    ]);
                }
            }
        }
        // @dd($allHistory);
        return response()->json([
            'dataHistory' => $allHistory
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

    public function updateAllHistory($idOutlet)
    {
        //Berfungsi untuk mengupdate datahistory perhari
        $allDate = tanggalAll::orderBy('Tanggal', 'ASC')->get();
        // @dd($allDate);
        $pergerakanSaldoSekarang = 0;
        $dataAwalDitemukan = false;
        for ($i = 0; $i < $allDate->count(); $i++) {
            $reimburse = $allDate[$i]->reimburses;
            if ($reimburse != null) {
                $pattyCash = [];
                $tanggalFound = false;
                $reimburse = $reimburse->where('idOutlet', '=', $idOutlet);
                // search reimburse untuk mendapatkan saldo terakhir di hari itu
                for ($j = 0; $j < $reimburse->count(); $j++) {
                    $tanggalFound = true;
                    if ($dataAwalDitemukan == false) {
                        $pergerakanSaldoSekarang = $reimburse[$j]->saldoTerakhir;
                        $dataAwalDitemukan = true;
                    } else {
                        $reimburse[$j]->update([
                            'saldoTerakhir' => $pergerakanSaldoSekarang
                        ]);
                    }

                    $pembelianHarian = $allDate[$i]->pattyCashHarians;
                    $reimburseHarian = $reimburse[$j]->penerimaReimburses;
                    // @dd($reimburseHarian);
                    if ($reimburseHarian != null) {
                        for ($k = 0; $k < $reimburseHarian->count(); $k++) {
                            if ($reimburseHarian[$k]->idRevisi == '3') {
                                $pergerakanSaldoSekarang = $pergerakanSaldoSekarang + $reimburseHarian[$k]->qty;
                            }
                        }
                    }

                    if ($pembelianHarian != null) {
                        $pembelianHarian = $pembelianHarian->where('idOutlet', '=', $idOutlet);
                        for ($k = 0; $k < $pembelianHarian->count(); $k++) {
                            $pembelianList = $pembelianHarian[$k]->listItemPattyCashs;
                            for ($l = 0; $l < $pembelianList->count(); $l++) {
                                $qtyPembelian = $pembelianList[$l]->pivot->quantity;
                                $totalPembelian = $pembelianList[$l]->pivot->total;
                                $pergerakanSaldoSekarang = $pergerakanSaldoSekarang - $totalPembelian;
                            }
                        }
                        $pattyCash = array_reverse($pattyCash, false);
                    }
                    // array_push($allHistory,$saldoTerakhir);
                }
                if ($tanggalFound == false) {
                    if ($dataAwalDitemukan) {
                        reimburse::create([
                            'idTanggal' => $allDate[$i]->id,
                            'idOutlet' => $idOutlet,
                            'saldoTerakhir' => $pergerakanSaldoSekarang
                        ]);
                        // $i--;
                    }
                }
            }
        }
        echo "Sukses Update";
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
