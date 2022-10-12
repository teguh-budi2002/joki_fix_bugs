<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BpController;
use App\Http\Controllers\FpsController;

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
    return view('welcome');
});

//Route for Barang Persediaan
Route::get('/persediaan/index', [BpController::class,'index'] )->name('persediaan');
Route::get('/persediaan/tambahbp', [BpController::class,'tambahbp'] )->name('barangpersediaan');
Route::post('/insertbp', [BpController::class,'insertbp'] )->name('insertbp');
Route::get('/persediaan/tampilbp/{id}', [BpController::class,'tampilbp'] )->name('tampilbp');
Route::post('/persediaan/editbp/{id}', [BpController::class,'editbp'] )->name('editbp');
Route::get('/persediaan/deletebp/{id}', [BpController::class,'deletebp'] )->name('deletebp');

//Route for Permintaan
Route::get('/fp/fpindex',[FpsController::class,'index'])->name('formpermintaan');
Route::get('/fp/tambahfp', [FpsController::class,'tambahfp'] )->name('tambahformpermintaan');
Route::post('/insertfp', [FpsController::class,'insertfp'] )->name('insertfp');
Route::get('/fp/tampilfp/{id}', [FpsController::class,'tampilfp'] )->name('tampilfp');
Route::post('/fp/editfp/{id}', [FpsController::class,'editfp'] )->name('editfp');
Route::get('/fp/deletefp/{id}', [FpsController::class,'deletefp'] )->name('deletefp');
Route::get('/fp/tambahfp', [FpsController::class,'tambahfungsi'] )->name('tambahfungsi');
//Route::get('/fp/tambahfp', [FpsController::class,'tambahbarang'] )->name('tambahbarang');
