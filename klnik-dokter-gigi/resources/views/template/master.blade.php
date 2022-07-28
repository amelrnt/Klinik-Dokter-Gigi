<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Custom fonts for this template-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{asset('/icon/medical-team.png')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- Bootstrap core JavaScript-->
    <script src={{asset("jquery/jquery.min.js")}}></script>
    <script src={{asset("bootstrap/js/bootstrap.bundle.min.js")}}></script>

    <!-- Core plugin JavaScript-->
    <script src={{asset("jquery-easing/jquery.easing.min.js")}}></script>

    <!-- Custom scripts for all pages-->
    <script src={{asset("js/sb-admin-2.min.js")}}></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- Custom styles for this template-->
    <link href={{asset("css/sb-admin-2.min.css")}} rel="stylesheet">

</head>

@if(Session::get('iduser') != null)
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            @if(Session::get('level') == 'dokter')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('dokter.index')}}">
            @elseif(Session::get('level') == 'pasien')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('pasien.index')}}">
            @elseif(Session::get('level') == 'admin')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.index')}}">
            @elseif(Session::get('level') == 'pemilik')
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('owner.index')}}">        
            @endif
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">{{Session::get('nama_user')}}</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                @if(Session::get('level') == 'dokter')
                <a class="nav-link" href="{{route('dokter.index')}}">
                @elseif(Session::get('level') == 'pasien')
                <a class="nav-link" href="{{route('pasien.index')}}">
                @elseif(Session::get('level') == 'admin')
                <a class="nav-link" href="{{route('admin.index')}}">
                @elseif(Session::get('level') == 'pemilik')
                <a class="nav-link" href="{{route('owner.index')}}">
                @endif
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Sidebar
            </div>
            @if(Session::get('level') == 'pasien')
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Checkup</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Checkup Screens</h6>
                        <a class="collapse-item" href="{{route('list.jadwal')}}">Cek Jadwal</a>
                        <a class="collapse-item" href="{{route('list.riwayat')}}">Riwayat</a>
                    </div>
                </div>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="{{route('list.barang')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Riwayat Barang</span></a>
            </li>
            @elseif(Session::get('level') == 'dokter')

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="{{route('dokter.jadwal')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Jadwal Checkup</span></a>
            </li>

            @elseif(Session::get('level') == 'admin')

            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.barang')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kelola Barang</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.verif')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Assign User</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.jadwal')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Setujui Jadwal</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.jadwaldokter')}}">  
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kelola Jadwal Dokter</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.transaksi')}}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Transaksi</span></a>
            </li>
            @elseif(Session::get('level') == 'pemilik')

            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kelola Barang</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kelola Jadwal Dokter</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Penjadwalan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Data Transaksi</span></a>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Session::get('nama_user')}}</span>
                                <i class="fa-solid fa-user"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{route('profile')}}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
@endif
            @yield('content')

@if(Session::get('iduser') != null)
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endif

</body>

</html>