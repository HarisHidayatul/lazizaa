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
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <style>
        .brandIcon {
            width: 50px;
            height: 50px;
        }
        h5 {
            font-weight: 400;
        }
    </style>
    <title>Waste Harian</title>
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
        <h5 id="date"></h5>
        <div class="container-sm">
            <table class="table table-bordered" id="mainTable">
                <thead>
                    <tr>
                        <th>
                            Item Waste
                        </th>
                        <th>
                            Jenis
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Satuan
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
        </div>
    </div>

    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <div id="idEdit"></div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4></h4>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" id="editQty" class="form-control" value="0" />
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
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Data</h4>
                        <div id="idEdit"></div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h5>Tanggal</h5>
                        <input type="date" class="form-control" id="dateAdd" value="{{ $dateSelect }}"
                            readonly>
                        <div id="radioButtonUser"></div>
                        <h5>Input Item</h5>
                        <div class="form-group">
                            <select id="showItemOnBrand" class="form-control" style="width: 100%">
                            </select>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <button type="button" class="btn btn-secondary"
                                    onclick="showRequest()">Request</button>
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
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-info" value="Save" onclick="submitWasteHarian()">
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
                            <label>Jenis Item</label>
                            <div id="jenisReq"></div>
                        </div>
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
    var selectJenisBrand = null;
    var idJenisBrand = [];
    var objItemBrand = [];
    var dataWaste = [];
    var rowEditWaste = 0;
    var idWaste = 0;
    var dates = "{{ $dateSelect }}";
    var selectJenisReq = 0;

    // jQuery.noConflict();
    // $("#showItemOnBrand").select2();

    function setDate() {
        dates = document.getElementById("dateAdd").value;
        document.getElementById("date").innerHTML = dates.split("-").reverse().join("/");
        refreshFillTable();
    }

    function sendRevisiItem() {
        $.ajax({
            url: "{{ url('waste/items/store/revision') }}",
            type: 'get',
            data: {
                Item: document.getElementById('tambahNamaItemReq').value,
                idSatuan: $('#showSatuanEdit').val(),
                idOutlet: "{{ session('idOutlet') }}",
                idJenisBahan: idJenisBrand[selectJenisReq]
            },
            success: function(response) {
                jQuery.noConflict();
                $('#requestEmployeeModal').modal('hide');
                document.getElementById('tambahNamaItemReq').value = "";
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function addDataShow() {
        jQuery.noConflict();
        $('#addEmployeeModal').modal('show');
        document.getElementById('satuan').innerText = $('#showItemOnBrand').find(':selected').data('satuan');
    }

    function showRequest() {
        jQuery.noConflict();
        $('#addEmployeeModal').modal('hide');
        $('#requestEmployeeModal').modal('show');
    }

    $('#showItemOnBrand').change(function() {
        document.getElementById('satuan').innerText = $(this).find(':selected').data('satuan');
    })

    $(document).on("click", "[id^=a]", function(event, ui) {
        //function for edit (when clicked)
        var rows = this.id.substring(1);
        rowEditWaste = rows;
        // alert(rowEditWaste);
        document.getElementById("editQty").value = document.getElementById('b' + rows + 'k0')?.innerText;
    })

    function checkEditSend() {
        //Check Edit Data
        var qtyValEdit = document.getElementById("editQty").value;
        var qtyTableFill = document.getElementById('b' + rowEditWaste + 'k0').innerText;
        // alert(rowEditWaste);
        if (qtyValEdit != qtyTableFill) {
            $.ajax({
                url: "{{ url('waste/edit/qty/data/') }}" + "/" + dataWaste[rowEditWaste],
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

        jQuery.noConflict();
        $('#editEmployeeModal').modal('hide');
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

    function submitWasteHarian() {
        $.ajax({
            url: "{{ url('waste/data/getId') }}",
            type: 'get',
            data: {
                // tanggal: document.getElementById('dateAdd').value,
                tanggal: dates,
                idOutlet: "{{ session('idOutlet') }}"
            },
            success: function(response) {
                // console.log(response);
                idWaste = response;
                sendDataToServer(idWaste)
            },
            error: function(req, err) {
                console.log(err);
                // return 0
            }
        });
    }

    function sendDataToServer(idWastes) {
        $.ajax({
            url: "{{ url('waste/store/data') }}",
            type: 'get',
            data: {
                idWaste: idWastes,
                idListItem: $('#showItemOnBrand').val(),
                quantity: document.getElementById('qtyAdd').value,
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

    function getItemBrand() {
        $.ajax({
            url: "{{ url('waste/brand/show/item') }}",
            type: 'get',
            data: {
                idBrand: "{{ session('idBrand') }}",
            },
            success: function(response) {
                // console.log(response);
                idJenisBrand.length = 0;
                objItemBrand.length = 0;
                var obj = JSON.parse(JSON.stringify(response));
                // console.log(obj);
                var dataDropdown = '';
                var items = '';
                var radioButton = '';
                var radioButton2 = '';
                for (var i = 0; i < obj.listWaste.length; i++) {
                    radioButton +=
                        '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="selJenisBrand" onclick="radioSelBrand(' +
                        i +
                        ')" value="' + obj.listWaste[i].jenisBahan + '" id="radioBrand' + i + '"/>' +
                        '<label for="' + obj.listWaste[i].jenisBahan + '">' + obj.listWaste[i].jenisBahan +
                        '</label>' +
                        ' </div>';
                    radioButton2 +=
                        '<div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="selJenisBrand2" onclick="radioSelReq(' +
                        i +
                        ')" value="' + obj.listWaste[i].jenisBahan + '" id="radioBrand' + i + '"/>' +
                        '<label for="' + obj.listWaste[i].jenisBahan + '">' + obj.listWaste[i].jenisBahan +
                        '</label>' +
                        ' </div>';
                    idJenisBrand.push(obj.listWaste[i].idJenis);
                    objItemBrand.push(obj.listWaste[i].waste);
                    // console.log(obj.listWaste[i].waste);
                }
                // console.log(objItem);
                document.getElementById("radioButtonUser").innerHTML = radioButton;
                document.getElementById("jenisReq").innerHTML = radioButton2;
                radioSelBrand(selectJenisBrand);
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function radioSelReq(selectIndex) {
        selectJenisReq = selectIndex;
    }

    function radioSelBrand(selectIndex) {
        if (document.getElementById("radioBrand" + selectIndex) != null) {
            document.getElementById("radioBrand" + selectIndex).checked = true;
        }
        selectJenisBrand = selectIndex;
        var objSelect = objItemBrand[selectIndex];
        console.log(objSelect);
        // var item = '';
        var dataDropdown = '';
        for (var i = 0; i < objSelect?.length; i++) {
            // item += objSelect[i].Item + ' , ' + objSelect[i].Satuan + ' | ';

            dataDropdown += '<option value="';
            dataDropdown += objSelect[i].id;
            dataDropdown += '" data-satuan="' + objSelect[i].Satuan + '"';
            dataDropdown += '>';
            dataDropdown += objSelect[i].Item;
            dataDropdown += '</option>';
        }
        console.log(dataDropdown);
        // document.getElementById("BrandItem").innerHTML = item;
        $('#showItemOnBrand').empty().append(dataDropdown);
        document.getElementById('satuan').innerText = $('#showItemOnBrand').find(':selected').data('satuan');
    }

    function refreshFillTable() {
        $.ajax({
            url: "{{ url('waste/user/showTable/') }}" + '/' + "{{ session('idOutlet') }}" + '/' + dates,
            type: 'get',
            success: function(response) {
                // console.log(response);
                dataWaste.length = 0;
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataTable = '';
                var indexLoop = 0;
                for (var i = 0; i < obj.itemWaste.length; i++) {
                    // console.log(obj.itemWaste.length);
                    for (var j = 0; j < obj.itemWaste[i].Item.length; j++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].jenis;
                        dataTable += '</td>';
                        dataTable += '<td id="b' + indexLoop + 'k0" ';
                        if (obj.itemWaste[i].Item[j].idQtyRev == '2') {
                            dataTable += 'style="background-color:tomato;" ';
                        } else if (obj.itemWaste[i].Item[j].idQtyRev == '3') {
                            dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                        }
                        dataTable += '>';
                        dataTable += obj.itemWaste[i].Item[j].qty;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Satuan;
                        dataTable += '</td>';


                        dataTable +=
                            '<td><a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" id="a' +
                            indexLoop +
                            '">&#xE254;</i></a>';
                        indexLoop++;
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].namaPengisi;
                        dataTable += '</td>';
                        dataTable += '<tr>';

                        dataWaste.push(obj.itemWaste[i].Item[j].idWasteFill);
                    }
                }
                $('#mainTable>tbody').empty().append(dataTable);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    $(document).ready(function() {
        setDate();
        getItemBrand();
        refreshFillTable();
        getAllSatuan();
    })
</script>

</html>
