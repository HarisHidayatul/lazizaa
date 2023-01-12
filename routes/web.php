<?php

use App\Http\Controllers\fsoHarianController;
use App\Http\Controllers\itemSOController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\pattyCashController;
use App\Http\Controllers\reimburseController;
use App\Http\Controllers\salesHarianController;
use App\Http\Controllers\setoranController;
use App\Http\Controllers\soFillController;
use App\Http\Controllers\soHarianController;
use App\Http\Controllers\typeOutletItemController;
use App\Http\Controllers\typeSalesController;
use App\Http\Controllers\wasteController;
use App\Models\dUser;
use App\Models\fsoHarian;
use App\Models\itemWaste;
use App\Models\pattyCashHarian;
use App\Models\salesharian;
use App\Models\wasteHarian;
use Database\Seeders\soHarian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//php artisan optimize //for clear cache
//php artisan route:clear //for clear cache
//composer dump-autoload //untuk optimize dan auto load folder
Route::get('/soHarian', function () {
    return view('soHarian', [
        'datafso' => fsoHarian::orderBy('Tanggal', 'DESC')->get(),
        // 'datafso' => fsoHarian::orderBy('Tanggal', 'DESC')->paginate(3,'*',1,2),
        // 'datafso' => fsoHarian::orderBy('Tanggal', 'ASC')->get(),
        // 'datafso' => fsoHarian::whereBetween(), https://stackoverflow.com/questions/66206284/get-data-after-start-date-laravel
        'date'    => date("Y-m-d")
    ]);
});
//Flow untuk FSO Harian
Route::get('itemSO/show', [itemSOController::class, 'index']); //get all item SO
Route::get('itemSO/store', [itemSOController::class, 'store']);

Route::get('listType/soHarian/show', [typeOutletItemController::class, 'index']);
Route::get('listType/soHarian/store', [typeOutletItemController::class, 'store']);
Route::get('listType/soHarian/store/item', [typeOutletItemController::class, 'storeItem']);
Route::get('listType/soHarian/store/outlet', [typeOutletItemController::class, 'storeOutletOnType']);
Route::get('listType/soHarian/show/item/{id}', [typeOutletItemController::class, 'showByItem']);
Route::get('listType/soHarian/show/outlet/{id}', [typeOutletItemController::class, 'showByOutlet']);
Route::get('listType/soHarian/show/item/outlet/{id}', [typeOutletItemController::class, 'showItemByOutlet']);
Route::get('listType/soHarian/delete/itemOnType', [typeOutletItemController::class, 'destroyItemOnType']);
Route::get('listType/soHarian/delete/outletOnType', [typeOutletItemController::class, 'destroyOutletOnType']);
Route::get('show/outlet', [typeOutletItemController::class, 'indexOutlet']);

Route::get('soHarian/user/showTable/{id}', [fsoHarianController::class, 'show']); //show id untuk outlet
Route::get('soHarian/user/showDetail/{id}/{date}/{idSesi}', [fsoHarianController::class, 'showOnDate']); //show id untuk outlet, berdasarkan tanggal
Route::get('soHarian/user/showDetailLastSesi/{id}/{date}', [fsoHarianController::class, 'showOnDateLastSesi']);

Route::get('soHarian/date/getId', [fsoHarianController::class, 'showAndCreateID']);
Route::get('soHarian/store/data', [soFillController::class, 'store']);
Route::get('soHarian/edit/data/{id}', [fsoHarianController::class, 'editSoFill']);
Route::get('soHarian/edit/userFill/{id}', [fsoHarianController::class, 'editFsoHarian']);
Route::get('soHarian/edit/qty/rev/data', [fsoHarianController::class, 'editQtyRev']);
// Route::get('soHarian/show/data/all', [fsoHarianController::class, 'showAllDataSo']);

Route::get('soHarian/show/revision/all/{fromDate}/{toDate}', [fsoHarianController::class, 'showDateRevision']);
Route::get('soHarian/show/revision/done/{fromDate}/{toDate}', [fsoHarianController::class, 'showDateRevisionDone']);

Route::get('soHarian/show/batas/{idOutlet}/{date}', [fsoHarianController::class, 'showDataBatasOnDate']);
Route::get('soHarian/setting/soBatas/show/{idOutlet}', [fsoHarianController::class, 'showBatas']);
Route::get('soHarian/setting/soBatas/store/{idOutlet}', [fsoHarianController::class, 'storeBatas']);

Route::get('soHarian/user/showAllSesi/{idOutlet}/{date}', [fsoHarianController::class, 'showAllDataSesi']); //menampilkan data di hari itu sesuai sesi

Route::get('fsoh/getId', [fsoHarianController::class, 'showAndCreateID']);

Route::get('soHarian', function () {
    return view('fsoHarian.typeOutlet');
});

//Flow untuk Sales Harian
Route::get('typeSales/show', [typeSalesController::class, 'index']); //get all type sales
Route::get('typeSales/item/show/{id}', [typeSalesController::class, 'show']);
Route::get('typeSales/show/item/eachtype', [typeSalesController::class, 'showItemType']);
Route::get('typeSales/items/show', [typeSalesController::class, 'showAll']);
Route::get('typeSales/outlet/show/item/{id}', [typeSalesController::class, 'showListOnOutlet']);
Route::get('typeSales/store', [typeSalesController::class, 'store']);
Route::get('typeSales/item/store', [typeSalesController::class, 'storeItem']);
Route::get('typeSales/item/outlet/store', [typeSalesController::class, 'storeItemOnOutlet']);
Route::get('typeSales/item/outlet/delete', [typeSalesController::class, 'destroyItemOnOutlet']);

Route::get('salesHarian/show/list/{id}', [salesHarianController::class, 'showList']);
Route::get('salesHarian/show/list/all/{id}', [salesHarianController::class, 'showListBasedType']); //show all item based on id outlet
Route::get('salesHarian/user/showTable/{id}/{date}/{idSesi}', [salesHarianController::class, 'show']); //show id untuk outlet
Route::get('salesHarian/user/showAllData/{id}/{date}/{idSesi}', [salesHarianController::class, 'showAllData']); //show id untuk outlet

Route::get('salesHarian/user/showAllSesi/{idOutlet}/{date}', [salesHarianController::class, 'showAllDataSesi']); //menampilkan data di hari itu sesuai sesi
Route::get('salesHarian/user/showAllSesi2/{idOutlet}/{date}', [salesHarianController::class, 'showAllDataSesi2']); //menampilkan data di hari itu sesuai sesi


Route::get('salesHarian/show/salesFill/{id}', [salesHarianController::class, 'showOnSalesFill']); //menampilkan data seperti showAllData

Route::get('salesHarian/show/revision/all/{fromDate}/{toDate}', [salesHarianController::class, 'showDateRevision']); //menampilkan semua tanggal revisi
Route::get('salesHarian/show/revision/outlet/{id}', [salesHarianController::class, 'showRevisionOutlet']); //menampilkan revisi outlet berdasarkan id

Route::get('salesHarian/show/revision/done/{fromDate}/{toDate}', [salesHarianController::class, 'showDateRevisionDone']); //menampilkan semua tanggal revisi


Route::get('salesHarian/show/revision/done/outlet/{id}', [salesHarianController::class, 'showRevisionDoneOutlet']);

Route::get('salesHarian/items/show/req', [salesHarianController::class, 'showAllRequest']);
Route::get('salesHarian/items/store/request', [salesHarianController::class, 'storeRevisionCheck']);
Route::get('salesHarian/items/show/req/all/{id}', [salesHarianController::class, 'showReqOutlet']);

Route::get('salesHarian/data/getId', [salesHarianController::class, 'showAndCreateID']);
Route::get('salesHarian/store/data', [salesHarianController::class, 'store']);
Route::get('salesHarian/items/store/revision', [salesHarianController::class, 'storeItemRevision']);
Route::get('salesHarian/items/show/rev/{id}', [salesHarianController::class, 'showRevisiOutlet']); //revision by id outlet

Route::get('salesHarian/edit/cu/data/{id}', [salesHarianController::class, 'editCu']);
Route::get('salesHarian/edit/cu/rev/data', [salesHarianController::class, 'editCuRev']);

Route::get('salesHarian/edit/total/data/{id}', [salesHarianController::class, 'editTotal']);
Route::get('salesHarian/edit/total/rev/data', [salesHarianController::class, 'editTotalRev']);

Route::get('salesHarian', function () {
    return view('salesHarian.typeSales');
});

//Flow untuk Patty Cash
Route::get('pattyCash/items/show', [pattyCashController::class, 'showAll']);
Route::get('pattyCash/items/show/revisi', [pattyCashController::class, 'showAllRevisi']);
Route::get('pattyCash/items/revisi/outlet/{id}', [pattyCashController::class, 'showRevisiOutlet']); //Menampilkan revisi per outlet
Route::get('pattyCash/brand/show', [pattyCashController::class, 'showAllBrand']);
Route::get('pattyCash/brand/show/item', [pattyCashController::class, 'showItemOnBrand']);
Route::get('pattyCash/user/showTable/{id}/{date}', [pattyCashController::class, 'show']); //show id untuk outlet
Route::get('pattyCash/user/showAllData/{id}/{date}/{idSesi}', [pattyCashController::class, 'showAllData']); //show id untuk outlet

Route::get('pattyCash/show/revision/all/{fromDate}/{toDate}', [pattyCashController::class, 'showDateRevision']);
Route::get('pattyCash/show/revision/done/{fromDate}/{toDate}', [pattyCashController::class, 'showDateRevisionDone']);

Route::get('pattyCash/outlet/show', [pattyCashController::class, 'showAllOutlet']);
Route::get('pattyCash/items/store', [pattyCashController::class, 'storeItem']);
Route::get('pattyCash/items/store/revision', [pattyCashController::class, 'storeItemRevision']);
Route::get('pattyCash/items/store/revision/request', [pattyCashController::class, 'storeRevisionCheck']);
Route::get('pattyCash/brands/store/item', [pattyCashController::class, 'storeBrandItem']);
Route::get('pattyCash/brands/item/del', [pattyCashController::class, 'destroyItemOnBrand']);

Route::get('pattyCash/edit/qty/data/{id}', [pattyCashController::class, 'editQty']);
Route::get('pattyCash/edit/qty/rev/data', [pattyCashController::class, 'editQtyRev']);

Route::get('pattyCash/edit/total/data/{id}', [pattyCashController::class, 'editTotal']);

Route::get('pattyCash/edit/total/rev/data', [pattyCashController::class, 'editTotalRev']);

Route::get('pattyCash/show/revision/outlet/{id}', [pattyCashController::class, 'showRevisionOutlet']); //menampilkan revisi outlet berdasarkan id
Route::get('pattyCash/show/revision/done/outlet/{id}', [pattyCashController::class, 'showRevisionDoneOutlet']);
Route::get('pattyCash/show/pattyCashFill/{id}', [pattyCashController::class, 'showOnPattyCashFill']); //menampilkan data seperti showAllData

Route::get('pattyCash/items/show/req/all/{id}', [pattyCashController::class, 'showReqOutlet']);

Route::get('pattyCash/data/getId', [pattyCashController::class, 'showAndCreateID']);
Route::get('pattyCash/store/data', [pattyCashController::class, 'store']);

Route::get('show/satuan', [pattyCashController::class, 'showSatuan']);

Route::get('pattyCash/user/showAllSesi/{idOutlet}/{date}', [pattyCashController::class, 'showAllDataSesi']); //menampilkan data di hari itu sesuai sesi

Route::get('pattyCash', function () {
    return view('pattyCash.typePattyCash');
});

Route::get('waste/items/show', [wasteController::class, 'showAll']);
Route::get('waste/items/store', [wasteController::class, 'storeItem']);
Route::get('waste/items/show/req', [wasteController::class, 'showAllRequest']);
Route::get('waste/items/show/rev/{id}', [wasteController::class, 'showRevisiOutlet']); //revision by id outlet
Route::get('waste/items/store/revision', [wasteController::class, 'storeItemRevision']);
Route::get('waste/brand/show/item', [wasteController::class, 'showItemOnBrand']);
Route::get('waste/brands/store/item', [wasteController::class, 'storeBrandItem']);
Route::get('waste/brands/item/del', [wasteController::class, 'destroyItemOnBrand']);
Route::get('waste/items/store/revision/request', [wasteController::class, 'storeRevisionCheck']);
Route::get('waste/user/showTable/{id}/{date}', [wasteController::class, 'show']); //show id untuk outlet
Route::get('waste/data/getId', [wasteController::class, 'showAndCreateID']);
Route::get('waste/store/data', [wasteController::class, 'store']);
Route::get('waste/edit/qty/data/{id}', [wasteController::class, 'editQty']);

Route::get('waste/show/revision/all/{fromDate}/{toDate}', [wasteController::class, 'showDateRevision']);
Route::get('waste/show/revision/done/{fromDate}/{toDate}', [wasteController::class, 'showDateRevisionDone']);

Route::get('waste/show/revision/outlet/{id}', [wasteController::class, 'showRevisionOutlet']); //menampilkan revisi outlet berdasarkan id
Route::get('waste/show/revision/done/outlet/{id}', [wasteController::class, 'showRevisionDoneOutlet']);
Route::get('waste/show/wasteFill/{id}', [wasteController::class, 'showOnWasteFill']); //menampilkan data seperti showAllData

Route::get('waste/items/show/req/all/{id}', [wasteController::class, 'showReqOutlet']);

Route::get('waste/edit/cu/rev/data', [wasteController::class, 'editQtyRev']);
Route::get('waste/user/showAllData/{id}/{date}/{idSesi}', [wasteController::class, 'showAllData']); //show id untuk outlet

Route::get('waste/user/showAllSesi/{idOutlet}/{date}', [wasteController::class, 'showAllDataSesi']); //menampilkan data di hari itu sesuai sesi

Route::get('wasteHarian', function () {
    return view('wasteHarian.typeWaste');
});

Route::get('setoran/bank/type/show', [setoranController::class, 'showType']);
Route::get('setoran/bank/show/all', [setoranController::class, 'showAllBank']);
Route::get('setoran/bank/show/{idJenisBank}', [setoranController::class, 'showBank']);
Route::get('setoran/user/pengirim/createID', [setoranController::class, 'createIDPengirim']);
Route::get('setoran/penerima/createID', [setoranController::class, 'createIDPenerima']);
Route::get('setoran/penerima/edit', [setoranController::class, 'editPenerima']);
Route::get('setoran/penerima/show', [setoranController::class, 'showPenerima']);
Route::get('setoran/show/pengirim/eWallet/inPart/{idUser}', [setoranController::class, 'showPengirimEWalletPart']);
Route::get('setoran/show/pengirim/eWallet/all/{idUser}', [setoranController::class, 'showPengirimEWalletAll']);

Route::get('setoran/show/pengirim/transfer/inPart/{idUser}', [setoranController::class, 'showPengirimTransferPart']);
Route::get('setoran/show/pengirim/transfer/all/{idUser}', [setoranController::class, 'showPengirimTransferAll']);
Route::get('setoran/show/pengirim/inPart/{idUser}', [setoranController::class, 'showPengirimPart']);
Route::get('setoran/show/pengirim/all/{idUser}', [setoranController::class, 'showPengirimAll']);
Route::get('setoran/show/detail/{idSetoran}', [setoranController::class, 'showSetoranDetail']);

Route::get('setoran/show/pengirim/list/{idPengirimList}', [setoranController::class, 'showPengirimList']);
Route::get('setoran/show/data/inPart/{idOutlet}', [setoranController::class, 'showSetoranPart']);
Route::get('setoran/show/data/all/{idOutlet}', [setoranController::class, 'showSetoranAll']);
Route::get('setoran/penerima/sendData', [setoranController::class, 'createSetoran']);

Route::get('setoran', function () {
    return view('setoran.typeSetoran');
});

Route::get('reimburse/show/history/outlet/{idOutlet}/{countData}', [reimburseController::class, 'showHistory']);
Route::get('reimburse/show/detail/{idDetail}', [reimburseController::class, 'showDetail']);
Route::get('reimburse/update/history/cycle/{idOutlet}', [reimburseController::class, 'updateAllHistory']); //refresh historty
Route::get('reimburse/store/data', [reimburseController::class, 'storeDataReimburse']);

Route::get('reimburse/store/byIdTujuan/{idTujuan}', [reimburseController::class, 'storeReimburseIdTujuan']);

Route::get('reimburse/show/pengirim/all/{idUser}', [reimburseController::class, 'showPengirimAll']);

Route::get('user/show/all', [loginController::class, 'getAllUser']);

Route::get('/login', function () {
    return view('login');
});

Route::get('checkLogin', [loginController::class, 'loginCheck']);
Route::get('getAllDate/{idOutlet}', [loginController::class, 'getAllDate']);

Route::get('/', function () {
    return view('userControl2.login');
});
Route::post('user/login', [loginController::class, 'login']);

Route::group(['middleware' => 'cekLoginMiddleware'], function () {
    Route::get('user/logout', [loginController::class, 'logout']);
    Route::get('user/dashboard', function () {
        return view('userControl2.dashboard');
    });
    Route::get('admin/item/so', function () {
        // return view('adminControl.setItem.soHarian');
        return view('adminControl.setItem.index');
    });
    Route::get('admin/item/sales', function () {
        return view('adminControl.setItem.sales');
    });
    Route::get('accounting/revisi/sales', function () {
        return view('accountingControl.revisi.sales.index');
    });
    Route::get('accounting/revisi/so', function () {
        return view('accountingControl.revisi.so.index');
    });
    Route::get('accounting/revisi/pattyCash', function () {
        return view('accountingControl.revisi.pattyCash.index');
    });
    Route::get('accounting/revisi/waste', function () {
        return view('accountingControl.revisi.waste.index');
    });
    Route::get('user/soHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.soHarian', [
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/detail/soHarian/{dateSelect}/{idSesi}', function ($dateSelect, $idSesi) {
        return view('userControl2.soHarianDetail', [
            'dateSelect' => $dateSelect,
            'idSesi' => $idSesi
        ]);
    });
    Route::get('user/detail/all/soHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.soHarianDetailAll', [
            'dateSelect' => $dateSelect
        ]);
    });

    Route::get('user/setting/soHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.soHarianSettingBatas', [
            'dateSelect' => $dateSelect
        ]);
    });

    Route::get('user/salesHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.salesHarian', [
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/detail/salesHarian/{dateSelect}/{idSesi}', function ($dateSelect, $idSesi) {
        return view('userControl2.salesHarianDetail', [
            'dateSelect' => $dateSelect,
            'idSesi' => $idSesi
        ]);
    });

    Route::get('user/detail/all/salesHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.salesHarianDetailAll2', [
            'dateSelect' => $dateSelect
        ]);
    });

    Route::get('user/request/salesHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.salesHarianRequest', [
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/req/salesHarian/all', function () {
        return view('userControl2.salesHarianRequestAll');
    });
    Route::get('user/rev/salesHarian/all', function () {
        return view('userControl2.salesHarianRevAll');
    });
    Route::get('user/rev/salesHarian/done', function () {
        return view('userControl2.salesHarianRevDone');
    });
    Route::get('user/rev/salesHarian/all/date/{idSalesFill}', function ($idSalesFill) {
        return view('userControl2.salesHarianRevAllDetail', [
            'idSalesFill' => $idSalesFill
        ]);
    });
    Route::get('user/rev/salesHarian/done/date/{idSalesFill}', function ($idSalesFill) {
        return view('userControl2.salesHarianRevDoneDetail', [
            'idSalesFill' => $idSalesFill
        ]);
    });
    Route::get('user/wasteHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.wasteHarian', [
            'dateSelect' => $dateSelect
        ]);
    });

    Route::get('user/detail/wasteHarian/{dateSelect}/{idSesi}', function ($dateSelect, $idSesi) {
        return view('userControl2.wasteHarianDetail', [
            'dateSelect' => $dateSelect,
            'idSesi' => $idSesi
        ]);
    });

    Route::get('user/detail/all/wasteHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.wasteHarianDetailAll', [
            'dateSelect' => $dateSelect
        ]);
    });

    Route::get('user/request/wasteHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.wasteHarianRequest', [
            'dateSelect' => $dateSelect
        ]);
    });

    Route::get('user/req/wasteHarian/all', function () {
        return view('userControl2.wasteHarianRequestAll');
    });
    Route::get('user/rev/wasteHarian/all', function () {
        return view('userControl2.wasteHarianRevAll');
    });
    Route::get('user/rev/wasteHarian/done', function () {
        return view('userControl2.wasteHarianRevDone');
    });
    Route::get('user/rev/wasteHarian/all/date/{idWasteFill}', function ($idWasteFill) {
        return view('userControl2.wasteHarianRevAllDetail', [
            'idWasteFill' => $idWasteFill
        ]);
    });
    Route::get('user/rev/wasteHarian/done/date/{idWasteFill}', function ($idWasteFill) {
        return view('userControl2.wasteHarianRevDoneDetail', [
            'idWasteFill' => $idWasteFill
        ]);
    });
    Route::get('user/pattyCashHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.pattyCashHarian', [
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/detail/pattyCashHarian/{dateSelect}/{idSesi}', function ($dateSelect, $idSesi) {
        return view('userControl2.pattyCashHarianDetail', [
            'dateSelect' => $dateSelect,
            'idSesi' => $idSesi
        ]);
    });

    Route::get('user/detail/all/pattyCashHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.pattyCashHarianDetailAll', [
            'dateSelect' => $dateSelect
        ]);
    });


    Route::get('user/request/pattyCashHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.pattyCashHarianRequest', [
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/req/pattyCashHarian/all', function () {
        return view('userControl2.pattyCashHarianRequestAll');
    });
    Route::get('user/rev/pattyCashHarian/all', function () {
        return view('userControl2.pattyCashHarianAll');
    });
    Route::get('user/rev/pattyCashHarian/done', function () {
        return view('userControl2.pattyCashHarianRevDone');
    });
    Route::get('user/rev/pattyCashHarian/all/date/{idPattyCashFill}', function ($idPattyCashFill) {
        return view('userControl2.pattyCashHarianRevAllDetail', [
            'idPattyCashFill' => $idPattyCashFill
        ]);
    });
    Route::get('user/rev/pattyCashHarian/done/date/{idPattyCashFill}', function ($idPattyCashFill) {
        return view('userControl2.pattyCashHarianRevDoneDetail', [
            'idPattyCashFill' => $idPattyCashFill
        ]);
    });
    Route::get('user/setoran/home', function () {
        return view('userControl.setoran.home');
    });
    Route::get('user/setoran/history', function () {
        return view('userControl.setoran.allHistory');
    });
    Route::get('user/setoran/penerima', function () {
        return view('userControl.setoran.allPenerima');
    });
    Route::get('user/setoran/transfer', function () {
        return view('userControl.setoran.transfer');
    });
    Route::get('user/setoran/transfer/detail/{fromWhere}/{idSetoran}', function ($fromWhere, $idSetoran) {
        return view('userControl.setoran.detailTransfer', [
            'fromWhere' => $fromWhere,
            'idSetoran' => $idSetoran
        ]);
    });
    Route::get('user/setoran/transfer/add/pengirim', function () {
        return view('userControl.setoran.tambahRekeningBaru');
    });
    Route::get('user/setoran/transfer/kirim/{fromWhere}/{idPengirim}', function ($fromWhere, $idPengirim) {
        return view('userControl.setoran.kirimTransfer', [
            'fromWhere' => $fromWhere,
            'idPengirim' => $idPengirim
        ]);
    });
    Route::get('user/setoran/eWallet/add/pengirim', function () {
        return view('userControl.setoran.tambahEWalletBaru');
    });
    Route::get('user/setoran/eWallet/kirim/{fromWhere}/{idPengirim}', function ($fromWhere, $idPengirim) {
        return view('userControl.setoran.kirimEWallet', [
            'fromWhere' => $fromWhere,
            'idPengirim' => $idPengirim
        ]);
    });
    Route::get('user/setoran/eWallet', function () {
        return view('userControl.setoran.eWallet');
    });
    Route::get('user/setoran/eWallet/detail/{fromWhere}/{idSetoran}', function ($fromWhere, $idSetoran) {
        return view('userControl.setoran.detailEWallet', [
            'fromWhere' => $fromWhere,
            'idSetoran' => $idSetoran
        ]);
    });
    Route::get('user/setoran/wait', function () {
        return view('userControl.setoran.verifikasiWait');
    });

    Route::get('user/reimburse/history', function () {
        return view('userControl.reimburse.history');
    });

    Route::get('user/reimburse/detail/{idDetail}', function ($idDetail) {
        return view('userControl.reimburse.detail', [
            'idDetail' => $idDetail
        ]);
    });

    Route::get('user/reimburse/kirim', function () {
        return view('userControl.reimburse.kirim');
    });

    Route::get('user/reimburse/wait', function () {
        return view('userControl.reimburse.verifikasiWait');
    });
});
