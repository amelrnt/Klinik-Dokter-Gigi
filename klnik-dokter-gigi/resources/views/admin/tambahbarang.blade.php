@extends('template.master')

@section('title', 'Tambah Barang Admin')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tambah Barang</h1>
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

                        <form name="editform" method="POST" action="/admin/storebarang" class="mt-5">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" id="nama_barang" aria-describedby="namaBarangHelp" value="">
                            </div>
                            <div class="mb-3">
                                <label for="harga_barang" class="form-label">Harga Barang</label>
                                <input type="number" class="form-control" name="harga_barang" id="harga_barang" aria-describedby="hargaBarangHelp" value="">
                            </div>
                            <div class="mb-3">
                                <label for="stok_barang" class="form-label">Stok Barang</label>
                                <input type="number" class="form-control" name="stok_barang" id="stok_barang" aria-describedby="stokBarangpHelp" value="">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-outline-danger" href="{{route('admin.barang')}}">Batal</a>
                        </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop