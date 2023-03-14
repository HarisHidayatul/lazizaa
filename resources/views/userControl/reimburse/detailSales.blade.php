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
        }

        .textModalReimburse {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 17px;
            text-align: center;
            margin-top: 20px;
        }


        .boxInput {
            height: 98px;
            background: #FFFFFF;
            border: 1px solid #E5E7EB;
            border-radius: 16px;
            padding: 12px 12px;
            margin-bottom: 45px;
            margin-top: 30px;
        }

        .jumlahLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 500;
            font-size: 12px;
            line-height: 150%;
            color: #6B7280;
        }

        .satuanLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 150%;
            color: #6B7280;
            margin-top: 5px;
            margin-right: 15px;
        }

        .inputJumlah {
            font-family: 'Montserrat';
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

        button {
            /* width: 100%; */
            margin-top: 25px;
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

        .editText {
            margin-top: 20px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            /* or 22px */

            text-align: center;
            text-decoration-line: underline;

            /* Main color/Red/50 */

            color: #B20731;
            cursor: pointer;
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
                <img src="{{ url('img/icon/detailTransfer.png') }}" alt="" style="width: 86px; height: 86px;">
            </div>
            <div class="detailNominal">Rp <span id="jumlahTransfer">0</span></div>
            <div class="editText" onclick="editClick();">Edit</div>
            <div class="d-flex justify-content-between" style="margin-top: 35px;">
                <div class="statusLabel">Status</div>
                <img id="imageStatusSetoran" src="" alt="" style="width: 77px; height: 25px;">
            </div>
            <div class="wrapPembayaran">
                <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                    <div class="labelPembayaran">Pengisi</div>
                    <div class="detailPembayaran" id="namaPengisi"></div>
                </div>
                <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                    <div class="labelPembayaran">Tanggal</div>
                    <div class="detailPembayaran" id="tanggal"></div>
                </div>
                <div style="border: 1px dashed #7A7A7A; margin-bottom: 10px; margin-top: 10px;"></div>
                <div class="labelPembayaran">Pesan</div>
                <textarea id="pesan" disabled>
                </textarea>
            </div>
        </div>
    </div>
    <div style="height: 100vw;"></div>
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style=" margin-top: 40vw">
            <div class="modal-content" style="height: 350px;border-radius: 48px 48px 0px 0px;">
                <div class="modal-body">
                    <div class="d-flex justify-content-between" style="margin-top: 10px">
                        <div></div>
                        <img src="{{ url('img/dashboard/closeBlack.png') }}" alt="" height="12px"
                            style="margin-right: 5px" onclick="closeEdit();">
                    </div>
                    <div class="textModalReimburse">Reimburse Sales</div>
                    <div class="boxInput" id="boxInput">
                        <div class="jumlahLabel">Jumlah :</div>
                        <div class="d-flex justify-content-start" style="margin-top: 15px; margin-left: 5px;">
                            <div class="satuanLabel">Rp</div>
                            <input class="inputJumlah" type="text" placeholder="0" id="inputJumlah">
                        </div>
                    </div>
                    <button onclick="editSend()" style="width: 100%;">Selesai</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];

    var inputJumlah = new AutoNumeric('#inputJumlah', {
        decimalPlaces: '0'
    });

    $(document).ready(function() {
        getDetail();
    });

    function editClick() {
        $('#exampleModalCenter').modal('show');
    }

    function closeEdit() {
        $('#exampleModalCenter').modal('hide');
    }

    function editSend() {
        $.ajax({
            url: "{{ url('reimburse/sales/edit/detail') }}" + '/' + "{{ $idDetail }}",
            type: 'get',
            data: {
                idOutlet: "{{ session('idOutlet') }}",
                idPengisi: "{{ session('idPengisi') }}",
                total: inputJumlah.rawValue,
            },
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                window.location.href = "{{ url('user/reimburse/sales/detail') }}" + '/' + "{{ $idDetail }}";
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function getDetail() {
        $.ajax({
            url: "{{ url('reimburse/sales/show/detail') }}" + '/' + "{{ $idDetail }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                var day = new Date(obj.tanggal);
                var url = "{{ url('') }}"
                console.log(obj);
                if (obj.idRevisiTotal == '2') {
                    document.getElementById('imageStatusSetoran').src =
                        "{{ url('img/icon/pending.png') }}";
                } else {
                    document.getElementById('imageStatusSetoran').style.visibility = "hidden";
                }
                document.getElementById('jumlahTransfer').innerHTML = obj.total.toLocaleString();
                document.getElementById('namaPengisi').innerHTML = obj.namaPengisi;
                document.getElementById('tanggal').innerHTML = day.getDate() + ' ' + months[day.getMonth()];
                inputJumlah.set(obj.total);
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function goBack() {
        window.location.href = "{{ url('user/dashboard') }}";
    }
</script>

</html>
