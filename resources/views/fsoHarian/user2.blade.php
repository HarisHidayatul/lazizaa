{{-- @dd($datafso) --}}
{{-- @dd($datafso[0]['Tanggal']) --}}
{{-- @dd($date) --}}
{{-- @dd($userID) --}}
{{-- @dd($datafso[1]->dUsers[0]['Username']); --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }

        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }

        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a,
        .pagination li.active a.page-link {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        /* Custom checkbox */
        .custom-checkbox {
            position: relative;
        }

        .custom-checkbox input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            margin: 5px 0 0 3px;
            z-index: 9;
        }

        .custom-checkbox label:before {
            width: 18px;
            height: 18px;
        }

        .custom-checkbox label:before {
            content: '';
            margin-right: 10px;
            display: inline-block;
            vertical-align: text-top;
            background: white;
            border: 1px solid #bbb;
            border-radius: 2px;
            box-sizing: border-box;
            z-index: 2;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            content: '';
            position: absolute;
            left: 6px;
            top: 3px;
            width: 6px;
            height: 11px;
            border: solid #000;
            border-width: 0 3px 3px 0;
            transform: inherit;
            z-index: 3;
            transform: rotateZ(45deg);
        }

        .custom-checkbox input[type="checkbox"]:checked+label:before {
            border-color: #03A9F4;
            background: #03A9F4;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            border-color: #fff;
        }

        .custom-checkbox input[type="checkbox"]:disabled+label:before {
            color: #b8b8b8;
            cursor: auto;
            box-shadow: none;
            background: #ddd;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
            font-size: 14px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }
    </style>
</head>

<body>
    {{-- <h3>User id : {{ $userID }}</h3> --}}
    <img src="{{ $brandImage }}">
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Data</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Data</span></a>
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i
                                    class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll;">
                    <table class="table table-striped table-hover" id="maintable">
                        <thead>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
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
    <script>
        var dataId = [];
        var idSo = 0;
        var idSelectEdit = 0;
        var dataSo = []; //Ini bekerja secara lokal belum masuk ke server jika terdapat edit
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
                    idPengisi: {{ $idPengisi }}
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
                    idPengisi: {{ $idPengisi }}
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
                        '<input type="date" class="form-control" id="dateAdd" value={{ $date }} required>';
                    editOrderData +=
                        '<input type="date" class="form-control" id="dateEdit" value={{ $date }} readonly>';

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

                        addOrderData += '<label>' + obj.DataItem[i]['Item'] + '</label>';
                        editOrderData += '<label>' + obj.DataItem[i]['Item'] + '</label>';

                        addOrderData += '<input type="number" name="addname" class="form-control" value="0"/>';
                        editOrderData +=
                            '<input type="number" name="editname" class="form-control" value="0"/>';

                        addOrderData += '</div>';
                        editOrderData += '</div>';

                        order_data += '<td>' + obj.DataItem[i]['Item'] + '</td>';
                    }
                    order_data += '<td>';
                    order_data += 'Edit';
                    order_data += '</td>';
                    order_data += '<td>';
                    order_data += 'Pengisi';
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
                    idPengisi: {{ $idPengisi }}
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
                url: "{{ 'soHarian/user/showTable/' }}" + {{ $idOutlet }},
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
                        dataTable +=
                            '<td><a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" id="a' +
                            i +
                            '">&#xE254;</i></a>';

                        dataTable += '<td>';
                        dataTable += obj.itemfso[i].pengisi;
                        dataTable += '</td>';
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
            showItemOutlet({{ $idOutlet }});
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
</body>

</html>
