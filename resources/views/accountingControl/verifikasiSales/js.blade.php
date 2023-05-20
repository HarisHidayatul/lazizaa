@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        var valueTotalAll = [];
        var idSalesFill = [];
        var selIndexSalesFill = 0;

        var arrayCSV = [];

        var idMutasiArray = [];

        var objAll = '';

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

            document.getElementById('startDate2').value = formattedDate;
            document.getElementById('stopDate2').value = formattedDate;

            document.getElementById('verifikasiSalesTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Verifikasi Sales";
            document.getElementById('linkContent').innerHTML = "Verifikasi Sales";
            getAllOutlet();
            getListSales();

            getPenerima();
        })

        function setGenerateTransaksi() {
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: "{{ url('mutasi/generate/pelunasan') }}",
                type: 'POST',
                data: {
                    startDate: startDate,
                    stopDate: stopDate
                }, // kirim data sebagai JSON string
                success: function(data) {
                    getListAllFilter();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function getPenerima() {
            $.ajax({
                url: "{{ url('setoran/penerima/show') }}",
                type: 'GET',
                data: {
                    // data: JSON.stringify(data)
                }, // kirim data sebagai JSON string
                success: function(data) {
                    var obj = JSON.parse(JSON.stringify(data));
                    console.log(data);
                    var dataHtml = '';
                    for (var i = 0; i < obj.penerimaListArray.length; i++) {
                        // <option value=""></option>
                        dataHtml += '<option value="';
                        dataHtml += obj.penerimaListArray[i].id;
                        dataHtml += '">';
                        dataHtml += obj.penerimaListArray[i].namaRekening + ' ' + obj.penerimaListArray[i]
                            .nomorRekening;
                        dataHtml += '</option>';
                    }
                    $('#selPenerima').empty().append(dataHtml);
                    // alert('Data berhasil diposting!');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function getListAllFilter() {
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            // var accessHistory = document.getElementById('selDate').value;
            var accessOutlet = document.getElementById('selOutlet').value;
            var urlAll = "{{ url('salesHarian/show/verifikasi') }}" + '/' + accessOutlet + '/' + startDate + '/' + stopDate;
            $.ajax({
                url: urlAll,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    console.log(obj);
                    objAll = obj;
                    valueTotalAll.length = 0;
                    idSalesFill.length = 0;
                    var loopCount = 0;
                    var idListSales = document.getElementById('selFilterSales').value;
                    for (var i = 0; i < obj.itemSales.length; i++) {
                        for (var j = 0; j < obj.itemSales[i].data.length; j++) {
                            for (var k = 0; k < obj.itemSales[i].data[j].data.length; k++) {
                                if ((idListSales == 0) || (idListSales == obj.itemSales[i].data[j].data[k]
                                        .idListSales)) {
                                    historyAll += '<tr>';
                                    historyAll += '<td>';
                                    // Example date in yyyy-mm-dd format
                                    const dateStr = obj.itemSales[i].Tanggal;

                                    // Split the string into year, month, and day components
                                    const [year, month, day] = dateStr.split('-');

                                    historyAll += `${day}/${month}/${year}`;
                                    historyAll += '</td>';
                                    historyAll += '<td>';
                                    historyAll += obj.itemSales[i].data[j].outlet;
                                    historyAll += '</td>';
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
                                    historyAll +=
                                        '<a href="#" data-toggle="modal" data-target="#mutasiModalCenter" onclick="getMutasiFromSales(';
                                    historyAll += loopCount;
                                    historyAll += ');">';
                                    historyAll += obj.itemSales[i].data[j].data[k].diterima.toLocaleString();
                                    historyAll += '</a>';
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
                                    historyAll += '</tr>';

                                    idSalesFill.push(obj.itemSales[i].data[j].data[k].idSalesFill);
                                    loopCount++;

                                    arrayCSV.push([
                                        `${day}/${month}/${year}`,
                                        obj.itemSales[i].data[j].outlet,
                                        obj.itemSales[i].data[j].data[k].listSales,
                                        obj.itemSales[i].data[j].data[k].total.toLocaleString(),
                                        obj.itemSales[i].data[j].data[k].diterima.toLocaleString(),
                                        obj.itemSales[i].data[j].data[k].selisih.toLocaleString(),
                                        Math.round(((obj.itemSales[i].data[j].data[k].selisih) *
                                            100) / (
                                            obj.itemSales[i].data[j].data[k].total))
                                    ]);
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

        function setMutasiFromSales() {
            var mutasiCheck = document.getElementsByName('mutasiCheck');
            var idSendMutasi = [];
            for (var i = 0; i < mutasiCheck.length; i++) {
                if (!mutasiCheck[i].disabled) {
                    if (mutasiCheck[i].checked) {
                        idSendMutasi.push(idMutasiArray[i]);
                    }
                }
            }
            var arraySend = {
                idSendMutasi: idSendMutasi,
                idSalesFill: idSalesFill[selIndexSalesFill]
            }

            console.log(arraySend);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: "{{ url('mutasi/create/pelunasan/sales') }}",
                type: 'POST',
                data: {
                    data: JSON.stringify(arraySend)
                }, // kirim data sebagai JSON string
                success: function(data) {
                    var obj = JSON.parse(JSON.stringify(data));
                    var dataHTML = '';
                    console.log(obj);
                    getListAllFilter();
                    printMutasiFromSales();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function delMutasiFromSales(idPelunasanMutasiSales) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: "{{ url('mutasi/delete/pelunasan/sales') }}",
                type: 'DELETE',
                data: {
                    idPelunasanMutasiSales: idPelunasanMutasiSales
                }, // kirim data sebagai JSON string
                success: function(data) {
                    var obj = JSON.parse(JSON.stringify(data));
                    var dataHTML = '';
                    console.log(obj);
                    getListAllFilter();
                    printMutasiFromSales();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function getMutasiFromSales(index) {
            selIndexSalesFill = index;
            printMutasiFromSales();
        }

        function printMutasiFromSales() {
            $.ajax({
                url: "{{ url('mutasi/show/pelunasan/sales') }}",
                type: 'GET',
                data: {
                    idSalesFill: JSON.stringify(idSalesFill[selIndexSalesFill])
                }, // kirim data sebagai JSON string
                success: function(data) {
                    var obj = JSON.parse(JSON.stringify(data));
                    var dataHTML = '';
                    console.log(data);
                    for (var i = 0; i < obj.dataMutasi.length; i++) {
                        dataHTML += '<tr>';
                        dataHTML += '<td>';
                        dataHTML += obj.dataMutasi[i].tanggalBaru;
                        dataHTML += '</td>';
                        dataHTML += '<td>';
                        dataHTML += obj.dataMutasi[i].trxNotes;
                        dataHTML += '</td>';
                        dataHTML += '<td>';
                        dataHTML += obj.dataMutasi[i].total.toLocaleString();
                        dataHTML += '</td>';
                        dataHTML += '<td>';
                        // <button type="button" class="btn btn-secondary" onclick="getListAllFilter()">Filter Date</button>
                        dataHTML +=
                            '<button type="button" class="btn btn-secondary" onclick="delMutasiFromSales(';
                        dataHTML += obj.dataMutasi[i].idPelunasanMutasiSales;
                        dataHTML += ')">Delete</button>';
                        dataHTML += '</td>';
                        dataHTML += '</tr>';
                    }
                    $('#tabelMutasiDipilih>tbody').empty().append(dataHTML);

                    for (var i = 0; i < idMutasiArray.length; i++) {
                        var mutasiFound = false;
                        for (var j = 0; j < obj.dataMutasi.length; j++) {
                            if (idMutasiArray[i] == obj.dataMutasi[j].id) {
                                mutasiFound = true;
                                break;
                            }
                        }
                        if (mutasiFound) {
                            document.getElementsByName('mutasiCheck')[i].disabled = true;
                            document.getElementsByName('mutasiCheck')[i].checked = true;
                        } else {
                            document.getElementsByName('mutasiCheck')[i].disabled = false;
                            document.getElementsByName('mutasiCheck')[i].checked = false;
                        }
                    }

                    var dataSalesFill = '';
                    for (var i = 0; i < obj.dataSales.length; i++) {
                        dataSalesFill += '<tr>';

                        dataSalesFill += '<td>';
                        dataSalesFill += obj.dataSales[i].TanggalBaru;
                        dataSalesFill += '<td>';

                        dataSalesFill += '<td>';
                        dataSalesFill += obj.dataSales[i].outlet;
                        dataSalesFill += '<td>';

                        dataSalesFill += '<td>';
                        dataSalesFill += obj.dataSales[i].sesi;
                        dataSalesFill += '<td>';

                        dataSalesFill += '<td>';
                        dataSalesFill += obj.dataSales[i].itemSales;
                        dataSalesFill += '<td>';

                        dataSalesFill += '<td ';
                        if (obj.dataSales[i].idRevisiTotal == '2') {
                            dataSalesFill += 'style="color:tomato;" ';
                        } else if (obj.dataSales[i].idRevisiTotal == '3') {
                            dataSalesFill += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataSalesFill += '>';
                        dataSalesFill += obj.dataSales[i].total.toLocaleString();
                        dataSalesFill += '<td>';

                        dataSalesFill += '</tr>';
                    }
                    $('#tabelSalesDipilih>tbody').empty().append(dataSalesFill);

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function getTableMutasi() {
            // var accessHistory = document.getElementById('selDate').value;
            var startDate = document.getElementById('startDate2').value;
            var stopDate = document.getElementById('stopDate2').value;
            var idPenerimaList = document.getElementById('selPenerima').value;
            var urlAll = "{{ url('mutasi/show/all') }}";
            $.ajax({
                url: urlAll,
                type: 'get',
                data: {
                    idPenerimaList: idPenerimaList,
                    startDate: startDate,
                    stopDate: stopDate
                },
                success: function(response) {
                    var objAllData = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    idMutasiArray.length = 0;
                    console.log(objAllData);
                    for (var i = 0; i < objAllData.dataMutasi.length; i++) {
                        historyAll += '<tr onclick="clickMutasi(';
                        historyAll += i;
                        historyAll += ');">';
                        historyAll += '<td>';
                        historyAll += '<input type="checkbox" name="mutasiCheck">';
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += objAllData.dataMutasi[i].tanggalBaru;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += objAllData.dataMutasi[i].trxNotes;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += objAllData.dataMutasi[i].total.toLocaleString();
                        historyAll += '</td>';

                        historyAll += '</tr>';

                        idMutasiArray.push(objAllData.dataMutasi[i].id);
                    }
                    $('#tabelMutasi>tbody').empty().append(historyAll);
                    printMutasiFromSales();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function clickMutasi(index) {
            var checkedMutasi = document.getElementsByName('mutasiCheck')[index].checked;
            var disableMutasi = document.getElementsByName('mutasiCheck')[index].disabled;
            if (!disableMutasi) {
                if (checkedMutasi) {
                    document.getElementsByName('mutasiCheck')[index].checked = false;
                } else {
                    document.getElementsByName('mutasiCheck')[index].checked = true;
                }
            }
        }

        function downloadCSV() {
            var obj = objAll;
            var arrayAllData = [];
            var namaFile = 'Data Sales Outlet ';
            const selectElement = document.getElementById('selOutlet');
            const selectedOptionText = selectElement.options[selectElement.selectedIndex].text;

            namaFile += selectedOptionText;
            namaFile += ' ';
            namaFile += document.getElementById('startDate').value;
            namaFile += ' Sampai ';
            namaFile += document.getElementById('stopDate').value;
            arrayAllData.push([
                'Tanggal',
                'Outlet',
                'Item Sales',
                'Jumlah (+/-)',
                'Jumlah Diterima',
                'Fee',
                '%'
            ]);
            for (var i = 0; i < arrayCSV.length; i++) {
                arrayAllData.push(arrayCSV[i]);
            }
            // arrayAllData.push(arrayCSV);
            exportToCsv(namaFile, arrayAllData);
        }

        function exportToCsv(filename, rows) {
            var processRow = function(row) {
                var finalVal = '';
                for (var j = 0; j < row.length; j++) {
                    var innerValue = row[j] === null ? '' : row[j].toString();
                    if (row[j] instanceof Date) {
                        innerValue = row[j].toLocaleString();
                    };
                    var result = innerValue.replace(/"/g, '""');
                    if (result.search(/("|,|\n)/g) >= 0)
                        result = '"' + result + '"';
                    if (j > 0)
                        finalVal += ',';
                    finalVal += result;
                }
                return finalVal + '\n';
            };

            var csvFile = '';
            for (var i = 0; i < rows.length; i++) {
                csvFile += processRow(rows[i]);
            }

            var blob = new Blob([csvFile], {
                type: 'text/csv;charset=utf-8;'
            });
            if (navigator.msSaveBlob) { // IE 10+
                navigator.msSaveBlob(blob, filename);
            } else {
                var link = document.createElement("a");
                if (link.download !== undefined) { // feature detection
                    // Browsers that support HTML5 download attribute
                    var url = URL.createObjectURL(blob);
                    link.setAttribute("href", url);
                    link.setAttribute("download", filename);
                    link.style.visibility = 'hidden';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }
            }
        }

        function getAllOutlet() {
            $.ajax({
                url: "{{ url('pattyCash/outlet/show') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var listAllOutlet = "";
                    var imgLaporanPembelian = "{{ url('img/dashboard/laporanPembelian.png') }}";
                    var imgPending = "{{ url('img/icon/pending.png') }}";
                    console.log(obj);
                    listAllOutlet += '<option value=0>Semua</option>'
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

        function getListSales() {
            $.ajax({
                url: "{{ url('salesHarian/show/list/all') }}" + '/0',
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var listSales = "";
                    listSales += '<option value=0>Semua Sales</option>';
                    for (var i = 0; i < obj.listSales.length; i++) {
                        for (var j = 0; j < obj.listSales[i].sales.length; j++) {
                            listSales += '<option value=';
                            listSales += obj.listSales[i].sales[j].id;
                            listSales += '>';
                            listSales += obj.listSales[i].sales[j].sales;
                            listSales += '</option>';
                        }
                    }
                    $('#selFilterSales').empty().append(listSales);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
