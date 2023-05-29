@extends('accountingControl.beeCloudRobot.index')

@section('robotjs')
    <script>
        $(document).ready(function() {
            document.getElementById("pembayaranRobotSubMenu").classList.add("active");
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
            var idOutlet = document.getElementById('selOutlet').value;
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;

            $.ajax({
                url: "{{ url('robot/pembayaran/show/all') }}",
                type: 'get',
                data: {
                    idOutlet: idOutlet,
                    startDate: startDate,
                    stopDate: stopDate
                },
                success: function(response) {
                    var objAllData = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    // var imgLaporanPembelian = "{{ url('img/dashboard/laporanPembelian.png') }}";
                    var imgPending = "{{ url('img/icon/pending.png') }}";
                    var selectFilter = document.getElementById('selFilter').value;
                    console.log(objAllData);

                    for (var i = 0; i < objAllData.allData.length; i++) {
                        for (var j = 0; j < objAllData.allData[i].dataHistory.length; j++) {
                            for (var k = 0; k < objAllData.allData[i].dataHistory[j].pattyCash.length; k++) {
                                for (var l = 0; l < objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash
                                    .length; l++) {
                                    if (selectFilter == 1) {
                                        var foundPending = false;
                                        if (objAllData.allData[i].dataHistory[j].pattyCash[k]
                                            .dataRobot.length == 0) {
                                            continue;
                                        }
                                        for (var m = 0; m < objAllData.allData[i].dataHistory[j].pattyCash[
                                                k].dataRobot.length; m++) {
                                            if (objAllData.allData[i].dataHistory[j].pattyCash[k]
                                                .dataRobot[m].status == 'pending') {
                                                foundPending = true;
                                            }
                                        }
                                        if (!foundPending) {
                                            continue;
                                        }
                                    }
                                    if (selectFilter == 2) {
                                        var foundSukses = false;
                                        if (objAllData.allData[i].dataHistory[j].pattyCash[k]
                                            .dataRobot.length == 0) {
                                            continue;
                                        }
                                        for (var m = 0; m < objAllData.allData[i].dataHistory[j].pattyCash[
                                                k].dataRobot.length; m++) {
                                            if (objAllData.allData[i].dataHistory[j].pattyCash[k]
                                                .dataRobot[m].status == 'sukses') {
                                                foundSukses = true;
                                            }
                                        }
                                        if (!foundSukses) {
                                            continue;
                                        }
                                    }
                                    if(selectFilter == 3){
                                        if (objAllData.allData[i].dataHistory[j].pattyCash[k]
                                            .dataRobot.length != 0) {
                                            continue;
                                        }
                                    }

                                    var lengthPatty = objAllData.allData[i].dataHistory[j].pattyCash[k]
                                        .pattyCash.length;
                                    historyAll += '<tr>';
                                    var hargaSatuan = parseInt(objAllData.allData[i].dataHistory[j].pattyCash[k]
                                        .pattyCash[l].total);
                                    hargaSatuan /= parseInt(objAllData.allData[i].dataHistory[j].pattyCash[k]
                                        .pattyCash[l].qty);
                                    hargaSatuan = Math.round(hargaSatuan);
                                    if (l == 0) {
                                        historyAll += '<td rowspan="';
                                        historyAll += lengthPatty;
                                        historyAll += '">';
                                        historyAll += objAllData.allData[i].dataHistory[j].tanggal;
                                        historyAll += '</td>';

                                        historyAll += '<td rowspan="';
                                        historyAll += lengthPatty;
                                        historyAll += '">';
                                        historyAll += objAllData.allData[i].outlet;
                                        historyAll += '</td>';

                                        historyAll += '<td rowspan="';
                                        historyAll += lengthPatty;
                                        historyAll += '">';
                                        historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k].sesi;
                                        historyAll += '</td>';
                                    }
                                    historyAll += '<td>';
                                    historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .item;
                                    historyAll += '</td>';

                                    historyAll += '<td>';
                                    historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .jenisItem;
                                    historyAll += '</td>';

                                    historyAll += '<td ';
                                    if (objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .idRevQty == '2') {
                                        historyAll += 'style="color: red;"';
                                    }
                                    if (objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .idRevQty == '3') {
                                        historyAll += 'style="color: green;"';
                                    }
                                    historyAll += '>';
                                    historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .qty;
                                    historyAll += '</td>';

                                    
                                    historyAll += '<td>';
                                    historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .qtyRobot;
                                    historyAll += '</td>';

                                    historyAll += '<td>';
                                    historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .satuan;
                                    historyAll += '</td>';

                                    historyAll += '<td ';
                                    if (objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .idRevTotal == '2') {
                                        historyAll += 'style="color: red;"';
                                    }
                                    if (objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .idRevTotal == '3') {
                                        historyAll += 'style="color: green;"';
                                    }
                                    historyAll += '>';
                                    historyAll += hargaSatuan.toLocaleString();
                                    historyAll += '</td>';

                                    historyAll += '<td ';
                                    if (objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .idRevTotal == '2') {
                                        historyAll += 'style="color: red;"';
                                    }
                                    if (objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .idRevTotal == '3') {
                                        historyAll += 'style="color: green;"';
                                    }
                                    historyAll += '>';
                                    historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k]
                                        .pattyCash[l].total.toLocaleString();
                                    historyAll += '</td>';

                                    historyAll += '<td>';
                                    historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k].pattyCash[l]
                                        .totalRobot;
                                    historyAll += '</td>';

                                    if (l == 0) {
                                        historyAll += '<td rowspan="';
                                        historyAll += lengthPatty;
                                        historyAll += '" >';
                                        for (var m = 0; m < objAllData.allData[i].dataHistory[j].pattyCash[
                                                k].dataRobot.length; m++) {
                                            historyAll += '<div title="';
                                            historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k]
                                                .dataRobot[m].user;
                                            historyAll += '">';
                                            historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k]
                                                .dataRobot[m].status;
                                            historyAll += '</div>';

                                        }
                                        historyAll += '</td>';

                                        historyAll += '<td rowspan="';
                                        historyAll += lengthPatty;
                                        historyAll += '">';
                                        if (objAllData.allData[i].dataHistory[j].pattyCash[k].dataRobot.length >
                                            0) {
                                            for (var m = 0; m < objAllData.allData[i].dataHistory[j].pattyCash[
                                                    k].dataRobot.length; m++) {
                                                if (objAllData.allData[i].dataHistory[j].pattyCash[k]
                                                    .dataRobot[m].status == 'pending') {
                                                    historyAll +=
                                                        '<button type="button" class="btn btn-secondary" onClick="deleteVerifikasi(';
                                                    historyAll += objAllData.allData[i].dataHistory[j]
                                                        .pattyCash[k]
                                                        .dataRobot[m].idRobotList;
                                                    historyAll += ')">';
                                                    historyAll += 'Delete';
                                                    historyAll += '</button>';
                                                }
                                            }
                                        } else {
                                            historyAll +=
                                                '<button type="button" class="btn btn-secondary" onClick="sendVerifikasi(';
                                            historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k]
                                                .idPattyHarian;
                                            historyAll += ')">';
                                            historyAll += 'Verifikasi';
                                            historyAll += '</button>';

                                        }
                                        // historyAll += objAllData.allData[i].dataHistory[j].pattyCash[k].idPattyHarian;
                                        historyAll += '</td>';
                                    }
                                    historyAll += '</tr>';
                                }
                            }
                        }
                    }
                    $('#statusInputTabel>tbody').empty().append(historyAll);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function deleteVerifikasi(idRobotPembayaranStatus) {
            $.ajax({
                url: "{{ url('robot/pembayaran/delete') }}",
                type: 'delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                    idRobotPembayaranStatus: idRobotPembayaranStatus
                },
                success: function(response) {
                    getListAllFilter();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendVerifikasi(idPattyHarian) {
            $.ajax({
                url: "{{ url('robot/pembayaran/create') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    idPattyHarian: idPattyHarian,
                    idPemverifikasi: {{ session('idPengisi') }},
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
