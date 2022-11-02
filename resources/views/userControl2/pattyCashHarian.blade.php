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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- jQuery -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.min.js"></script>

    <title>Patty Cash Harian</title>
    <style>
        .brandIcon {
            width: 50px;
            height: 50px;
        }

        h5 {
            font-weight: 400;
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
        <div class="container-sm">
            <h5 id="date"></h5>
            <table class="table table-striped table-bordered" id="mainTable">
                <thead>
                    <tr>
                        <th>
                            Item Patty Cash
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Total
                        </th>
                        <th>
                            Action
                        </th>
                        <th>
                            Pengisi
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            {{-- <button onclick="submitPattyCashHarian()">Submit</button> --}}
        </div>
        <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Add Data</h4>
                            <div id="idEdit"></div>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <h5>Tanggal</h5>
                            <input type="date" class="form-control" id="dateAdd" value="{{ $dateSelect }}"
                                readonly>
                            <h5>Input Item</h5>
                            <div class="form-group">
                                <select id="showItemOnBrand" class="form-control" style="width: 100%">
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <button type="button" onclick="showRequest()"
                                        class="btn btn-secondary">Request</button>
                                </div>
                            </div>
                            <h5>Quantity</h5>
                            <div class="form-row">
                                <div class="input-group">
                                    <input type="number" id="qtyAdd" class="form-control" placeholder="0">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="satuan">Gram</span>
                                    </div>
                                </div>
                            </div>
                            <h5>Total</h5>
                            <div class="form-row">
                                <div class="input-group">
                                    <input id="totalAdd" class="form-control" placeholder="0">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="button" class="btn btn-info" value="Save"
                                onclick="submitPattyCashHarian()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="editEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Data</h4>
                            <div id="idEdit"></div>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <h4></h4>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" id="editQty" class="form-control" value="0" />
                            </div>
                            <div class="form-group">
                                <label>Total</label>
                                <input id="editTotal" class="form-control" value="0" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="button" class="btn btn-info" value="Save" onclick="checkEditSend()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="requestEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Request Data</h4>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Nama Item</label>
                                <input id="tambahNamaItemReq" class="form-control" placeholder="Masukkan nama item" />
                            </div>
                            <div class="form-group">
                                <label>Satuan</label>
                                <select id="showSatuanEdit" class="form-control" style="width: 100%">
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="button" class="btn btn-info" value="Send" onclick="sendRevisiItem()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
</body>
<script>
    // $("#showItemOnBrand").select2();
    var rowEditPattyCash = 0;
    var dataPattyCash = [];
    var totalPattyCash = [];
    var dates = "{{ $dateSelect }}";
    var idPattyCash = 0;
    var valueTotalEdit = new AutoNumeric('#editTotal', {
        decimalPlaces: '0'
    });
    var valueTotalAdd = new AutoNumeric('#totalAdd', {
        decimalPlaces: '0'
    });

    function showRequest() {
        jQuery.noConflict();
        $('#addEmployeeModal').modal('hide');
        $('#requestEmployeeModal').modal('show');
    }

    function getAllSatuan() {
        $.ajax({
            url: "{{ url('show/satuan') }}",
            type: 'get',
            success: function(response) {
                // console.log(response);
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataDropdown = '';
                for (var i = 0; i < obj.dataItem.length; i++) {
                    dataDropdown += '<option value=';
                    dataDropdown += obj.dataItem[i].id;
                    dataDropdown += '>';
                    dataDropdown += obj.dataItem[i].Satuan;
                    dataDropdown += '</option>';
                }
                $('#showSatuanEdit').empty().append(dataDropdown);
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function setDate() {
        dates = document.getElementById("dateAdd").value;
        document.getElementById("date").innerHTML = dates.split("-").reverse().join("/");
        refreshFillTable();
    }

    $(document).ready(function() {
        setDate();
        refreshFillTable();
        getItemBrand();
        getAllSatuan();
    })

    function submitPattyCashHarian() {
        $.ajax({
            url: "{{ url('pattyCash/data/getId') }}",
            type: 'get',
            data: {
                // tanggal: document.getElementById('dateAdd').value,
                tanggal: dates,
                idOutlet: "{{ session('idOutlet') }}"
            },
            success: function(response) {
                // console.log(response);
                idPattyCash = response;
                sendDataToServer(idPattyCash)
            },
            error: function(req, err) {
                console.log(err);
                // return 0
            }
        });
    }

    function sendRevisiItem() {
        $.ajax({
            url: "{{ url('pattyCash/items/store/revision') }}",
            type: 'get',
            data: {
                Item: document.getElementById('tambahNamaItemReq').value,
                idSatuan: $('#showSatuanEdit').val(),
                idOutlet: "{{ session('idOutlet') }}"
            },
            success: function(response) {
                $('#requestEmployeeModal').modal('hide');
                document.getElementById('tambahNamaItemReq').value = "";
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function sendDataToServer(idPattyCashs) {
        $.ajax({
            url: "{{ url('pattyCash/store/data') }}",
            type: 'get',
            data: {
                idPattyCash: idPattyCashs,
                idListItem: $('#showItemOnBrand').val(),
                quantity: document.getElementById('qtyAdd').value,
                total: parseInt(valueTotalAdd.rawValue),
                idPengisi: "{{ session('idPengisi') }}"
            },
            success: function(response) {
                // break;
                // isSuccess = true;
                refreshFillTable();
                jQuery.noConflict();
                $('#addEmployeeModal').modal('hide');
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    $('#showItemOnBrand').change(function() {
        // alert($(this).val());
        // alert($(this).find(':selected').data('satuan'));
        document.getElementById('satuan').innerText = $(this).find(':selected').data('satuan');
    })


    $(document).on("click", "[id^=a]", function(event, ui) {
        //function for edit (when clicked)
        var rows = this.id.substring(1);
        rowEditPattyCash = rows;
        // alert(rowEditPattyCash);
        document.getElementById("editQty").value = document.getElementById('b' + rows + 'k0')?.innerText;
        // document.getElementById("editTotal").value = document.getElementById('b' + rows + 'k1').innerText;
        // document.getElementById("editTotal").value = totalPattyCash[rows];
        valueTotalEdit.set(totalPattyCash[rows]);
    })

    function getItemBrand() {
        $.ajax({
            url: "{{ url('pattyCash/brand/show/item') }}",
            type: 'get',
            data: {
                idBrand: "{{ session('idBrand') }}",
            },
            success: function(response) {
                console.log(response);
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataDropdown = '';
                for (var i = 0; i < obj.dataItem.length; i++) {
                    dataDropdown += '<option value=';
                    dataDropdown += obj.dataItem[i].id;
                    dataDropdown += '  data-satuan="' + obj.dataItem[i].Satuan + '"';
                    dataDropdown += '>';
                    dataDropdown += obj.dataItem[i].Item;
                    dataDropdown += '</option>';
                }
                $('#showItemOnBrand').empty().append(dataDropdown);
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function checkEditSend() {
        //Check Edit Data
        var qtyValEdit = document.getElementById("editQty").value;
        // var totalValEdit = document.getElementById("editTotal").value;
        var totalValEdit = parseInt(valueTotalEdit.rawValue);
        var qtyTableFill = document.getElementById('b' + rowEditPattyCash + 'k0')?.innerText;
        var totalTableFill = totalPattyCash[rowEditPattyCash];
        // var totalTableFill = document.getElementById('b' + rowEditPattyCash + 'k1').innerText;
        // alert(rowEditPattyCash);
        if (qtyValEdit != qtyTableFill) {
            $.ajax({
                url: "{{ url('pattyCash/edit/qty/data/') }}" + "/" + dataPattyCash[rowEditPattyCash],
                type: 'get',
                data: {
                    quantityRevisi: qtyValEdit,
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
        if (totalValEdit != totalTableFill) {
            $.ajax({
                url: "{{ url('pattyCash/edit/total/data/') }}" + "/" + dataPattyCash[rowEditPattyCash],
                type: 'get',
                data: {
                    totalRevisi: totalValEdit,
                    idPengisi: "{{ session('idPengisi') }}"
                },
                success: function(response) {
                    refreshFillTable();
                },
                error: function(req, err) {
                    console.log(err);
                    // return 0
                }
            });
        }

        jQuery.noConflict();
        $('#editEmployeeModal').modal('hide');
    }

    function refreshFillTable() {
        $.ajax({
            url: "{{ url('/') }}" + '/' + "{{ 'pattyCash/user/showTable/' }}" +
                "{{ session('idOutlet') }}" + '/' + dates,
            type: 'get',
            success: function(response) {
                // console.log(response);
                dataPattyCash.length = 0;
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataTable = '';
                var indexLoop = 0;
                totalPattyCash.length = 0;
                for (var i = 0; i < obj.itemPattyCash.length; i++) {
                    // console.log(obj.itemPattyCash.length);
                    for (var j = 0; j < obj.itemPattyCash[i].Item.length; j++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item;
                        dataTable += '</td>';
                        dataTable += '<td id="b' + indexLoop + 'k0" ';
                        if (obj.itemPattyCash[i].Item[j].idQtyRev == '2') {
                            dataTable += 'style="background-color:tomato;" ';
                        } else if (obj.itemPattyCash[i].Item[j].idQtyRev == '3') {
                            dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                        }
                        dataTable += '>';
                        dataTable += obj.itemPattyCash[i].Item[j].qty;
                        dataTable += '</td>';

                        dataTable += '<td id="b' + indexLoop + 'k1" ';
                        if (obj.itemPattyCash[i].Item[j].idTotalRev == '2') {
                            dataTable += 'style="background-color:tomato;" ';
                        } else if (obj.itemPattyCash[i].Item[j].idTotalRev == '3') {
                            dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                        }
                        dataTable += '>';
                        dataTable += obj.itemPattyCash[i].Item[j].total.toLocaleString();
                        dataTable += '</td>';
                        totalPattyCash.push(obj.itemPattyCash[i].Item[j].total);

                        dataTable +=
                            '<td><a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" id="a' +
                            indexLoop +
                            '">&#xE254;</i></a>';
                        indexLoop++;
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].namaPengisi;
                        dataTable += '</td>';
                        dataTable += '<tr>';

                        dataPattyCash.push(obj.itemPattyCash[i].Item[j].idPattyCashFill);
                    }
                }
                $('#mainTable>tbody').empty().append(dataTable);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function addDataShow() {
        jQuery.noConflict();
        $('#addEmployeeModal').modal('show');
        document.getElementById('satuan').innerText = $('#showItemOnBrand').find(':selected').data('satuan');
    }
</script>

</html>
