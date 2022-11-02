{{-- https://github.com/niinpatel/calendarHTML-Javascript/blob/master/scripts.js --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Calendar</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
        integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Optional JavaScript for bootstrap -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous">
    </script>
    <style>
        .dateNow {
            position: relative;
            z-index: 1;
        }

        .dateNow::before {
            content: "";
            background-color: red;
            opacity: 30%;
            display: block;
            height: 20px;
            width: 20px;
            border-radius: 50%;
            margin: auto;
            color: #fff;
            /* line-height: 10px; */
            text-align: center;
            vertical-align: middle;
            position: absolute;
            z-index: 0;
        }

        .fillData::after {
            content: "";
            background-color: blue;
            opacity: 30%;
            height: 5px;
            width: 5px;
            display: block;
            border-radius: 50%;
            margin: auto;
            color: #fff;
            /* line-height: 10px; */
            text-align: center;
            vertical-align: center;
            position: absolute;
            z-index: 0;
        }

        td {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container col-sm-4 col-md-7 col-lg-4 mt-5">
        <div class="card">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <img src="img/babarafi.jpg" class="rounded-circle" alt="Brand" width="50" height="50">
                        <a class="nav-item nav-link" href="#">Dashboard</a>
                    </div>
                </div>
            </nav>
            <h4>Lazizaa Sukodono</h4>
            <div class="form-inline">
                <button onclick="previous()"><</button>
                        <h3 id="monthAndYear"></h3>
                        <button onclick="next()">></button>
                        <button>Buat baru +</button>
            </div>
            <table class="table table-bordered table-responsive-sm" id="calendar">
                <thead>
                    <tr>
                        <th>SEN</th>
                        <th>SEL</th>
                        <th>RAB</th>
                        <th>KAM</th>
                        <th>JUM</th>
                        <th>SAB</th>
                        <th>MIN</th>
                    </tr>
                </thead>
                <tbody id="calendar-body">
                </tbody>
            </table>
        </div>
    </div>
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
            for (let i = 0; i < 6; i++) {
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
                        cell.addEventListener("click", previous);
                        dateBefore++;
                    } else if (date > daysInMonth) {
                        let cellText = document.createTextNode(dateAfter);
                        cell.appendChild(cellText);
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
</body>

</html>
