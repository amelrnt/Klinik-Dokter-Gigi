<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Login;
use Illuminate\Support\Facades\Session;

class DokterController extends Controller
{
    public function index()
    {

        $tersetujui = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status','pd.jadwal_praktik_idjadwal_praktik')
                    ->where('pd.status','1')
                    ->where('user.iduser',Session::get('iduser'))
                    ->get();

        $tidak_tersetujui = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status','pd.jadwal_praktik_idjadwal_praktik')
                    ->where('pd.status','0')
                    ->where('user.iduser',Session::get('iduser'))
                    ->get();

        session(['total_checkup_selesai'=>count($tersetujui),'total_checkup_belum_selesai'=>count($tidak_tersetujui)]);

        return view('dokter/index');
    }


    public function jadwal(){
        // SELECT praktik_dijadwalkan.tanggal, jadwal_praktik.hari, jadwal_praktik.jam, praktik_dijadwalkan.keterangan, user.nama_user FROM `praktik_dijadwalkan` 
        // INNER JOIN jadwal_praktik ON jadwal_praktik.idjadwal_praktik = praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik 
        // INNER JOIN pasien ON pasien.idpasien = praktik_dijadwalkan.pasien_idpasien
        // INNER JOIN user ON user.iduser = pasien.user_iduser 
        // INNER JOIN dokter ON dokter.iddokter = jadwal_praktik.dokter_iddokter 
        // WHERE praktik_dijadwalkan.status = 1 AND dokter.user_iduser = 2

        $jadwal = DB::table('praktik_dijadwalkan')
                    ->join('jadwal_praktik', 'jadwal_praktik.idjadwal_praktik', '=', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik')
                    ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
                    ->join('user', 'user.iduser', '=', 'pasien.user_iduser')
                    ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
                    ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'user.nama_user')
                    ->where('praktik_dijadwalkan.status','1')
                    ->where('dokter.user_iduser',Session::get('iduser'))
                    ->paginate(15);
        
        return view('dokter/jadwal',['jadwal'=>$jadwal]);
    }
    public function cetakJadwalPDF(){
        // SELECT praktik_dijadwalkan.tanggal, jadwal_praktik.hari, jadwal_praktik.jam, praktik_dijadwalkan.keterangan, user.nama_user FROM `praktik_dijadwalkan` 
        // INNER JOIN jadwal_praktik ON jadwal_praktik.idjadwal_praktik = praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik 
        // INNER JOIN pasien ON pasien.idpasien = praktik_dijadwalkan.pasien_idpasien
        // INNER JOIN user ON user.iduser = pasien.user_iduser 
        // INNER JOIN dokter ON dokter.iddokter = jadwal_praktik.dokter_iddokter 
        // WHERE praktik_dijadwalkan.status = 1 AND dokter.user_iduser = 2

        $jadwal = DB::table('praktik_dijadwalkan')
                    ->join('jadwal_praktik', 'jadwal_praktik.idjadwal_praktik', '=', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik')
                    ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
                    ->join('user', 'user.iduser', '=', 'pasien.user_iduser')
                    ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
                    ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'user.nama_user')
                    ->where('praktik_dijadwalkan.status','1')
                    ->where('dokter.user_iduser',Session::get('iduser'))
                    ->get();
        
        $pdf = \PDF::loadview('dokter/cetakjadwalpdf',['jadwal'=>$jadwal]);

        return $pdf->stream();
    }

    public function searchJadwal(Request $request){

        $search = $request->input('search_jadwal_dokter');

        $jadwal = DB::table('praktik_dijadwalkan')
                    ->join('jadwal_praktik', 'jadwal_praktik.idjadwal_praktik', '=', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik')
                    ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
                    ->join('user', 'user.iduser', '=', 'pasien.user_iduser')
                    ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
                    ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'user.nama_user')
                    ->where('praktik_dijadwalkan.status','1')
                    ->where('dokter.user_iduser',Session::get('iduser'))
                    ->where(function($query) use ($search) {
                        $query->where('praktik_dijadwalkan.tanggal','LIKE','%'.$search.'%')
                        ->orWhere('praktik_dijadwalkan.keterangan','LIKE','%'.$search.'%')
                        ->orWhere('jadwal_praktik.hari','LIKE','%'.$search.'%')
                        ->orWhere('jadwal_praktik.jam','LIKE','%'.$search.'%')
                        ->orWhere('user.nama_user','LIKE','%'.$search.'%');
                    })
                    ->paginate(15);
        
        return view('dokter/jadwal',['jadwal'=>$jadwal]);

    }
    
}
