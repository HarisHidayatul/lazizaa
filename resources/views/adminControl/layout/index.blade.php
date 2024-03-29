@extends('adminControl.layout.css')

@section('mainBody')
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            {{-- navbar yang terdapat di atas --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
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
            <a href="index3.html" class="brand-link">
                <img src="{{ url('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ url('dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image">
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
                                    <a href="{{ url('admin/so/item') }}" class="nav-link" id="soSubMenu">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>SO Harian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/sales/item') }}" class="nav-link" id="salesSubMenu">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales Harian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/pattyCash/item') }}" class="nav-link" id="pattyCashSubMenu">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Patty Cash</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/waste/item') }}" class="nav-link" id="wasteSubMenu">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Waste</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/satuan') }}" class="nav-link" id="satuanSubMenu">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Satuan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item" id="commonTabMenu">
                            <a href="#" class="nav-link" id="commonSubMenu">
                                <i class="nav-icon 	fa fa-user"></i>
                                <p>
                                    Set User
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/common/brand') }}" class="nav-link" id="brandSubMenu">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Brand</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/common/outlet') }}" class="nav-link" id="outletSubMenu">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Outlet</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/common/user') }}" class="nav-link" id="userSubMenu">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/setBank') }}" class="nav-link" id="setBankSubMenu">
                                <i class="nav-icon fa fa-bank"></i>
                                <p class="text">Set Bank</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/setoran') }}" class="nav-link" id="setoranSubMenu">
                                <i class="nav-icon fas fa-cash-register"></i>
                                <p class="text">Penerima Setoran</p>
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
                                    {{-- <div>asfdas</div> --}}
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
@endsection
