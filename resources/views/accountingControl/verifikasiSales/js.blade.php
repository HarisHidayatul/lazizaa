@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        var valueTotalAll = [];
        var idSalesFill = [];

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
                    valueTotalAll.length = 0;
                    idSalesFill.length = 0;
                    var loopCount = 0;
                    for (var i = 0; i < obj.itemSales.length; i++) {
                        for (var j = 0; j < obj.itemSales[i].Item.length; j++) {
                            for (var k = 0; k < obj.itemSales[i].Item[j].Item.length; k++) {
                                historyAll += '<tr>';
                                historyAll += '<td>';
                                historyAll += obj.itemSales[i].Tanggal;
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
                                historyAll += obj.itemSales[i].Item[j].Item[k].persen;
                                historyAll += '</td>';
                                historyAll += '<td>';
                                historyAll +=
                                    '<button type="button" class="btn btn-secondary" onClick="editItem(' + loopCount +
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
