<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PasienController extends Controller
{
    public function index($id)
    {
        $data = User::where(['iduser'=>$id])->first();
        session(['iduser'=>$id,'nama_user'=>$data->nama_user,'alamat'=>$data->alamat,'noHp'=>$data->noHp,'email'=>$data->email,'level'=>$data->level]);
        // var_dump(session('iduser'));
        return view('pasien/index');
    }

    public function riwayat($id){
        
        $riwayat = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->join('pasien','pasien.idpasien','=','pd.pasien_idpasien')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status')
                    ->where('pasien.user_iduser',$id)
                    ->get();
                    
        return view('pasien/riwayat',['riwayat'=>$riwayat]);
    }
    public function jadwal(){
        
        $jadwal = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status')
                    ->get();

        return view('pasien/jadwalcheckup',['jadwal'=>$jadwal]);
    }
    public function barang($id){
        
        $barang = DB::table('transaksi_detail as td')
                    ->join('transaksi as t', 'td.transaksi_idtransaksi', '=', 't.idtransaksi')
                    ->join('user as u', 't.user_iduser', '=', 'u.iduser')
                    ->join('barang as b', 'td.barang_idbarang', '=', 'b.idbarang')
                    ->select('td.*', 'u.*', 'b.*','t.created_at')
                    ->where('u.iduser',$id)
                    ->get();

        return view('pasien/barang',['barang'=>$barang]);
    }

}
