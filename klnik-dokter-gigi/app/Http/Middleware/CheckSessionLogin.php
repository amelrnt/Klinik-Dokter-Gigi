<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckSessionLogin
{
    public function handle(Request $request, Closure $next)
    {
        if(!$request->session()->has('iduser')){
            return redirect('login');
        }else{
            if($request->session('level') == 'pasien'){
                return redirect('pasien');
            }
            if($request->session('level') == 'dokter'){
                return redirect('dokter');
            }
            if($request->session('level') == 'admin'){
                return redirect('admin');
            }
            if($request->session('level') == 'pemilik'){
                return redirect('owner');
            }
        }
        return $next($request);
    }
}