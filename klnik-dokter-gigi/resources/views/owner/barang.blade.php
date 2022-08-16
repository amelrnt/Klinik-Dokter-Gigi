@extends('template.master')

@section('title', 'Daftar Barang')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">
                    
                        <form action="{{route('owner.search.barang')}}" method="GET">
                            @method('GET')
                            <label class="sr-only" for="inlineFormInputGroup">Search</label>
                            <div class="input-group mb-4 mt-4">
                                    <input type="text" class="form-control" name="search_barang" id="search_barang" placeholder="Search">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                    </div>
                            </div>
                        </form>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Barang</h6>
                                <a href="{{route('owner.cetak.barang')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
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
                                            @if($barang->count() > 0)
                                                @foreach ($barang as $b)
                                                <tr>
                                                    <td>{{$b->nama_barang}}</td>
                                                    <td>Rp. {{$b->harga_barang}}</td>
                                                    <td>{{$b->stok_barang}}</td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="3">Belum ada data</td>
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