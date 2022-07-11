<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoryController;
use App\Http\Controllers\TransaksiController;

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

Route::get('/', function () {
    return view('index');
});

Route::get('/', [DashboardController::class, 'index']);
Route::get('/kategory', [DashboardController::class, 'kategory']);
Route::get('/transaksi', [DashboardController::class, 'transaksi']);

Route::post('storekategory', [KategoryController::class,'store']);
Route::post('editKategory', [KategoryController::class,'show']);
Route::post('updateKategory', [KategoryController::class,'update']);
Route::post('deleteKategory', [KategoryController::class,'delete']);

Route::post('storetransaksi', [TransaksiController::class,'store']);
Route::post('changeKategory', [KategoryController::class,'change']);
Route::post('editTransaksi', [TransaksiController::class,'show']);
Route::post('updateTransaksi', [TransaksiController::class,'update']);
Route::post('deleteTransaksi', [TransaksiController::class,'delete']);