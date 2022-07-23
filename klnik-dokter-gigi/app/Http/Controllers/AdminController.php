<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index($id)
    {
        $data = User::where(['iduser'=>$id])->first();
        return view('admin/index',['data'=>$data]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

 
    public function show(Admin $admin)
    {
        //
    }


    public function edit(Admin $admin)
    {
        //
    }

    
    public function update(Request $request, Admin $admin)
    {
        //
    }

  
    public function destroy(Admin $admin)
    {
        //
    }
}
