<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('admin/item/so') }}" class="nav-link">SO Harian</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('admin/item/sales') }}" class="nav-link">Sales Harian</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('admin/item/pattyCash') }}" class="nav-link">Patty Cash</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Waste</a>
                </li>
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
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon 	fas fa-bread-slice"></i>
                                <p>
                                    Item
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('admin/item/so') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>SO Harian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/item/sales') }}" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales Harian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/item/pattyCash') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Patty Cash</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Waste</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Satuan</p>
                                    </a>
                                </li>
                            </ul>
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
                            <h1 class="m-0">Set Item</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Set Item</a></li>
                                <li class="breadcrumb-item active">SO</li>
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
                                <div class="card-header border-0">
                                    <div class="d-flex justify-content-left">

                                    </div>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="form-group col-sm-3">
                                                <input type="text" class="form-control" id="tambahTypeSales"
                                                    placeholder="Nama Type">
                                            </div>
                                            <div class="form-group">
                                                <button type="button" onclick="sendAddType()"
                                                    class="btn btn-secondary">Submit</button>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="addItemSalesOnType"
                                                    placeholder="Nama Item">
                                            </div>
                                            <div class="form-group col-sm-2">
                                                <select class="form-control" id="selType">
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" onclick="sendAddItem()"
                                                    class="btn btn-secondary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                    <table class="table table-striped" id="tableAllItem">
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Sales</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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

    <script>
        $(document).ready(function() {
            getListAllType();
            getListAllItem();
            // showOutlet();
            // getAllItem();
        })

        function getListAllType() {
            $.ajax({
                url: "{{ url('typeSales/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var type = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.typeSales.length; i++) {
                        type += obj.typeSales[i].type + ' | ';

                        dataDropdown += '<option value=';
                        dataDropdown += obj.typeSales[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.typeSales[i].type;
                        dataDropdown += '</option>';
                    }
                    $('#selType').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getListAllItem() {
            $.ajax({
                url: "{{ url('typeSales/show/item/eachtype') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    console.log(obj);
                    var indexTable =0;
                    for (var i = 0; i < obj.listType.length; i++) {
                        for (var j = 0; j < obj.listType[i].listSales.length; j++) {
                            dataTable += '<tr>';
                            dataTable += '<td>';
                            dataTable += obj.listType[i].type;
                            dataTable += '</td>';
                            dataTable += '<td>';
                            dataTable += obj.listType[i].listSales[j].sales;
                            dataTable += '</td>';
                            dataTable +=
                                '<td><a href="#deleteEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" id="a' +
                                indexTable +
                                '">&#xE254;</i></a>';
                            dataTable += '<td>';
                            dataTable += '</tr>';
                            indexTable++;
                        }
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function sendAddItem() {
            $.ajax({
                url: "{{ url('typeSales/item/store') }}",
                type: 'get',
                data: {
                    idType: $('#selType').val(),
                    NamaItem: document.getElementById('addItemSalesOnType').value,
                },
                success: function(response) {
                    setType();
                    document.getElementById('addItemSalesOnType').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })

        }

        function sendAddType() {
            $.ajax({
                url: "{{ url('typeSales/store') }}",
                type: 'get',
                data: {
                    NamaType: document.getElementById('tambahTypeSales').value,
                },
                success: function(response) {
                    getListAllType();
                    document.getElementById('tambahTypeSales').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ url('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ url('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE -->
    <script src="{{ url('dist/js/adminlte.js') }}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{ url('plugins/chart.js/Chart.min.js') }}"></script>
</body>

</html>
