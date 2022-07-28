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
Route::get('/logout', [LoginController::class , 'logout'])->name('logout');
Route::get('/edit/profile', [ProfileController::class , 'edit'])->name('edit.profile');
Route::get('/profile', [ProfileController::class , 'profile'])->name('profile');
Route::post('/profile/update', [ProfileController::class,'update'])->name('update.profile');

Route::get('/register', [RegisterController::class,'index'])->name('register');
Route::post('/store', [RegisterController::class,'store']);

Route::get('/admin', [AdminController::class ,'index'])->name('admin.index');
Route::get('/admin/barangadmin', [AdminController::class ,'allBarang'])->name('admin.barang');

Route::get('/admin/inputnewbarang', [AdminController::class ,'inputNewBarang'])->name('admin.tambah.barang');
Route::post('/admin/storebarang', [AdminController::class ,'addBarang']);
Route::delete('/admin/deletebarang/{id}', [AdminController::class ,'deleteBarang'])->name('admin.delete.barang');
Route::put('/admin/updatebarang/{id}', [AdminController::class ,'updatebarang'])->name('admin.update.barang');

Route::get('/admin/verif_user', [AdminController::class ,'verifUser'])->name('admin.verif');
Route::get('/admin/verif_jadwal', [AdminController::class ,'verifJadwal'])->name('admin.jadwal');
Route::get('/admin/jadwaldokter', [AdminController::class ,'showJadwal'])->name('admin.jadwaldokter');
Route::get('/admin/transaksi', [AdminController::class ,'showTransaksi'])->name('admin.transaksi');

Route::get('/admin/inputjadwal', [AdminController::class ,'addNewJadwal'])->name('admin.input.jadwal');

Route::get('/owner', [OwnerController::class ,'index'])->name('owner.index');

Route::get('/pasien', [PasienController::class ,'index'])->name('pasien.index');
Route::get('/pasien/riwayat', [PasienController::class ,'riwayat'])->name('list.riwayat');
Route::get('/pasien/barang', [PasienController::class ,'barang'])->name('list.barang');
Route::get('/pasien/jadwal', [PasienController::class ,'jadwal'])->name('list.jadwal');
Route::get('/pasien/checkup/{jadwal}', [PasienController::class ,'daftar_checkup'])->name('daftar.checkup');

Route::get('/pasien/getjadwal/{id}', [PasienController::class ,'get_id_jadwal'])->name('pasien.get.jadwal');
Route::post('/pasien/storejadwal/{id}',[PasienController::class ,'store_jadwal'])->name('pasien.store.jadwal');

Route::get('/dokter', [DokterController::class ,'index'])->name('dokter.index');
Route::get('/dokter/jadwal', [DokterController::class ,'jadwal'])->name('dokter.jadwal');

