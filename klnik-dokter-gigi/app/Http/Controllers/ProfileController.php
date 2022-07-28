<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Login;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function profile(){
        $data = User::where(['iduser'=>Session::get('iduser')])->first();
        // var_dump($data);
        return view('authentication/profile',['data'=>$data]);
    }

    public function edit(){
        $data = Login::select('*')->where(['user_iduser'=>Session::get('iduser')])->first();
        // var_dump($data);
        return view('authentication/edit',['data'=>$data]);
    }

    public function update(Request $request){
        $data = Login::select('*')->where(['user_iduser'=>$request->input('iduser')])->first();
        // var_dump($data, $request->input('email'));
        
        $data->username = $request->input('username');
        $data->password = $request->input('password');
        $data->user->nama_user = $request->input('name');
        $data->user->noHp = $request->input('nohp');
        $data->user->email = $request->input('email');
        $data->user->alamat = $request->input('alamat');

        if($data->update() && $data->user->update()){
            return redirect(route('profile'));
        }else{
            return redirect(route('edit.profile'));
        }
    }
}
