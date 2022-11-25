<?php

use App\Http\Controllers\fsoHarianController;
use App\Http\Controllers\itemSOController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\pattyCashController;
use App\Http\Controllers\salesHarianController;
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
Route::get('soHarian/user/showDetail/{id}/{date}', [fsoHarianController::class, 'showOnDate']);//show id untuk outlet, berdasarkan tanggal
Route::get('soHarian/date/getId', [fsoHarianController::class, 'showAndCreateID']);
Route::get('soHarian/store/data', [soFillController::class, 'store']);
Route::get('soHarian/edit/data/{id}', [fsoHarianController::class, 'editSoFill']);
Route::get('soHarian/edit/userFill/{id}', [fsoHarianController::class, 'editFsoHarian']);
Route::get('soHarian/edit/qty/rev/data', [fsoHarianController::class, 'editQtyRev']);
Route::get('soHarian/show/data/all', [fsoHarianController::class, 'showAllDataSo']);
Route::get('soHarian/show/revision/all', [fsoHarianController::class, 'showDateRevision']);
Route::get('soHarian/show/revision/done', [fsoHarianController::class, 'showDateRevisionDone']);
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
Route::get('salesHarian/show/list/all/{id}',[salesHarianController::class,'showListBasedType']);//show all item based on id outlet
Route::get('salesHarian/user/showTable/{id}/{date}', [salesHarianController::class, 'show']); //show id untuk outlet
Route::get('salesHarian/user/showAllData/{id}/{date}', [salesHarianController::class, 'showAllData']); //show id untuk outlet
Route::get('salesHarian/show/revision/all', [salesHarianController::class, 'showDateRevision']); //menampilkan semua tanggal revisi
Route::get('salesHarian/show/revision/done', [salesHarianController::class, 'showDateRevisionDone']); //menampilkan semua tanggal revisi
Route::get('salesHarian/items/show/req', [salesHarianController::class, 'showAllRequest']);
Route::get('salesHarian/items/store/request', [salesHarianController::class, 'storeRevisionCheck']);


Route::get('salesHarian/data/getId', [salesHarianController::class, 'showAndCreateID']);
Route::get('salesHarian/store/data', [salesHarianController::class, 'store']);
Route::get('salesHarian/items/store/revision', [salesHarianController::class, 'storeItemRevision']);
Route::get('salesHarian/items/show/rev/{id}',[salesHarianController::class, 'showRevisiOutlet']);//revision by id outlet

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
Route::get('pattyCash/items/revisi/outlet/{id}', [pattyCashController::class, 'showRevisiOutlet']);//Menampilkan revisi per outlet
Route::get('pattyCash/brand/show', [pattyCashController::class, 'showAllBrand']);
Route::get('pattyCash/brand/show/item', [pattyCashController::class, 'showItemOnBrand']);
Route::get('pattyCash/user/showTable/{id}/{date}', [pattyCashController::class, 'show']); //show id untuk outlet


Route::get('pattyCash/show/revision/all', [pattyCashController::class, 'showDateRevision']);
Route::get('pattyCash/show/revision/done', [pattyCashController::class, 'showDateRevisionDone']);

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

Route::get('pattyCash/data/getId', [pattyCashController::class, 'showAndCreateID']);
Route::get('pattyCash/store/data', [pattyCashController::class, 'store']);
Route::get('show/satuan', [pattyCashController::class, 'showSatuan']);

Route::get('pattyCash', function () {
    return view('pattyCash.typePattyCash');
});

Route::get('waste/items/show', [wasteController::class, 'showAll']);
Route::get('waste/items/store', [wasteController::class, 'storeItem']);
Route::get('waste/items/show/req', [wasteController::class, 'showAllRequest']);
Route::get('waste/items/show/rev/{id}',[wasteController::class, 'showRevisiOutlet']);//revision by id outlet
Route::get('waste/items/store/revision', [wasteController::class, 'storeItemRevision']);
Route::get('waste/brand/show/item', [wasteController::class, 'showItemOnBrand']);
Route::get('waste/brands/store/item', [wasteController::class, 'storeBrandItem']);
Route::get('waste/brands/item/del', [wasteController::class, 'destroyItemOnBrand']);
Route::get('waste/items/store/revision/request', [wasteController::class, 'storeRevisionCheck']);
Route::get('waste/user/showTable/{id}/{date}', [wasteController::class, 'show']); //show id untuk outlet
Route::get('waste/data/getId', [wasteController::class, 'showAndCreateID']);
Route::get('waste/store/data', [wasteController::class, 'store']);
Route::get('waste/edit/qty/data/{id}', [wasteController::class, 'editQty']);
Route::get('waste/show/revision/all', [wasteController::class, 'showDateRevision']);
Route::get('waste/show/revision/done', [wasteController::class, 'showDateRevisionDone']);
Route::get('waste/edit/cu/rev/data', [wasteController::class, 'editQtyRev']);
Route::get('waste/user/showAllData/{id}/{date}', [wasteController::class, 'showAllData']); //show id untuk outlet


Route::get('wasteHarian', function () {
    return view('wasteHarian.typeWaste');
});

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
        // @dd(session()->all());
        // @dd(session('date'));
        return view('userControl2.dashboard');
    });
    
    Route::get('admin/item/so', function () {
        return view('adminControl.setItem.soHarian');
    });
    Route::get('admin/item/sales', function () {
        return view('adminControl.setItem.sales');
    });
    Route::get('accounting/revisi/sales', function () {
        return view('accountingControl.revisi.sales');
    });
    Route::get('accounting/revisi/so', function () {
        return view('accountingControl.revisi.so');
    });
    Route::get('accounting/revisi/pattyCash', function () {
        return view('accountingControl.revisi.pattyCash');
    });
    Route::get('accounting/revisi/waste', function () {
        return view('accountingControl.revisi.waste');
    });
    Route::get('user/soHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.soHarian',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/detail/soHarian/{dateSelect}',function($dateSelect){
        return view('userControl2.soHarianDetail',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/salesHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.salesHarian',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/detail/salesHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.salesHarianDetail',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/request/salesHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.salesHarianRequest',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/wasteHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.wasteHarian',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/detail/wasteHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.wasteHarianDetail',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/request/wasteHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.wasteHarianRequest',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/pattyCashHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.pattyCashHarian',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/detail/pattyCashHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.pattyCashHarianDetail',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/request/pattyCashHarian/{dateSelect}', function($dateSelect){
        return view('userControl2.pattyCashHarianRequest',[
            'dateSelect' => $dateSelect
        ]);
    });
    Route::get('user/pattyCashHarian1/{dateSelect}', function($dateSelect){
        return view('userControl2.pattyCashHarian1',[
            'dateSelect' => $dateSelect
        ]);
    });
});
