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
                                <h6 class="m-0 font-weight-bold text-primary">Riwayat Checkup</h6>
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
                                                <th>Keterangan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($riwayat != null)
                                                @foreach ($riwayat as $r)
                                                <tr>
                                                    <td>{{$r->tanggal}}</td>
                                                    <td>{{$r->hari}}</td>
                                                    <td>{{$r->jam}}</td>
                                                    <td>{{$r->nama_user}}</td>
                                                    <td>{{$r->keterangan}}</td>
                                                    @if($r->status==1)
                                                    <td>dikonfirmasi</td>
                                                    @else
                                                    <td>tidak dikonfirmasi</td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            @else:
                                            <tr>
                                                <td>11 Januari 2022</td>
                                                <td>Senin</td>
                                                <td>10.00</td>
                                                <td>Johnny</td>
                                                <td>Hadir</td>
                                                <td>Aktif</td>
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