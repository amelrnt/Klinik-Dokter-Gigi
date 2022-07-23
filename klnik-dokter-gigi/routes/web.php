<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;

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

Route::get('/login', [LoginController::class,'index']);
Route::post('/authenticate', [LoginController::class,'authenticate']);
Route::get('/dashboard/{id}', [LoginController::class,'login']);


Route::get('/register', [RegisterController::class,'index']);
Route::post('/store', [RegisterController::class,'store']);

Route::get('/admin/{id}', [AdminController::class , 'index']);

Route::get('/pasien/{id}', [PasienController::class , 'index']);

Route::get('/dokter/{id}', [DokterController::class , 'index']);
