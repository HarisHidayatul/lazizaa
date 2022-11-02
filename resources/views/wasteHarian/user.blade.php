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
    <title>Document</title>
</head>
<body>
    <h2 id="date"></h2>
    <input type="date" class="form-control" id="dateAdd" value="{{ $date }}" required>
    <button onclick="setDate()">Set Date</button>
    <table class="table table-bordered" id="mainTable" style="width: 60%">
        <thead>
            <tr>
                <th>
                    Item Waste
                </th>
                <th>
                    Satuan
                </th>
                <th>
                    Jenis
                </th>
                <th>
                    Quantity
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

    <div id="radioButtonUser"></div>
    <h7>Input Item : </h7><br>
    <select id="showItemOnBrand" style='width: 200px;'>
    </select><br>
    <br>
    <h7>Satuan : </h7>
    
    <div id="satuan"></div>

    <br>
    <h7>Quantity : </h7><br>
    <input type="number" id="qtyAdd">
    <button onclick="submitWasteHarian()">Submit</button>

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
</body>
<script>
    var selectJenisBrand = null;
    var idJenisBrand = [];
    var objItemBrand = [];
    var dataWaste = [];
    var rowEditWaste =0;
    var idWaste =0;
    var dates = "{{ $date }}";

    $("#showItemOnBrand").select2();

    function setDate() {
        dates = document.getElementById("dateAdd").value;
        document.getElementById("date").innerHTML = dates.split("-").reverse().join("/");
        refreshFillTable();
    }
    
    $('#showItemOnBrand').change(function() {
        document.getElementById('satuan').innerText = $(this).find(':selected').data('satuan');
    })

    $(document).on("click", "[id^=a]", function(event, ui) {
        //function for edit (when clicked)
        var rows = this.id.substring(1);
        rowEditWaste = rows;
        // alert(rowEditWaste);
        document.getElementById("editQty").value = document.getElementById('b' + rows + 'k0').innerText;
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

        jQuery.noConflict();
        $('#editEmployeeModal').modal('hide');
    }

    function submitWasteHarian() {
        $.ajax({
            url: "{{ url('waste/data/getId') }}",
            type: 'get',
            data: {
                // tanggal: document.getElementById('dateAdd').value,
                tanggal: dates,
                idOutlet: {{ $idOutlet }}
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
                idPengisi: {{ $idPengisi }}
            },
            success: function(response) {
                // break;
                // isSuccess = true;
                refreshFillTable();
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
                idBrand: {{ $idBrand }},
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
                for (var i = 0; i < obj.listWaste.length; i++) {
                    radioButton += '<input type="radio" name="selJenisBrand" onclick="radioSelBrand(' +
                        i +
                        ')" value="' + obj.listWaste[i].jenisBahan + '" id="radioBrand' + i + '"/>' +
                        '<label for="' + obj.listWaste[i].jenisBahan + '">' + obj.listWaste[i].jenisBahan +
                        '</label>' +
                        ' <br>';
                    idJenisBrand.push(obj.listWaste[i].idJenis);
                    objItemBrand.push(obj.listWaste[i].waste);
                    // console.log(obj.listWaste[i].waste);
                }
                // console.log(objItem);
                document.getElementById("radioButtonUser").innerHTML = radioButton;
                radioSelBrand(selectJenisBrand);
            },
            error: function(req, err) {
                console.log(err);
            }
        })
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

            dataDropdown += '<option value=';
            dataDropdown += objSelect[i].id;
            dataDropdown += '  data-satuan="' + objSelect[i].Satuan + '"';
            dataDropdown += '>';
            dataDropdown += objSelect[i].Item;
            dataDropdown += '</option>';
        }
        // document.getElementById("BrandItem").innerHTML = item;
        $('#showItemOnBrand').empty().append(dataDropdown);
    }

    function refreshFillTable() {
        $.ajax({
            url: "{{ 'waste/user/showTable/' }}" + "{{ $idOutlet }}" + '/' + dates,
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
                        dataTable += obj.itemWaste[i].Item[j].Satuan;
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
        getItemBrand();
        refreshFillTable();
    })
</script>
</html>