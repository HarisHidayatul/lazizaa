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
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap');

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

        input {
            background: #FFFFFF;
            /* Main color/Red/50 */
            width: 100%;
            height: 35px;
            border: 1.0663px solid #E0E0E0;
            box-shadow: 0px 0px 0.394561px rgba(12, 26, 75, 0.24), 0px 1.18368px 3.15649px -0.394561px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
            padding-left: 10px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14.2174px;
            line-height: 140%;
            color: #E0E0E0;
        }

        input:focus {
            outline: 1.0663px solid #B20731;
            color: #585858;
        }

        input:valid {
            color: #585858;
        }

        input::placeholder {
            color: #E0E0E0;
        }

        .labelInput {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14.2174px;
            line-height: 140%;
            color: #585858;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        button {
            width: 100%;
            height: 35px;
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

        .logoBankWrap {
            width: 48px;
            height: 48px;
            background: #F9FAFB;
            border-radius: 12px;
            align-items: center;
        }

        .logoBankWrap img {
            width: 37px;
            height: 37px;
            object-fit: contain;
            margin-top: 5px;
            margin-left: 5px;
        }

        .tambahEWalletLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
            margin-top: 12px;
            margin-left: 12px;
        }

        .wrapTambahEWallet {
            margin-top: 20px;
            padding-bottom: 15px;
            margin-bottom: 15px;
            border-bottom: 1px solid #F3F4F6;
        }

        .pengirimLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }

        .semuaLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
        }

        .pengirimWrapLogoBank {
            background: #F9FAFB;
            border-radius: 12px;
            width: 48px;
            height: 48px;
            margin-bottom: 7px;
            margin-left: 18px;
            margin-right: 18px;
        }

        .pengirimWrapLogoBank img {
            width: 35px;
            height: 35px;
            margin-top: 7px;
            margin-left: 7px;
            object-fit: contain;
        }

        .pengirimBank {
            margin-top: 10px;
            display: flex;
            overflow-x: auto;
        }

        .wrapPengirimBank {
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 16px;
            width: 85px;
            margin-right: 10px;
        }

        .pengirimWrapLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            text-align: center;
            color: #585858;
            margin-top: 15px;
            padding-bottom: 20px;
        }

        .dateTransaksi {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #6B7280;
            margin-top: 30px;
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

        .inputSearch {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #BEBEBE;
        }

        .inputSearch::placeholder {
            color: #BEBEBE;
        }
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack" onclick="goToHome();">
            <h4 class="kembali">Tambah E-wallet baru</h4>
            <div></div>
        </div>
    </div>
    <div style="height: 50px;"></div>

    {{-- halaman utama --}}
    <div id="homeAddSetoran">
        <div class="d-flex justify-content-center">
            <div style="width: 350px; margin: 0 10px;">
                <div style="content: ''; height: 40px;"></div>
                <div class="labelInput">Tambah E-Wallet</div>
                <div id="listBankAll"></div>
                <div style="height: 30px;"></div>
                <div class="d-flex justify-content-between">
                    <div class="pengirimLabel">Pengirim</div>
                    <div class="semuaLabel" onclick="showSearchPenerima();">Semua</div>
                </div>
                <div id="pengirimBankPart"></div>
            </div>
        </div>
    </div>
    {{-- Search all penerima --}}
    <div id="searchPenerima">
        <div class="d-flex justify-content-center">
            <div style="width: 300px; margin-top: 70px;">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text fa fa-search"
                            style="background: white; border-right: none; color:#BEBEBE;"></span>
                    </div>
                    <input type="text" class="form-control inputSearch" placeholder="Cari nama penerima"
                        style="border-left: none;" onkeyup="searchNama()" id="searchNama">
                </div>
                <div id="searchPenerimaList"></div>
            </div>
        </div>
    </div>
    {{-- tambah e wallet baru form --}}
    <div id="addSetoranId">
        <div class="d-flex justify-content-center">
            <div style="width: 350px; margin: 0 10px;">
                <div style="content: ''; height: 40px;"></div>
                <div class="labelInput">Nomor E-wallet</div>
                <input type="number" placeholder="Contoh: 08123456789" id="nomorRekening">
                <div class="labelInput">Nama pemilik</div>
                <input type="text" placeholder="Contoh: Nama pemilik E-wallet" id="namaRekening">
                <div style="content: ''; height: 300px;"></div>
                <button onclick="createNewId();">Tambah ke penerima baru</button>
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
    var backIndex = 0;
    var idBank = 0;
    var objAllPenerima = null;
    $(document).ready(function() {
        showHomeAddSetoran();
        // showSearchPenerima();
        getAllBank();
        getListBankInPart();
        getAllPenerimaa();
    })

    function searchNama() {
        var nama = document.getElementById('searchNama').value.toUpperCase();
        var dataListBank = '';
        var alphabetFirst = '';
        var url = "{{ url('') }}";
        for (var i = 0; i < objAllPenerima.pengirimListArray.length; i++) {
            if (nama.length == 0) {
                var firstChar = objAllPenerima.pengirimListArray[i].namaRekening.substring(0, 1);
                if (firstChar != alphabetFirst) {
                    alphabetFirst = firstChar;
                    dataListBank += '<div class="dateTransaksi">';
                    dataListBank += firstChar;
                    dataListBank += '</div>';
                }
            }
            if (objAllPenerima.pengirimListArray[i].namaRekening.toUpperCase().indexOf(nama) > -1) {
                dataListBank += '<div class="d-flex justify-content-start rowTransaksi" onclick="goToKirimEWallet('+objAllPenerima.pengirimListArray[i].id+')">';
                dataListBank += '<div class="logoBankWrap"><img src="' + url + '/' + objAllPenerima.pengirimListArray[i]
                    .imgBank;
                dataListBank += '" alt="" style="height: 40px;"></div>';
                dataListBank += '<div style="margin-left: 15px;">';
                dataListBank += '<div class="d-flex justify-content-start" style="margin-top: 2px;">';
                dataListBank += '<div class="nameTransaksi">' + objAllPenerima.pengirimListArray[i].namaRekening +
                    '</div></div>';
                dataListBank += '<div class="clockTransaksi">' + objAllPenerima.pengirimListArray[i].nomorRekening +
                    '</div></div></div>';
            }
        }
        document.getElementById('searchPenerimaList').innerHTML = dataListBank;
    }

    function getAllPenerimaa() {
        $.ajax({
            url: "{{ url('setoran/show/pengirim/eWallet/all') }}" + '/' + "{{ session('idPengisi') }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                objAllPenerima = obj;
                searchNama();
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function getAllBank() {
        $.ajax({
            url: "{{ url('setoran/bank/show') }}" + '/' + "2",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var dataListBank = '';
                for (var i = 0; i < obj.listBank.length; i++) {
                    var url = "{{ url('') }}"
                    dataListBank +=
                        '<div class="d-flex justify-content-start wrapTambahEWallet" onclick="showSetoranAddId(' +
                        obj.listBank[i].id +
                        ');">';
                    dataListBank += '<div class="logoBankWrap">';
                    dataListBank += '<img src="' + url + '/' + obj.listBank[i].img + '" alt="">';
                    dataListBank += '</div><div class="tambahEWalletLabel">';
                    dataListBank += obj.listBank[i].bank;
                    dataListBank += '</div></div>';
                }
                document.getElementById('listBankAll').innerHTML = dataListBank;
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function getListBankInPart() {
        $.ajax({
            url: "{{ url('setoran/show/pengirim/eWallet/inPart') }}" + '/' + "{{ session('idPengisi') }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var pengirimHTML = '';
                var url = "{{ url('') }}";
                pengirimHTML += '<div class="pengirimBank">';
                for (var i = 0; i < obj.pengirimListArray.length; i++) {
                    pengirimHTML +=
                        '<div class="wrapPengirimBank" onclick="goToKirimEWallet('+obj.pengirimListArray[i].id+')"><div style="height: 10px;"></div><div class="pengirimWrapLogoBank">';
                    pengirimHTML += '<img src="' + url + '/' + obj.pengirimListArray[i].imgBank +
                        '" alt="">';
                    pengirimHTML += '</div><div class="pengirimWrapLabel">';
                    if (obj.pengirimListArray[i].namaRekening.length > 4) {
                        pengirimHTML += obj.pengirimListArray[i].namaRekening.substring(0, 4) + "...";
                    } else {
                        pengirimHTML += obj.pengirimListArray[i].namaRekening;
                    }
                    pengirimHTML += '</div></div>';
                }
                pengirimHTML += '</div>';
                document.getElementById('pengirimBankPart').innerHTML = pengirimHTML;
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function createNewId() {
        $.ajax({
            url: "{{ url('setoran/user/pengirim/createID') }}",
            type: 'get',
            data: {
                idUser: "{{ session('idPengisi') }}",
                namaRekening: document.getElementById('namaRekening').value,
                nomorRekening: document.getElementById('nomorRekening').value,
                idBank: idBank
            },
            success: function(response) {
                console.log(response);
                goToKirimEWallet(response);
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function goToKirimEWallet(idPengirim){
        window.location.href = "{{ url('user/setoran/eWallet/kirim/tambah') }}" + '/' + idPengirim;
    }

    function showHomeAddSetoran() {
        backIndex = 0;
        document.getElementById("homeAddSetoran").style.display = "block";
        document.getElementById("searchPenerima").style.display = "none";
        document.getElementById("addSetoranId").style.display = "none";
    }

    function showSearchPenerima() {
        backIndex = 1;
        document.getElementById("homeAddSetoran").style.display = "none";
        document.getElementById("searchPenerima").style.display = "block";
        document.getElementById("addSetoranId").style.display = "none";
    }

    function showSetoranAddId(indexBank) {
        backIndex = 2;
        idBank = indexBank;
        console.log(idBank);
        document.getElementById("homeAddSetoran").style.display = "none";
        document.getElementById("searchPenerima").style.display = "none";
        document.getElementById("addSetoranId").style.display = "block";
    }

    function goToHome() {
        if (backIndex == 2) {
            showHomeAddSetoran();
        } else if (backIndex == 1) {
            showHomeAddSetoran();
        } else {
            window.location.href = "{{ url('user/setoran/home') }}";
        }
    }
</script>

</html>
