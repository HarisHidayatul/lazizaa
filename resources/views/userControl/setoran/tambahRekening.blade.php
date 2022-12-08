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

        .rowTransaksi {
            margin-top: 15px;
            padding-bottom: 13px;
            margin-bottom: 13px;
            border-bottom: 1px solid #F3F4F6;
        }

        .nameList {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
        }
        .tittleAll {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            margin-top: 25px;
            margin-bottom: 20px;

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
            <h4 class="kembali">Tambah rekening</h4>
            <div></div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div style="width: 300px; margin-top: 70px;">
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank BCA</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank BCA</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank BRI</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank BNI</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank BSI</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank Mandiri</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank Permata</div>
                    </div>
                </div>
            </div>


            <div class="tittleAll">Semua Bank</div>


            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank Jatim</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank Danamon</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank Jago</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank Bukopin</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank Muamalat</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-start rowTransaksi" onclick="goToTambahRekeningBaru();">
                <div>
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                </div>
                <div style="margin-left: 15px;">
                    <div class="d-flex justify-content-start" style="margin-top: 10px;">
                        <div class="nameList">Bank CIMB Niaga</div>
                    </div>
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
            <div class="d-flex justify-content-center" style="margin-top: 60px;">
                <img src="{{ url('img/icon/instagram.png') }}" alt="" style="height: 20px; width: 20px;">
                <div style="width: 40px;"></div>
                <img src="{{ url('img/icon/facebook.png') }}" alt="" style="width: 12px; height: 23px;">
                <div style="width: 40px;"></div>
                <img src="{{ url('img/icon/whatsapp.png') }}" alt="" style="width: 24px; height: 24px;">
            </div>
            <div style="height: 20px;"></div>
            <div class="footerLaporta"><span style="font-size: 16px; margin-top: 5px;">&#169;</span> 2022 - Laporta</div>
        </div>
    </div>
</body>
<script>
    function goToHome() {
        window.location.href = "{{ url('user/setoran/home') }}";
    }
    function goToTambahRekeningBaru(){
        window.location.href = "{{ url('user/setoran/transfer/add/pengirim') }}";
    }
</script>
</html>
