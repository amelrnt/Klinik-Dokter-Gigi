<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Login;

class RegisterController extends Controller
{
    public function index(){
        return view('authentication/register');
    }

    public function store(Request $request){
        
        
        $validator = $request->validate([
            'fullname' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'phoneNumber' => 'required|max:20',
            'password' => 'required',
            'confirmPassword' => 'required|same:password'
        ],
        [
            'fullname.required' => 'Nama lengkap harus diisi',
            'username.required' => 'Username harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Harus terdapat @',
            'address.required' => 'Alamat harus diisi',
            'phoneNumber.required' => 'Nomor telepon harus diisi',
            'phoneNumber.max' => 'Nomor telepon melebihi 20 karakter',
            'password.required' => 'Passwor harus diisi',
            'confirmPassword.required' => 'Konfirmasi password harus diisi',
            'confirmPassword.same' => 'password dan konfirmasi password tidak sama'
        ]);
        
        if(count($validator) > 0){
            $user = new User();

            $user->nama_user = $request->input('fullname');
            $user->alamat = $request->input('address');
            $user->email = $request->input('email');
            $user->noHp = $request->input('phoneNumber');
            $user->level = 'pasien';

            if($user->save()){
                $login = new Login();

                $login->username = $request->input('username');
                $login->password = $request->input('password');
                $login->user_iduser = $user->id;

                $login->save();

                return redirect('login');
            }else{
                return redirect('register');
            }

        }else{

        }

    }
}
