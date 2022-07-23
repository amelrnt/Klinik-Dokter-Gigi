<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use App\Models\User;

class PasienController extends Controller
{
    public function index($id)
    {
        $data = User::where(['iduser'=>$id])->first();
        return view('pasien/index',['data'=>$data]);
    }

}
