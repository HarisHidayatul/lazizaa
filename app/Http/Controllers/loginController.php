<?php

namespace App\Http\Controllers;

use App\Models\dBrand;
use App\Models\doutlet;
use App\Models\dUser;
use App\Models\fsoHarian;
use App\Models\listSesi;
use App\Models\salesharian;
use App\Models\tanggalAll;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    //
    public function loginCheck(Request $request)
    {
        // dd($request->all());
        $response = '';
        // $dUser = dUser::where('username', $request->username)->get();
        // $dBrand = doutlet::find($dUser[0]['idOutlet'])->dBrands;
        // @dd($dBrand);
        try {
            $dUser = dUser::where('username', $request->username)->get();
            $dOutlet = $dUser[0]->doutlets;
            if ($request->password == $dUser[0]['Password']) {
                $dBrand = doutlet::find($dUser[0]['idOutlet'])->dBrands;
                /* Program dibawah digunakan untuk SO Harian, Jangan dihapus,
                untuk perkembangan program lagi*/
                if ($dUser[0]['idRole'] == 1) {
                    return view('dataCollect.revision2', [
                        'idPengisi' => $dUser[0]['id'],
                    ]);
                } else if ($dUser[0]['idRole'] == 2) {
                    /* Program di bawah untuk sales harian*/
                    // return view('fsoHarian.user2', [
                    //     'Brand' => $dBrand['Nama Brand'],
                    //     'brandImage' => $dBrand['Image'],
                    //     'Outlet' => $dOutlet['Nama Store'],
                    //     'idPengisi' => $dUser[0]['id'],
                    //     'idOutlet' => $dUser[0]['idOutlet'],
                    //     'date'    => date("Y-m-d")
                    // ]);

                    /* Program di bawah untuk sales harian*/
                    // return view('salesHarian.user', [
                    //     'Brand' => $dBrand['Nama Brand'],
                    //     'brandImage' => $dBrand['Image'],
                    //     'Outlet' => $dOutlet['Nama Store'],
                    //     'idPengisi' => $dUser[0]['id'],
                    //     'idOutlet' => $dUser[0]['idOutlet'],
                    //     'date'    => date("Y-m-d")
                    // ]);

                    /* Program di bawah untuk pattycash harian */
                    // return view('pattyCash.user', [
                    //     'Brand' => $dBrand['Nama Brand'],
                    //     'idBrand' => $dBrand['id'],
                    //     'brandImage' => $dBrand['Image'],
                    //     'Outlet' => $dOutlet['Nama Store'],
                    //     'idPengisi' => $dUser[0]['id'],
                    //     'idOutlet' => $dUser[0]['idOutlet'],
                    //     'date'    => date("Y-m-d")
                    // ]);

                    /* Program di bawah untuk waste harian */
                    return view('wasteHarian.user', [
                        'Brand' => $dBrand['Nama Brand'],
                        'idBrand' => $dBrand['id'],
                        'brandImage' => $dBrand['Image'],
                        'Outlet' => $dOutlet['Nama Store'],
                        'idPengisi' => $dUser[0]['id'],
                        'idOutlet' => $dUser[0]['idOutlet'],
                        'date'    => date("Y-m-d")
                    ]);
                } else {
                    // return redirect();
                    return view('login');
                }
            } else {
                $response = 'Wrong Password';
                return view('login', ['response' => $response]);
                // echo 'FALSE';
            }
        } catch (Exception $e) {
            //  @dd($e);
            $response = 'Username Not Available';
            return view('login', ['response' => $response]);
            // echo "Username Not Available";
        }
    }
    public function login(Request $request)
    {
        // @dd($request->all());
        // https://www.youtube.com/watch?v=Xo1yJHkPEVM
        $data = dUser::where('Username', $request->username)->first();
        // @dd($data);
        if ($data) {
            // if(Hash::check($request->password,$data->password)){
            //     session(['berhasil_login' => true]);
            //     session(['idUser' => $data->id]);
            //     return redirect('user/dashboard');
            // }
            if ($request->password == $data->Password) {
                $tanggalID = null;
                try{
                    $tanggalAll = tanggalAll::where('Tanggal', '=', date("Y-m-d"))->first();
                    if ($tanggalAll == null) {
                        $tanggalID = tanggalAll::create([
                            'Tanggal' => date("Y-m-d"),
                        ])->id;
                    } else {
                        $tanggalID = $tanggalAll['id'];
                    }
                }catch(Exception $e){
                    $tanggalID = tanggalAll::create([
                        'Tanggal' => date("Y-m-d"),
                    ])->id;
                }
                if ($data['idRole'] == '2') { //untuk role user
                    $dOutlet = $data->doutlets;
                    $dBrand = doutlet::find($data['idOutlet'])->dBrands;
                    session(['berhasil_login' => true]);
                    session([
                        'Brand' => $dBrand['Nama Brand'],
                        'idBrand' => $dBrand['id'],
                        'brandImage' => $dBrand['Image'],
                        'Outlet' => $dOutlet['Nama Store'],
                        'idPengisi' => $data['id'],
                        'idOutlet' => $data['idOutlet'],
                        'date'    => date("Y-m-d"),
                        'idTanggal' => $tanggalID
                    ]);
                    return redirect('user/dashboard');
                } else if ($data['idRole'] == '1') { //untuk role admin
                    session(['berhasil_login' => true]);
                    session([
                        'idPengisi' => $data['id'],
                        'date'    => date("Y-m-d"),
                        'namaPengisi' => $data['Nama Lengkap'],
                        'idTanggal' => $tanggalID
                    ]);
                    return redirect('accounting/revisi/so');
                } else if ($data['idRole'] == '3') {
                    session(['berhasil_login' => true]);
                    session([
                        'idPengisi' => $data['id'],
                        'date'    => date("Y-m-d"),
                        'namaPengisi' => $data['Nama Lengkap'],
                        'idTanggal' => $tanggalID
                    ]);
                    return redirect('admin/so/item');
                } else if($data['idRole'] == '4'){
                    //idRole 4 untuk DC / Gudang
                    session(['berhasil_login' => true]);
                    session([
                        'idPengisi' => $data['id'],
                        'date'    => date("Y-m-d"),
                        'namaPengisi' => $data['Nama Lengkap'],
                        'idTanggal' => $tanggalID
                    ]);
                    return redirect('gudang/soBulanan');
                }
                else {
                    return redirect('/')->with('message', 'Role tidak terdaftar');
                }
            }
        }
        return redirect('/')->with('message', 'Username atau Password Salah');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');
    }

    public function getAllUser()
    {
        $userAll = dUser::all();
        $allUser = [];
        for ($i = 0; $i < $userAll->count(); $i++) {
            array_push($allUser, (object)[
                'id' => $userAll[$i]->id,
                'nama' => $userAll[$i]['Nama Lengkap']
            ]);
        }
        return response()->json([
            'user' => $allUser
        ]);
    }

    public function getAllDate($idOutlet, Request $request)
    {
        // echo $idOutlet;
        $allData = doutlet::find($idOutlet);
        // $allTanggal = tanggalAll::orderBy('Tanggal', 'DESC')->get();
        $allTanggal = tanggalAll::whereYear('Tanggal', '=', $request->year)->whereMonth('Tanggal', '=', $request->month)->get();

        $dateSales = $allData->dateSales;
        $datefsoharian = $allData->datefsoharian;
        $datePattyCash = $allData->datePattyCash;
        $dateWaste = $allData->dateWaste;
        $itemTanggal = [];

        $idSalesDate = [];
        $idfsoharian = [];
        $idPattyCash = [];
        $idWaste = [];

        for ($i = 0; $i < $dateSales->count(); $i++) {
            array_push($idSalesDate, $dateSales[$i]->id);
        }
        for ($i = 0; $i < $datefsoharian->count(); $i++) {
            array_push($idfsoharian, $datefsoharian[$i]->id);
        }
        for ($i = 0; $i < $datePattyCash->count(); $i++) {
            array_push($idPattyCash, $datePattyCash[$i]->id);
        }
        for ($i = 0; $i < $dateWaste->count(); $i++) {
            array_push($idWaste, $dateWaste[$i]->id);
        }

        for ($i = 0; $i < $allTanggal->count(); $i++) {
            $dataExist = false;
            $existSales = 0;
            $existFso = 0;
            $existPattyCash = 0;
            $existWaste = 0;
            for ($j = 0; $j < count($idSalesDate); $j++) {
                if ($idSalesDate[$j] == $allTanggal[$i]->id) {
                    $existSales = 1;
                    $dataExist = true;
                    break;
                }
            }
            for ($j = 0; $j < count($idfsoharian); $j++) {
                if ($idfsoharian[$j] == $allTanggal[$i]->id) {
                    $existFso = 1;
                    $dataExist = true;
                    break;
                }
            }
            for ($j = 0; $j < count($idPattyCash); $j++) {
                if ($idPattyCash[$j] == $allTanggal[$i]->id) {
                    $existPattyCash = 1;
                    $dataExist = true;
                    break;
                }
            }
            for ($j = 0; $j < count($idWaste); $j++) {
                if ($idWaste[$j] == $allTanggal[$i]->id) {
                    $existWaste = 1;
                    $dataExist = true;
                    break;
                }
            }
            if ($dataExist) {
                array_push($itemTanggal, (object)[
                    'Tanggal' => $allTanggal[$i]->Tanggal,
                    'idTanggal' => $allTanggal[$i]->id,
                    'sales' => $existSales,
                    'fso' => $existFso,
                    'pcash' => $existPattyCash,
                    'waste' => $existWaste
                ]);
            }
        }
        return response()->json([
            'DataTanggal' => $itemTanggal
        ]);
    }

    public function getAllDateBetween($fromDate, $toDate)
    {
        //menerapkan eager eloquent
        $allDate = tanggalAll::with('salesharians', 'fsoharians', 'pattyCashHarians', 'wasteHarians','reimburses.penerimaReimburses','setorans')->whereBetween('Tanggal', array($fromDate, $toDate))->orderBy('Tanggal', 'DESC')->get();
        // @dd($allDate[4]->salesharians);
        $allOutlet = doutlet::all();
        $allSesi = listSesi::orderBy('id', 'ASC')->get();
        // @dd($allSesi);
        //mapping => sesi 1, sesi 2, sesi 3
        $itemTanggal = [];
        for ($i = 0; $i < count($allDate); $i++) {
            $itemOutlet = [];
            for ($j = 0; $j < $allOutlet->count(); $j++) {
                $salesData = [];
                $fsoData = [];
                $pattyCashData = [];
                $wasteData = [];

                $reimburseStatus = 0;
                $reimburseHO = $allDate[$i]->reimburses->where('idOutlet', '=', $allOutlet[$j]->id)->first();
                if($reimburseHO != null){
                    if($reimburseHO->penerimaReimburses->count() > 0){
                        $reimburseStatus = 1;
                    }
                }

                $setoranStatus = 0;
                $setoranHO = $allDate[$i]->setorans->where('idOutlet', '=', $allOutlet[$j]->id);
                if($setoranHO->count() > 0){
                    $setoranStatus = 1;
                }

                for ($k = 0; $k < $allSesi->count(); $k++) {
                    $salesHarian = $allDate[$i]->salesharians->where('idOutlet', '=', $allOutlet[$j]->id)->where('idSesi', '=', $allSesi[$k]->id);
                    $fsoHarian = $allDate[$i]->fsoharians->where('idOutlet', '=', $allOutlet[$j]->id)->where('idSesi', '=', $allSesi[$k]->id);
                    $pattyCashHarian = $allDate[$i]->pattyCashHarians->where('idOutlet', '=', $allOutlet[$j]->id)->where('idSesi', '=', $allSesi[$k]->id);
                    $wasteHarian = $allDate[$i]->wasteHarians->where('idOutlet', '=', $allOutlet[$j]->id)->where('idSesi', '=', $allSesi[$k]->id);

                    if (count($salesHarian) > 0) {
                        array_push($salesData,1);
                    }else{
                        array_push($salesData,0);
                    }

                    if (count($fsoHarian) > 0) {
                        array_push($fsoData,1);
                    }else{
                        array_push($fsoData,0);
                    }

                    if (count($pattyCashHarian) > 0) {
                        array_push($pattyCashData,1);
                    }else{
                        array_push($pattyCashData,0);
                    }

                    if (count($wasteHarian) > 0) {
                        array_push($wasteData,1);
                    }else{
                        array_push($wasteData,0);
                    }
                }

                array_push($itemOutlet, (object)[
                    'outlet' => $allOutlet[$j]['Nama Store'],
                    'data' => array($fsoData, $salesData, $pattyCashData, $wasteData),
                    'reimburse' => $reimburseStatus,
                    'setoran' => $setoranStatus
                ]);
            }
            array_push($itemTanggal, (object)[
                'Tanggal' => $allDate[$i]->Tanggal,
                'itemOutlet' => $itemOutlet,
            ]);
        }

        return response()->json([
            'dataTanggal' => $itemTanggal
        ]);
    }
}
