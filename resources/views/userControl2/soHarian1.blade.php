<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>SO Harian</title>
    <style>
        .brandIcon {
            width: 50px;
            height: 50px;
        }

        td:first-child {
            position: sticky;
            left: 0px;
            background-color: white;
        }
        td:last-child{
            position: sticky;
            right: 0px;
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
            <a class="navbar-brand" href="#">Administrasi Outlet</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('user/dashboard') }}">Laporan Harian <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">View Outlet</a>
                            <a class="dropdown-item" href="#">View Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('user/logout') }}">Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="justify-content-between">
                <input onclick="addDataShow()" class="btn btn-primary" type="button" value="Add Data">
                <img src="{{ session('brandImage') }}" alt="" class="brandIcon">
            </div>
        </nav>
        <div class="table-responsive">
            <div class="table-wrapper">
                <div style="overflow-x: scroll;">
                    <table class="table table-striped table-hover" id="maintable">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="groupAddItem">

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        {{-- <input type="submit" class="btn btn-success" value="Add"> --}}
                        <input type="button" class="btn btn-info" onclick="sendAddData()" value="Add">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <div id="idEdit"></div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="groupEditItem">
                        <div class="form-group">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-info" value="Save" onclick="checkEdit()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div id="idDel"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Data</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-danger" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="dataExistModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Replace Data</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Data exist on database, do you want to replace?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Replace">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    var dataId = [];
    var idSo = 0;
    var idSelectEdit = 0;
    var dataSo = []; //Ini bekerja secara lokal belum masuk ke server jika terdapat edit
    function addDataShow() {
        $('#addEmployeeModal').modal('show');
    }

    function checkEdit() {
        // var updateDone = true;
        for (var j = 0; j < dataId.length; j++) {
            var dataFound = false;
            for (var k = 0; k < dataSo?.itemfso[idSelectEdit]?.Item.length; k++) {
                if (dataId[j] == dataSo?.itemfso[idSelectEdit]?.Item[k]?.idItem) {
                    dataFound = true;
                    if (document.getElementsByName("editname")[j].value != dataSo?.itemfso[idSelectEdit]?.Item[k]
                        ?.qty) {
                        $.ajax({
                            url: '{{ url('soHarian/edit/data/') }}' + '/' + dataSo?.itemfso[idSelectEdit]?.Item[
                                k]?.idSoFill,
                            type: 'get',
                            data: {
                                quantityRevisi: document.getElementsByName("editname")[j].value
                            },
                            success: function(response) {
                                // console.log(response);
                                refreshFillTable();
                                // updateDone = true;
                            },
                            error: function(req, err) {
                                console.log(err);
                                // return 0
                            }
                        });
                        break;
                    }

                }
            }
            if (!dataFound) {
                document.getElementsByName("editname")[j].value = "0";
            }
        }

        $.ajax({
            url: "{{ url('soHarian/date/getId') }}",
            type: 'get',
            data: {
                tanggal: document.getElementById('dateEdit').getAttribute('value'),
                idPengisi: "{{ session('idPengisi') }}"
            },
            success: function(response) {
                // console.log(response);
                var idEditSo = response;
                sendDataEditToServer(idEditSo)
            },
            error: function(req, err) {
                console.log(err);
                // return 0
            }
        });

        $('#editEmployeeModal').modal('hide');
    }

    function sendDataEditToServer(idEditSo) {
        $.ajax({
            url: "{{ url('soHarian/edit/userFill') }}" + "/" + idEditSo,
            type: 'get',
            data: {
                idPengisi: "{{ session('idPengisi') }}"
            },
            success: function(response) {
                // console.log(response);
                refreshFillTable();
            },
            error: function(req, err) {
                console.log(err);
                // return 0
            }
        });
    }

    function showItemOutlet(id) {
        $.ajax({
            url: "{{ url('listType/soHarian/show/item/outlet/') }}" + '/' + id,
            type: 'get',
            success: function(response) {
                var order_data = '';
                var addOrderData = '';
                var editOrderData = '';
                var obj = JSON.parse(JSON.stringify(response));

                addOrderData += '<div class="form-group">';
                editOrderData += '<div class="form-group">';

                addOrderData += '<label>Tanggal</label>';
                editOrderData += '<label>Tanggal</label>';

                addOrderData +=
                    '<input type="date" class="form-control" id="dateAdd" value={{ $dateSelect }} required>';
                editOrderData +=
                    '<input type="date" class="form-control" id="dateEdit" value={{ $dateSelect }} readonly>';

                addOrderData += '</div>';
                editOrderData += '</div>';

                order_data += '<tr>';
                order_data += '<td>';
                order_data += 'Tanggal';
                order_data += '</td>';
                console.log(response);
                for (var i = 0; i < obj.DataItem.length; i++) {
                    dataId.push(obj.DataItem[i]['id']);
                    addOrderData += '<div class="form-group">';
                    editOrderData += '<div class="form-group">';

                    addOrderData += '<label>' + obj.DataItem[i]['Item'] + ' (' + obj.DataItem[i]['satuan'] +
                        ') ' + '</label>';
                    editOrderData += '<label>' + obj.DataItem[i]['Item'] + '</label>';

                    addOrderData += '<input type="number" name="addname" class="form-control" value="0"/>';
                    editOrderData +=
                        '<input type="number" name="editname" class="form-control" value="0"/>';

                    addOrderData += '</div>';
                    editOrderData += '</div>';

                    order_data += '<td>' + obj.DataItem[i]['Item'] + '<br>' + obj.DataItem[i]['satuan'] +
                        '</td>';
                }
                order_data += '<td>';
                order_data += 'Pengisi';
                order_data += '</td>';
                order_data += '<td>';
                order_data += 'Edit';
                order_data += '</td>';
                order_data += '</tr>';
                $('#maintable>thead').empty().append(order_data);

                $('#groupAddItem').empty().append(addOrderData);
                $('#groupEditItem').empty().append(editOrderData);

                refreshFillTable();
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function sendAddData() {
        $.ajax({
            url: "{{ url('soHarian/date/getId') }}",
            type: 'get',
            data: {
                tanggal: document.getElementById('dateAdd').value,
                idPengisi: "{{ session('idPengisi') }}"
            },
            success: function(response) {
                // console.log(response);
                idSo = response;
                sendDataToServer(idSo)
            },
            error: function(req, err) {
                console.log(err);
                // return 0
            }
        });
    }

    function sendDataToServer(idSo2) {
        var elementInput = document.getElementsByName("addname");
        // console.log(elementInput[0].value);
        // console.log(elementInput.length);
        for (var i = 0; i < elementInput.length; i++) {
            var isSuccess = false;
            $.ajax({
                url: "{{ url('soHarian/store/data') }}",
                type: 'get',
                data: {
                    idSo: idSo2,
                    idItemSo: dataId[i],
                    quantity: elementInput[i].value
                },
                success: function(response) {
                    // break;
                    isSuccess = true;
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
        // document.getElementById('addEmployeeModal').modal('hide');
        $('#addEmployeeModal').modal('hide'); //fungsi untuk menutup form
        refreshFillTable();
    }

    function refreshFillTable() {
        $.ajax({
            url: "{{ url('soHarian/user/showTable/') }}" + "/" + "{{ session('idOutlet') }}",
            type: 'get',
            success: function(response) {
                // console.log(response);
                dataSo.length = 0;
                var obj = JSON.parse(JSON.stringify(response));
                dataSo = obj;
                console.log(dataSo);
                var dataTable = '';
                for (var i = 0; i < obj.itemfso.length; i++) {
                    dataTable += '<tr>';
                    dataTable += '<td>';
                    dataTable += obj.itemfso[i].Tanggal.split("-").reverse().join("/");
                    dataTable += '</td>';
                    console.log(obj.itemfso.length);
                    for (var j = 0; j < dataId.length; j++) {
                        // console.log(obj.itemfso[i].Item.length);
                        var dataFound = false;
                        for (var k = 0; k < obj.itemfso[i].Item.length; k++) {
                            if (dataId[j] == obj.itemfso[i].Item[k].idItem) {
                                dataTable += '<td id="r' + i + 'c' + j + '" ';
                                if (obj.itemfso[i].Item[k].idRev == '2') {
                                    dataTable += 'style="background-color:tomato;" ';
                                } else if (obj.itemfso[i].Item[k].idRev == '3') {
                                    dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                                }
                                dataTable += '>';
                                dataFound = true;
                                dataTable += obj.itemfso[i].Item[k].qty;
                                dataTable += '</td>';
                                break;
                            }
                        }
                        if (!dataFound) {
                            dataTable += '<td>';
                            dataTable += 0;
                            dataTable += '</td>';
                        }
                    }
                    
                    dataTable += '<td>';
                    dataTable += obj.itemfso[i].pengisi;
                    dataTable += '</td>';
                    dataTable +=
                        '<td><a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" id="a' +
                        i +
                        '">&#xE254;</i></a>';
                    dataTable += '</tr>';
                }
                $('#maintable>tbody').empty().append(dataTable);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }
    $(document).ready(function() {
        showItemOutlet("{{ session('idOutlet') }}");
    });
    $(document).on("click", "[id^=a]", function(event, ui) {
        //function for edit (when clicked)
        var idClickEdit = this.id.substring(1);
        idSelectEdit = idClickEdit;
        // alert(idClickEdit);
        document.getElementById('dateEdit').setAttribute('value', dataSo?.itemfso[idClickEdit]?.Tanggal);
        // document.getElementById('r0c0').style.backgroundColor = "lightblue";
        for (var j = 0; j < dataId.length; j++) {
            var dataFound = false;
            for (var k = 0; k < dataSo?.itemfso[idClickEdit]?.Item.length; k++) {
                if (dataId[j] == dataSo?.itemfso[idClickEdit]?.Item[k]?.idItem) {
                    dataFound = true;
                    document.getElementsByName("editname")[j].value = dataSo?.itemfso[idClickEdit]?.Item[k]
                        ?.qty;
                    break;
                }
            }
            if (!dataFound) {
                document.getElementsByName("editname")[j].value = "0";
            }
        }
    })
</script>

</html>
