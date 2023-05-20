<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\listSales;
use App\Models\pelunasan_mutasi_sales;
use App\Models\robot_ecommerce_status;
use App\Models\robot_pembayaran_status;
use App\Models\robot_pembelian_status;
use App\Models\robot_temp_e_commerce;
use App\Models\tanggalAll;
use Illuminate\Http\Request;

class robotController extends Controller
{
    //
    public function showRobotPembelian(){
        $robotPembelianStatuss = robot_pembelian_status::where('idStatusRobot','=','1')->get()->first();
        $arrayPatty = [];
        $listPattys = $robotPembelianStatuss->pattyCashHarians->listItemPattyCashs;
        $tanggal = $robotPembelianStatuss->pattyCashHarians->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));
        $keywoard = $robotPembelianStatuss->pattyCashHarians->dOutlets->keywoardBee;
        $termin = $robotPembelianStatuss->pattyCashHarians->dOutlets->terminBee;
        $cabang = $robotPembelianStatuss->pattyCashHarians->dOutlets->cabangBee;
        $gudang = $robotPembelianStatuss->pattyCashHarians->dOutlets->gudangBee;
        $notes = '';

        foreach($listPattys as $listPatty){
            $qty = $listPatty->pivot->quantity;
            $total = $listPatty->pivot->total;
            if($listPatty->pivot->idRevQuantity == '2'){
                $qty = $listPatty->pivot->quantityRevisi;
            }
            if($listPatty->pivot->idRevTotal == '2'){
                $total = $listPatty->pivot->totalRevisi;
            }
            if(($qty == 0)||($total == 0)){
                continue;
            }
            $hargaSatuan = $total/$qty;
            if($listPatty->jenis_patty_cashs->namaJenis == 'HPP'){
                array_push($arrayPatty,(object)[
                    'idBeeCloud' => $listPatty->kodeBeeCloud,
                    'namaItem' => $listPatty->Item,
                    'qty' => $qty,
                    'total' => $total,
                    'satuan' => $listPatty->satuans->Satuan,
                    'hargaSatuan' => $hargaSatuan,
                    'gudang'    => $gudang
                ]);
                $notes .= $listPatty->Item;
                $notes .= '  ';
                $notes .= $qty;
                $notes .= ' ';
                $notes .= $listPatty->satuans->Satuan;
                $notes .= '  ';
                $notes .= 'Rp ';
                $notes .= $total;
                $notes .= '        ,         ';
            }
        }
        // @dd($tanggal);
        return response()->json([
            'Tanggal' => $tanggalDDmmYY,
            'keywoard' => $keywoard,
            'termin' => $termin,
            'cabang' => $cabang,
            'idRobotPembelian' => $robotPembelianStatuss->id,
            'Data'  => $arrayPatty,
            'Notes' => $notes
        ]);
    }

    public function showRobotPembayaran(){
        $robotPembayaranStatuss = robot_pembayaran_status::where('idStatusRobot','=','1')->get()->first();
        $arrayPatty = [];
        $listPattys = $robotPembayaranStatuss->pattyCashHarians->listItemPattyCashs;
        $tanggal = $robotPembayaranStatuss->pattyCashHarians->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));
        $keywoard = $robotPembayaranStatuss->pattyCashHarians->dOutlets->keywoardBee;
        $termin = $robotPembayaranStatuss->pattyCashHarians->dOutlets->terminBee;
        $cabang = $robotPembayaranStatuss->pattyCashHarians->dOutlets->cabangBee;
        $gudang = $robotPembayaranStatuss->pattyCashHarians->dOutlets->gudangBee;
        $kas = $robotPembayaranStatuss->pattyCashHarians->dOutlets->kasBee;
        $keterangan = '';
        $keterangan .= $robotPembayaranStatuss->pattyCashHarians->dOutlets['Nama Store'];
        $keterangan .= ' pembayaran kas ';
        $keterangan .= $tanggalDDmmYY;

        foreach($listPattys as $listPatty){
            $kategoriPattyCashs = $listPatty->jenis_patty_cashs->kategori_patty_cashs->namaKategori;
            $qty = $listPatty->pivot->quantity;
            $total = $listPatty->pivot->total;
            if($listPatty->pivot->idRevQuantity == '2'){
                $qty = $listPatty->pivot->quantityRevisi;
            }
            if($listPatty->pivot->idRevTotal == '2'){
                $total = $listPatty->pivot->totalRevisi;
            }
            if(($qty == 0)||($total == 0)){
                continue;
            }
            $hargaSatuan = $total/$qty;
            if(($kategoriPattyCashs == 'Beban Operasional')||($kategoriPattyCashs == 'Beban Penjualan')||($kategoriPattyCashs == 'Beban Gaji')||($kategoriPattyCashs == 'Beban Marketing')){
                $notes = '';
                $notes .= $listPatty->Item;
                $notes .= ' ';
                $notes .= $qty;
                $notes .= ' ';
                $notes .= $listPatty->satuans->Satuan;
                array_push($arrayPatty,(object)[
                    'kodeAkun' => $listPatty->jenis_patty_cashs->kodeAkun,
                    'namaItem' => $listPatty->Item,
                    'qty' => $qty,
                    'total' => $total,
                    'satuan' => $listPatty->satuans->Satuan,
                    'hargaSatuan' => $hargaSatuan,
                    'gudang'    => $gudang,
                    'gudang' => $gudang,
                    'Notes' => $notes
                ]);
            }
        }
        // @dd($tanggal);
        return response()->json([
            'Tanggal' => $tanggalDDmmYY,
            'keywoard' => $keywoard,
            'termin' => $termin,
            'cabang' => $cabang,
            'kas' => $kas,
            'idRobotPembayaran' => $robotPembayaranStatuss->id,
            'Data'  => $arrayPatty,
            'Keterangan' => $keterangan
        ]);
    }

    public function showRobotECommerce(){
        $robotECommerceStatus = robot_ecommerce_status::where('idStatusRobot','=','1')->get()->first();
        $tanggal = $robotECommerceStatus->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));
        $keterangan = $robotECommerceStatus->dOutlets['Nama Store'];
        $keterangan .= ' Beban E Commerce ';
        $keterangan .= $tanggalDDmmYY;
                
        $keywoard = $robotECommerceStatus->dOutlets->keywoardBee;
        $cabang = $robotECommerceStatus->dOutlets->cabangBee;

        $kodeAkun = '610.0201'; //Kode akun ini fix mengambil dari beban ecommerce
        $totalECommerce = 0;
        $data = [];

        $idOutlet = $robotECommerceStatus->idOutlet;
        $idTanggal = $robotECommerceStatus->idTanggal;

        $robotTempECommerces = robot_temp_e_commerce::where('idOutlet','=',$idOutlet)->get();
        if($robotTempECommerces->count() > 0){
            $robotTempECommerces = $robotTempECommerces->where('idTanggal','=',$idTanggal);
            if($robotTempECommerces->count() > 0){
                foreach($robotTempECommerces as $eachTempECommerce){
                    $totalECommerce = $totalECommerce + $eachTempECommerce->total;
                    array_push($data,(object)[
                        'total' => $eachTempECommerce->total,
                        'keywoardBee' => $eachTempECommerce->listSaless->keywoardBee,
                        'itemBee' => $eachTempECommerce->listSaless->itemBee
                    ]);
                }
            }
        }
        return response()->json([
            'Tanggal' => $tanggalDDmmYY,
            'keywoard' => $keywoard,
            'cabang' => $cabang,
            'idRobotECommerce' => $robotECommerceStatus->id,
            'Keterangan' => $keterangan,
            'totalECommerce' => $totalECommerce,
            'kodeAkun' => $kodeAkun,
            'Data'  => $data
        ]);
    }

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
                        if ($pembelianList->pivot->idRevQuantity == 2) {
                            $qtyPembelian = $pembelianList->pivot->quantityRevisi;
                        }
                        if($qtyPembelian == 0){
                            continue;
                        }
                        if($totalPembelian == 0){
                            continue;
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

    public function showPembayaran(Request $request){
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

                $PembayaranHarians = $tanggalAll->pattyCashHarians;
                $PembayaranHarians = $PembayaranHarians->where('idOutlet', '=', $outletArray[$indexOutletLoop]);
                foreach ($PembayaranHarians as $PembayaranHarian) {
                    $pattyCashSesi = [];
                    $dataRobot = [];
                    $PembayaranLists = $PembayaranHarian->listItemPattyCashs;
                    $idSesi = $PembayaranHarian->idSesi;
                    
                    $robotPembayarans = $PembayaranHarian->robotPembayaranStatuss;
                    foreach($robotPembayarans as $robotPembayaran){
                        array_push($dataRobot,(object)[
                            'idRobotList' => $robotPembayaran->id,
                            'user' => $robotPembayaran->dUsers['Nama Lengkap'],
                            'status' => $robotPembayaran->statusRobots->status
                        ]);
                    }

                    foreach ($PembayaranLists as $PembayaranList) {
                        $qtyPembayaran = $PembayaranList->pivot->quantity;
                        $totalPembayaran = $PembayaranList->pivot->total;
                        $kategoriPattyCashs = $PembayaranList->jenis_patty_cashs->kategori_patty_cashs->namaKategori;
                        if ($PembayaranList->pivot->idRevTotal == 2) {
                            $totalPembayaran = $PembayaranList->pivot->totalRevisi;
                        }
                        if ($PembayaranList->pivot->idRevQuantity == 2) {
                            $qtyPembayaran = $PembayaranList->pivot->quantityRevisi;
                        }
                        if($qtyPembayaran == 0){
                            continue;
                        }
                        if($totalPembayaran == 0){
                            continue;
                        }
                        if(($kategoriPattyCashs == 'Beban Operasional')||($kategoriPattyCashs == 'Beban Penjualan')||($kategoriPattyCashs == 'Beban Gaji')||($kategoriPattyCashs == 'Beban Marketing')){
                            array_push($pattyCashSesi, (object)[
                                'item' => $PembayaranList->Item,
                                'jenisItem' => $PembayaranList->jenis_patty_cashs->namaJenis,
                                'idSesi' => $idSesi,
                                'total' => $totalPembayaran,
                                'qty' => $qtyPembayaran,
                                'idRevTotal' => $PembayaranList->pivot->idRevTotal,
                                'idRevQty' => $PembayaranList->pivot->idRevQuantity,
                                'satuan' => $PembayaranList->satuans->Satuan,
                            ]);
                        }
                        $dataFound = true;
                    }
                    array_push($pattyCash,(object)[
                        'sesi' => $idSesi,
                        'pattyCash' => $pattyCashSesi,
                        'idPattyHarian' => $PembayaranHarian->id,
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

    public function showEcommerce(Request $request){
        $idOutlet = $request->idOutlet;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('salesharians.listSaless','robotTempECommerces','robotECommerceStatuss.dUsers')->get();
        // @dd($tanggalAll[0]->salesharians);
        $listSaless = listSales::where('butuhVerifikasi', '>', 0)->get();
        $outletAll = doutlet::all();
        if ($idOutlet > 0) {
            $outletAll = $outletAll->where('id', '=', $idOutlet);
        }
        // @dd($outletAll);
        // @dd($listSaless);
        $salesDate = [];
        foreach ($tanggalAll as $eachTanggal) {
            $salesOutlet = [];
            foreach ($outletAll as $eachOutlet) {
                $salesHarians = $eachTanggal->salesharians->where('idOutlet', '=', $eachOutlet->id);
                $robotTempECommerces = $eachTanggal->robotTempECommerces->where('idOutlet', '=', $eachOutlet->id);
                $robotECommerceStatuss = $eachTanggal->robotECommerceStatuss->where('idOutlet','=',$eachOutlet->id);
                $arrayList = [];
                foreach ($listSaless as $listSales) {
                    $listFound = false;
                    $idRevisiTotal = 1;
                    $arrayIdSalesFill = [];
                    $arrayTotal = [];
                    $totalQty = 0;
                    $jumlahDiterima = 0;
                    foreach ($salesHarians as $salesHarian) {
                        $listSalesHarians = $salesHarian->listSaless;
                        foreach ($listSalesHarians as $listSalesHarian) {
                            if ($listSalesHarian->id == $listSales->id) {
                                $listFound = true;
                                $idTotalRevisi = $listSalesHarian->pivot->idRevisiTotal;
                                $idSalesFill = $listSalesHarian->pivot->id;
                                $pelunasanMutasiSaless = pelunasan_mutasi_sales::where('idSalesFill','=',$idSalesFill)->with('mutasiTransaksis')->get();
                                foreach($pelunasanMutasiSaless as $pelunasanMutasiSales){
                                    $jumlahDiterima = $jumlahDiterima + $pelunasanMutasiSales->mutasiTransaksis->total;
                                }
                                $totalQtyTemp = $listSalesHarian->pivot->total;
                                if ($idTotalRevisi == '2') {
                                    $idRevisiTotal = $idTotalRevisi;
                                    $totalQtyTemp = $listSalesHarian->pivot->totalRevisi;
                                }
                                array_push($arrayTotal, $totalQtyTemp);
                                $totalQty = $totalQty + $totalQtyTemp;

                                array_push($arrayIdSalesFill, $listSalesHarian->pivot->id);
                            }
                        }
                    }
                    if ($listFound) {
                        if ($totalQty > 0) {
                            $selisih = $totalQty - $jumlahDiterima;
                            array_push($arrayList, (object)[
                                'idListSales' => $listSales->id,
                                'listSales' => $listSales->sales,
                                'idTotalRevisi' => $idRevisiTotal,
                                'total' => $totalQty,
                                'arrayTotal' => $arrayTotal,
                                'diterima' => $jumlahDiterima,
                                'selisih' => $selisih,
                                'idSalesFill' => $arrayIdSalesFill
                            ]);
                        }
                        // print_r($arrayList);
                    }
                }

                $arrayList2 = [];
                foreach($arrayList as $loopList){
                    //Mengelompokkan gopay dan gofood kedalam satu wadah
                    $idListSalesTemp = $loopList->idListSales;
                    $listSalesTemp = $loopList->listSales;
                    $totalTemp = $loopList->total;
                    $idTotalRevisiTemp = $loopList->idTotalRevisi;
                    $diterimaTemp = $loopList->diterima;
                    $arrayTotalTemp = [];
                    $idSalesFillTemp = [];

                    foreach($loopList->arrayTotal as $loopArrayTotal){
                        // $loopList->arrayTotal
                        array_push($arrayTotalTemp, $loopArrayTotal);
                    }

                    foreach($loopList->idSalesFill as $loopArrayIdSalesFill){
                        array_push($idSalesFillTemp, $loopArrayIdSalesFill);
                    }
                    
                    if($loopList->idListSales == 6){
                        //ID 6 merupakan ID goFood
                        foreach($arrayList as $loopList2){
                            //Cari yang memiliki ID 16 atau gopay
                            if($loopList2->idListSales == 16){
                                $listSalesTemp .= ' / ';
                                $listSalesTemp .= $loopList2->listSales;
                                $totalTemp = $totalTemp + $loopList2->total;
                                $diterimaTemp = $diterimaTemp + $loopList2->diterima;

                                foreach($loopList2->arrayTotal as $loopArrayTotal2){
                                    // $loopList->arrayTotal
                                    array_push($arrayTotalTemp, $loopArrayTotal2);
                                }
            
                                foreach($loopList2->idSalesFill as $loopArrayIdSalesFill2){
                                    array_push($idSalesFillTemp, $loopArrayIdSalesFill2);
                                }

                                if($loopList2->idTotalRevisi == 2){
                                    $idTotalRevisiTemp = 2;
                                }
                            }
                        }
                    }
                    else if($loopList->idListSales == 7){
                        //ID 6 merupakan ID grab food
                        foreach($arrayList as $loopList2){
                            //Cari yang memiliki ID 17 atau ovo
                            if($loopList2->idListSales == 17){
                                $listSalesTemp .= ' / ';
                                $listSalesTemp .= $loopList2->listSales;
                                $totalTemp = $totalTemp + $loopList2->total;
                                $diterimaTemp = $diterimaTemp + $loopList2->diterima;

                                foreach($loopList2->arrayTotal as $loopArrayTotal2){
                                    // $loopList->arrayTotal
                                    array_push($arrayTotalTemp, $loopArrayTotal2);
                                }
            
                                foreach($loopList2->idSalesFill as $loopArrayIdSalesFill2){
                                    array_push($idSalesFillTemp, $loopArrayIdSalesFill2);
                                }

                                if($loopList2->idTotalRevisi == 2){
                                    $idTotalRevisiTemp = 2;
                                }
                            }
                        }
                    }
                    else if($loopList->idListSales == 16){
                        //ID 16 merupakan ID gopay
                        continue;
                    }
                    else if($loopList->idListSales == 17){
                        //ID 17 merupakan ID ovo
                        continue;
                    }
                    $robotQty = 0;
                    foreach($robotTempECommerces as $robotTempECommerce){
                        if($loopList->idListSales == $robotTempECommerce->idListSales){
                            $robotQty = $robotTempECommerce->total;
                            break;
                        }
                    }
                    $selisih = $totalTemp - $diterimaTemp;
                    array_push($arrayList2, (object)[
                        'idListSales' => $idListSalesTemp,
                        'listSales' => $listSalesTemp,
                        'idTotalRevisi' => $idTotalRevisiTemp,
                        'total' => $totalTemp,
                        'arrayTotal' => $arrayTotalTemp,
                        'diterima' => $diterimaTemp,
                        'selisih' => $selisih,
                        'idSalesFill' => $idSalesFillTemp,
                        'robotQty' => $robotQty
                    ]);
                }
                $dataRobot = [];
                foreach($robotECommerceStatuss as $robotECommerceStatus){
                    array_push($dataRobot,(object)[
                        'id' => $robotECommerceStatus->id,
                        'user' => $robotECommerceStatus->dUsers['Nama Lengkap'],
                        'status' => $robotECommerceStatus->statusRobots->status
                    ]);
                }
                array_push($salesOutlet, (object)[
                    'outlet' => $eachOutlet['Nama Store'],
                    'idOutlet' => $eachOutlet->id,
                    'data' => $arrayList2,
                    'dataRobot' => $dataRobot
                ]);
                // @dd($salesHarian);
            }
            array_push($salesDate, (object)[
                'Tanggal' => $eachTanggal->Tanggal,
                'idTanggal' => $eachTanggal->id,
                'data' => $salesOutlet
            ]);
        }
        // salesHarian;
        return response()->json([
            // 'countItem' => $datasales->count(),
            'itemSales' => $salesDate
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

    public function createRobotPembayaran(Request $request){
        $idPattyHarian = $request->idPattyHarian;
        $idPemverifikasi = $request->idPemverifikasi;

        robot_pembayaran_status::create([
            'idPattyCashHarian' => $idPattyHarian,
            'idPemverifikasi' => $idPemverifikasi,
            'idStatusRobot' => '1'
        ]);
    }

    public function createRobotEcommerce(Request $request){
        $dataArray = $request->input('data');
        $idPemverifikasi = $dataArray['idPemverifikasi'];

        $dataParse = $dataArray['data'];
        $idOutlet = $dataParse['idOutlet'];
        $idTanggal = $dataParse['idTanggal'];
        $datas = $dataParse['data'];

        foreach($datas as $data){
            $idListSales = $data['idListSales'];
            $bebanECommerce = $data['beban'];
            print_r($data);

            $robotTempECommerce = new robot_temp_e_commerce();
            $robotTempECommerce->idOutlet = $idOutlet;
            $robotTempECommerce->idTanggal = $idTanggal;
            $robotTempECommerce->idListSales = $idListSales;
            $robotTempECommerce->total = $bebanECommerce;
            $robotTempECommerce->save();
        }
        $robotECommerceStatus = new robot_ecommerce_status();
        $robotECommerceStatus->idOutlet = $idOutlet;
        $robotECommerceStatus->idTanggal = $idTanggal;
        $robotECommerceStatus->idPemverifikasi = $idPemverifikasi;
        $robotECommerceStatus->idStatusRobot = '1';
        $robotECommerceStatus->save();
    }

    public function doneRobotPembelian($id){
        $robot_pembelian_status = robot_pembelian_status::find($id);
        $robot_pembelian_status->update([
            'idStatusRobot' => '2'
        ]);
        // @dd($robot_pembelian_status);
    }

    public function doneRobotPembayaran($id){
        $robot_pembayaran_status = robot_pembayaran_status::find($id);
        $robot_pembayaran_status->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function doneRobotECommerce($id){
        $robot_ecommerce_status = robot_ecommerce_status::find($id);
        $robot_ecommerce_status->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function deleteRobotPembelian(Request $request){
        robot_pembelian_status::find($request->idRobotPembelianStatus)->delete();
    }

    public function deleteRobotPembayaran(Request $request){
        robot_pembayaran_status::find($request->idRobotPembayaranStatus)->delete();
    }
    public function deleteRobotEcommerce(Request $request){
        $idRobotEcommerceStatus = $request->idRobotEcommerceStatus;

        $robotECommerceStatus = robot_ecommerce_status::find($idRobotEcommerceStatus);
        $idTanggal = $robotECommerceStatus->idTanggal;
        $idOutlet = $robotECommerceStatus->idOutlet;

        $robotTempECommerces = robot_temp_e_commerce::where('idTanggal','=',$idTanggal)->get();
        if($robotTempECommerces->count() > 0){
            $robotTempECommerces = $robotTempECommerces->where('idOutlet','=',$idOutlet);
            if($robotTempECommerces->count() > 0){
                foreach($robotTempECommerces as $robotTempECommerce){
                    $robotTempECommerce->delete();
                }
            }
        }
        $robotECommerceStatus->delete();
    }
}
