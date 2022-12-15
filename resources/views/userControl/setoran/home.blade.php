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
    <title>Pembelian Revisi</title>
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
            max-width: 330px;
            min-width: 300px;
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
            margin-top: 1px;
        }

        .listPayment {
            display: flex;
            flex-direction: row;
        }

        .listPayment img {
            width: 156px;
            height: 114px;
        }

        .lblPengirim {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }

        .semuaPengirim {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 140%;
        }

        .wrapBank {
            margin-top: 10px;
            margin-bottom: 10px;
            background: #FFFFFF;
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 16px;
            margin-left: 10px;
            margin-right: 10px;
        }

        .wrapBank div {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
        }

        .wrapBankImage {
            width: 42px;
            height: 42px;
            background: #F9FAFB;
            border-radius: 12px;
            margin-right: 18px;
            margin-left: 18px;
        }

        .wrapBankImage img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .pengirimAll {
            display: flex;
            width: 300px;
            overflow-x: scroll;
        }

        .wrapTransaksi {
            margin-top: 40px;
            display: flex;
            width: 300px;
            overflow: auto;
        }

        .wrapTransaksi div {
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

        .wrapTransaksi .active {
            background: #B20731;
            font-weight: 600;
            color: #FFFFFF;
        }

        .dateTransaksi {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #6B7280;
            margin-top: 20px;
        }

        .nameTransaksi {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
            margin-right: 7px;
        }

        .clockTransaksi {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            color: #6B7280;
            margin-top: 1px;
        }

        .priceTransaksi {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
            margin-top: 8px;
        }

        .rowTransaksi {
            margin-top: 15px;
            padding-bottom: 13px;
            margin-bottom: 13px;
            border-bottom: 1px solid #F3F4F6;
        }

        .historyWrapImage {
            width: 42px;
            height: 42px;
            background: #F9FAFB;
            border-radius: 12px;
        }

        .historyWrapImage img {
            width: 38px;
            height: 38px;
            object-fit: contain;
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
                <div class="col-3" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{ url('img/dashboard/menuIcon.png') }}" alt="menu icon" class="imageMenu">
                </div>
                <div class="col">
                    <h4 class="laporanMenu">Revisi</h4>
                </div>
            </div>
            <div>
                <img src="{{ url('img/dashboard/userIcon.jpg') }}" alt="user icon" class="imageProfile">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="container1">
            <div class="revHeader">Pembayaran</div>
            <div style="content: ''; height:20px;"></div>
            <div class="listPayment">
                <img src="{{ url('img/pembayaran/eWallet.png') }}" alt="" onclick="goToTambahEWallet();">
                <div style="content: ''; width: 10vw;"></div>
                <img src="{{ url('img/pembayaran/transfer.png') }}" alt="" onclick="goToTambahRekening();">
            </div>
            <div style="content: ''; height:30px;"></div>
            <div class="d-flex justify-content-between">
                <div class="lblPengirim">Pengirim</div>
                <div class="semuaPengirim" onclick="goToPenerima();">Semua</div>
            </div>
            <div style="content: ''; height:10px;"></div>
            <div>
                <div class="pengirimAll" id="pengirimAll">
                    <div class="wrapBank" onclick="goToKirimKeTransfer();">
                        {{-- <div class="wrapBankImage">
                            <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                        </div>
                        <div>Siti</div> --}}
                    </div>
                </div>
            </div>
            <div class="wrapTransaksi">
                <div name="sortTransaksi" onclick="listByDate(0);" class="active" style="flex: 0 0 68px;">Semua</div>
                <div name="sortTransaksi" onclick="listByDate(1);" style="flex: 0 0 67px;">Hari ini</div>
                <div name="sortTransaksi" onclick="listByDate(2);" style="flex: 0 0 129px;">1 Minggu terakhir</div>
                <div name="sortTransaksi" onclick="listByDate(3);" style="flex: 0 0 117px;">30 Hari Terakhir</div>
            </div>
            <div class="d-flex justify-content-between" style="margin-top: 20px;">
                <div class="lblPengirim">History Transaksi</div>
                <div class="semuaPengirim" onclick="goToAllHistory();">Semua</div>
            </div>
            <div id="historyTransaksi">
                {{-- <div class="dateTransaksi">1 November</div>
                <div class="d-flex justify-content-between rowTransaksi" onclick="goToEWalletDetail();">
                    <div class="d-flex justify-content-start">
                        <div class="historyWrapImage">
                            <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                        </div>
                        <div style="margin-left: 15px;">
                            <div class="d-flex justify-content-start" style="margin-top: 2px;">
                                <div class="nameTransaksi">Siti</div>
                                <img src="{{ url('img/icon/pending.png') }}" alt=""
                                    style="height: 14px; margin-top: 2px;">
                            </div>
                            <div class="clockTransaksi">12.03 WIB</div>
                        </div>
                    </div>
                    <div class="priceTransaksi">Rp 59.000</div>
                </div> --}}
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
                            <div class="row rowRequest activeRequest" onclick="goToRequestSales();">Sales</div>
                            <div class="row rowRequest" onclick="goToRequestWaste();">Waste</div>
                            <div class="row rowRequest" onclick="goToRequestPattyCash();">Pembelian</div>
                            <div style="content: '';height:10px;"></div>
                        </div>
                        <div class="row menuNotActive" style="margin-top: 25px;" id="revisiMenu"
                            onclick="revisiShow();">
                            <div class="col-1">
                                <div class="col-1"><img src="{{ url('img/dashboard/revisiIcon.png') }}"
                                        alt="" style="height: 20px;margin-top:-2px; margin-left:-15px;"
                                        id="revisiIcon"></div>
                            </div>
                            <div class="col-6" style="text-align: left">Revisi</div>
                            <div class="col-3" style="text-align: right" id="arrowRevisi">&#10095;</div>
                        </div>
                        <div style="background: #FFEAEF;border-radius: 0px 0px 6px 6px;" id="revisiTab">
                            <div style="content: '';height:5px;"></div>
                            <div class="row rowRequest activeRequest" onclick="goToRevisiSales();">Sales</div>
                            <div class="row rowRequest" onclick="goToRevisiWaste();">Waste</div>
                            <div class="row rowRequest" onclick="goToRevisiPattyCash();">Pembelian</div>
                            <div style="content: '';height:10px;"></div>
                        </div>
                        <div style="height: 20px;"></div>
                        <div class="row menuNotActive menuActive" id="setoranMenu" onclick="setoranShow();">
                            <div class="col-1"><img src="{{ url('img/dashboard/setoranIconActive.png') }}"
                                    alt="" style="height: 20px;margin-top:-2px;" id="setoranIcon"></div>
                            <div class="col-6" style="text-align: left" onclick="goToSetoran();">Setoran</div>
                            <div class="col-3" style="text-align: right"></div>
                        </div>
                    </div>
                    <img src="{{ url('img/dashboard/logout.png') }}" alt="logo icon" class="imageLogOut"
                        onclick="logout();">
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
        </div>
    </div>
</body>
<script>
    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];

    $(document).ready(function() {
        getHistoryTransaksi();
        getPengirimInPart();
        setoranShow();
    });

    function getPengirimInPart() {
        $.ajax({
            url: "{{ url('setoran/show/pengirim/inPart') }}" + '/' + "{{ session('idPengisi') }}",
            type: 'get',
            success: function(response) {
                // console.log(response);
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var pengirimAll = '';
                var url = "{{ url('') }}";
                // pengirimAll += '<div class="pengirimAll">';
                for (var i = 0; i < obj.pengirimListArray.length; i++) {
                    pengirimAll += '<div class="wrapBank"';
                    if (obj.pengirimListArray[i].idJenis == '1') {
                        pengirimAll += ' onclick="goToKirimKeTransfer(';
                        pengirimAll += obj.pengirimListArray[i].id;
                        pengirimAll += ');"';
                    } else if (obj.pengirimListArray[i].idJenis == '2') {
                        pengirimAll += ' onclick="goToKirimKeEWallet(';
                        pengirimAll += obj.pengirimListArray[i].id;
                        pengirimAll += ');"';
                    }
                    pengirimAll += '>';
                    pengirimAll += '<div class="wrapBankImage">';
                    pengirimAll += '<img src="' + url + '/' + obj.pengirimListArray[i].imgBank +
                        '" alt="">';
                    pengirimAll += '</div><div>';

                    if (obj.pengirimListArray[i].namaRekening.length > 4) {
                        pengirimAll += obj.pengirimListArray[i].namaRekening.substring(0, 4) +
                            "...";
                    } else {
                        pengirimAll += obj.pengirimListArray[i].namaRekening;
                    }
                    pengirimAll += '</div></div></div>';
                }
                // pengirimAll += '</div>';
                // console.log(pengirimAll);
                document.getElementById('pengirimAll').innerHTML = pengirimAll;
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function getHistoryTransaksi() {
        $.ajax({
            url: "{{ url('setoran/show/data/inPart') }}" + '/' + "{{ session('idOutlet') }}",
            type: 'get',
            success: function(response) {
                // console.log(response);
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataHistoryHTML = '';
                var url = "{{ url('') }}";
                for (var i = 0; i < obj.setoran.length; i++) {
                    var day = new Date(obj.setoran[i].Tanggal);
                    dataHistoryHTML += '<div class="dateTransaksi">';
                    dataHistoryHTML += day.getDate() + ' ' + months[day.getMonth()];
                    dataHistoryHTML += '</div>';
                    for (var j = 0; j < obj.setoran[i].setoran.length; j++) {
                        dataHistoryHTML +=
                            '<div class="d-flex justify-content-between rowTransaksi"';
                        if (obj.setoran[i].setoran[j].idJenis == '1') {
                            dataHistoryHTML += ' onclick="goToTransferDetail(' + obj.setoran[i].setoran[j]
                                .id + ');"';
                        } else if (obj.setoran[i].setoran[j].idJenis == '2') {
                            dataHistoryHTML += ' onclick="goToEWalletDetail(' + obj.setoran[i].setoran[j]
                                .id + ');"';
                        }
                        dataHistoryHTML += '>';
                        dataHistoryHTML += '<div class="d-flex justify-content-start">';
                        dataHistoryHTML += '<div class="historyWrapImage">';
                        dataHistoryHTML += '<img src="' + url + '/' + obj.setoran[i].setoran[j].imgBank +
                            '" alt="">';
                        dataHistoryHTML += '</div><div style="margin-left: 15px;">';
                        dataHistoryHTML +=
                            '<div class="d-flex justify-content-start" style="margin-top: 2px;">';
                        dataHistoryHTML += '<div class="nameTransaksi">';

                        if (obj.setoran[i].setoran[j].namaRekening.length > 7) {
                            dataHistoryHTML += obj.setoran[i].setoran[j].namaRekening.substring(0, 7) +
                                "...";
                        } else {
                            dataHistoryHTML += obj.setoran[i].setoran[j].namaRekening;
                        }

                        dataHistoryHTML += '</div>';
                        if (obj.setoran[i].setoran[j].idRev == '2') {
                            dataHistoryHTML += '<img src="' + url + '/' + 'img/icon/pending.png' + '"';
                            dataHistoryHTML += ' alt=""style="height: 14px; margin-top: 2px;">';
                        } else {
                            dataHistoryHTML += '<img src="' + url + '/' + 'img/icon/sukses.png' + '"';
                            dataHistoryHTML += ' alt=""style="height: 14px; margin-top: 2px;">';
                        }
                        dataHistoryHTML += '</div><div class="clockTransaksi">';
                        dataHistoryHTML += obj.setoran[i].setoran[j].time;
                        dataHistoryHTML += ' WIB</div></div></div>';
                        dataHistoryHTML += '<div class="priceTransaksi">Rp ';
                        dataHistoryHTML += obj.setoran[i].setoran[j].qty.toLocaleString().replace(',', '.');
                        dataHistoryHTML += '</div></div>';
                    }
                }
                document.getElementById('historyTransaksi').innerHTML = dataHistoryHTML;

            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function goToAllHistory() {
        window.location.href = "{{ url('user/setoran/history') }}";
    }

    function goToEWalletDetail(idSetoran) {
        window.location.href = "{{ url('user/setoran/eWallet/detail/home') }}" + '/' + idSetoran;
    }

    function goToTransferDetail(idSetoran) {
        window.location.href = "{{ url('user/setoran/transfer/detail/home') }}" + '/' + idSetoran;
    }

    function goToPenerima() {
        window.location.href = "{{ url('user/setoran/penerima') }}";
    }

    function goToTambahEWallet() {
        window.location.href = "{{ url('user/setoran/eWallet/add/pengirim') }}";
    }

    function goToTambahRekening() {
        window.location.href = "{{ url('user/setoran/transfer/add/pengirim') }}";
    }

    function goToKirimKeTransfer(idPengirim) {
        window.location.href = "{{ url('user/setoran/transfer/kirim/home') }}" + '/' + idPengirim;
    }

    function goToKirimKeEWallet(idPengirim) {
        window.location.href = "{{ url('user/setoran/eWallet/kirim/home') }}" + '/' + idPengirim;
    }

    function listByDate(index) {
        // console.log(.length);
        var element = document.getElementsByName("sortTransaksi");
        for (var i = 0; i < element.length; i++) {
            if (i == index) {
                element[i].classList.add("active");
                continue;
            }
            element[i].classList.remove("active");
        }
    }

    //sidebar
    $('#exampleModal').on('hidden.bs.modal', function() {

    })

    function goToDashboard() {
        window.location.href = "{{ url('user/dashboard') }}";
    }

    function goToRequestSales() {
        window.location.href = "{{ url('user/req/salesHarian/all') }}";
    }

    function goToRequestWaste() {
        window.location.href = "{{ url('user/req/wasteHarian/all') }}";
    }

    function goToRequestPattyCash() {
        window.location.href = "{{ url('user/req/pattyCashHarian/all') }}";
    }

    function goToRevisiSales() {
        window.location.href = "{{ url('user/rev/salesHarian/all') }}";
    }

    function goToRevisiWaste() {
        window.location.href = "{{ url('user/rev/wasteHarian/all') }}"
    }

    function goToRevisiPattyCash() {
        window.location.href = "{{ url('user/rev/pattyCashHarian/all') }}"
    }
    function goToSetoran(){
        window.location.href = "{{ url('user/setoran/home') }}"
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
        setoranHide();
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
        setoranHide();
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
        setoranHide();
    }

    function revisiHide() {
        document.getElementById('revisiTab').style.display = "none";
        document.getElementById('revisiMenu').classList.remove("menuActive");
        document.getElementById('arrowRevisi').classList.remove("arrowChange");
        document.getElementById('revisiIcon').src = "{{ url('img/dashboard/revisiIcon.png') }}";
    }

    function setoranShow(){
        document.getElementById('setoranMenu').classList.add("menuActive");
        document.getElementById('setoranIcon').src = "{{ url('img/dashboard/setoranIconActive.png') }}";
        requestHide();
        revisiHide();
        dashboardHide();
        // goToSetoran
    }

    function setoranHide(){
        document.getElementById('setoranMenu').classList.remove("menuActive");
        document.getElementById('setoranIcon').src = "{{ url('img/dashboard/setoranIcon.png') }}";
    }

    function logout() {
        window.location.href = "{{ url('user/logout') }}";
    }
</script>

</html>
