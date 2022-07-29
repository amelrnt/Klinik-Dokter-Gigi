@extends('template.master')

@section('title', 'Tambah Jadwal Admin')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tambah Jadwal</h1>
                        <!-- DataTales Example -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form name="inputform" method="POST" action="{{route('admin.store.jadwal')}}" class="mt-5">
                            @csrf
                            {{-- <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <div class="input-group mb-2">
                                    <div class="input-group date" id="datepicker">
                                        <input type="text" class="form-control" placeholder="Tanggal">
                                        <div class="input-group-append">
                                            <div class="input-group-text bg-white" id="calendar"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="mb-3">
                                <label for="hari" class="form-label">Hari</label>
                                <select class="form-control" name="hari" id="hari" aria-describedby="hariHelp">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="waktu" class="form-label">Waktu</label>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <select class="form-control" name="jam" id="jam" aria-describedby="jamHelp">
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                        </select>
                                    </div>
                                    <p id="separator">:</p>
                                    <div class="col-sm-2">
                                        <select class="form-control" name="menit" id="menit" aria-describedby="menitHelp">
                                            <option value="00">00</option>
                                            <option value="15">15</option>
                                            <option value="30">30</option>
                                            <option value="45">45</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama_dokter" class="form-label">Nama Dokter</label>
                                <select class="form-control" name="id_dokter" id="id_dokter" aria-describedby="namaDokterHelp">
                                    @if($dokter != null)
                                        @foreach($dokter as $d)
                                            <option value="{{$d->iddokter}}">{{$d->nama_user}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-outline-danger" href="{{route('admin.jadwaldokter')}}">Batal</a>
                        </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            {{-- <script>
                $('#datepicker').click(function () {
                    $('#datepicker').datepicker()
                });
            </script> --}}
@stop