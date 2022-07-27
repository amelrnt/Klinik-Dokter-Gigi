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
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Checkup Pasien</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                              <th>Tanggal</th>
                                              <th>Hari</th>
                                              <th>Jam</th>
                                              <th>Nama Pasien</th>
                                              <th>Nama Dokter</th>
                                              <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($jadwal != null)
                                                @foreach ($jadwal as $j)
                                                <tr>
                                                  <td>{{$j->tanggal}}</td>
                                                  <td>{{$j->hari}}</td>
                                                  <td>{{$j->jam}}</td>
                                                  <td>{{$j->namapasien}}</td>
                                                  <td>{{$j->namadokter}}</td>
                                                  @if($j->status == 1)
                                                  <td>Disetujui</td>
                                                  @else
                                                    <td>
                                                    <button type="button" class="btn btn-success">Terima</button>
                                                    <button type="button" class="btn btn-danger">Tolak</button>
                                                    </td>
                                                  @endif  
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td>data kosong</td>
                                                <td> </td>
                                                <td> </td>
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

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop