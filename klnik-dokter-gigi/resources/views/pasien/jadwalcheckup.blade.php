@extends('template.master')

@section('title', 'Checkup Pasien')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tabel</h1>

                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                        @endif
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Jadwal Checkup</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
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
                                            @if($jadwal != null)
                                                @foreach ($jadwal as $j)
                                                <tr>
                                                    <td>{{$j->hari}}</td>
                                                    <td>{{$j->jam}}</td>
                                                    <td>{{$j->nama_user}}</td>
                                                    <td>
                                                        <a 
                                                            href="javascript:void(0)" 
                                                            id="jadwal" 
                                                            data-url="{{ route('pasien.get.jadwal', $j->idjadwal_praktik ) }}" 
                                                            class="btn btn-success">Daftar</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else:
                                            <tr>
                                                <td>Data Kosong</td>
                                                <td></td>
                                                <td></td>
                                                <td><a href="#" class="btn btn-success">Daftar</a></td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- /.container-fluid -->
                <div class="modal fade" id="modals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Input Detail Checkup</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form id="editform" name="editform" method="POST" action="#">
                                        @csrf
                                        <input type="text" class="form-control" name="hari" id="hari" aria-describedby="hariHelp" value="" hidden>
                                        <input type="text" class="form-control" name="jam" id="jam" aria-describedby="jamHelp" value="" hidden>
                                        <input type="number" class="form-control" name="id_dokter" id="id_dokter" aria-describedby="namaUserHelp" value="" hidden>
                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group date" id="datepicker">
                                                    <input type="text" name="tanggal" id="tanggal" class="form-control" placeholder="Tanggal">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text bg-white" id="calendar"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <input type="text" class="form-control" name="keterangan" id="keterangan" aria-describedby="keteranganHelp">
                                        </div>
                                        <button type="submit" id="simpan" class="btn btn-primary">Simpan</button>
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <!-- End of Main Content -->
            <script type="text/javascript">
                

                $(document).ready(function () {
                    /* When click show user */
                    $('body').on('click', '#jadwal', function () {

                    var userURL = $(this).data('url');
                    $.get(userURL, function (data) {

                        console.log(data);

                        $('#modals').modal('show');
                        $('#editform').prop('action',"/pasien/storejadwal/"+data.idjadwal_praktik);


                        $('#id_dokter').prop('name','id_dokter_'+data.idjadwal_praktik);
                        $('#hari').prop('name','hari_'+data.idjadwal_praktik);
                        $('#jam').prop('name','jam_'+data.idjadwal_praktik);

                        $('#hari').prop('value', data.hari);
                        $('#jam').prop('value', data.jam);
                        $('#id_dokter').prop('value', data.iduser);

                        $('#tanggal').prop('name','tanggal_'+data.idjadwal_praktik);
                        $('#keterangan').prop('name','keterangan_'+data.idjadwal_praktik);

                        console.log($('#tanggal').attr('name'));
                        
                        
                        $('#datepicker').click(function () {
                            $('#datepicker').datepicker()
                        });
                        
                    })

                    });
                });



            </script>
@stop