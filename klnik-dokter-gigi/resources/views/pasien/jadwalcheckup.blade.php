@extends('template.master')

@section('title', 'Checkup Pasien')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">
                    
                    <form action="{{route('list.search.jadwal')}}" method="GET">
                        @method('GET')
                        <label class="sr-only" for="inlineFormInputGroup">Search</label>
                        <div class="input-group mb-2 mt-1">
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
                            @if(Request::input('filter_month') == null)
                            <a href="{{route('pasien.cetak.jadwal')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                            @else
                            <a href="{{route('pasien.cetak.jadwalcheckupbymonth',Request::input('filter_month'))}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                            @endif
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
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($jadwal->count() > 0)
                                            @foreach ($jadwal as $j)
                                            <tr>
                                                <td>{{$j->hari}}</td>
                                                <td>{{$j->jam}}</td>
                                                <td>{{$j->nama_user}}</td>
                                                <td>
                                                    <a href="{{route('pasien.input.jadwal',$j->idjadwal_praktik)}}" class="btn btn-success">Daftar</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @else:
                                        <tr>
                                            <td colspan="4">Belum ada jadwal</td>
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