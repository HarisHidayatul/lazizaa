<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\robot_pembelian_status;
use App\Models\tanggalAll;
use Illuminate\Http\Request;

class robotController extends Controller
{
    //
    public function showPembelian(Request $request){
        $idOutlet = $request->idOutlet;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
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
        $tanggalAlls = $tanggalAlls->whereBetween('Tanggal', array($startDate, $stopDate));
        $tanggalAlls = $tanggalAlls->with(['reimburses.penerimaReimburses.pengirimLists', 'reimburses.penerimaReimburses.penerimaLists', 'pattyCashHarians.listItemPattyCashs.satuans', 'pattyCashHarians.listItemPattyCashs.jenis_patty_cashs.kategori_patty_cashs'])->get();
        
        for ($indexOutletLoop = 0; $indexOutletLoop < count($outletArray); $indexOutletLoop++) {
            $allHistory = [];
            $namaOutlet = doutlet::find($outletArray[$indexOutletLoop])['Nama Store'];
            // @dd($namaOutlet);
            foreach ($tanggalAlls as $tanggalAll) {
                $dataFound = false;
                $pattyCash = [];

                $pembelianHarians = $tanggalAll->pattyCashHarians;
                $pembelianHarians = $pembelianHarians->where('idOutlet', '=', $outletArray[$indexOutletLoop]);
                foreach ($pembelianHarians as $pembelianHarian) {
                    $pattyCashSesi = [];
                    $dataRobot = [];
                    $pembelianLists = $pembelianHarian->listItemPattyCashs;
                    $idSesi = $pembelianHarian->idSesi;
                    
                    $robotPembelians = $pembelianHarian->robotPembelianStatuss;
                    foreach($robotPembelians as $robotPembelian){
                        array_push($dataRobot,(object)[
                            'idRobotList' => $robotPembelian->id,
                            'user' => $robotPembelian->dUsers['Nama Lengkap'],
                            'status' => $robotPembelian->statusRobots->status
                        ]);
                    }

                    foreach ($pembelianLists as $pembelianList) {
                        $qtyPembelian = $pembelianList->pivot->quantity;
                        $totalPembelian = $pembelianList->pivot->total;
                        if ($pembelianList->pivot->idRevTotal == 2) {
                            $totalPembelian = $pembelianList->pivot->totalRevisi;
                        }
                        if($pembelianList->jenis_patty_cashs->namaJenis == 'HPP'){
                            array_push($pattyCashSesi, (object)[
                                'item' => $pembelianList->Item,
                                'jenisItem' => $pembelianList->jenis_patty_cashs->namaJenis,
                                'idSesi' => $idSesi,
                                'total' => $totalPembelian,
                                'qty' => $qtyPembelian,
                                'idRevTotal' => $pembelianList->pivot->idRevTotal,
                                'idRevQty' => $pembelianList->pivot->idRevQuantity,
                                'satuan' => $pembelianList->satuans->Satuan,
                            ]);
                        }
                        $dataFound = true;
                    }
                    array_push($pattyCash,(object)[
                        'sesi' => $idSesi,
                        'pattyCash' => $pattyCashSesi,
                        'idPattyHarian' => $pembelianHarian->id,
                        'dataRobot' => $dataRobot
                    ]);
                }

                if ($dataFound) {
                    array_push($allHistory, (object)[
                        'tanggal' => $tanggalAll->Tanggal,
                        'pattyCash' => $pattyCash,
                    ]);
                }
            }
            $allHistory = array_reverse($allHistory, false);

            array_push($allData, (object)[
                'dataHistory' => $allHistory,
                'outlet' => $namaOutlet
            ]);
        }

        return response()->json([
            'allData' => $allData
        ]);
    }

    public function createRobotPembelian(Request $request){
        $idPattyHarian = $request->idPattyHarian;
        $idPemverifikasi = $request->idPemverifikasi;

        robot_pembelian_status::create([
            'idPattyCashHarian' => $idPattyHarian,
            'idPemverifikasi' => $idPemverifikasi,
            'idStatusRobot' => '1'
        ]);
    }

    public function deleteRobotPembelian(Request $request){
        robot_pembelian_status::find($request->idRobotPembelianStatus)->delete();
    }
}
