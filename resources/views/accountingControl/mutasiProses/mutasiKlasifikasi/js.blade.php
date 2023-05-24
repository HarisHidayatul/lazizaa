@extends('accountingControl.mutasiProses.index')

@section('mutasijs')
    <script>
        var idMutasiSelect = 0;
        $(document).ready(function() {
            // document.getElementById('mutasiProsesTabMenu').classList.add("active");
            document.getElementById("mutasiKlasifikasiSubMenu").classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Mutasi Klasifikasi";
            document.getElementById('linkContent').innerHTML = "Mutasi Klasifikasi";
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

        function generateMutasi(){
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var idPenerimaList = document.getElementById('selPenerima').value;
            $.ajax({
                url: "{{ url('mutasi/generate/detail') }}",
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    startDate: startDate,
                    stopDate: stopDate,
                    idPenerimaList: idPenerimaList
                }, // kirim data sebagai JSON string
                success: function(data) {
                    getListAllFilter();
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
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
            var urlAll = "{{ url('mutasi/show/sales') }}";
            $.ajax({
                url: urlAll,
                type: 'get',
                data: {
                    idPenerimaList: idPenerima,
                    startDate: startDate,
                    stopDate: stopDate
                },
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    console.log(obj);
                    for (var i = 0; i < obj.dataMutasi.length; i++) {
                        historyAll += '<tr>';
                        historyAll += '<td>';
                        historyAll += obj.dataMutasi[i].id;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.dataMutasi[i].tanggalBaru;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.dataMutasi[i].keterangan;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.dataMutasi[i].klasifikasi;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.dataMutasi[i].debit.toLocaleString();
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.dataMutasi[i].kredit.toLocaleString();
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.dataMutasi[i].cabang;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.dataMutasi[i].aksi;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += obj.dataMutasi[i].selisihHari;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        if (obj.dataMutasi[i].action == 0) {
                            historyAll +=
                                '<button type="button" class="btn btn-secondary" onclick="addMutasiKlasifikasi(';
                            historyAll += obj.dataMutasi[i].id;
                            historyAll += ')">Add</button>';
                        }
                        if (obj.dataMutasi[i].action == 1) {
                            historyAll +=
                                '<button type="button" class="btn btn-secondary" onclick="deleteMutasiKlasifikasi(';
                            historyAll += obj.dataMutasi[i].id;
                            historyAll += ')">Delete</button>';
                        }
                        historyAll += '</td>';
                        historyAll += '</tr>';
                    }
                    var lokasiScroll =  window.scrollY || window.pageYOffset;
                    console.log(lokasiScroll);
                    $('#statusInputTabel>tbody').empty().append(historyAll);
                    window.scrollTo(0,lokasiScroll+35);

                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function deleteMutasiKlasifikasi(idMutasi) {
            idMutasiSelect = idMutasi;
            $('#deleteModalCenter').modal('show');
        }

        function deleteMutasi() {
            $.ajax({
                url: "{{ url('mutasi/detail/delete') }}",
                type: 'delete',
                data: {
                    "_token": "{{ csrf_token() }}",
                    idMutasiTransaksi: idMutasiSelect
                },
                success: function(response) {
                    getListAllFilter();
                    $('#deleteModalCenter').modal('hide');
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function backDeleteClick() {
            $('#deleteModalCenter').modal('hide');
        }

        function addMutasiKlasifikasi(idMutasi) {
            idMutasiSelect = idMutasi;
            var urlAll = "{{ url('mutasi/show/id') }}" + '/' + idMutasi;
            $.ajax({
                url: urlAll,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    console.log(obj);
                    document.getElementById('keteranganAdd').innerHTML = obj.keterangan;
                    document.getElementById('totalAdd').innerHTML = obj.total.toLocaleString();

                    var listOutlet = '<option value="0">Pilih Outlet</option>';
                    var listKlasifikasi = '<option value="0">Pilih Klasifikasi</option>';
                    var listAksi = '<option value="0">Pilih Aksi</option>';
                    for (var i = 0; i < obj.outlet.length; i++) {
                        listOutlet += '<option value="';
                        listOutlet += obj.outlet[i].id;
                        listOutlet += '">';
                        listOutlet += obj.outlet[i].outlet;
                        listOutlet += '</option>';
                    }
                    for (var i = 0; i < obj.mutasiAksi.length; i++) {
                        listAksi += '<option value="';
                        listAksi += obj.mutasiAksi[i].id;
                        listAksi += '">';
                        listAksi += obj.mutasiAksi[i].aksi;
                        listAksi += '</option>';
                    }
                    for (var i = 0; i < obj.mutasiKlasifikasi.length; i++) {
                        listKlasifikasi += '<option value="';
                        listKlasifikasi += obj.mutasiKlasifikasi[i].id;
                        listKlasifikasi += '">';
                        listKlasifikasi += obj.mutasiKlasifikasi[i].klasifikasi;
                        listKlasifikasi += '</option>';
                    }
                    $('#klasifikasiAdd').empty().append(listKlasifikasi);
                    $('#cabangAdd').empty().append(listOutlet);
                    $('#aksiAdd').empty().append(listAksi);
                    document.getElementById('hPlusAdd').value =0;
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
            $('#addModalCenter').modal('show');
        }

        function backMutasiClick() {
            $('#addModalCenter').modal('hide');
        }

        function sendMutasi() {
            var idMutasiAksi = document.getElementById('aksiAdd').value;
            var idOutlet = document.getElementById('cabangAdd').value;
            var idMutasiKlasifikasi = document.getElementById('klasifikasiAdd').value;
            var hPlusAdd = document.getElementById('hPlusAdd').value;
            $.ajax({
                url: "{{ url('mutasi/detail/create') }}",
                type: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    idMutasiTransaksi: idMutasiSelect,
                    idMutasiAksi: idMutasiAksi,
                    idOutlet: idOutlet,
                    idMutasiKlasifikasi: idMutasiKlasifikasi,
                    selisihHari: hPlusAdd
                },
                success: function(response) {
                    getListAllFilter();
                    $('#addModalCenter').modal('hide');
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
