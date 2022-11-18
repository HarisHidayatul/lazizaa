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
    <title>Dashboard User</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap');

        .header {
            height: 50px;
            background: #B20731;
        }

        .imageMenu {
            width: 28px;
            height: 28px;
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

        .modal.right .modal-dialog {
            position: fixed;
            left: 0;
            margin: auto;
            width: 175px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.right .modal-content {
            height: 100%;
            overflow-y: auto;
        }

        .modal.left .modal-body {
            padding: 15px 15px 80px;
        }

        .modal.left.fade .modal-dialog {
            right: -320px;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.left.fade.show .modal-dialog {
            left: 0;
        }

        /* ----- MODAL STYLE ----- */
        .modal-content {
            border-radius: 0;
            border: none;
        }

        .modal-header {
            border-bottom-color: #eeeeee;
            background-color: #fafafa;
        }

        .imageClose {
            width: 15px;
            height: 15px;
            right: 20px;
            position: absolute;
        }

        .imageLogo {
            width: 85px;
            height: 30px;
            margin-top: 25%;
            position: absolute;
        }

        .containerr {
            margin-top: 75px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Code For Calendar */
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

        td {
            cursor: pointer;
            padding: 0 2vw;
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
            margin-top: 1px;
        }

        h1 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            font-size: 24px;
            color: #B20731;
            display: flex;
            position: absolute;
            left: 10%;
            margin-top: -4vh;
        }

        h2 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            display: flex;
            position: absolute;
            left: 10%;
            /* align-items: center;
            text-align: center; */
            color: #B20731;
            margin-top: 0vh;
        }

        h5 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            font-size: 15px;
            line-height: 140%;
            /* or 20px */

            display: flex;
            align-items: center;
            text-align: center;

        }

        .previousNext {
            border: none;
            background: none;
        }

        .rowHeight {
            content: "";
            height: 100px
        }

        .container2 {
            content: "";
            height: 20px;
        }

        .bottom {
            margin-top: 65px;
            height: 1000px;
            background: #FCFBFB;
            box-shadow: 0px -0.82px 1.65px rgba(0, 14, 51, 0.1);
            border-radius: 16px;
        }

        .soIcon {
            height: 30px;
            margin-left: 10px;
        }

        .layoutBottom {
            height: 55px;
            background: #FFFFFF;
            /* Greyscale/20 */
            border: 1px solid #E0E0E0;
            border-radius: 10px;
            padding-top: 10px;
            /* padding-left: 10px; */
            margin-top: 12px;
            cursor: pointer;
        }

        .bottom-container {
            margin-left: 15px;
            margin-right: 15px;
        }

        .soStatus {
            height: 20px;
            margin-right: 10px
        }
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <div class="row">
                <div class="col-3" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{ url('img/dashboard/menuIcon.png') }}" alt="menu icon" class="imageMenu">
                </div>
                <div class="col">
                    <h4 class="laporanMenu">Laporan</h4>
                </div>
            </div>
            <div>
                <img src="{{ url('img/dashboard/userIcon.jpg') }}" alt="user icon" class="imageProfile">
            </div>
        </div>
    </div>
    <div class="container2"></div>
    <div class="containerr">
        <div class="row">
            <div class="col">
                <button class="previousNext" onclick="previous(0)">&#10094;</button>
            </div>
            <div class="col-8">
                <h3 id="monthAndYear"></h3>
            </div>
            <div class="col">
                <button class="previousNext" onclick="next(0)">&#10095;</button>
            </div>
        </div>
        <div class="row">
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
        <div class="row">
            <div class="rowHeight"></div>
        </div>
        <div class="row">
            <h1>Lazizaa Sukodono</h1>
        </div>
        <div class="row">
            <h2 id="dateSelected">Selasa, 1 November</h2>
        </div>
    </div>
    <div class="d-flex justify-content-center bottom">
        <div class="container bottom-container">
            <div class="row d-flex justify-content-between layoutBottom" onclick="soClick();">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ url('img/dashboard/laporanSo.png') }}" alt="laporanSo" class="soIcon">
                    </div>
                    <div class="col" style="margin-top: 3px;margin-left: 1px;">
                        <h5>Laporan SO</h5>
                    </div>
                </div>
                <div>
                    <img src="{{ url('img/dashboard/kosong1.png') }}" alt="kosong1" class="soStatus" id="soStatus">
                </div>
            </div>
            <div class="row d-flex justify-content-between layoutBottom" onclick="salesClick();">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ url('img/dashboard/laporanSales.png') }}" alt="laporanSo" class="soIcon">
                    </div>
                    <div class="col" style="margin-top: 3px; margin-left: -3px;">
                        <h5>Laporan Sales</h5>
                    </div>
                </div>
                <div>
                    <img src="{{ url('img/dashboard/kosong1.png') }}" alt="kosong2" class="soStatus" id="salesStatus">
                </div>
            </div>
            <div class="row d-flex justify-content-between layoutBottom" onclick="wasteClick();">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ url('img/dashboard/laporanWaste.png') }}" alt="laporanSo" class="soIcon">
                    </div>
                    <div class="col" style="margin-top: 3px; margin-left: -5px;">
                        <h5>Laporan Waste</h5>
                    </div>
                </div>
                <div>
                    <img src="{{ url('img/dashboard/kosong1.png') }}" alt="terisi" class="soStatus" id="wasteStatus">
                </div>
            </div>
            <div class="row d-flex justify-content-between layoutBottom">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ url('img/dashboard/laporanPattyCash.png') }}" alt="laporanSo" class="soIcon">
                    </div>
                    <div class="col" style="margin-top: 3px; margin-left: -12px;">
                        <h5>Laporan Patty Cash</h5>
                    </div>
                </div>
                <div>
                    <img src="{{ url('img/dashboard/kosong1.png') }}" alt="kosong1" class="soStatus"
                        id="pattyCashStatus">
                </div>
            </div>
        </div>

    </div>
    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ url('img/dashboard/closeIcon.png') }}" alt="close icon" class="imageClose"
                        data-dismiss="modal">
                    <img src="{{ url('img/dashboard/lazizaaLogo.png') }}" alt="logo icon" class="imageLogo">
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    let dateSelect = today.getDate();
    var dataExistType = []; //fso, pattycash, sales, waste, date
    var statusSo = 0;
    var statusSales = 0;
    var statusWaste = 0;
    var statusPattyCash = 0;

    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu"];

    let monthAndYear = document.getElementById("monthAndYear");
    showCalendar(currentMonth, currentYear);

    function soClick() {
        if (statusSo == 0) {
            window.location.href = "{{ url('user/soHarian') }}" + "/" + currentYear + '-' + (currentMonth + 1) + '-' +
                dateSelect;
        } else {
            window.location.href = "{{ url('user/detail/soHarian') }}" + "/" + currentYear + '-' + (currentMonth + 1) +
                '-' + dateSelect;
        }
    }

    function salesClick() {
        if (statusSales == 0) {
            window.location.href = "{{ url('user/salesHarian') }}" + "/" + currentYear + '-' + (currentMonth + 1) +
                '-' + dateSelect;
        } else {
            window.location.href = "{{ url('user/detail/salesHarian') }}" + "/" + currentYear + '-' + (currentMonth +
                1) + '-' + dateSelect;
        }
    }

    function wasteClick(){
        if (statusWaste == 0) {
            window.location.href = "{{ url('user/wasteHarian') }}" + "/" + currentYear + '-' + (currentMonth + 1) +
                '-' + dateSelect;
        } else {
            window.location.href = "{{ url('user/detail/wasteHarian') }}" + "/" + currentYear + '-' + (currentMonth +
                1) + '-' + dateSelect;
        }
    }

    function changeIcon(fsoStatus, pattyCashStatus, salesStatus, wasteStatus) {
        if (fsoStatus == 1) {
            $('#soStatus').attr('src', "{{ url('img/dashboard/terisi.png') }}");
            statusSo = 1;
        } else {
            $('#soStatus').attr('src', "{{ url('img/dashboard/kosong1.png') }}");
            statusSo = 0;
        }
        if (pattyCashStatus == 1) {
            $('#pattyCashStatus').attr('src', "{{ url('img/dashboard/terisi.png') }}");
            statusPattyCash = 1;
        } else {
            $('#pattyCashStatus').attr('src', "{{ url('img/dashboard/kosong1.png') }}");
            statusPattyCash = 0;
        }
        if (salesStatus == 1) {
            $('#salesStatus').attr('src', "{{ url('img/dashboard/terisi.png') }}");
            statusSales = 1;
        } else {
            $('#salesStatus').attr('src', "{{ url('img/dashboard/kosong1.png') }}");
            statusSales = 0;
        }
        if (wasteStatus == 1) {
            $('#wasteStatus').attr('src', "{{ url('img/dashboard/terisi.png') }}");
            statusWaste = 1;
        } else {
            $('#wasteStatus').attr('src', "{{ url('img/dashboard/kosong1.png') }}");
            statusWaste = 0;
        }
    }

    function getDataOnAllDate() {
        $.ajax({
            url: "{{ url('getAllDate/') }}" + '/' + "{{ session('idOutlet') }}",
            data: {
                month: currentMonth + 1,
                year: currentYear
            },
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

    function showListOnAllDate(obj) {
        dataExistType.length = 0;
        for (var i = 0; i < obj.DataTanggal.length; i++) {
            var arrayExistType = [];
            var dateParse = parseInt(obj.DataTanggal[i].Tanggal.split("-")[2]);
            arrayExistType.push(obj.DataTanggal[i].fso);
            arrayExistType.push(obj.DataTanggal[i].pcash);
            arrayExistType.push(obj.DataTanggal[i].sales);
            arrayExistType.push(obj.DataTanggal[i].waste);
            arrayExistType.push(dateParse);
            // arrayExistType.push(mydate.toDateString());
            dataExistType.push(arrayExistType);
        }
        console.log(dataExistType);
        showCalendar(currentMonth, currentYear);
        selectDate(dateSelect);
    }

    function searchExistDataOnDate(indexDate) {
        var dataTemp = null;
        for (var i = 0; i < dataExistType.length; i++) {
            if (indexDate == dataExistType[i][4]) {
                dataTemp = i;
                break;
            }
        }
        return dataTemp;
    }
    $(document).ready(function() {
        getDataOnAllDate();
    });

    function next(indexDate) {
        if (indexDate != 0) {
            dateSelect = indexDate;
        }
        currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth + 1) % 12;
        showCalendar(currentMonth, currentYear);
        getDataOnAllDate();
    }

    function previous(indexDate) {
        if (indexDate != 0) {
            dateSelect = indexDate;
        }
        currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        showCalendar(currentMonth, currentYear);
        getDataOnAllDate();
    }

    function showCalendar(month, year) {

        let firstDay = (new Date(year, month)).getDay() - 1;
        let daysInMonth = 32 - new Date(year, month, 32).getDate();
        let daysInMonthBefore = 32 - new Date(year, month - 1, 32).getDate();

        let tbl = document.getElementById("calendar-body"); // body of the calendar

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
                    if (date === dateSelect) {
                        fillTable += 'class="dateSelect" ';
                    } else {
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
        var indexDataOnDate = searchExistDataOnDate(indexDate);
        if (indexDataOnDate == null) {
            changeIcon(0, 0, 0, 0);
        } else {
            changeIcon(dataExistType[indexDataOnDate][0], dataExistType[indexDataOnDate][1], dataExistType[
                indexDataOnDate][2], dataExistType[indexDataOnDate][3]);
        }
        dateSelect = indexDate;
        var newDate = currentYear;
        newDate += '-' + (currentMonth + 1);
        newDate += '-' + dateSelect;
        var day = new Date(newDate);
        var stringDay = '';
        if ((currentMonth == 0)&&(currentYear==2023)) {
            //Terdapat bug untuk hari pada Januari 2023
            stringDay = days[day.getDay()+1] + ', ' + dateSelect + ' ' + months[currentMonth];
        }else{
            stringDay = days[day.getDay()] + ', ' + dateSelect + ' ' + months[currentMonth];
        }
        console.log(stringDay);
        console.log(newDate);
        document.getElementById('dateSelected').innerHTML = stringDay;
        showCalendar(currentMonth, currentYear);
    }
</script>

</html>
