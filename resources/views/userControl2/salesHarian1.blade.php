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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.min.js"></script>
    <style>
        .brandIcon {
            width: 50px;
            height: 50px;
        }

        h5 {
            font-weight: 400;
        }
        .footer {
            margin-top: 50px;
            width: 100%;
            background: #B20731;
        }

        .imgFooter {
            height: 105px;
            width: 120px;
            margin-bottom: -25px;
        }

        .tittleFooter {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            text-align: center;
            color: #FFFFFF;
            padding-bottom: 20px;
        }

        .borderFooter {
            left: 30px;
            width: 85vw;
            max-width: 400px;
            border-bottom: 1px solid #FFFFFF;
        }

        .socialMediaLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            text-align: center;
            color: #FFFFFF;
            margin-top: 25px;
        }

        .footerLaporta {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            /* identical to box height */

            text-align: center;

            color: #FFFFFF;

        }
    </style>
    <title>Sales Harian</title>
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
                <img src="{{ session('brandImage') }}" alt="" class="brandIcon">
            </div>
        </nav>
        <div class="container-sm">
            <input type="date" class="form-control" id="dateAdd" value="{{ $dateSelect }}" readonly>
            {{-- <h2>{{ $Outlet }}</h2> --}}
            <table class="table" id="fillTable">
                <thead>
                    <tr>
                        <th>
                            <h3></h3>
                        </th>
                        <th>
                            <h3>CU</h3>
                        </th>
                        <th>
                            <h3>Total</h3>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <br>
            <button class="right" onclick="submitSalesHarian()">Submit</button>
            <br>
            <br>
            <table class="table" id="mainTable">
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
                            <h6>Action</h6>
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
    </div>
    <div class="container" style="width:60%">
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
                            <input type="button" class="btn btn-info" value="Save" onclick="checkEditSend()">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center footer">
        <div>
            <div class="d-flex justify-content-center">
                <img class="imgFooter" src="{{ url('img/lazizaaHome.png') }}" alt="">
            </div>
            <div class="tittleFooter">PT LAZIZAA RAHMAT SEMESTA</div>
            <div class="d-flex justify-content-center borderFooter"></div>
            <div class="socialMediaLabel">Social media</div>
            <div class="d-flex justify-content-center" style="margin-top: 60px;">
                <img src="{{ url('img/icon/instagram.png') }}" alt="" style="height: 20px; width: 20px;">
                <div style="width: 40px;"></div>
                <img src="{{ url('img/icon/facebook.png') }}" alt="" style="width: 12px; height: 23px;">
                <div style="width: 40px;"></div>
                <img src="{{ url('img/icon/whatsapp.png') }}" alt="" style="width: 24px; height: 24px;">
            </div>
            <div style="height: 20px;"></div>
            <div class="footerLaporta"><span style="font-size: 16px; margin-top: 5px;">&#169;</span> 2022 - Laporta</div>
        </div>
    </div>
</body>
<script>
    var dataIdType = [];
    var dataIdItem = [];
    var nameIdType = [];
    var nameIdItem = [];
    var dataSales = [];

    var cuDataTable = [];
    var totalDataTable = [];

    var valueTotalAll = [];
    var idSales = 0;
    var rowEditSales = 0;

    var valueCuEdit = new AutoNumeric('#editCU', {
        decimalPlaces: '0'
    });
    var valueTotalEdit = new AutoNumeric('#editTotal', {
        decimalPlaces: '0'
    });

    var dates = "{{ $dateSelect }}";

    function setDate() {
        dates = document.getElementById("dateAdd").value;
        document.getElementById("date").innerHTML = dates.split("-").reverse().join("/");
        refreshFillTable();
        setClearFill();
    }

    function setClearFill() {
        for (var i = 0; i < dataIdItem.length; i++) {
            document.getElementById('r' + i + 'c0').value = "";
            document.getElementById('r' + i + 'c1').value = "";
        }
        sumValueInput();
    }

    function checkEditSend() {
        //Check Edit Data
        // var cuValEdit = document.getElementById("editCU").value;
        var cuValEdit = parseInt(valueCuEdit.rawValue);
        // var totalValEdit = document.getElementById("editTotal").value;
        var totalValEdit = parseInt(valueTotalEdit.rawValue);
        // var cuTableFill = document.getElementById('b' + rowEditSales + 'k0').innerText;
        var cuTableFill = cuDataTable[rowEditSales];
        // var totalTableFill = document.getElementById('b' + rowEditSales + 'k1').innerText;
        var totalTableFill = totalDataTable[rowEditSales];
        // alert(rowEditSales);
        if (cuValEdit != cuTableFill) {
            $.ajax({
                url: "{{ url('salesHarian/edit/cu/data/') }}" + "/" + dataSales[rowEditSales],
                type: 'get',
                data: {
                    cuRevisi: cuValEdit,
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
                url: "{{ url('salesHarian/edit/total/data/') }}" + "/" + dataSales[rowEditSales],
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


        $('#editEmployeeModal').modal('hide');
    }

    $(document).on("click", "[id^=a]", function(event, ui) {
        //function for edit (when clicked)
        var rows = this.id.substring(1);
        rowEditSales = rows;
        // alert(this.id.substring(1));
        // document.getElementById("editCU").value = document.getElementById('b' + rows + 'k0').innerText;
        // document.getElementById("editTotal").value = document.getElementById('b' + rows + 'k1').innerText;

        // valueCuEdit.rawValue = cuDataTable[rows];
        valueCuEdit.set(cuDataTable[rows]);
        // valueTotalEdit.rawValue = totalDataTable[rows];
        valueTotalEdit.set(totalDataTable[rows]);
    })

    function submitSalesHarian() {
        $.ajax({
            url: "{{ url('salesHarian/data/getId') }}",
            type: 'get',
            data: {
                // tanggal: document.getElementById('dateAdd').value,
                tanggal: dates,
                idOutlet: "{{ session('idOutlet') }}"
            },
            success: function(response) {
                // console.log(response);
                idSales = response;
                sendDataToServer(idSales)
            },
            error: function(req, err) {
                console.log(err);
                // return 0
            }
        });
    }

    function sendDataToServer(idSaless) {
        for (var j = 0; j < 5; j++) { //ulangin kirim sebanyak lima kali
            for (var i = 0; i < dataIdItem.length; i++) {
                var elementIDSendRow0 = document.getElementById('r' + i + 'c0').value;
                // var elementIDSendRow1 = document.getElementById('r' + i + 'c1').value;
                var elementIDSendRow1 = parseInt(valueTotalAll[i].rawValue);
                var idListSales = dataIdItem[i];
                if (elementIDSendRow0 == null) {
                    continue;
                }
                if (elementIDSendRow1 == null) {
                    continue;
                }

                $.ajax({
                    url: "{{ url('salesHarian/store/data') }}",
                    type: 'get',
                    data: {
                        idSales: idSaless,
                        idListSales: idListSales,
                        cu: elementIDSendRow0,
                        total: elementIDSendRow1,
                        idPengisi: "{{ session('idPengisi') }}"
                    },
                    success: function(response) {
                        // break;
                        // isSuccess = true;
                    },
                    error: function(req, err) {
                        console.log(err);
                    }
                });
            }
        }
        refreshFillTable();
    }

    function refreshFillTable() {
        $.ajax({
            url: "{{ url('salesHarian/user/showTable/') }}"+ '/' + "{{ session('idOutlet') }}" + '/' + dates,
            type: 'get',
            success: function(response) {
                // console.log(response);
                dataSales.length = 0;
                cuDataTable.length = 0;
                totalDataTable.length = 0;
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataTable = '';
                var indexLoop = 0;
                for (var i = 0; i < obj.itemSales.length; i++) {
                    dataTable += '<tr>';
                    // console.log(obj.itemSales.length);
                    for (var j = 0; j < dataIdItem.length; j++) {
                        // console.log(obj.itemSales[i].Item.length);
                        // console.log(dataIdItem[j]);
                        // var dataFound = false;
                        for (var k = 0; k < obj.itemSales[i].Item.length; k++) {
                            if (dataIdItem[j] == obj.itemSales[i].Item[k].idListSales) {
                                dataTable += '<tr>';
                                dataTable += '<td>' + nameIdItem[j] + '</td>';

                                dataTable += '<td id="b' + indexLoop + 'k0" ';
                                if (obj.itemSales[i].Item[k].idCuRev == '2') {
                                    dataTable += 'style="background-color:tomato;" ';
                                } else if (obj.itemSales[i].Item[k].idCuRev == '3') {
                                    dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                                }
                                dataTable += '>';
                                dataTable += obj.itemSales[i].Item[k].cuQty;
                                cuDataTable.push(obj.itemSales[i].Item[k].cuQty);
                                dataTable += '</td>';

                                dataTable += '<td id="b' + indexLoop + 'k1" ';
                                if (obj.itemSales[i].Item[k].idTotalRev == '2') {
                                    dataTable += 'style="background-color:tomato;" ';
                                } else if (obj.itemSales[i].Item[k].idTotalRev == '3') {
                                    dataTable += 'style="background-color:rgb(30, 206, 9);" ';
                                }
                                dataTable += '>';
                                dataTable += obj.itemSales[i].Item[k].totalQty.toLocaleString();
                                totalDataTable.push(obj.itemSales[i].Item[k].totalQty);
                                dataTable += '</td>';

                                dataTable +=
                                    '<td><a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" id="a' +
                                    indexLoop +
                                    '">&#xE254;</i></a>';
                                indexLoop++;


                                dataTable += '<td>';
                                dataTable += obj.itemSales[i].Item[k].namaPengisi;
                                dataTable += '</td>';
                                dataTable += '<tr>';

                                dataSales.push(obj.itemSales[i].Item[k].idSalesFill);

                                break;
                            }
                        }
                        // if (!dataFound) {
                        //     dataTable += '<td>';
                        //     dataTable += 0;
                        //     dataTable += '</td>';
                        // }
                    }
                    dataTable += '</tr>';
                }
                $('#mainTable>tbody').empty().append(dataTable);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function sumValueInput() {
        var sumData = 0;
        for (var i = 0; i < dataIdItem.length; i++) {
            var idInput = 'r' + i + 'c1';
            if (document.getElementById(idInput).value != '') {
                // sumData += parseInt(document.getElementById(idInput).value);
                sumData += parseInt(valueTotalAll[i].rawValue);
                // sumData += valueTotalAll[i].rawValue;
            }
        }
        document.getElementById('totalALL').innerHTML = sumData.toLocaleString();
        // console.log(sumData);
    }

    function getListAllType() {
        $.ajax({
            url: "{{ url('typeSales/show') }}",
            type: 'get',
            success: function(response) {
                // console.log(response);
                var obj = JSON.parse(JSON.stringify(response));
                var type = '';
                var dataDropdown = '';
                dataIdType.length = 0;
                nameIdType.length = 0;
                dataIdItem.length = 0;
                nameIdItem.length = 0;
                for (var i = 0; i < obj.typeSales.length; i++) {
                    dataIdType.push(obj.typeSales[i].id);
                    nameIdType.push(obj.typeSales[i].type);
                }
                getItemOnOutlet();
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function getItemOnOutlet() {
        $.ajax({
            url: "{{ url('salesHarian/show/list/') }}" + '/' + "{{ session('idOutlet') }}",
            type: 'get',
            success: function(response) {
                // console.log(response);
                var obj = JSON.parse(JSON.stringify(response));
                var dataTable = '';
                var row = 0;
                valueTotalAll.length = 0;
                for (var i = 0; i < dataIdType.length; i++) {
                    var dataFound = false;
                    for (var j = 0; j < obj.listSales.length; j++) {
                        if (dataIdType[i] == obj.listSales[j].typeSales) {
                            dataFound = true;
                            break;
                        }
                        // dataDropdown += obj.listSales[j].id;
                        // dataDropdown += obj.listSales[j].sales;
                    }
                    if (dataFound) {
                        dataTable += "<tr><th><h5>" + nameIdType[i] + "</h5></th></tr>";
                        for (var j = 0; j < obj.listSales.length; j++) {
                            if (dataIdType[i] == obj.listSales[j].typeSales) {
                                dataIdItem.push(obj.listSales[j].id);
                                nameIdItem.push(obj.listSales[j].sales);
                                dataTable += '<tr><td>' + obj.listSales[j].sales +
                                    '</td><td><input type="number"' + ' id="r' + row +
                                    'c0" style="width: 100px; padding: 1px" placeholder="0">' +
                                    '</td><td><input class="numberComa"' + ' id="r' + row +
                                    'c1" style="width: 100px; padding: 1px" placeholder="0" onchange="sumValueInput()">' +
                                    '</td></tr>';
                                row++;
                            }
                        }
                    }
                }
                dataTable += "<tr><th><h5>" + 'Total' + "</h5></th>";
                dataTable += '<th><h5 id="totalCU"></h5></th>';
                dataTable += '<th><h5 id="totalALL">0</h5></th>';
                dataTable += "</tr>";
                $('#fillTable>tbody').empty().append(dataTable);
                for (var i = 0; i < row; i++) {
                    var idRow = '#r' + i + 'c1';
                    valueTotalAll.push(new AutoNumeric(idRow, {
                        decimalPlaces: '0'
                    }));
                }
                refreshFillTable();
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }
    $(document).ready(function() {
        getListAllType();
        // refreshFillTable();
        // .split("-").reverse().join("/")
        document.getElementById("date").innerHTML = dates.split("-").reverse().join("/");
        $.ajax({
            url: "{{ url('salesHarian/data/getId') }}",
            type: 'get',
            data: {
                // tanggal: document.getElementById('dateAdd').value,
                tanggal: "{{ $dateSelect }}",
                idOutlet: "{{ session('idOutlet') }}"
            },
            success: function(response) {
                // console.log(response);
                idSales = response;
            },
            error: function(req, err) {
                console.log(err);
                // return 0
            }
        });
    });
</script>

</html>
