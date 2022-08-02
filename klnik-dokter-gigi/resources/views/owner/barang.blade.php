@extends('template.master')

@section('title', 'Daftar Barang')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tabel</h1>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    @if(Session::has('message'))
                                        <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
                                    @endif
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama barang</th>
                                                <th>Harga</th>
                                                <th>Stok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($barang != null)
                                                @foreach ($barang as $b)
                                                <tr>
                                                    <td>{{$b->nama_barang}}</td>
                                                    <td>Rp. {{$b->harga_barang}}</td>
                                                    <td>{{$b->stok_barang}}</td>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td>data kosong</td>
                                                <td> </td>
                                                <td> </td>
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