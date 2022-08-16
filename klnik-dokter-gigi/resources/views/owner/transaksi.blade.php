@extends('template.master')

@section('title', 'Daftar Transaksi')

@section('content')

                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">
                        
                        <form action="{{route('owner.search.transaksi')}}" method="GET">
                            @method('GET')
                            <label class="sr-only" for="inlineFormInputGroup">Search</label>
                            <div class="input-group mb-4 mt-4">
                                    <input type="text" class="form-control" name="search_transaksi" id="search_transaksi" placeholder="Search">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                                    </div>
                            </div>
                        </form>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
                                @if(Request::input('filter_month') == null)
                                <a href="{{route('owner.cetak.transaksi')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                                @else
                                <a href="{{route('owner.cetak.transaksibymonth',Request::input('filter_month'))}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                                @endif
                            </div>
                            <div class="card-body">
                                <form action="{{route('owner.search.transaksibymonth')}}" method="get">
                                    <div class="input-group mb-4 mt-4">
                                        <p>Filter berdasarkan bulan:</p>
                                        <select class="form-control mx-2" name="filter_month" id="filter_month">
                                            <option value="0" selected></option>
                                            <option value="1">Januari (1)</option>
                                            <option value="2">Februari (2)</option>
                                            <option value="3">Maret (3)</option>
                                            <option value="4">April (4)</option>
                                            <option value="5">Mei (5)</option>
                                            <option value="6">Juni (6)</option>
                                            <option value="7">Juli (7)</option>
                                            <option value="8">Agustus (8)</option>
                                            <option value="9">September (9)</option>
                                            <option value="10">Oktober (10)</option>
                                            <option value="11">November (11)</option>
                                            <option value="12">Desember (12)</option>
                                        </select>
                                        <div class="input-group-append">
                                            <button class="btn btn-warning">Filter</button>
                                        </div>
                                    </div>
                                </form>
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
                                                <td colspan="4">Belum ada data</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if($transaksi->count() > 0)
                                    {!!$transaksi->links('pagination::bootstrap-4')!!}
                                    @endif
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop