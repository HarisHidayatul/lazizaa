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
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}

    <script src="js/autoNumeric.min.js"></script>

    <title>Document</title>
</head>

<body>
    <div class="container">
        <table class="table" style="width: 30%">
            <tbody>
                <tr>
                    <td>To Do : </td>
                    <td>
                        <div id="toDoCountSales"></div>
                    </td>
                </tr>
                <tr>
                    <td>Done : </td>
                    <td>
                        <div id="doneCountSales"></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-striped" id="mainTableSales">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Outlet</th>
                    <th scope="col">Item Sales</th>
                    <th scope="col">CU</th>
                    <th scope="col">Total</th>
                    <th scope="col">Pengisi</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
        <table class="table table-striped" id="mainTableSalesDone">
            <thead>
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Outlet</th>
                    <th scope="col">Item Sales</th>
                    <th scope="col">CU</th>
                    <th scope="col">Total</th>
                    <th scope="col">Pengisi</th>
                    <th scope="col">Perevisi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Revisi Data </h4>
                        <h4 class="modal-title" id="editTanggal"></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <h4></h4>
                        <div class="form-group">
                            <label>CU</label>
                            <input id="editCU" class="form-control" value="0" />
                        </div>
                        <div class="form-group">
                            <label>Total</label>
                            <input id="editTotal" class="form-control" value="0" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-info" value="Submit" onclick="submitRevSales()">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    var dataAllSales = []; //format : Tanggal, idCuRev, CU, idTotalRev, Total, IdSalesFill
    var clickLastEditSales = 0;
    $(document).on("click", "[id^=a]", function(event, ui) {
        //function for edit (when clicked)
        var idClickEdit = this.id.substring(1);
        clickLastEditSales = idClickEdit;
        // console.log(dataAllSales);
        document.getElementById('editTanggal').innerHTML = dataAllSales[idClickEdit][0];
        document.getElementById('editCU').value = dataAllSales[idClickEdit][2];
        document.getElementById('editTotal').value = dataAllSales[idClickEdit][4];
    })

    function submitRevSales() {
        var cu = document.getElementById('editCU').value;
        var total = document.getElementById('editTotal').value;
        if (dataAllSales[clickLastEditSales][1] == '2') {
            $.ajax({
                url: "{{ url('salesHarian/edit/cu/rev/data') }}",
                type: 'get',
                data: {
                    cuRevisi: cu,
                    idSalesFill: dataAllSales[clickLastEditSales][5],
                    idPerevisi: "{{ $idPengisi }}"
                },
                success: function(response) {
                    // console.log(response);
                },
                error: function(req, err) {
                    console.log(err);
                    // return 0
                }
            });
        }
        if (dataAllSales[clickLastEditSales][3] == '2') {
            $.ajax({
                url: "{{ url('salesHarian/edit/total/rev/data') }}",
                type: 'get',
                data: {
                    totalRevisi: total,
                    idSalesFill: dataAllSales[clickLastEditSales][5],
                    idPerevisi: "{{ $idPengisi }}"
                },
                success: function(response) {},
                error: function(req, err) {
                    console.log(err);
                    // return 0
                }
            });
        }
        $('#editEmployeeModal').modal('hide');
        clearRevSales();
    }

    function clearRevSales() {
        // $('#mainTableSales>tbody').empty();
        showAllRevisionSales();
        showAllRevisionDoneSales();
    }

    function refreshTableRevSales(obj) {
        var dataTable = '';
        var countData = 0;
        dataAllSales.length = 0;
        for (var i = 0; i < obj?.itemSales?.length; i++) {
            for (var j = 0; j < obj.itemSales[i].Item.length; j++) {
                for (var k = 0; k < obj.itemSales[i].Item[j].Item.length; k++) {
                    var tempData = [];
                    countData++;
                    dataTable += '<tr>';
                    dataTable += '<td>';
                    dataTable += obj.itemSales[i].Tanggal.split("-").reverse().join("/");
                    tempData.push(obj.itemSales[i].Tanggal.split("-").reverse().join("/"));
                    dataTable += '</td>';
                    dataTable += '<td>';
                    dataTable += obj.itemSales[i].Item[j].Outlet;
                    dataTable += '</td>';
                    dataTable += '<td>';
                    dataTable += obj.itemSales[i].Item[j].Item[k].sales;
                    dataTable += '</td>';
                    dataTable += '<td ';
                    if (obj.itemSales[i].Item[j].Item[k].idCuRev == '2') {
                        dataTable += 'style="background-color:tomato;" ';
                    } else if (obj.itemSales[i].Item[j].Item[k].idCuRev == '3') {
                        dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                    }
                    dataTable += ' >';
                    dataTable += obj.itemSales[i].Item[j].Item[k].cuQty;
                    tempData.push(obj.itemSales[i].Item[j].Item[k].idCuRev);
                    tempData.push(obj.itemSales[i].Item[j].Item[k].cuQty);
                    dataTable += '</td>';
                    dataTable += '<td ';
                    if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '2') {
                        dataTable += 'style="background-color:tomato;" ';
                    } else if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '3') {
                        dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                    }
                    dataTable += ' >';
                    dataTable += obj.itemSales[i].Item[j].Item[k].totalQty.toLocaleString();
                    tempData.push(obj.itemSales[i].Item[j].Item[k].idTotalRev);
                    tempData.push(obj.itemSales[i].Item[j].Item[k].totalQty);
                    dataTable += '</td>';
                    dataTable += '<td>';
                    dataTable += obj.itemSales[i].Item[j].Item[k].namaPengisi;
                    dataTable += '</td>';
                    dataTable +=
                        '<td><a href="#editEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Accept" id="a' +
                        (countData - 1) + '">&#xE254;</i></a></td>';
                    dataTable += '</tr>';
                    tempData.push(obj.itemSales[i].Item[j].Item[k].idSalesFill);
                    dataAllSales.push(tempData);
                    // idSalesFill.push(obj.itemSales[i].Item[j].Item[k].idSalesFill);
                }
            }
        }
        document.getElementById("toDoCountSales").innerHTML = countData;
        // console.log(dataTable);
        $('#mainTableSales>tbody').empty().append(dataTable);
    }

    function refreshTableRevSalesDone(obj) {
        var dataTable = '';
        var countData = 0;
        for (var i = 0; i < obj?.itemSales?.length; i++) {
            for (var j = 0; j < obj.itemSales[i].Item.length; j++) {
                for (var k = 0; k < obj.itemSales[i].Item[j].Item.length; k++) {
                    countData++;
                    dataTable += '<tr>';
                    dataTable += '<td>';
                    dataTable += obj.itemSales[i].Tanggal.split("-").reverse().join("/");
                    dataTable += '</td>';
                    dataTable += '<td>';
                    dataTable += obj.itemSales[i].Item[j].Outlet;
                    dataTable += '</td>';
                    dataTable += '<td>';
                    dataTable += obj.itemSales[i].Item[j].Item[k].sales;
                    dataTable += '</td>';
                    dataTable += '<td ';
                    if (obj.itemSales[i].Item[j].Item[k].idCuRev == '2') {
                        dataTable += 'style="background-color:tomato;" ';
                    } else if (obj.itemSales[i].Item[j].Item[k].idCuRev == '3') {
                        dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                    }
                    dataTable += ' >';
                    dataTable += obj.itemSales[i].Item[j].Item[k].cuQty;
                    dataTable += '</td>';
                    dataTable += '<td ';
                    if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '2') {
                        dataTable += 'style="background-color:tomato;" ';
                    } else if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '3') {
                        dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                    }
                    dataTable += ' >';
                    dataTable += obj.itemSales[i].Item[j].Item[k].totalQty.toLocaleString();
                    dataTable += '</td>';
                    dataTable += '<td>';
                    dataTable += obj.itemSales[i].Item[j].Item[k].namaPengisi;
                    dataTable += '</td>';
                    dataTable += '<td>';
                    dataTable += obj.itemSales[i].Item[j].Item[k].namaPerevisi;
                    dataTable += '</td>';
                    dataTable += '</tr>';
                }
            }
        }
        document.getElementById("doneCountSales").innerHTML = countData;
        // console.log(dataTable);
        $('#mainTableSalesDone>tbody').empty().append(dataTable);
    }

    function showAllRevisionSales() {
        $.ajax({
            url: "{{ 'salesHarian/show/revision/all' }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                refreshTableRevSales(obj);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function showAllRevisionDoneSales() {
        $.ajax({
            url: "{{ 'salesHarian/show/revision/done' }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                refreshTableRevSalesDone(obj);
                // console.log(obj);
                // setRevSalesDone(depthRevisiSalesDone, index1RevisiSalesDone, index2RevisiSalesDone,
                //     index3RevisiSalesDone);
                // $('#mainTable>tbody').empty().append(dataTable);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }
    $(document).ready(function() {
        showAllRevisionSales();
        showAllRevisionDoneSales();
    });
</script>

</html>
