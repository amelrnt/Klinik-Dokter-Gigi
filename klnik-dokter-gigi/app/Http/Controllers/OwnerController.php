<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Ramsey\Collection\Collection;
use \PDF;

class OwnerController extends Controller
{
    public function index()
    {
        $data = User::where(['iduser'=>Session::get('iduser')])->first();

        $terjadwal = DB::table('transaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('pasien', 'pasien.idpasien', '=', 'praktik_dijadwalkan.pasien_idpasien')
        ->where('praktik_dijadwalkan.status', '1')
        ->count('transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan');

        $allJadwal = DB::table('transaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('pasien', 'pasien.idpasien', '=', 'praktik_dijadwalkan.pasien_idpasien')
        ->count('transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan');

        $pasien = DB::table('pasien')
        ->count('idpasien');

        $dokter= DB::table('dokter')
        ->count('iddokter');

        return view('owner/index',['data'=>$data, 'konfirmasi' => $terjadwal, 'nonkonfirmasi'=>$allJadwal, 'pasien' => $pasien, 'dokter'=>$dokter]);
    }

   
    public function allBarang()
    {
        $data = DB::table('barang')
        ->paginate(15);

        return view('owner/barang',['barang'=>$data]);
    }

    public function cetakBarangPDF()
    {
        $data = DB::table('barang')
        ->get();
        
        $pdf = \PDF::loadView('owner/cetakbarangpdf',['barang'=>$data]);

        return $pdf->stream();
    }

    public function searchBarang(Request $request){

        $barang = $request->input('search_barang');

        $data = DB::table('barang')
        ->select('*')
        ->where('nama_barang','LIKe','%'.$barang.'%')
        ->orWhere('harga_barang','LIKE','%'.$barang.'%')
        ->orWhere('stok_barang','LIKE','%'.$barang.'%')
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
        ->paginate(15);

        return view('owner/jadwal',['jadwal'=>$jadwal]);
    }
    public function searchJadwalDokter(Request $request){
        
        $search = $request->input('search_jadwal_dokter');

        $jadwal = DB::table('jadwal_praktik')
        ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
        ->join('user', 'user.iduser', '=', 'dokter.user_iduser')
        ->select('jadwal_praktik.*', 'user.nama_user')
        ->where('jadwal_praktik.hari','LIKE','%'.$search.'%')
        ->orWhere('jadwal_praktik.jam','LIKE','%'.$search.'%')
        ->orWhere('user.nama_user','LIKE','%'.$search.'%')
        ->paginate(15);

        return view('owner/jadwal',['jadwal'=>$jadwal]);
    }

    public function cetakJadwalDokterPDF()
    {
        // SELECT jadwal_praktik.hari, jadwal_praktik.jam, user.nama_user FROM `jadwal_praktik` 
        // INNER JOIN dokter ON jadwal_praktik.dokter_iddokter = dokter.iddokter INNER JOIN user on user.iduser = dokter.user_iduser 
        $jadwal = DB::table('jadwal_praktik')
        ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
        ->join('user', 'user.iduser', '=', 'dokter.user_iduser')
        ->select('jadwal_praktik.*', 'user.nama_user')
        ->get();

        $pdf = \PDF::loadView('owner/cetakjadwalpdf',['jadwal'=>$jadwal]);

        return $pdf->stream();
    }



    public function searchJadwalDisetujui(Request $request){
        $search = $request->input('search_jadwal_disetujui');
        
        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.status', '1')
        ->where(function($query) use ($search){
            $query->where('u1.nama_user','LIKE','%'.$search.'%')
            ->orWhere('u2.nama_user','LIKE','%'.$search.'%')
            ->orWhere('praktik_dijadwalkan.keterangan','LIKE','%'.$search.'%')
            ->orWhere('praktik_dijadwalkan.tanggal','LIKE','%'.$search.'%')
            ->orWhere('jadwal_praktik.jam','LIKE','%'.$search.'%')
            ->orWhere('jadwal_praktik.hari','LIKE','%'.$search.'%');
        })
        ->paginate(15);

        return view('owner/jadwal_disetujui',['jadwal'=>$jadwal]);
    }

    public function jadwal()
    {
        // SELECT praktik_dijadwalkan.tanggal, jadwal_praktik.hari, jadwal_praktik.jam, praktik_dijadwalkan.keterangan, praktik_dijadwalkan.status, u1.nama_user as namapasien, u2.nama_user as namadokter 
        // FROM praktik_dijadwalkan INNER JOIN jadwal_praktik ON praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik = jadwal_praktik.idjadwal_praktik INNER JOIN pasien ON praktik_dijadwalkan.pasien_idpasien = pasien.idpasien 
        // INNER JOIN dokter ON dokter.iddokter = jadwal_praktik.dokter_iddokter INNER JOIN user as u1 on u1.iduser = pasien.user_iduser INNER JOIN user as u2 on u2.iduser= dokter.user_iduser
        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.status', '1')
        ->paginate(15);

        return view('owner/jadwal_disetujui',['jadwal'=>$jadwal]);
    }

    public function filterJadwalByMonth(Request $request){

        $month = $request->input('filter_month');
        
        $query = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.status', '1');
        
        if($month=='0'){
            $jadwal = $query->paginate(15);
        }else{
            $jadwal = $query->whereMonth('praktik_dijadwalkan.tanggal','=',$month)
            ->paginate(15);
        }

        return view('owner/jadwal_disetujui',['jadwal'=>$jadwal]);
    }

    public function cetakJadwalDisetujuiPDFByMonth($month){
        $query = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.status', '1');

        if($month == '0'){
            $jadwal = $query->get();
        }else{
            $jadwal = $query->whereMonth('praktik_dijadwalkan.tanggal','=',$month)
            ->get();
        }

        $pdf = \PDF::loadView('owner/cetakjadwaldisetujuipdf',['jadwal'=>$jadwal,'month'=>$month]);

        return $pdf->stream();
    }
    public function cetakJadwalDisetujuiPDF()
    {
        // SELECT jadwal_praktik.hari, jadwal_praktik.jam, user.nama_user FROM `jadwal_praktik` 
        // INNER JOIN dokter ON jadwal_praktik.dokter_iddokter = dokter.iddokter INNER JOIN user on user.iduser = dokter.user_iduser 
        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.status', '1')
        ->get();

        $pdf = \PDF::loadView('owner/cetakjadwaldisetujuipdf',['jadwal'=>$jadwal,'month'=>'0']);

        return $pdf->stream();
    }

    public function showTransaksi()
    {
        // SELECT user.nama_user, barang.nama_barang, barang.harga_barang, transaksi.created_at FROM `transaksi_detail` 
        // INNER JOIN transaksi ON transaksi_detail.transaksi_idtransaksi = transaksi.idtransaksi 
        // INNER JOIN barang ON transaksi_detail.barang_idbarang = barang.idbarang 
        // INNER JOIN user ON transaksi.idtransaksi = user.iduser 
        $transaksi = DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan', '=', 'praktik_dijadwalkan.idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', 'barang.nama_barang', 'barang.harga_barang', 'transaksi.created_at')
        ->paginate(15);

        return view('owner/transaksi',['transaksi'=>$transaksi]);
    }
    
    public function searchTransaksi(Request $request)
    {
        
        $search = $request->input('search_transaksi');

        $transaksi = DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan', '=', 'praktik_dijadwalkan.idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', 'barang.nama_barang', 'barang.harga_barang', 'transaksi.created_at')
        ->where('user.nama_user','LIKE','%'.$search.'%')
        ->orWhere('barang.nama_barang','LIKE','%'.$search.'%')
        ->orWhere('barang.harga_barang','LIKE','%'.$search.'%')
        ->orWhere('transaksi.created_at','LIKE','%'.$search.'%')
        ->paginate(15);

        return view('owner/transaksi',['transaksi'=>$transaksi]);
    }

    public function cetakTransaksiPDF(){
        
        $transaksi = DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan', '=', 'praktik_dijadwalkan.idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', 'barang.nama_barang', 'barang.harga_barang', 'transaksi.created_at')
        ->get();

        $pdf = \PDF::loadView('owner/cetaktransaksipdf',['transaksi'=>$transaksi, 'month'=>'0']);

        return $pdf->stream();
    }


    public function searchTransaksiByMonth(Request $request){
        
        $month = $request->input('filter_month');
        
        $query = DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan', '=', 'praktik_dijadwalkan.idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', 'barang.nama_barang', 'barang.harga_barang', 'transaksi.created_at');
        
        if($month == '0'){
            $transaksi = $query->groupBy('transaksi_detail.idtransaksi_detail')
            ->paginate(15);
        }else{
            $transaksi = $query->whereMonth('transaksi.created_at','=',$month)
            ->groupBy('transaksi_detail.idtransaksi_detail')
            ->paginate(15);
        }
        return view('owner/transaksi',['transaksi'=>$transaksi]);
    }
    public function cetakTransaksiByMonthPDF($month){
        
        $query = DB::table('transaksi')
        ->join('transaksi_detail', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan', '=', 'praktik_dijadwalkan.idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', 'barang.nama_barang', 'barang.harga_barang', 'transaksi.created_at');

        if($month == '0'){
            $transaksi = $query->groupBy('transaksi_detail.idtransaksi_detail')
            ->get();
        }else{
            $transaksi = $query->whereMonth('transaksi.created_at','=',$month)
            ->groupBy('transaksi_detail.idtransaksi_detail')
            ->get();
        }
        $pdf = \PDF::loadview('owner/cetaktransaksipdf',['transaksi'=>$transaksi, 'month'=>$month]);
        return $pdf->stream();
    }
}