@extends('accountingControl.beeCloudRobot.index')

@section('robotjs')
    <script>
        var allDataSend = [];

        $(document).ready(function() {
            document.getElementById("eCommerceRobotSubMenu").classList.add("active");
        })
        $(document).ready(function() {
            // membuat objek Date untuk tanggal hari ini
            var today = new Date();

            // mendapatkan nilai tanggal, bulan, dan tahun dari objek Date
            var day = today.getDate();
            var month = today.getMonth() + 1; // bulan dimulai dari 0, jadi harus ditambah 1
            var year = today.getFullYear();

            // menambahkan nol pada bulan dan tanggal jika nilainya kurang dari 10
            if (month < 10) {
                month = '0' + month;
            }

            if (day < 10) {
                day = '0' + day;
            }

            // menggabungkan tanggal, bulan, dan tahun menjadi format yang diinginkan (yyyy-mm-dd)
            var formattedDate = year + '-' + month + '-' + day;

            document.getElementById('startDate').value = formattedDate;
            document.getElementById('stopDate').value = formattedDate;

            getAllOutlet();
        })

        function getAllOutlet() {
            $.ajax({
                url: "{{ url('pattyCash/outlet/show') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var listAllOutlet = "";
                    // var imgLaporanPembelian = "{{ url('img/dashboard/laporanPembelian.png') }}";
                    var imgPending = "{{ url('img/icon/pending.png') }}";
                    console.log(obj);
                    listAllOutlet += '<option value=0>Semua</option>';
                    for (var i = 0; i < obj.Outlet.length; i++) {
                        listAllOutlet += '<option value=';
                        listAllOutlet += obj.Outlet[i].id;
                        listAllOutlet += '>';
                        listAllOutlet += obj.Outlet[i].namaOutlet;
                        listAllOutlet += '</option>';
                    }
                    $('#selOutlet').empty().append(listAllOutlet);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getListAllFilter() {
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            // var accessHistory = document.getElementById('selDate').value;
            var accessOutlet = document.getElementById('selOutlet').value;
            var urlAll = "{{ url('robot/ecommerce/show/all') }}";
            $.ajax({
                url: urlAll,
                type: 'get',
                data: {
                    idOutlet: accessOutlet,
                    startDate: startDate,
                    stopDate: stopDate
                },
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    console.log(obj);
                    // objAll = obj;
                    // valueTotalAll.length = 0;
                    // idSalesFill.length = 0;
                    var loopCount = 0;
                    var firstLoop = false;
                    allDataSend.length = 0;
                    for (var i = 0; i < obj.itemSales.length; i++) {
                        for (var j = 0; j < obj.itemSales[i].data.length; j++) {
                            firstLoop = true;
                            var arrayTempSend = [];
                            for (var k = 0; k < obj.itemSales[i].data[j].data.length; k++) {
                                historyAll += '<tr>';
                                // Example date in yyyy-mm-dd format
                                const dateStr = obj.itemSales[i].Tanggal;

                                // Split the string into year, month, and day components
                                const [year, month, day] = dateStr.split('-');
                                if (firstLoop) {
                                    historyAll += '<td rowspan="';
                                    historyAll += obj.itemSales[i].data[j].data.length;
                                    historyAll += '" >';
                                    historyAll += `${day}/${month}/${year}`;
                                    historyAll += '</td>'
                                }

                                if (firstLoop) {
                                    historyAll += '<td rowspan="';
                                    historyAll += obj.itemSales[i].data[j].data.length;
                                    historyAll += '" >';
                                    historyAll += obj.itemSales[i].data[j].outlet;
                                    historyAll += '</td>';
                                }
                                historyAll += '<td>';
                                historyAll += obj.itemSales[i].data[j].data[k].listSales;
                                historyAll += '</td>';

                                historyAll += '<td ';
                                if (obj.itemSales[i].data[j].data[k].idTotalRevisi == '2') {
                                    historyAll += 'style="color:tomato;" ';
                                } else if (obj.itemSales[i].data[j].data[k].idTotalRevisi == '3') {
                                    historyAll += 'style="color:rgb(30, 206, 9);" ';
                                }
                                historyAll += '>';

                                historyAll += obj.itemSales[i].data[j].data[k].total.toLocaleString();
                                historyAll += '</td>';
                                historyAll += '<td>';
                                historyAll += obj.itemSales[i].data[j].data[k].diterima.toLocaleString();
                                historyAll += '</td>';
                                historyAll += '<td>';
                                historyAll += obj.itemSales[i].data[j].data[k].selisih.toLocaleString();
                                historyAll += '</td>';
                                historyAll += '<td>';
                                historyAll += Math.round(((obj.itemSales[i].data[j].data[k].selisih) *
                                    100) / (
                                    obj.itemSales[i].data[j].data[k].total));
                                historyAll += '%';
                                historyAll += '</td>';


                                historyAll += '<td>';
                                historyAll += obj.itemSales[i].data[j].data[k].robotQty.toLocaleString();
                                historyAll += '</td>';

                                if (firstLoop) {
                                    historyAll += '<td rowspan="';
                                    historyAll += obj.itemSales[i].data[j].data.length;
                                    historyAll += '" >';
                                    for (var l = 0; l < obj.itemSales[i].data[j].dataRobot.length; l++) {
                                        historyAll += '<div title="';
                                        historyAll += obj.itemSales[i].data[j].dataRobot[l].user;
                                        historyAll += '">';
                                        historyAll += obj.itemSales[i].data[j].dataRobot[l].status;
                                        historyAll += '</div>';
                                    }
                                    historyAll += '</td>';

                                    historyAll += '<td rowspan="';
                                    historyAll += obj.itemSales[i].data[j].data.length;
                                    historyAll += '" >';
                                    if (obj.itemSales[i].data[j].dataRobot.length > 0) {
                                        for (var l = 0; l < obj.itemSales[i].data[j].dataRobot.length; l++) {
                                            if (obj.itemSales[i].data[j].dataRobot[l].status == 'pending') {
                                                historyAll +=
                                                    '<button type="button" class="btn btn-secondary" onClick="deleteVerifikasi(';
                                                historyAll += obj.itemSales[i].data[j].dataRobot[l].id;
                                                historyAll += ')">';
                                                historyAll += 'Delete';
                                                historyAll += '</button>';
                                            }
                                        }
                                    } else {
                                        historyAll +=
                                            '<button type="button" class="btn btn-secondary" onClick="sendVerifikasi(';
                                        historyAll += loopCount;
                                        historyAll += ')">';
                                        historyAll += 'Verifikasi';
                                        historyAll += '</button>';
                                    }
                                    historyAll += '</td>';
                                }

                                arrayTempSend.push({
                                    "idListSales": obj.itemSales[i].data[j].data[k].idListSales,
                                    "beban": obj.itemSales[i].data[j].data[k].selisih
                                });


                                historyAll += '</tr>';

                                firstLoop = false;
                            }
                            allDataSend.push({
                                "idOutlet": obj.itemSales[i].data[j].idOutlet,
                                "idTanggal": obj.itemSales[i].idTanggal,
                                'data': arrayTempSend
                            });
                            loopCount++;
                        }
                    }
                    $('#statusInputTabel>tbody').empty().append(historyAll);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendVerifikasi(index) {
            console.log(allDataSend[index]);
            var data = {
                idPemverifikasi: {{ session('idPengisi') }},
                data: allDataSend[index]
            }
            $.ajax({
                url: "{{ url('robot/ecommerce/create') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    data: data,
                },
                success: function(response) {
                    getListAllFilter();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }


        function deleteVerifikasi(idRobotEcommerceStatus) {
            $.ajax({
                url: "{{ url('robot/ecommerce/delete') }}",
                type: 'delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                    idRobotEcommerceStatus: idRobotEcommerceStatus,
                },
                success: function(response) {
                    getListAllFilter();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
