@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        var valueTotalAll = [];
        var idSalesFill = [];

        var arrayCSV = [];

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

            document.getElementById('verifikasiSalesTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Verifikasi Sales";
            document.getElementById('linkContent').innerHTML = "Verifikasi Sales";
            getAllOutlet();
            getListSales();
        })

        function editItem(index) {
            $.ajax({
                url: "{{ url('salesHarian/update/verifikasi') }}",
                type: 'get',
                data: {
                    idSalesFill: idSalesFill[index],
                    totalDiterima: parseInt(valueTotalAll[index].rawValue)
                },
                success: function(response) {
                    getListAllFilter();
                },
                error: function(req, err) {
                    console.log(err);
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
                                    historyAll += '<input class="inputTotal" name="inputTotal" ';
                                    // historyAll += obj.itemSales[i].data[j].data[k].jumlahDiterima;
                                    historyAll += '>';
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
                                    historyAll +=
                                        '<button type="button" class="btn btn-secondary" onClick="editItem(' +
                                        loopCount +
                                        ');">Submit</button>';
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

                    var inputTotalElement = document.getElementsByName('inputTotal');
                    loopCount = 0;
                    for (var i = 0; i < inputTotalElement.length; i++) {
                        valueTotalAll.push(new AutoNumeric(inputTotalElement[i], {
                            decimalPlaces: '0'
                        }));
                    }
                    for (var i = 0; i < obj.itemSales.length; i++) {
                        for (var j = 0; j < obj.itemSales[i].data.length; j++) {
                            for (var k = 0; k < obj.itemSales[i].data[j].data.length; k++) {
                                if ((idListSales == 0) || (idListSales == obj.itemSales[i].data[j].data[k]
                                        .idListSales)) {
                                    valueTotalAll[loopCount].set(obj.itemSales[i].data[j].data[k]
                                        .diterima);
                                    loopCount++;
                                }
                            }
                        }
                    }
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
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
