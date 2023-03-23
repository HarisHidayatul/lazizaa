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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.min.js"></script>

    <title>Sales Harian</title>
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
        .col-middle {
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
            margin-left: -20px;
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
            text-align: center;
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

        h2 {

            /* Semibold/Large */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
        }

        h5 {

            /* Semibold/SM */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
        }

        h6 {

            /* Regular/XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 500;
            font-size: 14px;
            line-height: 15px;
            /* identical to box height */


            /* Main color/Red/50 */

            color: #B20731;

        }

        h7 {

            /* Semibold/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 140%;
            /* or 22px */


            /* Main color/Red/50 */

            color: #B20731;

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
            /* margin-top: 50px; */
            float: right;
        }

        input {
            background: #FFFFFF;
            /* Greyscale/20 */

            border: 1px solid #E0E0E0;
            border-radius: 8px;
            height: 40px;

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 13.4367px;
            line-height: 140%;
            /* identical to box height, or 19px */


            /* Greyscale/20 */

            /* color: #E0E0E0; */

            padding-left: 15px;
        }

        .typeSales {
            margin-top: 25px;
        }

        .rowSales {
            margin-top: 25px;
            width: 100%;
        }

        .inputCU {
            width: 37vw;
            max-width: 220px;
        }

        .inputTotal {
            width: 100%;
        }

        .totalRp::before {
            content: 'Rp. ';
            position: absolute;
            left: 58%;
        }

        input[type='number']:focus {
            border: 1.0663px solid #B20731;
            box-shadow: 0px 0px 0.394561px rgba(12, 26, 75, 0.24), 0px 1.18368px 3.15649px -0.394561px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
        }

        .requestItem {

            /* Semibold/XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            margin-top: 15px;
            /* identical to box height */


            /* Main color/Red/50 */
            color: #B20731;

            cursor: pointer;
        }

        .wrapSesi {
            margin-top: 50px;
            /* margin-bottom: 10px; */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
        }

        .wrapSesi div {
            cursor: pointer;
            width: 120px;
            text-align: center;
            padding-bottom: 5px;
        }

        .sesiActive {
            color: #000000;
            border-bottom: 3px solid #B20731;
        }

        .sesiNonActive {
            color: #BEBEBE;
            border-bottom: 1px solid #E0E0E0;
        }

        .sesiNonActive:hover {
            border-bottom: 1px solid #B20731;
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
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <div class="row">
                <div class="col-2 col-middle" data-toggle="modal" data-target="#exampleModal"
                    onclick="goToDashboard();">
                    <img src="{{ url('img/back.png') }}" alt="back icon" class="imageBack">
                </div>
                <div class="col col-middle">
                    <h4 class="laporanMenu">Laporan harian</h4>
                </div>
            </div>
            <div>
                <img src="{{ url('img/dashboard/userIcon.jpg') }}" alt="user icon" class="imageProfile">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center containerTop">
        <div class="row headerTop">
            <div class="col menuNotSel" style="margin-top: 15px;margin-left: 10px" onclick="goToSoHarian();">SO</div>
            <div class="col menuSel" style="margin-top: 15px" onclick="goToSalesHarian();">Sales</div>
            <div class="col menuNotSel" style="margin-top: 15px" onclick="goToWasteHarian();">Waste</div>
            <div class="col menuNotSel" style="margin-top: 5px" onclick="goToPattyCashHarian();">Pembeli an</div>
        </div>
    </div>
    <div class="d-flex justify-content-center containerBottom">
        <div class="container" style="margin-left: 5px;margin-right: 10px">
            <h3 id="dateSelected" style="margin-top: 18px">Selasa, 1 November</h3>
            <div class="d-flex justify-content-center wrapSesi">
                <div name="sesi" class="sesiActive" onclick="changeSesi(0)">Sesi 1</div>
                <div name="sesi" class="sesiNonActive" onclick="changeSesi(1)">Sesi 2</div>
                {{-- <div name="sesi" class="sesiNonActive" onclick="changeSesi(2)">Sesi 3</div> --}}
            </div>
            {{-- <div style="content: ''; height: 30px"></div> --}}
            <h2 class="typeSales">Total Sales</h2>
            <input class="inputTotal" placeholder="Total Reading Sales" id="totalReadingCasheer"
                onchange="sumValueInput()">
            <h2 class="typeSales">Sales Non Tunai</h2>
            <div id="fillDataSales"></div>
            <div style="margin-top: 45px;">
                <div class="d-flex justify-content-between">
                    <h6>Total Sales</h6>
                    <h6 class="totalRp" id="totalSalesDisplay">0</h6>
                </div>
                <div id="bottomFill"></div>
                <div style="content: ''; border: 1px solid #B20731; margin-bottom: 15px;"></div>
                <div class="d-flex justify-content-between">
                    <h7>Total Disetorkan</h7>
                    <h7 id="totalALL">Rp. 0</h7>
                </div>
            </div>
            <div style="content: ''; height: 55px"></div>
            <div class="row">
                <div class="col-6 requestItem" onclick="goToRequestItem();">Requset Item?</div>
                <div class="col-6">
                    <button type="button" class="btn" onclick="submitSalesHarian();">Simpan</button>
                </div>
            </div>
            <div style="content: ''; height: 125px"></div>
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
            <div class="footerLaporta"><span style="font-size: 16px; margin-top: 5px;">&#169;</span> 2022 - Laporta
            </div>
        </div>
    </div>
</body>
<script>
    var dataIdType = [];
    var dataIdItem = [];

    var dataIdItemEdit = [];
    var dataTotalEdit = [];
    var dataSalesEdit = [];

    var nameIdType = [];
    var nameIdItem = [];

    var totalDataTable = [];

    var valueTotalAll = [];
    var idSales = 0;

    var row = 0;

    var selectedSesi = 1;

    var dateSelected = "{{ $dateSelect }}";

    var totalReadingCasheer = new AutoNumeric('#totalReadingCasheer', {
        decimalPlaces: '0'
    });


    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

    function goToSoHarian() {
        window.location.href = "{{ url('user/soHarian') }}" + '/' + dateSelected;
    }

    function goToSalesHarian() {
        window.location.href = "{{ url('user/salesHarian') }}" + '/' + dateSelected;
    }

    function goToWasteHarian() {
        window.location.href = "{{ url('user/wasteHarian') }}" + '/' + dateSelected;
    }

    function goToPattyCashHarian() {
        window.location.href = "{{ url('user/pattyCashHarian') }}" + '/' + dateSelected;
    }

    function goToRequestItem() {
        window.location.href = "{{ url('user/request/salesHarian') }}" + '/' + dateSelected;
    }

    $(document).ready(function() {
        var day = new Date(dateSelected);
        var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day.getMonth()];
        // console.log(stringDay);
        // console.log(day.getDay());
        document.getElementById('dateSelected').innerHTML = stringDay;
        getListAllType();

    });

    function changeSesi(index) {
        var sesiElement = document.getElementsByName('sesi');
        selectedSesi = index + 1;
        for (var i = 0; i < sesiElement.length; i++) {
            if (i == index) {
                sesiElement[i].classList.add("sesiActive");
                sesiElement[i].classList.remove("sesiNonActive");
            } else {
                sesiElement[i].classList.add("sesiNonActive");
                sesiElement[i].classList.remove("sesiActive");
            }
        }
        getAllData();
    }

    function getAllData() {
        clearAllData();
        $.ajax({
            url: "{{ url('salesHarian/user/showTable/') }}" + '/' + "{{ session('idOutlet') }}" + '/' +
                dateSelected + '/' + selectedSesi,
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                totalReadingCasheer.set(obj.totalManual);
                for (var i = 0; i < obj.itemSales[0]?.Item.length; i++) {
                    for (var j = 0; j < dataIdItem.length; j++) {
                        if (obj.itemSales[0].Item[i].idListSales == dataIdItem[j]) {
                            var idRow = 'r' + j;

                            dataIdItemEdit.push(obj.itemSales[0].Item[i].idListSales);
                            dataTotalEdit.push(obj.itemSales[0].Item[i].totalQty);
                            dataSalesEdit.push(obj.itemSales[0].Item[i].idSalesFill);

                            valueTotalAll[j].set(obj.itemSales[0].Item[i].totalQty);
                            // document.getElementById(idRow + 'c1').value = obj.itemSales[0].Item[i].totalQty;
                        }
                        // console.log("Tessss");
                    }
                }
                sumValueInput();
                // dataIdItem
            },
            error: function(req, err) {
                console.log(err);
                clearAllData();
            }
        });
    }

    function clearAllData() {
        dataIdItemEdit.length = 0;
        dataTotalEdit.length = 0;
        dataSalesEdit.length = 0;

        for (var i = 0; i < valueTotalAll.length; i++) {
            var idRow = 'r' + i;
            valueTotalAll[i].set('');
        }
    }

    function submitSalesHarian() {
        if (totalReadingCasheer.rawValue != 0) {
            $.ajax({
                url: "{{ url('salesHarian/data/getId') }}",
                type: 'get',
                data: {
                    // tanggal: document.getElementById('dateAdd').value,
                    tanggal: dateSelected,
                    idOutlet: "{{ session('idOutlet') }}",
                    idSesi: selectedSesi,
                    totalManual: parseInt(totalReadingCasheer.rawValue)
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
    }

    function sendDataToServer(idSaless) {
        for (var j = 0; j < 5; j++) { //ulangin kirim sebanyak lima kali
            for (var i = 0; i < dataIdItem.length; i++) {
                // var elementIDSendRow1 = document.getElementById('r' + i + 'c1').value;
                var elementIDSendRow1 = parseInt(valueTotalAll[i].rawValue);
                var idListSales = dataIdItem[i];
                if (elementIDSendRow1 == '') {
                    continue;
                }

                $.ajax({
                    url: "{{ url('salesHarian/store/data') }}",
                    type: 'get',
                    data: {
                        idSales: idSaless,
                        idListSales: idListSales,
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
        for (var k = 0; k < 5; k++) {
            for (var i = 0; i < dataIdItemEdit.length; i++) {
                for (var j = 0; j < dataIdItem.length; j++) {
                    if (dataIdItemEdit[i] == dataIdItem[j]) {
                        var idRow = 'r' + j;
                        var valTotalInput = valueTotalAll[j].rawValue;
                        if (valTotalInput != dataTotalEdit[i]) {
                            $.ajax({
                                url: "{{ url('salesHarian/edit/total/data/') }}" + "/" + dataSalesEdit[i],
                                type: 'get',
                                data: {
                                    totalRevisi: valTotalInput,
                                    idPengisi: "{{ session('idPengisi') }}"
                                },
                                success: function(response) {

                                },
                                error: function(req, err) {
                                    console.log(err);
                                    // return 0
                                }
                            });
                        }
                        // dataIdItemEdit.push(obj.itemSales[0].Item[i].idListSales);
                        // dataTotalEdit.push(obj.itemSales[0].Item[i].totalQty);

                        // valueTotalAll[j].set(obj.itemSales[0].Item[i].totalQty);
                    }
                    // console.log("Tessss");
                }
            }
        }
        // goToDashboard();
        window.location.href = "{{ url('user/detail/salesHarian') }}" + '/' + dateSelected + '/' + selectedSesi;
    }

    function goToDashboard() {
        window.location.href = "{{ url('user/dashboard') }}";
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
                console.log(obj);
                var dataTable = '';
                row = 0;
                valueTotalAll.length = 0;
                var inputFill = '';
                var bottomFill = '';
                for (var i = 0; i < dataIdType.length; i++) {
                    var dataFound = false;
                    for (var j = 0; j < obj.listSales.length; j++) {
                        if (dataIdType[i] == obj.listSales[j].typeSales) {
                            dataFound = true;
                            break;
                        }
                    }
                    if (dataFound) {
                        inputFill += '<div>';
                        // inputFill += '<h2 class="typeSales">' + nameIdType[i] + '</h2>';
                        for (var j = 0; j < obj.listSales.length; j++) {
                            if (dataIdType[i] == obj.listSales[j].typeSales) {
                                dataIdItem.push(obj.listSales[j].id);
                                nameIdItem.push(obj.listSales[j].sales);
                                inputFill += '<div class="rowSales"><div>';
                                inputFill += '<h5>' + obj.listSales[j].sales + '</h5>';
                                inputFill += '</div><div>';
                                inputFill += '<input class="inputTotal" id="r' + row +
                                    'c1" placeholder="0" onchange="sumValueInput()">';
                                inputFill += '</div></div>';

                                bottomFill += '<div class="d-flex justify-content-between">';
                                bottomFill += '<h6>' + obj.listSales[j].sales + '</h6>';

                                bottomFill += '<h6 class="totalRp">-<span id="t' + row + '">0</span></h6>';
                                bottomFill += '</div>';

                                row++;
                            }
                        }
                        inputFill += '</div>';
                    }
                }
                document.getElementById('fillDataSales').innerHTML = inputFill;
                document.getElementById('bottomFill').innerHTML = bottomFill;
                for (var i = 0; i < row; i++) {
                    var idRow = '#r' + i + 'c1';
                    valueTotalAll.push(new AutoNumeric(idRow, {
                        decimalPlaces: '0'
                    }));
                }
                getAllData();
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function sumValueInput() {
        var totalSum = 0;
        totalSum = parseInt(totalReadingCasheer.rawValue);
        var sumData = 0;
        for (var i = 0; i < dataIdItem.length; i++) {
            var idInput = 'r' + i + 'c1';
            if (document.getElementById(idInput).value != '') {
                // sumData += parseInt(document.getElementById(idInput).value);
                sumData += parseInt(valueTotalAll[i].rawValue);
                // sumData += valueTotalAll[i].rawValue;
            }
        }
        totalSum = totalSum - sumData;
        document.getElementById('totalALL').innerHTML = 'Rp. ' + parseInt(totalSum).toLocaleString();
        document.getElementById('totalSalesDisplay').innerHTML = parseInt(totalReadingCasheer.rawValue).toLocaleString();
        // console.log(sumData);
        copyInputToText();
    }

    function copyInputToText() {
        for (var i = 0; i < row; i++) {
            var idTotal = 'r' + i + 'c1';
            var idBottomTotal = 't' + i;
            var valueIdTotal = 0;
            if (document.getElementById(idTotal).value != '') {
                valueIdTotal = document.getElementById(idTotal).value;
            }
            document.getElementById(idBottomTotal).innerHTML = valueIdTotal.toLocaleString().replace(',', '.');
        }
    }
</script>

</html>
