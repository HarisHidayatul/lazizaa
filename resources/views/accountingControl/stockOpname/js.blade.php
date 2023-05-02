@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        var bulanIndonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember'
        ];

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

            document.getElementById('stockOpnameTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Stock Opname";
            document.getElementById('linkContent').innerHTML = "Stock Opname";

            getAllOutlet();
        })

        function getAllData() {
            var idOutlet = document.getElementById('selOutlet').value;
            var countData = "between";
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            $.ajax({
                url: "{{ url('soHarian/show/history') }}",
                type: 'get',
                data: {
                    idOutlet: idOutlet,
                    countData: countData,
                    startDate: startDate,
                    stopDate: stopDate,
                    accessRole: "accounting"
                },
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    insertDataTheadTable(obj);

                    var dataBody = '';
                    var arrayItem = [];
                    // var dataItem = [];

                    //Dapatkan semua item
                    for (var i = 0; i < obj.dataItemSO.length; i++) {
                        arrayItem.push([
                            obj.dataItemSO[i].id,
                            obj.dataItemSO[i].Item,
                            obj.dataItemSO[i].Satuan
                        ]);
                    }

                    for (var i = 0; i < arrayItem.length; i++) {
                        //Loop untuk tiap item
                        dataBody += '<tr>';
                        dataBody += '<td>';
                        dataBody += arrayItem[i][1];
                        dataBody += '</td>';
                        dataBody += '<td>';
                        dataBody += arrayItem[i][2];
                        dataBody += '</td>';
                        for (var j = 0; j < obj.allData.length; j++) {
                            for (var k = 0; k < obj.allData[j].dataHistory.length; k++) {
                                var dataItemSo = 0;
                                for (var l = 0; l < obj.allData[j].dataHistory[k].dataSo.length; l++) {

                                    for (var m = 0; m < obj.allData[j].dataHistory[k].dataSo[l].dataSo
                                        .length; m++) {
                                        if (obj.allData[j].dataHistory[k].dataSo[l].dataSo[m].idItem ==
                                            arrayItem[i][0]) {
                                            dataItemSo = obj.allData[j].dataHistory[k].dataSo[l].dataSo[m]
                                                .quantity;
                                        }
                                    }
                                }
                                dataBody += '<td>';
                                dataBody += dataItemSo;
                                dataBody += '</td>';
                            }
                        }
                        dataBody += '</tr>';
                    }


                    // console.log(dataBody);

                    $('#statusInputTabel>tbody').empty().append(dataBody);
                    console.log(arrayItem);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })

        }

        function insertDataTheadTable(obj) {
            var dataThead = '';

            var headOutlet = '';
            var headDate = '';
            var headMonth = '';
            headOutlet += '<tr>';
            headOutlet += '<td></td>';
            headOutlet += '<td></td>';

            headDate += '<tr>';
            headDate += '<td>Nama Item</td>';
            headDate += '<td>Satuan</td>';

            headMonth += '<tr>';
            headMonth += '<td></td>';
            headMonth += '<td></td>';

            for (var i = 0; i < obj.allData.length; i++) {
                //Membuat array coloumn yang menampung span table dari tanggal dibawah
                var arrayMonth = [];

                //Membuat header untuk outlet
                headOutlet += '<td colspan="';
                headOutlet += obj.allData[i].dataHistory.length;
                headOutlet += '">';
                headOutlet += obj.allData[i].outlet;
                headOutlet += '</td>';

                var monthBefore = 0;
                var loopMonth = 1;

                var namaBulan = '';
                var tahun = '';

                for (var j = 0; j < obj.allData[i].dataHistory.length; j++) {
                    var date = new Date(obj.allData[i].dataHistory[j].Tanggal);
                    var monthNow = date.getMonth() + 1; // tambahkan 1 karena index bulan dimulai dari 0

                    if (monthNow == monthBefore) {
                        loopMonth++;
                    } else {
                        if (j != 0) {
                            arrayMonth.push([
                                loopMonth,
                                (namaBulan + ' ' + tahun)
                            ]);
                            loopMonth = 1;
                        }
                    }
                    if (j == (obj.allData[i].dataHistory.length - 1)) {
                        namaBulan = bulanIndonesia[date.getMonth()];
                        tahun = date.getFullYear();
                        arrayMonth.push([
                            loopMonth,
                            (namaBulan + ' ' + tahun)
                        ]);
                    }

                    monthBefore = monthNow;
                    namaBulan = bulanIndonesia[date.getMonth()];
                    tahun = date.getFullYear();

                    headDate += '<td>';
                    headDate += date.getDate();
                    headDate += '</td>';
                }

                for (var j = 0; j < arrayMonth.length; j++) {
                    headMonth += '<td colspan="';
                    headMonth += arrayMonth[j][0];
                    headMonth += '">';
                    headMonth += arrayMonth[j][1];
                    headMonth += '</td>';
                }
            }
            headDate += '</tr>';
            headMonth += '</tr>';
            headOutlet += '</tr>';
            dataThead = headOutlet + headMonth + headDate;

            $('#statusInputTabel>thead').empty().append(dataThead);
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
                    // listAllOutlet += '<option value=0>Semua</option>'
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
            var filename = 'Data SO Outlet ';
            filename += document.getElementById('statusInputTabel').value;
            filename += ' ';
            filename += document.getElementById('startDate').value;
            filename += ' Sampai ';
            filename += document.getElementById('stopDate').value;
            downloadCSV2(filename);
        }

        function downloadCSV2(filename) {
            // Mendapatkan referensi ke tabel
            var table = document.getElementById("statusInputTabel");

            // Membuat variabel untuk menyimpan data
            var data = [];

            // Mendapatkan header tabel
            var header = [];
            var headerRow = table.rows[0].cells;
            for (var i = 0; i < headerRow.length; i++) {
                var cell = headerRow[i];
                var colspan = cell.getAttribute("colspan");
                colspan = colspan ? parseInt(colspan) : 1;
                for (var j = 0; j < colspan; j++) {
                    header.push(cell.textContent.trim());
                }
            }
            data.push(header);

            // Mendapatkan data dari setiap baris tabel
            for (var i = 1; i < table.rows.length; i++) {
                var row = [];
                for (var j = 0; j < table.rows[i].cells.length; j++) {
                    var cell = table.rows[i].cells[j];
                    var colspan = cell.getAttribute("colspan");
                    colspan = colspan ? parseInt(colspan) : 1;
                    for (var k = 0; k < colspan; k++) {
                        row.push(cell.textContent.trim());
                    }
                }
                data.push(row);
            }

            // Membuat tautan untuk mengunduh CSV
            var csvContent = "data:text/csv;charset=utf-8,";
            data.forEach(function(rowArray) {
                var row = rowArray.join(",");
                csvContent += row + "\r\n";
            });
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "tabel.csv");
            document.body.appendChild(link);
            link.click();
        }
    </script>
@endsection
