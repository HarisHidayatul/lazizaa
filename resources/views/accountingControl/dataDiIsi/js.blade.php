@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        $(document).ready(function() {
            document.getElementById('checkExistTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Status Input";
            document.getElementById('linkContent').innerHTML = "Status Input";

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
                    dataTable += '</tr>';
                }
            }
            $('#statusInputTabel>tbody').empty().append(dataTable);
        }
    </script>
@endsection
