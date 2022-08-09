
@extends('template.master')

@section('title', 'Daftar Jadwal Checkup')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <form action="{{route('owner.search.jadwaldisetujui')}}" method="GET">
                            @method('GET')
                            <label class="sr-only" for="inlineFormInputGroup">Search</label>
                            <div class="input-group mb-4 mt-4">
                                    <input type="text" class="form-control" name="search_jadwal_disetujui" id="search_jadwal_disetujui" placeholder="Search">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                    </div>
                            </div>
                        </form>

                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Checkup Pasien</h6>
                                @if(Request::input('filter_month') == null)
                                <a href="{{route('owner.cetak.jadwaldisetujui')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                                @else
                                <a href="{{route('owner.cetak.jadwaldisetujuibymonth',Request::input('filter_month'))}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                @if(Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                                @endif
                                <form action="{{route('owner.filter.jadwaldisetujui')}}" method="get">
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
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                              <th>Tanggal</th>
                                              <th>Hari</th>
                                              <th>Jam</th>
                                              <th>Nama Pasien</th>
                                              <th>Nama Dokter</th>
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
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="5">Belum ada data</td>
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