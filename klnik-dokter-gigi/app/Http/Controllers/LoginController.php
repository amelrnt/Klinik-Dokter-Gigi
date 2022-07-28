<?php

namespace App\Http\Controllers;

use App\Models\Login as login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Response;
use App\Models\User;

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

        $login = Login::where(['username'=>$username,'password'=>$password])->first()->user;
        
        $data = User::where(['iduser'=>$login->iduser])->first();
        
        session(['iduser'=>$login->iduser,'nama_user'=>$data->nama_user,'alamat'=>$data->alamat,'noHp'=>$data->noHp,'email'=>$data->email,'level'=>$data->level]);
        
        if($login->count() > 0){
            if($login->level == 'admin'){
                return redirect('admin');
            }
            if($login->level == 'pemilik'){
                return redirect('owner');
            }
            if($login->level == 'dokter'){
                return redirect('dokter');
            }
            if($login->level == 'pasien'){
                return redirect('pasien');
            }
        }else{
            return response()->json(['status'=>'failed!','message'=>'user not found!'], Response::HTTP_BAD_REQUEST);
        }
    }

    public function logout(){        
        Session::invalidate();
        Session::regenerateToken();

        return redirect('login');
    }

}
