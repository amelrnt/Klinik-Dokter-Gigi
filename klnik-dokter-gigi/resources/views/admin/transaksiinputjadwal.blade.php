@extends('template.master')

@section('title', 'Input Tanggal Transaksi')

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
                                              <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($jadwal->count() > 0)
                                                @foreach ($jadwal as $j)
                                                <tr>
                                                    <td>{{$j->tanggal}}</td>
                                                    <td>{{$j->hari}}</td>
                                                    <td>{{$j->jam}}</td>
                                                    <td>{{$j->namapasien}}</td>
                                                    <td>{{$j->namadokter}}</td>
                                                    @if($j->status == 1)
                                                    <td>Disetujui</td>
                                                    <td><a href="{{route('admin.tambah.transaksi',$j->idpraktik_dijadwalkan)}}" class="btn btn-primary">Input Transaksi</a></td>
                                                    @else
                                                    <td>Belum disetujui</td>
                                                    <td>Belum disetujui</td>
                                                    @endif  
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="7">Belum ada data</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if($jadwal->count() > 0)
                                    {!!$jadwal->links('pagination::bootstrap-4')!!}
                                    @endif
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop