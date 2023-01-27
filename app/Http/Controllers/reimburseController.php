<?php

namespace App\Http\Controllers;

use App\Models\penerimaReimburse;
use App\Models\pengirimList;
use App\Models\reimburse;
use App\Models\tanggalAll;
use Carbon\Carbon;
use Exception;
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
        $tanggalAll = tanggalAll::where('Tanggal', '=', $request->tanggal)->first();
        if ($tanggalAll == null) {
            $tanggalAll = tanggalAll::create([
                'Tanggal' => $request->tanggal
            ]);
        }
        $reimburse = $tanggalAll->reimburses->where('idOutlet', '=', $request->idOutlet)->first();
        if ($reimburse == null) {
            $reimburse = reimburse::create([
                'idTanggal' => $tanggalAll->id,
                'idOutlet' => $request->idOutlet,
                'saldoTerakhir' => '0'
            ]);
        }
        $tujuan = pengirimList::create([
            'idOutlet' => $request->idOutlet,
            'idUser' => $request->idPengisi,
            'idBank' => $request->idBank,
            'namaRekening' => $request->namaRekening,
            'nomorRekening' => $request->nomorRekening,
        ]);
        $penerimaReimburse = penerimaReimburse::create([
            'idTujuan' => $tujuan->id,
            'idPengirim' => '1', //default 1
            'idReimburse' => $reimburse->id,
            'pesan' => $request->pesan,
            'idRevisi' => '2',
            'imgTransfer' => 'none',
            'qty' => $request->qty,
            'idPengisi' => $request->idPengisi
        ]);
        echo $penerimaReimburse->id;
        // @dd($reimburse);
    }

    public function storeReimburseIdTujuan(Request $request, $idTujuan)
    {
        //tanggal, id outlet => reimburse (saldo terakhir = 0 jika tidak ada)
        //idPengirim (default 1), idBank, namaRekening, nomorRekening, pesan, idRevisi (default 2)
        //imgTransfer (default null), qty

        //searchTanggal
        $tanggalAll = tanggalAll::where('Tanggal', '=', $request->tanggal)->first();
        if ($tanggalAll == null) {
            $tanggalAll = tanggalAll::create([
                'Tanggal' => $request->tanggal
            ]);
        }
        $reimburse = $tanggalAll->reimburses->where('idOutlet', '=', $request->idOutlet)->first();
        if ($reimburse == null) {
            $reimburse = reimburse::create([
                'idTanggal' => $tanggalAll->id,
                'idOutlet' => $request->idOutlet,
                'saldoTerakhir' => '0'
            ]);
        }

        $penerimaReimburse = penerimaReimburse::create([
            'idTujuan' => $idTujuan,
            'idPengirim' => '1', //default 1
            'idReimburse' => $reimburse->id,
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
        $bankPenerima = '';

        $idRevisi = null;
        $jumlahTransfer = 0;
        // @dd($penerimaReimburse->listBanks);
        if ($penerimaReimburse != null) {
            // @dd($penerimaReimburse->tanggalAlls);
            $tanggal = $penerimaReimburse->tanggalAlls->Tanggal;
            $pesan = $penerimaReimburse->pesan;
            $namaPenerima = $penerimaReimburse->pengirimLists->namaRekening;
            $rekeningPenerima = $penerimaReimburse->pengirimLists->nomorRekening;
            $jumlahTransfer = $penerimaReimburse->qty;
            $idRevisi = $penerimaReimburse->idRevisi;
            if ($idRevisi != '2') {
                $namaPengirim = $penerimaReimburse->penerimaLists->namaRekening;
                $rekeningPengirim = $penerimaReimburse->penerimaLists->nomorRekening;
            }
            $imgBankPenerima = $penerimaReimburse->listBanks->imageBank;
            $bankPenerima = $penerimaReimburse->listBanks->bank;
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
            'bankPenerima' => $bankPenerima,
            'idRevisi' => $idRevisi,
            'idPengirim' => $penerimaReimburse->penerimaLists->id
        ]);
    }

    public function showPengirimAll($idUser)
    {
        $pengirimList = pengirimList::where('idUser', '=', $idUser)->get();
        $pengirimListArray = [];
        for ($i = 0; $i < $pengirimList->count(); $i++) {
            $idJenisBank = $pengirimList[$i]->listBanks->idJenisBank;
            if ($idJenisBank == '1') {
                array_push($pengirimListArray, (object)[
                    'id' => $pengirimList[$i]->id,
                    'namaRekening' => $pengirimList[$i]->namaRekening,
                    'nomorRekening' => $pengirimList[$i]->nomorRekening,
                    'imgBank' => $pengirimList[$i]->listBanks->imageBank,
                    'bank' => $pengirimList[$i]->listBanks->bank,
                    'idJenisBank' => $idJenisBank
                ]);
            }
        }
        usort($pengirimListArray, function ($a, $b) {
            return strcmp($a->namaRekening, $b->namaRekening);
        });
        return response()->json([
            'pengirimListArray' => $pengirimListArray
        ]);
    }

    public function showHistory($idOutlet, $countData, $startDate, $stopDate)
    {
        $now = Carbon::now();
        $pergerakanSaldo = 0;
        // $allDate = [];
        $allHistory = [];
        // $saldoPattyCash = 0;
        $semuaTanggal = tanggalAll::orderBy('Tanggal', 'DESC')->with(['reimburses.penerimaReimburses.pengirimLists', 'reimburses.penerimaReimburses.penerimaLists', 'pattyCashHarians.listItemPattyCashs.satuans'])->get();
        $allDate = $semuaTanggal;
        // @dd($allDate);

        if ($countData == 'today') {
            $allDate = $semuaTanggal->where('Tanggal', '=', $now->format('Y-m-d'));
        } else if ($countData == '7day') {
            $from = $now->format('Y-m-d');
            $to = $now->subDays(7)->format('Y-m-d');
            $allDate = $semuaTanggal->whereBetween('Tanggal', array($to, $from));
        } else if ($countData == '30day') {
            $from = $now->format('Y-m-d');
            $to = $now->subDays(30)->format('Y-m-d');
            $allDate = $semuaTanggal->whereBetween('Tanggal', array($to, $from));
        } else if ($countData == 'between') {
            $allDate = $semuaTanggal->whereBetween('Tanggal', array($startDate, $stopDate));
        } else if ($countData == 'all') {
            $allDate = $semuaTanggal;
        }
        // @dd(is_null($allDate[13]));
        // @dd($allDate[13]->reimburses);

        for ($i = 0; $i < $semuaTanggal->count(); $i++) {
            try {
                $reimburseTanggalIni = [];
                $pattyCash = [];
                $dataFound = false;
                $reimburseAll = $allDate[$i]->reimburses->where('idOutlet', '=', $idOutlet);
                $reimburse = $reimburseAll->first();
                for ($j = 0; $j < $reimburseAll->count(); $j++) {
                    $reimburse = $reimburseAll[$j];
                    $pergerakanSaldo = $reimburse->saldoTerakhir;
                    $pembelianHarian = $allDate[$i]->pattyCashHarians;
                    $reimburseHarian = $reimburse->penerimaReimburses;

                    for ($k = 0; $k < $reimburseHarian->count(); $k++) {
                        if ($reimburseHarian[$k]->idRevisi == '3') {
                            $pergerakanSaldo = $pergerakanSaldo + $reimburseHarian[$k]->qty;
                        }
                        array_push($reimburseTanggalIni, (object)[
                            'id' => $reimburseHarian[$k]->id,
                            'reimburse' => $reimburseHarian[$k]->qty,
                            'saldo' => $pergerakanSaldo,
                            'idRev' => $reimburseHarian[$k]->idRevisi
                        ]);
                        $dataFound = true;
                    }

                    $pembelianHarian = $pembelianHarian->where('idOutlet', '=', $idOutlet);
                    for ($k = 0; $k < $pembelianHarian->count(); $k++) {
                        $pembelianList = $pembelianHarian[$k]->listItemPattyCashs;
                        for ($l = 0; $l < $pembelianList->count(); $l++) {
                            $qtyPembelian = $pembelianList[$l]->pivot->quantity;
                            $totalPembelian = $pembelianList[$l]->pivot->total;
                            if ($pembelianList[$l]->pivot->idRevTotal == 2) {
                                $totalPembelian = $pembelianList[$l]->pivot->totalRevisi;
                            }
                            $pergerakanSaldo = $pergerakanSaldo - $totalPembelian;
                            array_push($pattyCash, (object)[
                                'item' => $pembelianList[$l]->Item,
                                'total' => $totalPembelian,
                                'qty' => $qtyPembelian,
                                'idRevTotal' => $pembelianList[$l]->pivot->idRevTotal,
                                'idRevQty' => $pembelianList[$l]->pivot->idRevQuantity,
                                'satuan' => $pembelianList[$l]->satuans->Satuan,
                                'saldo' => $pergerakanSaldo
                            ]);
                            $dataFound = true;
                        }
                    }
                    $pattyCash = array_reverse($pattyCash, false);
                }
                if ($dataFound) {
                    array_push($allHistory, (object)[
                        'tanggal' => $allDate[$i]->Tanggal,
                        'pattyCash' => $pattyCash,
                        'reimburse' => $reimburseTanggalIni
                    ]);
                }
            } catch (Exception $e) {
            }
        }
        // reimburse;
        return response()->json([
            'dataHistory' => $allHistory,
            'saldoPattyCash' => $pergerakanSaldo
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
        $pergerakanSaldo = 0;
        $awalSaldo = true;
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'ASC')->with('reimburses.penerimaReimburses', 'pattyCashHarians.listItemPattyCashs')->get();
        for ($i = 0; $i < $tanggalAll->count(); $i++) {
            $reimburseAll = $tanggalAll[$i]->reimburses;
            if (count($reimburseAll) == 0) {
                reimburse::create([
                    'idTanggal' => $tanggalAll[$i]->id,
                    'idOutlet' => $idOutlet,
                    'saldoTerakhir' => $pergerakanSaldo
                ]);
            }
            $reimburseAll = $reimburseAll->where('idOutlet', '=', $idOutlet);
            if (count($reimburseAll) == 0) {
                reimburse::create([
                    'idTanggal' => $tanggalAll[$i]->id,
                    'idOutlet' => $idOutlet,
                    'saldoTerakhir' => $pergerakanSaldo
                ]);
            }
            $reimburseAll = $reimburseAll->where('idOutlet', '=', $idOutlet);
            $reimburse = $reimburseAll->first();

            if ($awalSaldo) {
                $pergerakanSaldo = $reimburse->saldoTerakhir;
                $awalSaldo = false;
            } else {
                if ($pergerakanSaldo != $reimburse->saldoTerakhir) {
                    $reimburse->update([
                        'saldoTerakhir' => $pergerakanSaldo
                    ]);
                }
            }

            echo "Tanggal : ";
            echo $tanggalAll[$i]->Tanggal;
            echo "<br>\n";

            echo "saldo terakhir : ";
            echo $pergerakanSaldo;
            echo "<br>\n";

            $pembelianHarian = $tanggalAll[$i]->pattyCashHarians;
            $reimburseHarian = $reimburse->penerimaReimburses;
            // @dd($reimburseHarian);
            for ($k = 0; $k < $reimburseHarian->count(); $k++) {
                if ($reimburseHarian[$k]->idRevisi == '3') {
                    $pergerakanSaldo = $pergerakanSaldo + $reimburseHarian[$k]->qty;
                    echo "reimburse : ";
                    echo $reimburseHarian[$k]->qty;
                    echo "<br>\n";
                }
            }
            $pembelianHarian = $pembelianHarian->where('idOutlet', '=', $idOutlet);
            for ($k = 0; $k < $pembelianHarian->count(); $k++) {
                $pembelianList = $pembelianHarian[$k]->listItemPattyCashs;
                for ($l = 0; $l < $pembelianList->count(); $l++) {
                    $qtyPembelian = $pembelianList[$l]->pivot->quantity;
                    $totalPembelian = $pembelianList[$l]->pivot->total;
                    if ($pembelianList[$l]->pivot->idRevTotal == 2) {
                        $totalPembelian = $pembelianList[$l]->pivot->totalRevisi;
                    }
                    $pergerakanSaldo = $pergerakanSaldo - $totalPembelian;

                    echo "pembelian : ";
                    echo $totalPembelian;
                    echo "<br>\n";
                }
            }
        }
    }
    public function updateRevisiTerima($id, Request $request)
    {
        $penerimaReimburse = penerimaReimburse::find($id);
        $penerimaReimburse->update([
            'idPengirim' => $request->idPengirim,
            'idRevisi' => $request->idRevisi,
            'pesan' => $request->pesan
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
