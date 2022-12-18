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
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

        .headerMenuTop {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            color: #FFFFFF;
        }

        .headerMenuTop img {
            height: 13px;
        }

        .tittle {
            margin-top: 30px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            /* or 22px */
            text-align: center;
            color: #FFFFFF;
        }

        .priceTittle {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            line-height: 120%;
            align-items: center;
            text-align: center;
            color: #FFFFFF;
        }

        .detailTittle {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            color: #585858;
            margin-top: 10px;
        }

        .detailPrice {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
        }

        .wrapSortDate {
            margin-top: 50px;
            display: flex;
            width: 95vw;
            max-width: 400px;
            overflow: auto;
        }

        .wrapSortDate div {
            /* overflow: hidden; */
            width: 100px;
            height: 31px;
            white-space: nowrap;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            text-align: center;
            padding-top: 6px;
            color: #B20731;
            background: #FFEAEF;
            border-radius: 100px;
            margin-right: 10px;
        }

        .wrapSortDate .active {
            background: #B20731;
            font-weight: 600;
            color: #FFFFFF;
        }

        .historyTransaksiLabel {
            margin-top: 40px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }

        .dateTransaksi {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #6B7280;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .wrapPembelianImg {
            width: 48px;
            height: 48px;
            background: #F9FAFB;
            border-radius: 12px;
        }

        .labelItemTransaksi {
            margin-top: 8px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
        }

        .labelQtyTransaksi {
            margin-top: 1px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            color: #BEBEBE;
        }

        .labelValuePembelian {
            margin-top: 9px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #B20731;
        }

        .labelValuePattyCash {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            color: #585858;
            text-align: right;
        }

        .wrapPattyCash{
            margin-top: 15px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #F3F4F6;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center">
        <div style="max-width: 400px;">
            <img src="{{ url('img/reimburse/reimburseHistory.png') }}" alt="" style="width: 100%;">
            <div class="d-flex justify-content-start headerMenuTop" style="margin-top: -180px; margin-left: 30px;">
                <img src="{{ url('img/icon/backLeft.png') }}" alt="">
                <div style="margin-left: 10px;">Kembali</div>
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <div class="tittle">Saldo Patty Cash</div>
                    <div class="priceTittle">Rp 472.000</div>
                    {{-- <div style="height: 70px;"></div> --}}
                    <div style="margin-top: 30px;">
                        <img src="{{ url('img/reimburse/reimburseStat.png') }}" alt="" style="width: 320px;">
                        <div class="d-flex justify-content-start" style="margin-top: -70px;">
                            <div style="margin-left: 47px;">
                                <div class="detailTittle">Reimburse</div>
                                <div class="detailPrice">+ Rp 15.200.000</div>
                            </div>
                            <div style="margin-left: 33px;">
                                <div class="detailTittle">Pembelian</div>
                                <div class="detailPrice">- Rp 15.200.000</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    <div class="wrapSortDate">
                        <div style="flex: 0 0 67px;" class="active">Hari ini</div>
                        <div style="flex: 0 0 129px;">1 Minggu Terakhir</div>
                        <div style="flex: 0 0 117px;">30 Hari Terakhir</div>
                        <div style="flex: 0 0 67px;">Semua</div>
                    </div>
                    {{-- <div style="margin-top: 20px;"></div> --}}
                    <div class="historyTransaksiLabel">History Transaksi</div>
                    <div class="dateTransaksi">1 November</div>
                    <div class="d-flex justify-content-between wrapPattyCash">
                        <div class="d-flex justify-content-start">
                            <div class="wrapPembelianImg d-flex justify-content-center align-items-center">
                                <img src="{{ url('img/dashboard/laporanPembelian.png') }}" alt=""
                                    style="height: 22px;">
                            </div>
                            <div style="margin-left: 15px;">
                                <div class="d-flex justify-content-start">
                                    <div class="labelItemTransaksi">Beras</div>
                                </div>
                                <div class="labelQtyTransaksi">5000 gr</div>
                            </div>
                        </div>
                        <div style="margin-right: 10px;">
                            <div class="labelValuePembelian">- Rp 59.000</div>
                            <div class="labelValuePattyCash">Rp 472.000</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between wrapPattyCash">
                        <div class="d-flex justify-content-start">
                            <div class="wrapPembelianImg d-flex justify-content-center align-items-center">
                                <img src="{{ url('img/dashboard/laporanPembelian.png') }}" alt=""
                                    style="height: 22px;">
                            </div>
                            <div style="margin-left: 15px;">
                                <div class="d-flex justify-content-start">
                                    <div class="labelItemTransaksi">Minyak Goreng</div>
                                </div>
                                <div class="labelQtyTransaksi">5000 ml</div>
                            </div>
                        </div>
                        <div style="margin-right: 10px;">
                            <div class="labelValuePembelian">- Rp 59.000</div>
                            <div class="labelValuePattyCash">Rp 531.000</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between wrapPattyCash">
                        <div class="d-flex justify-content-start">
                            <div class="wrapPembelianImg d-flex justify-content-center align-items-center">
                                <img src="{{ url('img/dashboard/laporanPembelian.png') }}" alt=""
                                    style="height: 22px;">
                            </div>
                            <div style="margin-left: 15px;">
                                <div class="d-flex justify-content-start">
                                    <div class="labelItemTransaksi">Beras</div>
                                </div>
                                <div class="labelQtyTransaksi">5000 gr</div>
                            </div>
                        </div>
                        <div style="margin-right: 10px;">
                            <div class="labelValuePembelian">- Rp 59.000</div>
                            <div class="labelValuePattyCash">Rp 472.000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 1000px;"></div>
</body>

</html>
