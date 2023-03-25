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
            margin-bottom: 5px;
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
            {{-- <div class="typeSales">Organik</div>
            <div class="d-flex justify-content-between align-items-center wrapSales" onclick="clickOnSesi(0);">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="{{ url('img/dashboard/laporanSales.png') }}" alt="" style="height: 35px;">
                    <div style="margin-left: 10px;">
                        <div class="itemSales">Dine in</div>
                        <div class="detailSales">Siti &#10140; CU <span>10</span> Total <span>Rp 20.222</span></div>
                    </div>
                </div>
                <img src="{{ url('img/icon/arrowDown.png') }}" alt="" style="height: 8px;">
            </div>
            <div class="boxDetailSesi" name="detailSesi">
                <div class="detailSesi">
                    <div class="d-flex justify-content-start">
                        <div>Sesi 1</div>
                        <img src="{{ url('img/icon/tertunda.png') }}" alt=""
                            style="height: 15px; margin-top:10px;">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div><span>CU</span></div>
                        <div>46</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #E0E0E0;"></div>
                    <div class="d-flex justify-content-between">
                        <div>Total</div>
                        <div>Rp 546.064</div>
                    </div>
                </div>
                <div class="detailSesi">
                    <div class="d-flex justify-content-start">
                        <div>Sesi 2</div>
                        <img src="{{ url('img/icon/tertunda.png') }}" alt=""
                            style="height: 15px; margin-top:10px;">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div><span>CU</span></div>
                        <div>46</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #E0E0E0;"></div>
                    <div class="d-flex justify-content-between">
                        <div>Total</div>
                        <div>Rp 546.064</div>
                    </div>
                </div>
                <div style="margin-top: 15px;">
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div>Sesi 1</div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div>Sesi 2</div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div>Sesi 3</div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>
                    <div class="d-flex justify-content-between totalAll">
                        <div>Sub Total</div>
                        <div>Rp. 1,638,192</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center wrapSales" onclick="clickOnSesi(1);">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="{{ url('img/dashboard/laporanSales.png') }}" alt="" style="height: 35px;">
                    <div style="margin-left: 10px;">
                        <div class="itemSales">Cooking class</div>
                        <div class="detailSales">Siti &#10140; CU <span>10</span> Total <span>Rp 20.222</span></div>
                    </div>
                </div>
                <img src="{{ url('img/icon/arrowDown.png') }}" alt="" style="height: 8px;">
            </div>
            <div class="boxDetailSesi" name="detailSesi">
                <div class="detailSesi">
                    <div class="d-flex justify-content-start">
                        <div>Sesi 1</div>
                        <img src="{{ url('img/icon/tertunda.png') }}" alt=""
                            style="height: 15px; margin-top:10px;">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div><span>CU</span></div>
                        <div>46</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #E0E0E0;"></div>
                    <div class="d-flex justify-content-between">
                        <div>Total</div>
                        <div>Rp 546.064</div>
                    </div>
                </div>
                <div class="detailSesi">
                    <div>Sesi 2</div>
                    <div class="d-flex justify-content-between">
                        <div><span>CU</span></div>
                        <div>46</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #E0E0E0;"></div>
                    <div class="d-flex justify-content-between">
                        <div>Total</div>
                        <div>Rp 546.064</div>
                    </div>
                </div>
                <div style="margin-top: 15px;">
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div>Sesi 1</div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div>Sesi 2</div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div>Sesi 3</div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>
                    <div class="d-flex justify-content-between totalAll">
                        <div>Sub Total</div>
                        <div>Rp. 1,638,192</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center wrapSales" onclick="clickOnSesi(2);">
                <div class="d-flex justify-content-start align-items-center">
                    <img src="{{ url('img/dashboard/laporanSales.png') }}" alt="" style="height: 35px;">
                    <div style="margin-left: 10px;">
                        <div class="itemSales">Grabfood</div>
                        <div class="detailSales">Siti &#10140; CU <span>10</span> Total <span>Rp 20.222</span></div>
                    </div>
                </div>
                <img src="{{ url('img/icon/arrowDown.png') }}" alt="" style="height: 8px;">
            </div>
            <div class="boxDetailSesi" name="detailSesi">
                <div class="detailSesi">
                    <div class="d-flex justify-content-start">
                        <div>Sesi 1</div>
                        <img src="{{ url('img/icon/tertunda.png') }}" alt=""
                            style="height: 15px; margin-top:10px;">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div><span>CU</span></div>
                        <div>46</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #E0E0E0;"></div>
                    <div class="d-flex justify-content-between">
                        <div>Total</div>
                        <div>Rp 546.064</div>
                    </div>
                </div>
                <div class="detailSesi">
                    <div class="d-flex justify-content-start">
                        <div>Sesi 2</div>
                        <img src="{{ url('img/icon/tertunda.png') }}" alt=""
                            style="height: 15px; margin-top:10px;">
                    </div>
                    <div class="d-flex justify-content-between">
                        <div><span>CU</span></div>
                        <div>46</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #E0E0E0;"></div>
                    <div class="d-flex justify-content-between">
                        <div>Total</div>
                        <div>Rp 546.064</div>
                    </div>
                </div>
                <div style="margin-top: 15px;">
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div>Sesi 1</div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div>Sesi 2</div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div class="d-flex justify-content-between totalPerSesi">
                        <div>Sesi 3</div>
                        <div>Rp. 546.064</div>
                    </div>
                    <div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>
                    <div class="d-flex justify-content-between totalAll">
                        <div>Sub Total</div>
                        <div>Rp. 1,638,192</div>
                    </div>
                </div>
            </div>
            <div style="margin-top: 15px;">
                <div class="d-flex justify-content-between totalPerSesi">
                    <div>Organik</div>
                    <div>Rp. 546.064</div>
                </div>
                <div class="d-flex justify-content-between totalPerSesi">
                    <div>E Commerce</div>
                    <div>Rp. 546.064</div>
                </div>
                <div class="d-flex justify-content-between totalPerSesi">
                    <div>Event</div>
                    <div>Rp. 546.064</div>
                </div>
                <div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>
                <div class="d-flex justify-content-between totalAll">
                    <div>Total Sales</div>
                    <div>Rp. 1,638,192</div>
                </div>
            </div> --}}
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
        var tempDate = "{{ $dateSelect }}";
        var dateParts = tempDate.split('-');
        var formattedDate = dateParts[1] + '/' + dateParts[2] + '/' + dateParts[0];

        var day = new Date(formattedDate);

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
                var obj1 = JSON.parse(JSON.stringify(response));
                console.log(obj1);
                var obj = obj1.dataSales;
                var objReimburseSales = obj1.dataReimburseSales;
                var allDataHTML = '';
                var totalHTML = '';
                var indexButton = 0;
                var totalAll = 0;
                var totalReimburseSales = 0;
                var totalReadingCasheer = 0;

                totalHTML += '<div style="margin-top: 25px;">';

                for (var i = 0; i < obj1.dataTotal.length; i++) {
                    totalHTML += '<div class="d-flex justify-content-between totalPerSesi">';
                    totalHTML += '<div>' + 'Total Sales Sesi ' + obj1.dataTotal[i].sesi + '</div>';
                    totalHTML += '<div>Rp. ' + obj1.dataTotal[i].total.toLocaleString() + '</div></div>';
                    totalReadingCasheer += parseInt(obj1.dataTotal[i].total);
                }
                for (var i = 0; i < obj.length; i++) {
                    allDataHTML += '<div class="typeSales">';
                    allDataHTML += obj[i].type;
                    allDataHTML += '</div>';

                    for (var j = 0; j < obj[i].sales.length; j++) {
                        var detailSesi = '';
                        var totalPerSesi = '';
                        var totalValPerSesi = 0;
                        detailSesi += '<div class="boxDetailSesi" name="detailSesi">';
                        totalPerSesi += '<div style="margin-top: 15px;">';
                        for (var k = 0; k < obj[i].sales[j][2].length; k++) {
                            detailSesi += '<div class="detailSesi">';
                            detailSesi += '<div class="d-flex justify-content-start">';
                            detailSesi += '<div>Sesi ' + obj[i].sales[j][2][k].sesi + '</div>';
                            if ((obj[i].sales[j][2][k].idCuRev == '2') || (obj[i].sales[j][2][k]
                                    .idTotalRev == '2')) {
                                var urlRev = "{{ url('img/icon/tertunda.png') }}";
                                detailSesi += '<img src="' + urlRev +
                                    '" alt="" style="height: 15px; margin-top:10px;">';
                            } else if ((obj[i].sales[j][2][k].idCuRev == '3') || (obj[i].sales[j][2][k]
                                    .idTotalRev == '3')) {
                                var urlRev = "{{ url('img/icon/sukses.png') }}";
                                detailSesi += '<img src="' + urlRev +
                                    '" alt="" style="height: 15px; margin-top:10px;">';
                            }
                            detailSesi += '</div><div class="d-flex justify-content-between">';
                            detailSesi += '<div><span></span></div>';
                            detailSesi += '<div>' + '' + '</div>';
                            detailSesi +=
                                '</div><div style="width: 100%; border: 1px solid #E0E0E0;"></div>';
                            detailSesi += '<div class="d-flex justify-content-between"><div>Total</div>';
                            detailSesi += '<div>Rp ' + parseInt(obj[i].sales[j][2][k].totalQty)
                                .toLocaleString() +
                                '</div></div></div>';

                            totalPerSesi += '<div class="d-flex justify-content-between totalPerSesi">';
                            totalPerSesi += '<div>Sesi ' + obj[i].sales[j][2][k].sesi + '</div>';
                            totalPerSesi += '<div>Rp. ' + parseInt(obj[i].sales[j][2][k].totalQty)
                                .toLocaleString() +
                                '</div></div>';
                            totalValPerSesi += parseInt(obj[i].sales[j][2][k].totalQty);

                            totalAll += parseInt(obj[i].sales[j][2][k].totalQty);
                        }

                        totalPerSesi +=
                            '<div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>';
                        totalPerSesi +=
                            '<div class="d-flex justify-content-between totalAll"><div>Sub Total</div>';
                        totalPerSesi += '<div>Rp. ' + totalValPerSesi.toLocaleString() +
                            '</div></div></div>';

                        detailSesi += totalPerSesi + '</div>';

                        allDataHTML +=
                            '<div class="d-flex justify-content-between align-items-center wrapSales" onclick="clickOnSesi(';
                        allDataHTML += indexButton;
                        allDataHTML += ');"><div class="d-flex justify-content-start align-items-center">';
                        allDataHTML += '<img src="' + "{{ url('img/dashboard/laporanSales.png') }}" +
                            '" alt="" style="height: 35px;">';
                        allDataHTML += '<div style="margin-left: 10px;">';
                        allDataHTML += '<div class="itemSales">' + obj[i].sales[j][1] + '</div>';
                        allDataHTML += '<div class="detailSales">';
                        allDataHTML += 'Total <span>Rp ';
                        allDataHTML += totalValPerSesi.toLocaleString();
                        allDataHTML += '</span></div></div></div>';
                        allDataHTML += '<img src="' + "{{ url('img/icon/arrowDown.png') }}" +
                            '" alt="" style="height: 8px;">'
                        allDataHTML += '</div>';
                        allDataHTML += detailSesi;

                        indexButton++;

                        totalHTML += '<div class="d-flex justify-content-between totalPerSesi">';
                        totalHTML += '<div>' + obj[i].sales[j][1] + '</div>';
                        totalHTML += '<div>- Rp. ' + totalValPerSesi.toLocaleString() + '</div></div>';
                    }
                }
                for (var i = 0; i < objReimburseSales.length; i++) {
                    totalHTML += '<div class="d-flex justify-content-between totalPerSesi">';
                    totalHTML += '<div>' + 'Reimburse Sales' + '</div>';
                    totalHTML += '<div>- Rp. ' + objReimburseSales[i].total.toLocaleString() +
                        '</div></div>';
                    totalReimburseSales -= objReimburseSales[i].total;
                }
                totalHTML +=
                    '<div style="width: 100%; border: 1px solid #B20731; margin-top: 10px;"></div>';
                totalHTML +=
                    '<div class="d-flex justify-content-between totalAll"><div>Total Disetorkan</div>';
                totalHTML += '<div>Rp. ' + (totalReadingCasheer - totalAll + totalReimburseSales)
                    .toLocaleString() +
                    '</div></div></div>';

                allDataHTML += totalHTML;

                document.getElementById('allDataHTML').innerHTML = allDataHTML;
                resetDetailSesi();
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
