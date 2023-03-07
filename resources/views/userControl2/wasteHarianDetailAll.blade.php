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

            /* Greyscale/50 */

            color: #7A7A7A;
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
            /* width: 85px; */
            height: 30px;
            margin-top: 25%;
            position: absolute;
        }

        .imageLogOut {
            /* width: 85px; */
            height: 20px;
            position: absolute;
            bottom: 15px;
            left: 15px;
        }

        .containerr {
            /* margin-top: 75px; */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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
            /* or 22px */


            /* Main color/Red/50 */

            color: #B20731;
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
            height: 60px;
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

        .textOutlet {
            /* Semibold/Large */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 140%;
            /* identical to box height, or 28px */


            /* Main color/Red/50 */
            color: #B20731;
            margin-right: 22vw;
        }

        .menuSidebar {
            margin-top: 120px;
            width: 150px;
            justify-content: center;
            flex-direction: row;
        }

        .menuActive::before {
            /* Main color/Red/50 */
            content: '';
            position: absolute;
            margin-top: -7px;
            left: 7px;
            background: #B20731;
            border-radius: 8px;
            width: 160px;
            height: 36px;
            text-align: center;
        }

        .menuActive {
            /* Semibold/base */

            /* font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%; */
            /* or 22px */


            /* Greyscale/10 */

            color: #FFFFFF;
             !important
        }

        .menuNotActive {
            /* Regular/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 140%;
            cursor: pointer;
            /* display: block; */
        }

        .rowRequest {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 140%;
            margin-left: 15px;
            margin-top: 10px;
            cursor: pointer;
        }

        .activeRequest {
            font-weight: 600;
            color: #B20731;
        }

        .arrowChange {
            transform: rotate(90deg);
            margin-top: -10px;
            margin-left: -3px;
        }

        .revHeader {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 24px;
            line-height: 120%;
            margin-top: 80px;
        }

        .boxTop {
            background: #B20731;
            border-radius: 6px;
            height: 38px;
            margin-top: 15px;
        }

        .subBoxTop {
            /* width: 150px; */
            width: 100vw;
            margin-left: 5px;
            margin-right: 5px;
            text-align: center;
            padding-top: 5px;
            margin-top: 5px;
            margin-bottom: 5px;
            /* background: #FFFFFF; */
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 6px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #FFFFFF;
        }

        .subActive {
            background: white;
            color: #B20731;
             !important
        }

        .container1 {
            width: 80vw;
            max-width: 400px;
            min-width: 250px;
        }

        .dateTop {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            margin-top: 20px;
            /* margin-left: -12px; */
            margin-bottom: 10px;
        }

        .boxDetail {
            cursor: pointer;
            border: 1px solid #E0E0E0;
            height: 48px;
            border-radius: 8px;
            padding-top: 5px;
            padding-left: 5px;
            padding-right: 10px;
            margin-bottom: 10px;
        }

        .detailTitle {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            line-height: 140%;
        }

        .detailSubTitle {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            color: #9C9C9C;
        }

        .detailRev {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 11px;
            line-height: 12px;
            color: #BEBEBE;
            text-align: end;
            margin-top: 1px;
            text-align: end;
            margin-top: 1px;
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

        .wrapEdit {
            position: fixed;
            right: 30px;
            bottom: 100px;
        }

        .wrapEdit div {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            width: 106px;
            height: 44px;
            background: #B20731;
            border: 1px solid white;
            color: #FFFFFF;
            border-radius: 6px;
            text-align: center;
            align-content: center;
            align-items: center;
            padding-top: 10px;
            cursor: pointer;
        }

        .iconStatus {
            height: 18px;
        }
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <div class="row" onclick="goToDashboard();" style="cursor: pointer;">
                <div class="col-2" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack">
                </div>
                <div class="col">
                    <h4 class="kembali">Kembali</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="container1">
            <div class="d-flex justify-content-center revHeader">Laporan Waste</div>
            <div class="d-flex justify-content-center" style="margin-top: 5px;">
                <img src="{{ url('img/pointMap.png') }}" alt="map" style="height: 18px; margin-top: 1px;">
                <h2 style="margin-left: 5px;">{{ session('Outlet') }}</h2>
            </div>
            <div class="dateTop" id="dateTop">XXXXX XX XXXXXXX</div>
            {{-- <div class="dateTop">Sesi 3</div>
            <div class="d-flex justify-content-between boxDetail">
                <div class="d-flex justify-content-start">
                    <div><img src="{{ url('img/dashboard/laporanSales.png') }}" alt="" style="height: 35px;">
                    </div>
                    <div style="margin-left: 10px; margin-top:3px;">
                        <div class="d-flex justify-content-start detailTitle">
                            <div>Takeaway</div>
                            <img src="{{ url('img/icon/sukses.png') }}" alt="" style="height: 18px">
                        </div>
                        <div class="detailSubTitle">Siti</div>
                    </div>
                </div>
                <div>
                    <div style="content: '';height: 6px;"></div>
                    <div class="detailRev">CU &#10132; <span style="color: #FFA500;">10</span></div>
                    <div class="detailRev">Total &#10132; <span style="color: #FFA500;">Rp. 20.222</span></div>
                </div>
            </div>
            <div class="d-flex justify-content-between boxDetail">
                <div class="d-flex justify-content-start">
                    <div><img src="{{ url('img/dashboard/laporanSales.png') }}" alt="" style="height: 35px;">
                    </div>
                    <div style="margin-left: 10px; margin-top:3px;">
                        <div class="detailTitle">Takeaway</div>
                        <div class="detailSubTitle">Siti</div>
                    </div>
                </div>
                <div>
                    <div style="content: '';height: 6px;"></div>
                    <div class="detailRev">CU &#10132; <span style="color: #FFA500;">10</span></div>
                    <div class="detailRev">Total &#10132; <span style="color: #FFA500;">Rp. 20.222</span></div>
                </div>
            </div> --}}
            <div id="dataHTML"></div>
        </div>
    </div>
    <div style="height: 50px;"></div>
    <div class="wrapEdit">
        <div onclick="buttonEditClick();">Edit</div>
    </div>
    <div style="height: 100vw;"></div>
    <div class="d-flex justify-content-center footer">
        <div>
            <div class="d-flex justify-content-center">
                <img class="imgFooter" src="{{ url('img/lazizaaHome.png') }}" alt="">
            </div>
            <div class="tittleFooter">PT LAZIZAA RAHMAT SEMESTA</div>
            <div class="d-flex justify-content-center borderFooter"></div>
            <div class="socialMediaLabel">Social media</div>
            <div class="d-flex justify-content-center" style="margin-top: 20px;">
                <img src="{{ url('img/icon/instagram.png') }}" alt="" style="height: 20px; width: 20px;">
                <div style="width: 40px;"></div>
                <img src="{{ url('img/icon/facebook.png') }}" alt="" style="width: 12px; height: 23px;">
                <div style="width: 40px;"></div>
                <img src="{{ url('img/icon/whatsapp.png') }}" alt="" style="width: 24px; height: 24px;">
            </div>
            <div style="height: 20px;"></div>
            <div class="footerLaporta"><span style="font-size: 16px; margin-top: 5px;">&#169;</span> 2022 - Laporta
            </div>
            <div style="height: 50px;"></div>
        </div>
    </div>
</body>
<script>
    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

    $(document).ready(function() {
        console.log("{{ $dateSelect }}");
        var day = new Date("{{ $dateSelect }}");
        var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day.getMonth()];
        document.getElementById('dateTop').innerHTML = stringDay;
        
        getAllData();
    });

    function buttonEditClick(){
        window.location.href = "{{ url('user/wasteHarian') }}" + '/' + "{{ $dateSelect }}";
    }

    function getAllData() {
        $.ajax({
            url: "{{ url('waste/user/showAllSesi') }}" + '/' + "{{ session('idOutlet') }}" + '/' +
                "{{ $dateSelect }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var imgURL = "{{ url('img/dashboard/laporanWaste.png') }}";
                var dataHTML = '';
                for (var i = 0; i < obj.length; i++) {
                    var tempHTML = '';
                    var dataFound = false;
                    for (var j = 0; j < obj[i].dataWaste[0].length; j++) {
                        dataFound = true;
                        tempHTML += '<div class="d-flex justify-content-between boxDetail" onclick="goToDetailSesi('+obj[i].idSesi+');">';
                        tempHTML += '<div class="d-flex justify-content-start">';
                        tempHTML += '<div><img src="' + imgURL + '" alt="" style="height: 35px;"></div>';
                        tempHTML += '<div style="margin-left: 10px; margin-top:3px;">';
                        tempHTML += '<div class="d-flex justify-content-start detailTitle"><div>' + obj[i].dataWaste[0][j].waste[0].item + '</div>';

                        if ((obj[i].dataWaste[0][j].waste[0].idRevQty == 2)) {
                            var urlImage = "{{ url('img/icon/tertunda.png') }}";
                            tempHTML += '<img src="' + urlImage + '" style="height: 18px" alt="icon status">';
                        } else if ((obj[i].dataWaste[0][j].waste[0].idRevQty == 3)) {
                            var urlImage = "{{ url('img/icon/direvisi.png') }}";
                            tempHTML += '<img src="' + urlImage + '" style="height: 18px" alt="icon status">';
                        } else {
                            tempHTML += '';
                        }

                        tempHTML += '</div>';
                        tempHTML += '<div class="detailSubTitle">' + obj[i].dataWaste[0][j].waste[0].namaPengisi + '</div></div></div><div>';
                        tempHTML += '<div style="content: '+"''"+';height: 6px;"></div>';
                        tempHTML += '<div class="detailRev">'+obj[i].dataWaste[0][j].type+'<span style="color: #B20731;">';
                        // tempHTML += obj[i].dataWaste[0][j].waste[0].idRevQty;
                        tempHTML += '</span></div>';
                        tempHTML += '<div class="detailRev"><span style="color: #B20731;">';
                        tempHTML += obj[i].dataWaste[0][j].waste[0].qty;
                        tempHTML += ' ';
                        tempHTML += obj[i].dataWaste[0][j].waste[0].satuan;
                        tempHTML += '</span></div></div></div>';
                        // console.log(tempHTML);
                    }
                    if(dataFound){
                        dataHTML += '<div class="dateTop">Sesi ' + obj[i].idSesi + '</div>';
                        dataHTML += tempHTML;
                    }
                }
                document.getElementById('dataHTML').innerHTML = dataHTML;
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function goToDashboard() {
        window.location.href = "{{ url('user/dashboard') }}";
    }

    function goToDetailSesi(index){
        window.location.href = "{{ url('user/detail/wasteHarian') }}" + '/' + "{{ $dateSelect }}" + '/' + index;
    }
</script>

</html>
