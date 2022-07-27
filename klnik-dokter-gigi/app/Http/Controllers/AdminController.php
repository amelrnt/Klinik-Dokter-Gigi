<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index($id)
    {
        $data = User::where(['iduser'=>$id])->first();
        return view('admin/index',['data'=>$data]);
    }

    public function allBarang()
    {
        $data = DB::table('barang')
        ->get();

        return view('admin/barang',['barang'=>$data]);
    }

    public function addBarang()
    {
        
    }

    public function verifUser()
    {
        $dokter = DB::table('user')
        ->join('login', 'user.iduser', '=', 'login.user_iduser')
        ->leftJoin('dokter', 'user.iduser','=', 'dokter.user_iduser')
        ->where('user.level', "dokter")
        ->get();

        $pasien = DB::table('user')
        ->join('login', 'user.iduser', '=', 'login.user_iduser')
        ->leftJoin('pasien', 'user.iduser','=', 'pasien.user_iduser')
        ->where('user.level', "dokter")
        ->get();

        return view('admin/assign_user',['dokter'=>$dokter, 'pasien'=>$pasien]);
    }


    public function verifJadwal()
    {
        // SELECT praktik_dijadwalkan.tanggal, jadwal_praktik.hari, jadwal_praktik.jam, praktik_dijadwalkan.keterangan, praktik_dijadwalkan.status, u1.nama_user as namapasien, u2.nama_user as namadokter 
        // FROM praktik_dijadwalkan INNER JOIN jadwal_praktik ON praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik = jadwal_praktik.idjadwal_praktik INNER JOIN pasien ON praktik_dijadwalkan.pasien_idpasien = pasien.idpasien 
        // INNER JOIN dokter ON dokter.iddokter = praktik_dijadwalkan.dokter_iddokter INNER JOIN user as u1 on u1.iduser = pasien.user_iduser INNER JOIN user as u2 on u2.iduser= dokter.user_iduser
        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'praktik_dijadwalkan.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->get();

        return view('admin/verif_jadwal',['jadwal'=>$jadwal]);
    }

 
    public function showJadwal()
    {
        // SELECT jadwal_praktik.hari, jadwal_praktik.jam, user.nama_user FROM `jadwal_praktik` 
        // INNER JOIN dokter ON jadwal_praktik.dokter_iddokter = dokter.iddokter INNER JOIN user on user.iduser = dokter.user_iduser 
        $jadwal = DB::table('jadwal_praktik')
        ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
        ->join('user', 'user.iduser', '=', 'dokter.user_iduser')
        ->select('jadwal_praktik.hari', 'jadwal_praktik.jam', 'user.nama_user')
        ->get();

        return view('admin/jadwal',['jadwal'=>$jadwal]);
    }


    public function showTransaksi()
    {
        // SELECT user.nama_user, barang.nama_barang, barang.harga_barang, transaksi.created_at FROM `transaksi_detail` 
        // INNER JOIN transaksi ON transaksi_detail.transaksi_idtransaksi = transaksi.idtransaksi 
        // INNER JOIN barang ON transaksi_detail.barang_idbarang = barang.idbarang 
        // INNER JOIN user ON transaksi.idtransaksi = user.iduser 
        $transaksi = DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('user', 'transaksi.idtransaksi', '=', 'user.iduser')
        ->select('user.nama_user', 'barang.nama_barang', 'barang.harga_barang', 'transaksi.created_at')
        ->get();

        return view('admin/transaksi',['transaksi'=>$transaksi]);
    }

    
    
}
