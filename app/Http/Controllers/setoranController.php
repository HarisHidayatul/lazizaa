<?php

namespace App\Http\Controllers;

use App\Models\dUser;
use App\Models\jenisBank;
use App\Models\listBank;
use App\Models\penerimaList;
use App\Models\pengirimList;
use App\Models\setoran;
use App\Models\tanggalAll;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function createSetoran(Request $request)
    {
        $dateNow = date("Y-m-d");
        $tanggalAll = tanggalAll::where('Tanggal', '=', $dateNow)->first();
        $tanggalID = null;
        if ($tanggalAll == null) {
            $tanggalID = tanggalAll::create([
                'Tanggal' => $dateNow,
            ])->id;
        } else {
            $tanggalID = $tanggalAll['id'];
        }

        $dataArray = [
            'idOutlet' => $request->idOutlet,
            'idPengirim' => $request->idPengirim,
            'idTujuan' => $request->idTujuan,
            'qtySetor' => $request->qtySetor,
            'imgTransfer' => 'In Progress',
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

    public function showPenerima()
    {
        $penerimaList = penerimaList::all();
        // @dd($penerimaList);
        $penerimaListArray = [];
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
            'penerimaListArray' => $penerimaListArray
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

    public function showSetoranPart($idOutlet)
    {
        $tanggalAll = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        $allData = [];
        $countData = 1;
        for ($i = 0; $i < $tanggalAll->count(); $i++) {
            $setoran = $tanggalAll[$i]->setorans->where('idOutlet', '=', $idOutlet);
            // @dd($setoran);
            $setoranArray = [];
            for ($j = 0; $j < $setoran->count(); $j++) {
                array_push($setoranArray, (object)[
                    'id' => $setoran[$j]->id,
                    'idRev' => $setoran[$j]->idRevisi,
                    'namaRekening' => $setoran[$j]->pengirimLists->namaRekening,
                    'time' => $setoran[$j]->updated_at->format('H:i'),
                    'imgBank' => $setoran[$j]->pengirimLists->listBanks->imageBank,
                    'qty' => $setoran[$j]->qtySetor
                ]);
                $countData++;
                if ($countData > 5) {
                    break;
                }
            }
            array_push($allData, (object)[
                'Tanggal' => $tanggalAll[$i]->Tanggal,
                'setoran' => $setoranArray
            ]);
            if ($countData > 5) {
                break;
            }
        }
        return response()->json([
            'setoran' => $allData
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
