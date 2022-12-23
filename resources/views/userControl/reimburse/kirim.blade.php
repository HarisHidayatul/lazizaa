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
    <title>Document</title>
    <style>
        /* @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap'); */
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&family=Roboto:wght@400;500;700&display=swap');

        .header {
            height: 50px;
            background: white;
        }

        .imageBack {
            height: 15px;
        }

        .menuAll {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 20px;
        }

        .kembali {
            margin-top: -6px;
        }

        h4 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            /* identical to box height */
            display: flex;
            align-items: center;
            text-align: center;
        }

        button {
            /* width: 100%; */
            height: 40px;
            background: #B20731;
            border-radius: 8px;
            border: none;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            text-align: center;
            color: #FFFFFF;
        }

        .topWrap {
            background: #F9FAFB;
            border-radius: 12px;
            height: 60px;
            padding: 0px 10px;
            margin-bottom: 20px;
        }

        .topWrapImage {
            width: 45px;
            height: 45px;
            padding-top: 5px;
            background: #FFFFFF;
            border-radius: 12px;
        }

        .topWrapImage img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .nameTop {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
        }

        .nameTop span {
            font-size: 25px;
            position: relative;
            top: -2px;
        }

        .boxInput {
            height: 98px;
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 16px;
            padding: 12px 12px;
            margin-bottom: 45px;
        }

        .jumlahLabel {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 150%;
            color: #6B7280;
        }

        .satuanLabel {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 150%;
            color: #6B7280;
            margin-top: 5px;
            margin-right: 15px;
        }

        .inputJumlah {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 24px;
            line-height: 130%;
            /* color: #E0E0E0; */
            color: #585858;
            border: none;
        }

        .inputJumlah:focus {
            border: none;
            outline: none;
            color: #E0E0E0;
        }

        .wrapNominal {
            display: flex;
            flex-wrap: wrap;
            max-width: 500px;
            margin-bottom: 40px;
            /* min-width: 400px; */
        }

        .wrapNominal div {
            flex: 0 0 125px;
            height: 30px;
            /* width: 100px; */
            background: #FFEAEF;
            border-radius: 8px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            text-align: center;
            padding: 5px;
            color: #B20731;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .wrapUpload {
            height: 50px;
            background: #F6F6F6;
            border: 1px dashed #BEBEBE;
            border-radius: 8px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            text-align: center;
            color: #585858;
            margin-top: 20px;
            margin-bottom: 25px;
        }

        .wrapUpload div {
            margin-left: 15px;
        }

        .rekTujuan {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }

        .rekTujuanLBL {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
            margin-top: 3px;
        }

        .rekTujuanNum {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            /* text-align: center; */
            color: #BEBEBE;
            margin-top: 3px;
        }

        .wrapRekTujuan {
            border: 1px solid #E0E0E0;
            height: 60px;
            border-radius: 12px;
            padding-left: 10px;
            padding-right: 10px;
        }

        .wrapImgRekTujuan {
            width: 42px;
            height: 42px;
            background: #F9FAFB;
            border-radius: 8px;
        }

        .wrapImgRekTujuan img {
            width: 38px;
            height: 38px;
            object-fit: contain;
        }

        .wrapBottom {
            padding-top: 20px;
            padding-left: 20px;
            padding-right: 20px;
            background: #FFFFFF;
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.1), 0px -5.55px 8.88063px rgba(20, 37, 63, 0.06);
            border-radius: 24px 24px 0px 0px;
        }

        .wrapListRekening {
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 16px;
            padding-right: 15px;
            padding-left: 15px;
            height: 80px;
            width: 85vw;
            margin-bottom: 15px;
        }

        .wrapImgRekening {
            width: 48px;
            height: 48px;
            left: 20px;
            top: 112px;
            background: #F9FAFB;
            border-radius: 1000px;
        }

        .wrapImgRekening img {
            width: 43px;
            height: 43px;
            object-fit: contain;
        }

        .listBankTittle {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
        }

        .listBankNumber {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            margin-top: 2px;
            color: #BEBEBE;
        }

        .circleSelect {
            width: 24px;
            height: 24px;
            border-radius: 12px;
            border: 1px solid #E5E7EB;
        }

        .activeSelectBank {
            background: #B20731;
        }

        .activeSelectBank::after {
            content: '\2713';
            position: absolute;
            margin-top: 3px;
            margin-left: 6px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 140%;
            color: white;
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

        /* calendar */
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
            padding: 0 1.7vw;
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

        .previousNext {
            text-align: center;
            vertical-align: middle;
            /* Semibold/base */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 0.9rem;
            line-height: 4.5vh;
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
            margin-top: 5px;
        }

        .pilihTanggal {
            margin-left: 10px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
            margin-bottom: 5px;
        }

        .wrapSelectTanggal {
            height: 42px;
            border: 1px solid #E0E0E0;
            border-radius: 12px;
        }

        .dateKirimLbl {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
            margin-left: 8px;
        }

        .calendarLayout {
            /* shadow/Hard */
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.1), 0px 11.1008px 13.3209px rgba(20, 37, 63, 0.06);
            border-radius: 6.90722px;
            position: absolute;
            top: 60vh;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 500px;
            width: 100vw;
            background: white;
        }

        .buttonNonActive {
            background: #FFEAEF;
            color: #B20731;
        }

        textarea {
            border: none;
            width: 100%;
            height: 87px;
            margin-top: 5px;
            margin-bottom: 20px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            color: #585858;
            text-align: justify;
            background: #FDFDFD;
            border: 0.942363px solid #E3E9ED;
            border-radius: 15.0778px;
            padding: 10px 10px;
        }

        .labelPembayaran {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
        }

        .addBankLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
            margin-top: 15px;
            margin-bottom: 2px;
        }

        .inputBank {
            border: 1.0663px solid #E0E0E0;
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
            height: 42px;
            width: 100%;
            padding-left: 10px;
            /* Semibold/Large */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 13px;
            line-height: 140%;
            color: #585858;
        }

        .inputBank::placeholder {
            color: #E0E0E0;
        }

        .fillBankSelect {
            background: #FFFFFF;
            border: 1.0663px solid #E0E0E0;
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
            height: 42px;
            padding: 0 10px;

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 13px;
            line-height: 140%;
            color: #BEBEBE;
        }

        .selectItemContainer {
            overflow-y: auto;
            height: 100px;
            width: 87vw;
            max-width: 400px;
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
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack" onclick="goBack();">
            <h4 class="kembali">Request Reimburse</h4>
            <div></div>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-left: 5px; margin-right: 5px; margin-top:100px;">
        <div id="inputRekeningBank" style="width: 90%; max-width: 400px;">
            <div class="addBankLabel">Bank</div>
            <div class="d-flex justify-content-between align-items-center fillBankSelect" onclick="listBankClick();">
                <div id="fillBankSelect">Pilih Bank</div>
                <img src="{{ url('img/icon/selectArrow.png') }}" alt="" style="height: 12px;">
            </div>
            <div class="selectItemContainer" id="selectItem">
                <div id="itemAll">
                    {{-- <div class="itemSelect" onclick="selectIndexBank(0)">AAAA</div> --}}
                </div>
            </div>
            <div class="addBankLabel">Nomor rekening</div>
            <input id="inputNomorRekening" class="inputBank" type="number" placeholder="Contoh : 14318161581">
            <div class="addBankLabel">Atas nama</div>
            <input id="atasNamaRekening" class="inputBank" type="text" placeholder="Contoh : Justin Beiber"><br>
            <div style="height: 200px;"></div>
            <button style="width: 100%;" onclick="lanjutClick();">Lanjut</button>
        </div>
        <div id="home">
            <div class="d-flex justify-content-start align-items-center topWrap">
                <div class="topWrapImage">
                    <img id="imageBankPengirim" src="" alt="">
                </div>
                <div style="margin-left: 15px;">
                    <div class="nameTop" id="namaPengirim">....</div>
                    <div class="nameTop" id="rekeningDanBankPengirim">.... | <span>.....</span> ....</div>
                </div>
            </div>
            <div class="pilihTanggal">Pilih tanggal</div>
            <div class="d-flex justify-content-between align-items-center wrapSelectTanggal"
                onclick="calendarLayoutShow();">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="{{ url('img/icon/calendarIcon.png') }}" alt=""
                        style="height: 24px; margin-left: 10px;">
                    <div class="dateKirimLbl" id="dateKirimLbl">11/11/2022</div>
                </div>
                <div>
                    <div>
                        <img src="{{ url('img/icon/selectArrow.png') }}" alt=""
                            style="height: 13px; margin-right: 10px;">
                    </div>
                </div>
            </div>
            <div class="calendarLayout" id="calendarLayout">
                <div class="d-flex justify-content-center">
                    <div style="margin-right: 40px;">
                        <div class="previousNext" onclick="previous(0)">&#10094;</div>
                    </div>
                    <div>
                        <h3 id="monthAndYear"></h3>
                    </div>
                    <div style="margin-left: 40px;">
                        <div class="previousNext" onclick="next(0)">&#10095;</div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
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
                <div style="height: 20px;"></div>
                <div class="d-flex justify-content-center">
                    <button class="buttonNonActive" style="width: 30vw; margin-right: 3vw;"
                        onclick="calendarLayoutHide();">Batal</button>
                    <button style="width: 30vw;" onclick="terapkanCalendar();">Terapkan</button>
                </div>
                <div style="height: 20px;"></div>
            </div>
            <div style="height: 20px;"></div>
            <div class="boxInput" id="boxInput">
                <div class="jumlahLabel">Jumlah :</div>
                <div class="d-flex justify-content-start" style="margin-top: 15px; margin-left: 5px;">
                    <div class="satuanLabel">Rp</div>
                    <input class="inputJumlah" type="text" placeholder="0" id="inputJumlah">
                </div>
            </div>
            <div class="d-flex justify-content-center wrapNominal">
                <div onclick="setJumlah(50000)">50.000</div>
                <div onclick="setJumlah(100000)">100.000</div>
                <div onclick="setJumlah(200000)">200.000</div>
                <div onclick="setJumlah(500000)">500.000</div>
                <div onclick="setJumlah(1000000)">1.000.000</div>
                <div onclick="setJumlah(2000000)">2.000.000</div>
            </div>
            <div class="labelPembayaran">Pesan</div>
            <textarea id="textAreaPesan" placeholder='"Untuk keperluan apa?"'></textarea>
            <div class="wrapBottom">
                <button onclick="sendDataKirim();" style="width: 100%">Kirim request</button>
            </div>
        </div>
    </div>
    <div style="content: ''; height: 35px;"></div>
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
    let today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();
    let dateSelect = today.getDate();
    var indexPage = 0;
    var listBankActive = true;
    var currentDateMonthYear = currentYear + '-' + currentMonth + '-' + dateSelect;

    var objListBank = null;

    var indexSelectBank = null;

    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];

    let monthAndYear = document.getElementById("monthAndYear");
    showCalendar(currentMonth, currentYear);

    function selectIndexBank(index) {
        indexSelectBank = index;
        document.getElementById('fillBankSelect').innerHTML = objListBank.listBank[indexSelectBank].bank;
        hideListBank();
    }

    function sendDataKirim(){
        $.ajax({
            url: "{{ url('reimburse/store/data') }}",
            type: 'get',
            data: {
                idOutlet: "{{ session('idOutlet') }}",
                tanggal: currentDateMonthYear,
                idBank: objListBank.listBank[indexSelectBank].id,
                namaRekening: document.getElementById('atasNamaRekening').value,
                nomorRekening: document.getElementById('inputNomorRekening').value,
                pesan: document.getElementById('textAreaPesan').value,
                qty: parseInt(inputJumlah.rawValue),
                idPengisi: "{{ session('idPengisi') }}"
            },
            success: function(response) {
                // window.location.href = "{{ url('user/reimburse/detail') }}" + '/' + response;
                window.location.href = "{{ url('user/reimburse/wait') }}";
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function getAllBank() {
        $.ajax({
            url: "{{ url('setoran/bank/show/all') }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                objListBank = obj;
                var dataListAllBank = '';
                for (var i = 0; i < obj.listBank.length; i++) {
                    dataListAllBank += '<div class="itemSelect" onclick="selectIndexBank(';
                    dataListAllBank += i;
                    dataListAllBank += ')">';
                    dataListAllBank += obj.listBank[i].bank;
                    dataListAllBank += '</div>';
                }
                document.getElementById("itemAll").innerHTML = dataListAllBank;
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function listBankClick() {
        if (listBankActive) {
            hideListBank();
        } else {
            showListBank();
        }
    }

    function showListBank() {
        listBankActive = true;
        document.getElementById('selectItem').style.visibility = "visible";
    }

    function hideListBank() {
        listBankActive = false;
        document.getElementById('selectItem').style.visibility = "hidden";
    }

    function showInputRekening() {
        document.getElementById('inputRekeningBank').style.display = "block";
        document.getElementById('home').style.display = "none";
        indexPage = 0;
    }

    function hideInputRekening() {
        document.getElementById('inputRekeningBank').style.display = "none";
        document.getElementById('home').style.display = "block";
        indexPage = 1;
    }

    $(document).ready(function() {
        document.getElementById('dateKirimLbl').innerHTML = today.getDate() + '/' + today.getMonth() + '/' + today.getFullYear();
        calendarLayoutHide();
        showInputRekening();
        hideListBank();
        getAllBank();
    });

    $('#boxInput').click(function() {
        $('#inputJumlah').focus();
    });

    var inputJumlah = new AutoNumeric('#inputJumlah', {
        decimalPlaces: '0'
    })

    function calendarLayoutShow() {
        document.getElementById('calendarLayout').style.visibility = "visible";
    }

    function calendarLayoutHide() {
        document.getElementById('calendarLayout').style.visibility = "hidden";
    }

    function setJumlah(jumlah) {
        inputJumlah.set(jumlah);
    }

    function goBack() {
        if (indexPage == 0) {
            window.location.href = "{{ url('user/dashboard') }}";
        } else if (indexPage == 1) {
            showInputRekening();
        }
    }

    function lanjutClick() {
        var inputNomorRekening = document.getElementById('inputNomorRekening').value;
        var atasNamaRekening = document.getElementById('atasNamaRekening').value;
        document.getElementById('imageBankPengirim').src = "{{ url('') }}" + '/' + objListBank.listBank[
            indexSelectBank].img;
        document.getElementById('namaPengirim').innerHTML = atasNamaRekening;
        document.getElementById('rekeningDanBankPengirim').innerHTML = objListBank.listBank[indexSelectBank].bank +
            ' | ' + inputNomorRekening;
        // document.getElementById()
        // console.log();
        if ((indexSelectBank != null) && (inputNomorRekening != '') && (atasNamaRekening != '')) {
            hideInputRekening();
        }
    }

    function bayar() {
        window.location.href = "{{ url('user/setoran/wait') }}";
    }

    function next(indexDate) {
        if (indexDate != 0) {
            dateSelect = indexDate;
        }
        currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
        currentMonth = (currentMonth + 1) % 12;
        showCalendar(currentMonth, currentYear);
    }

    function previous(indexDate) {
        if (indexDate != 0) {
            dateSelect = indexDate;
        }
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
        dateSelect = indexDate;
        showCalendar(currentMonth, currentYear);
    }

    function terapkanCalendar() {
        var newDate = currentYear;
        newDate += '-' + (currentMonth + 1);
        newDate += '-' + dateSelect;
        var day = new Date(newDate);
        var stringDay = '';
        stringDay += dateSelect + '/' + (currentMonth + 1) + '/' + currentYear;
        currentDateMonthYear = currentYear + '-' + currentMonth + '-' + dateSelect;
        document.getElementById('dateKirimLbl').innerHTML = stringDay;
        calendarLayoutHide();
    }
</script>

</html>
