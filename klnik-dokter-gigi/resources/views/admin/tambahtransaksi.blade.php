@extends('template.master')

@section('title', 'Tambah Transaksi Admin')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Tambah Transaksi</h1>
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

                        <form name="editform" method="POST" action="{{route('admin.transaksi.fix',$jadwal->idpraktik_dijadwalkan)}}" class="mt-5">
                            @csrf
                            <input type="text" name="pasien_idpasien" value="{{$jadwal->pasien_idpasien}}" hidden>
                            <input type="text" name="idpraktik_dijadwalkan" value="{{$jadwal->idpraktik_dijadwalkan}}" hidden>
                            <div class="mb-3">
                                <label for="nama_user" class="form-label">Metode Pembayaran</label>
                                <select class="form-control" name="metode_pembayaran" id="metode_pembayaran" aria-describedby="metodePembayaranHelp">
                                    <option value="cash">Cash</option>
                                    <option value="transfer">Transfer</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <select class="form-control" name="barang" id="barang" aria-describedby="namaBarangHelp">
                                    @if($barang != null)
                                        @foreach($barang as $b)
                                            <option value="{{$b->idbarang}}">{{$b->nama_barang}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga_barang" class="form-label">Harga Layanan</label>
                                <input type="number" class="form-control" name="harga_barang" id="harga_barang" aria-describedby="hargaBarangHelp" value="">
                            </div>
                            <div class="mb-3">
                                <label for="harga_barang" class="form-label">Jumlah Barang</label>
                                <input type="number" class="form-control" name="jumlah_barang" id="jumlah_barang" aria-describedby="jumlahBarangHelp" value="">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a class="btn btn-outline-danger" href="">Batal</a>
                        </form>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop