<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\listSales;
use App\Models\mutasi_transaksi;
use App\Models\pattyCashFill;
use App\Models\pattyCashHarian;
use App\Models\pelunasan_mutasi_sales;
use App\Models\robot_165_pindah_saldo_status;
use App\Models\robot_ecommerce_status;
use App\Models\robot_mutasi1003_setoran_status;
use App\Models\robot_mutasi165_reimburse_status;
use App\Models\robot_mutasi455tfkas_penerimaan_status;
use App\Models\robot_mutasi455tfkas_status;
use App\Models\robot_pembayaran_status;
use App\Models\robot_pembelian_status;
use App\Models\robot_temp_e_commerce;
use App\Models\robot_mutasi455_pembayaran_status;
use App\Models\robot_165_pembayaran;
use App\Models\tanggalAll;
use Illuminate\Http\Request;

class robotController extends Controller
{
    //
    public function showRobotPembelian()
    {
        $robotPembelianStatuss = robot_pembelian_status::where('idStatusRobot', '=', '1')->get()->first();
        $arrayPatty = [];
        $listPattys = $robotPembelianStatuss->pattyCashHarians->listItemPattyCashs;
        $tanggal = $robotPembelianStatuss->pattyCashHarians->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));
        $keywoard = $robotPembelianStatuss->pattyCashHarians->dOutlets->keywoardBee;
        $termin = $robotPembelianStatuss->pattyCashHarians->dOutlets->terminBee;
        $cabang = $robotPembelianStatuss->pattyCashHarians->dOutlets->cabangBee;
        $gudang = $robotPembelianStatuss->pattyCashHarians->dOutlets->gudangBee;
        $notes = '';

        foreach ($listPattys as $listPatty) {
            $qty = $listPatty->pivot->quantity;
            $total = $listPatty->pivot->total;
            if ($listPatty->pivot->idRevQuantity == '2') {
                $qty = $listPatty->pivot->quantityRevisi;
            }
            if ($listPatty->pivot->idRevTotal == '2') {
                $total = $listPatty->pivot->totalRevisi;
            }
            if (($qty == 0) || ($total == 0)) {
                continue;
            }
            $hargaSatuan = $total / $qty;
            if ($listPatty->jenis_patty_cashs->namaJenis == 'HPP') {
                array_push($arrayPatty, (object)[
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

    public function showRobotPembayaran()
    {
        $robotPembayaranStatuss = robot_pembayaran_status::where('idStatusRobot', '=', '1')->get()->first();
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

        foreach ($listPattys as $listPatty) {
            $kategoriPattyCashs = $listPatty->jenis_patty_cashs->kategori_patty_cashs->namaKategori;
            $qty = $listPatty->pivot->quantity;
            $total = $listPatty->pivot->total;
            if ($listPatty->pivot->idRevQuantity == '2') {
                $qty = $listPatty->pivot->quantityRevisi;
            }
            if ($listPatty->pivot->idRevTotal == '2') {
                $total = $listPatty->pivot->totalRevisi;
            }
            if (($qty == 0) || ($total == 0)) {
                continue;
            }
            $hargaSatuan = $total / $qty;
            if (($kategoriPattyCashs == 'Beban Operasional') || ($kategoriPattyCashs == 'Beban Penjualan') || ($kategoriPattyCashs == 'Beban Gaji') || ($kategoriPattyCashs == 'Beban Marketing')) {
                $notes = '';
                $notes .= $listPatty->Item;
                $notes .= ' ';
                $notes .= $qty;
                $notes .= ' ';
                $notes .= $listPatty->satuans->Satuan;
                array_push($arrayPatty, (object)[
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

    public function showRobotECommerce()
    {
        $robotECommerceStatus = robot_ecommerce_status::where('idStatusRobot', '=', '1')->get()->first();
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

        $robotTempECommerces = robot_temp_e_commerce::where('idOutlet', '=', $idOutlet)->get();
        if ($robotTempECommerces->count() > 0) {
            $robotTempECommerces = $robotTempECommerces->where('idTanggal', '=', $idTanggal);
            if ($robotTempECommerces->count() > 0) {
                foreach ($robotTempECommerces as $eachTempECommerce) {
                    $totalECommerce = $totalECommerce + $eachTempECommerce->total;
                    array_push($data, (object)[
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

    public function showRobotMutasi455TfKas()
    {
        $robotMutasi455TfKas = robot_mutasi455tfkas_status::where('idStatusRobot', '=', '1')->get()->first();
        $pelunasanMutasiSales = $robotMutasi455TfKas->pelunasanMutasiSaless;
        $mutasiTransaksi = $pelunasanMutasiSales->mutasiTransaksis;

        $keterangan = $mutasiTransaksi->trxNotes;
        $tanggal = $mutasiTransaksi->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));

        $total = $mutasiTransaksi->total;

        $kasAsalKeywoard = '0455';
        $kasTujuanKeywoard = '0455';

        $kasAsal = 'IDR - BCA CS 0455';
        $kasTujuan = 'IDR - BCA CS 0455';

        $cabang = $pelunasanMutasiSales->salesFills->salesHarians->dOutlets->cabangBee;
        $cabangKeywoard = $pelunasanMutasiSales->salesFills->salesHarians->dOutlets->keywoardBee;

        $listSalesKeywoard = $pelunasanMutasiSales->salesFills->listSaless->keywoardBee;
        $listSales = $pelunasanMutasiSales->salesFills->listSaless->itemBee;

        if ($total < 0) {
            //Termasuk kolom kredit
            $total = $total * (-1);

            $kasTujuan = 'IDR - ';
            $kasTujuan .= $listSales;

            $kasTujuanKeywoard = $listSalesKeywoard;
        } else {
            //Termasuk kolom debit
            $kasAsal = 'IDR - ';
            $kasAsal .= $listSales;

            $kasAsalKeywoard = $listSalesKeywoard;
        }

        return response()->json([
            'idRobotMutasi455TfKas' => $robotMutasi455TfKas->id,
            'Tanggal' => $tanggalDDmmYY,
            'kasAsalKeywoard' => $kasAsalKeywoard,
            'kasAsal' => $kasAsal,
            'kasTujuanKeywoard' => $kasTujuanKeywoard,
            'kasTujuan' => $kasTujuan,
            'keterangan' => $keterangan,
            'total' => $total,
            'cabangKeywoard' => $cabangKeywoard,
            'cabang' => $cabang
        ]);
    }

    public function showRobotMutasi455TfKasPenerimaan()
    {
        $robotMutasi455TfKasPenerimaan = robot_mutasi455tfkas_penerimaan_status::where('idStatusRobot', '=', '1')->get()->first();
        $pelunasanMutasiSales = $robotMutasi455TfKasPenerimaan->pelunasanMutasiSaless;
        $mutasiTransaksi = $pelunasanMutasiSales->mutasiTransaksis;

        $keterangan = $mutasiTransaksi->trxNotes;
        $tanggal = $mutasiTransaksi->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));

        $total = $mutasiTransaksi->total;

        $cabangKeywoard = 'lazizaa';
        $cabang = 'PT. Lazizaa Rahmat Semesta';

        $kodeAkun = '250.2041';

        $kasKeywoard = '0455';
        $kas = 'BCA CS 0455';

        return response()->json([
            'idRobotMutasi455TfKasPenerimaan' => $robotMutasi455TfKasPenerimaan->id,
            'Tanggal' => $tanggalDDmmYY,
            'kodeAkun' => $kodeAkun,
            'kasKeywoard' => $kasKeywoard,
            'kas' => $kas,
            'keterangan' => $keterangan,
            'total' => $total,
            'cabangKeywoard' => $cabangKeywoard,
            'cabang' => $cabang
        ]);
    }

    public function showRobotMutasi455Pembayaran()
    {
        $robotMutasi455Pembayaran = robot_mutasi455_pembayaran_status::where('idStatusRobot', '=', '1')->get()->first();
        $mutasiTransaksi = $robotMutasi455Pembayaran->mutasiTransaksis;

        $keterangan = $mutasiTransaksi->trxNotes;
        $tanggal = $mutasiTransaksi->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));

        $total = (-1) * $mutasiTransaksi->total;

        $cabangKeywoard = 'lazizaa';
        $cabang = 'PT. Lazizaa Rahmat Semesta';

        $kodeAkun = '250.2041';

        $kasKeywoard = '0455';
        $kas = 'BCA CS 0455';

        return response()->json([
            'idRobotMutasi455Pembayaran' => $robotMutasi455Pembayaran->id,
            'Tanggal' => $tanggalDDmmYY,
            'kodeAkun' => $kodeAkun,
            'kasKeywoard' => $kasKeywoard,
            'kas' => $kas,
            'keterangan' => $keterangan,
            'total' => $total,
            'cabangKeywoard' => $cabangKeywoard,
            'cabang' => $cabang
        ]);
    }

    public function showRobotMutasi1003()
    {
        $robotMutasi1003 = robot_mutasi1003_setoran_status::where('idStatusRobot', '=', '1')->get()->first();
        $mutasiSetoran = $robotMutasi1003->mutasiSetorans;
        // @dd($mutasiSetoran);

        $mutasiTransaksi = $mutasiSetoran->mutasiTransaksis;

        $keterangan = $mutasiTransaksi->trxNotes;
        $tanggal = $mutasiTransaksi->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));

        $total = $mutasiTransaksi->total;

        $kasTujuanKeywoard = 'setoran';
        $kasTujuan = 'IDR - BCA Setoran Sales';

        // @dd($mutasiSetoran->setorans);
        $cabang = $mutasiSetoran->setorans->dOutlets->cabangBee;
        $cabangKeywoard = $mutasiSetoran->setorans->dOutlets->keywoardBee;

        if ($total < 0) {
            //Termasuk kolom kredit
            $total = $total * (-1);
        }

        $kasAsalKeywoard = $mutasiSetoran->setorans->dOutlets->keywoardBee;
        $kasAsal = $mutasiSetoran->setorans->dOutlets->kasSalesBee;

        return response()->json([
            'idRobotMutasi1003' => $robotMutasi1003->id,
            'Tanggal' => $tanggalDDmmYY,
            'kasAsalKeywoard' => $kasAsalKeywoard,
            'kasAsal' => $kasAsal,
            'kasTujuanKeywoard' => $kasTujuanKeywoard,
            'kasTujuan' => $kasTujuan,
            'keterangan' => $keterangan,
            'total' => $total,
            'cabangKeywoard' => $cabangKeywoard,
            'cabang' => $cabang
        ]);
    }

    public function showRobotReimburse165()
    {
        $robotMutasi165 = robot_mutasi165_reimburse_status::where('idStatusRobot', '=', '1')->get()->first();
        $mutasiReimburse = $robotMutasi165->mutasiReimburses;

        $mutasiTransaksi = $mutasiReimburse->mutasiTransaksis;

        $keterangan = $mutasiTransaksi->trxNotes;
        $tanggal = $mutasiTransaksi->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));

        $total = (-1) * $mutasiTransaksi->total;

        $kasAsalKeywoard = '0165';
        $kasAsal = 'IDR - BCA Bisnis 0165';

        // @dd($mutasiReimburse->penerimaReimburses->reimburses);
        $cabang = $mutasiReimburse->penerimaReimburses->reimburses->dOutlets->cabangBee;
        $cabangKeywoard = $mutasiReimburse->penerimaReimburses->reimburses->dOutlets->keywoardBee;

        if ($total < 0) {
            //Termasuk kolom kredit
            $total = $total * (-1);
        }

        $kasTujuanKeywoard = $mutasiReimburse->penerimaReimburses->reimburses->dOutlets->keywoardBee;
        $kasTujuan = $mutasiReimburse->penerimaReimburses->reimburses->dOutlets->terminBee;

        return response()->json([
            'idRobotMutasi165' => $robotMutasi165->id,
            'Tanggal' => $tanggalDDmmYY,
            'kasAsalKeywoard' => $kasAsalKeywoard,
            'kasAsal' => $kasAsal,
            'kasTujuanKeywoard' => $kasTujuanKeywoard,
            'kasTujuan' => $kasTujuan,
            'keterangan' => $keterangan,
            'total' => $total,
            'cabangKeywoard' => $cabangKeywoard,
            'cabang' => $cabang
        ]);
    }

    public function showRobotMutasi165PindahSaldo(){
        $robotMutasi165 = robot_165_pindah_saldo_status::where('idStatusRobot', '=', '1')->get()->first();
        $mutasiDetail = $robotMutasi165->mutasiDetails;

        $mutasiTransaksi = $mutasiDetail->mutasiTransaksis;

        $keterangan = $mutasiTransaksi->trxNotes;
        $tanggal = $mutasiTransaksi->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));

        $total = $mutasiTransaksi->total;

        $kasTujuanKeywoard = '0165';
        $kasTujuan = 'IDR - BCA Bisnis 0165';

        // @dd($mutasiReimburse->penerimaReimburses->reimburses);
        $cabangKeywoard = 'lazizaa';
        $cabang = 'PT. Lazizaa Rahmat Semesta';

        if ($total < 0) {
            //Termasuk kolom kredit
            $total = $total * (-1);
        }

        $kasAsal = '';
        $kasAsalKeywoard = '';

        if ($mutasiDetail->idMutasiKlasifikasi == 11) {
            //Jika id mutasi merupakan pindah saldo dari 1003 maka
            $kasAsal = 'IDR - BCA Setoran Sales';
            $kasAsalKeywoard = 'setoran';
        }
        if ($mutasiDetail->idMutasiKlasifikasi == 12) {
            //Jika id mutasi merupakan pindah saldo dari 0455 maka
            $kasAsal = 'IDR - BCA CS 0455';
            $kasAsalKeywoard = '0455';
        }

        return response()->json([
            'idRobotMutasi165' => $robotMutasi165->id,
            'Tanggal' => $tanggalDDmmYY,
            'kasAsalKeywoard' => $kasAsalKeywoard,
            'kasAsal' => $kasAsal,
            'kasTujuanKeywoard' => $kasTujuanKeywoard,
            'kasTujuan' => $kasTujuan,
            'keterangan' => $keterangan,
            'total' => $total,
            'cabangKeywoard' => $cabangKeywoard,
            'cabang' => $cabang
        ]);
    }

    public function showRobotPembayaran165(){
        $robot165Pembayaran = robot_165_pembayaran::where('idStatusRobot', '=', '1')->get()->first();
        $mutasiPembayaran = $robot165Pembayaran->mutasiPembayaran;
        $mutasiDetail = $mutasiPembayaran->mutasiDetail;
        $mutasiTransaksi = $mutasiDetail->mutasiTransaksis;

        $arrayPatty = [];
        $listPatty = $mutasiPembayaran->listItemPattyCash;
        $tanggal = $mutasiTransaksi->tanggalAlls->Tanggal;
        $tanggalDDmmYY = date('d-m-Y', strtotime($tanggal));
        $keywoard = $mutasiDetail->dOutlets->keywoardBee;
        // $termin = $mutasiDetail->dOutlets->terminBee;
        $cabang = $mutasiDetail->dOutlets->cabangBee;
        // $gudang = $mutasiDetail->dOutlets->gudangBee;
        // $kas = $mutasiDetail->dOutlets->kasBee;
        $keterangan = $mutasiTransaksi->trxNotes;
        $total = (-1)*$mutasiTransaksi->total;

        array_push($arrayPatty, (object)[
            'kodeAkun' => $listPatty->jenis_patty_cashs->kodeAkun,
            'namaItem' => $listPatty->Item,
            'total' => $total,
        ]);
        return response()->json([
            'Tanggal' => $tanggalDDmmYY,
            'keywoard' => $keywoard,
            'cabang' => $cabang,
            'idRobot165Pembayaran' => $robot165Pembayaran->id,
            'Data'  => $arrayPatty,
            'Keterangan' => $keterangan,
            'kas' => 'BCA Bisnis 0165',
            'kasKeywoard' => '0165'
        ]);
    }

    public function showPembelian(Request $request)
    {
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
                    foreach ($robotPembelians as $robotPembelian) {
                        array_push($dataRobot, (object)[
                            'idRobotList' => $robotPembelian->id,
                            'user' => $robotPembelian->dUsers['Nama Lengkap'],
                            'status' => $robotPembelian->statusRobots->status
                        ]);
                    }

                    foreach ($pembelianLists as $pembelianList) {
                        $qtyPembelian = $pembelianList->pivot->quantity;
                        $totalPembelian = $pembelianList->pivot->total;

                        $robotQtyPembelian = $pembelianList->pivot->quantityRobot;
                        $robotTotalPembelian = $pembelianList->pivot->totalRobot;

                        if ($pembelianList->pivot->idRevTotal == 2) {
                            $totalPembelian = $pembelianList->pivot->totalRevisi;
                        }
                        if ($pembelianList->pivot->idRevQuantity == 2) {
                            $qtyPembelian = $pembelianList->pivot->quantityRevisi;
                        }

                        if (($robotQtyPembelian == 0) && ($robotTotalPembelian == 0)) {
                            if ($qtyPembelian == 0) {
                                continue;
                            }
                            if ($totalPembelian == 0) {
                                continue;
                            }
                        }
                        if ($pembelianList->jenis_patty_cashs->namaJenis == 'HPP') {
                            array_push($pattyCashSesi, (object)[
                                'item' => $pembelianList->Item,
                                'jenisItem' => $pembelianList->jenis_patty_cashs->namaJenis,
                                'idSesi' => $idSesi,
                                'total' => $totalPembelian,
                                'qty' => $qtyPembelian,
                                'idRevTotal' => $pembelianList->pivot->idRevTotal,
                                'idRevQty' => $pembelianList->pivot->idRevQuantity,
                                'satuan' => $pembelianList->satuans->Satuan,
                                'qtyRobot' => $robotQtyPembelian,
                                'totalRobot' => $robotTotalPembelian
                            ]);
                        }
                        $dataFound = true;
                    }
                    array_push($pattyCash, (object)[
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

    public function showPembayaran(Request $request)
    {
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
                    foreach ($robotPembayarans as $robotPembayaran) {
                        array_push($dataRobot, (object)[
                            'idRobotList' => $robotPembayaran->id,
                            'user' => $robotPembayaran->dUsers['Nama Lengkap'],
                            'status' => $robotPembayaran->statusRobots->status
                        ]);
                    }

                    foreach ($PembayaranLists as $PembayaranList) {
                        $qtyPembayaran = $PembayaranList->pivot->quantity;
                        $totalPembayaran = $PembayaranList->pivot->total;
                        $kategoriPattyCashs = $PembayaranList->jenis_patty_cashs->kategori_patty_cashs->namaKategori;

                        $qtyRobot = $PembayaranList->pivot->quantityRobot;
                        $totalRobot = $PembayaranList->pivot->totalRobot;


                        if ($PembayaranList->pivot->idRevTotal == 2) {
                            $totalPembayaran = $PembayaranList->pivot->totalRevisi;
                        }
                        if ($PembayaranList->pivot->idRevQuantity == 2) {
                            $qtyPembayaran = $PembayaranList->pivot->quantityRevisi;
                        }

                        if (($qtyRobot == 0) && ($totalRobot == 0)) {
                            if ($qtyPembayaran == 0) {
                                continue;
                            }
                            if ($totalPembayaran == 0) {
                                continue;
                            }
                        }
                        if (($kategoriPattyCashs == 'Beban Operasional') || ($kategoriPattyCashs == 'Beban Penjualan') || ($kategoriPattyCashs == 'Beban Gaji') || ($kategoriPattyCashs == 'Beban Marketing')) {
                            array_push($pattyCashSesi, (object)[
                                'item' => $PembayaranList->Item,
                                'jenisItem' => $PembayaranList->jenis_patty_cashs->namaJenis,
                                'idSesi' => $idSesi,
                                'total' => $totalPembayaran,
                                'qty' => $qtyPembayaran,
                                'idRevTotal' => $PembayaranList->pivot->idRevTotal,
                                'idRevQty' => $PembayaranList->pivot->idRevQuantity,
                                'satuan' => $PembayaranList->satuans->Satuan,
                                'qtyRobot' => $qtyRobot,
                                'totalRobot' => $totalRobot
                            ]);
                        }
                        $dataFound = true;
                    }
                    array_push($pattyCash, (object)[
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

    public function showEcommerce(Request $request)
    {
        $idOutlet = $request->idOutlet;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('salesharians.listSaless', 'robotTempECommerces', 'robotECommerceStatuss.dUsers')->get();
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
                $robotECommerceStatuss = $eachTanggal->robotECommerceStatuss->where('idOutlet', '=', $eachOutlet->id);
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
                                $pelunasanMutasiSaless = pelunasan_mutasi_sales::where('idSalesFill', '=', $idSalesFill)->with('mutasiTransaksis')->get();
                                foreach ($pelunasanMutasiSaless as $pelunasanMutasiSales) {
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
                $gofoodFound = false;
                $grabfoodFound = false;
                foreach ($arrayList as $loopList) {
                    //Mengelompokkan gopay dan gofood kedalam satu wadah
                    $idListSalesTemp = $loopList->idListSales;
                    $listSalesTemp = $loopList->listSales;
                    $totalTemp = $loopList->total;
                    $idTotalRevisiTemp = $loopList->idTotalRevisi;
                    $diterimaTemp = $loopList->diterima;
                    $arrayTotalTemp = [];
                    $idSalesFillTemp = [];

                    foreach ($loopList->arrayTotal as $loopArrayTotal) {
                        // $loopList->arrayTotal
                        array_push($arrayTotalTemp, $loopArrayTotal);
                    }

                    foreach ($loopList->idSalesFill as $loopArrayIdSalesFill) {
                        array_push($idSalesFillTemp, $loopArrayIdSalesFill);
                    }

                    if ($loopList->idListSales == 6) {
                        //ID 6 merupakan ID goFood
                        foreach ($arrayList as $loopList2) {
                            //Cari yang memiliki ID 16 atau gopay
                            if ($loopList2->idListSales == 16) {
                                $gofoodFound = true;
                                $listSalesTemp .= ' / ';
                                $listSalesTemp .= $loopList2->listSales;
                                $totalTemp = $totalTemp + $loopList2->total;
                                $diterimaTemp = $diterimaTemp + $loopList2->diterima;

                                foreach ($loopList2->arrayTotal as $loopArrayTotal2) {
                                    // $loopList->arrayTotal
                                    array_push($arrayTotalTemp, $loopArrayTotal2);
                                }

                                foreach ($loopList2->idSalesFill as $loopArrayIdSalesFill2) {
                                    array_push($idSalesFillTemp, $loopArrayIdSalesFill2);
                                }

                                if ($loopList2->idTotalRevisi == 2) {
                                    $idTotalRevisiTemp = 2;
                                }
                            }
                        }
                    } else if ($loopList->idListSales == 7) {
                        //ID 6 merupakan ID grab food
                        foreach ($arrayList as $loopList2) {
                            //Cari yang memiliki ID 17 atau ovo
                            if ($loopList2->idListSales == 17) {
                                $grabfoodFound = true;
                                $listSalesTemp .= ' / ';
                                $listSalesTemp .= $loopList2->listSales;
                                $totalTemp = $totalTemp + $loopList2->total;
                                $diterimaTemp = $diterimaTemp + $loopList2->diterima;

                                foreach ($loopList2->arrayTotal as $loopArrayTotal2) {
                                    // $loopList->arrayTotal
                                    array_push($arrayTotalTemp, $loopArrayTotal2);
                                }

                                foreach ($loopList2->idSalesFill as $loopArrayIdSalesFill2) {
                                    array_push($idSalesFillTemp, $loopArrayIdSalesFill2);
                                }

                                if ($loopList2->idTotalRevisi == 2) {
                                    $idTotalRevisiTemp = 2;
                                }
                            }
                        }
                    } else if ($loopList->idListSales == 16) {
                        //ID 16 merupakan ID gopay
                        if ($gofoodFound) {
                            continue;
                        }
                    } else if ($loopList->idListSales == 17) {
                        //ID 17 merupakan ID ovo
                        if ($grabfoodFound) {
                            continue;
                        }
                    }
                    $robotQty = 0;
                    foreach ($robotTempECommerces as $robotTempECommerce) {
                        if ($loopList->idListSales == $robotTempECommerce->idListSales) {
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
                foreach ($robotECommerceStatuss as $robotECommerceStatus) {
                    array_push($dataRobot, (object)[
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

    public function showMutasi455TfKas(Request $request)
    {
        $idPenerima = $request->idPenerima;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('mutasiTransaksis.pelunasanMutasiSaless.salesFills.salesHarians.dOutlets', 'mutasiTransaksis.pelunasanMutasiSaless.salesFills.listSaless')->get();
        $dataMutasi = [];

        foreach ($tanggalAll as $loopTanggal) {
            $tanggalDDmmYY = date('d/m/Y', strtotime($loopTanggal->Tanggal));
            $mutasiTransaksis = $loopTanggal->mutasiTransaksis->where('idPenerimaList', '=', $idPenerima);
            foreach ($mutasiTransaksis as $loopMutasi) {
                $pelunasanMutasiSaless = $loopMutasi->pelunasanMutasiSaless;
                if ($pelunasanMutasiSaless != null) {
                    $kredit = 0;
                    $debit = 0;
                    $dataRobot = [];
                    $robotMutasi455TfKas = $pelunasanMutasiSaless->robotMutasi455TfKasStatus;
                    if ($loopMutasi->total > 0) {
                        $debit = $loopMutasi->total;
                    } else {
                        $kredit = (-1) * $loopMutasi->total;
                    }
                    foreach ($robotMutasi455TfKas as $loopMutasiRobot) {
                        array_push($dataRobot, (object)[
                            'id' => $loopMutasiRobot->id,
                            'idStatus' => $loopMutasiRobot->statusRobots->id,
                            'status' => $loopMutasiRobot->statusRobots->status,
                            'perevisi' => $loopMutasiRobot->dUsers['Nama Lengkap']
                        ]);
                    }
                    //Jika merupakan manajemen sukodono, tidak perlu ditampilkan di robot karena merupakan bagian penerimaan pembayaran
                    if ($pelunasanMutasiSaless->salesFills->salesHarians->dOutlets->id == 17) {
                        continue;
                    }
                    array_push($dataMutasi, (object)[
                        'id' => $pelunasanMutasiSaless->id,
                        'tanggal' => $tanggalDDmmYY,
                        'klasifikasi' => $pelunasanMutasiSaless->salesFills->listSaless['sales'],
                        'cabang' => $pelunasanMutasiSaless->salesFills->salesHarians->dOutlets['Nama Store'],
                        'kredit' => $kredit,
                        'debit' => $debit,
                        'keterangan' => $loopMutasi->trxNotes,
                        'dataRobot' => $dataRobot
                    ]);
                }
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'data' => $dataMutasi
        ]);
    }

    public function showMutasi455TfKasPenerimaan(Request $request)
    {
        $idPenerima = $request->idPenerima;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('mutasiTransaksis.pelunasanMutasiSaless.salesFills.salesHarians.dOutlets', 'mutasiTransaksis.pelunasanMutasiSaless.salesFills.listSaless')->get();
        $dataMutasi = [];

        foreach ($tanggalAll as $loopTanggal) {
            $tanggalDDmmYY = date('d/m/Y', strtotime($loopTanggal->Tanggal));
            $mutasiTransaksis = $loopTanggal->mutasiTransaksis->where('idPenerimaList', '=', $idPenerima);
            foreach ($mutasiTransaksis as $loopMutasi) {
                $pelunasanMutasiSaless = $loopMutasi->pelunasanMutasiSaless;
                if ($pelunasanMutasiSaless != null) {
                    $kredit = 0;
                    $debit = 0;
                    $dataRobot = [];
                    $robotMutasi455TfKasPenerimaan = $pelunasanMutasiSaless->robotMutasi455TfKasPenerimaanStatus;
                    if ($loopMutasi->total > 0) {
                        $debit = $loopMutasi->total;
                    } else {
                        $kredit = (-1) * $loopMutasi->total;
                    }
                    foreach ($robotMutasi455TfKasPenerimaan as $loopMutasiRobot) {
                        array_push($dataRobot, (object)[
                            'id' => $loopMutasiRobot->id,
                            'idStatus' => $loopMutasiRobot->statusRobots->id,
                            'status' => $loopMutasiRobot->statusRobots->status,
                            'perevisi' => $loopMutasiRobot->dUsers['Nama Lengkap']
                        ]);
                    }
                    //Hanya tampilkan yang sukodono saja
                    if ($pelunasanMutasiSaless->salesFills->salesHarians->dOutlets->id != 17) {
                        continue;
                    }
                    array_push($dataMutasi, (object)[
                        'id' => $pelunasanMutasiSaless->id,
                        'tanggal' => $tanggalDDmmYY,
                        'klasifikasi' => $pelunasanMutasiSaless->salesFills->listSaless['sales'],
                        'cabang' => $pelunasanMutasiSaless->salesFills->salesHarians->dOutlets['Nama Store'],
                        'kredit' => $kredit,
                        'debit' => $debit,
                        'keterangan' => $loopMutasi->trxNotes,
                        'dataRobot' => $dataRobot
                    ]);
                }
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'data' => $dataMutasi
        ]);
    }

    public function showMutasi455TfKasSukodono(Request $request)
    {
        $idPenerima = $request->idPenerima;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('mutasiTransaksis.pelunasanMutasiSaless.salesFills.salesHarians.dOutlets', 'mutasiTransaksis.pelunasanMutasiSaless.salesFills.listSaless')->get();
        $dataMutasi = [];

        foreach ($tanggalAll as $loopTanggal) {
            $tanggalDDmmYY = date('d/m/Y', strtotime($loopTanggal->Tanggal));
            $mutasiTransaksis = $loopTanggal->mutasiTransaksis->where('idPenerimaList', '=', $idPenerima);
            foreach ($mutasiTransaksis as $loopMutasi) {
                $pelunasanMutasiSaless = $loopMutasi->pelunasanMutasiSaless;
                if ($pelunasanMutasiSaless != null) {
                    $kredit = 0;
                    $debit = 0;
                    $dataRobot = [];
                    $robotMutasi455TfKas = $pelunasanMutasiSaless->robotMutasi455TfKasStatus;
                    if ($loopMutasi->total > 0) {
                        $debit = $loopMutasi->total;
                    } else {
                        $kredit = (-1) * $loopMutasi->total;
                    }
                    foreach ($robotMutasi455TfKas as $loopMutasiRobot) {
                        array_push($dataRobot, (object)[
                            'id' => $loopMutasiRobot->id,
                            'idStatus' => $loopMutasiRobot->statusRobots->id,
                            'status' => $loopMutasiRobot->statusRobots->status,
                            'perevisi' => $loopMutasiRobot->dUsers['Nama Lengkap']
                        ]);
                    }
                    //Jika merupakan manajemen sukodono, tidak perlu ditampilkan di robot karena merupakan bagian penerimaan pembayaran
                    if ($pelunasanMutasiSaless->salesFills->salesHarians->dOutlets->id == 17) {
                        continue;
                    }
                    array_push($dataMutasi, (object)[
                        'id' => $pelunasanMutasiSaless->id,
                        'tanggal' => $tanggalDDmmYY,
                        'klasifikasi' => $pelunasanMutasiSaless->salesFills->listSaless['sales'],
                        'cabang' => $pelunasanMutasiSaless->salesFills->salesHarians->dOutlets['Nama Store'],
                        'kredit' => $kredit,
                        'debit' => $debit,
                        'keterangan' => $loopMutasi->trxNotes,
                        'dataRobot' => $dataRobot
                    ]);
                }
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'data' => $dataMutasi
        ]);
    }

    public function showMutasi455Pembayaran(Request $request)
    {
        $idPenerima = $request->idPenerima;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('mutasiTransaksis.pelunasanMutasiSaless.salesFills.salesHarians.dOutlets', 'mutasiTransaksis.pelunasanMutasiSaless.salesFills.listSaless')->get();
        $dataMutasi = [];

        foreach ($tanggalAll as $loopTanggal) {
            $tanggalDDmmYY = date('d/m/Y', strtotime($loopTanggal->Tanggal));
            $mutasiTransaksis = $loopTanggal->mutasiTransaksis->where('idPenerimaList', '=', $idPenerima);
            foreach ($mutasiTransaksis as $loopMutasi) {
                $mutasiDetail = $loopMutasi->mutasiDetails;
                if ($mutasiDetail != null) {
                    if ($mutasiDetail->mutasiAksis->id != 1) {
                        //Hanya tampilkan yang aksi pembayaran
                        continue;
                    }
                    if ($mutasiDetail->mutasiKlasifikasis->id != 1) {
                        //Hanya tampilkan yang punya klasifikasi sukodono
                        continue;
                    }
                    $kredit = 0;
                    $debit = 0;
                    $dataRobot = [];
                    $robotMutasi455Pembayaran = $loopMutasi->robotMutasi455Pembayaran;
                    if ($loopMutasi->total > 0) {
                        $debit = $loopMutasi->total;
                    } else {
                        $kredit = (-1) * $loopMutasi->total;
                    }
                    foreach ($robotMutasi455Pembayaran as $loopMutasiRobot) {
                        array_push($dataRobot, (object)[
                            'id' => $loopMutasiRobot->id,
                            'idStatus' => $loopMutasiRobot->statusRobots->id,
                            'status' => $loopMutasiRobot->statusRobots->status,
                            'perevisi' => $loopMutasiRobot->dUsers['Nama Lengkap']
                        ]);
                    }
                    array_push($dataMutasi, (object)[
                        'id' => $loopMutasi->id,
                        'tanggal' => $tanggalDDmmYY,
                        'klasifikasi' => $mutasiDetail->mutasiKlasifikasis->klasifikasi,
                        'cabang' => $mutasiDetail->dOutlets['Nama Store'],
                        'kredit' => $kredit,
                        'debit' => $debit,
                        'keterangan' => $loopMutasi->trxNotes,
                        'dataRobot' => $dataRobot
                    ]);
                }
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'data' => $dataMutasi
        ]);
    }

    public function showMutasi1003Setoran(Request $request)
    {
        $idPenerima = $request->idPenerima;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('mutasiTransaksis.mutasiSetorans', 'mutasiTransaksis.mutasiDetails')->get();
        $dataMutasi = [];

        foreach ($tanggalAll as $loopTanggal) {
            $tanggalDDmmYY = date('d/m/Y', strtotime($loopTanggal->Tanggal));
            $mutasiTransaksis = $loopTanggal->mutasiTransaksis->where('idPenerimaList', '=', $idPenerima);
            foreach ($mutasiTransaksis as $loopMutasi) {
                $mutasiSetoran = $loopMutasi->mutasiSetorans;
                $mutasiDetail =  $loopMutasi->mutasiDetails;
                if ($mutasiSetoran != null) {
                    $kredit = 0;
                    $debit = 0;
                    $dataRobot = [];
                    $robotMutasi1003Setorans = $mutasiSetoran->robotMutasi1003Setorans;
                    if ($loopMutasi->total > 0) {
                        $debit = $loopMutasi->total;
                    } else {
                        $kredit = (-1) * $loopMutasi->total;
                    }
                    foreach ($robotMutasi1003Setorans as $loopMutasiRobot) {
                        array_push($dataRobot, (object)[
                            'id' => $loopMutasiRobot->id,
                            'idStatus' => $loopMutasiRobot->statusRobots->id,
                            'status' => $loopMutasiRobot->statusRobots->status,
                            'perevisi' => $loopMutasiRobot->dUsers['Nama Lengkap']
                        ]);
                    }
                    array_push($dataMutasi, (object)[
                        'id' => $loopMutasi->id,
                        'tanggal' => $tanggalDDmmYY,
                        'klasifikasi' => $mutasiDetail->mutasiKlasifikasis->klasifikasi,
                        'cabang' => $mutasiDetail->dOutlets['Nama Store'],
                        'kredit' => $kredit,
                        'debit' => $debit,
                        'keterangan' => $loopMutasi->trxNotes,
                        'dataRobot' => $dataRobot
                    ]);
                }
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'data' => $dataMutasi
        ]);
    }

    public function showMutasi165Reimburse(Request $request)
    {
        $idPenerima = $request->idPenerima;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('mutasiTransaksis.mutasiSetorans', 'mutasiTransaksis.mutasiDetails')->get();
        $dataMutasi = [];

        foreach ($tanggalAll as $loopTanggal) {
            $tanggalDDmmYY = date('d/m/Y', strtotime($loopTanggal->Tanggal));
            $mutasiTransaksis = $loopTanggal->mutasiTransaksis->where('idPenerimaList', '=', $idPenerima);
            foreach ($mutasiTransaksis as $loopMutasi) {
                $mutasiReimburse = $loopMutasi->mutasiReimburses;
                $mutasiDetail =  $loopMutasi->mutasiDetails;
                if ($mutasiReimburse != null) {
                    $kredit = 0;
                    $debit = 0;
                    $dataRobot = [];
                    $robotMutasi165Reimburse = $mutasiReimburse->robotMutasi165Reimburse;
                    if ($loopMutasi->total > 0) {
                        $debit = $loopMutasi->total;
                    } else {
                        $kredit = (-1) * $loopMutasi->total;
                    }
                    foreach ($robotMutasi165Reimburse as $loopMutasiRobot) {
                        array_push($dataRobot, (object)[
                            'id' => $loopMutasiRobot->id,
                            'idStatus' => $loopMutasiRobot->statusRobots->id,
                            'status' => $loopMutasiRobot->statusRobots->status,
                            'perevisi' => $loopMutasiRobot->dUsers['Nama Lengkap']
                        ]);
                    }
                    array_push($dataMutasi, (object)[
                        'id' => $loopMutasi->id,
                        'tanggal' => $tanggalDDmmYY,
                        'klasifikasi' => $mutasiDetail->mutasiKlasifikasis->klasifikasi,
                        'cabang' => $mutasiDetail->dOutlets['Nama Store'],
                        'kredit' => $kredit,
                        'debit' => $debit,
                        'keterangan' => $loopMutasi->trxNotes,
                        'dataRobot' => $dataRobot
                    ]);
                }
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'data' => $dataMutasi
        ]);
    }

    public function showMutasi165PindahSaldo(Request $request)
    {
        $idPenerima = $request->idPenerima;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('mutasiTransaksis.mutasiDetails')->get();
        $dataMutasi = [];

        foreach ($tanggalAll as $loopTanggal) {
            $tanggalDDmmYY = date('d/m/Y', strtotime($loopTanggal->Tanggal));
            $mutasiTransaksis = $loopTanggal->mutasiTransaksis->where('idPenerimaList', '=', $idPenerima);
            foreach ($mutasiTransaksis as $loopMutasi) {
                $mutasiDetail =  $loopMutasi->mutasiDetails;
                if ($mutasiDetail != null) {
                    if (($mutasiDetail->idMutasiKlasifikasi == '11') || ($mutasiDetail->idMutasiKlasifikasi == '12')) {
                        $kredit = 0;
                        $debit = 0;
                        $dataRobot = [];
                        $robot165PindahSaldo = $mutasiDetail->robot165PindahSaldo;
                        if ($loopMutasi->total > 0) {
                            $debit = $loopMutasi->total;
                        } else {
                            $kredit = (-1) * $loopMutasi->total;
                        }
                        foreach ($robot165PindahSaldo as $loopMutasiRobot) {
                            array_push($dataRobot, (object)[
                                'id' => $loopMutasiRobot->id,
                                'idStatus' => $loopMutasiRobot->statusRobots->id,
                                'status' => $loopMutasiRobot->statusRobots->status,
                                'perevisi' => $loopMutasiRobot->dUsers['Nama Lengkap']
                            ]);
                        }
                        array_push($dataMutasi, (object)[
                            'id' => $loopMutasi->id,
                            'tanggal' => $tanggalDDmmYY,
                            'klasifikasi' => $mutasiDetail->mutasiKlasifikasis->klasifikasi,
                            'cabang' => $mutasiDetail->dOutlets['Nama Store'],
                            'kredit' => $kredit,
                            'debit' => $debit,
                            'keterangan' => $loopMutasi->trxNotes,
                            'dataRobot' => $dataRobot
                        ]);
                    }
                }
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'data' => $dataMutasi
        ]);
    }

    public function showMutasi165Pembayaran(Request $request){
        $idPenerima = $request->idPenerima;
        $startDate = $request->startDate;
        $stopDate = $request->stopDate;
        $tanggalAll = tanggalAll::whereBetween('Tanggal', array($startDate, $stopDate))->orderBy('Tanggal', 'ASC')->with('mutasiTransaksis.mutasiDetails.mutasiPembayarans.listItemPattyCash','mutasiTransaksis.mutasiDetails.mutasiPembayarans.robot165Pembayaran')->get();
        $dataMutasi = [];

        foreach ($tanggalAll as $loopTanggal) {
            $tanggalDDmmYY = date('d/m/Y', strtotime($loopTanggal->Tanggal));
            $mutasiTransaksis = $loopTanggal->mutasiTransaksis->where('idPenerimaList', '=', $idPenerima);
            foreach ($mutasiTransaksis as $loopMutasi) {
                $mutasiDetail =  $loopMutasi->mutasiDetails;
                if ($mutasiDetail != null) {
                    $mutasiPembayaran = $mutasiDetail->mutasiPembayarans;
                    if($mutasiPembayaran != null){
                        $kredit = 0;
                        $debit = 0;
                        $dataRobot = [];
                        $robot165Pembayaran = $mutasiPembayaran->robot165Pembayaran;
                        $klasifikasi = $mutasiPembayaran->listItemPattyCash->Item;
                        if ($loopMutasi->total > 0) {
                            $debit = $loopMutasi->total;
                        } else {
                            $kredit = (-1) * $loopMutasi->total;
                        }
                        foreach ($robot165Pembayaran as $loopMutasiRobot) {
                            array_push($dataRobot, (object)[
                                'id' => $loopMutasiRobot->id,
                                'idStatus' => $loopMutasiRobot->statusRobots->id,
                                'status' => $loopMutasiRobot->statusRobots->status,
                                'perevisi' => $loopMutasiRobot->dUsers['Nama Lengkap']
                            ]);
                        }
                        array_push($dataMutasi, (object)[
                            'id' => $loopMutasi->id,
                            'tanggal' => $tanggalDDmmYY,
                            'klasifikasi' => $klasifikasi,
                            'cabang' => $mutasiDetail->dOutlets['Nama Store'],
                            'kredit' => $kredit,
                            'debit' => $debit,
                            'keterangan' => $loopMutasi->trxNotes,
                            'dataRobot' => $dataRobot
                        ]);
                    }
                }
            }
        }
        return response()->json([
            // 'countItem' => $datasales->count(),
            'data' => $dataMutasi
        ]);
    }

    public function createRobotPembelian(Request $request)
    {
        $idPattyHarian = $request->idPattyHarian;
        $idPemverifikasi = $request->idPemverifikasi;

        $pattyCashHarian = pattyCashHarian::find($idPattyHarian);
        $listPattyCash = $pattyCashHarian->listItemPattyCashs;
        foreach ($listPattyCash as $eachListPatty) {
            if ($eachListPatty->jenis_patty_cashs->namaJenis == 'HPP') {
                $quantity = $eachListPatty->pivot->quantity;
                $total = $eachListPatty->pivot->total;

                $idQtyRevisi = $eachListPatty->pivot->idRevQuantity;
                $idTotalRevisi = $eachListPatty->pivot->idRevTotal;
                if ($idQtyRevisi == '2') {
                    $quantity = $eachListPatty->pivot->quantityRevisi;
                }
                if ($idTotalRevisi == '2') {
                    $total = $eachListPatty->pivot->totalRevisi;
                }

                $pattyCashFill = pattyCashFill::find($eachListPatty->pivot->id);
                $pattyCashFill->quantityRobot = $quantity;
                $pattyCashFill->totalRobot = $total;
                $pattyCashFill->save();
            }
        }

        robot_pembelian_status::create([
            'idPattyCashHarian' => $idPattyHarian,
            'idPemverifikasi' => $idPemverifikasi,
            'idStatusRobot' => '1'
        ]);
    }

    public function createRobotPembayaran(Request $request)
    {
        $idPattyHarian = $request->idPattyHarian;
        $idPemverifikasi = $request->idPemverifikasi;

        $pattyCashHarian = pattyCashHarian::find($idPattyHarian);
        $listPattyCash = $pattyCashHarian->listItemPattyCashs;
        foreach ($listPattyCash as $eachListPatty) {
            $kategoriPattyCashs = $eachListPatty->jenis_patty_cashs->kategori_patty_cashs->namaKategori;
            if (($kategoriPattyCashs == 'Beban Operasional') || ($kategoriPattyCashs == 'Beban Penjualan') || ($kategoriPattyCashs == 'Beban Gaji') || ($kategoriPattyCashs == 'Beban Marketing')) {
                $quantity = $eachListPatty->pivot->quantity;
                $total = $eachListPatty->pivot->total;

                $idQtyRevisi = $eachListPatty->pivot->idRevQuantity;
                $idTotalRevisi = $eachListPatty->pivot->idRevTotal;
                if ($idQtyRevisi == '2') {
                    $quantity = $eachListPatty->pivot->quantityRevisi;
                }
                if ($idTotalRevisi == '2') {
                    $total = $eachListPatty->pivot->totalRevisi;
                }

                $pattyCashFill = pattyCashFill::find($eachListPatty->pivot->id);
                $pattyCashFill->quantityRobot = $quantity;
                $pattyCashFill->totalRobot = $total;
                $pattyCashFill->save();
            }
        }

        robot_pembayaran_status::create([
            'idPattyCashHarian' => $idPattyHarian,
            'idPemverifikasi' => $idPemverifikasi,
            'idStatusRobot' => '1'
        ]);
    }

    public function createRobotEcommerce(Request $request)
    {
        $dataArray = $request->input('data');
        $idPemverifikasi = $dataArray['idPemverifikasi'];

        $dataParse = $dataArray['data'];
        $idOutlet = $dataParse['idOutlet'];
        $idTanggal = $dataParse['idTanggal'];
        $datas = $dataParse['data'];

        foreach ($datas as $data) {
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

    public function createRobotMutasi455TfKas(Request $request)
    {
        $idPelunasanMutasiSales = $request->idPelunasanMutasiSales;
        $idPemverifikasi = $request->idPemverifikasi;
        $robotMutasi455TfKas = new robot_mutasi455tfkas_status();
        $robotMutasi455TfKas->idPelunasanMutasiSales = $idPelunasanMutasiSales;
        $robotMutasi455TfKas->idPemverifikasi = $idPemverifikasi;
        $robotMutasi455TfKas->idStatusRobot = '1';
        $robotMutasi455TfKas->save();
    }

    public function createRobotMutasi455TfKasPenerimaan(Request $request)
    {
        $idPelunasanMutasiSales = $request->idPelunasanMutasiSales;
        $idPemverifikasi = $request->idPemverifikasi;
        $robotMutasi455TfKas = new robot_mutasi455tfkas_penerimaan_status();
        $robotMutasi455TfKas->idPelunasanMutasiSales = $idPelunasanMutasiSales;
        $robotMutasi455TfKas->idPemverifikasi = $idPemverifikasi;
        $robotMutasi455TfKas->idStatusRobot = '1';
        $robotMutasi455TfKas->save();
    }

    public function createRobotMutasi455Pembayaran(Request $request)
    {
        $idMutasiTransaksi = $request->idMutasiTransaksi;
        $idPemverifikasi = $request->idPemverifikasi;
        $robotPembayaran455 = new robot_mutasi455_pembayaran_status();
        $robotPembayaran455->idMutasiTransaksi = $idMutasiTransaksi;
        $robotPembayaran455->idPemverifikasi = $idPemverifikasi;
        $robotPembayaran455->idStatusRobot = '1';
        $robotPembayaran455->save();
    }

    public function createRobotMutasi1003Setoran(Request $request)
    {
        $idMutasiTransaksi = $request->idMutasiTransaksi;
        $idPemverifikasi = $request->idPemverifikasi;
        $mutasiSetoran = mutasi_transaksi::find($idMutasiTransaksi)->mutasiSetorans;
        $robotMutasi1003 = new robot_mutasi1003_setoran_status();
        $robotMutasi1003->idMutasiSetoran = $mutasiSetoran->id;
        $robotMutasi1003->idPemverifikasi = $idPemverifikasi;
        $robotMutasi1003->idStatusRobot = '1';
        $robotMutasi1003->save();
    }

    public function createRobotMutasi165Reimburse(Request $request)
    {
        $idMutasiTransaksi = $request->idMutasiTransaksi;
        $idPemverifikasi = $request->idPemverifikasi;
        $mutasiReimburse = mutasi_transaksi::find($idMutasiTransaksi)->mutasiReimburses;
        $robotMutasi165Reimburse = new robot_mutasi165_reimburse_status();
        $robotMutasi165Reimburse->idmutasiReimburse = $mutasiReimburse->id;
        $robotMutasi165Reimburse->idPemverifikasi = $idPemverifikasi;
        $robotMutasi165Reimburse->idStatusRobot = '1';
        $robotMutasi165Reimburse->save();
    }

    public function createRobotMutasi165PindahSaldo(Request $request)
    {
        $idMutasiTransaksi = $request->idMutasiTransaksi;
        $idPemverifikasi = $request->idPemverifikasi;
        $mutasiDetail = mutasi_transaksi::find($idMutasiTransaksi)->mutasiDetails;
        $robotMutasi165PindahSaldo = new robot_165_pindah_saldo_status();
        $robotMutasi165PindahSaldo->idmutasiDetail = $mutasiDetail->id;
        $robotMutasi165PindahSaldo->idPemverifikasi = $idPemverifikasi;
        $robotMutasi165PindahSaldo->idStatusRobot = '1';
        $robotMutasi165PindahSaldo->save();
    }

    public function createRobotMutasi165Pembayaran(Request $request){
        $idMutasiTransaksi = $request->idMutasiTransaksi;
        $idPemverifikasi = $request->idPemverifikasi;
        $mutasiDetail = mutasi_transaksi::find($idMutasiTransaksi)->mutasiDetails;
        $mutasiPembayaran = $mutasiDetail->mutasiPembayarans;
        if($mutasiPembayaran != null){
            $robot165Pembayaran = new robot_165_pembayaran();
            $robot165Pembayaran->idPemverifikasi = $idPemverifikasi;
            $robot165Pembayaran->idStatusRobot = '1';
            $robot165Pembayaran->idMutasiPembayaran = $mutasiPembayaran->id;
            $robot165Pembayaran->save();
        }
    }

    public function doneRobotPembelian($id)
    {
        $robot_pembelian_status = robot_pembelian_status::find($id);
        $robot_pembelian_status->update([
            'idStatusRobot' => '2'
        ]);
        // @dd($robot_pembelian_status);
    }

    public function doneRobotPembayaran($id)
    {
        $robot_pembayaran_status = robot_pembayaran_status::find($id);
        $robot_pembayaran_status->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function doneRobotECommerce($id)
    {
        $robot_ecommerce_status = robot_ecommerce_status::find($id);
        $robot_ecommerce_status->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function doneRobotMutasi455TfKas($id)
    {
        $robot_mutasi455tfkas_status = robot_mutasi455tfkas_status::find($id);
        $robot_mutasi455tfkas_status->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function doneRobotMutasi455TfKasPenerimaan($id)
    {
        $robot_mutasi455tfkas_penerimaan_status = robot_mutasi455tfkas_penerimaan_status::find($id);
        $robot_mutasi455tfkas_penerimaan_status->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function doneRobotMutasi455Pembayaran($id)
    {
        $robotMutasi455Pembayaran = robot_mutasi455_pembayaran_status::find($id);
        $robotMutasi455Pembayaran->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function doneRobotMutasi1003($id)
    {
        $robotMutasi1003 = robot_mutasi1003_setoran_status::find($id);
        $robotMutasi1003->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function doneRobotReimburse165($id)
    {
        $robotMutasiReimburse = robot_mutasi165_reimburse_status::find($id);
        $robotMutasiReimburse->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function doneRobotMutasi165PindahSaldo($id){
        $robotMutasiPindahSaldo = robot_165_pindah_saldo_status::find($id);
        $robotMutasiPindahSaldo->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function doneRobotPembayaran165($id){
        $robotPembayaran165 = robot_165_pembayaran::find($id);
        $robotPembayaran165->update([
            'idStatusRobot' => '2'
        ]);
    }

    public function deleteRobotPembelian(Request $request)
    {
        $robotPembelianStatus = robot_pembelian_status::find($request->idRobotPembelianStatus);
        $listPattyCash = $robotPembelianStatus->pattyCashHarians->listItemPattyCashs;
        foreach ($listPattyCash as $eachListPatty) {
            //Cari item patty yang termasuk hpp
            if ($eachListPatty->jenis_patty_cashs->namaJenis == 'HPP') {
                $pattyCashFill = pattyCashFill::find($eachListPatty->pivot->id);
                $pattyCashFill->quantityRobot = 0;
                $pattyCashFill->totalRobot = 0;
                $pattyCashFill->save();
            }
        }

        robot_pembelian_status::find($request->idRobotPembelianStatus)->delete();
    }

    public function deleteRobotPembayaran(Request $request)
    {
        $robotPembelianStatus = robot_pembayaran_status::find($request->idRobotPembayaranStatus);
        $listPattyCash = $robotPembelianStatus->pattyCashHarians->listItemPattyCashs;
        foreach ($listPattyCash as $eachListPatty) {
            $kategoriPattyCashs = $eachListPatty->jenis_patty_cashs->kategori_patty_cashs->namaKategori;
            if (($kategoriPattyCashs == 'Beban Operasional') || ($kategoriPattyCashs == 'Beban Penjualan') || ($kategoriPattyCashs == 'Beban Gaji') || ($kategoriPattyCashs == 'Beban Marketing')) {
                $pattyCashFill = pattyCashFill::find($eachListPatty->pivot->id);
                $pattyCashFill->quantityRobot = 0;
                $pattyCashFill->totalRobot = 0;
                $pattyCashFill->save();
            }
        }
        robot_pembayaran_status::find($request->idRobotPembayaranStatus)->delete();
    }
    public function deleteRobotEcommerce(Request $request)
    {
        $idRobotEcommerceStatus = $request->idRobotEcommerceStatus;

        $robotECommerceStatus = robot_ecommerce_status::find($idRobotEcommerceStatus);
        $idTanggal = $robotECommerceStatus->idTanggal;
        $idOutlet = $robotECommerceStatus->idOutlet;

        $robotTempECommerces = robot_temp_e_commerce::where('idTanggal', '=', $idTanggal)->get();
        if ($robotTempECommerces->count() > 0) {
            $robotTempECommerces = $robotTempECommerces->where('idOutlet', '=', $idOutlet);
            if ($robotTempECommerces->count() > 0) {
                foreach ($robotTempECommerces as $robotTempECommerce) {
                    $robotTempECommerce->delete();
                }
            }
        }
        $robotECommerceStatus->delete();
    }
    public function deleteRobotMutasi455TfKas(Request $request)
    {
        $idRobotMutasi455TfKas = $request->idRobotMutasi455TfKas;
        robot_mutasi455tfkas_status::find($idRobotMutasi455TfKas)->delete();
    }
    public function deleteRobotMutasi455TfKasPenerimaan(Request $request)
    {
        $idRobotMutasi455TfKas = $request->idRobotMutasi455TfKas;
        robot_mutasi455tfkas_penerimaan_status::find($idRobotMutasi455TfKas)->delete();
    }

    public function deleteRobotMutasi455Pembayaran(Request $request)
    {
        $idRobotMutasi455Pembayaran = $request->idRobotMutasi455Pembayaran;
        robot_mutasi455_pembayaran_status::find($idRobotMutasi455Pembayaran)->delete();
    }

    public function deleteRobotMutasi1003Setoran(Request $request)
    {
        $idRobotMutasi1003Setoran = $request->idRobotMutasi1003Setoran;
        robot_mutasi1003_setoran_status::find($idRobotMutasi1003Setoran)->delete();
    }

    public function deleteRobotMutasi165Reimburse(Request $request)
    {
        $idRobotMutasi165Reimburse = $request->idRobotMutasi165Reimburse;
        robot_mutasi165_reimburse_status::find($idRobotMutasi165Reimburse)->delete();
    }

    public function deleteRobotMutasi165PindahSaldo(Request $request){
        $idRobotMutasi165PindahSaldo = $request->idRobotMutasi165PindahSaldo;
        robot_165_pindah_saldo_status::find($idRobotMutasi165PindahSaldo)->delete();
    }

    public function deleteRobotMutasi165Pembayaran(Request $request){
        $idRobot165Pembayaran = $request->idRobot165Pembayaran;
        robot_165_pembayaran::find($idRobot165Pembayaran)->delete();
    }
}
