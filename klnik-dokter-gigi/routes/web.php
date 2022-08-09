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

// Route::group(['middleware' => ['checkLogin']],  function(){
    
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
    Route::get('/admin/searchbarang', [AdminController::class, 'searchBarang'])->name('admin.search.barang');
    Route::get('/admin/cetakbarang', [AdminController::class, 'cetakBarangPDF'])->name('admin.cetak.barang');

    Route::get('/admin/verif_user', [AdminController::class ,'verifUser'])->name('admin.verif');

    Route::get('/admin/search/akundokter', [AdminController::class ,'searchAkunDokter'])->name('admin.search.akundokter');
    Route::get('/admin/cetak/akundokter', [AdminController::class ,'cetakAkunDokterPDF'])->name('admin.cetak.akundokter');

    Route::get('/admin/search/akunpasien', [AdminController::class ,'searchAkunPasien'])->name('admin.search.akunpasien');
    Route::get('/admin/cetak/akunpasien', [AdminController::class ,'cetakAkunPasienPDF'])->name('admin.cetak.akunpasien');

    Route::get('/admin/verif_jadwal', [AdminController::class ,'verifJadwal'])->name('admin.jadwal');
    Route::get('/admin/cetak/verif_jadwal', [AdminController::class ,'cetakVerifJadwalPDF'])->name('admin.cetak.jadwalverif');
    Route::get('/admin/search/verif_jadwal', [AdminController::class ,'searchVerifJadwal'])->name('admin.search.jadwalverif');

    Route::get('/admin/jadwaldokter', [AdminController::class ,'showJadwal'])->name('admin.jadwaldokter');
    Route::get('/admin/cetakjadwaldokter', [AdminController::class ,'cetakJadwalDokterPDF'])->name('admin.cetak.jadwaldokter');
    Route::get('/admin/searchjadwaldokter', [AdminController::class, 'searchJadwalDokter'])->name('admin.search.jadwaldokter');

    Route::get('/admin/verif_pasien/{id}',[AdminController::class ,'accPasien'])->name('admin.acc.pasien');
    Route::get('/admin/verif_dokter/{id}',[AdminController::class ,'accDokter'])->name('admin.acc.dokter');
    Route::get('/admin/tolak_pasien/{id}',[AdminController::class ,'denyPasien'])->name('admin.deny.pasien');
    Route::get('/admin/tolak_dokter/{id}',[AdminController::class ,'denyDokter'])->name('admin.deny.dokter');

    Route::get('/admin/transaksi', [AdminController::class ,'showTransaksi'])->name('admin.transaksi');
    Route::get('/admin/searchtransaksi', [AdminController::class ,'searchTransaksi'])->name('admin.search.transaksi');
    Route::get('/admin/search/transaksibymonth', [AdminController::class ,'searchTransaksiByMonth'])->name('admin.search.transaksibymonth');

    Route::get('/admin/inputjadwaltransaksi', [AdminController::class ,'pilihJadwalTransaksi'])->name('admin.tambah.jadwaltransaksi');
    Route::get('/admin/inputtransaksi/{id}', [AdminController::class ,'inputTransaksi'])->name('admin.tambah.transaksi');
    Route::post('/admin/inputtransaksi/{id}', [AdminController::class ,'transaksiToDB'])->name('admin.transaksi.fix');
    Route::get('/admin/cetaktransaksi', [AdminController::class ,'cetakTransaksiPDF'])->name('admin.cetak.transaksi');
    Route::get('/admin/cetaktransaksi/{month}', [AdminController::class ,'cetakTransaksiByMonthPDF'])->name('admin.cetak.transaksibymonth');

    Route::get('/admin/inputjadwal', [AdminController::class ,'addNewJadwal'])->name('admin.input.jadwal');
    Route::post('/admin/storejadwal', [AdminController::class ,'storeJadwal'])->name('admin.store.jadwal');
    Route::get('/admin/terimajadwal/{id}', [AdminController::class ,'terimaJadwal'])->name('admin.terima.jadwal');
    Route::get('/admin/tolakjadwal/{id}', [AdminController::class ,'tolakJadwal'])->name('admin.tolak.jadwal');
    Route::put('/admin/updatejadwal/{id}', [AdminController::class ,'updateJadwal'])->name('admin.update.jadwal');
    Route::get('/admin/deletejadwal/{id}', [AdminController::class ,'deleteJadwal'])->name('admin.delete.jadwal');


    Route::get('/owner', [OwnerController::class ,'index'])->name('owner.index');
    Route::get('/owner/barangowner', [OwnerController::class ,'allBarang'])->name('owner.barang');
    Route::get('/owner/searchbarang', [OwnerController::class ,'searchBarang'])->name('owner.search.barang');
    Route::get('/owner/cetakbarang', [OwnerController::class ,'cetakBarangPDF'])->name('owner.cetak.barang');

    Route::get('/owner/jadwalowner', [OwnerController::class ,'showJadwal'])->name('owner.jadwal');
    Route::get('/owner/search/jadwaldokter', [OwnerController::class ,'searchJadwalDokter'])->name('owner.search.jadwaldokter');
    Route::get('/owner/cetak/jadwaldokter', [OwnerController::class ,'cetakJadwalDokterPDF'])->name('owner.cetak.jadwaldokter');
    Route::get('/owner/jadwaldisetujui', [OwnerController::class ,'jadwal'])->name('owner.jadwaldisetujui');
    Route::get('/owner/search/jadwaldisetujui', [OwnerController::class ,'searchJadwalDisetujui'])->name('owner.search.jadwaldisetujui');
    Route::get('/owner/filter/jadwaldisetujui', [OwnerController::class ,'filterJadwalByMonth'])->name('owner.filter.jadwaldisetujui');
    Route::get('/owner/cetak/jadwaldisetujui', [OwnerController::class ,'cetakJadwalDisetujuiPDF'])->name('owner.cetak.jadwaldisetujui');
    Route::get('/owner/cetak/jadwaldisetujui/{month}', [OwnerController::class ,'cetakJadwalDisetujuiPDFByMonth'])->name('owner.cetak.jadwaldisetujuibymonth');
    Route::get('/owner/transaksiowner', [OwnerController::class ,'showTransaksi'])->name('owner.transaksi');
    Route::get('/owner/search/transaksi', [OwnerController::class ,'searchTransaksi'])->name('owner.search.transaksi');
    Route::get('/owner/filter/transaksi', [OwnerController::class ,'searchTransaksiByMonth'])->name('owner.filter.transaksi');
    Route::get('/owner/search/transaksibymonth', [OwnerController::class ,'searchTransaksiByMonth'])->name('owner.search.transaksibymonth');

    Route::get('/owner/cetaktransaksi', [OwnerController::class ,'cetakTransaksiPDF'])->name('owner.cetak.transaksi');
    Route::get('/owner/cetaktransaksi/{month}', [OwnerController::class ,'cetakTransaksiByMonthPDF'])->name('owner.cetak.transaksibymonth');

    Route::get('/pasien', [PasienController::class ,'index'])->name('pasien.index');
    Route::get('/pasien/riwayat', [PasienController::class ,'riwayat'])->name('list.riwayat');
    Route::get('/pasien/cetakriwayattransaksi', [PasienController::class ,'cetakRiwayatPDF'])->name('pasien.cetak.riwayat');

    Route::get('/pasien/barang', [PasienController::class ,'barang'])->name('list.barang');
    Route::get('/pasien/cetakriwayatbarang', [PasienController::class ,'cetakRiwayatBarangPDF'])->name('pasien.cetak.barang');

    Route::get('/pasien/jadwal', [PasienController::class ,'jadwal'])->name('list.jadwal');
    Route::get('/pasien/cetakjadwal', [PasienController::class ,'cetakJadwalPDF'])->name('pasien.cetak.jadwal');
    Route::get('/pasien/search/jadwaldokter', [PasienController::class ,'searchJadwal'])->name('list.search.jadwal');

    Route::get('/pasien/checkup/{jadwal}', [PasienController::class ,'daftar_checkup'])->name('daftar.checkup');

    Route::get('/pasien/inputjadwal/{id}', [PasienController::class ,'input_jadwal_checkup'])->name('pasien.input.jadwal');
    Route::post('/pasien/storejadwal',[PasienController::class ,'store_jadwal'])->name('pasien.store.jadwal');

    Route::get('/dokter', [DokterController::class ,'index'])->name('dokter.index');
    Route::get('/dokter/jadwal', [DokterController::class ,'jadwal'])->name('dokter.jadwal');
    Route::get('/dokter/search/jadwal', [DokterController::class ,'searchJadwal'])->name('dokter.search.jadwal');
    Route::get('/dokter/cetak/jadwal', [DokterController::class ,'cetakJadwalPDF'])->name('dokter.cetak.jadwal');
// });