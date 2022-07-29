@extends('template.master')

@section('title', 'Input Detail Checkup Pasien')

@section('content')
                
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Input Detail Checkup</h1>
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

                    <form id="editform" method="POST" name="inputform" action="/pasien/storejadwal">
                        @csrf
                        @if($jadwal != null)
                        <input type="text" class="form-control" name="idjadwal_praktik" id="idjadwal_praktik" aria-describedby="hariHelp" value="{{$jadwal->idjadwal_praktik}}" hidden>
                        <input type="number" class="form-control" name="id_dokter" id="id_dokter" aria-describedby="idDokterHelp" value="{{$jadwal->iddokter}}" hidden>
                        @endif
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
                            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" aria-describedby="keteranganHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{route('list.jadwal')}}" class="btn btn-secondary" type="button">Batal</a>
                    </form>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <script>
            $('#datepicker').click(function () {
                $('#datepicker').datepicker();
            });
        </script>
@stop