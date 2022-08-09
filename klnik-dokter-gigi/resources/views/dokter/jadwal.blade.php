@extends('template.master')

@section('title', 'Jadwal Dokter')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <form action="{{route('dokter.search.jadwal')}}" method="GET">
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
                                <h6 class="m-0 font-weight-bold text-primary">Jadwal Checkup</h6>
                                <a href="{{route('dokter.cetak.jadwal')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
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
                                                <th>Keterangan</th>
                                                <th>Nama Pasien</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($jadwal != null)
                                                @foreach ($jadwal as $j)
                                                <tr>
                                                    <td>{{$j->tanggal}}</td>
                                                    <td>{{$j->hari}}</td>
                                                    <td>{{$j->jam}}</td>
                                                    <td>{{$j->keterangan}}</td>
                                                    <td>{{$j->nama_user}}</td>
                                                </tr>
                                                @endforeach
                                            @else:
                                            <tr>
                                                <td>12 Mei 2022</td>
                                                <td>Senin</td>
                                                <td>12.00</td>
                                                <td>Iskandar Tua</td>
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