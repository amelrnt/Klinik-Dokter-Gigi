@extends('template.master')

@section('title', 'Profile')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Biodata</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">{{strtoupper(Session::get('level'))}}</h6>
                            </div>
                            <div class="card-body my-4">
                            @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                            @endif
                                @if($data != null)
                                <div class="row">
                                    <div class="col ml-4">
                                        <img width="300px" src="{{asset('img/profile-user.png')}}" alt="">
                                    </div>
                                    <div class="col mr-4">
                                        <div class="row">
                                            <div class="col">
                                                <p><b>Username</b></p>
                                            </div>
                                            <div class="col">
                                                <p>{{$data->nama_user}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p><b>Password</b></p>
                                            </div>
                                            <div class="col">
                                                <p>********</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p><b>Nama</b></p>
                                            </div>
                                            <div class="col">
                                                <p>{{$data->nama_user}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p><b>Email</b></p>
                                            </div>
                                            <div class="col">
                                                <p>{{$data->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p><b>Alamat</b></p>
                                            </div>
                                            <div class="col">
                                                <p>{{$data->alamat}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <p><b>Nomor HP</b></p>
                                            </div>
                                            <div class="col">
                                                <p>{{$data->noHp}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                {{-- Button to edit --}}
                                                <a class="btn btn-warning" href="{{route('edit.profile')}}">Edit</a>
                                            </div>
                                            <div class="col">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop