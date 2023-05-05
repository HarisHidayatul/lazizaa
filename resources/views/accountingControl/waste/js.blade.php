@extends('accountingControl.layout.index')

@section('filljs')
    <script>
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

            document.getElementById('wasteReportTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Waste";
            document.getElementById('linkContent').innerHTML = "Waste";

            getAllOutlet();
        })

        function getAllData (){
            // waste/show/history/outlet
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var selOutlet = document.getElementById('selOutlet').value;
            $.ajax({
                url: "{{ url('waste/show/history/outlet') }}" + '/' + selOutlet + '/between' + '/' + startDate + '/' + stopDate,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataTable = '';
                    for(var i=0;i<obj.allData.length;i++){
                        for(var j=0;j<obj.allData[i]?.data.length;j++){
                            for(var k=0;k<obj.allData[i].data[j]?.waste.length;k++){
                                for(var l=0;l<obj.allData[i].data[j].waste[k]?.waste.length;l++){
                                    dataTable += '<tr>';
                                    dataTable += '<td>';
                                    dataTable += obj.allData[i].data[j].tanggal;
                                    dataTable += '</td>';
                                    dataTable += '<td>';
                                    dataTable += obj.allData[i].outlet;
                                    dataTable += '</td>';
                                    dataTable += '<td>';
                                    dataTable += obj.allData[i].data[j].waste[k].sesi;
                                    dataTable += '</td>';
                                    dataTable += '<td>';
                                    dataTable += obj.allData[i].data[j].waste[k].waste[l].item;
                                    dataTable += '</td>';
                                    dataTable += '<td>';
                                    dataTable += '</td>';
                                    dataTable += '<td>';
                                    dataTable += obj.allData[i].data[j].waste[k].waste[l].quantity;
                                    dataTable += '</td>';
                                    dataTable += '<td>';
                                    dataTable += obj.allData[i].data[j].waste[k].waste[l].satuan;
                                    dataTable += '</td>';
                                    dataTable += '<td>';
                                    dataTable += obj.allData[i].data[j].waste[k].waste[l].pengisi;
                                    dataTable += '</td>';
                                    dataTable += '<td>';
                                    if(obj.allData[i].data[j].waste[k].waste[l].idRev == '2'){
                                        dataTable += 'REVISI';
                                    }
                                    dataTable += '</td>';
                                    dataTable += '</tr>';
                                }
                            }
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

        function downloadCSV() {
            var filename = 'Data Waste ';
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
