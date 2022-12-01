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
            font-size: 20px;
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
            margin-top: 6px;
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
                    <h4 class="laporanMenu">Request</h4>
                </div>
            </div>
            <div>
                <img src="{{ url('img/dashboard/userIcon.jpg') }}" alt="user icon" class="imageProfile">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="container1">
            <div class="revHeader">Request pembelian</div>
            <div id="dataRev"></div>
        </div>
    </div>
    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="{{ url('img/dashboard/closeIcon.png') }}" alt="close icon" class="imageClose"
                        data-dismiss="modal">
                    <img src="{{ url(session('brandImage')) }}" alt="logo icon" class="imageLogo">
                    <div class="menuSidebar">
                        <div class="row menuNotActive menuActive" id="dashboardMenu" onclick="dashboardShow();">
                            <div class="col-1"><img src="{{ url('img/dashboard/dashboardIconActive.png') }}"
                                    alt="" style="height: 20px;margin-top:-2px;" id="dashboardIcon"></div>
                            <div class="col-6" style="text-align: left" onclick="goToDashboard();">Dashboard</div>
                            <div class="col-3" style="text-align: right"></div>
                        </div>
                        <div class="row menuNotActive" style="margin-top: 25px;" onclick="requestShow();"
                            id="requestMenu">
                            <div class="col-1"><img src="{{ url('img/dashboard/requestIcon.png') }}" alt=""
                                    style="height: 20px;margin-top:-2px;" id="requestIcon"></div>
                            <div class="col-6" style="text-align: left">Request</div>
                            <div class="col-3" style="text-align: right;" id="arrowRequest">&#10095;</div>
                        </div>
                        <div style="background: #FFEAEF;border-radius: 0px 0px 6px 6px;" id="requestTab">
                            <div style="content: '';height:5px;"></div>
                            <div class="row rowRequest activeRequest">Sales</div>
                            <div class="row rowRequest">Waste</div>
                            <div class="row rowRequest">Pembelian</div>
                            <div style="content: '';height:10px;"></div>
                        </div>
                        <div class="row menuNotActive" style="margin-top: 25px;" id="revisiMenu"
                            onclick="revisiShow();">
                            <div class="col-1">
                                <div class="col-1"><img src="{{ url('img/dashboard/revisiIcon.png') }}" alt=""
                                        style="height: 20px;margin-top:-2px; margin-left:-15px;" id="revisiIcon"></div>
                            </div>
                            <div class="col-6" style="text-align: left">Revisi</div>
                            <div class="col-3" style="text-align: right" id="arrowRevisi">&#10095;</div>
                        </div>
                        <div style="background: #FFEAEF;border-radius: 0px 0px 6px 6px;" id="revisiTab">
                            <div style="content: '';height:5px;"></div>
                            <div class="row rowRequest activeRequest" onclick="goToRevisiSales();">Sales</div>
                            <div class="row rowRequest">Waste</div>
                            <div class="row rowRequest">Pembelian</div>
                            <div style="content: '';height:10px;"></div>
                        </div>
                    </div>

                    <img src="{{ url('img/dashboard/logout.png') }}" alt="logo icon" class="imageLogOut"
                        onclick="logout();">
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];


    function goToSalesBelum() {
        window.location.href = "{{ url('user/rev/salesHarian/all') }}";
    }

    function goToSalesSudah() {
        window.location.href = "{{ url('user/rev/salesHarian/done') }}";
    }


    $(document).ready(function() {
        revisiShow();
        showRevAll();
    });
    $('#exampleModal').on('hidden.bs.modal', function() {
        // do something…
        requestShow();
    })


    function goToDashboard() {
        window.location.href = "{{ url('user/dashboard') }}";
    }

    function goToRevisiSales() {
        window.location.href = "{{ url('user/rev/salesHarian/all') }}";
    }

    function requestShow() {
        document.getElementById('requestTab').style.display = "block";
        document.getElementById('revisiMenu').classList.remove("menuActive");
        document.getElementById('requestMenu').classList.add("menuActive");
        // $("#requestIcon").attr("src","img/dashboard/requestIconActive.png");
        document.getElementById('arrowRequest').classList.add("arrowChange");
        document.getElementById('requestIcon').src = "{{ url('img/dashboard/requestIconActive.png') }}";
        dashboardHide();
        revisiHide();
    }

    function requestHide() {
        document.getElementById('requestTab').style.display = "none";
        document.getElementById('requestMenu').classList.remove("menuActive");
        // $("#requestIcon").attr("src","img/dashboard/requestIcon.png");
        document.getElementById('arrowRequest').classList.remove("arrowChange");
        document.getElementById('requestIcon').src = "{{ url('img/dashboard/requestIcon.png') }}";
    }

    function dashboardShow() {
        document.getElementById('dashboardMenu').classList.add("menuActive");
        document.getElementById('dashboardIcon').src = "{{ url('img/dashboard/dashboardIconActive.png') }}";
        requestHide();
        revisiHide();
        goToDashboard();
    }

    function dashboardHide() {
        document.getElementById('dashboardMenu').classList.remove("menuActive");
        document.getElementById('dashboardIcon').src = "{{ url('img/dashboard/dashboardIcon.png') }}";
    }

    function revisiShow() {
        document.getElementById('revisiTab').style.display = "block";
        document.getElementById('revisiMenu').classList.add("menuActive");
        // $("#requestIcon").attr("src","img/dashboard/requestIconActive.png");
        document.getElementById('arrowRevisi').classList.add("arrowChange");
        document.getElementById('revisiIcon').src = "{{ url('img/dashboard/revisiIconActive.png') }}";
        dashboardHide();
        requestHide();
    }

    function revisiHide() {
        document.getElementById('revisiTab').style.display = "none";
        document.getElementById('revisiMenu').classList.remove("menuActive");
        document.getElementById('arrowRevisi').classList.remove("arrowChange");
        document.getElementById('revisiIcon').src = "{{ url('img/dashboard/revisiIcon.png') }}";
    }

    function logout() {
        window.location.href = "{{ url('user/logout') }}";
    }


    function goToRevSales(idSalesFill) {
        console.log(idSalesFill);
        window.location.href = "{{ url('user/rev/salesHarian/all/date') }}" + '/' + idSalesFill;
    }

    function showRevAll() {
        $.ajax({
            url: "{{ url('pattyCash/items/show/req/all') }}" + '/' + "{{ session('idOutlet') }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataRev = '';
                var urlImage = "{{ url('img/dashboard/laporanPattyCash.png') }}";
                for (var i = 0; i < obj.reqPattyCash.length; i++) {
                    var day = new Date(obj.reqPattyCash[i].Tanggal);
                    var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day
                        .getMonth()];
                    dataRev += '<div class="dateTop">' + stringDay + '</div>';
                    for (var j = 0; j < obj.reqPattyCash[i].reqPattyCash.length; j++) {
                        dataRev +=
                            '<div class="d-flex justify-content-between boxDetail">';
                        dataRev += '<div class="d-flex justify-content-start">';
                        dataRev += '<div><img src="' + urlImage +
                            '" alt="" style="height: 25px; margin-top: 5px;"></div>';
                        dataRev +=
                            '<div style="margin-left: 10px; margin-top:3px;"><div class="detailTitle">';
                        dataRev += obj.reqPattyCash[i].reqPattyCash[j].Item;
                        dataRev += '</div><div class="detailSubTitle">';
                        dataRev += obj.reqPattyCash[i].reqPattyCash[j].namaPengisi;
                        dataRev += '</div></div></div><div><div style="content: ' + "'';" +
                            'height: 6px;"></div>';
                        dataRev +=
                            '<div class="detailRev">Satuan &#10132; <span style="color: #008000;">';
                        dataRev += obj.reqPattyCash[i].reqPattyCash[j].satuan;
                        dataRev += '</span></div>';
                        dataRev += '</div></div>';
                    }
                }
                document.getElementById('dataRev').innerHTML = dataRev;
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }
</script>

</html>
