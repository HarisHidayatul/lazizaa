@extends('accountingControl.mutasiProses.index')

@section('mutasijs')
    <script>
        var idMutasiArray = [];
        var idMutasiSalesArray = [];
        $(document).ready(function() {
            // document.getElementById('mutasiProsesTabMenu').classList.add("active");
            document.getElementById("penjualanMutasiSubMenu").classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Proses Mutasi Penjualan";
            document.getElementById('linkContent').innerHTML = "Proses Mutasi Penjualan";
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
            // var accessHistory = document.getElementById('selDate').value;
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var idPenerimaList = document.getElementById('selPenerima').value;
            var urlAll = "{{ url('mutasi/show/penjualan') }}";
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
                    idMutasiSalesArray.length = 0;
                    console.log(objAllData);
                    // $('#statusInputTabel>tbody').empty().append(historyAll);
                    var optionListSales = '<option value="0">Pilih Sales</option>';
                    var optionOutlet = '<option value="0">Pilih Outlet</option>';
                    for (var i = 0; i < objAllData.listSales.length; i++) {
                        optionListSales += '<option value="';
                        optionListSales += objAllData.listSales[i].id;
                        optionListSales += '">';
                        optionListSales += objAllData.listSales[i].listSales;
                        optionListSales += '</option>';
                    }
                    for (var i = 0; i < objAllData.outlet.length; i++) {
                        optionOutlet += '<option value="';
                        optionOutlet += objAllData.outlet[i].id;
                        optionOutlet += '">';
                        optionOutlet += objAllData.outlet[i].outlet;
                        optionOutlet += '</option>';
                    }
                    for (var i = 0; i < objAllData.dataMutasi.length; i++) {
                        historyAll += '<tr>';
                        historyAll += '<td>';
                        historyAll += objAllData.dataMutasi[i].tanggalBaru;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += objAllData.dataMutasi[i].trxNotes;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += objAllData.dataMutasi[i].total.toLocaleString();
                        historyAll += '</td>';

                        historyAll += '<td>';
                        historyAll += '<div class="form-group">';
                        historyAll += '<select class="form-control" name="dropDownListSales">';
                        historyAll += optionListSales;
                        historyAll += '</select>';
                        historyAll += '</div>';
                        historyAll += '</td>';

                        historyAll += '<td>';
                        historyAll += '<div class="form-group">';
                        historyAll += '<select class="form-control" name="dropDownOutlet">';
                        historyAll += optionOutlet;
                        historyAll += '</select>';
                        historyAll += '</div>';
                        historyAll += '</td>';

                        historyAll += '<td>';
                        historyAll += '<button type="button" class="btn btn-secondary" onClick="editItem(' +
                            i +
                            ');">Edit</button>';
                        historyAll += '</td>';

                        historyAll += '</tr>';

                        idMutasiArray.push(objAllData.dataMutasi[i].id);
                        idMutasiSalesArray.push(objAllData.dataMutasi[i].idMutasiSales);
                    }
                    $('#statusInputTabel>tbody').empty().append(historyAll);
                    var dropDownListSales = document.getElementsByName('dropDownListSales');
                    var dropDownOutlet = document.getElementsByName('dropDownOutlet');

                    for (var i = 0; i < objAllData.dataMutasi.length; i++) {
                        dropDownListSales[i].value = objAllData.dataMutasi[i].idListSales;
                        dropDownOutlet[i].value = objAllData.dataMutasi[i].idOutlet;
                    }
                    console.log(idMutasiArray);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function generateMutasi() {
            // var accessHistory = document.getElementById('selDate').value;
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var idPenerimaList = document.getElementById('selPenerima').value;
            var urlAll = "{{ url('mutasi/generate/penjualan') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: urlAll,
                type: 'post',
                data: {
                    idPenerimaList: idPenerimaList,
                    startDate: startDate,
                    stopDate: stopDate
                },
                success: function(response) {
                    var objAllData = JSON.parse(JSON.stringify(response));
                    getListAllFilter();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function editItem(index) {
            var idListSales = document.getElementsByName('dropDownListSales')[index].value;
            var idOutlet = document.getElementsByName('dropDownOutlet')[index].value;
            var idMutasi = idMutasiArray[index];
            var idMutasiSales = idMutasiSalesArray[index];

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: "{{ url('mutasi/edit/penjualan') }}",
                type: 'patch',
                data: {
                    idListSales: idListSales,
                    idOutlet: idOutlet,
                    idMutasi: idMutasi,
                    idMutasiSales: idMutasiSales
                }, // kirim data sebagai JSON string
                success: function(data) {
                    // var obj = JSON.parse(JSON.stringify(data));

                    // alert('Data berhasil diposting!');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
@endsection
