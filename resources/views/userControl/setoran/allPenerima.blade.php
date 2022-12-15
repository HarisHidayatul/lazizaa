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
            <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack" onclick="goToHome();">
            <h4 class="kembali">Penerima</h4>
            <div></div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div style="width: 300px; margin-top: 70px;">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text fa fa-search"
                        style="background: white; border-right: none; color:#BEBEBE;"></span>
                </div>
                <input type="text" class="form-control inputSearch" placeholder="Cari nama penerima"
                    style="border-left: none;" id="searchNama" onkeyup="searchNama()">
            </div>
            <div id="searchPenerimaList"></div>
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
    var objAllPenerima = null;
    $(document).ready(function() {
        getAllPenerimaa();
    });

    function getAllPenerimaa() {
        $.ajax({
            url: "{{ url('setoran/show/pengirim/all') }}" + '/' + "{{ session('idPengisi') }}",
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
                dataListBank += '<div class="d-flex justify-content-start rowTransaksi"';
                if (objAllPenerima.pengirimListArray[i].idJenisBank == '1') {
                    dataListBank += ' onclick="goToKirimTransfer(' + objAllPenerima.pengirimListArray[i].id + ')"';
                } else if (objAllPenerima.pengirimListArray[i].idJenisBank == '2') {
                    dataListBank += ' onclick="goToKirimEWallet(' + objAllPenerima.pengirimListArray[i].id + ')"';
                }
                dataListBank += ' >';
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

    function goToKirimEWallet(idPengirim) {
        window.location.href = "{{ url('user/setoran/eWallet/kirim/semua') }}" + '/' + idPengirim;
    }

    function goToKirimTransfer(idPengirim) {
        window.location.href = "{{ url('user/setoran/transfer/kirim/semua') }}" + '/' + idPengirim;
    }

    function goToHome() {
        window.location.href = "{{ url('user/setoran/home') }}";
    }
</script>

</html>
