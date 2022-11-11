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
    <title>Detail SO Harian</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap');

        .header {
            height: 50px;
            background: white;
        }

        .imageBack {
            height: 13px;
        }

        .menuAll {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 10px;
        }

        .kembali {
            margin-top: 7px;
            margin-left: -14px;
        }

        h4 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            /* identical to box height */

            display: flex;
            align-items: center;
            text-align: center;
        }

        .col {
            text-align: center;
            vertical-align: middle;
        }

        .containerBottom {
            margin-top: 30px;
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


            /* Information/main */

            color: #0000FF;

        }

        h1 {
            /* Semibold/XL */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 25px;
            line-height: 120%;
            /* identical to box height, or 29px */


            color: #000000;
        }

        h2 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            /* or 22px */


            /* Main color/Red/50 */

            color: #B20731;

        }

        h4 {
            /* Semibold/XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;

            /* Greyscale/50 */

            color: #7A7A7A;
        }

        h5 {
            /* Regular/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 140%;
        }

        h6 {
            /* Semibold/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
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
            height: 40px;
            margin-top: 50px;
            float: right;
        }

        .boxPengisi {
            /* background-color: #000000; */
            background: #F7F4F4;
            border-radius: 6px;
        }

        .contentSo {
            border-bottom: 1px solid #E0E0E0;
            margin-top: 20px
        }

        .imgSo {
            height: 21px;
            margin-top: -5px
        }

        .leftSo {
            margin-top: -6px;
        }

        .rightSo {
            margin-top: -3px;
        }

        .itemSo {
            margin-left: -10px;
        }
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <div class="row" onclick="goToDashboard();">
                <div class="col-2" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack">
                </div>
                <div class="col">
                    <h4 class="kembali">Kembali</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 60px;">
        <h1>Detail Laporan</h1>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 5px;">
        <img src="{{ url('img/pointMap.png') }}" alt="map" style="height: 18px; margin-top: 1px">
        <h2 style="margin-left: 5px;">Lazizaa Sukodono</h2>
    </div>
    <div class="d-flex justify-content-center">
        <img src="{{ url('img/dashboard/laporanSo.png') }}" alt="soImage" style="height: 64px; margin-top: 25px">
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 20px">
        <h3>Laporan SO</h3>
    </div>
    <div class="d-flex justify-content-center">
        <h4 id="dateSelected">Selasa, 01 November 2022</h4>
    </div>
    <div class="containerBottom">
        <div style="height: 20px;content: ''"></div>
        <div style="margin-left: 20px; margin-right: 20px;">
            <div class="d-flex justify-content-between boxPengisi">
                <h5 style="margin-top: 5px; margin-left: 10px">Pengisi</h5>
                <h6 style="margin-top: 5px; margin-right: 10px" id="namaPengisi">.</h6>
            </div>
            <div style="height: 15px;content: ''"></div>
            <div id="contentSo"></div>
            <button type="button" class="btn" onclick="goToEdit();">Edit</button>
            <div style="content: ''; height: 150px"></div>
        </div>
    </div>
</body>
<script>
    var dateSelected = "{{ $dateSelect }}";

    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

    $(document).ready(function() {
        var day = new Date(dateSelected);
        console.log(day);
        var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day.getMonth()] + ' ' + (day.getYear()+1900);
        document.getElementById('dateSelected').innerHTML = stringDay;

        showAllData();
    });

    function goToEdit(){
        window.location.href = "{{ url('user/edit/soHarian') }}" + "/" + "{{ $dateSelect }}";
    }

    function showAllData() {
        $.ajax({
            url: '{{ url('soHarian/user/showDetail') }}' + '/' + "{{ session('idOutlet') }}" + '/' +
                "{{ $dateSelect }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(response);
                var contentSo = '';
                for (var i = 0; i < obj.itemfso.length; i++) {
                    var urlImage = '{{ url('img/soImage') }}' + '/' + obj.itemfso[i]['icon'];
                    contentSo +=
                        '<div class="d-flex justify-content-between contentSo"><div class="row leftSo"><div class="col-1">'
                    contentSo += '<img src="' + urlImage + '"' + ' alt="so icon" class="imgSo">';
                    contentSo += '</div><div class="col itemSo">';
                    contentSo += '<h5>' + obj.itemfso[i]['item'] + '</h5>';
                    contentSo += '</div></div><div class="row rightSo"><div class="col-1">';
                    contentSo += '<h6>' + obj.itemfso[i]['qty'] + '</h6>';
                    contentSo += '</div><div class="col itemSo">';
                    contentSo += '<h6>' + obj.itemfso[i]['satuan'] + '</h6>';
                    contentSo += '</div></div></div>';
                }
                document.getElementById('contentSo').innerHTML = contentSo;
                document.getElementById('namaPengisi').innerHTML = obj.pengisi;
            },
            error: function(req, err) {
                console.log(err);
                // return 0
            }
        });
    }
    function goToDashboard() {
        window.location.href = "{{ url('user/dashboard') }}";
    }
</script>

</html>
