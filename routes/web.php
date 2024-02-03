<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PurchasesController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\ReportsController;

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
Auth::routes();
Route::get('/', function () {
    return view('auth/login');
});
Route::get('/product/alert',[ProductController::class, 'getAlertQty']);

Route::middleware(['auth'])->group(function () {
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
Route::group(['middleware' => ['role:owner']], function () {
Route::view('/404-page','admin.404-page')->name('404-page');
Route::view('/blank-page','admin.blank-page')->name('blank-page');
Route::view('/buttons','admin.buttons')->name('buttons');
Route::view('/cards','admin.cards')->name('cards');
Route::view('/utilities-colors','admin.utilities-color')->name('utilities-colors');
Route::view('/utilities-borders','admin.utilities-border')->name('utilities-borders');
Route::view('/utilities-animations','admin.utilities-animation')->name('utilities-animations');
Route::view('/utilities-other','admin.utilities-other')->name('utilities-other');
Route::view('/chart','admin.chart')->name('chart');
Route::view('/tables','admin.tables')->name('tables');
Route::view('/404-page','admin.404-page')->name('404-page');
});

// ________________________________________People_________________________________________________________
Route::group(['middleware' => ['role:admin|owner|staff|general_manager']], function () {

Route::get('/user', [PeopleController::class,'user'])->name('user');
Route::post('/user/create', [PeopleController::class, 'user_create']);
Route::post('/user/update', [PeopleController::class, 'user_update']);

Route::get('/customer', [PeopleController::class,'customer'])->name('customer');
Route::post('/customer/store', [PeopleController::class, 'customer_store']);
Route::post('/customer/update', [PeopleController::class, 'customer_update']);
Route::get('/customer/{id}/question', [PeopleController::class, 'customer_question']);
Route::get('/customer/{id}/destroy', [PeopleController::class, 'customer_destroy']);

Route::get('/supplier', [PeopleController::class,'supplier'])->name('supplier');
Route::post('/supplier/store', [PeopleController::class, 'supplier_store']);
Route::post('/supplier/update', [PeopleController::class, 'supplier_update']);
Route::get('/supplier/{id}/question', [PeopleController::class, 'supplier_question']);
Route::get('/supplier/{id}/destroy', [PeopleController::class, 'supplier_destroy']);
// ________________________________________TheEnd_________________________________________________________
// ________________________________________Setting_________________________________________________________
//Product
Route::get('/product', [ProductController::class,'index'])->name('product');
Route::get('/product/{id}/question', [ProductController::class, 'question']);
Route::get('/product/row', [ProductController::class, 'row'])->name('row');
Route::get('/product/{id}/destroy', [ProductController::class, 'destroy']);
Route::get('/product/{id}/edit', [ProductController::class, 'edit']);
Route::patch('/product/{id}/update', [ProductController::class, 'update']);
Route::get('/product/create', [ProductController::class, 'create']);
Route::post('/product/store', [ProductController::class,'store'])->name('/product/store');
//issue
Route::get('/issue', [IssueController::class,'index'])->name('issue');
Route::get('/issue/{id}/question', [IssueController::class, 'question']);
Route::get('/issue/{id}/destroy', [IssueController::class, 'destroy']);
Route::get('/issue/{id}/edit', [IssueController::class, 'edit']);
Route::patch('/issue/{id}/update', [IssueController::class, 'update']);
Route::get('/issue/create', [IssueController::class, 'create']);
Route::post('/issue/store', [IssueController::class,'store'])->name('/issue/store');
Route::get('/issue/view/{id}', [IssueController::class,'show'])->name('/issue/view');
//process
Route::get('/process', [ProcessController::class,'index'])->name('process');
Route::get('/process/{id}/question', [ProcessController::class, 'question']);
Route::get('/process/{id}/destroy', [ProcessController::class, 'destroy']);
Route::get('/process/{id}/edit', [ProcessController::class, 'edit']);
Route::patch('/process/{id}/update', [ProcessController::class, 'update']);
Route::get('/process/create', [ProcessController::class, 'create']);
Route::post('/process/store', [ProcessController::class,'store'])->name('/process/store');
Route::get('/process/view/{id}', [ProcessController::class,'show'])->name('/issue/view');

//purchases
Route::get('/purchases', [PurchasesController::class,'index'])->name('purchases');
Route::get('/purchases/{id}/question', [PurchasesController::class, 'question']);
Route::get('/purchases/{id}/destroy', [PurchasesController::class, 'destroy']);
Route::get('/purchases/{id}/edit', [PurchasesController::class, 'edit']);
Route::post('/purchases/update', [PurchasesController::class, 'update']);
Route::get('/purchases/create', [PurchasesController::class, 'create']);
Route::post('/purchases/store', [PurchasesController::class,'store'])->name('/purchases/store');

//Pos
Route::get('/pos', [PosController::class,'index'])->name('pos');
Route::post('/pos/store', [PosController::class, 'store']);
Route::get('/pos/custom', [PosController::class, 'custom']);
Route::get('/pos/view/{id}', [PosController::class,'show'])->name('/pos/view');
Route::get('/pos/moal_view/{id}', [PosController::class,'modal_view'])->name('/pos/moal_view');


//Category
Route::get('/category', [SettingController::class,'category'])->name('category');
Route::post('/category/store', [SettingController::class, 'category_store']);
Route::post('/category/update', [SettingController::class, 'category_update']);
Route::get('/category/{id}/question', [SettingController::class, 'category_question']);
Route::get('/category/{id}/destroy', [SettingController::class, 'category_destroy']);
//Subcategory
Route::get('/subcategory', [SettingController::class,'subcategory'])->name('subcategory');
Route::post('/subcategory/store', [SettingController::class, 'subcategory_store']);
Route::post('/subcategory/update', [SettingController::class, 'subcategory_update']);
Route::get('/subcategory/{id}/question', [SettingController::class, 'subcategory_question']);
Route::get('/subcategory/{id}/destroy', [SettingController::class, 'subcategory_destroy']);
//Unit
Route::get('/unit', [SettingController::class,'unit'])->name('unit');
Route::post('/unit/store', [SettingController::class, 'unit_store']);
Route::post('/unit/update', [SettingController::class, 'unit_update']);
Route::get('/unit/{id}/question', [SettingController::class, 'unit_question']);
Route::get('/unit/{id}/destroy', [SettingController::class, 'unit_destroy']);
//Brand
Route::get('/brand', [SettingController::class,'brand'])->name('brand');
Route::post('/brand/store', [SettingController::class, 'brand_store']);
Route::post('/brand/update', [SettingController::class, 'brand_update']);
Route::get('/brand/{id}/question', [SettingController::class, 'brand_question']);
Route::get('/brand/{id}/destroy', [SettingController::class, 'brand_destroy']);
//Bot
Route::get('/bot', [SettingController::class,'bot'])->name('bot');
Route::post('/bot/store', [SettingController::class, 'bot_store']);
Route::post('/bot/update', [SettingController::class, 'bot_update']);
Route::get('/bot/{id}/question', [SettingController::class, 'bot_question']);
Route::get('/bot/{id}/destroy', [SettingController::class, 'bot_destroy']);
//warehouse
Route::get('/warehouse', [SettingController::class,'warehouse'])->name('warehouse');
Route::post('/warehouse/store', [SettingController::class, 'warehouse_store']);
Route::post('/warehouse/update', [SettingController::class, 'warehouse_update']);
Route::get('/warehouse/{id}/question', [SettingController::class, 'warehouse_question']);
Route::get('/warehouse/{id}/destroy', [SettingController::class, 'warehouse_destroy']);
//Payment_method
Route::get('/payment_method', [SettingController::class,'payment_method'])->name('payment_method');
Route::post('/payment_method/store', [SettingController::class, 'payment_method_store']);
Route::post('/payment_method/update', [SettingController::class, 'payment_method_update']);
Route::get('/payment_method/{id}/question', [SettingController::class, 'payment_method_question']);
Route::get('/payment_method/{id}/destroy', [SettingController::class, 'payment_method_destroy']);
// Reports
Route::prefix('report')->group(function(){
Route::get('/product', [ReportsController::class,'product'])->name('report/product');
Route::get('/category', [ReportsController::class,'category'])->name('report/category');
Route::get('/brand', [ReportsController::class,'brand'])->name('report/brand');
Route::get('/daily_sale', [ReportsController::class,'daily_sale'])->name('report/daily_sale');
Route::get('/monthly_sale', [ReportsController::class,'monthly_sale'])->name('report/monthly_sale');
Route::get('/sale', [ReportsController::class,'sale'])->name('report/sale');
Route::get('/sale_item', [ReportsController::class,'sale_item'])->name('report/sale_item');
Route::get('/purchases', [ReportsController::class,'purchases'])->name('report/purchases');
Route::get('/purchases_item', [ReportsController::class,'purchases_item'])->name('report/purchases_item');

});
// ________________________________________TheEnd_________________________________________________________
});
});

