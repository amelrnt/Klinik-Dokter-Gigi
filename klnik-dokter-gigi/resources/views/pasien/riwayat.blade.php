@extends('template.master')

@section('title', 'Riwayat Checkup Pasien')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Riwayat Checkup</h6>
                                <a href="{{route('pasien.cetak.riwayat')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                @if(Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                                @endif
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
                                                <td colspan="6">Belum ada riwayat checkup</td>
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