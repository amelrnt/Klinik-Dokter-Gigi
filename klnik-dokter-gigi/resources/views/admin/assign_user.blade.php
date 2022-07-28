@extends('template.master')

@section('title', 'Kelola Barang')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tabel</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar akun Dokter</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama User</th>
                                                <th>Alamat</th>
                                                <th>No Hp</th>
                                                <th>Email</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($dokter != null)
                                                @foreach ($dokter as $d)
                                                <tr>
                                                    <td>{{$d->nama_user}}</td>
                                                    <td>{{$d->alamat}}</td>
                                                    <td>{{$d->noHp}}</td>
                                                    <td>{{$d->email}}</td>
                                                    <td>
                                                    @if(!$d->iddokter)
                                                    <button type="button" class="btn btn-success">Setujui </button>
                                                    <button type="button" class="btn btn-danger">Tolak</button>
                                                    @else
                                                    pendaftaran telah disetujui
                                                    @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td>data kosong</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                <button type="button" class="btn btn-success">Edit</button>
                                                <button type="button" class="btn btn-danger">Hapus</button>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar akun Pasien</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama User</th>
                                                <th>Alamat</th>
                                                <th>No Hp</th>
                                                <th>Email</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($dokter != null)
                                                @foreach ($pasien as $p)
                                                <tr>
                                                    <td>{{$p->nama_user}}</td>
                                                    <td>{{$p->alamat}}</td>
                                                    <td>{{$p->noHp}}</td>
                                                    <td>{{$p->email}}</td>
                                                    <td>
                                                    @if(!$p->idpasien)
                                                    <button type="button" class="btn btn-success">Setujui</button>
                                                    <button type="button" class="btn btn-danger">Tolak</button>
                                                    @else
                                                    pendaftaran telah disetujui
                                                    @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else:
                                            <tr>
                                                <td>data kosong</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop