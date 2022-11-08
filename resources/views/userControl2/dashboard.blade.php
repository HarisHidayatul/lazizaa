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
        .dateNow {
            /* position: relative; */
            /* z-index: 1; */
            color: white;
        }

        .dateNow::before {
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
        }

        h2 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            display: flex;
            align-items: center;
            text-align: center;
            color: #B20731;
        }

        .previousNext {
            border: none;
            background: none;
        }

        .rowHeight {
            content: "";
            height: 125px
        }

        .rowHeight2 {
            content: "";
            height: 10px;
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
    <div class="containerr">
        <div class="row">
            <div class="col">
                <button class="previousNext" onclick="previous()">&#10094;</button>
            </div>
            <div class="col-8">
                <h3 id="monthAndYear"></h3>
            </div>
            <div class="col">
                <button class="previousNext" onclick="next()">&#10095;</button>
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
            <h2>Selasa, 1 Nopember</h2>
        </div>
        <div class="row">
            <div class="rowHeight2"></div>
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

    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "Nopember", "Desember"
    ];

    let monthAndYear = document.getElementById("monthAndYear");
    showCalendar(currentMonth, currentYear);


    function next() {
        currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth + 1) % 12;
        showCalendar(currentMonth, currentYear);
    }

    function previous() {
        currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
        currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
        showCalendar(currentMonth, currentYear);
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
        for (let i = 0; i < 5; i++) {
            // creates a table row
            let row = document.createElement("tr");
            //creating individual cells, filing them up with data.
            for (let j = 0; j < 7; j++) {
                let cell = document.createElement("td");
                // cell.addEventListener("click", showBefore);
                // cell.setAttribute('id','id2');
                if (i === 0 && j < firstDay) {
                    let cellText = document.createTextNode(dateBefore);
                    cell.appendChild(cellText);
                    cell.classList.add("beforeAfterDate");
                    cell.addEventListener("click", previous);
                    dateBefore++;
                } else if (date > daysInMonth) {
                    let cellText = document.createTextNode(dateAfter);
                    cell.appendChild(cellText);
                    cell.classList.add("beforeAfterDate");
                    cell.addEventListener("click", previous);
                    dateAfter++;
                    // break;
                } else {
                    let cellText = document.createTextNode(date);
                    if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                        cell.classList.add("dateNow");
                    } // color today's date
                    cell.classList.add("fillData");
                    cell.appendChild(cellText);
                    date++;
                }
                row.appendChild(cell);
            }
            tbl.appendChild(row); // appending each row into calendar body.
        }
    }
</script>

</html>
