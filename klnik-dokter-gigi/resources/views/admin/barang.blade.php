@extends('template.master')

@section('title', 'Kelola Barang')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">

                    <div class="col-auto">
                        
                        <form action="{{route('admin.search.barang')}}" method="GET">
                            @method('GET')
                            <label class="sr-only" for="inlineFormInputGroup">Search</label>
                            <div class="input-group mb-4 mt-4">
                                    <input type="text" class="form-control" name="search_barang" id="search_barang" placeholder="Search">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                    </div>
                            </div>
                        </form>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
                                <a href="{{route('admin.tambah.barang')}}" class="btn btn-primary">Tambah Data</a>
                                <a href="{{route('admin.cetak.barang')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
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
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($barang->count() > 0)
                                                @foreach ($barang as $b)
                                                <tr>
                                                    <td>{{$b->nama_barang}}</td>
                                                    <td>Rp. {{$b->harga_barang}}</td>
                                                    <td>{{$b->stok_barang}}</td>
                                                    <td>
                                                    <a href="#" data-toggle="modal" data-target="#editModal-{{$b->idbarang}}" class="btn btn-success">Edit</a>
                                                    {{-- <a href="#" data-toggle="modal" data-target="#deleteModal-{{$b->idbarang}}" class="btn btn-danger">Hapus</a> --}}
                                                    </td>
                                                </tr>
                                                <!-- Edit Modal-->
                                                <div class="modal fade" id="editModal-{{$b->idbarang}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit barang ({{$b->nama_barang}})</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form name="editform_{{$b->idbarang}}" method="POST" action="{{route('admin.update.barang',$b->idbarang)}}">
                                                                    @method('PUT')
                                                                    @csrf
                                                                    <input type="text" class="form-control" name="id_barang" id="id_barang" aria-describedby="idBarangHelp" value="{{$b->idbarang}}" hidden>
                                                                    <div class="mb-3">
                                                                        <label for="nama_barang" class="form-label">Nama Barang</label>
                                                                        <input type="text" class="form-control" name="nama_barang_{{$b->idbarang}}" id="nama_barang" aria-describedby="namaBarangHelp" value="{{$b->nama_barang}}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="harga_barang" class="form-label">Harga Barang</label>
                                                                        <input type="number" class="form-control" name="harga_barang_{{$b->idbarang}}" id="harga_barang" aria-describedby="hargaBarangHelp" value="{{$b->harga_barang}}">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label for="stok_barang" class="form-label">Stok Barang</label>
                                                                        <input type="number" class="form-control" name="stok_barang_{{$b->idbarang}}" id="stok_barang" aria-describedby="stokBarangpHelp" value="{{$b->stok_barang}}">
                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- Delete modal --}}
                                                <div class="modal fade" id="deleteModal-{{$b->idbarang}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Yakin hapus barang? ({{$b->nama_barang}})</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form name="deleteform_{{$b->idbarang}}" method="POST" action="{{route('admin.delete.barang',$b->idbarang)}}">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-primary">Hapus</button>
                                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="4">Belum ada data</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if($barang->count() > 0)
                                        {!!$barang->links('pagination::bootstrap-4')!!}
                                    @endif
                                </div>
                            </div>
                        </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop