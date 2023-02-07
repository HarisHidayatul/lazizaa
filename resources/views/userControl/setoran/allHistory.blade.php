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

        .imageWrapHistory {
            width: 42px;
            height: 42px;
            background: #F9FAFB;
            border-radius: 12px;
        }

        .imageWrapHistory img {
            width: 40px;
            height: 40px;
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
            <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack" onclick="goToHome();">
            <h4 class="kembali">History setoran sales</h4>
            <div></div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div style="width: 300px; margin-top: 65px;">
            <div id="allHistoryTransaksi"></div>
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
    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];

    $(document).ready(function() {
        getAllHistory();
    })

    function getAllHistory() {
        $.ajax({
            url: "{{ url('setoran/show/data/all') }}" + '/' + "{{ session('idOutlet') }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var allHistoryTransaksi = '';
                var url = "{{ url('') }}";
                for (var i = 0; i < obj.setoran.length; i++) {
                    var day = new Date(obj.setoran[i].Tanggal);
                    allHistoryTransaksi += '<div class="dateTransaksi">';
                    allHistoryTransaksi += day.getDate() + ' ' + months[day.getMonth()];
                    allHistoryTransaksi += '</div>';
                    for (var j = 0; j < obj.setoran[i].setoran.length; j++) {
                        allHistoryTransaksi +=
                            '<div class="d-flex justify-content-between rowTransaksi"';
                        if (obj.setoran[i].setoran[j].idJenis == '1') {
                            allHistoryTransaksi += ' onclick="goToTransferDetail(' + obj.setoran[i].setoran[
                                    j]
                                .id + ');"';
                        } else if (obj.setoran[i].setoran[j].idJenis == '2') {
                            allHistoryTransaksi += ' onclick="goToEWalletDetail(' + obj.setoran[i].setoran[
                                    j]
                                .id + ');"';
                        }
                        allHistoryTransaksi += '>';
                        allHistoryTransaksi += '<div class="d-flex justify-content-start">';
                        allHistoryTransaksi += '<div class="imageWrapHistory">';
                        allHistoryTransaksi += '<img src="' + url + '/' + obj.setoran[i].setoran[j]
                            .imgBank +
                            '" alt="">';
                        allHistoryTransaksi += '</div>';
                        allHistoryTransaksi += '<div style="margin-left: 15px;">';
                        allHistoryTransaksi +=
                            '<div class="d-flex justify-content-start" style="margin-top: 2px;">';
                        allHistoryTransaksi += '<div class="nameTransaksi">';

                        if (obj.setoran[i].setoran[j].namaRekening.length > 7) {
                            allHistoryTransaksi += obj.setoran[i].setoran[j].namaRekening.substring(0, 7) +
                                "...";
                        } else {
                            allHistoryTransaksi += obj.setoran[i].setoran[j].namaRekening;
                        }

                        // allHistoryTransaksi += obj.setoran[i].setoran[j].namaRekening;
                        allHistoryTransaksi += '</div>';
                        if (obj.setoran[i].setoran[j].idRev == '2') {
                            allHistoryTransaksi += '<img src="' + url + '/' + 'img/icon/pending.png' + '"';
                            allHistoryTransaksi += ' alt=""style="height: 14px; margin-top: 2px;">';
                        } else {
                            allHistoryTransaksi += '<img src="' + url + '/' + 'img/icon/sukses.png' + '"';
                            allHistoryTransaksi += ' alt=""style="height: 14px; margin-top: 2px;">';
                        }
                        allHistoryTransaksi += '</div>';
                        allHistoryTransaksi += '<div class="clockTransaksi">';
                        allHistoryTransaksi += obj.setoran[i].setoran[j].time;
                        allHistoryTransaksi += ' WIB</div>';
                        allHistoryTransaksi += '</div></div>';
                        allHistoryTransaksi += '<div class="priceTransaksi">Rp ';
                        allHistoryTransaksi += parseInt(obj.setoran[i].setoran[j].qty).toLocaleString().replace(',',
                            '.');
                        allHistoryTransaksi += '</div></div>';
                    }
                    document.getElementById('allHistoryTransaksi').innerHTML = allHistoryTransaksi;
                }
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function goToHome() {
        window.location.href = "{{ url('user/setoran/home') }}";
    }

    function goToEWalletDetail(idSetoran) {
        window.location.href = "{{ url('user/setoran/eWallet/detail/history') }}" + '/' + idSetoran;
    }

    function goToTransferDetail(idSetoran) {
        window.location.href = "{{ url('user/setoran/transfer/detail/history') }}" + '/' + idSetoran;
    }
</script>

</html>
