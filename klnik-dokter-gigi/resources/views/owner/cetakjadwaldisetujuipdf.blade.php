<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Daftar Jadwal Checkup Pasien PDF (Owner)</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" href="data:image/png;base64,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">
        
</head>
<body>
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Laporan Daftar Jadwal Checkup Pasien PDF (Owner)</h1>

                        @if($month == '0')
                            <h6>Seluruh bulan</h6>
                        @else
                            @if($month == '1')
                                <h6>Bulan : Januari</h6>
                            @elseif($month == '2')
                                <h6>Bulan : Februari</h6>
                            @elseif($month == '3')
                                <h6>Bulan : Maret</h6>
                            @elseif($month == '4')
                                <h6>Bulan : April</h6>
                            @elseif($month == '5')
                                <h6>Bulan : Mei</h6>
                            @elseif($month == '6')
                                <h6>Bulan : Juni</h6>
                            @elseif($month == '7')
                                <h6>Bulan : Juli</h6>
                            @elseif($month == '8')
                                <h6>Bulan : Agustus</h6>
                            @elseif($month == '9')
                                <h6>Bulan : September</h6>
                            @elseif($month == '10')
                                <h6>Bulan : Oktober</h6>
                            @elseif($month == '11')
                                <h6>Bulan : November</h6>
                            @elseif($month == '12')
                                <h6>Bulan : Desember</h6>
                            @endif
                        @endif
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Jadwal Checkup Pasien</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
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
                                                <td colspan="5">data kosong</td>
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

            @if(Session::get('iduser') != null)
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Dokter Hitz 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

@endif

</body>

</html>