<?php

namespace App\Http\Controllers;

use App\Models\penerimaReimburse;
use App\Models\pengirimList;
use App\Models\reimburse;
use App\Models\tanggalAll;
use App\Models\tempImgAll;
use App\Models\doutlet;
use App\Models\sales_harian_reimburse;
use App\Models\sales_reimburse;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function storeDataReimburseSales(Request $request)
    {
        $idOutlet = $request->idOutlet;
        $tanggal = $request->tanggal;
        $total = $request->total;
        $idPengisi = $request->idPengisi;

        $tanggalAll = new tanggalAll();
        $salesHarianReimburse = new sales_harian_reimburse();
        $salesReimburse = new sales_reimburse();

        $tanggalAllFind = tanggalAll::where('Tanggal', '=', $tanggal)->get();
        if ($tanggalAllFind->count() == 0) {
            $tanggalAll->Tanggal = $tanggal;
            $tanggalAll->save();
        } else {
            $tanggalAll = $tanggalAllFind->first();
        }


        //cari sales harian reimburse
        $salesHarianFind = sales_harian_reimburse::where('idOutlet', '=', $idOutlet)->get();
        if ($salesHarianFind->count() == 0) {
            $salesHarianReimburse->idOutlet = $idOutlet;
            $salesHarianReimburse->idTanggal = $tanggalAll->id;
            $salesHarianReimburse->save();
        } else {
            $salesHarianFind = $salesHarianFind->where('idTanggal', '=', $tanggalAll->id);
            if ($salesHarianFind->count() == 0) {
                $salesHarianReimburse->idOutlet = $idOutlet;
                $salesHarianReimburse->idTanggal = $tanggalAll->id;
                $salesHarianReimburse->save();
            } else {
                $salesHarianReimburse = $salesHarianFind->first();
            }
        }

        $salesReimburseFind = $salesHarianReimburse->sales_reimburses;
        if ($salesReimburseFind == null) {
            $salesReimburse->idSalesHarianReimburse = $salesHarianReimburse->id;
            $salesReimburse->total = $total;
            $salesReimburse->idPengisi = $idPengisi;
            $salesReimburse->idPerevisi = $idPengisi;
            $salesReimburse->save();
        } else {
            $salesReimburse = $salesReimburseFind;
            $salesReimburse->totalRevisi = $total;
            $salesReimburse->idPerevisi = $idPengisi;
            $salesReimburse->idRevisiTotal = '2';
            $salesReimburse->save();
        }
        // @dd($salesReimburse);
        return response()->json([
            'idSalesHarianReimburse' => $salesReimburse->idSalesHarianReimburse,
            'idSalesReimburse' => $salesReimburse->id
        ]);
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

    public function showDetailSales($idDetail)
    {
        $sales_reimburse = sales_reimburse::find($idDetail);
        $sales_harian_reimburse = $sales_reimburse->salesHarianReimburses;
        $tanggal = $sales_harian_reimburse->tanggalAlls->Tanggal;
        $total = $sales_reimburse->total;
        $namaPengisi = $sales_reimburse->dUsers['Nama Lengkap'];
        if ($sales_reimburse->idRevisiTotal == '2') {
            $total = $sales_reimburse->totalRevisi;
        }
        // @dd($tanggal);
        return response()->json([
            'tanggal' => $tanggal,
            'idRevisiTotal' => $sales_reimburse->idRevisiTotal,
            'total' => $total,
            'namaPengisi' => $namaPengisi
        ]);
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
            'idPengirim' => $penerimaReimburse->penerimaLists->id,
            'imageBukti' => $penerimaReimburse->imgTransfer
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
        $outletArray = [];
        $allData = [];

        if ($idOutlet == 0) {
            $tempOutlet = doutlet::all();
            for ($i = 0; $i < $tempOutlet->count(); $i++) {
                array_push($outletArray, $tempOutlet[$i]->id);
            }
        } else {
            array_push($outletArray, $idOutlet);
        }
        $tanggalAlls = tanggalAll::orderBy('Tanggal', 'ASC');

        if ($countData == 'today') {
            $tanggalAlls = $tanggalAlls->where('Tanggal', '=', $now->format('Y-m-d'));
        } else if ($countData == '7day') {
            $from = $now->format('Y-m-d');
            $to = $now->subDays(7)->format('Y-m-d');
            $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($to, $from));
        } else if ($countData == '30day') {
            $from = $now->format('Y-m-d');
            // $to = $now->subDays(30)->format('Y-m-d');
            $to = $now->format('Y-m-01');
            $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($to, $from));
        } else if ($countData == 'between') {
            $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));
        } else if ($countData == 'all') {
            $tanggalAlls = $tanggalAlls;
        }
        $tanggalAlls = $tanggalAlls->with(['reimburses.penerimaReimburses.pengirimLists', 'reimburses.penerimaReimburses.penerimaLists', 'pattyCashHarians.listItemPattyCashs.satuans', 'pattyCashHarians.listItemPattyCashs.jenis_patty_cashs.kategori_patty_cashs'])->get();
        // @dd($tanggalAlls);

        // $fsadfa = tanggalAll;
        for ($indexOutletLoop = 0; $indexOutletLoop < count($outletArray); $indexOutletLoop++) {
            $pergerakanSaldo = 0;
            $allHistory = [];
            $namaOutlet = doutlet::find($outletArray[$indexOutletLoop])['Nama Store'];
            // @dd($namaOutlet);
            foreach ($tanggalAlls as $tanggalAll) {
                $reimburseTanggalIni = [];
                $reimburseSales = [];
                $pattyCash = [];
                $dataFound = false;

                $reimburseAll = $tanggalAll->reimburses->where('idOutlet', '=', $outletArray[$indexOutletLoop]);

                $reimburse = $reimburseAll->first();
                $reimburseHarians = [];
                if ($reimburse != null) {
                    $pergerakanSaldo = $reimburse->saldoTerakhir;
                    $reimburseHarians = $reimburse->penerimaReimburses;
                }

                $pembelianHarians = $tanggalAll->pattyCashHarians;


                $salesReimburse = $tanggalAll->salesHarianReimburses->where('idOutlet', '=', $outletArray[$indexOutletLoop])->first();
                if ($salesReimburse != null) {
                    if ($salesReimburse != null) {
                        $salesReimburse = $salesReimburse->sales_reimburses;
                        if ($salesReimburse != null) {
                            $totalSalesReimburse = $salesReimburse->total;
                            if ($salesReimburse->idRevisiTotal == '2') {
                                $totalSalesReimburse = $salesReimburse->totalRevisi;
                            }
                            $pergerakanSaldo = $pergerakanSaldo + $totalSalesReimburse;
                            array_push($reimburseSales, (object)[
                                'id' => $salesReimburse->id,
                                'idRevisiTotal' => $salesReimburse->idRevisiTotal,
                                'total' => $totalSalesReimburse,
                                'saldo' => $pergerakanSaldo
                            ]);
                            $dataFound = true;
                        }
                    }
                }

                foreach ($reimburseHarians as $reimburseHarian) {
                    if ($reimburseHarian->idRevisi == '3') {
                        $pergerakanSaldo = $pergerakanSaldo + $reimburseHarian->qty;
                    }
                    array_push($reimburseTanggalIni, (object)[
                        'id' => $reimburseHarian->id,
                        'reimburse' => $reimburseHarian->qty,
                        'saldo' => $pergerakanSaldo,
                        'idRev' => $reimburseHarian->idRevisi
                    ]);
                    $dataFound = true;
                }

                $reimburseTanggalIni = array_reverse($reimburseTanggalIni, false);

                $pembelianHarians = $pembelianHarians->where('idOutlet', '=', $outletArray[$indexOutletLoop]);
                foreach ($pembelianHarians as $pembelianHarian) {
                    $pembelianLists = $pembelianHarian->listItemPattyCashs;
                    $idSesi = $pembelianHarian->idSesi;
                    foreach ($pembelianLists as $pembelianList) {
                        $qtyPembelian = $pembelianList->pivot->quantity;
                        $totalPembelian = $pembelianList->pivot->total;
                        if ($pembelianList->pivot->idRevTotal == 2) {
                            $totalPembelian = $pembelianList->pivot->totalRevisi;
                        }
                        $pergerakanSaldo = $pergerakanSaldo - $totalPembelian;
                        array_push($pattyCash, (object)[
                            'item' => $pembelianList->Item,
                            'jenisItem' => $pembelianList->jenis_patty_cashs->namaJenis,
                            'kategoriItem' => $pembelianList->jenis_patty_cashs->kategori_patty_cashs->namaKategori,
                            'idSesi' => $idSesi,
                            'total' => $totalPembelian,
                            'qty' => $qtyPembelian,
                            'idRevTotal' => $pembelianList->pivot->idRevTotal,
                            'idRevQty' => $pembelianList->pivot->idRevQuantity,
                            'satuan' => $pembelianList->satuans->Satuan,
                            'saldo' => $pergerakanSaldo
                        ]);
                        $dataFound = true;
                    }
                }
                $pattyCash = array_reverse($pattyCash, false);

                if ($dataFound) {
                    array_push($allHistory, (object)[
                        'tanggal' => $tanggalAll->Tanggal,
                        'pattyCash' => $pattyCash,
                        'reimburse' => $reimburseTanggalIni,
                        'reimburseSales' => $reimburseSales
                    ]);
                }
            }
            $allHistory = array_reverse($allHistory, false);

            array_push($allData, (object)[
                'dataHistory' => $allHistory,
                'saldoPattyCash' => $pergerakanSaldo,
                'outlet' => $namaOutlet
            ]);
        }

        return response()->json([
            'allData' => $allData
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

    public function updateSalesReimburse($idDetail, Request $request)
    {
        $sales_reimburse = sales_reimburse::find($idDetail);
        $sales_reimburse->totalRevisi = $request->total;
        $sales_reimburse->idRevisiTotal = '2';
        $sales_reimburse->idPerevisi = $request->idPengisi;
        $sales_reimburse->save();
    }

    public function updateAllHistoryOutlet()
    {
        $outletAll = doutlet::all();
        for ($j = 0; $j < $outletAll->count(); $j++) {
            echo $outletAll[$j]['Nama Store'];
            echo '<br>';
            $this->updateAllHistory($outletAll[$j]->id);
            echo '<br>';
            echo '<br>';
        }
    }
    public function updateAllHistory($idOutlet)
    {
        $pergerakanSaldo = 0;
        $awalSaldo = true;
        $now = Carbon::now();
        $dateNow = $now->format('Y-m-d');
        $firstDate = $now->subMonth(1)->firstOfMonth()->format('Y-m-d'); //mendapatkan firstdate di tanggal 1 di tanggal sebelumnya

        $tanggalSekarang = tanggalAll::where('Tanggal', '=', $dateNow)->first();
        if ($tanggalSekarang == null) {
            tanggalAll::create([
                'Tanggal' => $dateNow
            ]);
        }
        // @dd($tanggalSekarang);
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'ASC');
        $from = $dateNow;
        $to = $firstDate;
        // $allDates = $tanggalAll->whereBetween('Tanggal', array($to, $from)); //Gunakan ini jika pattycash semua outlet sesuai saldo awal
        $allDates = $tanggalAll->with('reimburses.penerimaReimburses', 'pattyCashHarians.listItemPattyCashs', 'salesHarianReimburses.sales_reimburses')->get();
        // @dd($allDates);
        foreach ($allDates as $allDate) {
            $reimburseAll = $allDate->reimburses;
            if (count($reimburseAll) == 0) {
                reimburse::create([
                    'idTanggal' => $allDate->id,
                    'idOutlet' => $idOutlet,
                    'saldoTerakhir' => $pergerakanSaldo
                ]);
                // break;
                $reimburseAll = $allDate->reimburses;
            }
            
            $reimburseAll = $reimburseAll->where('idOutlet', '=', $idOutlet);
            if (count($reimburseAll) == 0) {
                reimburse::create([
                    'idTanggal' => $allDate->id,
                    'idOutlet' => $idOutlet,
                    'saldoTerakhir' => $pergerakanSaldo
                ]);
                // break;
                $reimburseAll = $reimburseAll->where('idOutlet', '=', $idOutlet);
            }
            // $reimburseAll = $reimburseAll->where('idOutlet', '=', $idOutlet);
            $reimburse = $reimburseAll->first();

            if ($awalSaldo) {
                $pergerakanSaldo = $reimburse->saldoTerakhir;
                $awalSaldo = false;
            } else {
                // print_r($pergerakanSaldo);
                // print_r('a');
                // print_r($reimburse->saldoTerakhir);
                // print_r('b');
                if ($pergerakanSaldo != $reimburse->saldoTerakhir) {
                    $reimburse->update([
                        'saldoTerakhir' => $pergerakanSaldo
                    ]);
                }
            }

            echo "Tanggal : ";
            echo $allDate->Tanggal;
            echo "<br>\n";

            echo "saldo terakhir : ";
            echo $pergerakanSaldo;
            echo "<br>\n";

            $pembelianHarians = $allDate->pattyCashHarians;
            $reimburseHarian = $reimburse->penerimaReimburses;
            // @dd($tanggalAll[12]->pattyCashHarians);
            for ($k = 0; $k < $reimburseHarian->count(); $k++) {
                if ($reimburseHarian[$k]->idRevisi == '3') {
                    $pergerakanSaldo = $pergerakanSaldo + $reimburseHarian[$k]->qty;
                    echo "reimburse : ";
                    echo $reimburseHarian[$k]->qty;
                    echo "<br>\n";
                }
            }
            $pembelianHarians = $pembelianHarians->where('idOutlet', '=', $idOutlet);
            foreach ($pembelianHarians as $pembelianHarian) {
                $pembelianList = $pembelianHarian->listItemPattyCashs;
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

            $salesReimburse = $allDate->salesHarianReimburses->where('idOutlet', '=', $idOutlet)->first();
            if ($salesReimburse != null) {
                if ($salesReimburse != null) {
                    $salesReimburse = $salesReimburse->sales_reimburses;
                    if ($salesReimburse != null) {
                        $totalSalesReimburse = $salesReimburse->total;
                        if ($salesReimburse->idRevisiTotal == '2') {
                            $totalSalesReimburse = $salesReimburse->totalRevisi;
                        }
                        $pergerakanSaldo = $pergerakanSaldo + $totalSalesReimburse;

                        echo "sales reimburse : ";
                        echo $totalSalesReimburse;
                        echo "<br>\n";
                    }
                }
            }
        }
    }
    public function updateRevisiTerima($id, Request $request)
    {
        $idRevisi = $request->idRevisi;
        $penerimaReimburse = penerimaReimburse::find($id);
        if ($idRevisi != '2') {
            if ($request->idImageTemp != 0) {
                $imagePathTemp = tempImgAll::find($request->idImageTemp)->imagePath;
                $imagePathNew = 'penerimaReimburse/';
                $imagePathNew .= now()->format('Y_m_d_H_i_s_');
                $imagePathNew .= substr($imagePathTemp, -5);

                Storage::copy($imagePathTemp, $imagePathNew);
                Storage::delete($imagePathTemp);
                tempImgAll::find($request->idImageTemp)->delete();

                $penerimaReimburse->update([
                    'idPengirim' => $request->idPengirim,
                    'idRevisi' => $idRevisi,
                    'pesan' => $request->pesan,
                    'imgTransfer' => $imagePathNew
                ]);
            } else {
                $penerimaReimburse->update([
                    'idPengirim' => $request->idPengirim,
                    'idRevisi' => $idRevisi,
                    'pesan' => $request->pesan
                ]);
            }
        } else {
            $penerimaReimburse->update([
                'idPengirim' => $request->idPengirim,
                'idRevisi' => $idRevisi,
                'pesan' => $request->pesan
            ]);
        }
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
    public function deleteRevisiTerima($id)
    {
        $penerimaReimburse = penerimaReimburse::find($id);
        $imagePath = $penerimaReimburse->imgTransfer;
        $penerimaReimburse->delete();
        Storage::delete($imagePath);
    }
}
