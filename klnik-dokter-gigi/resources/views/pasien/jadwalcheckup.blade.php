@extends('template.master')

@section('title', 'Checkup Pasien')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tabel</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Jadwal Checkup</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Nama Dokter</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($jadwal != null)
                                                @foreach ($jadwal as $j)
                                                <tr>
                                                    <td>{{$j->tanggal}}</td>
                                                    <td>{{$j->hari}}</td>
                                                    <td>{{$j->jam}}</td>
                                                    <td>{{$j->nama_user}}</td>
                                                    <td><a href="{{route('daftar.checkup',['id'=>Session::get('iduser'),'jadwal'=>$j->jadwal_praktik_idjadwal_praktik])}}" class="btn btn-success">Daftar</a></td>
                                                </tr>
                                                @endforeach
                                            @else:
                                            <tr>
                                                <td>12 Mei 2022</td>
                                                <td>Senin</td>
                                                <td>12.00</td>
                                                <td>Iskandar Tua</td>
                                                <td><a href="#" class="btn btn-success">Daftar</a></td>
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