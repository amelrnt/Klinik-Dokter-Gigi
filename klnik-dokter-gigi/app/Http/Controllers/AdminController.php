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

class AdminController extends Controller
{
    public function index()
    {
        $data = User::where(['iduser'=>Session::get('iduser')])->first();
        return view('admin/index',['data'=>$data]);
    }

    public function allBarang()
    {
        $data = DB::table('barang')
        ->get();

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

    public function verifUser()
    {
        $dokter = DB::table('user')
        ->leftJoin('dokter', 'user.iduser','=', 'dokter.user_iduser')
        ->where('user.level', "dokter")
        ->get();

        $pasien = DB::table('user')
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
        ->select('jadwal_praktik.*', 'user.nama_user')
        ->get();

        $dokter = DB::table('dokter')
                    ->join('user','dokter.user_iduser','=','user.iduser')
                    ->select('*')
                    ->get();
        
        $hours = new Collection(['9','10','11','12','13','14','15','16','17','18','19']);
        $minutes = new Collection(['00','15','30','45']);
        $days = new Collection(['Senin','Selasa','Rabu','Kamis','Jumat']);

        // var_dump("Jadwal", $jadwal, "Dokter", $dokter, $hours, $minutes);

        return view('admin/jadwal',['jadwal'=>$jadwal,'dokter'=>$dokter,'hours'=>$hours,'minutes'=>$minutes,'days'=>$days]);
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
