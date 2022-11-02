<?php

namespace App\Http\Controllers;

use App\Models\dBrand;
use App\Models\doutlet;
use App\Models\dUser;
use App\Models\fsoHarian;
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
                if ($data['idRole'] == '2') {//untuk role user
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
                        'date'    => date("Y-m-d")
                    ]);
                    return redirect('user/dashboard');
                }
                else if($data['idRole']=='1'){//untuk role admin
                    session(['berhasil_login' => true]);
                    session([
                        'idPengisi' => $data['id'],
                        'date'    => date("Y-m-d"),
                        'namaPengisi' => $data['Nama Lengkap']
                    ]);
                    return redirect('accounting/revisi/so');
                }
                else{
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

    public function soHarian($date)
    {
    }
    public function getAllDate($idOutlet)
    {
        // echo $idOutlet;
        $allData = doutlet::find($idOutlet);
        $allTanggal = tanggalAll::orderBy('Tanggal', 'DESC')->get();

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
}
