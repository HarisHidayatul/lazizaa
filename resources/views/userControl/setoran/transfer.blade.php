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

        .lblTittle {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }

        .lblSemua {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
        }

        .listTopText {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
            text-align: center;
        }

        .boxListTop {
            width: 95px;
            height: 100px;
            background: #F9FAFB;
            border-radius: 12px;
            justify-content: center;
            margin-bottom: 10px;
            margin-right: 10px;
        }

        .boxListTop img {
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 22px;
            height: 50px;
        }

        .newBank {
            margin-top: 20px;
            background: #F9FAFB;
            border-radius: 16px;
            height: 50px;
            padding-left: 15px;
            padding-right: 15px;
        }

        .labelNewBank {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 700;
            font-size: 16px;
            line-height: 150%;
            color: #585858;
            margin-left: 10px;
            margin-top: -2px;
        }

        .pengirimBottom {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            text-align: center;
            color: #585858;
        }

        .wrapBottom {
            flex: 0 0 82px;
            height: 115px;
            background: #F9FAFB;
            border-radius: 16px;
            margin-right: 15px;
        }
        .wrapBottom img{
            height: 45px;
            margin-top: 15px;
            margin-left: 15px;
            margin-bottom: 10px;
        }
        .wrapPengirim{
            margin-top: 10px; 
            display: flex;
            overflow-x: auto;
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
            <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack">
            <h4 class="kembali">Transfer Bank</h4>
            <div></div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div style="width: 315px; margin-top: 70px;">
            <div class="d-flex justify-content-between">
                <div class="lblTittle">Tambah rekening</div>
                <div class="lblSemua">Semua</div>
            </div>
            <div style="display: flex; flex-flow: wrap; margin-top: 20px;">
                <div class="boxListTop">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="listTopText">BCA</div>
                </div>
                <div class="boxListTop">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="listTopText">BRI</div>
                </div>
                <div class="boxListTop">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="listTopText">BNI</div>
                </div>
                <div class="boxListTop">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="listTopText">BSI</div>
                </div>
                <div class="boxListTop">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="listTopText">Mandiri</div>
                </div>
                <div class="boxListTop">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="listTopText">Permata</div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center newBank">
                <div class="d-flex justify-content-start">
                    <img src="{{ url('img/pembayaran/addBank.png') }}" alt="" style="height: 17px;">
                    <div class="labelNewBank">Add new bank</div>
                </div>
                <img src="{{ url('img/icon/arrowRight.png') }}" alt="" style="height: 17px;">
            </div>
            <div class="d-flex justify-content-between" style="margin-top: 30px;">
                <div class="lblTittle">Pengirim</div>
                <div class="lblSemua">Semua</div>
            </div>
            <div class="wrapPengirim">
                <div class="wrapBottom">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="pengirimBottom">Muha...</div>
                </div>
                <div class="wrapBottom">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="pengirimBottom">Aditya</div>
                </div>
                <div class="wrapBottom">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="pengirimBottom">Siti</div>
                </div>
                <div class="wrapBottom">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="pengirimBottom">Siti</div>
                </div>
                <div class="wrapBottom">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="pengirimBottom">Siti</div>
                </div>
                <div class="wrapBottom">
                    <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="">
                    <div class="pengirimBottom">Siti</div>
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

</html>
