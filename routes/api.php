<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [App\Http\Controllers\ApiController::class, 'register']);
Route::post('/login', [App\Http\Controllers\ApiController::class, 'login']);
Route::post('/add-employee', [App\Http\Controllers\ApiController::class, 'add_employee'])->name('add_employee');
Route::post('/edit-employee', [App\Http\Controllers\ApiController::class, 'edit_employee'])->name('edit_employee');
Route::post('/delet-employee', [App\Http\Controllers\ApiController::class, 'delet_employee'])->name('delet_employee');
Route::post('/add-new-pyment', [App\Http\Controllers\ApiController::class, 'add_new_pyment'])->name('add_new_pyment');



Route::get('/view-staff', [App\Http\Controllers\ApiController::class, 'view_staff'])->name('view_staff');
Route::post('/logout-employee', [App\Http\Controllers\ApiController::class, 'logout_employee'])->name('logout_employee');
Route::get('/view_reports', [App\Http\Controllers\ApiController::class, 'view_reports'])->name('view_reports');
Route::post('/invoice-details', [App\Http\Controllers\ApiController::class, 'invoice_details'])->name('invoice_details');

//مدير مشتريات
Route::get('/View-money-transfers', [App\Http\Controllers\ApiController::class, 'View_money_transfers'])->name('View_money_transfers');
Route::post('/edit-type', [App\Http\Controllers\ApiController::class, 'edit_type1'])->name('edit_type1');
Route::get('/Show-items', [App\Http\Controllers\ApiController::class, 'Show_items'])->name('Show_items');
Route::post('/edit-type-class', [App\Http\Controllers\ApiController::class, 'edit_type_class'])->name('edit_type_class');

// مستلم مواد
Route::get('/View-products', [App\Http\Controllers\ApiController::class, 'View_products'])->name('View_products');
Route::post('/edit-type-products', [App\Http\Controllers\ApiController::class, 'edit_type_products'])->name('edit_type_products');
Route::post('/creat-invoice', [App\Http\Controllers\ApiController::class, 'creat_invoice'])->name('creat_invoice');

Route::get('/dd', [App\Http\Controllers\ApiController::class, 'dd'])->name('dd');
