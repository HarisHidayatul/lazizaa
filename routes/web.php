<?php

use App\Http\Controllers\commonController;
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
use App\Http\Controllers\robotController;
use App\Http\Controllers\prosesMutasiController;
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
use App\Http\Controllers\apiBeeCloudController;


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

//Flow untuk common fitur
Route::get('getServerTime',[commonController::class,'getServerTime']);

Route::get('common/satuan/show', [commonController::class, 'showSatuan']);
Route::get('common/satuan/store', [commonController::class, 'storeSatuan']);
Route::get('common/satuan/update/{id}', [commonController::class, 'updateSatuan']);

Route::get('common/brand/show', [commonController::class, 'showBrand']);
Route::get('common/brand/store', [commonController::class, 'storeBrand']);
Route::get('common/brand/update/{id}', [commonController::class, 'updateBrand']);

Route::get('common/outlet/show/{idBrand}', [commonController::class, 'showOutlet']);
Route::get('common/outlet/showAll', [commonController::class, 'showAllOutlet']);
Route::get('common/outlet/store', [commonController::class, 'storeOutlet']);
Route::get('common/outlet/update/{id}', [commonController::class, 'updateOutlet']);

Route::get('common/role/showAll', [commonController::class, 'showAllRole']);

Route::get('common/user/show/{idOutlet}', [commonController::class, 'showUser']);
Route::get('common/user/store', [commonController::class, 'storeUser']);
Route::get('common/user/update/{id}', [commonController::class, 'updateUser']);

//Flow untuk FSO Harian
Route::get('itemSO/initData', [itemSOController::class, 'initAllDataSO']);

Route::get('itemSO/show', [itemSOController::class, 'index']); //get all item SO
Route::get('itemSO/showAll', [itemSOController::class, 'showAllItem']);

Route::get('itemSO/store', [itemSOController::class, 'store']);
Route::get('itemSO/update/{id}', [itemSOController::class, 'update']);

Route::get('listType/soHarian/show', [typeOutletItemController::class, 'index']);
Route::get('listType/soHarian/store', [typeOutletItemController::class, 'store']);
Route::get('listType/soHarian/updateType/{id}', [typeOutletItemController::class, 'updateType']);
Route::get('listType/soHarian/updateKategori/{id}', [typeOutletItemController::class, 'updateKategori']);

Route::get('listType/soHarian/store/item', [typeOutletItemController::class, 'storeItem']);
Route::get('listType/soHarian/store/kategori', [typeOutletItemController::class, 'storeKategori']);

Route::get('listType/soHarian/store/outlet', [typeOutletItemController::class, 'storeOutletOnType']);
Route::get('listType/soHarian/show/item/{id}', [typeOutletItemController::class, 'showByItem']);
Route::get('listType/soHarian/show/outlet/{id}', [typeOutletItemController::class, 'showByOutlet']);
Route::get('listType/soHarian/show/item/outlet/{id}', [typeOutletItemController::class, 'showItemByOutlet']);
Route::get('listType/soHarian/delete/itemOnType', [typeOutletItemController::class, 'destroyItemOnType']);
Route::get('listType/soHarian/delete/outletOnType', [typeOutletItemController::class, 'destroyOutletOnType']);
Route::get('show/outlet', [typeOutletItemController::class, 'indexOutlet']);

Route::get('soHarian/user/showTable/{id}', [fsoHarianController::class, 'show']); //show id untuk outlet
Route::get('soHarian/user/showDetail/{id}/{date}/{idSesi}', [fsoHarianController::class, 'showOnDate']); //show id untuk outlet, berdasarkan tanggal
Route::get('soHarian/user/showDetailLastSesi/{id}/{date}/{idSesi}', [fsoHarianController::class, 'showOnDateLastSesi']); //menampilkan data so kemarin

Route::get('soHarian/date/getId', [fsoHarianController::class, 'showAndCreateID']);
Route::get('soHarian/store/data', [soFillController::class, 'store']);
Route::get('soHarian/edit/data', [fsoHarianController::class, 'editSoFill']);
Route::get('soHarian/edit/userFill/{id}', [fsoHarianController::class, 'editFsoHarian']);
Route::get('soHarian/edit/qty/rev/data', [fsoHarianController::class, 'editQtyRev']);
// Route::get('soHarian/show/data/all', [fsoHarianController::class, 'showAllDataSo']);

Route::get('soHarian/show/revision/all/{fromDate}/{toDate}', [fsoHarianController::class, 'showDateRevision']);
Route::get('soHarian/show/revision/done/{fromDate}/{toDate}', [fsoHarianController::class, 'showDateRevisionDone']);
Route::get('soHarian/show/history', [fsoHarianController::class, 'showHistory']); //history untuk bulanan
Route::get('soHarian/show/history2', [fsoHarianController::class, 'showHistory2']); //history untuk harian
Route::get('soHarian/show/history3', [fsoHarianController::class, 'showHistory3']);

Route::get('soHarian/show/batas/{idOutlet}/{date}', [fsoHarianController::class, 'showDataBatasOnDate']);
Route::get('soHarian/setting/soBatas/show/{idOutlet}', [fsoHarianController::class, 'showBatas']);
Route::get('soHarian/setting/soBatas/store/{idOutlet}', [fsoHarianController::class, 'storeBatas']);

Route::get('soHarian/user/showAllSesi/{idOutlet}/{date}', [fsoHarianController::class, 'showAllDataSesi']); //menampilkan data di hari itu sesuai sesi

Route::get('fsoh/getId', [fsoHarianController::class, 'showAndCreateID']);


//Flow untuk Sales Harian
Route::get('typeSales/show', [typeSalesController::class, 'index']); //get all type sales
Route::get('typeSales/item/show/{id}', [typeSalesController::class, 'show']);
Route::get('typeSales/show/item/eachtype', [typeSalesController::class, 'showItemType']);
Route::get('typeSales/items/show', [typeSalesController::class, 'showAll']);
Route::get('typeSales/outlet/show/item/{id}', [typeSalesController::class, 'showListOnOutlet']);
Route::get('typeSales/store', [typeSalesController::class, 'store']);
Route::get('typeSales/item/store', [typeSalesController::class, 'storeItem']);
Route::get('typeSales/item/outlet/store', [typeSalesController::class, 'storeItemOnOutlet']);
Route::get('typeSales/item/outlet/update/{id}', [typeSalesController::class, 'update']);
Route::get('typeSales/type/update/{id}', [typeSalesController::class, 'updateType']);
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

// Route::get('salesHarian/edit/total/data/{id}', [salesHarianController::class, 'editTotal']);
Route::get('salesHarian/edit/total/rev/data', [salesHarianController::class, 'editTotalRev']);

Route::get('salesHarian/show/verifikasi/{idOutlet}/{fromDate}/{toDate}', [salesHarianController::class, 'showVerifOutlet']);
Route::get('salesHarian/update/verifikasi', [salesHarianController::class, 'updateVerifOutlet']);

Route::get('salesHarian/show/laporanSales/{idOutlet}/{countData}/{startDate}/{stopDate}', [salesHarianController::class, 'showReimburseSales']);

//Flow untuk Patty Cash
Route::get('pattyCash/initData', [pattyCashController::class, 'initAllDataPattyCash']);
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
Route::get('pattyCash/jenisItem/store', [pattyCashController::class, 'storeJenis']);
Route::get('pattyCash/kategoriItem/store', [pattyCashController::class, 'storeKategori']);

Route::get('pattyCash/update/item/{id}', [pattyCashController::class, 'updateItem']);
Route::get('pattyCash/update/jenis/{id}', [pattyCashController::class, 'updateJenis']);
Route::get('pattyCash/update/kategori/{id}', [pattyCashController::class, 'updateKategori']);

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

Route::get('waste/items/show', [wasteController::class, 'showAll']);
Route::get('waste/items/store', [wasteController::class, 'storeItem']);
Route::get('waste/items/update/{id}', [wasteController::class, 'updateItem']);
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

Route::get('waste/show/history/outlet/{idOutlet}/{countData}/{startDate}/{stopDate}', [wasteController::class, 'showHistory']);

Route::get('waste/items/show/req/all/{id}', [wasteController::class, 'showReqOutlet']);

Route::get('waste/edit/cu/rev/data', [wasteController::class, 'editQtyRev']);
Route::get('waste/user/showAllData/{id}/{date}/{idSesi}', [wasteController::class, 'showAllData']); //show id untuk outlet

Route::get('waste/user/showAllSesi/{idOutlet}/{date}', [wasteController::class, 'showAllDataSesi']); //menampilkan data di hari itu sesuai sesi

Route::get('setoran/bank/type/show', [setoranController::class, 'showType']);
Route::get('setoran/bank/show/all', [setoranController::class, 'showAllBank']);
Route::get('setoran/bank/create', [setoranController::class, 'createBank']);
Route::get('setoran/bank/update/{id}', [setoranController::class, 'updateBank']);
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
Route::get('setoran/update/accounting/revisi/{id}', [setoranController::class, 'update']);
Route::get('setoran/delete/accounting/revisi/{id}', [setoranController::class, 'delete']);

Route::get('setoran/generate/mutasi',[prosesMutasiController::class ,'generateMutasiSetoran']);

Route::get('setoran/show/pengirim/list/{idPengirimList}', [setoranController::class, 'showPengirimList']);
Route::get('setoran/show/data/inPart/{idOutlet}/{countData}/{startDate}/{stopDate}', [setoranController::class, 'showSetoranPart']);
Route::get('setoran/show/data/inPart2/{idOutlet}/{countData}/{startDate}/{stopDate}', [setoranController::class, 'showSetoranPart2']);
Route::get('setoran/show/data/all/{idOutlet}', [setoranController::class, 'showSetoranAll']);
Route::get('setoran/penerima/sendData', [setoranController::class, 'createSetoran']);

Route::delete('setoran/mutasi/delete',[prosesMutasiController::class,'deleteMutasiSetoran']);

Route::get('setoran', function () {
    return view('setoran.typeSetoran');
});

Route::get('reimburse/show/history/outlet/{idOutlet}/{countData}/{startDate}/{stopDate}', [reimburseController::class, 'showHistory']);
Route::get('reimburse/show/detail/{idDetail}', [reimburseController::class, 'showDetail']);
Route::get('reimburse/sales/show/detail/{idDetail}', [reimburseController::class, 'showDetailSales']);
Route::get('reimburse/sales/edit/detail/{idDetail}', [reimburseController::class, 'updateSalesReimburse']);

Route::get('reimburse/update/history/cycle/{idOutlet}', [reimburseController::class, 'updateAllHistory']); //refresh historty
Route::get('reimburse/update/history/allOutlet', [reimburseController::class, 'updateAllHistoryOutlet']); //Merefresh semua history outlet

Route::get('reimburse/update/accounting/revisi/{id}', [reimburseController::class, 'updateRevisiTerima']);
Route::get('reimburse/delete/accounting/revisi/{id}', [reimburseController::class, 'deleteRevisiTerima']);
Route::get('reimburse/store/data', [reimburseController::class, 'storeDataReimburse']);
Route::get('reimburse/sales/store/data', [reimburseController::class, 'storeDataReimburseSales']);

Route::get('reimburse/store/byIdTujuan/{idTujuan}', [reimburseController::class, 'storeReimburseIdTujuan']);

Route::get('reimburse/show/pengirim/all/{idUser}', [reimburseController::class, 'showPengirimAll']);

Route::delete('reimburse/mutasi/delete',[prosesMutasiController::class, 'deleteMutasiReimburse']);

Route::post('reimburse/generate/mutasi',[prosesMutasiController::class, 'generateMutasiReimburse']);

Route::get('robot/pembelian/show/all', [robotController::class, 'showPembelian']);
Route::post('robot/pembelian/create', [robotController::class, 'createRobotPembelian']);
Route::delete('robot/pembelian/delete', [robotController::class, 'deleteRobotPembelian']);

Route::get('robot/pembayaran/show/all', [robotController::class, 'showPembayaran']);
Route::post('robot/pembayaran/create', [robotController::class, 'createRobotPembayaran']);
Route::delete('robot/pembayaran/delete', [robotController::class, 'deleteRobotPembayaran']);

Route::get('robot/ecommerce/show/all',[robotController::class, 'showEcommerce']);
Route::post('robot/ecommerce/create', [robotController::class, 'createRobotEcommerce']);
Route::delete('robot/ecommerce/delete',[robotController::class,'deleteRobotEcommerce']);

Route::get('robot/mutasi455TfKas/show/all',[robotController::class, 'showMutasi455TfKas']);
Route::post('robot/mutasi455TfKas/create', [robotController::class, 'createRobotMutasi455TfKas']);
Route::delete('robot/mutasi455TfKas/delete',[robotController::class,'deleteRobotMutasi455TfKas']);

Route::get('robot/mutasi455TfKasPenerimaan/show/all',[robotController::class, 'showMutasi455TfKasPenerimaan']);
Route::post('robot/mutasi455TfKasPenerimaan/create', [robotController::class, 'createRobotMutasi455TfKasPenerimaan']);
Route::delete('robot/mutasi455TfKasPenerimaan/delete',[robotController::class,'deleteRobotMutasi455TfKasPenerimaan']);

Route::get('robot/mutasi455Pembayaran/show/all',[robotController::class, 'showMutasi455Pembayaran']);
Route::post('robot/mutasi455Pembayaran/create', [robotController::class, 'createRobotMutasi455Pembayaran']);
Route::delete('robot/mutasi455Pembayaran/delete',[robotController::class,'deleteRobotMutasi455Pembayaran']);

Route::get('robot/mutasi1003Setoran/show/all',[robotController::class, 'showMutasi1003Setoran']);
Route::post('robot/mutasi1003Setoran/create', [robotController::class, 'createRobotMutasi1003Setoran']);
Route::delete('robot/mutasi1003Setoran/delete',[robotController::class,'deleteRobotMutasi1003Setoran']);

Route::get('robot/mutasi455TfKasSukodono/show/all',[robotController::class, 'showMutasi455TfKasSukodono']);

Route::get('robot/mutasi165Reimburse/show/all',[robotController::class, 'showMutasi165Reimburse']);
Route::post('robot/mutasi165Reimburse/create', [robotController::class, 'createRobotMutasi165Reimburse']);
Route::delete('robot/mutasi165Reimburse/delete',[robotController::class,'deleteRobotMutasi165Reimburse']);

Route::get('robot/mutasi165PindahSaldo/show/all',[robotController::class, 'showMutasi165PindahSaldo']);
Route::post('robot/mutasi165PindahSaldo/create', [robotController::class, 'createRobotMutasi165PindahSaldo']);
Route::delete('robot/mutasi165PindahSaldo/delete',[robotController::class,'deleteRobotMutasi165PindahSaldo']);

Route::get('robot/mutasi165Pembayaran/show/all',[robotController::class, 'showMutasi165Pembayaran']);
Route::post('robot/mutasi165Pembayaran/create', [robotController::class, 'createRobotMutasi165Pembayaran']);
Route::delete('robot/mutasi165Pembayaran/delete',[robotController::class,'deleteRobotMutasi165Pembayaran']);

Route::get('robot/api/pembelian/show', [robotController::class, 'showRobotPembelian']);
Route::get('robot/api/pembelian/done/{id}', [robotController::class, 'doneRobotPembelian']);

Route::get('robot/api/mutasi455TfKas/show', [robotController::class, 'showRobotMutasi455TfKas']);
Route::get('robot/api/mutasi455TfKas/done/{id}', [robotController::class, 'doneRobotMutasi455TfKas']);

Route::get('robot/api/mutasi455TfKasPenerimaan/show', [robotController::class, 'showRobotMutasi455TfKasPenerimaan']);
Route::get('robot/api/mutasi455TfKasPenerimaan/done/{id}', [robotController::class, 'doneRobotMutasi455TfKasPenerimaan']);

Route::get('robot/api/mutasi455Pembayaran/show', [robotController::class, 'showRobotMutasi455Pembayaran']);
Route::get('robot/api/mutasi455Pembayaran/done/{id}', [robotController::class, 'doneRobotMutasi455Pembayaran']);

Route::get('robot/api/mutasi165PindahSaldo/show', [robotController::class, 'showRobotMutasi165PindahSaldo']);
Route::get('robot/api/mutasi165PindahSaldo/done/{id}', [robotController::class, 'doneRobotMutasi165PindahSaldo']);

Route::get('robot/api/pembayaran/show', [robotController::class, 'showRobotPembayaran']);
Route::get('robot/api/pembayaran/done/{id}', [robotController::class, 'doneRobotPembayaran']);

Route::get('robot/api/ecommerce/show',[robotController::class,'showRobotECommerce']);
Route::get('robot/api/ecommerce/done/{id}', [robotController::class, 'doneRobotECommerce']);

Route::get('robot/api/mutasi1003/setoran/show',[robotController::class,'showRobotMutasi1003']);
Route::get('robot/api/mutasi1003/setoran/done/{id}', [robotController::class, 'doneRobotMutasi1003']);

Route::get('robot/api/mutasi165/reimburse/show',[robotController::class,'showRobotReimburse165']);
Route::get('robot/api/mutasi165/reimburse/done/{id}', [robotController::class, 'doneRobotReimburse165']);

Route::get('robot/api/mutasi165/pembayaran/show',[robotController::class,'showRobotPembayaran165']);
Route::get('robot/api/mutasi165/pembayaran/done/{id}', [robotController::class, 'doneRobotPembayaran165']);

Route::post('mutasi/upload', [prosesMutasiController::class, 'createMutasi']);
Route::get('mutasi/show/all',[prosesMutasiController::class, 'showMutasiAll']);
Route::get('mutasi/show/id/{id}',[prosesMutasiController::class, 'showMutasi']);

Route::delete('mutasi/detail/delete',[prosesMutasiController::class, 'deleteMutasiDetail']);
Route::post('mutasi/detail/create',[prosesMutasiController::class, 'createMutasiDetail']);

Route::get('mutasi/show/sales',[prosesMutasiController::class, 'showMutasiSales']);
Route::get('mutasi/show/pelunasan/sales',[prosesMutasiController::class, 'showPelunasanMutasiSales']);
Route::post('mutasi/create/pelunasan/sales',[prosesMutasiController::class, 'createPelunasanMutasiSales']);

Route::delete('mutasi/delete/pelunasan/sales',[prosesMutasiController::class, 'delMutasiFromSales']);

Route::post('mutasi/generate/pelunasan',[prosesMutasiController::class, 'generateMutasiPelunasan']);
Route::post('mutasi/generate/detail',[prosesMutasiController::class, 'generateMutasiDetail']);

Route::get('mutasi/delete/complete/{idStart}/{idStop}',[prosesMutasiController::class, 'deleteMutasiFromId']);

Route::get('user/show/all', [loginController::class, 'getAllUser']);

Route::get('checkLogin', [loginController::class, 'loginCheck']);
Route::get('getAllDate/{idOutlet}', [loginController::class, 'getAllDate']);

Route::get('getAllDateBetween/{fromDate}/{toDate}', [loginController::class, 'getAllDateBetween']);

Route::get('/', function () {
    return view('userControl2.login');
});
Route::post('user/login', [loginController::class, 'login']);

Route::get('uploadImage', function () {
    return view('tesUploadImage');
});
Route::post('postImage', [commonController::class, 'postImageAndGetID']);
Route::get('showImageTemp/{idTempImgAll}', [commonController::class, 'showImageTemp']);
Route::get('delImageTemp/{idTempImgAll}', [commonController::class, 'deleteImageTemp']);
Route::get('moveImage/{fromPathFile}/{toPathFile}', [commonController::class, 'moveImage']);

Route::group(['middleware' => 'cekLoginMiddleware'], function () {
    Route::get('user/logout', [loginController::class, 'logout']);
    Route::get('user/dashboard', function () {
        return view('userControl2.dashboard');
    });

    //Route akses untuk gudang
    Route::get('gudang/soBulanan', function () {
        return view('gudangControl.stockOpname.bulanan.index');
    });
    Route::get('gudang/soHarian', function () {
        return view('gudangControl.stockOpname.harian.index');
    });

    Route::get('gudang/so/kategori', function () {
        return view('gudangControl.setItem.so.kategori.index');
    });
    Route::get('gudang/so/listItem', function () {
        return view('gudangControl.setItem.so.listItem.index');
    });

    //Route akses untuk admin
    Route::get('admin/so/item', function () {
        // return view('adminControl.setItem.soHarian');
        return view('adminControl.setItem.so.listItem.index');
    });
    Route::get('admin/so/setType', function () {
        return view('adminControl.setItem.so.setType.index');
    });
    Route::get('admin/so/setOutlet', function () {
        return view('adminControl.setItem.so.outletType.index');
    });

    Route::get('admin/sales/item', function () {
        return view('adminControl.setItem.sales.listItem.index');
    });
    Route::get('admin/sales/setType', function () {
        return view('adminControl.setItem.sales.setType.index');
    });
    Route::get('admin/sales/outletType', function () {
        return view('adminControl.setItem.sales.outletType.index');
    });
    Route::get('admin/sales/pendingItem', function () {
        return view('adminControl.setItem.sales.pendingItem.index');
    });
    // Route::get('', function(){
    //     return view();
    // });
    Route::get('admin/pattyCash/item', function () {
        return view('adminControl.setItem.pattyCash.listItem.index');
    });
    Route::get('admin/pattyCash/brandItem', function () {
        return view('adminControl.setItem.pattyCash.brandItem.index');
    });
    Route::get('admin/pattyCash/pendingItem', function () {
        return view('adminControl.setItem.pattyCash.pendingItem.index');
    });

    Route::get('admin/waste/item', function () {
        return view('adminControl.setItem.waste.listItem.index');
    });
    Route::get('admin/waste/brandItem', function () {
        return view('adminControl.setItem.waste.brandItem.index');
    });
    Route::get('admin/waste/pendingItem', function () {
        return view('adminControl.setItem.waste.pendingItem.index');
    });

    Route::get('admin/satuan', function () {
        return view('adminControl.setItem.satuan.index');
    });

    Route::get('admin/common/brand', function () {
        return view('adminControl.common.brand.index');
    });
    Route::get('admin/common/outlet', function () {
        return view('adminControl.common.outlet.index');
    });
    Route::get('admin/common/user', function () {
        return view('adminControl.common.user.index');
    });
    Route::get('admin/setoran', function () {
        return view('adminControl.setoran.index');
    });
    Route::get('admin/setBank', function () {
        return view('adminControl.setBank.index');
    });

    //Route akses untuk accounting

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
    Route::get('accounting/mutasiProcess/upload', function () {
        return view('accountingControl.mutasiProses.upload.index');
    });
    Route::get('accounting/mutasiProcess/mutasiKlasifikasi', function(){
        return view('accountingControl.mutasiProses.mutasiKlasifikasi.index');
    });
    Route::get('accounting/checkExist', function () {
        return view('accountingControl.dataDiIsi.index');
    });

    Route::get('accounting/robot/pembelian', function () {
        return view('accountingControl.beeCloudRobot.pembelian.index');
    });

    Route::get('accounting/robot/pembayaran', function () {
        return view('accountingControl.beeCloudRobot.pembayaran.index');
    });

    Route::get('accounting/robot/ecommerce', function () {
        return view('accountingControl.beeCloudRobot.ecommerce.index');
    });

    Route::get('accounting/robot/mutasi455TfKas', function () {
        return view('accountingControl.beeCloudRobot.mutasi455TfKas.index');
    });

    Route::get('accounting/robot/mutasi455TfKasSukodono', function () {
        return view('accountingControl.beeCloudRobot.mutasi455TfKasSukodono.index');
    });

    Route::get('accounting/robot/mutasi455Pembayaran', function () {
        return view('accountingControl.beeCloudRobot.mutasi455Pembayaran.index');
    });

    Route::get('accounting/robot/mutasi1003Setoran',function(){
        return view('accountingControl.beeCloudRobot.mutasi1003Setoran.index');
    });

    Route::get('accounting/robot/mutasi165reimburse',function(){
        return view('accountingControl.beeCloudRobot.mutasi165.index');
    });

    Route::get('accounting/robot/pindahSaldo165', function(){
        return view('accountingControl.beeCloudRobot.pindahSaldo165.index');
    });

    Route::get('accounting/robot/pembayaran165', function(){
        return view('accountingControl.beeCloudRobot.pembayaran165.index');
    });

    Route::get('accounting/pattyCash', function () {
        return view('accountingControl.pattyCash.index');
    });

    Route::get('accounting/saldoPattyCash', function () {
        return view('accountingControl.saldoPattyCash.index');
    });

    Route::get('accounting/reimburse', function () {
        return view('accountingControl.reimburse.index');
    });

    Route::get('accounting/setoran', function () {
        return view('accountingControl.setoranTunai.index');
    });

    Route::get('accounting/verifikasi', function () {
        return view('accountingControl.verifikasiSales.index');
    });

    Route::get('accounting/laporanSales', function () {
        return view('accountingControl.laporanSales.index');
    });

    Route::get('accounting/stockOpname', function () {
        return view('accountingControl.stockOpname.index');
    });

    Route::get('accounting/so/item', function () {
        // return view('accountingControl.setItem.soHarian');
        return view('accountingControl.setItem.so.listItem.index');
    });
    Route::get('accounting/so/setType', function () {
        return view('accountingControl.setItem.so.setType.index');
    });
    Route::get('accounting/so/setOutlet', function () {
        return view('accountingControl.setItem.so.outletType.index');
    });

    Route::get('accounting/sales/item', function () {
        return view('accountingControl.setItem.sales.listItem.index');
    });
    Route::get('accounting/sales/setType', function () {
        return view('accountingControl.setItem.sales.setType.index');
    });
    Route::get('accounting/sales/outletType', function () {
        return view('accountingControl.setItem.sales.outletType.index');
    });
    Route::get('accounting/sales/pendingItem', function () {
        return view('accountingControl.setItem.sales.pendingItem.index');
    });
    // Route::get('', function(){
    //     return view();
    // });
    Route::get('accounting/pattyCash/item', function () {
        return view('accountingControl.setItem.pattyCash.listItem.index');
    });
    Route::get('accounting/pattyCash/jenisItem', function () {
        return view('accountingControl.setItem.pattyCash.jenisItem.index');
    });
    Route::get('accounting/pattyCash/kategoriItem', function () {
        return view('accountingControl.setItem.pattyCash.kategoriItem.index');
    });
    Route::get('accounting/pattyCash/brandItem', function () {
        return view('accountingControl.setItem.pattyCash.brandItem.index');
    });
    Route::get('accounting/pattyCash/pendingItem', function () {
        return view('accountingControl.setItem.pattyCash.pendingItem.index');
    });

    Route::get('accounting/waste/item', function () {
        return view('accountingControl.setItem.waste.listItem.index');
    });
    Route::get('accounting/waste/brandItem', function () {
        return view('accountingControl.setItem.waste.brandItem.index');
    });
    Route::get('accounting/waste/pendingItem', function () {
        return view('accountingControl.setItem.waste.pendingItem.index');
    });

    Route::get('accounting/waste', function () {
        return view('accountingControl.waste.index');
    });

    Route::get('accounting/satuan', function () {
        return view('accountingControl.setItem.satuan.index');
    });

    //Route akses untuk user

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

    Route::get('user/detail2/all/salesHarian/{dateSelect}', function ($dateSelect) {
        return view('userControl2.salesHarianDetailAll', [
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

    Route::get('user/reimburse/sales/detail/{idDetail}', function ($idDetail) {
        return view('userControl.reimburse.detailSales', [
            'idDetail' => $idDetail
        ]);
    });

    Route::get('user/reimburse/kirim', function () {
        return view('userControl.reimburse.kirim');
    });

    Route::get('user/reimburse/sales/kirim', function () {
        return view('userControl.reimburse.reimburseSales');
    });

    Route::get('user/reimburse/wait', function () {
        return view('userControl.reimburse.verifikasiWait');
    });
});

//Route dibawah adalah route untuk bee cloud api dan hanya diolah di API Bee Cloud Controller
Route::get('refreshItemSO', [apiBeeCloudController::class, 'refreshAPISoHarian']);
Route::get('refreshTransaksi', [apiBeeCloudController::class, 'refreshTransaksi']);
