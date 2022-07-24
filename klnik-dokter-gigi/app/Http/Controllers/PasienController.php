<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class PasienController extends Controller
{
    public function index($id)
    {
        $data = User::where(['iduser'=>$id])->first();
        session(['nama_user'=>$data->nama_user,'alamat'=>$data->alamat,'noHp'=>$data->noHp,'email'=>$data->email,'level'=>$data->level]);
        return view('pasien/index');
    }

}
