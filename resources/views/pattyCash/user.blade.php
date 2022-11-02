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

    <h7>Input Item : </h7><br>
    <select id="showItemOnBrand" style='width: 200px;'>
    </select><br>

    <h7>Quantity : </h7><br>
    <input type="number" id="qtyAdd">

    <br>
    <h7>Satuan : </h7>
    
    <div id="satuan"></div>

    <br>
    <h7>Total : </h7><br>
    <input type="number" id="totalAdd"><br>
    <button onclick="submitPattyCashHarian()">Submit</button>

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
                        <div class="form-group">
                            <label>Total</label>
                            <input type="number" id="editTotal" class="form-control" value="0" />
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
    $("#showItemOnBrand").select2();
    var rowEditPattyCash = 0;
    var dataPattyCash = [];
    var dates = "{{ $date }}";
    var idPattyCash = 0;

    function setDate() {
        dates = document.getElementById("dateAdd").value;
        document.getElementById("date").innerHTML = dates.split("-").reverse().join("/");
        refreshFillTable();
    }

    $(document).ready(function() {
        setDate();
        refreshFillTable();
        getItemBrand();
    })

    function submitPattyCashHarian() {
        $.ajax({
            url: "{{ url('pattyCash/data/getId') }}",
            type: 'get',
            data: {
                // tanggal: document.getElementById('dateAdd').value,
                tanggal: dates,
                idOutlet: {{ $idOutlet }}
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

    function sendDataToServer(idPattyCashs) {
        $.ajax({
            url: "{{ url('pattyCash/store/data') }}",
            type: 'get',
            data: {
                idPattyCash: idPattyCashs,
                idListItem: $('#showItemOnBrand').val(),
                quantity: document.getElementById('qtyAdd').value,
                total: document.getElementById('totalAdd').value,
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
        document.getElementById("editQty").value = document.getElementById('b' + rows + 'k0').innerText;
        document.getElementById("editTotal").value = document.getElementById('b' + rows + 'k1').innerText;
    })

    function getItemBrand() {
        $.ajax({
            url: "{{ url('pattyCash/brand/show/item') }}",
            type: 'get',
            data: {
                idBrand: "{{ $idBrand }}",
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
        var totalValEdit = document.getElementById("editTotal").value;
        var qtyTableFill = document.getElementById('b' + rowEditPattyCash + 'k0').innerText;
        var totalTableFill = document.getElementById('b' + rowEditPattyCash + 'k1').innerText;
        // alert(rowEditPattyCash);
        if (qtyValEdit != qtyTableFill) {
            $.ajax({
                url: "{{ url('pattyCash/edit/qty/data/') }}" + "/" + dataPattyCash[rowEditPattyCash],
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
        if (totalValEdit != totalTableFill) {
            $.ajax({
                url: "{{ url('pattyCash/edit/total/data/') }}" + "/" + dataPattyCash[rowEditPattyCash],
                type: 'get',
                data: {
                    totalRevisi: totalValEdit,
                    idPengisi: {{ $idPengisi }}
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
            url: "{{ 'pattyCash/user/showTable/' }}" + "{{ $idOutlet }}" + '/' + dates,
            type: 'get',
            success: function(response) {
                // console.log(response);
                dataPattyCash.length = 0;
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataTable = '';
                var indexLoop = 0;
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
                        dataTable += obj.itemPattyCash[i].Item[j].total;
                        dataTable += '</td>';

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
</script>

</html>
