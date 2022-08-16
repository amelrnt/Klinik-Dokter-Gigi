@extends('template.master')

@section('title', 'Riwayat Barang Pasien')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid d-flex flex-column min-vh-100">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Riwayat Barang Dibeli</h6>
                                @if(Request::input('filter_month') == null)
                                <a href="{{route('pasien.cetak.barang')}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                                @else
                                <a href="{{route('pasien.cetak.barangbymonth',Request::input('filter_month'))}}" target="_blank" class="btn btn-info"><i class="fas fa-file"></i> Cetak PDF</a>
                                @endif
                            </div>
                            <div class="card-body">
                            <form action="{{route('pasien.filter.barangbymonth')}}" method="get">
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
                                            @if($riwayat->count() > 0)
                                                @foreach ($riwayat as $r)
                                                <tr>
                                                    <td>{{$r->created_at}}</td>
                                                    <td>{{$r->nama_barang}}</td>
                                                    <td>{{$r->jumlah}}</td>
                                                    <td>{{$r->keterangan}}</td>
                                                    <td>{{$r->dokter}}</td>
                                                    <td>{{$r->total_harga}}</td>                                                
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="6">Belum ada transaksi</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    @if($riwayat != null)
                                        {!!$riwayat->links('pagination::bootstrap-4')!!}
                                    @endif
                                </div>
                            </div>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

@stop