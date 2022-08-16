<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Barang;
use stdClass;
use Illuminate\Support\Collection;
use \PDF;

class AdminController extends Controller
{
    public function index()
    {
        $data = User::where(['iduser'=>Session::get('iduser')])->first();

        $terjadwal = DB::table('praktik_dijadwalkan')
        // ->join('jadwal_praktik', 'jadwal_praktik.idjadwal_praktik', '=', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik')
        // ->join('pasien', 'pasien.idpasien', '=', 'praktik_dijadwalkan.pasien_idpasien')
        // ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        // ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        // ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        // ->select('praktik_dijadwalkan.idpraktik_dijadwalkan','praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.status','1')
        ->count('praktik_dijadwalkan.idpraktik_dijadwalkan');

        $allJadwal = DB::table('praktik_dijadwalkan')
        // ->join('jadwal_praktik', 'jadwal_praktik.idjadwal_praktik', '=', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik')
        // ->join('pasien', 'pasien.idpasien', '=', 'praktik_dijadwalkan.pasien_idpasien')
        // ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        // ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        // ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        // ->select('praktik_dijadwalkan.idpraktik_dijadwalkan','praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.status','0')
        ->count('praktik_dijadwalkan.idpraktik_dijadwalkan');

        $pasien = DB::table('pasien')
        ->count('idpasien');

        $dokter= DB::table('dokter')
        ->count('iddokter');

        return view('admin/index',['data'=>$data, 'konfirmasi' => $terjadwal, 'nonkonfirmasi'=>$allJadwal, 'pasien' => $pasien, 'dokter'=>$dokter]);
    }

    public function allBarang()
    {
        $data = DB::table('barang')
        ->paginate(6);

        return view('admin/barang',['barang'=>$data]);
    }

    public function inputNewBarang(){
        return view('admin/tambahbarang');
    }

    public function addBarang(Request $request)
    {

        $request->validate([
            'nama_barang' => 'required',
            'harga_barang' => 'required',
            'stok_barang' => 'required'
        ],
        [
            'nama_barang.required' => 'Nama barang harus diinput',
            'harga_barang.required' => 'Harga barang harus diinput',
            'stok_barang.required' => 'Stok barang harus diinput',
        ]);

        $data = [
            'nama_barang' => $request->input('nama_barang'),
            'harga_barang' => $request->input('harga_barang'),
            'stok_barang' => $request->input('stok_barang')
        ];

        $add_barang = DB::table('barang')->insert($data);
        
        if($add_barang){
            Session::flash('message', 'Barang berhasil ditambah');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Barang gagal ditambah!');
            Session::flash('alert-class', 'alert-danger'); 
        }
        return redirect(route('admin.barang'));
    }

    public function searchBarang(Request $request){

        $barang = $request->input('search_barang');

        $data = DB::table('barang')
        ->select('*')
        ->where('nama_barang','LIKe','%'.$barang.'%')
        ->orWhere('harga_barang','LIKE','%'.$barang.'%')
        ->orWhere('stok_barang','LIKE','%'.$barang.'%')
        ->get();

        return view('admin/barang',['barang'=>$data]);

    }

    public function cetakBarangPDF(){
        $data = DB::table('barang')
        ->get();

        $pdf = \PDF::loadview('admin/cetakbarangpdf',['barang'=>$data]);

        return $pdf->stream();
    }

    public function verifUser()
    {
        $dokter = DB::table('user')
        ->leftJoin('dokter', 'user.iduser','=', 'dokter.user_iduser')
        ->where('user.level', "dokter")
        ->paginate(10);

        $pasien = DB::table('user')
        ->leftJoin('pasien', 'user.iduser','=', 'pasien.user_iduser')
        ->where('user.level', "pasien")
        ->paginate(10);

        return view('admin/assign_user',['dokter'=>$dokter, 'pasien'=>$pasien]);
    }
    public function cetakAkunPasienPDF()
    {

        $pasien = DB::table('user')
        ->leftJoin('pasien', 'user.iduser','=', 'pasien.user_iduser')
        ->where('user.level', "pasien")
        ->get();

        
        $pdf = \PDF::loadview('admin/cetakakunpasienpdf',['pasien'=>$pasien]);

        return $pdf->stream();
    }
    public function cetakAkunDokterPDF()
    {

        $dokter = DB::table('user')
        ->leftJoin('dokter', 'user.iduser','=', 'dokter.user_iduser')
        ->where('user.level', "dokter")
        ->get();

        $pdf = \PDF::loadview('admin/cetakakundokterpdf',['dokter'=>$dokter]);

        return $pdf->stream();
    }

    public function searchAkunDokter(Request $request){

        $akunDokter = $request->input('search_akun_dokter');

        $dokter = DB::table('user')
        ->leftJoin('dokter', 'user.iduser','=', 'dokter.user_iduser')
        ->select('user.*','dokter.*')
        ->where('user.level', "dokter")
        ->where(function($query) use ($akunDokter){
            $query->where('user.nama_user','LIKE','%'.$akunDokter.'%')
            ->orWhere('user.alamat','LIKE','%'.$akunDokter.'%')
            ->orWhere('user.noHp','LIKE','%'.$akunDokter.'%')
            ->orWhere('user.email','LIKE','%'.$akunDokter.'%');
        })
        ->paginate(15);
        

        $pasien = DB::table('user')
        ->leftJoin('pasien', 'user.iduser','=', 'pasien.user_iduser')
        ->where('user.level', "pasien")
        ->paginate(15);

        return view('admin/assign_user',['dokter'=>$dokter, 'pasien'=>$pasien]);
    }

    public function searchAkunPasien(Request $request){

        $akunPasien = $request->input('search_akun_pasien');

        $dokter = DB::table('user')
        ->leftJoin('dokter', 'user.iduser','=', 'dokter.user_iduser')
        ->where('user.level', "dokter")
        ->paginate(15);
        

        $pasien = DB::table('user')
        ->leftJoin('pasien', 'user.iduser','=', 'pasien.user_iduser')
        ->select('user.*','pasien.*')
        ->where('user.level', "pasien")
        
        ->where(function($query) use ($akunPasien){
            $query->where('user.nama_user','LIKE','%'.$akunPasien.'%')
            ->orWhere('user.alamat','LIKE','%'.$akunPasien.'%')
            ->orWhere('user.noHp','LIKE','%'.$akunPasien.'%')
            ->orWhere('user.email','LIKE','%'.$akunPasien.'%');
        })
        ->paginate(15);

        return view('admin/assign_user',['dokter'=>$dokter, 'pasien'=>$pasien]);
    }

    public function accPasien($idUser)
    {

        $pasien = DB::table('pasien')->insert([
            'user_iduser' => $idUser]);

        if($pasien){
            Session::flash('message', 'Akun berhasil disetujui!');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Jadwal gagal disetujui!');
            Session::flash('alert-class', 'alert-danger'); 
        }

        return redirect(route('admin.verif'));
    }

    public function accDokter($idUser)
    {
        
        $dokter = DB::table('dokter')->insert([
            'user_iduser' => $idUser]);

        if($dokter){
            Session::flash('message', 'Akun berhasil disetujui!');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Jadwal gagal disetujui!');
            Session::flash('alert-class', 'alert-danger'); 
        }

        return redirect(route('admin.verif'));
    }

    public function denyDokter($idUser)
    {
        $dokter = DB::table('user')
        ->where('iduser', $idUser)->delete();

        Session::flash('message', 'akun berhasil ditolak!');
        Session::flash('alert-class', 'alert-danger'); 

        return redirect(route('admin.verif'));
    }

    public function denyPasien($idUser)
    {
        $pasien = DB::table('user')
        ->where('iduser', $idUser)->delete();

        Session::flash('message', 'akun berhasil ditolak!');
        Session::flash('alert-class', 'alert-danger'); 
        
        return redirect(route('admin.verif'));
    }


    public function verifJadwal()
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
        ->select('praktik_dijadwalkan.idpraktik_dijadwalkan','praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->paginate(15);

        return view('admin/verif_jadwal',['jadwal'=>$jadwal]);
    }

    public function searchVerifJadwalByMonth(Request $request){

        $month = $request->input('filter_month');

        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.idpraktik_dijadwalkan','praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->whereMonth('praktik_dijadwalkan.tanggal','=',$month)
        ->paginate(15);

        return view('admin/verif_jadwal',['jadwal'=>$jadwal]);
    }

    public function cetakVerifJadwalPDF(){
        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.idpraktik_dijadwalkan','praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->get();

        $pdf = \PDF::loadview('admin/cetakverifjadwalpdf',['jadwal'=>$jadwal,'month'=>'0']);

        return $pdf->stream();
    }

    public function cetakVerifJadwalPDFByMonth($month){
        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.idpraktik_dijadwalkan','praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->whereMonth('praktik_dijadwalkan.tanggal','=',$month)
        ->get();

        $pdf = \PDF::loadview('admin/cetakverifjadwalpdf',['jadwal'=>$jadwal,'month'=>$month]);

        return $pdf->stream();
    }

    public function searchVerifJadwal(Request $request){
        
        $searchVerif = $request->input('search_jadwal_verif');

        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'jadwal_praktik.idjadwal_praktik', '=', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik')
        ->join('pasien', 'pasien.idpasien', '=', 'praktik_dijadwalkan.pasien_idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.idpraktik_dijadwalkan','praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.tanggal','LIKE','%'.$searchVerif.'%')
        ->orWhere('jadwal_praktik.hari','LIKE','%'.$searchVerif.'%')
        ->orWhere('jadwal_praktik.jam','LIKE','%'.$searchVerif.'%')
        ->orWhere('praktik_dijadwalkan.keterangan','LIKE','%'.$searchVerif.'%')
        ->orWhere('u1.nama_user','LIKE','%'.$searchVerif.'%')
        ->orWhere('u2.nama_user','LIKE','%'.$searchVerif.'%')
        ->paginate(15);

        return view('admin/verif_jadwal',['jadwal'=>$jadwal]);
    }

    public function terimaJadwal($id){
        
        $data = [
            'praktik_dijadwalkan.status' => '1'
        ];
        
        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'jadwal_praktik.idjadwal_praktik', '=', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik')
        ->join('pasien', 'pasien.idpasien', '=', 'praktik_dijadwalkan.pasien_idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.idpraktik_dijadwalkan',$id)
        ->update($data);

        if($jadwal){
            Session::flash('message', 'Jadwal berhasil disetujui!');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Jadwal gagal disetujui!');
            Session::flash('alert-class', 'alert-danger'); 
        }
        
        return redirect(route('admin.jadwal'));
    }

    public function tolakJadwal($id){
        
        $jadwal = DB::table('praktik_dijadwalkan')
        ->join('jadwal_praktik', 'jadwal_praktik.idjadwal_praktik', '=', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik')
        ->join('pasien', 'pasien.idpasien', '=', 'praktik_dijadwalkan.pasien_idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.idpraktik_dijadwalkan', $id)
        ->delete();

        if($jadwal){
            Session::flash('message', 'Jadwal berhasil ditolak!');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Jadwal gagal ditolak!');
            Session::flash('alert-class', 'alert-danger'); 
        }
        
        return redirect(route('admin.jadwal'));
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

        // $time = explode(':',$jadwal[0]->jam);
        // var_dump($time);
        // die();

        $dokter = DB::table('dokter')
                    ->join('user','dokter.user_iduser','=','user.iduser')
                    ->select('*')
                    ->get();
        
        $hours = new Collection(['8','9','10','11','12','13','14','15','16','17','18','19']);
        $minutes = new Collection(['00','15','30','45']);
        $days = new Collection(['senin','selasa','rabu','kamis','jumat','sabtu','minggu']);

        // var_dump("Jadwal", $jadwal, "Dokter", $dokter, $hours, $minutes);

        return view('admin/jadwal',['jadwal'=>$jadwal,'dokter'=>$dokter,'hours'=>$hours,'minutes'=>$minutes,'days'=>$days]);
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

        $dokter = DB::table('dokter')
                    ->join('user','dokter.user_iduser','=','user.iduser')
                    ->select('*')
                    ->get();
        
        $hours = new Collection(['9','10','11','12','13','14','15','16','17','18','19']);
        $minutes = new Collection(['00','15','30','45']);
        $days = new Collection(['senin','selasa','rabu','kamis','jumat','sabtu','minggu']);

        // var_dump("Jadwal", $jadwal, "Dokter", $dokter, $hours, $minutes);

        return view('admin/jadwal',['jadwal'=>$jadwal,'dokter'=>$dokter,'hours'=>$hours,'minutes'=>$minutes,'days'=>$days]);
    }

    public function cetakJadwalDokterPDF(){
        $jadwal = DB::table('jadwal_praktik')
        ->join('dokter', 'jadwal_praktik.dokter_iddokter', '=', 'dokter.iddokter')
        ->join('user', 'user.iduser', '=', 'dokter.user_iduser')
        ->select('jadwal_praktik.*', 'user.nama_user')
        ->get();

        $pdf = \PDF::loadview('admin/cetakjadwalpdf',['jadwal'=>$jadwal]);

        return $pdf->stream();
    }

    public function addNewJadwal(){
        
        $dokter = DB::table('dokter')
                    ->join('user','dokter.user_iduser','=','user.iduser')
                    ->select('*')
                    ->get();

        return view('admin/tambahjadwal',['dokter'=>$dokter]);
    }

    public function storeJadwal(Request $request){
        $storeJadwal = DB::table('jadwal_praktik')
                        ->insert([
                            'hari' => $request->input('hari'),
                            'jam' => $request->input('jam').':'.$request->input('menit'),
                            'dokter_iddokter' => $request->input('id_dokter')
                        ]);
        if($storeJadwal){
            Session::flash('message', 'Jadwal berhasil ditambah!');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Jadwal gagal ditambah!');
            Session::flash('alert-class', 'alert-danger'); 
        }
            return redirect(route('admin.jadwaldokter'));        
    }

    public function updateJadwal(Request $request, $idjadwal){
        $data = [
            'hari' => $request->input('hari_'.$idjadwal),
            'jam' => $request->input('jam_'.$idjadwal).':'.$request->input('menit_'.$idjadwal),
            'dokter_iddokter' => $request->input('nama_dokter_'.$idjadwal)
        ];

        $jadwal = DB::table('jadwal_praktik')
                ->where('idjadwal_praktik',$idjadwal)
                ->update($data);

        if($jadwal){
            Session::flash('message', 'Jadwal berhasil diupdate');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Jadwal gagal diupdate!');
            Session::flash('alert-class', 'alert-danger'); 
        }
        return redirect(route('admin.jadwaldokter'));
    }

    public function deletejadwal($idjadwal){
        
        $jadwal = DB::table('jadwal_praktik')
        ->where('idjadwal_praktik',$idjadwal)
        ->delete();

        if($jadwal){
            Session::flash('message', 'Jadwal berhasil dihapus');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Jadwal gagal dihapu!');
            Session::flash('alert-class', 'alert-danger'); 
        }
        return redirect(route('admin.jadwaldokter'));
    }

    public function showTransaksi()
    {
        // SELECT transaksi.idtransaksi, user.nama_user as pasien, GROUP_CONCAT(barang.nama_barang SEPARATOR ', ') AS nama_barang, transaksi_detail.jumlah, transaksi.metode_pembayaran, transaksi.total_harga, transaksi.created_at FROM transaksi_detail 
        // INNER JOIN `transaksi`ON transaksi_detail.transaksi_idtransaksi = transaksi.idtransaksi 
        // INNER JOIN praktik_dijadwalkan ON praktik_dijadwalkan.idpraktik_dijadwalkan = transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan 
        // INNER JOIN barang ON transaksi_detail.barang_idbarang = barang.idbarang 
        // INNER JOIN pasien ON praktik_dijadwalkan.pasien_idpasien = pasien.idpasien 
        // INNER JOIN user ON user.iduser = pasien.user_iduser GROUP BY transaksi.idtransaksi
        
        $transaksi = DB::table('transaksi_detail')
        ->join('transaksi', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', DB::raw('group_concat(barang.nama_barang) as nama_barang'), 'transaksi_detail.jumlah', 'transaksi.metode_pembayaran', 'transaksi.total_harga', 'transaksi.created_at')
        ->groupBy('transaksi.idtransaksi')
        ->paginate(15);

        return view('admin/transaksi',['transaksi'=>$transaksi]);
    }
    public function searchTransaksiByMonth(Request $request){

        $month = $request->input('filter_month');

        $query = DB::table('transaksi_detail')
        ->join('transaksi', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', DB::raw('group_concat(barang.nama_barang) as nama_barang'), 'transaksi_detail.jumlah', 'transaksi.metode_pembayaran', 'transaksi.total_harga', 'transaksi.created_at');

        if($month == '0'){
            $transaksi = $query->groupBy('transaksi.idtransaksi')
            ->paginate(15);
        }else{
            $transaksi = $query->whereMonth('transaksi.created_at','=',$month)
            ->groupBy('transaksi.idtransaksi')
            ->paginate(15);
        }
        return view('admin/transaksi',['transaksi'=>$transaksi]);
    }



    public function cetakTransaksiPDF(){
        
        $transaksi = DB::table('transaksi_detail')
        ->join('transaksi', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', DB::raw('group_concat(barang.nama_barang) as nama_barang'), 'transaksi_detail.jumlah', 'transaksi.metode_pembayaran', 'transaksi.total_harga', 'transaksi.created_at')
        ->groupBy('transaksi.idtransaksi')
        ->get();

        $pdf = \PDF::loadview('admin/cetaktransaksipdf',['transaksi'=>$transaksi, 'month'=>'0']);

        return $pdf->stream();
    }
    public function cetakTransaksiByMonthPDF($month){
        
        $query = DB::table('transaksi_detail')
        ->join('transaksi', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', DB::raw('group_concat(barang.nama_barang) as nama_barang'), 'transaksi_detail.jumlah', 'transaksi.metode_pembayaran', 'transaksi.total_harga', 'transaksi.created_at');

        if($month == '0'){
            $transaksi = $query->groupBy('transaksi.idtransaksi')
            ->get();
        }else{
            $transaksi = $query->whereMonth('transaksi.created_at','=',$month)
            ->groupBy('transaksi.idtransaksi')
            ->get();
        }
        $pdf = \PDF::loadview('admin/cetaktransaksipdf',['transaksi'=>$transaksi, 'month'=>$month]);
        return $pdf->stream();
    }
    public function searchTransaksi(Request $request){
        
        $searchTransaksi = $request->input('search_transaksi');
        
        $transaksi = DB::table('transaksi_detail')
        ->join('transaksi', 'transaksi_detail.transaksi_idtransaksi', '=', 'transaksi.idtransaksi')
        ->join('praktik_dijadwalkan', 'praktik_dijadwalkan.idpraktik_dijadwalkan', '=', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan')
        ->join('barang', 'transaksi_detail.barang_idbarang', '=', 'barang.idbarang')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('user', 'pasien.user_iduser', '=', 'user.iduser')
        ->select('user.nama_user', DB::raw('group_concat(barang.nama_barang) as nama_barang'), 'transaksi_detail.jumlah', 'transaksi.metode_pembayaran', 'transaksi.total_harga', 'transaksi.created_at')
        ->groupBy('transaksi.idtransaksi')
        ->where('user.nama_user','LIKE','%'.$searchTransaksi.'%')
        ->orWhere('barang.nama_barang','LIKE','%'.$searchTransaksi.'%')
        ->orWhere('transaksi_detail.jumlah','LIKE','%'.$searchTransaksi.'%')
        ->orWhere('transaksi.metode_pembayaran','LIKE','%'.$searchTransaksi.'%')
        ->orWhere('transaksi.total_harga','LIKE','%'.$searchTransaksi.'%')
        ->orWhere('transaksi.created_at','LIKE','%'.$searchTransaksi.'%')
        ->paginate(15);

        return view('admin/transaksi',['transaksi'=>$transaksi]);
    }
    
    public function pilihJadwalTransaksi(){

        $jadwal = DB::table('transaksi')
        ->rightJoin('praktik_dijadwalkan', 'transaksi.praktik_dijadwalkan_idpraktik_dijadwalkan','=', 'praktik_dijadwalkan.idpraktik_dijadwalkan')
        ->join('jadwal_praktik', 'praktik_dijadwalkan.jadwal_praktik_idjadwal_praktik', '=', 'jadwal_praktik.idjadwal_praktik')
        ->join('pasien', 'praktik_dijadwalkan.pasien_idpasien', '=', 'pasien.idpasien')
        ->join('dokter', 'dokter.iddokter', '=', 'jadwal_praktik.dokter_iddokter')
        ->join('user as u1' , 'u1.iduser', '=', 'pasien.user_iduser')
        ->join('user as u2', 'u2.iduser', '=', 'dokter.user_iduser')
        ->select('praktik_dijadwalkan.idpraktik_dijadwalkan','praktik_dijadwalkan.tanggal', 'jadwal_praktik.hari', 'jadwal_praktik.jam', 'praktik_dijadwalkan.keterangan', 'praktik_dijadwalkan.status', 'u1.nama_user as namapasien', 'u2.nama_user as namadokter')
        ->where('praktik_dijadwalkan.status','1')
        ->WhereNull('transaksi.idtransaksi')
        ->get();
        
        return view('admin/transaksiinputjadwal',['jadwal'=>$jadwal]);
    }

    public function inputTransaksi($idjadwal){

        $user = DB::table('user')
                    ->join('pasien','pasien.user_iduser','=','user.iduser')
                    ->where('user.level','pasien')
                    ->select('pasien.idpasien','user.nama_user')->get();
        
        $barang = DB::table('barang')->select('*')->get();

        $jadwal = DB::table('praktik_dijadwalkan')
                    ->select('praktik_dijadwalkan.*')
                    ->where('praktik_dijadwalkan.idpraktik_dijadwalkan',$idjadwal)
                    ->first();

        return view('admin/tambahtransaksi',['user'=>$user,'jadwal'=>$jadwal,'barang'=>$barang]);
    }

    public function transaksiToDB(Request $request,$idjadwal)
    {
        // set timezone to GMT+7 ("Asia/Bangkok")
        date_default_timezone_set("Asia/Bangkok");
        
        $storetransaksi = DB::table('transaksi')
                        ->insertGetId([
                            'praktik_dijadwalkan_idpraktik_dijadwalkan' => $idjadwal,
                            'metode_pembayaran' => $request->input('metode_pembayaran'),
                            'total_harga' => $request->input('harga_barang'),
                            'created_at' => now()->format('Y-m-d H:i:s'),
                        ]);

        $storeTransaksiDetail = DB::table('transaksi_detail')
        ->insert([
            'transaksi_idtransaksi' => $storetransaksi,
            'barang_idbarang' => $request->input('barang'),
            'jumlah' => $request->input('jumlah_barang')
        ]);                

        if ($storeTransaksiDetail) {
            Session::flash('message', 'Transaksi berhasil ditambahkan!');
            Session::flash('alert-class', 'alert-success'); 
        } else{
            Session::flash('message', 'Transaksi gagal ditambahkan!');
            Session::flash('alert-class', 'alert-danger'); 
        }
        
        return redirect(route('admin.transaksi'));
    }

    public function updateBarang(Request $request, $idbarang){
        $data = [
            'nama_barang' => $request->input('nama_barang_'.$idbarang),
            'harga_barang' => $request->input('harga_barang_'.$idbarang),
            'stok_barang' => $request->input('stok_barang_'.$idbarang)
        ];

        $barang = Barang::findOrFail($idbarang)
                        ->update($data);

        if($barang){
            Session::flash('message', 'Barang berhasil diupdate');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Barang gagal diupdate!');
            Session::flash('alert-class', 'alert-danger'); 
        }
        return redirect(route('admin.barang'));
    }

    public function deleteBarang($idbarang){
        $barang = Barang::findOrFail($idbarang)
                    ->delete();

        if($barang){
            Session::flash('message', 'Barang berhasil dihapus');
            Session::flash('alert-class', 'alert-success'); 
        }else{
            Session::flash('message', 'Barang gagal dihapus!');
            Session::flash('alert-class', 'alert-danger'); 
        }
        return redirect(route('admin.barang'));
    }
}