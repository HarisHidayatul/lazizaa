@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        var valueTotalAll = [];
        var idSalesFill = [];

        var objAll = '';

        $(document).ready(function() {
            var today = new Date();
            var month = today.getMonth() + 1;
            var stringMonth = '';
            if (month / 10 == 0) {
                stringMonth = month;
            } else {
                stringMonth = '0' + month % 10;
            }
            document.getElementById('startDate').value = today.getFullYear() + '-' + stringMonth + '-' + today
                .getDate();
            document.getElementById('stopDate').value = today.getFullYear() + '-' + stringMonth + '-' + today
                .getDate();

            document.getElementById('verifikasiSalesTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Verifikasi Sales";
            document.getElementById('linkContent').innerHTML = "Verifikasi Sales";
            getAllOutlet();
        })

        function editItem(index) {
            $.ajax({
                url: "{{ url('salesHarian/update/verifikasi') }}" + '/' + idSalesFill[index],
                type: 'get',
                data: {
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
                    for (var i = 0; i < obj.itemSales.length; i++) {
                        for (var j = 0; j < obj.itemSales[i].Item.length; j++) {
                            for (var k = 0; k < obj.itemSales[i].Item[j].Item.length; k++) {
                                historyAll += '<tr>';
                                historyAll += '<td>';
                                // Example date in yyyy-mm-dd format
                                const dateStr = obj.itemSales[i].Tanggal;

                                // Split the string into year, month, and day components
                                const [year, month, day] = dateStr.split('-');

                                historyAll += `${day}/${month}/${year}`;
                                historyAll += '</td>';
                                historyAll += '<td>';
                                historyAll += obj.itemSales[i].Item[j].Outlet;
                                historyAll += '</td>';
                                historyAll += '<td>';
                                historyAll += obj.itemSales[i].Item[j].Item[k].sales;
                                historyAll += '</td>';

                                historyAll += '<td ';
                                if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '2') {
                                    historyAll += 'style="color:tomato;" ';
                                } else if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '3') {
                                    historyAll += 'style="color:rgb(30, 206, 9);" ';
                                }
                                historyAll += '>';

                                historyAll += obj.itemSales[i].Item[j].Item[k].totalQty.toLocaleString();
                                historyAll += '</td>';
                                historyAll += '<td>';
                                historyAll += '<input class="inputTotal" name="inputTotal" ';
                                // historyAll += obj.itemSales[i].Item[j].Item[k].jumlahDiterima;
                                historyAll += '>';
                                historyAll += '</td>';
                                historyAll += '<td>';
                                historyAll += obj.itemSales[i].Item[j].Item[k].selisih.toLocaleString();
                                historyAll += '</td>';

                                historyAll += '<td>';
                                historyAll += Math.round(((obj.itemSales[i].Item[j].Item[k].selisih) * 100) / (
                                    obj.itemSales[i].Item[j].Item[k].totalQty));
                                historyAll += '%';
                                historyAll += '</td>';

                                historyAll += '<td>';
                                historyAll +=
                                    '<button type="button" class="btn btn-secondary" onClick="editItem(' +
                                    loopCount +
                                    ');">Submit</button>';
                                historyAll += '</td>';
                                historyAll += '</tr>';

                                idSalesFill.push(obj.itemSales[i].Item[j].Item[k].idSalesFill);
                                loopCount++;
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
                        for (var j = 0; j < obj.itemSales[i].Item.length; j++) {
                            for (var k = 0; k < obj.itemSales[i].Item[j].Item.length; k++) {
                                valueTotalAll[loopCount].set(obj.itemSales[i].Item[j].Item[k].jumlahDiterima);
                                loopCount++;
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
            for (var i = 0; i < obj.itemSales.length; i++) {
                for (var j = 0; j < obj.itemSales[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemSales[i].Item[j].Item.length; k++) {
                        var tanggal = '';
                        var outlet = '';
                        var item_sales = '';
                        var jumlah = '';
                        var jumlah_diterima = '';
                        var fee = '';
                        var percent = '';

                        // Example date in yyyy-mm-dd format
                        const dateStr = obj.itemSales[i].Tanggal;

                        // Split the string into year, month, and day components
                        const [year, month, day] = dateStr.split('-');

                        tanggal = `${day}/${month}/${year}`;
                        outlet = obj.itemSales[i].Item[j].Outlet;
                        item_sales = obj.itemSales[i].Item[j].Item[k].sales;

                        jumlah = obj.itemSales[i].Item[j].Item[k].totalQty.toLocaleString();

                        jumlah_diterima = obj.itemSales[i].Item[j].Item[k].jumlahDiterima.toLocaleString();

                        fee = obj.itemSales[i].Item[j].Item[k].selisih.toLocaleString();

                        percent = Math.round(((obj.itemSales[i].Item[j].Item[k].selisih) * 100) / (
                            obj.itemSales[i].Item[j].Item[k].totalQty));

                        arrayAllData.push([
                            tanggal,
                            outlet,
                            item_sales,
                            jumlah,
                            jumlah_diterima,
                            fee,
                            percent
                        ]);
                    }
                }
            }
            exportToCsv(namaFile,arrayAllData);
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
    </script>
@endsection
