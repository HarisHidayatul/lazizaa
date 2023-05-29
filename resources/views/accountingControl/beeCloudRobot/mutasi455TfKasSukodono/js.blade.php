@extends('accountingControl.beeCloudRobot.index')

@section('robotjs')
    <script>
        $(document).ready(function() {
            document.getElementById("mutasi455TfKasSukodonoRobotSubMenu").classList.add("active");
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

            getPenerima();
        })

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
            var idPenerima = document.getElementById('selPenerima').value;
            var urlAll = "{{ url('robot/mutasi455TfKasPenerimaan/show/all') }}";
            $.ajax({
                url: urlAll,
                type: 'get',
                data: {
                    idPenerima: idPenerima,
                    startDate: startDate,
                    stopDate: stopDate
                },
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    console.log(obj);
                    for (var i = 0; i < obj.data.length; i++) {
                        historyAll += '<tr>';
                        historyAll += '<td>';
                        historyAll += obj.data[i].tanggal;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.data[i].keterangan;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.data[i].klasifikasi;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.data[i].debit.toLocaleString();
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.data[i].kredit.toLocaleString();
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.data[i].cabang;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        for (var j = 0; j < obj.data[i].dataRobot.length; j++) {
                            historyAll += '<div title="';
                            historyAll += obj.data[i].dataRobot[j].perevisi;
                            historyAll += '">';
                            historyAll += obj.data[i].dataRobot[j].status;
                            historyAll += '</div>';
                        }
                        historyAll += '</td>';
                        historyAll += '<td>';
                        if (obj.data[i].dataRobot.length > 0) {
                            for (var j = 0; j < obj.data[i].dataRobot.length; j++) {
                                if (obj.data[i].dataRobot[j].status == 'pending') {
                                    historyAll +=
                                        '<button type="button" class="btn btn-secondary" onClick="deleteVerifikasi(';
                                    historyAll += obj.data[i].dataRobot[j].id;
                                    historyAll += ')">';
                                    historyAll += 'Delete';
                                    historyAll += '</button>';
                                }
                            }
                        } else {
                            historyAll +=
                                '<button type="button" class="btn btn-secondary" onClick="sendVerifikasi(';
                            historyAll += obj.data[i].id;
                            historyAll += ')">';
                            historyAll += 'Verifikasi';
                            historyAll += '</button>';
                        }
                        historyAll += '</td>';
                        historyAll += '</tr>';
                    }
                    $('#statusInputTabel>tbody').empty().append(historyAll);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function deleteVerifikasi(idRobotMutasi455TfKas) {
            $.ajax({
                url: "{{ url('robot/mutasi455TfKasPenerimaan/delete') }}",
                type: 'delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                    idRobotMutasi455TfKas: idRobotMutasi455TfKas
                },
                success: function(response) {
                    getListAllFilter();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendVerifikasi(idPelunasanMutasiSales) {
            $.ajax({
                url: "{{ url('robot/mutasi455TfKasPenerimaan/create') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    idPelunasanMutasiSales: idPelunasanMutasiSales,
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
