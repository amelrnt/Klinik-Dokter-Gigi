@extends('template.master')

@section('title', 'Kelola Jadwal')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tabel</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Dokter</h6>
                              <a href="{{route('admin.input.jadwal')}}" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
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
                                            @if($jadwal != null)
                                                @foreach ($jadwal as $j)
                                                <tr>
                                                    <td>{{$j->hari}}</td>
                                                    <td>{{$j->jam}}</td>
                                                    <td>{{$j->nama_user}}</td>
                                                    <td>
                                                    <a href="#" data-toggle="modal" data-target="#editModal-{{$j->idjadwal_praktik}}" class="btn btn-success">Edit</a>
                                                    <a href="#" class="btn btn-danger">Hapus</a>
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
                                                                    <form name="editform_{{$j->idjadwal_praktik}}" method="POST" action="#">
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
                                                                                                @if($h == $time[0])
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
                                                                                            @if($m == $time[0])
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
                                                                            <select class="form-control" name="nama_dokter" id="nama_dokter" aria-describedby="namaDokterHelp">
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
                                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
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
                                                <button type="button" class="btn btn-success">Edit</button>
                                                <button type="button" class="btn btn-danger">Hapus</button>
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