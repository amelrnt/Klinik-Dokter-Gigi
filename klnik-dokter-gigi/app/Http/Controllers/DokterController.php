<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;
use App\Models\User;

class DokterController extends Controller
{
    public function index($id)
    {
        $data = User::where(['iduser'=>$id])->first();
        return view('dokter/index',['data'=>$data]);
    }

}
