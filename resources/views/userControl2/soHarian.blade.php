<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>SO Harian Edit</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap');

        .header {
            height: 50px;
            background: #B20731;
        }

        .imageBack {
            height: 15px;
        }

        .menuAll {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 10px;
        }

        h4 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #FFFFFF;
        }

        .laporanMenu {
            margin-top: 4px;
        }

        .imageProfile {
            border-radius: 32px;
            height: 32px;
            width: 32px;
        }

        .containerTop {
            margin-top: 100px;
            content: "";
            height: 50px;
        }

        /* .menuSel::before{
            content: "";
            background-color: white;
            height: 35px;
            width: 25px;
            display: flex;
            margin-top: 8px;
        } */
        .col {
            text-align: center;
            vertical-align: middle;
        }

        .headerTop {
            background-color: #B20731;
            border-radius: 8px;
            width: 350px;
        }

        .menuSel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Main color/Red/50 */

            /* color: #B20731; */
            color: #B20731;
            z-index: 0;
        }

        .menuSel::before {
            content: "";
            position: absolute;
            width: 75px;
            height: 40px;
            margin-top: -10px;
            margin-left: -25px;
            z-index: -1;
            /* Greyscale/10 */

            background: #FFFFFF;
            /* shadow/Very Soft */

            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 8px;
        }

        .menuNotSel {
            /* Semibold/SM */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Greyscale/10 */

            color: #FFFFFF;
            cursor: pointer;
        }

        .containerBottom {
            margin-top: 75px;
            /* height: 500px; */

            background: #FCFBFB;
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.1), 0px -2.22px 11.1008px -1.11008px rgba(50, 50, 71, 0.08);
            border-radius: 32px;
        }

        h3 {
            /* Semibold/Large */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            /* identical to box height, or 28px */

            display: flex;
            align-items: center;
            text-align: center;

        }

        .imgSo {
            border-right: none;
            background-color: white;
        }

        .imgSo::after {
            content: "";
            width: 1.5px;
            height: 20px;
            position: absolute;
            left: 38px;
            background-color: #9C9C9C;
        }

        .inputSo {
            border-left: none;
            border-right: none;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            color: #BEBEBE;
        }

        .inputSo::placeholder {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            color: #BEBEBE;
        }

        label {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 17px;
            line-height: 140%;
            /* identical to box height, or 20px */
            margin-top: 10px;

            color: #000000;
        }

        .unitSo {
            border-left: none;
            background-color: white;

            /* Semibold/SM */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Greyscale/30 */

            color: #BEBEBE;

        }

        .input-so {
            margin-top: 10px;
        }

        .btn {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* or 22px */
            color: #FFFFFF;
            background: #B20731;
            border-radius: 6px;
            width: 96px;
            height: 44px;
            margin-top: 50px;
            float: right;
        }
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <div class="row">
                <div class="col-2" data-toggle="modal" data-target="#exampleModal" onclick="goToDashboard();">
                    <img src="{{ url('img/back.png') }}" alt="back icon" class="imageBack">
                </div>
                <div class="col">
                    <h4 class="laporanMenu">Laporan Harian</h4>
                </div>
            </div>
            <div>
                <img src="{{ url('img/dashboard/userIcon.jpg') }}" alt="user icon" class="imageProfile">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center containerTop">
        <div class="row headerTop">
            <div class="col menuSel" style="margin-top: 15px" onclick="goToSoHarian();">SO</div>
            <div class="col menuNotSel" style="margin-top: 15px" onclick="goToSalesHarian();">Sales</div>
            <div class="col menuNotSel" style="margin-top: 15px" onclick="goToWasteHarian();">Waste</div>
            <div class="col menuNotSel" style="margin-top: 5px" onclick="goToPattyCashHarian();">Patty Cash</div>
        </div>
    </div>
    <div class="d-flex justify-content-start containerBottom">
        <div class="container" style="margin-left: 5px;margin-right: 10px">
            <h3 id="dateSelected" style="margin-top: 18px">Selasa, 1 November</h3>
            <h3 style="margin-top: 20px">Laporan SO</h3>
            <div id="groupAddItem"></div>
            <button type="button" class="btn" onclick="searchAllEdit()">Simpan</button>
            <div style="content: ''; height: 125px"></div>
        </div>
    </div>
</body>
<script>
    var dataId = [];
    var idSo = 0;
    var dateSelected = "{{ $dateSelect }}";
    var tempDataEdit = []; //idIndexOnElementInput, idSoFill, qty
    var dataAllEdit = []; //idSoFill,qty

    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];


    $(document).ready(function() {
        var day = new Date(dateSelected);
        var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day.getMonth()];
        // console.log(stringDay);
        // console.log(day.getDay());
        document.getElementById('dateSelected').innerHTML = stringDay;


        dataId.length = 0;
        showItemOutlet("{{ session('idOutlet') }}");
        console.log("{{ $dateSelect }}");
    });

    function goToSoHarian(){
        window.location.href = "{{ url('user/soHarian') }}" + '/' + dateSelected;
    }

    function goToSalesHarian(){
        window.location.href = "{{ url('user/salesHarian') }}" + '/' + dateSelected;
    }

    function goToWasteHarian(){
        window.location.href = "{{ url('user/wasteHarian') }}" + '/' + dateSelected;
    }

    function goToPattyCashHarian(){
        window.location.href = "{{ url('user/pattyCashHarian') }}" + '/' + dateSelected;
    }

    function goToDashboard() {
        window.location.href = "{{ url('user/dashboard') }}";
    }

    function getDataFillSo() {
        $.ajax({
            url: '{{ url('soHarian/user/showDetail') }}' + '/' + "{{ session('idOutlet') }}" + '/' +
                "{{ $dateSelect }}",
            type: 'get',
            success: function(response) {
                var elementInput = document.getElementsByName("addname");
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                tempDataEdit.length = 0;
                for (var i = 0; i < obj.itemfso.length; i++) {
                    // contentSo += '<h6>' + obj.itemfso[i]['qty'] + '</h6>';
                    // elementInput[searchIndexSoItem(obj.itemfso[i].idItem)].value = obj.itemfso[i].qty;
                    if (searchIndexSoItem(obj.itemfso[i].idItem)[0] == true) {
                        elementInput[searchIndexSoItem(obj.itemfso[i].idItem)[1]].value = obj.itemfso[i]
                            .qty;
                        tempDataEdit.push([searchIndexSoItem(obj.itemfso[i].idItem)[1], obj.itemfso[i]
                            .idSoFill, obj.itemfso[i].qty
                        ]);
                    }
                }
                console.log(tempDataEdit);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function searchAllEdit() {
        dataAllEdit.length = 0;
        var elementInput = document.getElementsByName("addname");
        for (var i = 0; i < tempDataEdit.length; i++) {
            var getValueElement = elementInput[tempDataEdit[i][0]].value;
            if (getValueElement != tempDataEdit[i][2]) {
                console.log(getValueElement);
                $.ajax({
                    url: '{{ url('soHarian/edit/data/') }}' + '/' + tempDataEdit[i][1],
                    type: 'get',
                    data: {
                        quantityRevisi: getValueElement
                    },
                    success: function(response) {
                    },
                    error: function(req, err) {
                        console.log(err);
                        // return 0
                    }
                });
            }
        }
        // goToDashboard();
        // window.location.href = "{{ url('user/detail/soHarian') }}" + '/' + dateSelected;
        sendAddData();
    }

    function searchIndexSoItem(idItem) {
        var idIndex = 0;
        var foundItem = false;
        for (var i = 0; i < dataId.length; i++) {
            if (dataId[i] == idItem) {
                idIndex = i;
                foundItem = true;
                break;
            }
        }
        return [foundItem, idIndex];
    }

    function sendDataToServer(idSo2) {
        var elementInput = document.getElementsByName("addname");
        // console.log(elementInput[0].value);
        // console.log(elementInput.length);
        for (var i = 0; i < (elementInput.length * 5); i++) {
            var isSuccess = false;
            var indexIteration = i % elementInput.length;
            if (elementInput[indexIteration].value == '') {
                continue;
            } else {
                $.ajax({
                    url: "{{ url('soHarian/store/data') }}",
                    type: 'get',
                    data: {
                        idSo: idSo2,
                        idItemSo: dataId[indexIteration],
                        quantity: elementInput[indexIteration].value
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
        }
        // goToDashboard();
        window.location.href = "{{ url('user/detail/soHarian') }}" + '/' + dateSelected;
    }

    function sendAddData() {
        $.ajax({
            url: "{{ url('soHarian/date/getId') }}",
            type: 'get',
            data: {
                tanggal: "{{ $dateSelect }}",
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

    function showItemOutlet(id) {
        dataId.length = 0;
        $.ajax({
            url: "{{ url('listType/soHarian/show/item/outlet/') }}" + '/' + id,
            type: 'get',
            success: function(response) {
                var order_data = '';
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                for (var i = 0; i < obj.DataItem.length; i++) {
                    var urlImage = '{{ url('img/soImage') }}' + '/' + obj.DataItem[i]['icon'];
                    dataId.push(obj.DataItem[i]['id']);
                    order_data += '<div class="input-so">';
                    order_data += '<label>' + obj.DataItem[i]['Item'] + '</label>';
                    order_data +=
                        '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text imgSo">';
                    order_data += '<img src="' + urlImage + '"' +
                        'alt="" style="height: 22px;margin-left:-5px"></span>';
                    order_data +=
                        '</div><input type="number" class="form-control inputSo" name="addname" placeholder="0">';
                    order_data +=
                        '<div class="input-group-append"><span class="input-group-text unitSo">';
                    order_data += obj.DataItem[i]['satuan'];
                    order_data += '</span></div></div></div>'
                }
                // document.getElementById('dateAdd').
                $('#groupAddItem').empty().append(order_data);
                getDataFillSo();
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }
</script>

</html>
