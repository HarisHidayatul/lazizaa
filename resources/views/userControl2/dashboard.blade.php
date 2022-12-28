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
            height: 60px;
        }

        .bottom {
            margin-top: 65px;
            height: 300px;
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

        .pattyCashCard {
            background-image: url("{{ url('img/pembayaran/card.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            /* optional, center the image */
            width: 310px;
            height: 190px;
        }

        .wasteCard {
            background-image: url("{{ url('img/pembayaran/cardWaste.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            /* optional, center the image */
            width: 310px;
            height: 190px;
        }

        .wrapCard {
            width: auto;
            overflow-x: scroll;
            overflow-y: hidden;
            white-space: nowrap;
        }

        .cardFill {
            display: inline-block;
            vertical-align: middle;
        }

        .labelPattyCash {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #FFFFFF;
            margin-top: 28px;
            margin-left: 20px;
        }

        .valuePattyCash {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 24px;
            line-height: 120%;
            color: #FFFFFF;
            margin-top: 22px;
            margin-left: 20px;
        }

        .addPattyCash {
            justify-content: center;
            text-align: center;
            display: flex;
            width: 146px;
            height: 40px;
            background: #FFFFFF;
            border-radius: 12px;
            margin-top: 38px;
            margin-left: 20px;
            padding-top: 8px;
        }

        .addPattyCash img {
            width: 12px;
            height: 12px;
            margin-top: 4px;
            margin-right: 5px;
        }

        .addPattyCash div {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            align-items: center;

            color: #585858;
        }


        .wrapStokSoHarian {
            display: flex;
            width: 330px;
            overflow: auto;
        }

        .stokHarian {
            /* display: block;!important */
            background-image: url("{{ url('img/icon/stockSOTemplate.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            /* optional, center the image */
            width: 310px;
            height: 66px;
            padding: 10px 20px;
            flex: 0 0 310px;
        }

        .labelStockHarian {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;

        }

        .imageIconSo {
            filter: invert(73%) sepia(59%) saturate(6350%) hue-rotate(337deg) brightness(80%) contrast(102%);
            height: 32px;
            margin-left: 5px;
            margin-top: 5px;
        }

        .lblItemSo {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 140%;
            align-items: center;
            color: #FFFFFF;
        }

        .qtyItemSo {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            align-items: center;
            color: #FFFFFF;
            margin-top: -5px;
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
                    <h4 class="laporanMenu">Laporan</h4>
                </div>
            </div>
            <div>
                <img src="{{ url('img/dashboard/userIcon.jpg') }}" alt="user icon" class="imageProfile">
            </div>
        </div>
    </div>
    <div style="content:'';height:95px;"></div>
    <div class="d-flex justify-content-center" style="justify-content: center;">
        <img src="{{ url('img/icon/mapPoint.png') }}" alt="" style="height: 23px; margin-left: 0px;">
        <div class="textOutlet">{{ session('Outlet') }}</div>
        <img src="{{ url('img/icon/backRight.png') }}" alt="" style="height: 10px; margin-top:10px;">
    </div>
    <div style="content: ''; height: 25px;"></div>
    <div class="d-flex justify-content-center wrapCard">
        <div class="cardFill" style="content:'';width:10px;"></div>
        <div class="pattyCashCard cardFill">
            <div onclick="goToPattyCashHistory();">
                <div class="labelPattyCash">Saldo Patty Cash</div>
                <div class="valuePattyCash">Rp <span id="totalPattyCash">0</span></div>
            </div>
            <div onclick="goToReimburseForm();">
                <div class="addPattyCash">
                    <img src="{{ url('img/icon/plus.png') }}" alt="">
                    <div onclick="goToReimburseForm();">Reimburse</div>
                </div>
            </div>
        </div>
    </div>
    <div style="content: ''; height: 25px;"></div>
    <div id="wrapStokSoHarian" style="display: none;">
        <div class="d-flex justify-content-center" style="margin-bottom: 15px;">
            <div style="margin-right: 130px;">
                <div class="labelStockHarian">Stok So Harian</div>
                <img src="{{ url('img/icon/warningSoHarian.png') }}" alt="" style="height: 15px;">
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <div class="wrapStokSoHarian" id="listStockSOAll">
            </div>
        </div>
        <div class="d-flex justify-content-center" style="margin-right: 270px; margin-top: 10px;">
            <img src="{{ url('img/icon/carorusel.png') }}" alt="" style="width: 89px; height: 8px;">
        </div>
    </div>
    <div style="content: ''; height: 25px;"></div>
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
                    <img src="{{ url('img/dashboard/kosong1.png') }}" alt="kosong2" class="soStatus"
                        id="salesStatus">
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
                    <img src="{{ url('img/dashboard/kosong1.png') }}" alt="terisi" class="soStatus"
                        id="wasteStatus">
                </div>
            </div>
            <div class="row d-flex justify-content-between layoutBottom" onclick="pattyCashClick();">
                <div class="row">
                    <div class="col-3">
                        <img src="{{ url('img/dashboard/laporanPattyCash.png') }}" alt="laporanSo" class="soIcon">
                    </div>
                    <div class="col" style="margin-top: 3px; margin-left: -12px;">
                        <h5>Laporan Pembelian</h5>
                    </div>
                </div>
                <div>
                    <img src="{{ url('img/dashboard/kosong1.png') }}" alt="kosong1" class="soStatus"
                        id="pattyCashStatus">
                </div>
            </div>
        </div>

    </div>
    <div class="modal right fade" id="exampleModal" tabindex="" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="row menuNotActive" id="setoranMenu" onclick="setoranShow();">
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
    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    let dateSelect = today.getDate();
    var dataExistType = []; //fso, pattycash, sales, waste, date
    var statusSo = 0;
    var statusSales = 0;
    var statusWaste = 0;
    var statusPattyCash = 0;

    var indexDeleteStockSO = 0;

    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];

    let monthAndYear = document.getElementById("monthAndYear");
    showCalendar(currentMonth, currentYear);

    $(document).ready(function() {
        getDataOnAllDate();
        // $('#exampleModal').modal('show');
        dashboardShow();
        getSaldoPattyCash();
        getAllLimitStockSO();
    });
    $('#exampleModal').on('hidden.bs.modal', function() {
        // do something…
        dashboardShow();
    })

    function getAllLimitStockSO() {
        $.ajax({
            url: "{{ url('soHarian/show/batas') }}" + '/' + "{{ session('idOutlet') }}" + '/' +
                currentYear + '-' + (currentMonth + 1) + '-' + dateSelect,
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataStockSo = '';
                var dataFound = false;
                for(var i =0;i< obj.dataLimitSo.length;i++){
                    dataFound = true;

                    dataStockSo += '<div name="stockSO">';
                    dataStockSo += '<div class="stokHarian d-flex justify-content-between">';
                    dataStockSo += '<div class="d-flex justify-content-start">';
                    dataStockSo += '<img class="imageIconSo" src="';
                    dataStockSo += "{{ url('img/soImage') }}" + '/' + obj.dataLimitSo[i].icon + '" alt="">';
                    dataStockSo += '<div style="margin-left: 20px;">';
                    dataStockSo += '<div class="lblItemSo">' + obj.dataLimitSo[i].item + '</div>';
                    dataStockSo += '<div class="qtyItemSo">' + obj.dataLimitSo[i].quantity + ' ' + obj.dataLimitSo[i].satuan + '</div>';
                    dataStockSo += '</div></div>';
                    dataStockSo += '<img src="' + "{{ url('img/icon/close.png') }}" + '" alt="" style="height: 17px;" ';
                    dataStockSo += 'onclick="deleteStockSO(' + i + ')"></div></div>';
                }
                document.getElementById('listStockSOAll').innerHTML = dataStockSo;

                if(dataFound){
                    document.getElementById('wrapStokSoHarian').style.display = 'block';
                }
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function deleteStockSO(index) {
        console.log(index);
        var stockSOElement = document.getElementsByName('stockSO');
        stockSOElement[index].style.display = 'none';

        indexDeleteStockSO++;
        if (indexDeleteStockSO >= stockSOElement.length) {
            document.getElementById('wrapStokSoHarian').style.display = "none";
        }
    }

    function getSaldoPattyCash() {
        $.ajax({
            url: "{{ url('reimburse/show/history/outlet') }}" + '/' + "{{ session('idOutlet') }}" + '/' +
                'today',
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                document.getElementById("totalPattyCash").innerHTML = obj.saldoPattyCash.toLocaleString();
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

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

    function goToSetoran() {
        window.location.href = "{{ url('user/setoran/home') }}"
    }

    function goToPattyCashHistory() {
        window.location.href = "{{ url('user/reimburse/history') }}";
    }

    function goToReimburseForm() {
        window.location.href = "{{ url('user/reimburse/kirim') }}";
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
        // goToDashboard();
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

    function setoranShow() {
        document.getElementById('setoranMenu').classList.add("menuActive");
        document.getElementById('setoranIcon').src = "{{ url('img/dashboard/setoranIconActive.png') }}";
        requestHide();
        revisiHide();
        dashboardHide();
        // goToSetoran
    }

    function setoranHide() {
        document.getElementById('setoranMenu').classList.remove("menuActive");
        document.getElementById('setoranIcon').src = "{{ url('img/dashboard/setoranIcon.png') }}";
    }

    function logout() {
        window.location.href = "{{ url('user/logout') }}";
    }

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

    function wasteClick() {
        if (statusWaste == 0) {
            window.location.href = "{{ url('user/wasteHarian') }}" + "/" + currentYear + '-' + (currentMonth + 1) +
                '-' + dateSelect;
        } else {
            window.location.href = "{{ url('user/detail/wasteHarian') }}" + "/" + currentYear + '-' + (currentMonth +
                1) + '-' + dateSelect;
        }
    }

    function pattyCashClick() {
        if (statusPattyCash == 0) {
            window.location.href = "{{ url('user/pattyCashHarian') }}" + "/" + currentYear + '-' + (currentMonth + 1) +
                '-' + dateSelect;
        } else {
            window.location.href = "{{ url('user/detail/pattyCashHarian') }}" + "/" + currentYear + '-' + (
                currentMonth +
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
        if ((currentMonth == 0) && (currentYear == 2023)) {
            //Terdapat bug untuk hari pada Januari 2023
            stringDay = days[day.getDay() + 1] + ', ' + dateSelect + ' ' + months[currentMonth];
        } else {
            stringDay = days[day.getDay()] + ', ' + dateSelect + ' ' + months[currentMonth];
        }
        console.log(stringDay);
        console.log(newDate);
        document.getElementById('dateSelected').innerHTML = stringDay;
        showCalendar(currentMonth, currentYear);
    }
</script>

</html>
