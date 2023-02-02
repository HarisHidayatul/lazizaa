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
            width: 100%;
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
            font-size: 20px;
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
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack" onclick="goBack();">
            <h4 class="kembali">Kirim Dari E-wallet</h4>
            <div></div>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-left: 5px; margin-right: 5px; margin-top:100px;">
        <div id="home" style="margin: 0 10px;">
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
            <div class="d-flex justify-content-center align-items-center wrapUpload">
                <label for="file-input">
                    <img src="{{ url('img/icon/uploadCamera.png') }}" alt="" style="height: 30px;">
                </label>
                <div>Upload bukti pembayaran</div>
            </div>
            <div class="wrapBottom">
                <div class="rekTujuan">Pilih rekening tujuan</div>
                <div style="content: ''; height: 15px;"></div>
                <div class="d-flex justify-content-between align-items-center wrapRekTujuan"
                    onclick="showRekeningTujuan();">
                    <div class="d-flex justify-content-start">
                        <div class="wrapImgRekTujuan">
                            <img id="rekTujuanImg" src="" alt="">
                        </div>
                        <div>
                            <div id="rekTujuanLBL" class="rekTujuanLBL"></div>
                            <div id="rekTujuanNum" class="rekTujuanNum"></div>
                        </div>
                    </div>
                    <img src="{{ url('img/icon/backRight2.png') }}" alt="" style="height: 15px;">
                </div>
                <div style="content: ''; height: 35px;"></div>
                <button onclick="sendDataKirim();">Bayar</button>
            </div>
        </div>
        <div id="rekeningTujuan">
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

    var rekeningTujuanActive = false;
    var indexPenerima = null;
    var objAllPenerima = null;


    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu", "Minggu"];

    var currentDateMonthYear = currentYear + '-' + (currentMonth + 1) + '-' + dateSelect;

    let monthAndYear = document.getElementById("monthAndYear");
    showCalendar(currentMonth, currentYear);

    $(document).ready(function() {
        hideRekeningTujuan();
        // showRekeningTujuan();
        showAllPenerima();
        showPengirim();
        calendarLayoutHide();
        document.getElementById('dateKirimLbl').innerHTML = today.getDate() + '/' + (today.getMonth() + 1) +
            '/' +
            today.getFullYear();
    });

    $('#boxInput').click(function() {
        $('#inputJumlah').focus();
    });

    var inputJumlah = new AutoNumeric('#inputJumlah', {
        decimalPlaces: '0'
    })

    function sendDataKirim() {
        $.ajax({
            url: "{{ url('setoran/penerima/sendData') }}",
            type: 'get',
            data: {
                // idBrand: "{{ session('idBrand') }}",
                tanggal: currentDateMonthYear,
                idOutlet: "{{ session('idOutlet') }}",
                idPengirim: "{{ $idPengirim }}",
                idTujuan: objAllPenerima.penerimaListArray[indexPenerima].id,
                qtySetor: parseInt(inputJumlah.rawValue),
            },
            success: function(response) {
                // console.log(response);
                bayar();
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function showPengirim() {
        $.ajax({
            url: "{{ url('setoran/show/pengirim/list') }}" + '/' + "{{ $idPengirim }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var nomorRekeningLength = obj.nomorRekening.length;
                var rekeningDanBankPengirim = obj.bank + ' | <span>.....</span> ';
                rekeningDanBankPengirim += obj.nomorRekening.slice(nomorRekeningLength - 4,
                    nomorRekeningLength);
                document.getElementById('namaPengirim').innerHTML = obj.namaRekening;
                document.getElementById('rekeningDanBankPengirim').innerHTML = rekeningDanBankPengirim;
                document.getElementById('imageBankPengirim').src = "{{ url('') }}" + '/' + obj
                    .imgBank;
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function showAllPenerima() {
        $.ajax({
            url: "{{ url('setoran/penerima/show') }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                objAllPenerima = obj;
                var dataPengirimHTML = '';
                var url = "{{ url('') }}";
                console.log(obj);
                var i = 0;
                for (i = 0; i < obj.penerimaListArray.length; i++) {
                    dataPengirimHTML +=
                        '<div class="d-flex justify-content-between align-items-center wrapListRekening" onclick="selectPenerima(';
                    dataPengirimHTML += i;
                    dataPengirimHTML += ')">';
                    dataPengirimHTML +=
                        '<div class="d-flex justify-content-start"><div class="wrapImgRekening">';
                    dataPengirimHTML += '<img src="';
                    dataPengirimHTML += url + '/' + obj.penerimaListArray[i].imgBank + '" alt="">';
                    dataPengirimHTML +=
                        '</div><div style="margin-left: 15px;"><div class="listBankTittle">';
                    dataPengirimHTML += obj.penerimaListArray[i].namaRekening;
                    dataPengirimHTML += '</div><div class="listBankNumber">';
                    dataPengirimHTML += obj.penerimaListArray[i].nomorRekening;
                    dataPengirimHTML += '</div></div></div>';
                    dataPengirimHTML += '<div class="circleSelect" name="selectPenerima"></div></div>';
                }
                document.getElementById('rekeningTujuan').innerHTML = dataPengirimHTML;
                if (i > 0) {
                    selectPenerima(0);
                }
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function selectPenerima(index) {
        indexPenerima = index;
        var elementSelect = document.getElementsByName('selectPenerima');
        for (var i = 0; i < elementSelect.length; i++) {
            if (i == index) {
                elementSelect[i].classList.add("activeSelectBank");
                continue;
            }
            elementSelect[i].classList.remove("activeSelectBank");
        }
        document.getElementById('rekTujuanImg').src = "{{ url('') }}" + '/' + objAllPenerima.penerimaListArray[
            index].imgBank;
        document.getElementById('rekTujuanLBL').innerHTML = objAllPenerima.penerimaListArray[index].namaRekening;
        document.getElementById('rekTujuanNum').innerHTML = objAllPenerima.penerimaListArray[index].nomorRekening;
        // console.log(elementSelect.length);
    }

    function setJumlah(jumlah) {
        inputJumlah.set(jumlah);
    }

    function showRekeningTujuan() {
        document.getElementById('rekeningTujuan').style.display = "block";
        document.getElementById('home').style.display = "none";
        rekeningTujuanActive = true;
    }

    function hideRekeningTujuan() {
        document.getElementById('rekeningTujuan').style.display = "none";
        document.getElementById('home').style.display = "block";
        rekeningTujuanActive = false;
    }

    function goBack() {
        if (rekeningTujuanActive == true) {
            hideRekeningTujuan();
        } else {
            if ("{{ $fromWhere }}" == "tambah") {
                window.location.href = "{{ url('user/setoran/eWallet/add/pengirim') }}";
            } else if ("{{ $fromWhere }}" == "semua") {
                window.location.href = "{{ url('user/setoran/penerima') }}";
            } else {
                window.location.href = "{{ url('user/setoran/home') }}";
            }
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
        currentDateMonthYear = currentYear + '-' + (currentMonth + 1) + '-' + dateSelect;
        document.getElementById('dateKirimLbl').innerHTML = stringDay;
        calendarLayoutHide();
    }

    function calendarLayoutShow() {
        document.getElementById('calendarLayout').style.visibility = "visible";
    }

    function calendarLayoutHide() {
        document.getElementById('calendarLayout').style.visibility = "hidden";
    }
</script>

</html>
