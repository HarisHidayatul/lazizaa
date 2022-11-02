{{-- @dd($dBrand[0]->doutlets); --}}
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
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="list-tab" role="tablist">
                <div id="revisionSalesList"></div>
            </div>
        </div>
    </div>
    <div class="container" style="width:50%">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="2">
                        <div id="itemSales"></div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>CU</td>
                    <td><input id="inputCUSales"></td>
                </tr>
                <tr>
                    <td>Jumlah</td>
                    <td><input id="inputTotalSales"></td>
                </tr>
                {{-- <tr>
                    <td colspan="2">Larry the Bird</td>
                </tr> --}}
            </tbody>
        </table>
        <button onclick="submitRevisionSales()">Submit</button>
        <table class="table" id="mainTableSales">
            <thead>
                <tr>
                    <th>
                        <h6>Item Sales</h6>
                    </th>
                    <th>
                        <h6>CU</h6>
                    </th>
                    <th>
                        <h6>Jumlah</h6>
                    </th>
                    <th>
                        <h6>Pengisi</h6>
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <br><br><br>
    <div class="row">
        <div class="col-4">
            <div class="list-group" id="list-tabs" role="tablist">
                <div id="revisionSalesListDone"></div>
            </div>
        </div>
    </div>
    <div class="container" style="width:50%">
        <table class="table" id="mainTableSalesDone">
            <thead>
                <tr>
                    <th>
                        <h6>Item Sales</h6>
                    </th>
                    <th>
                        <h6>CU</h6>
                    </th>
                    <th>
                        <h6>Jumlah</h6>
                    </th>
                    <th>
                        <h6>Pengisi</h6>
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>
<script>
    var objSales = null;
    var depthRevisiSales = 0;
    var index1RevisiSales = 0;
    var index2RevisiSales = 0;
    var index3RevisiSales = 0;

    var objSalesDone = null;
    var depthRevisiSalesDone = 0;
    var index1RevisiSalesDone = 0;
    var index2RevisiSalesDone = 0;
    var index3RevisiSalesDone = 0;

    var valueCuEdit = new AutoNumeric('#inputCUSales', {
        decimalPlaces: '0'
    });
    var valueTotalEdit = new AutoNumeric('#inputTotalSales', {
        decimalPlaces: '0'
    });

    function submitRevisionSales() {
        var obj = objSales;
        var idCuRev = obj.itemSales[index1RevisiSales].Item[index2RevisiSales].Item[index3RevisiSales].idCuRev;
        var idTotalRev = obj.itemSales[index1RevisiSales].Item[index2RevisiSales].Item[index3RevisiSales].idTotalRev;
        var valCuRev = parseInt(valueCuEdit.rawValue);
        var valTotalRev = parseInt(valueTotalEdit.rawValue);

        if (idCuRev == '2') {
            $.ajax({
                url: "{{ url('salesHarian/edit/cu/rev/data') }}",
                type: 'get',
                data: {
                    cuRevisi: valCuRev,
                    idSalesFill: obj.itemSales[index1RevisiSales].Item[index2RevisiSales].Item[
                        index3RevisiSales].idSalesFill,
                },
                success: function(response) {
                    // console.log(response);
                    clearRevSales();
                },
                error: function(req, err) {
                    console.log(err);
                    // return 0
                }
            });
        }
        if (idTotalRev == '2') {
            $.ajax({
                url: "{{ url('salesHarian/edit/total/rev/data') }}",
                type: 'get',
                data: {
                    totalRevisi: valTotalRev,
                    idSalesFill: obj.itemSales[index1RevisiSales].Item[index2RevisiSales].Item[
                        index3RevisiSales].idSalesFill,
                },
                success: function(response) {
                    clearRevSales();
                },
                error: function(req, err) {
                    console.log(err);
                    // return 0
                }
            });
        }
    }

    function clearRevSales() {
        depthRevisiSales--;
        document.getElementById('itemSales').innerHTML = "";
        valueCuEdit.set(0);
        valueTotalEdit.set(0);
        $('#mainTableSales>tbody').empty();
        showAllRevision();
        showAllRevisionDone();
    }

    function setRevSales(depthSales, index1, index2, index3) {
        //terdapat 3 depth clik yaitu per tanggal -> outlet -> jenis Item
        var dataList = '';
        if (depthSales != 0) {
            dataList += '<a class="list-group-item" data-toggle="list" onclick="setRevSales(' + (depthSales - 1) + ',' +
                index1 + ',' + index2 + ',' + index3 + ')">...</a>';
        }
        var obj = objSales;
        depthRevisiSales = depthSales;
        index1RevisiSales = index1;
        index2RevisiSales = index2;
        index3RevisiSales = index3;
        if (depthSales == 0) {
            for (var i = 0; i < obj.itemSales.length; i++) {
                dataList += '<a class="list-group-item" data-toggle="list" onclick="setRevSales(1,' + i + ',0,0)">';
                dataList += obj.itemSales[i].Tanggal;
                dataList += '<span class="badge badge-primary badge-pill">';
                dataList += obj.itemSales[i].Item.length;
                dataList += '</span></a>';
                // console.log(obj.itemSales[i].Tanggal);
            }
        } else if (depthSales == 1) {
            for (var i = 0; i < obj.itemSales[index1].Item.length; i++) {
                dataList += '<a class="list-group-item" data-toggle="list" onclick="setRevSales(2,' + index1 + ',' + i +
                    ',0)">';
                dataList += obj.itemSales[index1].Item[i].Outlet;
                // dataList += 'nama Outlet';
                dataList += '<span class="badge badge-primary badge-pill">';
                // dataList += '2';
                dataList += obj.itemSales[index1].Item[i].Item.length;
                dataList += '</span></a>';
            }
        } else if (depthSales == 2) {
            for (var i = 0; i < obj.itemSales[index1].Item[index2].Item.length; i++) {
                dataList += '<a class="list-group-item" data-toggle="list" onclick="setRevSales(3,' + index1 + ',' +
                    index2 + ',' + i + ')">';
                dataList += obj.itemSales[index1].Item[index2].Item[i].sales;
                dataList += '</a>';
            }
        } else if (depthSales == 3) {
            var header = obj.itemSales[index1].Item[index2].Item[index3].sales;
            var dataTable = '<tr><td>';
            dataTable += obj.itemSales[index1].Item[index2].Item[index3].sales;
            dataTable += '</td><td ';
            if (obj.itemSales[index1].Item[index2].Item[index3].idCuRev == '2') {
                dataTable += 'style="background-color:tomato;" ';
            } else if (obj.itemSales[index1].Item[index2].Item[index3].idCuRev == '3') {
                dataTable += 'style="background-color:rgb(30, 206, 9);" ';
            }
            dataTable += '>';
            dataTable += obj.itemSales[index1].Item[index2].Item[index3].cuQty;
            dataTable += '</td><td ';
            if (obj.itemSales[index1].Item[index2].Item[index3].idTotalRev == '2') {
                dataTable += 'style="background-color:tomato;" ';
            } else if (obj.itemSales[index1].Item[index2].Item[index3].idTotalRev == '3') {
                dataTable += 'style="background-color:rgb(30, 206, 9);" ';
            }
            dataTable += '>';
            dataTable += obj.itemSales[index1].Item[index2].Item[index3].totalQty.toLocaleString();
            dataTable += '</td><td>';
            dataTable += obj.itemSales[index1].Item[index2].Item[index3].namaPengisi;
            dataTable += '</td></tr>';
            // console.log(dataTable);

            header += ' / ' + obj.itemSales[index1].Item[index2].Outlet;
            header += ' / ' + obj.itemSales[index1].Tanggal;
            document.getElementById('itemSales').innerHTML = header;
            valueCuEdit.set(obj.itemSales[index1].Item[index2].Item[index3].cuQty);
            valueTotalEdit.set(obj.itemSales[index1].Item[index2].Item[index3].totalQty);
            // document.getElementById('inputCUSales').value = obj.itemSales[index1].Item[index2].Item[index3].cuQty;
            // document.getElementById('inputTotalSales').value = obj.itemSales[index1].Item[index2].Item[index3].totalQty;
            $('#mainTableSales>tbody').empty().append(dataTable);
        }
        // document.getElementById('revisionSalesList').innerHTML = '';
        document.getElementById('revisionSalesList').innerHTML = dataList;
    }

    function setRevSalesDone(depthSales, index1, index2, index3) {
        //terdapat 3 depth clik yaitu per tanggal -> outlet -> jenis Item
        var dataList = '';
        if (depthSales != 0) {
            dataList += '<a class="list-group-item" data-toggle="list" onclick="setRevSalesDone(' + (depthSales - 1) +
                ',' +
                index1 + ',' + index2 + ',' + index3 + ')">...</a>';
        }
        var obj = objSalesDone;
        depthRevisiSalesDone = depthSales;
        index1RevisiSalesDone = index1;
        index2RevisiSalesDone = index2;
        index3RevisiSalesDone = index3;
        if (depthSales == 0) {
            for (var i = 0; i < obj.itemSales.length; i++) {
                dataList += '<a class="list-group-item" data-toggle="list" onclick="setRevSalesDone(1,' + i + ',0,0)">';
                dataList += obj.itemSales[i].Tanggal;
                dataList += '<span class="badge badge-primary badge-pill">';
                dataList += obj.itemSales[i].Item.length;
                dataList += '</span></a>';
                // console.log(obj.itemSales[i].Tanggal);
            }
        } else if (depthSales == 1) {
            for (var i = 0; i < obj.itemSales[index1].Item.length; i++) {
                dataList += '<a class="list-group-item" data-toggle="list" onclick="setRevSalesDone(2,' + index1 + ',' +
                    i +
                    ',0)">';
                dataList += obj.itemSales[index1].Item[i].Outlet;
                // dataList += 'nama Outlet';
                dataList += '<span class="badge badge-primary badge-pill">';
                // dataList += '2';
                dataList += obj.itemSales[index1].Item[i].Item.length;
                dataList += '</span></a>';
            }
        } else if (depthSales == 2) {
            for (var i = 0; i < obj.itemSales[index1].Item[index2].Item.length; i++) {
                dataList += '<a class="list-group-item" data-toggle="list" onclick="setRevSalesDone(3,' + index1 + ',' +
                    index2 + ',' + i + ')">';
                dataList += obj.itemSales[index1].Item[index2].Item[i].sales;
                dataList += '</a>';
            }
        } else if (depthSales == 3) {
            var header = obj.itemSales[index1].Item[index2].Item[index3].sales;
            var dataTable = '<tr><td>';
            dataTable += obj.itemSales[index1].Item[index2].Item[index3].sales;
            dataTable += '</td><td ';
            if (obj.itemSales[index1].Item[index2].Item[index3].idCuRev == '2') {
                dataTable += 'style="background-color:tomato;" ';
            } else if (obj.itemSales[index1].Item[index2].Item[index3].idCuRev == '3') {
                dataTable += 'style="background-color:rgb(30, 206, 9);" ';
            }
            dataTable += '>';
            dataTable += obj.itemSales[index1].Item[index2].Item[index3].cuQty;
            dataTable += '</td><td ';
            if (obj.itemSales[index1].Item[index2].Item[index3].idTotalRev == '2') {
                dataTable += 'style="background-color:tomato;" ';
            } else if (obj.itemSales[index1].Item[index2].Item[index3].idTotalRev == '3') {
                dataTable += 'style="background-color:rgb(30, 206, 9);" ';
            }
            dataTable += '>';
            dataTable += obj.itemSales[index1].Item[index2].Item[index3].totalQty.toLocaleString();
            dataTable += '</td><td>';
            dataTable += obj.itemSales[index1].Item[index2].Item[index3].namaPengisi;
            dataTable += '</td></tr>';
            // console.log(dataTable);

            header += ' / ' + obj.itemSales[index1].Item[index2].Outlet;
            header += ' / ' + obj.itemSales[index1].Tanggal;
            $('#mainTableSalesDone>tbody').empty().append(dataTable);
        }
        // document.getElementById('revisionSalesList').innerHTML = '';
        document.getElementById('revisionSalesListDone').innerHTML = dataList;
    }

    function showAllRevision() {
        $.ajax({
            url: "{{ 'salesHarian/show/revision/all' }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                objSales = obj;
                setRevSales(depthRevisiSales, index1RevisiSales, index2RevisiSales, index3RevisiSales);
                // $('#mainTable>tbody').empty().append(dataTable);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function showAllRevisionDone() {
        $.ajax({
            url: "{{ 'salesHarian/show/revision/done' }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                // console.log(obj);
                objSalesDone = obj;
                setRevSalesDone(depthRevisiSalesDone, index1RevisiSalesDone, index2RevisiSalesDone,
                    index3RevisiSalesDone);
                // $('#mainTable>tbody').empty().append(dataTable);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    $(document).ready(function() {
        showAllRevision();
        showAllRevisionDone();
    });
</script>

</html>
