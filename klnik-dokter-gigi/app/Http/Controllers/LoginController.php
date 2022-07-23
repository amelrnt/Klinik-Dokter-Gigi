<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

        $login = Login::where(['username'=>$username,'password'=>$password])->first();
        if($login->count() > 0){
            
            if($login->user_iduser == 1 || $login->user_iduser == 6){
                return redirect('admin/'.$login->user_iduser);
            }
            if($login->user_iduser == 2){
                return redirect('dokter/'.$login->user_iduser);
            }
            if($login->user_iduser == 4){
                return redirect('pasien/'.$login->user_iduser);
            }
        }else{
            return response()->json(['status'=>'failed!','message'=>'user not found!'], Response::HTTP_BAD_REQUEST);
        }
    }

}
