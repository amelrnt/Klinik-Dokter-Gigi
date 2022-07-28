@extends('template.master')

@section('title', 'Edit Profile')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Edit Profile</h1>
                        <!-- DataTales Example -->

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form name="editform" method="POST" action="{{route('update.profile')}}" class="mt-5">
                            @csrf
                            <div class="mb-3">
                                <input type="number" class="form-control" name="iduser" id="iduser" aria-describedby="iduserHelp" value="{{Session::get('iduser')}}" hidden>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="name" aria-describedby="nameHelp" value="{{$data->user->nama_user}}">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat" aria-describedby="alamatHelp" value="{{$data->user->alamat}}">
                            </div>
                            <div class="mb-3">
                                <label for="nohp" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control" name="nohp" id="nohp" aria-describedby="nohpHelp" value="{{$data->user->noHp}}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" value="{{$data->user->email}}">
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="username" aria-describedby="usernameHelp" value="{{$data->username}}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" value="{{$data->password}}">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" onchange="changeType()" class="form-check-input" name="tampilPassword" id="tampilPassword">
                                <label class="form-check-label" for="tampilPassword">Tampilkan password</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-outline-danger" href="{{route('profile')}}">Batal</a>
                        </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

    <script>
        function changeType(){
            document.editform.password.type=(document.editform.tampilPassword.value=(document.editform.tampilPassword.value==1)?'-1':'1')=='1'?'text':'password';
        }
    </script>
@stop