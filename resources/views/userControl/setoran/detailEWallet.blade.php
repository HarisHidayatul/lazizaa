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

        .detailNominal {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            line-height: 120%;
            align-items: center;
            text-align: center;
            color: #000000;
            margin-top: 20px;
        }

        .statusLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            align-items: center;
        }

        .wrapPembayaran {
            background: #FAFAFA;
            border-radius: 12px;
            margin-top: 20px;
            padding: 10px 10px;
        }

        .labelPembayaran {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            /* text-align: center; */
            color: #9C9C9C;
        }

        .detailPembayaran {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            /* identical to box height */

            /* text-align: center; */

            /* Greyscale/60 */

            color: #585858;
        }

        .wrapBukti {
            margin-top: 10px;
            height: 43px;
            background: #FFFFFF;
            border-radius: 8px;
            padding: 0 10px;
        }

        .wrapBukti div {
            margin-left: 15px;
        }

        .penerimaLabel {
            margin-top: 20px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }


        .wrapPenerima {
            height: 72px;
            background: #FAFAFA;
            border: 1px solid #FAFAFA;
            border-radius: 12px;
            padding: 0 10px;
        }

        .boxBank {
            width: 42px;
            height: 42px;
            background: #FFFFFF;
            border-radius: 8px;
        }

        .boxBank img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .penerimaNama {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
        }

        .penerimaRekening {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            color: #BEBEBE;
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
            <h4 class="kembali">Detail pembayaran</h4>
            <div></div>
        </div>
    </div>
    <div style="height: 80px;"></div>
    <div class="d-flex justify-content-center">
        <div style="width: 90%;">
            <div class="d-flex justify-content-center">
                <img src="{{ url('img/icon/detailEWallet.png') }}" alt="" style="width: 86px; height: 86px;">
            </div>
            <div class="detailNominal">Rp <span id="qtySetoran">0</span></div>
            <div class="d-flex justify-content-between" style="margin-top: 35px;">
                <div class="statusLabel">Status</div>
                <img id="imageStatusSetoran" src="" alt="" style="width: 77px; height: 25px;">
            </div>
            <div class="wrapPembayaran">
                <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                    <div class="labelPembayaran">Pengirim</div>
                    <div class="detailPembayaran" id="namaRekeningPengirim"></div>
                </div>
                <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                    <div class="labelPembayaran">Tanggal</div>
                    <div class="detailPembayaran" id="dateAndTime"></div>
                </div>
                <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                    <div class="labelPembayaran">Rekening</div>
                    <div class="detailPembayaran">.....<span id="nomorRekeningPengirim"></span></div>
                </div>
                <div style="border: 1px dashed #7A7A7A; margin-bottom: 10px; margin-top: 10px;"></div>
                <div class="labelPembayaran">Bukti transfer</div>
                <div class="d-flex justify-content-start align-items-center wrapBukti">
                    <img src="{{ url('img/icon/image.png') }}" alt="" style="height: 20px;">
                    <a class="detailPembayaran" target="_blank" rel="noopener noreferrer" href="#"  id="filePathName" style="margin-left: 5px;">
                        Img_332323_95682.png
                    </a>
                </div>
            </div>
            <div class="penerimaLabel">Penerima</div>
            <div class="d-flex justify-content-start align-items-center wrapPenerima" style="margin-top: 10px;">
                <div class="boxBank">
                    <img id="imageBankPenerima" src="" alt="">
                </div>
                <div style="margin-left: 10px;">
                    <div class="penerimaNama" id="namaRekeningPenerima">PT. Lazizaa Rahmat Semesta</div>
                    <div class="penerimaRekening" id="nomorRekeningPenerima">008-26816111664</div>
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
    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];

    $(document).ready(function() {
        getDetail();
    });

    function getDetail() {
        $.ajax({
            url: "{{ url('setoran/show/detail') }}" + '/' + "{{ $idSetoran }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                var day = new Date(obj.date);
                var nomorRekeningLength = obj.nomorRekeningPengirim.length;
                console.log(obj);
                document.getElementById('qtySetoran').innerHTML = obj.qty.toLocaleString().replace(',','.');
                if (obj.idStatus == '2') {
                    document.getElementById('imageStatusSetoran').src =
                        "{{ url('img/icon/pending.png') }}";
                } else {
                    document.getElementById('imageStatusSetoran').src =
                        "{{ url('img/icon/sukses.png') }}";
                }
                document.getElementById('filePathName').href = "{{ url('storage') }}" + '/' + obj.imagePathFile;
                document.getElementById('filePathName').innerHTML = obj.imagePathFile;
                document.getElementById('namaRekeningPengirim').innerHTML = obj.namaRekeningPengirim;
                document.getElementById('dateAndTime').innerHTML = day.getDate() + ' ' + months[day.getMonth()] + ' - ' + obj.time;
                document.getElementById('nomorRekeningPengirim').innerHTML = obj.nomorRekeningPengirim.slice(nomorRekeningLength - 4,nomorRekeningLength);
                document.getElementById('namaRekeningPenerima').innerHTML = obj.namaRekeningPenerima;
                document.getElementById('nomorRekeningPenerima').innerHTML = obj.nomorRekeningPenerima;
                document.getElementById('imageBankPenerima').src = "{{ url('') }}" + '/' + obj.imageBankPenerima;
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function goBack() {
        if ("{{ $fromWhere }}" == "history") {
            window.location.href = "{{ url('user/setoran/history') }}";
        } else if ("{{ $fromWhere }}" == "home") {
            window.location.href = "{{ url('user/setoran/home') }}";
        }
    }
</script>

</html>
