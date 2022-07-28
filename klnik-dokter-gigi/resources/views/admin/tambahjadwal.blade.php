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

                        <form name="inputform" method="POST" action="#" class="mt-5">
                            @csrf
                            <div class="mb-3">
                                <label for="hari" class="form-label">Hari</label>
                                <select class="form-control" name="hari" id="hari" aria-describedby="hariHelp">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga_barang" class="form-label">Jam</label>
                                <div class="input-group date" id="jam_group">
                                    <input type='text' name="jam" id="jam" class="form-control" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
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