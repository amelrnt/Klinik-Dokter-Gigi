<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ProfileController;

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
    return view('landing_page/index');
});

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/authenticate', [LoginController::class,'authenticate']);
Route::get('/dashboard/{id}', [LoginController::class,'login']);
Route::get('/logout', [LoginController::class , 'logout'])->name('logout');
Route::get('/edit/profile/{id}', [ProfileController::class , 'edit'])->name('edit.profile');
Route::get('/profile/{id}', [ProfileController::class , 'profile'])->name('profile');
Route::post('/profile/update', [ProfileController::class,'update'])->name('update.profile');

Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/store', [RegisterController::class,'store']);

Route::get('/admin/{id}', [AdminController::class ,'index'])->name('admin.index');
Route::get('/barangadmin/{id}', [AdminController::class ,'allBarang'])->name('admin.barang');
Route::get('/verif_user/{id}', [AdminController::class ,'verifUser'])->name('admin.verif');
Route::get('/verif_jadwal/{id}', [AdminController::class ,'verifJadwal'])->name('admin.jadwal');
Route::get('/jadwaldokter/{id}', [AdminController::class ,'showJadwal'])->name('admin.jadwaldokter');
Route::get('/transaksi/{id}', [AdminController::class ,'showTransaksi'])->name('admin.transaksi');


Route::get('/owner/{id}', [OwnerController::class ,'index'])->name('owner.index');

Route::get('/pasien/{id}', [PasienController::class ,'index'])->name('pasien.index');
Route::get('/riwayat/{id}', [PasienController::class ,'riwayat'])->name('list.riwayat');
Route::get('/barang/{id}', [PasienController::class ,'barang'])->name('list.barang');
Route::get('/jadwal', [PasienController::class ,'jadwal'])->name('list.jadwal');
Route::get('/pasien/checkup/{id}/{jadwal}', [PasienController::class ,'daftar_checkup'])->name('daftar.checkup');

Route::get('/dokter/{id}', [DokterController::class ,'index'])->name('dokter.index');
Route::get('/dokter/jadwal/{id}', [DokterController::class ,'jadwal'])->name('dokter.jadwal');

