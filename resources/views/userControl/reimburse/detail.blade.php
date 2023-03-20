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

        button {
            width: 100%;
            margin-top: 10px;
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

        .textDelete {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            /* or 28px */

            text-align: center;
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
            <div id="deleteText" class="editText" onclick="deleteClick();">Delete</div>
            <div class="d-flex justify-content-between" style="margin-top: 35px;">
                <div class="statusLabel">Status</div>
                <img id="imageStatusSetoran" src="" alt="" style="width: 77px; height: 25px;">
            </div>
            <div class="wrapPembayaran">
                <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                    <div class="labelPembayaran">Pengirim</div>
                    <div class="detailPembayaran" id="namaPengirim"></div>
                </div>
                <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                    <div class="labelPembayaran">Tanggal</div>
                    <div class="detailPembayaran" id="tanggal"></div>
                </div>
                <div class="d-flex justify-content-between" style="margin-bottom: 10px;">
                    <div class="labelPembayaran">Rekening</div>
                    <div class="detailPembayaran" id="rekeningPengirim">.....<span></span></div>
                </div>
                <div style="border: 1px dashed #7A7A7A; margin-bottom: 10px; margin-top: 10px;"></div>
                <div class="labelPembayaran">Pesan</div>
                <textarea id="pesan" disabled>

                </textarea>
                <div class="labelPembayaran">Bukti transfer</div>
                <div class="d-flex justify-content-start align-items-center wrapBukti">
                    <img src="{{ url('img/icon/image.png') }}" alt="" style="height: 20px;">
                    <div class="detailPembayaran">
                        <a target="_blank" rel="noopener noreferrer" href="#" id="filePathName"></a>
                    </div>
                </div>
            </div>
            <div class="penerimaLabel">Penerima</div>
            <div class="d-flex justify-content-start align-items-center wrapPenerima" style="margin-top: 10px;">
                <div class="boxBank">
                    <img id="imgBankPenerima" src="" alt="">
                </div>
                <div style="margin-left: 10px;">
                    <div class="penerimaNama" id="namaPenerima"></div>
                    <div class="penerimaRekening" id="rekeningPenerima"></div>
                </div>
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
            <div class="modal-content" style="height: 350px;border-radius: 24px 24px 24px 24px;">
                <div class="modal-body">
                    <div style="height: 35px;"></div>
                    <div class="d-flex justify-content-center">
                        <img src="{{ url('img/icon/iconModal.png') }}" alt="" style="height: 70px">
                    </div>
                    <p class="textDelete">Apakah ingin menghapus item ini?</p>
                    {{-- <div style="height: 30px"></div> --}}
                    <button onclick="deleteReimburse();">Hapus</button>
                    <button style="background: #FFEAEF; color: #B20731;">Batal</button>
                </div>
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


    function deleteClick() {
        $('#exampleModalCenter').modal('show');
    }

    function closeDelete() {
        $('#exampleModalCenter').modal('hide');
    }

    function getDetail() {
        $.ajax({
            url: "{{ url('reimburse/show/detail') }}" + '/' + "{{ $idDetail }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                var day = new Date(obj.tanggal);
                var url = "{{ url('') }}"
                console.log(obj);
                document.getElementById('namaPenerima').innerHTML = obj.namaPenerima;
                document.getElementById('rekeningPenerima').innerHTML = obj.rekeningPenerima;
                document.getElementById('imgBankPenerima').src = url + '/' + obj.imgBankPenerima;
                document.getElementById('pesan').innerHTML = obj.pesan;
                document.getElementById('tanggal').innerHTML = day.getDate() + ' ' + months[day.getMonth()];
                document.getElementById('jumlahTransfer').innerHTML = parseInt(obj.jumlahTransfer)
                    .toLocaleString();
                if (obj.idRevisi == '2') {
                    document.getElementById('imageStatusSetoran').src =
                        "{{ url('img/icon/pending.png') }}";
                } else {
                    document.getElementById('deleteText').style.visibility = "hidden";
                    document.getElementById('imageStatusSetoran').src = "{{ url('img/icon/sukses.png') }}";
                    document.getElementById('namaPengirim').innerHTML = obj.namaPengirim;
                    document.getElementById('rekeningPengirim').innerHTML = obj.rekeningPengirim;
                    document.getElementById('filePathName').href = "{{ url('storage') }}" + '/' + obj
                        .imageBukti;
                    document.getElementById('filePathName').innerHTML = obj.imageBukti.substring(20, 35) +
                        '....';
                }
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function deleteReimburse() {
        $.ajax({
            url: "{{ url('reimburse/delete/accounting/revisi') }}" + '/' + "{{ $idDetail }}",
            type: 'get',
            success: function(response) {
                goBack();
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function goBack() {
        window.location.href = "{{ url('user/reimburse/history') }}";
    }
</script>

</html>
