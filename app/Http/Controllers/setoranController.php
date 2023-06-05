<?php

namespace App\Http\Controllers;

use App\Models\doutlet;
use App\Models\dUser;
use App\Models\jenisBank;
use App\Models\listBank;
use App\Models\mutasi_klasifikasi;
use App\Models\penerimaList;
use App\Models\pengirimList;
use App\Models\setoran;
use App\Models\tanggalAll;
use App\Models\tempImgAll;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class setoranController extends Controller
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
    public function createBank(Request $request)
    {
        listBank::create([
            'idJenisBank' => $request->idJenisBank,
            'bank' => $request->bank,
            'imageBank' => $request->imageBank
        ]);
    }

    public function createSetoran(Request $request)
    {
        $dateNow = $request->tanggal;
        $tanggalAll = tanggalAll::where('Tanggal', '=', $dateNow)->first();
        $imagePathTemp = tempImgAll::find($request->idImageTemp)->imagePath;
        $imagePathNew = 'setoran/';
        $imagePathNew .= now()->format('Y_m_d_H_i_s_');
        $imagePathNew .= substr($imagePathTemp, -5);

        $tanggalID = null;
        if ($tanggalAll == null) {
            $tanggalID = tanggalAll::create([
                'Tanggal' => $dateNow,
            ])->id;
        } else {
            $tanggalID = $tanggalAll['id'];
        }

        Storage::copy($imagePathTemp, $imagePathNew);
        Storage::delete($imagePathTemp);
        tempImgAll::find($request->idImageTemp)->delete();

        $dataArray = [
            'idOutlet' => $request->idOutlet,
            'idPengirim' => $request->idPengirim,
            'idTujuan' => $request->idTujuan,
            'qtySetor' => $request->qtySetor,
            'imgTransfer' => $imagePathNew,
            'idRevisi' => '2',
            'idTanggal' => $tanggalID,
        ];
        $dataa = setoran::create($dataArray)->id;
        return $dataa;
    }

    public function createIDPengirim(Request $request)
    {
        $outlet = dUser::find($request->idUser)->doutlets;
        $dataArray = [
            'idUser' => $request->idUser,
            'idOutlet' => $outlet->id,
            'namaRekening' => ucfirst(strtolower($request->namaRekening)),
            'nomorRekening' => $request->nomorRekening,
            'idBank' => $request->idBank,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        $dataa = pengirimList::create($dataArray)->id;
        return $dataa;
    }

    public function createIDPenerima(Request $request)
    {
        $dataArray = [
            'namaRekening' => $request->namaRekening,
            'nomorRekening' => $request->nomorRekening,
            'idBank' => $request->idBank,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];
        $dataa = penerimaList::create($dataArray)->id;
        return $dataa;
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
    public function showType()
    {
        $jenisBank = jenisBank::all();
        $jenisAll = [];
        for ($i = 0; $i < $jenisBank->count(); $i++) {
            array_push($jenisAll, (object)[
                'id' => $jenisBank[$i]->id,
                'jenis' => $jenisBank[$i]->jenis
            ]);
        }
        return response()->json([
            'jenis' => $jenisAll
        ]);
    }

    public function showBank($idJenisBank)
    {
        $listBank = listBank::where('idJenisBank', '=', $idJenisBank)->get();
        // @dd($listBank);
        $allBank = [];
        for ($i = 0; $i < $listBank->count(); $i++) {
            array_push($allBank, (object)[
                'id' => $listBank[$i]->id,
                'bank' => $listBank[$i]->bank,
                'img' => $listBank[$i]->imageBank
            ]);
        }
        return response()->json([
            'listBank' => $allBank
        ]);
    }

    public function showAllBank()
    {
        $listBank = listBank::all();
        $jenisBank = jenisBank::all();
        // @dd($listBank);
        $allBank = [];
        $jenisBankArray = [];
        for ($i = 0; $i < $jenisBank->count(); $i++) {
            array_push($jenisBankArray, (object)[
                'id' => $jenisBank[$i]->id,
                'jenis' => $jenisBank[$i]->jenis
            ]);
        }
        for ($i = 0; $i < $listBank->count(); $i++) {
            array_push($allBank, (object)[
                'id' => $listBank[$i]->id,
                'bank' => $listBank[$i]->bank,
                'img' => $listBank[$i]->imageBank,
                'idJenisBank' => $listBank[$i]->idJenisBank,
                'jenisBank' => $listBank[$i]->jenisBanks->jenis
            ]);
        }
        return response()->json([
            'listBank' => $allBank,
            'jenisBank' => $jenisBankArray
        ]);
    }

    public function showPenerima()
    {
        $penerimaList = penerimaList::all();
        $bankList = listBank::all();
        $mutasiKlasifikasi = mutasi_klasifikasi::all();
        // @dd($penerimaList);
        $mutasiKlasifikasiArray = [];
        $penerimaListArray = [];
        $bankListArray = [];
        foreach($mutasiKlasifikasi as $eachKlasifikasi){
            array_push($mutasiKlasifikasiArray, (object)[
                'id' => $eachKlasifikasi->id,
                'klasifikasi' => $eachKlasifikasi->klasifikasi,
            ]);
        }
        for ($i = 0; $i < $bankList->count(); $i++) {
            array_push($bankListArray, (object)[
                'id' => $bankList[$i]->id,
                'bank' => $bankList[$i]->bank
            ]);
        }
        for ($i = 0; $i < $penerimaList->count(); $i++) {
            array_push($penerimaListArray, (object)[
                'id' => $penerimaList[$i]->id,
                'namaRekening' => $penerimaList[$i]->namaRekening,
                'nomorRekening' => $penerimaList[$i]->nomorRekening,
                'idBank' => $penerimaList[$i]->idBank,
                'imgBank' => $penerimaList[$i]->listBanks->imageBank,
                'bank' => $penerimaList[$i]->listBanks->bank
            ]);
        }
        return response()->json([
            'penerimaListArray' => $penerimaListArray,
            'bankListArray' => $bankListArray,
            'mutasiKlasifikasiArray' => $mutasiKlasifikasiArray
        ]);
    }

    public function showPengirimEWalletPart($idUser)
    {
        $pengirimList = pengirimList::where('idUser', '=', $idUser)->orderBy('id', 'DESC')->get();
        $pengirimListArray = [];
        for ($i = 0; $i < $pengirimList->count(); $i++) {
            if ($pengirimList[$i]->listBanks->idJenisBank == 2) {
                if ($i >= 5) {
                    break;
                } else {
                    array_push($pengirimListArray, (object)[
                        'id' => $pengirimList[$i]->id,
                        'namaRekening' => $pengirimList[$i]->namaRekening,
                        // 'bank' => $pengirimList[$i]->listBanks->bank,
                        'imgBank' => $pengirimList[$i]->listBanks->imageBank
                    ]);
                }
            }
        }
        return response()->json([
            'pengirimListArray' => $pengirimListArray
        ]);
    }

    public function showPengirimTransferPart($idUser)
    {
        $pengirimList = pengirimList::where('idUser', '=', $idUser)->orderBy('id', 'DESC')->get();
        $pengirimListArray = [];
        for ($i = 0; $i < $pengirimList->count(); $i++) {
            if ($pengirimList[$i]->listBanks->idJenisBank == 1) {
                if ($i >= 5) {
                    break;
                } else {
                    array_push($pengirimListArray, (object)[
                        'id' => $pengirimList[$i]->id,
                        'namaRekening' => $pengirimList[$i]->namaRekening,
                        // 'bank' => $pengirimList[$i]->listBanks->bank,
                        'imgBank' => $pengirimList[$i]->listBanks->imageBank
                    ]);
                }
            }
        }
        return response()->json([
            'pengirimListArray' => $pengirimListArray
        ]);
    }


    public function showPengirimPart($idUser)
    {
        $pengirimList = pengirimList::where('idUser', '=', $idUser)->orderBy('id', 'DESC')->get();
        // @dd($pengirimList);
        $pengirimListArray = [];
        for ($i = 0; $i < $pengirimList->count(); $i++) {
            if ($i >= 5) {
                break;
            } else {
                array_push($pengirimListArray, (object)[
                    'id' => $pengirimList[$i]->id,
                    'namaRekening' => $pengirimList[$i]->namaRekening,
                    // 'bank' => $pengirimList[$i]->listBanks->bank,
                    'idJenis' => $pengirimList[$i]->listBanks->idJenisBank,
                    'imgBank' => $pengirimList[$i]->listBanks->imageBank
                ]);
            }
        }
        return response()->json([
            'pengirimListArray' => $pengirimListArray
        ]);
    }

    public function showPengirimEWalletAll($idUser)
    {
        $pengirimList = pengirimList::where('idUser', '=', $idUser)->get();
        $pengirimListArray = [];
        for ($i = 0; $i < $pengirimList->count(); $i++) {
            if ($pengirimList[$i]->listBanks->idJenisBank == 2) {
                array_push($pengirimListArray, (object)[
                    'id' => $pengirimList[$i]->id,
                    'namaRekening' => $pengirimList[$i]->namaRekening,
                    'nomorRekening' => $pengirimList[$i]->nomorRekening,
                    'imgBank' => $pengirimList[$i]->listBanks->imageBank
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

    public function showPengirimTransferAll($idUser)
    {
        $pengirimList = pengirimList::where('idUser', '=', $idUser)->get();
        $pengirimListArray = [];
        for ($i = 0; $i < $pengirimList->count(); $i++) {
            if ($pengirimList[$i]->listBanks->idJenisBank == 1) {
                array_push($pengirimListArray, (object)[
                    'id' => $pengirimList[$i]->id,
                    'namaRekening' => $pengirimList[$i]->namaRekening,
                    'nomorRekening' => $pengirimList[$i]->nomorRekening,
                    'imgBank' => $pengirimList[$i]->listBanks->imageBank
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

    public function showPengirimAll($idUser)
    {
        $pengirimList = pengirimList::where('idUser', '=', $idUser)->get();
        $pengirimListArray = [];
        for ($i = 0; $i < $pengirimList->count(); $i++) {
            array_push($pengirimListArray, (object)[
                'id' => $pengirimList[$i]->id,
                'namaRekening' => $pengirimList[$i]->namaRekening,
                'nomorRekening' => $pengirimList[$i]->nomorRekening,
                'imgBank' => $pengirimList[$i]->listBanks->imageBank,
                'idJenisBank' => $pengirimList[$i]->listBanks->idJenisBank
            ]);
        }
        usort($pengirimListArray, function ($a, $b) {
            return strcmp($a->namaRekening, $b->namaRekening);
        });
        return response()->json([
            'pengirimListArray' => $pengirimListArray
        ]);
    }

    public function showPengirimList($idPengirimList)
    {
        $pengirimList = pengirimList::find($idPengirimList);
        // @dd($pengirimList);
        return response()->json([
            'id'            => $pengirimList->id,
            'namaRekening'  => $pengirimList->namaRekening,
            'nomorRekening' => $pengirimList->nomorRekening,
            'bank'          => $pengirimList->listBanks->bank,
            'imgBank'       => $pengirimList->listBanks->imageBank
        ]);
    }

    public function showSetoranPart2($idOutlet, $countData, $startDate, $stopDate){
        $allData = [];
        $outletArray = [];
        if($idOutlet == '0'){
            $tempOutlet = doutlet::all();
            foreach($tempOutlet as $loopOutlet){
                array_push($outletArray, $loopOutlet->id);
            }
        }else{
            array_push($outletArray, $idOutlet);
        }
        // @dd($outletArray);
        foreach($outletArray as $loopIdOutlet){
            $namaOutlet = doutlet::find($loopIdOutlet)['Nama Store'];
            array_push($allData, (object)[
                'outlet' => $namaOutlet,
                'setoran' => $this->showSetoran($loopIdOutlet,  $countData, $startDate, $stopDate)
            ]);
        }
        return response()->json([
            'allSetoran' => $allData
        ]);
    }

    public function showSetoranPart($idOutlet, $countData, $startDate, $stopDate)
    {
        $allData = $this->showSetoran($idOutlet, $countData, $startDate, $stopDate);
        return response()->json([
            'setoran' => $allData
        ]);
    }

    public function showSetoran($idOutlet, $countData, $startDate, $stopDate){
        $now = Carbon::now();
        $tanggalAll = [];
        $semuaTanggal = tanggalAll::orderBy('Tanggal', 'DESC')->with('setorans.pengirimLists.listBanks','setorans.mutasiSetorans.mutasiTransaksis')->get();
        if ($countData == 'today') {
            $tanggalAll = $semuaTanggal->where('Tanggal', '=', $now->format('Y-m-d'));
        } else if ($countData == '7day') {
            $from = $now->format('Y-m-d');
            $to = $now->subDays(7)->format('Y-m-d');
            $tanggalAll = $semuaTanggal->whereBetween('Tanggal', array($to, $from));
        } else if ($countData == '30day') {
            $from = $now->format('Y-m-d');
            $to = $now->subDays(30)->format('Y-m-d');
            $tanggalAll = $semuaTanggal->whereBetween('Tanggal', array($to, $from));
        } else if ($countData == 'between') {
            $tanggalAll = $semuaTanggal->whereBetween('Tanggal', array($startDate, $stopDate));
        } else if ($countData == 'all') {
            $tanggalAll = $semuaTanggal;
        }
        $allData = [];
        $countData = 1;
        foreach ($tanggalAll as $loopTanggal) {
            $setoran = $loopTanggal->setorans->where('idOutlet', '=', $idOutlet);
            // @dd($setoran);
            $setoranArray = [];
            $dataFound = false;
            foreach($setoran as $setoranLoop){
                $mutasiSetorans = $setoranLoop->mutasiSetorans;
                $arrayMutasiSetoran = [];
                foreach($mutasiSetorans as $loopSetoran){
                    $mutasiTransaksi = $loopSetoran->mutasiTransaksis;
                    array_push($arrayMutasiSetoran,(object)[
                        'trxNotes' => $mutasiTransaksi->trxNotes
                    ]);
                }
                array_push($setoranArray, (object)[
                    'id' => $setoranLoop->id,
                    'idRev' => $setoranLoop->idRevisi,
                    'namaRekening' => $setoranLoop->pengirimLists->namaRekening,
                    'time' => $setoranLoop->updated_at->format('H:i'),
                    'imgBank' => $setoranLoop->pengirimLists->listBanks->imageBank,
                    'qty' => $setoranLoop->qtySetor,
                    'idJenis' => $setoranLoop->pengirimLists->listBanks->idJenisBank,
                    'mutasi' => $arrayMutasiSetoran
                ]);
                $dataFound = true;
            }
            if ($dataFound) {
                array_push($allData, (object)[
                    'Tanggal' => $loopTanggal->Tanggal,
                    'setoran' => $setoranArray
                ]);
            }
        }
        return $allData;
    }

    public function showSetoranAll($idOutlet)
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->with('setorans.pengirimLists.listBanks')->get();
        $allData = [];
        // $countData = 1;
        for ($i = 0; $i < $tanggalAll->count(); $i++) {
            $setorans = $tanggalAll[$i]->setorans->where('idOutlet', '=', $idOutlet);
            // @dd($setoran);
            $setoranArray = [];
            $dataFound = false;
            foreach($setorans as $setoran ){
                array_push($setoranArray, (object)[
                    'id' => $setoran->id,
                    'idRev' => $setoran->idRevisi,
                    'namaRekening' => $setoran->pengirimLists->namaRekening,
                    'time' => $setoran->updated_at->format('H:i'),
                    'imgBank' => $setoran->pengirimLists->listBanks->imageBank,
                    'qty' => $setoran->qtySetor,
                    'idJenis' => $setoran->pengirimLists->listBanks->idJenisBank
                ]);
                $dataFound = true;
            }
            if ($dataFound) {
                array_push($allData, (object)[
                    'Tanggal' => $tanggalAll[$i]->Tanggal,
                    'setoran' => $setoranArray
                ]);
            }
            // if ($countData > 5) {
            //     break;
            // }
        }
        return response()->json([
            'setoran' => $allData
        ]);
    }

    public function showSetoranDetail($idSetoran)
    {
        $setoran = setoran::find($idSetoran);
        // @dd($setoran->tanggalAlls->Tanggal);
        return response()->json([
            'id' => $idSetoran,
            'namaRekeningPengirim' => $setoran->pengirimLists->namaRekening,
            'nomorRekeningPengirim' => $setoran->pengirimLists->nomorRekening,
            'bankPengirim' => $setoran->pengirimLists->listBanks->bank,
            'namaRekeningPenerima' => $setoran->penerimaLists->namaRekening,
            'nomorRekeningPenerima' => $setoran->penerimaLists->nomorRekening,
            'imageBankPenerima' => $setoran->penerimaLists->listBanks->imageBank,
            'bankPenerima' => $setoran->penerimaLists->listBanks->bank,
            'idPenerima' => $setoran->penerimaLists->id,
            'idStatus' => $setoran->idRevisi,
            'date' => $setoran->tanggalAlls->Tanggal,
            'time' => $setoran->updated_at->format('H:i'),
            'qty' => $setoran->qtySetor,
            'imagePathFile' => $setoran->imgTransfer
        ]);
        // @dd($setoran);
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

    public function editPenerima(Request $request)
    {
        penerimaList::find($request->idPenerima)->update([
            'idBank'        => $request->idBank,
            'namaRekening'  => $request->namaRekening,
            'nomorRekening' => $request->nomorRekening,
        ]);
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
        $setoran = setoran::find($id);
        $setoran->update([
            'idTujuan' => $request->idPenerima,
            'idRevisi' => $request->idRevisi
        ]);
    }

    public function updateBank(Request $request, $id)
    {
        listBank::find($id)->update([
            'idJenisBank' => $request->idJenisBank,
            'bank' => $request->bank,
            'imageBank' => $request->imageBank
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
    public function delete($id)
    {
        $setoran = setoran::find($id);
        $pathImage = $setoran->imgTransfer;
        $setoran->delete();
        // @dd($setoran);
        Storage::delete($pathImage);
    }
}
