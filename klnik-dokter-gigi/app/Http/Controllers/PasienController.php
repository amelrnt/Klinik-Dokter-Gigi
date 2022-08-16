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
    public function index()
    {   
        // SELECT COUNT(transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan) FROM `transaksi` 
        // INNER JOIN praktik_dijadwalkan ON praktik_dijadwalkan.idpraktik_dijadwalkan = transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan 
        // INNER JOIN pasien ON pasien.idpasien = praktik_dijadwalkan.pasien_idpasien 
        // WHERE pasien.user_iduser = 22 AND praktik_dijadwalkan.status = 1

        $terjadwal = DB::table('transaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('pasien', 'pasien.idpasien', '=', 'praktik_dijadwalkan.pasien_idpasien')
        ->where('pasien.user_iduser', Session::get('iduser'))
        ->where('praktik_dijadwalkan.status', '1')
        ->count('transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan');

        $allJadwal = DB::table('transaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('pasien', 'pasien.idpasien', '=', 'praktik_dijadwalkan.pasien_idpasien')
        ->where('pasien.user_iduser', Session::get('iduser'))
        ->count('transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan');

        // return view('pasien/index', ['total_barang'=>count($barang),'total_jadwal'=>count($jadwal)]);
        return view('pasien/index', ['jadwal'=>$terjadwal,'allJadwal'=>$allJadwal]);
    }

    public function riwayat(){
        $riwayat = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->join('pasien','pasien.idpasien','=','pd.pasien_idpasien')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status')
                    ->where('pasien.user_iduser',Session::get('iduser'))
                    ->paginate(15);
                    
        return view('pasien/riwayat',['riwayat'=>$riwayat]);
    }

    public function searchRiwayatCheckupByMonth(Request $request){

        $month = $request->input('filter_month');

        $riwayat = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->join('pasien','pasien.idpasien','=','pd.pasien_idpasien')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status')
                    ->where('pasien.user_iduser',Session::get('iduser'))
                    ->whereMonth('pd.tanggal','=',$month)
                    ->pagiante(15);
                    
        return view('pasien/riwayat',['riwayat'=>$riwayat]);
    }

    public function cetakRiwayatPDF(){
        
        $riwayat = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->join('pasien','pasien.idpasien','=','pd.pasien_idpasien')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status')
                    ->where('pasien.user_iduser',Session::get('iduser'))
                    ->get();

        $pdf = \PDF::loadview('pasien/cetakriwayatpdf',['riwayat'=>$riwayat,'month'=>'0']);

        return $pdf->stream();
    }

    public function cetakRiwayatPDFByMonth($month){
        
        $riwayat = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->join('praktik_dijadwalkan as pd','pd.jadwal_praktik_idjadwal_praktik','=','jadwal_praktik.idjadwal_praktik')
                    ->join('pasien','pasien.idpasien','=','pd.pasien_idpasien')
                    ->select('jadwal_praktik.*', 'user.*', 'pd.tanggal','pd.keterangan','pd.status')
                    ->where('pasien.user_iduser',Session::get('iduser'))
                    ->whereMonth('pd.tanggal','=',$month)
                    ->get();

        $pdf = \PDF::loadview('pasien/cetakriwayatpdf',['riwayat'=>$riwayat,'month'=>$month]);

        return $pdf->stream();
    }


    public function jadwal(){
        $jadwal = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->select('jadwal_praktik.idjadwal_praktik','jadwal_praktik.hari', 'jadwal_praktik.jam', 'user.nama_user','user.iduser')
                    ->paginate(15);
                    // ->get();

        return view('pasien/jadwalcheckup',['jadwal'=>$jadwal]);
    }

    public function cetakJadwalPDF(){
        $jadwal = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->select('jadwal_praktik.idjadwal_praktik','jadwal_praktik.hari', 'jadwal_praktik.jam', 'user.nama_user','user.iduser')
                    ->get();

        $pdf = \PDF::loadview('pasien/cetakjadwaldokterpdf',['jadwal'=>$jadwal]);
        return $pdf->stream();
    }
    public function searchJadwal(Request $request)
    {

        $search = $request->input('search_jadwal_dokter');

        $jadwal = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->join('user', 'dokter.user_iduser', '=', 'user.iduser')
                    ->select('jadwal_praktik.idjadwal_praktik','jadwal_praktik.hari', 'jadwal_praktik.jam', 'user.nama_user','user.iduser')
                    ->where('jadwal_praktik.hari', 'LIKE','%'.$search.'%')
                    ->orWhere('jadwal_praktik.jam', 'LIKE','%'.$search.'%')
                    ->orWhere('user.nama_user', 'LIKE','%'.$search.'%')
                    ->paginate(15);

        return view('pasien/jadwalcheckup',['jadwal'=>$jadwal]);
    }

    public function input_jadwal_checkup($id){
        $jadwal = DB::table('jadwal_praktik')
                    ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
                    ->select('jadwal_praktik.idjadwal_praktik', 'dokter.iddokter')
                    ->where('jadwal_praktik.idjadwal_praktik',$id)
                    ->first();

        return view('pasien/inputcheckup',['jadwal'=>$jadwal]);
    }

    public function store_jadwal(Request $request){

        // Create the timestamp from the given date
        $tgl = $request->input('tanggal');
        
        $timestamp = strtotime($tgl);
        
        // Create the new format from the timestamp
        $tanggal = date("Y-m-d", $timestamp);
        
        $pasien = DB::table('pasien')->where('user_iduser',Session::get('iduser'))->select('idpasien')->first();

        if ($pasien ) {
            $jadwal = DB::table('praktik_dijadwalkan')
                    ->insert([
                        'tanggal'=> $tanggal,
                        'keterangan' => $request->input('keterangan'),
                        'jadwal_praktik_idjadwal_praktik'=> $request->input('idjadwal_praktik'),
                        'pasien_idpasien'=> $pasien->idpasien,
                        'status' => '0'
                    ]);
        
            if($jadwal){
                Session::flash('message', 'Jadwal berhasil ditambah');
                Session::flash('alert-class', 'alert-success'); 
            }else{
                Session::flash('message', 'Jadwal gagal ditambah!');
                Session::flash('alert-class', 'alert-danger'); 
            }
        }else{
            Session::flash('message', 'Pendaftaran anda belum disetujui admin!');
            Session::flash('alert-class', 'alert-danger'); 
        }
        
        

        return redirect(route('list.jadwal'));
    }

    public function barang(){
        // SELECT transaksi.metode_pembayaran, transaksi.metode_pembayaran, barang.nama_barang, transaksi_detail.jumlah, praktik_dijadwalkan.tanggal, praktik_dijadwalkan.keterangan, u1.nama_user AS dokter, u2.nama_user as nama_pasien FROM `transaksi` 
        // INNER JOIN transaksi_detail ON transaksi.idtransaksi = transaksi_detail.transaksi_idtransaksi 
        // INNER JOIN praktik_dijadwalkan ON praktik_dijadwalkan.idpraktik_dijadwalkan = transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan 
        // INNER JOIN barang ON barang.idbarang = transaksi_detail.barang_idbarang 
        // INNER JOIN dokter ON dokter.iddokter = praktik_dijadwalkan.dokter_iddokter 
        // INNER JOIN user AS u1 ON dokter.user_iduser = u1.iduser 
        // INNER JOIN pasien ON praktik_dijadwalkan.pasien_idpasien = pasien.idpasien 
        // INNER JOIN user AS u2 ON u2.iduser = pasien.user_iduser 
        // WHERE u2.iduser = 22 AND praktik_dijadwalkan.status = 1

        $riwayat = DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi.idtransaksi', '=', 'transaksi_detail.transaksi_idtransaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
        ->join('barang', 'barang.idbarang', '=', 'transaksi_detail.barang_idbarang')
        ->join('user AS u1', 'dokter.user_iduser', '=', 'u1.iduser')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user AS u2', 'u2.iduser', '=', 'pasien.user_iduser')
        ->select('u2.iduser','transaksi.total_harga', 'transaksi.metode_pembayaran', DB::raw('group_concat(barang.nama_barang) as nama_barang'), 'transaksi_detail.jumlah', 'transaksi.created_at', 'praktik_dijadwalkan.keterangan', 'u1.nama_user AS dokter')
        ->where('praktik_dijadwalkan.status', '1')
        ->where('u2.iduser', Session::get('iduser'))
        ->paginate(15);

        // var_dump($riwayat[0]);

        return view('pasien/barang',['riwayat'=>$riwayat]);
    }

    public function searchRiwayatBarangByMonth(Request $request){

        $month = $request->input('filter_month');

        $riwayat = DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi.idtransaksi', '=', 'transaksi_detail.transaksi_idtransaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
        ->join('barang', 'barang.idbarang', '=', 'transaksi_detail.barang_idbarang')
        ->join('user AS u1', 'dokter.user_iduser', '=', 'u1.iduser')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user AS u2', 'u2.iduser', '=', 'pasien.user_iduser')
        ->select('u2.iduser','transaksi.total_harga', 'transaksi.metode_pembayaran', DB::raw('group_concat(barang.nama_barang) as nama_barang'), 'transaksi_detail.jumlah', 'transaksi.created_at', 'praktik_dijadwalkan.keterangan', 'u1.nama_user AS dokter')
        ->where('praktik_dijadwalkan.status', '1')
        ->where('u2.iduser', Session::get('iduser'))
        ->whereMonth('transaksi.created_at','=',$month)
        ->paginate(15);

        // var_dump($riwayat[0]);

        return view('pasien/barang',['riwayat'=>$riwayat]);
    }

    public function cetakRiwayatBarangPDF(){
        
        $riwayat = DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi.idtransaksi', '=', 'transaksi_detail.transaksi_idtransaksi')
            ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
            ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
            ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
            ->join('barang', 'barang.idbarang', '=', 'transaksi_detail.barang_idbarang')
            ->join('user AS u1', 'dokter.user_iduser', '=', 'u1.iduser')
            ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
            ->join('user AS u2', 'u2.iduser', '=', 'pasien.user_iduser')
            ->select('u2.iduser','transaksi.total_harga', 'transaksi.metode_pembayaran', DB::raw('group_concat(barang.nama_barang) as nama_barang'), 'transaksi_detail.jumlah', 'transaksi.created_at', 'praktik_dijadwalkan.keterangan', 'u1.nama_user AS dokter')
            ->where('praktik_dijadwalkan.status', '1')
            ->where('u2.iduser', Session::get('iduser'))
            ->get();
        
        $pdf = \PDF::loadview('pasien/cetakriwayatbarangpdf',['riwayat'=>$riwayat,'month'=>'0']);

        return $pdf->stream();
    }
    public function cetakRiwayatBarangPDFByMonth($month){
        
        $riwayat = DB::table('transaksi')
            ->join('transaksi_detail', 'transaksi.idtransaksi', '=', 'transaksi_detail.transaksi_idtransaksi')
            ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
            ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
            ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
            ->join('barang', 'barang.idbarang', '=', 'transaksi_detail.barang_idbarang')
            ->join('user AS u1', 'dokter.user_iduser', '=', 'u1.iduser')
            ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
            ->join('user AS u2', 'u2.iduser', '=', 'pasien.user_iduser')
            ->select('u2.iduser','transaksi.total_harga', 'transaksi.metode_pembayaran', DB::raw('group_concat(barang.nama_barang) as nama_barang'), 'transaksi_detail.jumlah', 'transaksi.created_at', 'praktik_dijadwalkan.keterangan', 'u1.nama_user AS dokter')
            ->where('praktik_dijadwalkan.status', '1')
            ->where('u2.iduser', Session::get('iduser'))
            ->whereMonth('transaksi.created_at','=',$month)
            ->get();
        
        $pdf = \PDF::loadview('pasien/cetakriwayatbarangpdf',['riwayat'=>$riwayat,'month'=>$month]);

        return $pdf->stream();
    }

    public function daftar_checkup($jadwal){
        // get idpasien from session, 

        $pasien = DB::table('pasien as p')
                ->join('user as u', 'p.user_iduser','=','u.iduser')
                ->select('p.idpasien')
                ->where('p.user_iduser',Session::get('iduser'))
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
                    ->where('p.user_iduser',Session::get('iduser'))
                    ->where('jp.dokter_iddokter',$jadwal_praktik->dokter_iddokter)
                    ->get();

        // var_dump(count($check_riwayat)+1,$pasien->idpasien,$jadwal_praktik,$jadwal,date('Y-m-d'));

        $request_jadwal = DB::table('praktik_dijadwalkan')
                            ->insert([
                                'tanggal' => date('Y-m-d'),
                                'keterangan' => 'check up '.(count($check_riwayat)+1),
                                'jadwal_praktik_idjadwal_praktik'=> $jadwal,
                                'pasien_idpasien'=> $pasien->idpasien,
                                // 'dokter_iddokter'=> $jadwal_praktik->dokter_iddokter,
                                'status' => '0'
                            ]);
        if($request_jadwal){
            return redirect('riwayat');
        }else{
            return redirect('list.jadwal');
        }
    }
    
}