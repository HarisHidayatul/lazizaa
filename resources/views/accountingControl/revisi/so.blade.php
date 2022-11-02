<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accounting</title>

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
                    <a href="#" class="nav-link">SO Harian</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ url('accounting/revisi/sales') }}" class="nav-link">Sales Harian</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Patty Cash</a>
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
            <a href="#" class="brand-link">
                <img src="{{ url('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Accounting</span>
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
                                <i class="nav-icon fas fa-hourglass-half"></i>
                                <p>
                                    Revisi
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>SO Harian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('accounting/revisi/sales') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sales Harian</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('accounting/revisi/pattyCash') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Patty Cash</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./index3.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Waste</p>
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
                            <h1 class="m-0">Revisi</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Revisi</a></li>
                                <li class="breadcrumb-item active">So Harian</li>
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
                                        <a onclick="setTable(0)" style="cursor: pointer">To Do (</a>
                                        <div id="toDoCountSo"></div>
                                        <a>)/</a>
                                        <a onclick="setTable(1)" style="cursor: pointer">Done (</a>
                                        <div id="doneCountSo"></div>
                                        <a>)</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="setTable"></div>
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

    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Revisi Data </h4>
                        <h4 class="modal-title" id="editTanggal"></h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4 id="editItem"></h4>
                        <div class="input-group">
                            <input type="number" id="editQty" class="form-control" placeholder="0">
                            <div class="input-group-append">
                                <span class="input-group-text" id="satuan"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-info" value="Submit" onclick="submitRevSo()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        var dataAllSo = []; //format : Tanggal, idRev, qty, Item, Satuan, IdSoFill
        var clickLastEditSo = 0;
        $(document).on("click", "[id^=a]", function(event, ui) {
            //function for edit (when clicked)
            var idClickEdit = this.id.substring(1);
            clickLastEditSo = idClickEdit;
            // console.log(dataAllSo);
            document.getElementById('editTanggal').innerHTML = dataAllSo[idClickEdit][0];
            document.getElementById('editQty').value = dataAllSo[idClickEdit][2];
            document.getElementById('editItem').innerHTML = dataAllSo[idClickEdit][3];
            document.getElementById('satuan').innerHTML = dataAllSo[idClickEdit][4];

        })
        $(document).ready(function() {
            setTable(0);
            showAllRevisionSo();
            showAllRevisionDoneSo();
        });

        function setTable(index) {
            if (index == 0) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTableSo">' +
                    '<thead><tr><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Item SO</th><th scope="col">' +
                    'Nilai</th><th scope="col">Satuan</th><th scope="col">Pengisi</th>' +
                    '<th scope="col">Action</th></tr></thead><tbody></tbody></table>';
                showAllRevisionSo();
            } else if (index == 1) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTableSoDone">' +
                    '<thead><tr><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Item SO</th><th scope="col">' +
                    'Nilai</th><th scope="col">Satuan</th><th scope="col">Pengisi</th>' +
                    '<th scope="col">Perevisi</th></tr></thead><tbody></tbody></table>';
                showAllRevisionDoneSo();
            }

        }

        function submitRevSo() {
            $('#editEmployeeModal').modal('hide');
            var qty = document.getElementById('editQty').value;
            if (dataAllSo[clickLastEditSo][1] == '2') {
                console.log(dataAllSo);
                $.ajax({
                    url: "{{ url('soHarian/edit/qty/rev/data') }}",
                    type: 'get',
                    data: {
                        qty: qty,
                        idPerevisi: "{{ session('idPengisi') }}",
                        idSoFill: dataAllSo[clickLastEditSo][5],
                    },
                    success: function(response) {
                        // console.log(response);
                        clearRevSo();
                    },
                    error: function(req, err) {
                        console.log(err);
                        // return 0
                    }
                });
            }
        }

        function clearRevSo() {
            // $('#mainTableSo>tbody').empty();
            showAllRevisionSo();
            showAllRevisionDoneSo();
        }

        function refreshTableRevSo(obj) {
            var dataTable = '';
            var countData = 0;
            dataAllSo.length = 0;
            for (var i = 0; i < obj?.itemSo?.length; i++) {
                for (var j = 0; j < obj.itemSo[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemSo[i].Item[j].Item.length; k++) {
                        var tempData = [];
                        countData++;
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Tanggal.split("-").reverse().join("/");
                        tempData.push(obj.itemSo[i].Tanggal.split("-").reverse().join("/"));
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Outlet;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].Item;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemSo[i].Item[j].Item[k].idRev == '2') {
                            dataTable += 'style="background-color:tomato;" ';
                        } else if (obj.itemSo[i].Item[j].Item[k].idRev == '3') {
                            dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemSo[i].Item[j].Item[k].qty;
                        tempData.push(obj.itemSo[i].Item[j].Item[k].idRev);
                        tempData.push(obj.itemSo[i].Item[j].Item[k].qty);
                        tempData.push(obj.itemSo[i].Item[j].Item[k].Item);
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        dataTable +=
                            '<td><a  onclick="showEdit()" class="delete" data-toggle="modal" style="cursor: pointer"><i class="material-icons" data-toggle="tooltip" title="Accept" id="a' +
                            (countData - 1) + '">&#xE254;</i></a></td>';
                        dataTable += '</tr>';
                        tempData.push(obj.itemSo[i].Item[j].Item[k].satuan);
                        tempData.push(obj.itemSo[i].Item[j].Item[k].idSoFill);
                        dataAllSo.push(tempData);
                        // idSoFill.push(obj.itemSo[i].Item[j].Item[k].idSoFill);
                    }
                }
            }
            document.getElementById("toDoCountSo").innerHTML = countData;
            // console.log(dataTable);
            $('#mainTableSo>tbody').empty().append(dataTable);
        }

        function showEdit() {
            $('#editEmployeeModal').modal('show');
        }

        function refreshTableRevSoDone(obj) {
            var dataTable = '';
            var countData = 0;
            for (var i = 0; i < obj?.itemSo?.length; i++) {
                for (var j = 0; j < obj.itemSo[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemSo[i].Item[j].Item.length; k++) {
                        countData++;
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Tanggal.split("-").reverse().join("/");
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Outlet;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].Item;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemSo[i].Item[j].Item[k].idRev == '2') {
                            dataTable += 'style="background-color:tomato;" ';
                        } else if (obj.itemSo[i].Item[j].Item[k].idRev == '3') {
                            dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemSo[i].Item[j].Item[k].qty;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].namaPerevisi;
                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }
                }
            }
            document.getElementById("doneCountSo").innerHTML = countData;
            // console.log(dataTable);
            $('#mainTableSoDone>tbody').empty().append(dataTable);
        }

        function showAllRevisionSo() {
            $.ajax({
                url: "{{ url('soHarian/show/revision/all') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    refreshTableRevSo(obj);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function showAllRevisionDoneSo() {
            $.ajax({
                url: "{{ url('soHarian/show/revision/done') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    refreshTableRevSoDone(obj);
                    // console.log(obj);
                    // setRevSoDone(depthRevisiSoDone, index1RevisiSoDone, index2RevisiSoDone,
                    //     index3RevisiSoDone);
                    // $('#mainTable>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
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
