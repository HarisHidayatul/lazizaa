@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        var dataExportToCSV = [];
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

            document.getElementById('laporanSalesTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Laporan Sales";
            document.getElementById('linkContent').innerHTML = "Laporan Sales";

            getAllOutlet();
        })

        function getListAllFilter() {
            // var accessHistory = document.getElementById('selDate').value;
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var accessOutlet = document.getElementById('selOutlet').value;
            var urlAll = "{{ url('salesHarian/show/laporanSales') }}" + '/' + accessOutlet + '/' + 'between' + '/' +
                startDate + '/' + stopDate;
            $.ajax({
                url: urlAll,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataTable = '';
                    dataExportToCSV.length = 0;
                    for (var i = 0; i < obj.dataSales.length; i++) {
                        const outlet = obj.dataSales[i].Outlet;
                        for (var j = 0; j < obj.dataSales[i].data.length; j++) {
                            var saldo = 0;
                            var saldoSetoran = 0;

                            var pendingStatus = false;

                            const dateStr = obj.dataSales[i].data[j].tanggal;

                            // Split the string into year, month, and day components
                            const [year, month, day] = dateStr.split('-');
                            const tanggalString = `${day}/${month}/${year}`;
                            const tanggalExcel = `${month}/${day}/${year}`;

                            for (var k = 0; k < obj.dataSales[i].data[j].dataSales.length; k++) {
                                saldo += parseInt(obj.dataSales[i].data[j].dataSales[k].totalManual);
                                var tempDataExport = [];
                                dataTable += '<tr>';
                                dataTable += '<td>';
                                dataTable += tanggalString;
                                tempDataExport.push(tanggalExcel);
                                dataTable += '</td>';
                                dataTable += '<td>';
                                dataTable += outlet;
                                tempDataExport.push(outlet);
                                dataTable += '</td>';
                                dataTable += '<td>';
                                dataTable += 'Sales Sesi ';
                                dataTable += obj.dataSales[i].data[j].dataSales[k].sesi;
                                tempDataExport.push('Sales Sesi ' + obj.dataSales[i].data[j].dataSales[k].sesi);
                                dataTable += '</td>';
                                dataTable += '<td>';
                                dataTable += obj.dataSales[i].data[j].dataSales[k].totalManual.toLocaleString();
                                tempDataExport.push(obj.dataSales[i].data[j].dataSales[k].totalManual
                                    .toLocaleString());
                                dataTable += '</td>';
                                dataTable += '<td>';
                                tempDataExport.push('');
                                dataTable += '</td>';
                                dataTable += '<td>';
                                dataTable += '</td>';
                                tempDataExport.push('');
                                dataTable += '<td>';
                                dataTable += '</td>';
                                tempDataExport.push('');
                                dataTable += '<td>';
                                dataTable += saldo.toLocaleString();
                                dataTable += '</td>';
                                tempDataExport.push(saldo.toLocaleString());
                                dataTable += '<td>';
                                dataTable += '</td>';
                                tempDataExport.push('');
                                dataTable += '</tr>';
                                dataExportToCSV.push(tempDataExport);

                                for (var l = 0; l < obj.dataSales[i].data[j].dataSales[k].data.length; l++) {
                                    tempDataExport = [];
                                    saldo -= parseInt(obj.dataSales[i].data[j].dataSales[k].data[l].total);
                                    var selisih = obj.dataSales[i].data[j].dataSales[k].data[l].total - obj
                                        .dataSales[i].data[j].dataSales[k].data[l].totalDiterima;
                                    dataTable += '<tr>';
                                    dataTable += '<td>';
                                    dataTable += tanggalString;
                                    dataTable += '</td>';
                                    tempDataExport.push(tanggalExcel);
                                    dataTable += '<td>';
                                    dataTable += outlet;
                                    dataTable += '</td>';
                                    tempDataExport.push(outlet);
                                    dataTable += '<td>';
                                    dataTable += obj.dataSales[i].data[j].dataSales[k].data[l].sales;
                                    dataTable += '</td>';
                                    tempDataExport.push(obj.dataSales[i].data[j].dataSales[k].data[l].sales);
                                    dataTable += '<td>';
                                    dataTable += '</td>';
                                    tempDataExport.push('');
                                    dataTable += '<td>';
                                    dataTable += obj.dataSales[i].data[j].dataSales[k].data[l].total
                                        .toLocaleString();
                                    dataTable += '</td>';
                                    tempDataExport.push(obj.dataSales[i].data[j].dataSales[k].data[l].total
                                        .toLocaleString());
                                    dataTable += '<td>';
                                    dataTable += obj.dataSales[i].data[j].dataSales[k].data[l].totalDiterima
                                        .toLocaleString();
                                    dataTable += '</td>';
                                    tempDataExport.push(obj.dataSales[i].data[j].dataSales[k].data[l]
                                        .totalDiterima
                                        .toLocaleString());
                                    dataTable += '<td>';
                                    dataTable += selisih.toLocaleString();
                                    dataTable += '</td>';
                                    tempDataExport.push(selisih.toLocaleString());
                                    dataTable += '<td>';
                                    dataTable += saldo.toLocaleString();
                                    dataTable += '</td>';
                                    tempDataExport.push(saldo.toLocaleString());
                                    dataTable += '<td>';
                                    if (obj.dataSales[i].data[j].dataSales[k].data[l].idRevisiTotal == '2') {
                                        dataTable += 'REVISI';
                                        tempDataExport.push('REVISI');
                                    } else {
                                        tempDataExport.push('');
                                    }
                                    dataTable += '</td>';
                                    dataTable += '</tr>';
                                    dataExportToCSV.push(tempDataExport);
                                }
                            }

                            for (var k = 0; k < obj.dataSales[i].data[j].dataReimburse.length; k++) {
                                var tempDataExport = [];
                                saldo -= parseInt(obj.dataSales[i].data[j].dataReimburse[k].total);
                                dataTable += '<tr>';
                                dataTable += '<td>';
                                dataTable += tanggalString;
                                tempDataExport.push(tanggalExcel);
                                dataTable += '</td>';
                                dataTable += '<td>';
                                dataTable += outlet;
                                dataTable += '</td>';
                                tempDataExport.push(outlet);
                                dataTable += '<td>';
                                dataTable += 'Reimburse Sales';
                                dataTable += '</td>';
                                tempDataExport.push('Reimburse Sales');
                                dataTable += '<td>';
                                dataTable += '</td>';
                                tempDataExport.push('');
                                dataTable += '<td>';
                                dataTable += obj.dataSales[i].data[j].dataReimburse[k].total.toLocaleString();
                                dataTable += '</td>';
                                tempDataExport.push(obj.dataSales[i].data[j].dataReimburse[k].total
                                    .toLocaleString());
                                dataTable += '<td>';
                                dataTable += '</td>';
                                tempDataExport.push('');
                                dataTable += '<td>';
                                dataTable += '</td>';
                                tempDataExport.push('');
                                dataTable += '<td>';
                                dataTable += saldo.toLocaleString();
                                dataTable += '</td>';
                                tempDataExport.push(saldo.toLocaleString());
                                dataTable += '<td>';
                                if (obj.dataSales[i].data[j].dataReimburse[k].idRevisiTotal == '2') {
                                    dataTable += 'REVISI';
                                    tempDataExport.push('REVISI');
                                } else {
                                    tempDataExport.push('');
                                }
                                dataTable += '</td>';
                                dataTable += '</tr>';
                                dataExportToCSV.push(tempDataExport);
                            }

                            for (var k = 0; k < obj.dataSales[i].data[j].dataSetor.length; k++) {
                                saldoSetoran += parseInt(obj.dataSales[i].data[j].dataSetor[k].total);
                                if (obj.dataSales[i].data[j].dataSetor[k].idReivisiTotal == '2') {
                                    pendingStatus = true;
                                }
                            }
                            var tempDataExport = [];
                            dataTable += '<tr>';
                            dataTable += '<td>';
                            dataTable += tanggalString;
                            dataTable += '</td>';
                            tempDataExport.push(tanggalExcel);

                            dataTable += '<td>';
                            dataTable += outlet;
                            dataTable += '</td>';
                            tempDataExport.push(outlet);

                            dataTable += '<td>';
                            dataTable += 'Setoran Tunai/Sales';
                            dataTable += '</td>';
                            tempDataExport.push('Setoran Tunai/Sales');

                            dataTable += '<td>';
                            dataTable += '</td>';
                            tempDataExport.push('');

                            dataTable += '<td>';
                            dataTable += saldo.toLocaleString();
                            dataTable += '</td>';
                            tempDataExport.push(saldo.toLocaleString());

                            dataTable += '<td>';
                            dataTable += saldoSetoran.toLocaleString();
                            dataTable += '</td>';
                            tempDataExport.push(saldoSetoran.toLocaleString());

                            dataTable += '<td>';
                            dataTable += (saldo-saldoSetoran).toLocaleString();
                            dataTable += '</td>';
                            tempDataExport.push((saldo-saldoSetoran).toLocaleString());

                            dataTable += '<td>';
                            dataTable += '0';
                            dataTable += '</td>';
                            tempDataExport.push('0');

                            dataTable += '<td>';
                            if (pendingStatus) {
                                dataTable += 'PENDING';
                                tempDataExport.push('PENDING');
                            } else {
                                tempDataExport.push('');
                            }
                            dataTable += '</td>';

                            dataTable += '</tr>';
                            dataExportToCSV.push(tempDataExport);
                        }
                    }
                    $('#statusInputTabel>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
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

        function downloadCSV() {
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
                'Tanggal (Format mm/dd/yyyy)',
                'Outlet',
                'Item Sales',
                'Jumlah (+-)',
                '',
                'Jumlah Diterima',
                'Fee E-Commerce',
                'Saldo',
                'Status',
            ]);
            for (var i = 0; i < dataExportToCSV.length; i++) {
                arrayAllData.push(dataExportToCSV[i]);
            }
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
    </script>
@endsection
