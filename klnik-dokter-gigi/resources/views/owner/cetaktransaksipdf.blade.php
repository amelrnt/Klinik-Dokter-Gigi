<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Laporan Transaksi PDF (Owner)</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Laporan Transaksi PDF (Owner)</h1>
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
                        <!-- DataTables Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama User</th>
                                                <th>Nama Layanan</th>
                                                <th>Harga Layanan</th>
                                                <th>Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($transaksi->count() > 0)
                                                @foreach ($transaksi as $t)
                                                <tr>
                                                    <td>{{$t->nama_user}}</td>
                                                    <td>{{$t->nama_barang}}</td>
                                                    <td>Rp. {{$t->harga_barang}}</td>
                                                    <td>{{$t->created_at}}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="4">data kosong</td>
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