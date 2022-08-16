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
                                @if(Request::input('filter_month') == null)
                                <a href="{{route('dokter.cetak.jadwal')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                                @else
                                <a href="{{route('dokter.cetak.jadwalbymonth',Request::input('filter_month'))}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <form action="{{route('dokter.filter.jadwalbymonth')}}" method="get">
                                    <div class="input-group mb-4 mt-4">
                                        <p>Filter berdasarkan bulan:</p>
                                        <select class="form-control mx-2" name="filter_month" id="filter_month">
                                            <option value="0" selected></option>
                                            <option value="1">Januari (1)</option>
                                            <option value="2">Februari (2)</option>
                                            <option value="3">Maret (3)</option>
                                            <option value="4">April (4)</option>
                                            <option value="5">Mei (5)</option>
                                            <option value="6">Juni (6)</option>
                                            <option value="7">Juli (7)</option>
                                            <option value="8">Agustus (8)</option>
                                            <option value="9">September (9)</option>
                                            <option value="10">Oktober (10)</option>
                                            <option value="11">November (11)</option>
                                            <option value="12">Desember (12)</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-warning">Filter</button>
                                        </div>
                                    </div>
                                </form>
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
                                            @if($jadwal->count() > 0)
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
                                                <td colspan="5">Belum ada data</td>
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