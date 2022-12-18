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

        .wrapImgRekTujuan img{
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
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack" onclick="goBack();">
            <h4 class="kembali">Kirim Dari Rekening</h4>
            <div></div>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-left: 5px; margin-right: 5px; margin-top:100px;">
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
                <img src="{{ url('img/icon/uploadCamera.png') }}" alt="" style="height: 30px;">
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
    var rekeningTujuanActive = false;
    var indexPenerima = null;
    var objAllPenerima = null;

    $(document).ready(function() {
        hideRekeningTujuan();
        // showRekeningTujuan();
        showAllPenerima();
        showPengirim();
    });

    $('#boxInput').click(function() {
        $('#inputJumlah').focus();
    });

    var inputJumlah = new AutoNumeric('#inputJumlah', {
        decimalPlaces: '0'
    })

    function sendDataKirim(){
        $.ajax({
            url: "{{ url('setoran/penerima/sendData') }}",
            type: 'get',
            data: {
                // idBrand: "{{ session('idBrand') }}",
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
        document.getElementById('rekTujuanImg').src = "{{ url('') }}" + '/' + objAllPenerima.penerimaListArray[index].imgBank;
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
                window.location.href = "{{ url('user/setoran/transfer/add/pengirim') }}";
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
</script>

</html>
