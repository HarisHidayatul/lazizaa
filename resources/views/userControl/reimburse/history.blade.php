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
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

        .headerMenuTop {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            color: #FFFFFF;
        }

        .headerMenuTop img {
            height: 13px;
        }

        .tittle {
            margin-top: 30px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            /* or 22px */
            text-align: center;
            color: #FFFFFF;
        }

        .priceTittle {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            line-height: 120%;
            align-items: center;
            text-align: center;
            color: #FFFFFF;
        }

        .detailTittle {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            color: #585858;
            margin-top: 10px;
        }

        .detailPrice {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
        }

        .wrapSortDate {
            margin-top: 50px;
            display: flex;
            width: 95vw;
            max-width: 400px;
            overflow: auto;
        }

        .wrapSortDate div {
            /* overflow: hidden; */
            width: 100px;
            height: 31px;
            white-space: nowrap;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            text-align: center;
            padding-top: 6px;
            color: #B20731;
            background: #FFEAEF;
            border-radius: 100px;
            margin-right: 10px;
        }

        .wrapSortDate .active {
            background: #B20731;
            font-weight: 600;
            color: #FFFFFF;
        }

        .historyTransaksiLabel {
            margin-top: 40px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }

        .dateTransaksi {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #6B7280;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .wrapPembelianImg {
            width: 48px;
            height: 48px;
            background: #F9FAFB;
            border-radius: 12px;
        }

        .labelItemTransaksi {
            margin-top: 8px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
        }

        .statusItemTransaksi {
            height: 15px;
            margin-top: 10px;
            margin-left: 10px;
        }

        .labelQtyTransaksi {
            margin-top: 1px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            color: #BEBEBE;
        }

        .labelValuePembelian {
            margin-top: 9px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #B20731;
        }

        .activeValPembelian {
            color: #008000;
        }

        .pendingValPembelian {
            color: #585858;
        }

        .labelValuePattyCash {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            color: #585858;
            text-align: right;
        }

        .wrapPattyCash {
            margin-top: 15px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #F3F4F6;
        }

        /* calendar */
        .dateSelect {
            /* position: relative; */
            /* z-index: 1; */
            color: white;
        }

        .dateSelect::before {
            content: "";
            background: #b20732;

            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 6px;

            height: 30px;
            width: 30px;
            color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .dateBetween::before{
            content: "";
            /* background: #a7b207; */

            box-shadow: 0px 0px 0.479222px rgba(12, 26, 75, 0.24), 0px 1.43767px 3.83378px -0.479222px rgba(50, 50, 71, 0.05);
            border-radius: 6px;
            border: 1px solid #B20731;

            height: 30px;
            width: 30px;
            color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        td {
            cursor: pointer;
            padding: 0 1.7vw;
            position: relative;
        }

        td:hover {
            color: white;
        }

        td:hover::after {
            content: "";
            background: #afafaf;

            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 6px;

            height: 30px;
            width: 30px;
            color: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .dateNow::before {
            content: "";
            background: #B20731;
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 1.5px;
            height: 5px;
            width: 5px;
            color: #B20731;
            position: absolute;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
        }

        .mainTable {
            text-align: center;
            vertical-align: middle;
            /* Semibold/base */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 0.9rem;
            line-height: 4.5vh;
            border-spacing: 100px 0;
        }

        .beforeAfterDate {
            color: #E0E0E0;
        }

        .previousNext {
            text-align: center;
            vertical-align: middle;
            /* Semibold/base */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 0.9rem;
            line-height: 4.5vh;
        }

        h3 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            font-size: 20px;
            line-height: 120%;
            /* identical to box height, or 24px */

            /* display: flex; */
            align-items: center;
            text-align: center;
            margin-top: 5px;
        }

        .pilihTanggal {
            margin-left: 10px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
            margin-bottom: 5px;
        }

        .wrapSelectTanggal {
            height: 42px;
            border: 1px solid #E0E0E0;
            border-radius: 12px;
        }

        .dateKirimLbl {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
            margin-left: 8px;
        }

        .calendarLayout {
            /* shadow/Hard */
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.1), 0px 11.1008px 13.3209px rgba(20, 37, 63, 0.06);
            border-radius: 6.90722px;
            position: absolute;
            top: 575px;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 500px;
            width: 100vw;
            background: white;
        }

        .buttonNonActive {
            background: #FFEAEF;
            color: #B20731;
        }

        button {
            /* width: 100%; */
            height: 40px;
            background: #B20731;
            border-radius: 8px;
            border: none;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            text-align: center;
            color: #FFFFFF;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center">
        <div style="max-width: 400px;">
            <img src="{{ url('img/reimburse/reimburseHistory.png') }}" alt="" style="width: 100%;">
            <div onclick="goBack();" class="d-flex justify-content-start headerMenuTop"
                style="margin-top: -180px; margin-left: 30px;">
                <img src="{{ url('img/icon/backLeft.png') }}" alt="">
                <div style="margin-left: 10px;">Kembali</div>
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <div class="tittle">Saldo Patty Cash</div>
                    <div class="d-flex justify-content-center">
                        <div class="d-flex justify-content-start">
                            <div class="priceTittle" id="totalPattyCash">Rp 0</div>
                            <div onclick="refreshPattyCash();">
                                <i class="fa fa-refresh" style="color: white; cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                    {{-- <div style="height: 70px;"></div> --}}
                    <div style="margin-top: 30px;">
                        <img src="{{ url('img/reimburse/reimburseStat.png') }}" alt="" style="width: 320px;">
                        <div class="d-flex justify-content-between" style="margin-top: -70px;">
                            <div style="margin-left: 47px;">
                                <div class="detailTittle">Reimburse</div>
                                <div class="detailPrice" id="totalReimburse">+ Rp 0</div>
                            </div>
                            <div style="margin-right: 40px;">
                                <div class="detailTittle">Pembelian</div>
                                <div class="detailPrice" id="totalPembelian">- Rp 0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <div class="wrapSortDate">
                        <div name="sortHistory" style="flex: 0 0 67px;" class="active" onclick="getAllHistory(0)">Hari
                            ini</div>
                        {{-- <div name="sortHistory" style="flex: 0 0 129px;" onclick="getAllHistory(1)">1 Minggu Terakhir
                        </div>
                        <div name="sortHistory" style="flex: 0 0 117px;" onclick="getAllHistory(2)">30 Hari Terakhir
                        </div>
                        <div name="sortHistory" style="flex: 0 0 67px;" onclick="getAllHistory(3)">Semua</div> --}}
                        <div name="sortHistory" style="flex: 0 0 85px;" onclick="getAllHistory(1)">Bulan Ini
                        </div>
                        <div name="sortHistory" style="flex: 0 0 200px;" onclick="calendarLayoutShow()"
                            id="dateKirimLbl">
                            01/10/2023 - 06/10/2023
                        </div>
                    </div>
                    <div class="calendarLayout" id="calendarLayout">
                        <div class="d-flex justify-content-center">
                            <div style="margin-right: 40px;">
                                <div class="previousNext" onclick="previous(0)">&#10094;</div>
                            </div>
                            <div>
                                <h3 id="monthAndYear"></h3>
                            </div>
                            <div style="margin-left: 40px;">
                                <div class="previousNext" onclick="next(0)">&#10095;</div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <table class="mainTable" id="calendar">
                                <thead>
                                    <tr>
                                        <td>Sen</td>
                                        <td>Sel</td>
                                        <td>Rab</td>
                                        <td>Kam</td>
                                        <td>Jum</td>
                                        <td>Sab</td>
                                        <td>Min</td>
                                    </tr>
                                </thead>
                                <tbody id="calendar-body">
                                </tbody>
                            </table>
                        </div>
                        <div style="height: 20px;"></div>
                        <div class="d-flex justify-content-center">
                            <button class="buttonNonActive" style="width: 30vw; margin-right: 3vw;"
                                onclick="calendarLayoutHide();">Batal</button>
                            <button style="width: 30vw;" onclick="terapkanCalendar();">Terapkan</button>
                        </div>
                        <div style="height: 20px;"></div>
                    </div>
                    {{-- <div style="margin-top: 20px;"></div> --}}
                    <div class="historyTransaksiLabel">History Transaksi</div>
                    {{-- <div class="dateTransaksi">1 November</div>
                    <div class="d-flex justify-content-between wrapPattyCash">
                        <div class="d-flex justify-content-start">
                            <div class="wrapPembelianImg d-flex justify-content-center align-items-center">
                                <img src="{{ url('img/dashboard/laporanPembelian.png') }}" alt=""
                                    style="height: 22px;">
                            </div>
                            <div style="margin-left: 15px;">
                                <div class="d-flex justify-content-start">
                                    <div class="labelItemTransaksi">Beras</div>
                                </div>
                                <div class="labelQtyTransaksi">5000 gr</div>
                            </div>
                        </div>
                        <div style="margin-right: 10px;">
                            <div class="labelValuePembelian">- Rp 59.000</div>
                            <div class="labelValuePattyCash">Rp 472.000</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between wrapPattyCash">
                        <div class="d-flex justify-content-start">
                            <div class="wrapPembelianImg d-flex justify-content-center align-items-center">
                                <img src="{{ url('img/dashboard/laporanPembelian.png') }}" alt=""
                                    style="height: 22px;">
                            </div>
                            <div style="margin-left: 15px;">
                                <div class="d-flex justify-content-start">
                                    <div class="labelItemTransaksi">Minyak Goreng</div>
                                </div>
                                <div class="labelQtyTransaksi">5000 ml</div>
                            </div>
                        </div>
                        <div style="margin-right: 10px;">
                            <div class="labelValuePembelian">- Rp 59.000</div>
                            <div class="labelValuePattyCash">Rp 531.000</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between wrapPattyCash">
                        <div class="d-flex justify-content-start">
                            <div class="wrapPembelianImg d-flex justify-content-center align-items-center">
                                <img src="{{ url('img/dashboard/laporanPembelian.png') }}" alt=""
                                    style="height: 22px;">
                            </div>
                            <div style="margin-left: 15px;">
                                <div class="d-flex justify-content-start">
                                    <div class="labelItemTransaksi">Reimburse</div>
                                    <img class="statusItemTransaksi" src="{{ url('img/icon/pending.png') }}"
                                        alt="">
                                </div>
                                <div class="labelQtyTransaksi">5000 gr</div>
                            </div>
                        </div>
                        <div style="margin-right: 10px;">
                            <div class="labelValuePembelian activeValPembelian">+ Rp 59.000</div>
                            <div class="labelValuePattyCash">Rp 472.000</div>
                        </div>
                    </div> --}}
                    <div id="historyAll"></div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 1000px;"></div>
</body>
<script>
    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    let dateSelect = today.getDate();

    let dateSelectBefore = new Date();

    let dateSelectAfter = new Date();

    var boolSelectDate = true; //jika true, pilih tanggal sebelum, jika false, pilih tanggal sesudah

    showCalendar(currentMonth, currentYear);

    $(document).ready(function() {
        calendarLayoutHide();
        getAllHistory(0);
    })

    function goBack() {
        window.location.href = "{{ url('user/dashboard') }}";
    }

    function calendarLayoutShow() {
        document.getElementById('calendarLayout').style.visibility = "visible";
    }

    function calendarLayoutHide() {
        document.getElementById('calendarLayout').style.visibility = "hidden";
    }

    function getAllHistory(index) {
        var accessHistory = '';
        var element = document.getElementsByName("sortHistory");
        var stringDateSelectBefore = dateSelectBefore.getFullYear() + '-' ;
        if((dateSelectBefore.getMonth()+1)<10){
            stringDateSelectBefore += '0';
        }
        stringDateSelectBefore += (dateSelectBefore.getMonth()+1) + '-' ;
        if(dateSelectBefore.getDate() < 10){
            stringDateSelectBefore += '0';
        }
        stringDateSelectBefore += dateSelectBefore.getDate();

        var stringDateSelectAfter = dateSelectAfter.getFullYear() + '-' ;
        if((dateSelectAfter.getMonth()+1)<10){
            stringDateSelectAfter += '0';
        }
        stringDateSelectAfter += (dateSelectAfter.getMonth()+1) + '-' ;
        if(dateSelectAfter.getDate() < 10){
            stringDateSelectAfter += '0';
        }
        stringDateSelectAfter += dateSelectAfter.getDate();

        for (var i = 0; i < element.length; i++) {
            if (i == index) {
                element[i].classList.add("active");
                continue;
            }
            element[i].classList.remove("active");
        }
        if (index == 0) {
            accessHistory = 'today';
        } else if (index == 1) {
            accessHistory = '30day';
        } else if (index == 2) {
            accessHistory = 'between';
        }
        $.ajax({
            url: "{{ url('reimburse/show/history/outlet') }}" + '/' + "{{ session('idOutlet') }}" + '/' +
                accessHistory + '/'+ stringDateSelectBefore + '/' + stringDateSelectAfter,
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                var historyAll = "";
                var imgLaporanPembelian = "{{ url('img/dashboard/laporanPembelian.png') }}";
                var imgPending = "{{ url('img/icon/pending.png') }}";
                console.log(obj);
                obj = obj.allData[0];
                var totalReimburse = 0;
                var totalPembelian = 0;
                var totalPattyCash = parseInt(obj.saldoPattyCash);

                for (var i = 0; i < obj.dataHistory.length; i++) {
                    var day = new Date(obj.dataHistory[i].tanggal);
                    var stringDay = day.getDate() + ' ' + months[day.getMonth()];
                    var dataFound = false;

                    var historyToday = '<div class="dateTransaksi">' + stringDay + '</div>';
                    for (var j = 0; j < obj.dataHistory[i].pattyCash.length; j++) {
                        dataFound = true;
                        historyToday +=
                            '<div class="d-flex justify-content-between wrapPattyCash" onClick="goToDetailPattyCash(' +
                            "'" +
                            obj.dataHistory[i].tanggal + "'" +
                            ')">';
                        historyToday += '<div class="d-flex justify-content-start">';
                        historyToday +=
                            '<div class="wrapPembelianImg d-flex justify-content-center align-items-center">';
                        historyToday += '<img src="' + imgLaporanPembelian +
                            '" alt="" style="height: 22px;">';
                        historyToday += '</div><div style="margin-left: 15px;">';
                        historyToday +=
                            '<div class="d-flex justify-content-start"><div class="labelItemTransaksi">';
                        historyToday += obj.dataHistory[i].pattyCash[j].item;
                        historyToday += '</div></div><div class="labelQtyTransaksi">';
                        historyToday += obj.dataHistory[i].pattyCash[j].qty + " ";
                        historyToday += obj.dataHistory[i].pattyCash[j].satuan;
                        historyToday += '</div></div></div>';
                        historyToday +=
                            '<div style="margin-right: 10px;"><div class="labelValuePembelian">- Rp ';
                        historyToday += parseInt(obj.dataHistory[i].pattyCash[j].total).toLocaleString();
                        historyToday += '</div><div class="labelValuePattyCash">Rp ';
                        historyToday += parseInt(obj.dataHistory[i].pattyCash[j].saldo).toLocaleString();
                        historyToday += '</div></div></div>';
                        totalPembelian += parseInt(obj.dataHistory[i].pattyCash[j].total);
                    }
                    for (var j = 0; j < obj.dataHistory[i].reimburse.length; j++) {
                        dataFound = true;
                        historyToday +=
                            '<div class="d-flex justify-content-between wrapPattyCash" onClick="goToDetailReimburse(' +
                            obj.dataHistory[i].reimburse[j].id +
                            ')">';
                        historyToday += '<div class="d-flex justify-content-start">';
                        historyToday +=
                            '<div class="wrapPembelianImg d-flex justify-content-center align-items-center">';
                        historyToday += '<img src="' + imgLaporanPembelian +
                            '" alt="" style="height: 22px;">';
                        historyToday += '</div><div style="margin-left: 15px;">';
                        historyToday +=
                            '<div class="d-flex justify-content-start"><div class="labelItemTransaksi">';
                        historyToday += "Reimburse";
                        historyToday += '</div>';
                        if (obj.dataHistory[i].reimburse[j].idRev == '2') {
                            historyToday += '<img class="statusItemTransaksi" src="' + imgPending +
                                '" alt="">'
                        }
                        historyToday += '</div><div class="labelQtyTransaksi">';
                        // historyToday += obj.dataHistory[i].pattyCash[j].qty + " ";
                        // historyToday += obj.dataHistory[i].pattyCash[j].satuan;
                        historyToday += '</div></div></div>';
                        historyToday += '<div style="margin-right: 10px;"><div class="labelValuePembelian ';
                        if (obj.dataHistory[i].reimburse[j].idRev == '3') {
                            historyToday += 'activeValPembelian';
                            totalReimburse += parseInt(obj.dataHistory[i].reimburse[j].reimburse);
                        } else {
                            historyToday += 'pendingValPembelian';
                        }
                        historyToday += '">+ Rp ';
                        historyToday += parseInt(obj.dataHistory[i].reimburse[j].reimburse)
                            .toLocaleString();
                        historyToday += '</div><div class="labelValuePattyCash">Rp ';
                        historyToday += parseInt(obj.dataHistory[i].reimburse[j].saldo).toLocaleString();
                        historyToday += '</div></div></div>';
                    }

                    for (var j = 0; j < obj.dataHistory[i].reimburseSales.length; j++) {
                        dataFound = true;
                        historyToday +=
                            '<div class="d-flex justify-content-between wrapPattyCash" onClick="goToDetailReimburseSales(' +
                            obj.dataHistory[i].reimburseSales[j].id +
                            ')">';
                        historyToday += '<div class="d-flex justify-content-start">';
                        historyToday +=
                            '<div class="wrapPembelianImg d-flex justify-content-center align-items-center">';
                        historyToday += '<img src="' + imgLaporanPembelian +
                            '" alt="" style="height: 22px;">';
                        historyToday += '</div><div style="margin-left: 15px;">';
                        historyToday +=
                            '<div class="d-flex justify-content-start"><div class="labelItemTransaksi">';
                        historyToday += "Reimburse Sales";
                        historyToday += '</div>';
                        if (obj.dataHistory[i].reimburseSales[j].idRevisiTotal == '2') {
                            historyToday += '<img class="statusItemTransaksi" src="' + imgPending +
                                '" alt="">'
                        }
                        historyToday += '</div><div class="labelQtyTransaksi">';
                        // historyToday += obj.dataHistory[i].pattyCash[j].qty + " ";
                        // historyToday += obj.dataHistory[i].pattyCash[j].satuan;
                        historyToday += '</div></div></div>';
                        historyToday += '<div style="margin-right: 10px;"><div class="labelValuePembelian ';
                        if (obj.dataHistory[i].reimburseSales[j].idRevisiTotal == '3') {
                            historyToday += 'activeValPembelian';
                        } else {
                            historyToday += 'pendingValPembelian';
                        }
                        historyToday += '">+ Rp ';
                        historyToday += parseInt(obj.dataHistory[i].reimburseSales[j].total)
                            .toLocaleString();
                        historyToday += '</div><div class="labelValuePattyCash">Rp ';
                        historyToday += parseInt(obj.dataHistory[i].reimburseSales[j].saldo)
                            .toLocaleString();
                        historyToday += '</div></div></div>';

                        totalReimburse += parseInt(obj.dataHistory[i].reimburseSales[j].total);
                    }

                    if (dataFound) {
                        historyAll += historyToday;
                    }
                }
                document.getElementById("historyAll").innerHTML = historyAll;
                document.getElementById("totalReimburse").innerHTML = "+ Rp " + parseInt(totalReimburse)
                    .toLocaleString();
                document.getElementById("totalPembelian").innerHTML = "- Rp " + parseInt(totalPembelian)
                    .toLocaleString();
                document.getElementById("totalPattyCash").innerHTML = "Rp " + parseInt(totalPattyCash)
                    .toLocaleString().replaceAll(',', '.');
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function refreshPattyCash() {
        $.ajax({
            url: "{{ url('reimburse/update/history/cycle') }}" + '/' + "{{ session('idOutlet') }}",
            type: 'get',
            success: function(response) {
                window.location.href = "{{ url('user/reimburse/history') }}";
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function goToDetailReimburse(index) {
        window.location.href = "{{ url('user/reimburse/detail') }}" + "/" + index;
    }

    function goToDetailPattyCash(index) {
        window.location.href = "{{ url('user/detail/all/pattyCashHarian') }}" + "/" + index;
    }

    function goToDetailReimburseSales(index) {
        window.location.href = "{{ url('user/reimburse/sales/detail') }}" + "/" + index;
    }


    function next(indexDate) {
        if (indexDate != 0) {
            dateSelect = indexDate;
        }
        currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth + 1) % 12;
        resetDate();
        showCalendar(currentMonth, currentYear);
    }

    function previous(indexDate) {
        if (indexDate != 0) {
            dateSelect = indexDate;
        }
        currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        resetDate();
        showCalendar(currentMonth, currentYear);
    }

    function showCalendar(month, year) {
        let firstDay = (new Date(year, month)).getDay() - 1;
        let daysInMonth = 32 - new Date(year, month, 32).getDate();
        let daysInMonthBefore = 32 - new Date(year, month - 1, 32).getDate();

        let tbl = document.getElementById("calendar-body"); // body of the calendar

        let dateAfterSelection = 0;
        let dateBeforeSelection = 0;
        let selisihDate = 0;

        if ((dateSelectAfter.getFullYear() == year) && (dateSelectAfter.getMonth() == month)) {
            dateAfterSelection = dateSelectAfter.getDate();
        }
        selisihDate = Math.floor((dateSelectAfter.getTime() - dateSelectBefore.getTime()) / (1000 * 3600 * 24));
        if ((dateAfterSelection - selisihDate) > 0) {
            dateBeforeSelection = dateSelectBefore.getDate();
        }

        console.log(selisihDate);

        // clearing all previous cells
        tbl.innerHTML = "";

        // filing data about month and in the page via DOM.
        monthAndYear.innerHTML = months[month] + " " + year;

        // creating all cells
        let dateBefore = daysInMonthBefore - firstDay + 1;
        let date = 1;
        let dateAfter = 1;
        let fillTable = '';
        for (let i = 0; i < 6; i++) {
            // creates a table row
            fillTable += '<tr>';
            //creating individual cells, filing them up with data.
            for (let j = 0; j < 7; j++) {
                fillTable += '<td ';
                if (i === 0 && j < firstDay) {
                    fillTable += 'class="beforeAfterDate" ';
                    fillTable += 'onClick="previous(' + dateBefore + ');" ';
                    fillTable += '>';
                    fillTable += dateBefore;
                    dateBefore++;
                } else if (date > daysInMonth) {
                    fillTable += 'class="beforeAfterDate" ';
                    fillTable += 'onClick="next(' + dateAfter + ');" ';
                    fillTable += '>';
                    fillTable += dateAfter;
                    dateAfter++;
                    // break;
                } else {
                    if (date === dateAfterSelection) {
                        fillTable += 'class="dateSelect" ';
                    } else if (date === dateBeforeSelection) {
                        fillTable += 'class="dateSelect" ';
                    } 
                    else if(( dateAfterSelection > date )&&(dateBeforeSelection < date)){
                        fillTable += 'class="dateBetween" ';
                    }
                    else {
                        if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                            fillTable += 'class="dateNow" ';
                        } // color today's date
                    }
                    fillTable += 'onClick="selectDate(' + date + ');" ';
                    fillTable += '>';
                    fillTable += date;
                    date++;
                }
                fillTable += '</td>';
            }
            fillTable += '</tr>';
        }
        $('#calendar-body').empty().append(fillTable);
        // console.log(fillTable);
    }

    function selectDate(indexDate) {
        dateSelect = indexDate;
        updateDate();
        showCalendar(currentMonth, currentYear);
    }

    function updateDate() {
        // console.log();
        var tempStringDate = "'" + (currentMonth + 1) + '/' + dateSelect + '/' + currentYear + "'";
        var tempDate = new Date(tempStringDate);
        if (tempDate < dateSelectBefore) {
            dateSelectBefore = tempDate;
        }
        else if(tempDate == dateSelectBefore){
            dateSelectAfter = tempDate;
        }
        else if (tempDate > dateSelectAfter) {
            dateSelectAfter = tempDate;
        }
        else if(tempDate == dateSelectAfter){
            dateSelectAfter = tempDate;
        }
        else {
            dateSelectBefore = tempDate;
            dateSelectAfter = tempDate;
        }
        console.log(dateSelectAfter);
        console.log(dateSelectBefore);
        // console.log(tempDate);
    }

    function resetDate() {
        var tempStringDate = "'" + (currentMonth + 1) + '/' + dateSelect + '/' + currentYear + "'";
        var tempDate = new Date(tempStringDate);
        dateSelectBefore = tempDate;
        dateSelectAfter = tempDate;
    }

    function terapkanCalendar() {
        var stringDay = '';
        if(dateSelectBefore.getDate() < 10){
            stringDay += '0';
        }
        stringDay += dateSelectBefore.getDate() + '/';
        if((dateSelectBefore.getMonth()+1) < 10){
            stringDay += '0';
        }
        stringDay += (dateSelectBefore.getMonth()+1) + '/' + dateSelectBefore.getFullYear();
        stringDay += ' - ';
        
        if(dateSelectAfter.getDate() < 10){
            stringDay += '0';
        }
        stringDay += dateSelectAfter.getDate() + '/';
        if((dateSelectAfter.getMonth()+1) < 10){
            stringDay += '0';
        }
        stringDay += (dateSelectAfter.getMonth()+1) + '/' +dateSelectAfter.getFullYear();
        document.getElementById('dateKirimLbl').innerHTML = stringDay;
        calendarLayoutHide();
        getAllHistory(2);
    }
</script>

</html>
