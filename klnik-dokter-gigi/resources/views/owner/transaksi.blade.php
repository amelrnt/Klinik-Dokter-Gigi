@extends('template.master')

@section('title', 'Daftar Transaksi')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tabel</h1>
                        <!-- DataTales Example -->
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
                                            @if($transaksi != null)
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