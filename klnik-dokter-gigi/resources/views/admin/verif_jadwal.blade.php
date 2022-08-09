@extends('template.master')

@section('title', 'Verifikasi Jadwal')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">
                    
                        <form action="{{route('admin.search.jadwalverif')}}" method="GET">
                            @method('GET')
                            <label class="sr-only" for="inlineFormInputGroup">Search</label>
                            <div class="input-group mb-4 mt-4">
                                    <input type="text" class="form-control" name="search_jadwal_verif" id="search_jadwal_verif" placeholder="Search">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                    </div>
                            </div>
                        </form>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Checkup Pasien</h6>
                                <a href="{{route('admin.cetak.jadwalverif')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
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
                                                        <a href="{{route('admin.terima.jadwal', $j->idpraktik_dijadwalkan)}}" class="btn btn-success">Terima</a>
                                                        {{-- <a href="{{route('admin.tolak.jadwal', $j->idpraktik_dijadwalkan)}}" class="btn btn-danger">Tolak</a> --}}
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
                                                <!-- <button type="button" class="btn btn-success">Terima</button>
                                                <button type="button" class="btn btn-danger">Tolak</button> -->
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