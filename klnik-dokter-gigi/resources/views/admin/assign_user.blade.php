@extends('template.master')

@section('title', 'Setujui Pengguna')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">
                    <form action="{{route('admin.search.akundokter')}}" method="GET">
                        @method('GET')
                        <label class="sr-only" for="inlineFormInputGroup">Search</label>
                        <div class="input-group mb-4">
                                <input type="text" class="form-control" name="search_akun_dokter" id="search_akun_dokter" placeholder="Search Akun Dokter">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                </div>
                        </div>
                    </form>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar akun Dokter</h6>
                                <a href="{{route('admin.cetak.akundokter')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                @if(Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                                @endif
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
                                            @if($dokter->count() > 0)
                                                @foreach ($dokter as $d)
                                                <tr>
                                                    <td>{{$d->nama_user}}</td>
                                                    <td>{{$d->alamat}}</td>
                                                    <td>{{$d->noHp}}</td>
                                                    <td>{{$d->email}}</td>
                                                    <td>
                                                    @if(!$d->iddokter)
                                                    <button onclick="location.href='{{route('admin.acc.dokter',$d->iduser)}}'" type="button" class="btn btn-success">Setujui</button>
                                                    <button onclick="location.href='{{route('admin.deny.dokter',$d->iduser)}}'" type="button" class="btn btn-danger">Tolak</button>
                                                    @else
                                                    pendaftaran telah disetujui
                                                    @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="5">Belum ada data</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if($dokter->count() > 0)
                                        {!!$dokter->links('pagination::bootstrap-4')!!}
                                    @endif
                                </div>
                            </div>
                        </div>

                        
                    <form action="{{route('admin.search.akunpasien')}}" method="GET">
                        @method('GET')
                        <label class="sr-only" for="inlineFormInputGroup">Search</label>
                        <div class="input-group mb-4">
                                <input type="text" class="form-control" name="search_akun_pasien" id="search_akun_pasien" placeholder="Search Akun Pasien">
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                </div>
                        </div>
                    </form>
                        
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar akun Pasien</h6>
                                <a href="{{route('admin.cetak.akunpasien')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
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
                                        @if($pasien->count() > 0)
                                            @foreach ($pasien as $p)
                                            <tr>
                                                <td>{{$p->nama_user}}</td>
                                                <td>{{$p->alamat}}</td>
                                                <td>{{$p->noHp}}</td>
                                                <td>{{$p->email}}</td>
                                                <td>
                                                    @if(!$p->idpasien)
                                                    <button onclick="location.href='{{route('admin.acc.pasien',$p->iduser)}}'" type="button" class="btn btn-success">Setujui</button>
                                                    <button onclick="location.href='{{route('admin.deny.pasien',$p->iduser)}}'" type="button" class="btn btn-danger">Tolak</button>
                                                    @else
                                                    pendaftaran telah disetujui
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else
                                        <tr>
                                            <td colspan="5">Belum ada data</td>
                                        </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    @if($pasien->count() > 0)
                                        {!!$pasien->links('pagination::bootstrap-4')!!}
                                    @endif
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop