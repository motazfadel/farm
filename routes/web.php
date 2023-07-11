<?php

use Illuminate\Support\Facades\Route;

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


Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/userindex', [App\Http\Controllers\UserController::class, 'userindex'])->name('userindex');
Route::get('/user_list', [App\Http\Controllers\UserController::class, 'user_list'])->name('user_list');
Route::post('/delete_user', [App\Http\Controllers\UserController::class, 'delete_user'])->name('delete_user');
Route::get('/edituser/{id?}', [App\Http\Controllers\UserController::class, 'edituser'])->name('edituser');
Route::get('/adduser', [App\Http\Controllers\UserController::class, 'adduser'])->name('adduser');
Route::post('/newuser', [App\Http\Controllers\UserController::class, 'newuser'])->name('newuser');
Route::post('/updateuser/{id?}', [App\Http\Controllers\UserController::class, 'updateuser'])->name('updateuser');
// 3
Route::get('/add_pyment', [App\Http\Controllers\UserController::class, 'add_pyment'])->name('add_pyment');
Route::post('/save_payment', [App\Http\Controllers\UserController::class, 'save_payment'])->name('save_payment');

Route::get('/list', [App\Http\Controllers\UserController::class, 'list'])->name('list');
Route::get('/invoice_information/{id?}', [App\Http\Controllers\UserController::class, 'invoice_information'])->name('invoice_information');


Route::get('/create_invoice', [App\Http\Controllers\InvoiceController::class, 'create_invoice'])->name('create_invoice');
Route::post('/save_invoice', [App\Http\Controllers\InvoiceController::class, 'save_invoice'])->name('save_invoice');
Route::get('/receipt_money', [App\Http\Controllers\InvoiceController::class, 'receipt_money'])->name('receipt_money');
Route::post('/invoices/{id}', [App\Http\Controllers\InvoiceController::class, 'invoices'])->name('invoices');
Route::get('/material_delivery', [App\Http\Controllers\InvoiceController::class, 'material_delivery'])->name('material_delivery');
Route::post('/material/{id}', [App\Http\Controllers\InvoiceController::class, 'material'])->name('material');


Route::get('/material_receiver', [App\Http\Controllers\InvoiceController::class, 'material_receiver'])->name('material_receiver');
Route::post('/receiver/{id}', [App\Http\Controllers\InvoiceController::class, 'receiver'])->name('receiver');


