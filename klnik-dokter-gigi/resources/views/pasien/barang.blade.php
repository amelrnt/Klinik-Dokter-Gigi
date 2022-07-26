@extends('template.master')

@section('title', 'Checkup Pasien')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tabel</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Riwayat Barang Dibeli</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama Barang</th>
                                                <th>Harga Barang</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal transaksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($barang != null)
                                                @foreach ($barang as $b)
                                                <tr>
                                                    <td>{{$b->nama_barang}}</td>
                                                    <td>{{$b->harga_barang}}</td>
                                                    <td>{{$b->jumlah}}</td>
                                                    <td>{{$b->created_at}}</td>
                                                </tr>
                                                @endforeach
                                            @else:
                                            <tr>
                                                <td>11 Januari 2022</td>
                                                <td>Senin</td>
                                                <td>10.00</td>
                                                <td>Johnny</td>
                                                <td>Hadir</td>
                                                <td>Aktif</td>
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