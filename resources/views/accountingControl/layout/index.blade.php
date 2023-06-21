@extends('accountingControl.layout.css')

@section('mainBody')
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <div id="topNav"></div>
            <div id="topNavBar"></div>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Messages Dropdown Menu -->
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-light-danger elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
            <img src="{{ url('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: .8">
            <span class="brand-text font-weight-light">Accounting</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="{{ url('dist/img/avatarHijab.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ session('namaPengisi') }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                       with font-awesome or any other icon font library -->
                    <li class="nav-item" id="revisiTabMenu">
                        <a href="#" class="nav-link" id="revisiSubMenu">
                            <i class="nav-icon fas fa-hourglass-half"></i>
                            <p>
                                Revisi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('accounting/revisi/so') }}" class="nav-link" id="soTabMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>SO Harian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/revisi/sales') }}" class="nav-link" id="salesTabMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sales Harian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/revisi/pattyCash') }}" class="nav-link" id="pattyCashTabMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Patty Cash</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/revisi/waste') }}" class="nav-link" id="wasteTabMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Waste</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" id="itemTabMenu">
                        <a href="#" class="nav-link" id="itemSubMenu">
                            <i class="nav-icon 	fas fa-bread-slice"></i>
                            <p>
                                Set Item
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('accounting/so/item') }}" class="nav-link" id="soSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>SO Harian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/sales/item') }}" class="nav-link" id="salesSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Sales Harian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/pattyCash/item') }}" class="nav-link" id="pattyCashSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Patty Cash</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/waste/item') }}" class="nav-link" id="wasteSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Waste</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/satuan') }}" class="nav-link" id="satuanSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Satuan</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item" id="robotTabMenu">
                        <a href="#" class="nav-link" id="robotSubMenu">
                            <i class="nav-icon 	fas fa-robot"></i>
                            <p>
                                Bee Cloud Robot
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/pembelian') }}" class="nav-link" id="pembelianRobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pembelian</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/pembayaran') }}" class="nav-link" id="pembayaranRobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pembayaran</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/ecommerce') }}" class="nav-link" id="eCommerceRobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>E-Commerce</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/mutasi455TfKas') }}" class="nav-link" id="mutasi455TfKasRobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mutasi 455 (Transfer Kas)</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/mutasi455TfKasSukodono') }}" class="nav-link" id="mutasi455TfKasSukodonoRobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>455 Sukodono (Tf Kas)</p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/mutasi455Pembayaran') }}" class="nav-link" id="mutasi455PembayaranRobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>455 Pembayaran</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/mutasi1003Setoran') }}" class="nav-link" id="mutasi1003SetoranRobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>1003 Setoran</p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/mutasi165reimburse') }}" class="nav-link" id="reimburse165RobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Reimburse 165</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/pindahSaldo165') }}" class="nav-link" id="pindahSaldo165RobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pindah Saldo 165</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/robot/pembayaran165') }}" class="nav-link" id="pembayaran165RobotSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pembayaran 165</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('accounting/checkExist') }}" class="nav-link" id="checkExistTabMenu">
                            <i class="nav-icon fas fa-pen-square"></i>
                            <p class="text">Status Input</p>
                        </a>
                    </li>
                    <li class="nav-item" id="mutasiTabMenu">
                        <a href="#" class="nav-link" id="mutasiSubMenu">
                            <i class="nav-icon 	fa fa-hdd-o"></i>
                            <p>
                                Proses Mutasi
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('accounting/mutasiProcess/upload') }}" class="nav-link" id="uploadMutasiSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Upload Mutasi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('accounting/mutasiProcess/mutasiKlasifikasi') }}" class="nav-link" id="mutasiKlasifikasiSubMenu">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Mutasi Klasifikasi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ url('accounting/mutasiProcess') }}" class="nav-link" id="mutasiProsesTabMenu">
                            <i class="nav-icon 	fa fa-hdd-o"></i>
                            <p class="text">Proses Mutasi</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ url('accounting/pattyCash') }}" class="nav-link" id="pattyCashsTabMenu">
                            <i class="nav-icon fa fa-credit-card"></i>
                            <p class="text">Patty Cash</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('accounting/saldoPattyCash') }}" class="nav-link" id="saldoPattyCashsTabMenu">
                            <i class="nav-icon fa fa-credit-card"></i>
                            <p class="text">Saldo Patty Cash</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('accounting/reimburse') }}" class="nav-link" id="reimburseTabMenu">
                            <i class="nav-icon fas fa-money-check-alt"></i>
                            <p class="text">Reimburse</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('accounting/setoran') }}" class="nav-link" id="setoransTabMenu">
                            <i class="nav-icon fas fa-cash-register"></i>
                            <p class="text">Setoran Tunai</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('accounting/verifikasi') }}" class="nav-link" id="verifikasiSalesTabMenu">
                            <i class="nav-icon fa fa-check"></i>
                            <p class="text">Verifikasi Sales</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('accounting/laporanSales') }}" class="nav-link" id="laporanSalesTabMenu">
                            <i class="nav-icon fas fa-dollar-sign"></i>
                            <p class="text">Laporan Sales</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('accounting/stockOpname') }}" class="nav-link" id="stockOpnameTabMenu">
                            <i class="nav-icon fas fa-box-open"></i>
                            <p class="text">Stock Opname</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('accounting/waste') }}" class="nav-link" id="wasteReportTabMenu">
                            <i class="nav-icon fas fa-trash-alt"></i>
                            <p class="text">Waste</p>
                        </a>
                    </li>
                    <li class="nav-header">USER</li>
                    <li class="nav-item">
                        <a href="{{ url('user/logout') }}" class="nav-link">
                            <i class="nav-icon fa fa-sign-out text-danger"></i>
                            <p class="text">Log Out</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0" id="tittleContent"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#" id="linkContent"></a></li>
                            <li class="breadcrumb-item active" id="subFillContent"></li>

                            
                            <li class="breadcrumb-item"><a href="#" id="tittleFillContent"></a></li>
                            <li class="breadcrumb-item active" id="subFillContent"></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @yield('fillBody')
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
@endsection
