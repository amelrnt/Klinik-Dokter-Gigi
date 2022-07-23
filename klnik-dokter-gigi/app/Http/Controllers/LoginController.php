<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function index(){
        return view('authentication/login');
    }

    public function login(Request $request){
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

        $login = Login::where(['username'=>$username,'password'=>$password])->first();
        
        if($login->count() > 0){
            if($login->user_iduser == 1){
                return response()->json(['message'=>'success','role'=>'owner','data'=>$login], Response::HTTP_OK);
            }
            if($login->user_iduser == 2){
                return response()->json(['message'=>'success','role'=>'dokter','data'=>$login], Response::HTTP_OK);
            }
            if($login->user_iduser == 4){
                return response()->json(['message'=>'success','role'=>'pasien','data'=>$login], Response::HTTP_OK);
            }
            if($login->user_iduser == 6){
                return response()->json(['message'=>'success','role'=>'admin','data'=>$login], Response::HTTP_OK);
            }
        }else{
            return response()->json(['message'=>'failed login!'], Response::HTTP_BAD_REQUEST);
        }

    }
}
