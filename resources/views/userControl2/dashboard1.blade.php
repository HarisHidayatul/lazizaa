<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        body {
            /* background: #4527A0; */
        }

        .list-group {
            width: 400px !important;
        }

        .list-group-item {
            margin-top: 10px;
            border-radius: none;
            /* background: #5E35B1; */
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }


        .list-group-item:hover {
            transform: scaleX(1.1);
        }



        .check {
            opacity: 0;
            transition: all 0.6s ease-in-out;
        }

        .list-group-item:hover .check {
            opacity: 1;

        }

        .about span {
            font-size: 12px;
            margin-right: 10px;

        }

        input[type=checkbox] {
            position: relative;
            cursor: pointer;
        }

        input[type=checkbox]:before {
            content: "";
            display: block;
            position: absolute;
            width: 20px;
            height: 20px;
            top: 0px;
            left: 0;
            border: 1px solid #10a3f9;
            border-radius: 3px;
            background-color: white;

        }

        input[type=checkbox]:checked:after {
            content: "";
            display: block;
            width: 7px;
            height: 12px;
            border: solid #007bff;
            border-width: 0 2px 2px 0;
            -webkit-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            transform: rotate(45deg);
            position: absolute;
            top: 2px;
            left: 6px;
        }

        input[type="checkbox"]:checked+.check {
            opacity: 1;
        }

        .brandIcon {
            width: 50px;
            height: 50px;
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
                        <a class="nav-link" href="{{ url('user/dashboard') }}">Laporan Harian <span class="sr-only">(current)</span></a>
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
        {{-- https://bbbootstrap.com/snippets/bootstrap-folder-list-checkbox-and-transform-effect-16091735 --}}
        <div class="d-flex justify-content-center">
            <ul class="list-group mt-5 text-black">
                <div id="showAllTanggal"></div>
            </ul>
        </div>
    </div>
    <div id="addData" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="groupAddItem">
                        <input type="date" class="form-control" id="dateAdd" value="{{ session('date') }}" required>
                        <li onclick="goToSoHarianAdd()" class = "list-group-item d-flex justify-content-between align-content-center" >
                            <div class = "d-flex flex-row" >
                                <img src = "https://img.icons8.com/external-anggara-basic-outline-anggara-putra/100/000000/external-edit-basic-user-interface-anggara-basic-outline-anggara-putra.png" width = "40" / >
                                <div class = "ml-2" >
                                    <h6 class = "mb-0">SO Harian</h6>
                                </div>
                            </div>
                        </li>
                        <li onclick="goToPattyCashHarianAdd()" class = "list-group-item d-flex justify-content-between align-content-center" >
                            <div class = "d-flex flex-row" >
                                <img src = "https://img.icons8.com/external-anggara-basic-outline-anggara-putra/100/000000/external-edit-basic-user-interface-anggara-basic-outline-anggara-putra.png" width = "40" / >
                                <div class = "ml-2" >
                                    <h6 class = "mb-0">Patty Cash</h6>
                                </div>
                            </div>
                        </li>
                        <li onclick="goToSalesHarianAdd()" class = "list-group-item d-flex justify-content-between align-content-center" >
                            <div class = "d-flex flex-row" >
                                <img src = "https://img.icons8.com/external-anggara-basic-outline-anggara-putra/100/000000/external-edit-basic-user-interface-anggara-basic-outline-anggara-putra.png" width = "40" / >
                                <div class = "ml-2" >
                                    <h6 class = "mb-0">Sales</h6>
                                </div>
                            </div>
                        </li>
                        <li onclick="goToWasteHarianAdd()" class = "list-group-item d-flex justify-content-between align-content-center" >
                            <div class = "d-flex flex-row" >
                                <img src = "https://img.icons8.com/external-anggara-basic-outline-anggara-putra/100/000000/external-edit-basic-user-interface-anggara-basic-outline-anggara-putra.png" width = "40" / >
                                <div class = "ml-2" >
                                    <h6 class = "mb-0">Waste</h6>
                                </div>
                            </div>
                        </li>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="selectData" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <div id="idEdit"></div>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" id="groupFillItem">

                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    var dataExistType = []; //fso, pattycash, sales, waste
    var dateAll =[];
    var indexDateSelect=0;
    function addDataShow() {
        $('#addData').modal('show');
    }

    function goToSoHarian(){
        window.location.href = "{{ url('user/soHarian') }}"+'/'+dateAll[indexDateSelect];
    }
    function goToSoHarianAdd(){
        window.location.href = "{{ url('user/soHarian') }}"+'/'+document.getElementById('dateAdd').value;
    }

    function goToSalesHarian(){
        window.location.href = "{{ url('user/salesHarian') }}"+'/'+dateAll[indexDateSelect];
    }
    function goToSalesHarianAdd(){
        window.location.href = "{{ url('user/salesHarian') }}"+'/'+document.getElementById('dateAdd').value;
    }

    function goToPattyCashHarian(){
        window.location.href = "{{ url('user/pattyCashHarian') }}"+'/'+dateAll[indexDateSelect];
    }
    function goToPattyCashHarianAdd(){
        window.location.href = "{{ url('user/pattyCashHarian') }}"+'/'+document.getElementById('dateAdd').value;
    }

    function goToWasteHarian(){
        window.location.href = "{{ url('user/wasteHarian') }}"+'/'+dateAll[indexDateSelect];
    }
    function goToWasteHarianAdd(){
        window.location.href = "{{ url('user/wasteHarian') }}"+'/'+document.getElementById('dateAdd').value;
    }
    
    function clickDate(index) {
        var fillData = '';
        console.log(dataExistType);
        fillData+= '<input type="date" class="form-control" value="'+dateAll[index]+'" readonly>';
        indexDateSelect = index;
        if (dataExistType[index][0] == 1) {
            fillData +=
                '<li onclick="goToSoHarian()" class = "list-group-item d-flex justify-content-between align-content-center" ><div class = "d-flex flex-row" ><img src = "https://img.icons8.com/external-anggara-basic-outline-anggara-putra/100/000000/external-edit-basic-user-interface-anggara-basic-outline-anggara-putra.png" width = "40" / ><div class = "ml-2" ><h6 class = "mb-0">';
            fillData += "So Harian";
            fillData += '</h6>';
            fillData += "</div></div></li>";
        }
        if (dataExistType[index][1] == 1) {
            fillData +=
                '<li onclick="goToPattyCashHarian()" class = "list-group-item d-flex justify-content-between align-content-center" ><div class = "d-flex flex-row" ><img src = "https://img.icons8.com/external-anggara-basic-outline-anggara-putra/100/000000/external-edit-basic-user-interface-anggara-basic-outline-anggara-putra.png" width = "40" / ><div class = "ml-2" ><h6 class = "mb-0">';
            fillData += "Patty Cash";
            fillData += '</h6>';
            fillData += "</div></div></li>";
        }
        if (dataExistType[index][2] == 1) {
            fillData +=
                '<li onclick="goToSalesHarian()" class = "list-group-item d-flex justify-content-between align-content-center" ><div class = "d-flex flex-row" ><img src = "https://img.icons8.com/external-anggara-basic-outline-anggara-putra/100/000000/external-edit-basic-user-interface-anggara-basic-outline-anggara-putra.png" width = "40" / ><div class = "ml-2" ><h6 class = "mb-0">';
            fillData += "Sales";
            fillData += '</h6>';
            fillData += "</div></div></li>";
        }
        if (dataExistType[index][3] == 1) {
            fillData +=
                '<li onclick="goToWasteHarian()" class = "list-group-item d-flex justify-content-between align-content-center" ><div class = "d-flex flex-row" ><img src = "https://img.icons8.com/external-anggara-basic-outline-anggara-putra/100/000000/external-edit-basic-user-interface-anggara-basic-outline-anggara-putra.png" width = "40" / ><div class = "ml-2" ><h6 class = "mb-0">';
            fillData += "Waste";
            fillData += '</h6>';
            fillData += "</div></div></li>";
        }
        document.getElementById('groupFillItem').innerHTML = fillData;
        $('#selectData').modal('show');
    }

    function showListOnAllDate(obj) {
        // .split("-").reverse().join("/")
        dataExistType.length = 0;
        dateAll.length =0;
        var dataTable = '';
        for (var i = 0; i < obj.DataTanggal.length; i++) {
            var arrayExistType = [];
            arrayExistType.push(obj.DataTanggal[i].fso);
            arrayExistType.push(obj.DataTanggal[i].pcash);
            arrayExistType.push(obj.DataTanggal[i].sales);
            arrayExistType.push(obj.DataTanggal[i].waste);
            dataExistType.push(arrayExistType);
            var countData = 0;
            for (var j = 0; j < arrayExistType.length; j++) {
                countData += arrayExistType[j];
            }
            dataTable +=
                '<li onClick="clickDate(' + i +
                ')" class = "list-group-item d-flex justify-content-between align-content-center" ><div class = "d-flex flex-row" ><img src = "https://img.icons8.com/ios/100/000000/calendar--v1.png" width = "40" / ><div class = "ml-2" ><h6 class = "mb-0">';
            dataTable += obj.DataTanggal[i].Tanggal.split("-").reverse().join("/");
            dateAll.push(obj.DataTanggal[i].Tanggal);
            dataTable += '</h6><div class="about"><span>';
            // dataTable += "22 Files";
            dataTable += countData;
            dataTable += " Data";
            dataTable += '</span></div>';
            dataTable += "</div></div></li>";
        }
        // console.log(dataTable);
        document.getElementById('showAllTanggal').innerHTML = dataTable;
    }

    function getDataOnAllDate() {
        $.ajax({
            url: "{{ url('getAllDate/') }}" + '/' + "{{ session('idOutlet') }}", 
            type: 'get',
            success: function(response) {
                // break;
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                showListOnAllDate(obj);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }
    $(document).ready(function() {
        getDataOnAllDate();
        // showListOnAllDate();
    });
</script>

</html>
