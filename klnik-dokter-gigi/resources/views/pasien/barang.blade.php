@extends('template.master')

@section('title', 'Riwayat Barang Pasien')

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
                                @if(Session::has('message'))
                                    <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                                @endif
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Tanggal transaksi</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah Barang</th>
                                                <th>Keterangan</th>
                                                <th>Nama Dokter</th>
                                                <th>Jumlah Pembayaran Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($riwayat != null)
                                                @foreach ($riwayat as $r)
                                                <tr>
                                                    <td>{{$r->tanggal}}</td>
                                                    <td>{{$r->nama_barang}}</td>
                                                    <td>{{$r->jumlah}}</td>
                                                    <td>{{$r->keterangan}}</td>
                                                    <td>{{$r->dokter}}</td>
                                                    <td>{{$r->total_harga}}</td>                                                </tr>
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