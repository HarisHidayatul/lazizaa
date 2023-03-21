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
            height: 13px;
        }

        .menuAll {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 10px;
        }

        .kembali {
            margin-top: 7px;
            margin-left: -14px;
        }

        .container1 {
            width: 80vw;
            max-width: 400px;
            min-width: 250px;
        }

        .dateTop {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            margin-top: 20px;
            /* margin-left: -12px; */
            margin-bottom: 10px;
        }

        .revHeader {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 24px;
            line-height: 120%;
            margin-top: 80px;
        }

        h4 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;

            /* Greyscale/50 */

            color: #7A7A7A;
        }

        h2 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            /* or 22px */


            /* Main color/Red/50 */

            color: #B20731;
        }

        .typeSales {
            /* Semibold/Large */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            margin-top: 20px;
        }

        .itemSales {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            line-height: 140%;
            margin-bottom: 5px;
        }

        .detailSales {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            display: flex;
            align-items: center;
            color: #9C9C9C;
        }

        .detailSales span {
            color: #FFA500;
            margin-left: 5px;
            margin-right: 5px;
        }

        .wrapSales {
            border: 1px solid #9C9C9C;
            border-radius: 8px;
            padding: 10px 10px;
            margin-top: 20px;
        }

        .boxDetailSesi {
            background: #FCFBFB;
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.1), 0px 2.22016px 11.1008px -1.11008px rgba(50, 50, 71, 0.08);
            padding: 15px 5px;
            border-radius: 8px;
        }

        .detailSesi {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 250%;
        }

        .detailSesi span {
            font-weight: 400;
        }

        .totalPerSesi {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 400;
            font-size: 12px;
            line-height: 15px;
            color: #B20731;
            margin-top: 7.5px;
        }

        .totalAll {
            margin-top: 8px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            /* identical to box height, or 28px */


            /* Main color/Red/50 */

            color: #B20731;
        }

        .wrapEdit {
            position: fixed;
            right: 30px;
            bottom: 100px;
        }

        .wrapEdit div {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            width: 106px;
            height: 44px;
            background: #B20731;
            border: 1px solid white;
            color: #FFFFFF;
            border-radius: 6px;
            text-align: center;
            align-content: center;
            align-items: center;
            padding-top: 10px;
            cursor: pointer;
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
            <div class="row" onclick="goToDashboard();" style="cursor: pointer;">
                <div class="col-2" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{ url('img/back2.png') }}" alt="back icon" class="imageBack">
                </div>
                <div class="col">
                    <h4 class="kembali">Kembali</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <div class="container1">
            <div class="d-flex justify-content-center revHeader">Laporan Sales</div>
            <div class="d-flex justify-content-center" style="margin-top: 5px;">
                <img src="{{ url('img/pointMap.png') }}" alt="map" style="height: 18px; margin-top: 1px;">
                <h2 style="margin-left: 5px;">{{ session('Outlet') }}</h2>
            </div>
            <div class="dateTop" id="dateTop">XXXXX XX XXXXXXX</div>
            <div id="allDataHTML"></div>
            <div class="d-flex justify-content-between align-items-center wrapSales" onclick="clickOnSesi(0);">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="{{ url('img/dashboard/laporanSales.png') }}" alt="" style="height: 35px;">
                    <div style="margin-left: 10px;">
                        <div class="itemSales">Sesi 1</div>
                        <div class="detailSales">Total Cash <span>Rp 20.222</span></div>
                    </div>
                </div>
                <img src="{{ url('img/icon/arrowDown.png') }}" alt="" style="height: 8px;">
            </div>
            <div class="boxDetailSesi" name="detailSesi">
                <div style="margin-top: 15px;">
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div class="d-flex justify-content-start">
                            <div>Sales (Sesi 1)</div>
                        </div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div class="d-flex justify-content-start">
                            <div>Sales Non Tunai (Sesi 1)</div>
                        </div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div class="d-flex justify-content-start" style="margin-left: 15px">
                            <div>Go Food</div>
                            <img src="{{ url('img/icon/tertunda.png') }}" alt=""
                                style="height: 15px; ">
                        </div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div class="d-flex justify-content-start" style="margin-left: 15px">
                            <div>Grab Food</div>
                        </div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div class="d-flex justify-content-start" style="margin-left: 15px">
                            <div>Shopee Food</div>
                        </div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>
                    <div class="d-flex justify-content-between totalAll">
                        <div>Total Cash (Sesi 1)</div>
                        <div>Rp. 1,638,192</div>
                    </div>
                </div>
            </div>
            <div class="dateTop" style="margin-top: 35px;">Summary</div>
            <div style="margin-top: 15px;">
                <div class="d-flex justify-content-between totalPerSesi">
                    <div class="d-flex justify-content-start">
                        <div>Total Sales</div>
                    </div>
                    <div>Rp. 546.064</div>
                </div>
                <div class="d-flex justify-content-between totalPerSesi">
                    <div class="d-flex justify-content-start">
                        <div>Total Sales Non Tunai</div>
                    </div>
                    <div>Rp. 546.064</div>
                </div>
                <div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>
                <div class="d-flex justify-content-between totalPerSesi">
                    <div class="d-flex justify-content-start" style="margin-left: 15px">
                        <div>Go Food</div>
                    </div>
                    <div>Rp. 546.064</div>
                </div>
                <div class="d-flex justify-content-between totalPerSesi">
                    <div class="d-flex justify-content-start" style="margin-left: 15px">
                        <div>Grab Food</div>
                    </div>
                    <div>Rp. 546.064</div>
                </div>
                <div class="d-flex justify-content-between totalPerSesi">
                    <div class="d-flex justify-content-start" style="margin-left: 15px">
                        <div>Shopee Food</div>
                    </div>
                    <div>Rp. 546.064</div>
                </div>
                <div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>
                <div class="d-flex justify-content-between totalPerSesi">
                    <div class="d-flex justify-content-start" style="margin-left: 15px">
                        <div>Reimburse Sales</div>
                    </div>
                    <div>Rp. 546.064</div>
                </div>
                <div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>
                <div class="d-flex justify-content-between totalAll">
                    <div class="d-flex justify-content-start">
                        <div>Total Cash</div>
                        <img src="{{ url('img/icon/infoIcon.png') }}" alt=""
                            style="height: 15px; margin-top: 7px; margin-left: 5px;">
                    </div>
                    <div>Rp. 1,638,192</div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 100vw;"></div>
    <div class="wrapEdit">
        <div onclick="buttonEditClick();">Edit</div>
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
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

    $(document).ready(function() {
        // console.log("{{ $dateSelect }}");
        var day = new Date("{{ $dateSelect }}");
        var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day.getMonth()];
        document.getElementById('dateTop').innerHTML = stringDay;
        resetDetailSesi();
        getAllDataSesi();
    });

    function getAllDataSesi() {
        $.ajax({
            url: "{{ url('salesHarian/user/showAllSesi2') }}" + '/' + "{{ session('idOutlet') }}" + '/' +
                "{{ $dateSelect }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
            },
            error: function(req, err) {}
        });
    }

    function clickOnSesi(index) {
        var elementDetail = document.getElementsByName('detailSesi');
        if (elementDetail[index].style.display == 'none') {
            elementDetail[index].style.display = 'block';
        } else {
            elementDetail[index].style.display = 'none';
        }
    }

    function resetDetailSesi() {
        var elementDetail = document.getElementsByName('detailSesi');
        for (var i = 0; i < elementDetail.length; i++) {
            elementDetail[i].style.display = 'none';
        }
    }

    function goToDashboard() {
        window.location.href = "{{ url('user/dashboard') }}";
    }

    function buttonEditClick() {
        window.location.href = "{{ url('user/salesHarian') }}" + '/' + "{{ $dateSelect }}";
    }
</script>

</html>
