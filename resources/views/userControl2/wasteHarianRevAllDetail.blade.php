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
    <title>Detail Waste Harian</title>
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
            /* margin-top: 30px; */
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

            color: #B20731;

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
            top: 480px;
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
            top: 480px;
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
            top: 480px;
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
            top: 480px;
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
            margin-top: 15px;
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

        .totalRow {
            padding-bottom: 15px;

        }

        .borderCuTotal {
            margin-top: 5px;
            border: 1px solid #E0E0E0;
            margin-left: 5px;
            margin-bottom: 8px;
        }

        .listBottom {

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 15px;
            /* Main color/Red/50 */
            color: #B20731;
            margin-left: 5px;
        }

        .valBottom {
            /* Regular/XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 15px;
            /* identical to box height */


            /* Main color/Red/50 */

            color: #B20731;
        }

        .valBottom::before {
            content: 'Rp. ';
            position: absolute;
            right: 90px;
        }

        .borderTotal {

            /* Main color/Red/50 */

            border: 1px solid #B20731;
            margin-left: 5px;
        }

        .listPrice {
            /* margin-top: 10px; */
            margin-bottom: 10px;

        }

        .totalSales {
            margin-top: 15px;
            margin-bottom: 15px;
        }



        .totalBottom {
            /* Semibold/Large */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            margin-left: 5px;
            /* identical to box height, or 28px */

            /* Main color/Red/50 */

            color: #B20731;
        }

        .totalBottomVal {
            /* Semibold/Large */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            /* identical to box height, or 28px */


            /* Main color/Red/50 */

            color: #B20731;

        }

        .revisiWrap {
            margin: 0px 20px;
        }

        .wrapBottom {
            background: #B20731;
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.1), 0px -2.22px 11.1008px -1.11008px rgba(50, 50, 71, 0.08);
            border-radius: 32px;
        }

        .titleWrap {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 500;
            font-size: 20px;
            line-height: 140%;
            padding-top: 10px;
            color: #FFFFFF;
        }

        .titleSubRev {
            /* Semibold/XS */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            margin-bottom: 5px;
            /* identical to box height */
            /* Greyscale/10 */
            color: #FFFFFF;
        }

        .borderRev {
            content: '';
            margin-top: 10px;
            margin-left: 20px;
            width: 1px;
            height: 25px;
            background: #FCFBFB;
        }

        .detailSubRev {
            /* Semibold/base */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            /* or 22px */

            /* Greyscale/10 */
            color: #FFFFFF;
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
        <img src="{{ url('img/pointMap.png') }}" alt="map" style="height: 18px; margin-top: 1px;">
        <h2 style="margin-left: 5px;">{{ session('Outlet') }}</h2>
    </div>
    <div class="d-flex justify-content-center">
        <img src="{{ url('img/dashboard/laporanWaste.png') }}" alt="salesImage" style="height: 64px; margin-top: 25px">
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 20px">
        <h3>Laporan Waste</h3>
    </div>
    <div class="d-flex justify-content-center">
        <h4 id="dateSelected">Selasa, 01 November 2022</h4>
    </div>
    <div style="height: 50px;content: ''"></div>
    <div class="wrapBottom">
        <div class="revisiWrap">
            <div class="titleWrap">Revisi</div>
            <div style="content: ''; height: 10px;"></div>
            <div class="d-flex justify-content-between">
                <div>
                    <div class="titleSubRev" id="jenisHead"></div>
                    <div class="detailSubRev" id="wasteHead"></div>
                </div>
                <div class="borderRev"></div>
                <div style="text-align: end;">
                    <div class="titleSubRev">Jumlah</div>
                    <div class="detailSubRev" id="qtyHead"></div>
                </div>
            </div>
            <div style="content: ''; height: 10px;"></div>
        </div>
        {{-- <div style="content: ''; height:50px;"></div> --}}
        <div class="containerBottom">
            <div style="height: 20px;content: ''"></div>
            <div style="margin-left: 20px; margin-right: 20px;">
                <div class="d-flex justify-content-between boxPengisi">
                    <h5 style="margin-top: 5px; margin-left: 10px; color: #B20731;">Pengisi</h5>
                    <div>
                        <h6 class="namaPengisi1" id="namaPengisi1" onclick="showPengisi();"></h6>
                        <h6 class="namaPengisi2" id="namaPengisi2" onclick="showPengisi();"></h6>
                        <h6 class="namaPengisi3" id="namaPengisi3" onclick="showPengisi();"></h6>
                        <h6 class="namaPengisi4" id="namaPengisi4" onclick="showPengisi();"></h6>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 style="margin-top: 5px; margin-left: 10px; color: #B20731;">Status</h5>
                    </div>
                    <div>
                        <h5 style="margin-top: 7px; margin-left: 10px; color: #B20731; font-weight: 600;">Belum</h5>
                    </div>
                </div>
                <div>
                    <div style="height: 15px; content: '';"></div>
                    <div id="dataFill"></div>
                    <div style="content: ''; height: 30px"></div>
                    <button type="button" class="btn" onclick="goToEdit();">Edit</button>
                    <div style="content: ''; height: 150px"></div>
                </div>
            </div>
        </div>
        <div id="pengisiModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content modalContent">
                    <div id="pengisiFill"></div>
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
    var dateSelected = "";

    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

    $(document).ready(function() {
        showAllData();
    });

    function showPengisi() {
        $('#pengisiModal').modal('show');
    }

    function goToEdit() {
        window.location.href = "{{ url('user/wasteHarian') }}" + "/" + dateSelected;
    }

    function showAllData() {
        $.ajax({
            url: "{{ url('waste/show/wasteFill') }}" + '/' + "{{ $idWasteFill }}",
            type: 'get',
            success: function(response) {
                var allData = JSON.parse(JSON.stringify(response));
                console.log(allData);
                var day = new Date(allData.tanggal);
                var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day.getMonth()] +
                    ' ' + (day
                        .getYear() + 1900);
                document.getElementById('dateSelected').innerHTML = stringDay;
                dateSelected = allData.tanggal;
                obj = allData.waste;
                var dataFill = '';
                var dataBottom = '';
                var detailPengisi = '';
                var totalData = 0;
                var indexRow = 0;
                var namaPengisi1 = '';
                var namaPengisi2 = '';
                var namaPengisi3 = '';
                var namaPengisi4 = '';
                document.getElementById('jenisHead').innerHTML = allData.jenis;
                document.getElementById('wasteHead').innerHTML = allData.item;
                document.getElementById('qtyHead').innerHTML = allData.qty + ' ' + allData.satuan;
                for (var i = 0; i < obj.length; i++) {
                    dataFill += '<div><div class="d-flex justify-content-start typeSales">';
                    dataFill += obj[i].type;
                    dataFill += '</div>';
                    for (var j = 0; j < obj[i].waste.length; j++) {
                        dataFill += '<div class="d-flex justify-content-start">';
                        dataFill += '<div class="itemSales">' + obj[i].waste[j].item + '</div>';
                        if ((obj[i].waste[j].idRevQty == 2)) {
                            var urlImage = "{{ url('img/icon/tertunda.png') }}";
                            dataFill += '<img src="' + urlImage + '" class="iconStatus" alt="icon status">';
                        } else if ((obj[i].waste[j].idRevQty == 3)) {
                            var urlImage = "{{ url('img/icon/direvisi.png') }}";
                            dataFill += '<img src="' + urlImage + '" class="iconStatus" alt="icon status">';
                        } else {
                            dataFill += '';
                        }
                        dataFill += '</div><div class="d-flex justify-content-between cuRow">';
                        dataFill += '<div class="cuText">Jumlah</div>';
                        dataFill += '<div class="cuVal">' + obj[i].waste[j].qty + ' ' + obj[i].waste[j].satuan + '</div></div>';
                        dataFill += '<div class="d-flex justify-content-between borderCuTotal"></div>';
                        
                        detailPengisi += '<div class="row" style="margin-left: 5px; margin-top: 5px">';
                        detailPengisi += '<div class="col-3 detailName">' + obj[i].waste[j].namaPengisi[0] +
                            '</div>';
                        detailPengisi += '<div class="col-9"><div class="row">';
                        detailPengisi += '<div class="detailFullName">' + obj[i].waste[j].namaPengisi +
                            '</div></div>';
                        detailPengisi += '<div class="row"><div class="detailSales">';
                        detailPengisi += obj[i].waste[j].item;
                        detailPengisi += '</div></div></div></div>';

                        if (indexRow == 0) {
                            namaPengisi1 = obj[i].waste[j].namaPengisi[0];
                        }
                        if (indexRow == 1) {
                            namaPengisi2 = obj[i].waste[j].namaPengisi[0];
                        }
                        if (indexRow == 2) {
                            namaPengisi3 = obj[i].waste[j].namaPengisi[0];
                        }
                        indexRow++;
                    }
                    dataFill += '</div>';
                }
                if (indexRow == 0) {
                    document.getElementById('namaPengisi1').style.visibility = "hidden";
                    document.getElementById('namaPengisi2').style.visibility = "hidden";
                    document.getElementById('namaPengisi3').style.visibility = "hidden";
                    document.getElementById('namaPengisi4').style.visibility = "hidden";
                } else if (indexRow == 1) {
                    document.getElementById('namaPengisi1').style.visibility = "hidden";
                    document.getElementById('namaPengisi2').style.visibility = "hidden";
                    document.getElementById('namaPengisi3').style.visibility = "hidden";
                    document.getElementById('namaPengisi4').innerHTML = namaPengisi1;
                } else if (indexRow == 2) {
                    document.getElementById('namaPengisi1').style.visibility = "hidden";
                    document.getElementById('namaPengisi2').style.visibility = "hidden";
                    document.getElementById('namaPengisi3').innerHTML = namaPengisi1;
                    document.getElementById('namaPengisi4').innerHTML = namaPengisi2;
                } else if (indexRow == 3) {
                    document.getElementById('namaPengisi1').style.visibility = "hidden";
                    document.getElementById('namaPengisi2').innerHTML = namaPengisi1;
                    document.getElementById('namaPengisi3').innerHTML = namaPengisi2;
                    document.getElementById('namaPengisi4').innerHTML = namaPengisi3;
                } else if (indexRow == 4) {
                    document.getElementById('namaPengisi1').innerHTML = namaPengisi1;
                    document.getElementById('namaPengisi2').innerHTML = namaPengisi2;
                    document.getElementById('namaPengisi3').innerHTML = namaPengisi3;
                    document.getElementById('namaPengisi4').innerHTML = namaPengisi4;
                } else {
                    document.getElementById('namaPengisi1').innerHTML = namaPengisi1;
                    document.getElementById('namaPengisi2').innerHTML = namaPengisi2;
                    document.getElementById('namaPengisi3').innerHTML = namaPengisi3;
                    document.getElementById('namaPengisi4').innerHTML = (indexRow - 3);
                }
                document.getElementById('dataFill').innerHTML = dataFill;
                document.getElementById('pengisiFill').innerHTML = detailPengisi;
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function goToDashboard() {
        window.location.href = "{{ url('user/rev/wasteHarian/all') }}";
    }
</script>

</html>
