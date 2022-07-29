<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    public function index()
    {
        $data = User::where(['iduser'=>Session::get('iduser')])->first();
        return view('owner/index',['data'=>$data]);
    }

   
    public function allBarang()
    {
        $data = DB::table('barang')
        ->get();

        return view('owner/barang',['barang'=>$data]);
    }

  
    public function showJadwal()
    {
        // SELECT jadwal_praktik.hari, jadwal_praktik.jam, user.nama_user FROM `jadwal_praktik` 
        // INNER JOIN dokter ON jadwal_praktik.dokter_iddokter = dokter.iddokter INNER JOIN user on user.iduser = dokter.user_iduser 
        $jadwal = DB::table('jadwal_praktik')
        ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
        ->join('user', 'user.iduser', '=', 'dokter.user_iduser')
        ->select('jadwal_praktik.*', 'user.nama_user')
        ->get();

        $dokter = DB::table('dokter')
                    ->join('user','dokter.user_iduser','=','user.iduser')
                    ->select('*')
                    ->get();

        return view('owner/jadwal',['jadwal'=>$jadwal]);
    }

 
    public function jadwal()
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
        ->where('praktik_dijadwalkan.status', '1')
        ->get();

        return view('owner/jadwal_disetujui',['jadwal'=>$jadwal]);
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

        return view('owner/transaksi',['transaksi'=>$transaksi]);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
