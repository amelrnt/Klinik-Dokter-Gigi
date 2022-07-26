<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Login;

class DokterController extends Controller
{
    public function index($id)
    {

        $tersetujui = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status','pd.jadwal_praktik_idjadwal_praktik')
                    ->where('pd.status','1')
                    ->where('user.iduser',$id)
                    ->get();

        $tidak_tersetujui = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status','pd.jadwal_praktik_idjadwal_praktik')
                    ->where('pd.status','0')
                    ->where('user.iduser',$id)
                    ->get();

        session(['total_checkup_selesai'=>count($tersetujui),'total_checkup_belum_selesai'=>count($tidak_tersetujui)]);

        return view('dokter/index');
    }


    public function jadwal($iduser){
        $jadwal = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status','pd.jadwal_praktik_idjadwal_praktik')
                    ->where('pd.status','1')
                    ->where('user.iduser',$iduser)
                    ->get();
        
        return view('dokter/jadwal',['jadwal'=>$jadwal]);
    }

}
