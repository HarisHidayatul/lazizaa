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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/4.6.0/autoNumeric.min.js"></script>

    <title>Pembelian Harian</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap');

        .header {
            height: 50px;
            background: #B20731;
        }

        .imageBack {
            height: 15px;
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

        .containerTop {
            margin-top: 100px;
            content: "";
            height: 50px;
        }

        /* .menuSel::before{
            content: "";
            background-color: white;
            height: 35px;
            width: 25px;
            display: flex;
            margin-top: 8px;
        } */
        .col {
            text-align: center;
            vertical-align: middle;
        }

        .headerTop {
            background-color: #B20731;
            border-radius: 8px;
            width: 350px;
        }

        .menuSel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Main color/Red/50 */

            /* color: #B20731; */
            color: #B20731;
            z-index: 0;
        }

        .menuSel::before {
            content: "";
            position: absolute;
            width: 75px;
            height: 40px;
            margin-top: 0px;
            margin-left: -10px;
            z-index: -1;
            /* Greyscale/10 */

            background: #FFFFFF;
            /* shadow/Very Soft */

            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 8px;
        }

        .menuNotSel {
            /* Semibold/SM */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Greyscale/10 */

            color: #FFFFFF;
            cursor: pointer;
        }

        .containerBottom {
            margin-top: 75px;
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

            display: flex;
            align-items: center;
            text-align: center;

        }

        label {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 17px;
            line-height: 140%;
            /* identical to box height, or 20px */
            margin-top: 10px;

            color: #000000;
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
            height: 44px;
            /* margin-top: 50px; */
            float: right;
        }

        input[type='radio'] {
            visibility: hidden;
            cursor: pointer;
        }

        input[type='radio']:after {
            content: '';
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: 9px;
            left: -1px;
            position: absolute;
            /* display: inline-block; */
            visibility: visible;
            /* Greyscale/30 */

            border: 2px solid #BEBEBE;
        }

        input[type='radio']:checked::before {
            /* visibility: hidden; */
            content: '';
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: 9px;
            left: -1px;
            position: absolute;
            /* display: inline-block; */
            visibility: visible;
            /* Greyscale/30 */

            border: 2px solid #B20731;
        }

        input[type='radio']:checked:after {
            width: 7px;
            height: 7px;
            /* border-radius: 15px; */
            top: 12.5px;
            left: 2.5px;
            position: absolute;
            background-color: #B20731;
            content: '';
            border: none;
            display: inline-block;
            visibility: visible;
        }

        label[type='radio'] {

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Main color/Red/50 */
            cursor: pointer;
            color: #B20731;
        }

        .radioCustom:checked~label {
            color: #B20731;
        }

        .radioCustom-label {
            /* Semibold/SM */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            margin-top: 8px;
            display: flex;
            color: #BEBEBE;
        }

        .selectItemContainer {
            overflow-y: auto;
            height: 100px;
            width: 88%;
            position: absolute;
            background-color: white;
            margin-top: 10px;
            /* right: 25px; */
            box-shadow: 0px 0px 0.761728px rgba(12, 26, 75, 0.1), 0px 3.04691px 15.2346px -1.52346px rgba(50, 50, 71, 0.08);
            border-radius: 10.9791px;
            z-index: 99;
        }

        .selectItemContainer::-webkit-scrollbar {
            width: 10px;
        }

        .selectItemContainer::-webkit-scrollbar-track {
            /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0); */
            background: #F1F1F1;
            border-radius: 10px;
            width: 3px;
        }

        .selectItemContainer::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: #B20731;
            /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0); */
        }

        .itemSelect {
            /* Regular/base */
            font-family: 'Montserrat';
            padding-top: 3px;
            height: 30px;
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
            padding-left: 15px;
            cursor: pointer;
            margin-left: 5px;
            margin-right: 5px;
        }

        .itemSelect:hover {
            /* Semibold/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;

            /* Greyscale/60 */

            color: #585858;
            background: #FFEAEF;
            border-radius: 10.9791px;
        }

        .itemShow {
            width: 100%;
            height: 40px;
            background: #FFFFFF;
            margin-top: 10px;
            padding-top: 10px;
            padding-left: 15px;
            /* Main color/Red/50 */

            border: 1px solid #E0E0E0;
            border-radius: 8px;
            box-sizing: border-box;

            /* Semibold/SM */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */
            /* Greyscale/30 */
            color: #BEBEBE;
        }

        .itemLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            margin-top: 20px;
            margin-bottom: -5px;
            margin-left: 2px;
        }

        .jumlahLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            margin-top: 20px;
            margin-bottom: -5px;
            margin-left: 2px;

            color: #585858;
        }

        .jumlahInput {
            /* border-right: none; */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14.2174px;
            line-height: 140%;
            /* identical to box height, or 20px */
            background: white;

            /* Greyscale/20 */

            color: #E0E0E0;

            /* border: 1.0663px solid #E0E0E0; */
            box-shadow: 0px 0px 0.394561px rgba(12, 26, 75, 0.24), 0px 1.18368px 3.15649px -0.394561px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
        }

        .jumlahInput:focus {
            border: 1.0663px solid #B20731;
            box-shadow: 0px 0px 0.394561px rgba(12, 26, 75, 0.24), 0px 1.18368px 3.15649px -0.394561px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
        }

        .totalRp {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14.2174px;
            line-height: 140%;
            /* identical to box height, or 20px */

            /* Greyscale/20 */
            color: #E0E0E0;

            border: 1.0663px solid #E0E0E0;
            box-shadow: 0px 0px 0.394561px rgba(12, 26, 75, 0.24), 0px 1.18368px 3.15649px -0.394561px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
            background: white;
            border-right: none;
        }

        .totalVal {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14.2174px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Greyscale/20 */

            color: #E0E0E0;
        }

        .totalVal:focus {
            border: 1.0663px solid #B20731;
            box-shadow: 0px 0px 0.394561px rgba(12, 26, 75, 0.24), 0px 1.18368px 3.15649px -0.394561px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
        }

        .satuan {
            border-left: none;
            font-family: 'Montserrat';
            font-style: normal;
            background: white;
            font-weight: 600;
            line-height: 140%;
            font-size: 14.2174px;
            /* identical to box height, or 20px */

            /* Greyscale/60 */

            color: #585858;
            box-shadow: 0px 0px 0.394561px rgba(12, 26, 75, 0.24), 0px 1.18368px 3.15649px -0.394561px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
        }

        .requestItem {

            /* Semibold/XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            margin-top: 15px;
            /* identical to box height */


            /* Main color/Red/50 */
            color: #B20731;

            cursor: pointer;
        }
        .menuDetail {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            line-height: 140%;
            margin-left: -5px;
            text-align: left;
            /* margin-left: -9px; */
        }

        .jenisDetail {
            /* Semibold/2XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            margin-top: 5px;

            /* Greyscale/40 */
            margin-left: -9px;
            color: #9C9C9C;
        }

        .sesiDetail {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            color: #B20731;
            margin-top: 3px;
            text-align: end;
        }

        .valDetail {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            color: #9C9C9C;
            margin-top: 3px;
            text-align: end;
        }

        .rowDetail {
            background: #FFFFFF;
            /* Greyscale/20 */
            height: 65px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            align-content: center;
            margin-top: 15px;
            cursor: pointer;
        }

        .container {
            /* width: 150px; */
        }

        .modalContent {
            width: 286px;
            height: auto;
            background: #ffffff;
            position: absolute;
            margin-top: 250px;
            float: left;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .closeModal {
            /* background: #000000;!important */
            background: #B20731;
            height: 40px;
            border-radius: 8px;
            margin-right: 10px;
            margin-left: 10px;

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            /* or 22px */
            text-align: center;
            color: #FFFFFF;
            padding-top: 10px;
        }

        .modalTitle {

            /* Semibold/Large */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 140%;
            /* identical to box height, or 28px */

            text-align: center;

            color: #000000;
        }

        .subModalTittle {
            /* Regular/SM */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 13px;
            line-height: 140%;
            /* identical to box height, or 20px */

            text-align: center;

        }

        .subNameModal {
            /* Regular/XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            /* identical to box height */

            text-align: center;
            margin-top: 5px;
            /* Main color/Red/50 */

            color: #B20731;
        }

        .input-group-focus {
            border-color: #B20731;
             !important
        }

        .wrapSesi {
            margin-top: 50px;
            /* margin-bottom: 10px; */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
        }

        .wrapSesi div {
            cursor: pointer;
            width: 120px;
            text-align: center;
            padding-bottom: 5px;
        }

        .sesiActive {
            color: #000000;
            border-bottom: 3px solid #B20731;
        }

        .sesiNonActive {
            color: #BEBEBE;
            border-bottom: 1px solid #E0E0E0;
        }

        .sesiNonActive:hover {
            border-bottom: 1px solid #B20731;
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
        
        .wrapTransaksi {
            margin-top: 40px;
            display: flex;
            width: 100%;
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
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <div class="row">
                <div class="col-2" data-toggle="modal" data-target="#exampleModal" onclick="goToDashboard();">
                    <img src="{{ url('img/back.png') }}" alt="back icon" class="imageBack">
                </div>
                <div class="col">
                    <h4 class="laporanMenu">Laporan harian</h4>
                </div>
            </div>
            <div>
                <img src="{{ url('img/dashboard/userIcon.jpg') }}" alt="user icon" class="imageProfile">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center containerTop">
        <div class="row headerTop">
            <div class="col menuNotSel" style="margin-top: 15px" onclick="goToSoHarian();">SO</div>
            <div class="col menuNotSel" style="margin-top: 15px" onclick="goToSalesHarian();">Sales</div>
            <div class="col menuNotSel" style="margin-top: 15px" onclick="goToWasteHarian();">Waste</div>
            <div class="col menuSel" style="margin-top: 5px" onclick="goToPattyCashHarian();">Pembeli an</div>
        </div>
    </div>
    <div class="d-flex justify-content-center containerBottom">
        <div class="container" style="margin-left: 5px;margin-right: 10px">
            <h3 id="dateSelected" style="margin-top: 18px">Selasa, 1 November</h3>

            <div class="d-flex justify-content-center wrapSesi">
                <div name="sesi" class="sesiActive" onclick="changeSesi(0)">Sesi 1</div>
                <div name="sesi" class="sesiNonActive" onclick="changeSesi(1)">Sesi 2</div>
                <div name="sesi" class="sesiNonActive" onclick="changeSesi(2)">Sesi 3</div>
            </div>

            <div style="content: '';height: 15px"></div>
            <div class="d-flex justify-content-center">
                <div id="radioButtonUser"></div>
            </div>
            <div class="itemLabel">Item</div>
            {{-- <input type="text"> --}}
            <div class="itemShow" onclick="itemShowClick();">
                <div class="d-flex justify-content-between">
                    <div id="itemShow" style="margin-left: -2px">Pilih item</div>
                    <div style="margin-right: 10px"><img src="{{ url('img/icon/selectArrow.png') }}" alt=""
                            style="height: 12px"></div>
                </div>
            </div>
            <div class="selectItemContainer" id="selectItem">
                {{-- <div class="itemSelect" onclick="selectIndex(0)">AAAA</div> --}}
                <div id="itemAll"></div>
            </div>
            <div class="jumlahLabel">Quantity</div>
            <div class="input-group mb-3" style="margin-top: 10px">
                <input type="number" class="form-control jumlahInput" placeholder="0" id="jumlahInput"
                    style="border-right: none;">
                <div class="input-group-append">
                    <span class="input-group-text satuan" style="background: white" id="satuan"></span>
                </div>
            </div>
            <div class="jumlahLabel">Total</div>
            <div class="input-group mb-3" style="margin-top: 10px">
                <div class="input-group-append" style="border-right: none;">
                    <span class="input-group-text totalRp" id="totalRp">Rp</span>
                </div>
                <input class="form-control totalVal" id="totalVal" placeholder="0" style="border-left: none;">
            </div>
            <div style="content: ''; height: 50px"></div>
            <div class="row">
                <div class="col-6 requestItem" onclick="goToRequestItem();">Requset Item?</div>
                <div class="col-6"><button type="button" class="btn" onclick="sendAddData()">Simpan</button>
                </div>
            </div>
            <div style="content: ''; height: 25px"></div>
            <h3 id="dateSelected2" style="margin-top: 18px">Selasa, 1 November</h3>
            {{-- <div style="content: ''; height: 25px"></div> --}}

            <div class="d-flex justify-content-center wrapTransaksi">
                <div name="sortTransaksi" onclick="listBySesi(0);" class="active" style="flex: 0 0 68px;">Semua
                </div>
                <div name="sortTransaksi" onclick="listBySesi(1);" style="flex: 0 0 68px;">Sesi 1</div>
                <div name="sortTransaksi" onclick="listBySesi(2);" style="flex: 0 0 68px;">Sesi 2</div>
                <div name="sortTransaksi" onclick="listBySesi(3);" style="flex: 0 0 68px;">Sesi 3</div>
            </div>

            <div id="dataDetail"></div>
            <div style="content: ''; height: 50px"></div>
        </div>
    </div>
    <div id="itemDouble" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content modalContent">
                <div style="content: '';height:15px"></div>
                <div class="d-flex justify-content-center modalTitle">
                    <img src="{{ url('img/icon/iconModal.png') }}" alt="" style="height: 60px; width: 60px;">
                </div>
                <div style="content: '';height:5px"></div>
                <div style="content: '';height:5px"></div>
                <div class="d-flex justify-content-center modalTitle">Item telah di input</div>
                <div style="content: '';height:5px"></div>
                <div class="d-flex justify-content-center subModalTittle">Gunakan fitur edit / revisi</div>
                <div style="content: '';height:10px"></div>
                <div class="d-flex justify-content-center subNameModal">Klik nama item yang telah di input &#10140;
                    ubah
                </div>
                <div class="d-flex justify-content-center subNameModal">kolom Qty atau Total &#10140; klik simpan</div>
                <div style="content: '';height:25px"></div>
                <div class="closeModal" data-dismiss="modal" aria-hidden="true">Ok</div>
                <div style="content: '';height:15px"></div>
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
            <div class="footerLaporta"><span style="font-size: 16px; margin-top: 5px;">&#169;</span> 2022 - Laporta
            </div>
        </div>
    </div>
</body>
<script>
    var dataId = [];
    var idSo = 0;
    var dateSelected = "{{ $dateSelect }}";
    var dropdownItem = true;
    // var selectJenisBrand = null;
    var selectItemIndex = null;

    var sendOrEdit = true; // true for send and edit for false

    var idPattyCash = 0;

    var idJenisBrand = [];
    var objItemBrand = [];
    var objItemEdit = [];
    var indexEdit = null;

    var selectedSesi = 1;

    var objItem = '';

    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

    var totalInput = new AutoNumeric('#totalVal', {
        decimalPlaces: '0'
    });

    function itemShowClick() {
        if (dropdownItem) {
            dropdownItem = false;
            document.getElementById('selectItem').style.visibility = "hidden";
        } else {
            dropdownItem = true;
            document.getElementById('selectItem').style.visibility = "visible";
        }
    }

    function changeSesi(index) {
        var sesiElement = document.getElementsByName('sesi');
        selectedSesi = index + 1;
        for (var i = 0; i < sesiElement.length; i++) {
            if (i == index) {
                sesiElement[i].classList.add("sesiActive");
                sesiElement[i].classList.remove("sesiNonActive");
            } else {
                sesiElement[i].classList.add("sesiNonActive");
                sesiElement[i].classList.remove("sesiActive");
            }
        }
        // getAllData();
    }
    function listBySesi(index) {
        // console.log(.length);
        var element = document.getElementsByName("sortTransaksi");
        for (var i = 0; i < element.length; i++) {
            if (i == index) {
                element[i].classList.add("active");
                continue;
            }
            element[i].classList.remove("active");
        }
        showSesi(index);
    }

    function goToSoHarian() {
        window.location.href = "{{ url('user/soHarian') }}" + '/' + dateSelected;
    }

    function goToSalesHarian() {
        window.location.href = "{{ url('user/salesHarian') }}" + '/' + dateSelected;
    }

    function goToWasteHarian() {
        window.location.href = "{{ url('user/wasteHarian') }}" + '/' + dateSelected;
    }

    function goToPattyCashHarian() {
        window.location.href = "{{ url('user/pattyCashHarian') }}" + '/' + dateSelected;
    }

    function goToRequestItem() {
        window.location.href = "{{ url('user/request/pattyCashHarian') }}" + '/' + dateSelected;
    }

    $(document).ready(function() {
        var day = new Date(dateSelected);
        var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day.getMonth()];
        document.getElementById('dateSelected').innerHTML = stringDay;
        document.getElementById('dateSelected2').innerHTML = stringDay;

        dataId.length = 0;
        // console.log("{{ $dateSelect }}");

        itemShowClick();
        getItemBrand();
        refreshData();

        $("#jumlahInput").focus(function(e) {
            document.getElementById('satuan').classList.add("input-group-focus");
        }).blur(function(e) {
            document.getElementById('satuan').classList.remove("input-group-focus");
        });
        $("#totalVal").focus(function(e) {
            document.getElementById('totalRp').classList.add("input-group-focus");
        }).blur(function(e) {
            document.getElementById('totalRp').classList.remove("input-group-focus");
        });
    });

    function goToDashboard() {
        window.location.href = "{{ url('user/dashboard') }}";
    }

    function selectIndex(index) {
        // console.log(selectedIndex[index]);
        document.getElementById('itemShow').innerHTML = selectedIndex[index];
        itemShowClick();
    }

    function getItemBrand() {
        $.ajax({
            url: "{{ url('pattyCash/brand/show/item') }}",
            type: 'get',
            data: {
                idBrand: "{{ session('idBrand') }}",
            },
            success: function(response) {
                // console.log(response);
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                objItemBrand.length = 0;
                var dataDropdown = '';
                for (var i = 0; i < obj?.dataItem.length; i++) {
                    dataDropdown += '<div class="itemSelect" onclick="setDropDown(';
                    dataDropdown += i;
                    dataDropdown += ')">';
                    dataDropdown += obj.dataItem[i].Item;
                    dataDropdown += '</div>';
                    objItemBrand.push(obj.dataItem[i]);
                }
                document.getElementById('itemAll').innerHTML = dataDropdown;
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function setDropDown(selectIndex) {
        //Off kan drop down
        dropdownItem = false;
        sendOrEdit = true;
        document.getElementById('selectItem').style.visibility = "hidden";
        selectItemIndex = selectIndex;

        var itemSelect = objItemBrand[selectIndex]?.Item;
        console.log(objItemBrand[selectIndex]);
        document.getElementById('jumlahInput').value = '';
        totalInput.set('0');
        document.getElementById('itemShow').innerHTML = itemSelect;
        document.getElementById('satuan').innerHTML = objItemBrand[selectIndex]?.Satuan;
    }

    function refreshData() {
        $.ajax({
            url: "{{ url('/') }}" + '/' + "{{ 'pattyCash/user/showTable/' }}" +
                "{{ session('idOutlet') }}" + '/' + dateSelected,
            type: 'get',
            success: function(response) {
                console.log(response);
                var dataDetail = '';
                var obj = JSON.parse(JSON.stringify(response));
                objItem = obj;
                listBySesi(0);
                document.getElementById('jumlahInput').value = '';
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function showSesi(indexSesi) {
        var urlImage = '{{ url('img/dashboard/laporanPattyCash.png') }}';
        var indexLoop = 0;
        objItemEdit.length = 0;
        var dataDetail = '';

        for (var i = 0; i < objItem.itemPattyCash.length; i++) {
            for (var j = 0; j < objItem.itemPattyCash[i].Item.length; j++) {
                var dataDetail2 = '';
                dataDetail2 += '<div class="row rowDetail" onclick="editItem(' +
                    indexLoop +
                    ');"><div class="col-2"><img src="';
                dataDetail2 += urlImage;
                dataDetail2 += '" alt="waste"style="height: 40px"></div>';
                dataDetail2 += '<div class="col-5"><div class="row menuDetail">';
                // dataDetail2 += '<div class="col-9 menuDetail">';
                dataDetail2 += objItem.itemPattyCash[i].Item[j].Item;
                if (objItem.itemPattyCash[i].Item[j].idQtyRev == 2) {
                    var urlImageRev = '{{ url('img/icon/tertunda.png') }}';
                    dataDetail2 += '<img src="' + urlImageRev +
                        '" alt="status icon" class="status" style="height:15px; margin-left: 8px;">';
                } else if (objItem.itemPattyCash[i].Item[j].idTotalRev == 2) {
                    var urlImageRev = '{{ url('img/icon/tertunda.png') }}';
                    dataDetail2 += '<img src="' + urlImageRev +
                        '" alt="status icon" class="status" style="height:15px; margin-left: 8px;">';
                }
                dataDetail2 += '</div><div class="row jenisDetail">';
                dataDetail2 += objItem.itemPattyCash[i].Item[j].qty;
                dataDetail2 += ' ';
                dataDetail2 += objItem.itemPattyCash[i].Item[j].Satuan;
                dataDetail2 += '</div></div><div class="col-5">';

                dataDetail2 += '<div class="sesiDetail">';
                // dataDetail2 += 'ASDSA';
                dataDetail2 += 'Sesi ';
                dataDetail2 += objItem.itemPattyCash[i].Item[j].idSesi;
                dataDetail2 += '</div>';

                dataDetail2 += '<div class="valDetail">Rp ';
                dataDetail2 += objItem.itemPattyCash[i].Item[j].total.toLocaleString();
                dataDetail2 += '</div>';
                dataDetail2 += '</div></div>';

                if ((indexSesi == objItem.itemPattyCash[i].Item[j].idSesi)||(indexSesi == 0)) {
                    dataDetail += dataDetail2;
                    objItemEdit.push(objItem.itemPattyCash[i].Item[j]);
                    indexLoop++;
                }
            }
        }
        document.getElementById('dataDetail').innerHTML = dataDetail;
    }

    function editItem(selectIndex) {
        console.log(objItemEdit[selectIndex]);
        sendOrEdit = false;
        indexEdit = selectIndex;
        document.getElementById('itemShow').innerHTML = objItemEdit[selectIndex]?.Item;
        document.getElementById('jumlahInput').value = objItemEdit[selectIndex]?.qty;
        totalInput.set(objItemEdit[selectIndex]?.total);
        document.getElementById('satuan').innerHTML = objItemEdit[selectIndex]?.Satuan;
    }

    function submitEditPattyCash() {
        // var valueInput = document.getElementById('jumlahInput').value;
        // var valueEdit = objItemEdit[indexEdit]?.qty;
        console.log(objItemEdit[indexEdit]);
        var qtyValEdit = document.getElementById("jumlahInput").value;
        var totalValEdit = totalInput.rawValue;
        var qtyTableFill = objItemEdit[indexEdit]?.qty;
        var totalTableFill = objItemEdit[indexEdit]?.total;
        if (qtyValEdit != qtyTableFill) {
            $.ajax({
                url: "{{ url('pattyCash/edit/qty/data/') }}" + "/" + objItemEdit[indexEdit]?.idPattyCashFill,
                type: 'get',
                data: {
                    quantityRevisi: qtyValEdit,
                    idPengisi: "{{ session('idPengisi') }}"
                },
                success: function(response) {
                    // console.log(response);
                    refreshData();
                },
                error: function(req, err) {
                    console.log(err);
                    // return 0
                }
            });
        }
        if (totalValEdit != totalTableFill) {
            $.ajax({
                url: "{{ url('pattyCash/edit/total/data/') }}" + "/" + objItemEdit[indexEdit]?.idPattyCashFill,
                type: 'get',
                data: {
                    totalRevisi: totalValEdit,
                    idPengisi: "{{ session('idPengisi') }}"
                },
                success: function(response) {
                    refreshData();
                },
                error: function(req, err) {
                    console.log(err);
                    // return 0
                }
            });
        }
    }

    function sendAddData() {
        if (sendOrEdit) {
            submitPattyCashHarian();
        } else {
            submitEditPattyCash();
        }
    }

    function submitPattyCashHarian() {
        $.ajax({
            url: "{{ url('pattyCash/data/getId') }}",
            type: 'get',
            data: {
                // tanggal: document.getElementById('dateAdd').value,
                tanggal: dateSelected,
                idOutlet: "{{ session('idOutlet') }}",
                idSesi: selectedSesi
            },
            success: function(response) {
                // console.log(response);
                idPattyCash = response;
                sendDataToServer(idPattyCash)
            },
            error: function(req, err) {
                console.log(err);
                // return 0
            }
        });
    }

    function sendDataToServer(idPattyCashs) {
        $.ajax({
            url: "{{ url('pattyCash/store/data') }}",
            type: 'get',
            data: {
                idPattyCash: idPattyCashs,
                idListItem: objItemBrand[selectItemIndex]?.id,
                quantity: document.getElementById('jumlahInput').value,
                total: parseInt(totalInput.rawValue),
                idPengisi: "{{ session('idPengisi') }}"
            },
            success: function(response) {
                if (response == 0) {
                    $('#itemDouble').modal('show');
                }
                refreshData();
                document.getElementById('jumlahInput').value = '';
                totalInput.set(0);
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }
</script>

</html>
