@extends('template.master')

@section('title', 'Kelola Jadwal')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">
                    
                    <form action="{{route('admin.search.jadwaldokter')}}" method="GET">
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
                                <a href="{{route('admin.input.jadwal')}}" class="btn btn-primary">Tambah Data</a>
                                <a href="{{route('admin.cetak.jadwaldokter')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
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
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($jadwal[0]->nama_user != null)
                                                @foreach ($jadwal as $j)
                                                <tr>
                                                    <td>{{$j->hari}}</td>
                                                    <td>{{$j->jam}}</td>
                                                    <td>{{$j->nama_user}}</td>
                                                    <td>
                                                    <a href="#" data-toggle="modal" data-target="#editModal-{{$j->idjadwal_praktik}}" class="btn btn-success">Edit</a>
                                                    </td>
                                                </tr>
                                                <!-- Edit Modal-->
                                                <div class="modal fade" id="editModal-{{$j->idjadwal_praktik}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit jadwal ({{$j->nama_user}})</h5>
                                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form name="editform_{{$j->idjadwal_praktik}}" method="POST" action="{{route('admin.update.jadwal',$j->idjadwal_praktik)}}">
                                                                        @method('PUT')
                                                                        @csrf
                                                                        <input type="text" class="form-control" name="id_barang" id="id_barang" aria-describedby="idJadwalPraktikHelp" value="{{$j->idjadwal_praktik}}" hidden>
                                                                        <div class="mb-3">
                                                                            <label for="hari" class="form-label">Hari</label>
                                                                            <select name="hari_{{$j->idjadwal_praktik}}" id="hari" class="form-control" aria-describedby="hariHelp">
                                                                                @if($days != null)
                                                                                    @foreach($days as $dy)
                                                                                        @if($dy == $j->hari)
                                                                                            <option value="{{$dy}}" selected>{{$dy}}</option>
                                                                                        @else
                                                                                            <option value="{{$dy}}">{{$dy}}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                        @php
                                                                            $time = explode(':',$j->jam);
                                                                        @endphp
                                                                        <div class="mb-3">
                                                                            <div class="row">
                                                                                <div class="col-sm-3">
                                                                                    <select class="form-control" name="jam_{{$j->idjadwal_praktik}}" id="jam" aria-describedby="jamHelp">
                                                                                        @if($hours != null)
                                                                                            @foreach($hours as $h)
                                                                                                @if($time[0]==$h)
                                                                                                    <option value="{{$h}}" selected>{{$h}}</option>
                                                                                                @else
                                                                                                    <option value="{{$h}}">{{$h}}</option>
                                                                                                @endif
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                                <p id="separator">:</p>
                                                                                <div class="col-sm-3">
                                                                                    <select class="form-control" name="menit_{{$j->idjadwal_praktik}}" id="menit" aria-describedby="menitHelp">
                                                                                        @if($minutes != null)
                                                                                            @foreach($minutes as $m)
                                                                                            @if($time[1]==$m)
                                                                                                <option value="{{$m}}" selected>{{$m}}</option>
                                                                                            @else
                                                                                                <option value="{{$m}}">{{$m}}</option>
                                                                                            @endif
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mb-3">
                                                                            <label for="nama_dokter" class="form-label">Nama Dokter</label>
                                                                            <select class="form-control" name="nama_dokter_{{$j->idjadwal_praktik}}" id="nama_dokter" aria-describedby="namaDokterHelp">
                                                                                @if($dokter != null)
                                                                                    @foreach($dokter as $d)
                                                                                        @if($d->iddokter == $j->dokter_iddokter)
                                                                                            <option value="{{$j->dokter_iddokter}}" selected>{{$j->nama_user}}</option>
                                                                                        @else
                                                                                            <option value="{{$d->iddokter}}">{{$d->nama_user}}</option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                        <a class="btn btn-secondary" href="#" data-dismiss="modal">Batal</a>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td>data kosong</td>
                                                <td> </td>
                                                <td> </td>
                                                <td>
                                                <a type="button" class="btn btn-success">Edit</a>
                                                <a type="button" class="btn btn-danger">Hapus</a>
                                                </td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if($jadwal != null)
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