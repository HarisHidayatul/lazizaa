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
            width: 46px;
            height: 46px;
            object-fit: contain;
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
            width: 46px;
            height: 46px;
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
                <div class="d-flex justify-content-start wrapTambahEWallet" onclick="showSetoranAddId();">
                    <div class="logoBankWrap">
                        <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                    </div>
                    <div class="tambahEWalletLabel">Dana</div>
                </div>
                <div class="d-flex justify-content-start wrapTambahEWallet" onclick="showSetoranAddId();">
                    <div class="logoBankWrap">
                        <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                    </div>
                    <div class="tambahEWalletLabel">Gopay</div>
                </div>
                <div class="d-flex justify-content-start wrapTambahEWallet" onclick="showSetoranAddId();">
                    <div class="logoBankWrap">
                        <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                    </div>
                    <div class="tambahEWalletLabel">Shopeepay</div>
                </div>
                <div class="d-flex justify-content-start wrapTambahEWallet" onclick="showSetoranAddId();">
                    <div class="logoBankWrap">
                        <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                    </div>
                    <div class="tambahEWalletLabel">OVO</div>
                </div>
                <div style="height: 30px;"></div>
                <div class="d-flex justify-content-between">
                    <div class="pengirimLabel">Pengirim</div>
                    <div class="semuaLabel" onclick="showSearchPenerima();">Semua</div>
                </div>
                <div class="pengirimBank">
                    <div class="wrapPengirimBank">
                        <div style="height: 10px;"></div>
                        <div class="pengirimWrapLogoBank">
                            <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                        </div>
                        <div class="pengirimWrapLabel">Siti</div>
                    </div>
                    <div class="wrapPengirimBank">
                        <div style="height: 10px;"></div>
                        <div class="pengirimWrapLogoBank">
                            <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                        </div>
                        <div class="pengirimWrapLabel">Siti</div>
                    </div>
                    <div class="wrapPengirimBank">
                        <div style="height: 10px;"></div>
                        <div class="pengirimWrapLogoBank">
                            <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                        </div>
                        <div class="pengirimWrapLabel">Siti</div>
                    </div>
                    <div class="wrapPengirimBank">
                        <div style="height: 10px;"></div>
                        <div class="pengirimWrapLogoBank">
                            <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                        </div>
                        <div class="pengirimWrapLabel">Siti</div>
                    </div>
                    <div class="wrapPengirimBank">
                        <div style="height: 10px;"></div>
                        <div class="pengirimWrapLogoBank">
                            <img src="{{ url('img/pembayaran/logoBank/transfer/bca.png') }}" alt="">
                        </div>
                        <div class="pengirimWrapLabel">Siti</div>
                    </div>
                </div>
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
                        style="border-left: none;">
                </div>
                <div class="dateTransaksi">A</div>
                <div class="d-flex justify-content-start rowTransaksi">
                    <div>
                        <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt="" style="height: 40px;">
                    </div>
                    <div style="margin-left: 15px;">
                        <div class="d-flex justify-content-start" style="margin-top: 2px;">
                            <div class="nameTransaksi">Abdul</div>
                        </div>
                        <div class="clockTransaksi">08123456789</div>
                    </div>
                </div>
                <div class="d-flex justify-content-start rowTransaksi">
                    <div>
                        <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt=""
                            style="height: 40px;">
                    </div>
                    <div style="margin-left: 15px;">
                        <div class="d-flex justify-content-start" style="margin-top: 2px;">
                            <div class="nameTransaksi">Arifin</div>
                        </div>
                        <div class="clockTransaksi">08123456789</div>
                    </div>
                </div>
                <div class="d-flex justify-content-start rowTransaksi">
                    <div>
                        <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt=""
                            style="height: 40px;">
                    </div>
                    <div style="margin-left: 15px;">
                        <div class="d-flex justify-content-start" style="margin-top: 2px;">
                            <div class="nameTransaksi">Achmad</div>
                        </div>
                        <div class="clockTransaksi">08123456789</div>
                    </div>
                </div>
                <div class="dateTransaksi">B</div>
                <div class="d-flex justify-content-start rowTransaksi">
                    <div>
                        <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt=""
                            style="height: 40px;">
                    </div>
                    <div style="margin-left: 15px;">
                        <div class="d-flex justify-content-start" style="margin-top: 2px;">
                            <div class="nameTransaksi">Budi</div>
                        </div>
                        <div class="clockTransaksi">08123456789</div>
                    </div>
                </div>
                <div class="d-flex justify-content-start rowTransaksi">
                    <div>
                        <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt=""
                            style="height: 40px;">
                    </div>
                    <div style="margin-left: 15px;">
                        <div class="d-flex justify-content-start" style="margin-top: 2px;">
                            <div class="nameTransaksi">Burhan</div>
                        </div>
                        <div class="clockTransaksi">08123456789</div>
                    </div>
                </div>
                <div class="d-flex justify-content-start rowTransaksi">
                    <div>
                        <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt=""
                            style="height: 40px;">
                    </div>
                    <div style="margin-left: 15px;">
                        <div class="d-flex justify-content-start" style="margin-top: 2px;">
                            <div class="nameTransaksi">Bambang</div>
                        </div>
                        <div class="clockTransaksi">08123456789</div>
                    </div>
                </div>
                <div class="dateTransaksi">C</div>
                <div class="d-flex justify-content-start rowTransaksi">
                    <div>
                        <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt=""
                            style="height: 40px;">
                    </div>
                    <div style="margin-left: 15px;">
                        <div class="d-flex justify-content-start" style="margin-top: 2px;">
                            <div class="nameTransaksi">Cahyo</div>
                        </div>
                        <div class="clockTransaksi">08123456789</div>
                    </div>
                </div>
                <div class="d-flex justify-content-start rowTransaksi">
                    <div>
                        <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt=""
                            style="height: 40px;">
                    </div>
                    <div style="margin-left: 15px;">
                        <div class="d-flex justify-content-start" style="margin-top: 2px;">
                            <div class="nameTransaksi">Candra</div>
                        </div>
                        <div class="clockTransaksi">08123456789</div>
                    </div>
                </div>
                <div class="d-flex justify-content-start rowTransaksi">
                    <div>
                        <img src="{{ url('img/pembayaran/logoBank/bca.png') }}" alt=""
                            style="height: 40px;">
                    </div>
                    <div style="margin-left: 15px;">
                        <div class="d-flex justify-content-start" style="margin-top: 2px;">
                            <div class="nameTransaksi">Cipto</div>
                        </div>
                        <div class="clockTransaksi">08123456789</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- tambah e wallet baru form --}}
    <div id="addSetoranId">
        <div class="d-flex justify-content-center">
            <div style="width: 350px; margin: 0 10px;">
                <div style="content: ''; height: 40px;"></div>
                <div class="labelInput">Nomor E-wallet</div>
                <input type="text" placeholder="Contoh: 08123456789">
                <div class="labelInput">Nama pemilik</div>
                <input type="text" placeholder="Contoh: Nama pemilik E-wallet">
                <div style="content: ''; height: 300px;"></div>
                <button onclick="goToKirim();">Tambah ke penerima baru</button>
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
    $(document).ready(function() {
        showHomeAddSetoran();
        getAllBank();
    })

    function getAllBank() {
        $.ajax({
            url: "{{ url('setoran/bank/show') }}" + '/' + "2",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                for (var i = 0; i < obj.listBank.length; i++) {
                    
                }
            },
            error: function(req, err) {
                console.log(err);
            }
        })
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

    function showSetoranAddId() {
        backIndex = 2;
        document.getElementById("homeAddSetoran").style.display = "none";
        document.getElementById("searchPenerima").style.display = "none";
        document.getElementById("addSetoranId").style.display = "block";
    }

    function goToKirim() {
        window.location.href = "{{ url('user/setoran/eWallet/kirim/tambah') }}";
    }

    function tambahEWalletBaru() {
        // $.ajax({
        //     url: "{{ url('') }}",
        //     type: 'get',
        //     data: {
        //         idBrand: "{{ session('idBrand') }}",
        //     },
        //     success: function(response) {
        //         // console.log(response);
        //         var obj = JSON.parse(JSON.stringify(response));
        //         console.log(obj);
        //         objItemBrand.length = 0;
        //         var dataDropdown = '';
        //         for (var i = 0; i < obj?.dataItem.length; i++) {
        //             dataDropdown += '<div class="itemSelect" onclick="setDropDown(';
        //             dataDropdown += i;
        //             dataDropdown += ')">';
        //             dataDropdown += obj.dataItem[i].Item;
        //             dataDropdown += '</div>';
        //             objItemBrand.push(obj.dataItem[i]);
        //         }
        //         document.getElementById('itemAll').innerHTML = dataDropdown;
        //     },
        //     error: function(req, err) {
        //         console.log(err);
        //     }
        // })
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
