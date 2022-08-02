<?php

namespace App\Http\Controllers;

use App\Models\Login as login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('authentication/login');
    }

    public function authenticate(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        
        //valid credential
        $validator = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ],
        [
            'username.required' => 'Username harus diinput',
            'password.required' => 'Password harus diinput'
        ]);

        // $login = Login::where(['username'=>$username,'password'=>$password])->first()->user;
        
        $data = User::where(['username'=>$username,'password'=>$password])->first();
        if($data != null){
            
            $request->session()->regenerate();
            
            session(['iduser'=>$data->iduser,'nama_user'=>$data->nama_user,'alamat'=>$data->alamat,'noHp'=>$data->noHp,'email'=>$data->email,'level'=>$data->level]);
            
            if($data->level == 'admin'){
                return redirect('admin');
            }
            if($data->level == 'pemilik'){
                return redirect('owner');
            }
            if($data->level == 'dokter'){
                return redirect('dokter');
            }
            if($data->level == 'pasien'){
                return redirect('pasien');
            }
        }else{
            Session::flash('message', 'Anda belum terdaftar!');
            Session::flash('alert-class', 'alert-danger'); 
            return back();
        }
    }

    public function logout(){        
        Session::invalidate();
        Session::regenerateToken();

        return redirect('login');
    }

}
