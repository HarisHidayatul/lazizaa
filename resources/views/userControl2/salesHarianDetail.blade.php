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


            /* Warning/main */

            color: #FFA500;

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
            /* Semibold/2XS */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 12px;

            /* color: #FFFFFF; */

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


        .namaPengisi1::before {
            content: '';
            width: 22px;
            height: 22px;
            border: 1px solid #F6F4F4;
            border-radius: 50px;
            background-color: #FF6E92;
            position: absolute;
            z-index: -1;
            right: -7px;
            top: -4px;
        }

        .namaPengisi1 {
            cursor: pointer;
            position: absolute;
            z-index: 1;
            top: 360px;
            right: 70px;
            color: white;
        }

        .namaPengisi2::before {
            content: '';
            width: 22px;
            height: 22px;
            border: 1px solid #F6F4F4;
            border-radius: 50px;
            background-color: #B20731;
            position: absolute;
            z-index: -1;
            right: -7px;
            top: -4px;
        }

        .namaPengisi2 {
            cursor: pointer;
            position: absolute;
            z-index: 1;
            top: 360px;
            right: 55px;
            color: white;
        }

        .namaPengisi3::before {
            content: '';
            width: 22px;
            height: 22px;
            border: 1px solid #F6F4F4;
            border-radius: 50px;
            background-color: #BEBEBE;
            position: absolute;
            z-index: -1;
            right: -7px;
            top: -4px;
        }

        .namaPengisi3 {
            cursor: pointer;
            position: absolute;
            z-index: 1;
            top: 360px;
            right: 40px;
            color: white;
        }

        .namaPengisi4::before {
            content: '';
            width: 22px;
            height: 22px;
            border: 1px solid #F6F4F4;
            border-radius: 50px;
            background-color: #F62F60;
            position: absolute;
            z-index: -1;
            right: -7px;
            top: -4px;
        }

        .namaPengisi4 {
            cursor: pointer;
            position: absolute;
            z-index: 1;
            top: 360px;
            right: 25px;
            color: white;
        }


        .modalContent {
            margin-top: 385px;
            position: absolute;
            right: 20px;
            width: 200px;
            height: 150px;
            overflow-y: auto;
        }

        .detailName {
            /* Semibold/2XS */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            margin-top: 5px;
            position: relative;

            color: #FFFFFF;
            z-index: 1;
             !important
        }

        .modal {
            /* z-index: 1083;!important */
        }

        .detailName::before {
            content: "";
            background: #B20731;
            ;

            border: 1px solid #F6F4F4;
            border-radius: 50px;

            height: 25px;
            width: 25px;
            position: absolute;
            top: -3px;
            left: 6px;
            z-index: -1;
             !important
        }

        .detailFullName {

            /* Semibold/2XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 13px;
            line-height: 12px;
            margin-left: -14px;
            margin-top: 3px;
        }

        .detailSales {
            /* Regular/2XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 12px;

            margin-left: -14px;
            margin-top: 3px;
        }

        .iconImage {
            height: 20px;
            margin-left: 0px;
        }

        .typeSales {
            /* Semibold/Large */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            margin-left: 5px;
            margin-top: 10px;
        }

        .itemSales {
            /* Semibold/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            margin-left: 5px;
            margin-top: 15px;
        }

        .iconStatus {
            height: 18px;
            margin-top: 10px;
            margin-left: 8px;

        }

        .cuText {
            /* Regular/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 140%;
            margin-left: 5px;
        }

        .cuVal {

            /* Semibold/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }

        .cuRow {
            margin-top: 10px;
        }

        .totalText {
            /* Semibold/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            margin-left: 5px;
        }

        .totalVal {
            /* Semibold/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }
        .totalRow{
            padding-bottom: 15px;

        }
        .borderCuTotal{
            margin-top: 5px;
            border: 1px solid #E0E0E0;
            margin-left: 5px;
            margin-bottom: 8px;
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
        <img src="{{ url('img/dashboard/laporanSales.png') }}" alt="salesImage" style="height: 64px; margin-top: 25px">
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 20px">
        <h3>Laporan Sales</h3>
    </div>
    <div class="d-flex justify-content-center">
        <h4 id="dateSelected">Selasa, 01 November 2022</h4>
    </div>
    <div class="containerBottom">
        <div style="height: 20px;content: ''"></div>
        <div style="margin-left: 20px; margin-right: 20px;">
            <div class="d-flex justify-content-between boxPengisi">
                <h5 style="margin-top: 5px; margin-left: 10px; color: #B20731;">Pengisi</h5>
                <div>
                    <h6 class="namaPengisi1" id="namaPengisi1" onclick="showPengisi();">S</h6>
                    <h6 class="namaPengisi2" id="namaPengisi2" onclick="showPengisi();">S</h6>
                    <h6 class="namaPengisi3" id="namaPengisi3" onclick="showPengisi();">S</h6>
                    <h6 class="namaPengisi4" id="namaPengisi4" onclick="showPengisi();">S</h6>
                </div>
            </div>
            <div style="height: 15px;content: ''"></div>
            {{-- <div id="contentSo"></div> --}}
            <div>
                <div class="d-flex justify-content-start typeSales">Organik</div>
                <div class="d-flex justify-content-start">
                    <div class="itemSales">Dine In</div>
                    <img src="{{ url('img/icon/direvisi.png') }}" class="iconStatus" alt="icon status">
                </div>
                <div class="d-flex justify-content-between cuRow">
                    <div class="cuText">CU</div>
                    <div class="cuVal">46</div>
                </div>
                <div class="d-flex justify-content-between borderCuTotal"></div>
                <div class="d-flex justify-content-between totalRow">
                    <div class="totalText">Total</div>
                    <div class="totalVal">Rp. 546.064</div>
                </div>
            </div>
            <div>
                <div class="d-flex justify-content-start typeSales">Organik</div>
                <div class="d-flex justify-content-start">
                    <div class="itemSales">Dine In</div>
                    <img src="{{ url('img/icon/direvisi.png') }}" class="iconStatus" alt="icon status">
                </div>
                <div class="d-flex justify-content-between cuRow">
                    <div class="cuText">CU</div>
                    <div class="cuVal">46</div>
                </div>
                <div class="d-flex justify-content-between borderCuTotal"></div>
                <div class="d-flex justify-content-between totalRow">
                    <div class="totalText">Total</div>
                    <div class="totalVal">Rp. 546.064</div>
                </div>
            </div>
            <button type="button" class="btn" onclick="goToEdit();">Edit</button>
            <div style="content: ''; height: 150px"></div>
        </div>
    </div>
    <div id="pengisiModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content modalContent">
                <div class="row" style="margin-left: 5px; margin-top: 5px">
                    <div class="col-3 detailName" id="namaPengisi2">S</div>
                    <div class="col-9">
                        <div class="row">
                            <div class="detailFullName" id="namaLengkap2">Nama Lengkap S</div>
                        </div>
                        <div class="row">
                            <div class="detailSales">Takeaway</div>
                        </div>
                    </div>
                </div>
            </div>
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
        var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day.getMonth()] + ' ' + (day
            .getYear() + 1900);
        document.getElementById('dateSelected').innerHTML = stringDay;

        showAllData();
    });

    function showPengisi() {
        $('#pengisiModal').modal('show');
    }

    function goToEdit() {
        window.location.href = "{{ url('user/edit/soHarian') }}" + "/" + "{{ $dateSelect }}";
    }

    function showAllData() {
        $.ajax({
            url: "{{ url('salesHarian/user/showAllData/') }}" + '/' + "{{ session('idOutlet') }}" + '/' +
                dateSelected,
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);

            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function goToDashboard() {
        window.location.href = "{{ url('user/dashboard') }}";
    }
</script>

</html>
