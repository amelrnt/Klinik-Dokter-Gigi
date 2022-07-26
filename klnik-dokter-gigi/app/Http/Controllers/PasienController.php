<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Login;

class PasienController extends Controller
{
    public function index($id)
    {   
        $barang = DB::table('transaksi_detail as td')
                    ->join('transaksi as t', 'td.transaksi_idtransaksi', '=', 't.idtransaksi')
                    ->join('user as u', 't.user_iduser', '=', 'u.iduser')
                    ->join('barang as b', 'td.barang_idbarang', '=', 'b.idbarang')
                    ->select('td.*', 'u.*', 'b.*','t.created_at')
                    ->where('u.iduser',$id)
                    ->get();

        $jadwal = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status','pd.jadwal_praktik_idjadwal_praktik')
                    ->get();

        session(['total_barang'=>count($barang),'total_jadwal'=>count($jadwal)]);

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
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status','pd.jadwal_praktik_idjadwal_praktik')
                    ->get();

        // var_dump($jadwal);
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

    public function daftar_checkup($id, $jadwal){
        

        $pasien = DB::table('pasien as p')
                ->join('user as u', 'p.user_iduser','=','u.iduser')
                ->select('p.idpasien')
                ->where('p.user_iduser',$id)
                ->first();
        
        $jadwal_praktik = DB::table('praktik_dijadwalkan as pd')
                ->join('jadwal_praktik as jp', 'pd.jadwal_praktik_idjadwal_praktik','=','jp.idjadwal_praktik')
                ->select('pd.*','jp.*')
                ->where('jp.idjadwal_praktik',$jadwal)
                ->first();

        $check_riwayat = DB::table('praktik_dijadwalkan as pj')
                    ->join('jadwal_praktik as jp', 'pj.jadwal_praktik_idjadwal_praktik','=','jp.idjadwal_praktik')
                    ->join('pasien as p','pj.pasien_idpasien','=','p.idpasien')
                    ->select('pj.*','p.*','jp.*')
                    ->where('p.user_iduser',$id)
                    ->where('jp.dokter_iddokter',$jadwal_praktik->dokter_iddokter)
                    ->get();

        // var_dump(count($check_riwayat)+1,$pasien->idpasien,$jadwal_praktik,$jadwal,date('Y-m-d'));

        $request_jadwal = DB::table('praktik_dijadwalkan')
                            ->insert([
                                'tanggal' => date('Y-m-d'),
                                'keterangan' => 'check up '.(count($check_riwayat)+1),
                                'jadwal_praktik_idjadwal_praktik'=> $jadwal,
                                'pasien_idpasien'=> $pasien->idpasien,
                                'dokter_iddokter'=> $jadwal_praktik->dokter_iddokter,
                                'status' => '0'
                            ]);
        if($request_jadwal){
            return redirect('riwayat/'.$id);
        }else{
            return redirect('list.jadwal');
        }
    }
}
