@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        $(document).ready(function() {
            document.getElementById('checkExistTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Status Input";
            document.getElementById('linkContent').innerHTML = "Status Input";

            
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

        });

        function getAllDataExist() {
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var urlDate = "{{ url('getAllDateBetween') }}" + '/' + startDate;
            urlDate += '/' + stopDate;

            $.ajax({
                url: urlDate,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    refreshTable(obj);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function refreshTable(obj) {
            var dataTable = '';
            for (var i = 0; i < obj.dataTanggal.length; i++) {
                var boolTanggal = true;
                for (var j = 0; j < obj.dataTanggal[i].itemOutlet.length; j++) {
                    var dataSesi = '';
                    dataTable += '<tr>';
                    dataTable += '<td>';
                    if (boolTanggal) {
                        dataTable += obj.dataTanggal[i].Tanggal;
                        boolTanggal = false;
                    }
                    dataTable += '</td>';
                    for (var k = 0; k < obj.dataTanggal[i].itemOutlet[j].data.length; k++) {
                        for (var l = 0; l < obj.dataTanggal[i].itemOutlet[j].data[k].length; l++) {
                            var status = '';
                            dataSesi += '<td ';
                            if (obj.dataTanggal[i].itemOutlet[j].data[k][l] == 1) {
                                dataSesi += 'style="color: green;"';
                                status += 'Sudah';
                            } else {
                                dataSesi += 'style="color: red;"';
                                status += 'Belum';
                            }
                            dataSesi += '>';
                            dataSesi += status;
                            dataSesi += '</td>';
                        }
                    }
                    dataTable += '<td>';
                    dataTable += obj.dataTanggal[i].itemOutlet[j].outlet;
                    dataTable += '</td>';
                    dataTable += dataSesi;
                    
                    var status2 = 'Belum';
                    dataTable += '<td ';
                    if(obj.dataTanggal[i].itemOutlet[j].reimburse == '1'){
                        dataTable += 'style="color: green;"';
                        status2 = 'Sudah'
                    }else{
                        dataTable += 'style="color: red;"';
                    }
                    dataTable += '>'
                    dataTable += status2;
                    dataTable += '</td>';

                    status2 = 'Belum';
                    dataTable += '<td ';
                    if(obj.dataTanggal[i].itemOutlet[j].setoran == '1'){
                        dataTable += 'style="color: green;"';
                        status2 = 'Sudah'
                    }else{
                        dataTable += 'style="color: red;"';
                    }
                    dataTable += '>'
                    dataTable += status2;
                    dataTable += '</td>';

                    dataTable += '</tr>';
                }
            }
            $('#statusInputTabel>tbody').empty().append(dataTable);
        }
    </script>
@endsection
