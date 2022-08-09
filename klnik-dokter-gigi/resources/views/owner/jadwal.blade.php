@extends('template.master')

@section('title', 'Daftar Jadwal Dokter (Owner)')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <form action="{{route('owner.search.jadwaldokter')}}" method="GET">
                            @method('GET')
                            <label class="sr-only" for="inlineFormInputGroup">Search</label>
                            <div class="input-group mb-4 mt-4">
                                    <input type="text" class="form-control" name="search_jadwal_dokter" id="search_jadwal_dokter" placeholder="Search">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                    </div>
                            </div>
                        </form>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Dokter</h6>
                                <a href="{{route('owner.cetak.jadwaldokter')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    @if(Session::has('message'))
                                        <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                                    @endif
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Hari</th>
                                                <th>Jam</th>
                                                <th>Nama Dokter</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($jadwal[0]->nama_user != null)
                                                @foreach ($jadwal as $j)
                                                <tr>
                                                    <td>{{$j->hari}}</td>
                                                    <td>{{$j->jam}}</td>
                                                    <td>{{$j->nama_user}}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td>data kosong</td>
                                                <td>data kosong</td>
                                                <td>data kosong</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    {!!$jadwal->links('pagination::bootstrap-4')!!}
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop