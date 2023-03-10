@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        var objPenerima = [];
        var indexSetoran = 0;
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

            document.getElementById('setoransTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Setoran Tunai";
            document.getElementById('linkContent').innerHTML = "Setoran Tunai";
        })
        $(document).ready(function() {
            getAllOutlet();
            getAllPenerima();
        })

        function kirimTransfer() {
            var idRevisi = 2;
            var idPenerima = document.getElementById('listPenerima').value;
            if (document.getElementById('doneTransfer').checked) {
                idRevisi = 3;
            }

            $.ajax({
                url: "{{ url('setoran/update/accounting/revisi') }}" + '/' + indexSetoran,
                type: 'get',
                data: {
                    idPenerima: idPenerima,
                    idRevisi: idRevisi
                },
                success: function(response) {
                    $("#exampleModalCenter").modal('hide');
                    getListAllFilter();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function deleteTransfer(){
            $.ajax({
                url: "{{ url('setoran/delete/accounting/revisi') }}" + '/' + indexSetoran,
                type: 'get',
                success: function(response) {
                    $("#deleteModalCenter").modal('hide');
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
            var urlAll = "{{ url('setoran/show/data/inPart') }}" + '/' + accessOutlet + '/' + 'between' + '/' + startDate +
                '/' + stopDate;
            $.ajax({
                url: urlAll,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    console.log(obj);
                    for (var i = 0; i < obj.setoran.length; i++) {
                        for (var j = 0; j < obj.setoran[i].setoran.length; j++) {
                            historyAll += '<tr style="cursor: pointer;" onClick="clickSetoran(';
                            historyAll += obj.setoran[i].setoran[j].id;
                            historyAll += ')">';

                            historyAll += '<td>';
                            historyAll += obj.setoran[i].Tanggal;
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += obj.setoran[i].setoran[j].qty.toLocaleString().replaceAll(',', '.');
                            historyAll += '</td>';
                            historyAll += '<td ';
                            if (obj.setoran[i].setoran[j].idRev == '2') {
                                historyAll += 'style="color: red;"';
                                statusRevisi = 'PENDING';
                            } else if (obj.setoran[i].setoran[j].idRev == '3') {
                                historyAll += 'style="color: green;"';
                                statusRevisi = 'SUKSES';
                            }
                            historyAll += '>';
                            historyAll += statusRevisi;
                            historyAll += '</td>';
                            historyAll += '</tr>';
                        }
                    }
                    $('#statusInputTabel>tbody').empty().append(historyAll);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function clickSetoran(index) {
            indexSetoran = index;
            $.ajax({
                url: "{{ url('setoran/show/detail') }}" + '/' + index,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var setoranStatus = '';
                    if (obj.idStatus == '2') {
                        setoranStatus = 'PENDING';
                        document.getElementById('doneTransfer').checked = false;
                    } else if (obj.idStatus == '3') {
                        setoranStatus = 'SUKSES';
                        document.getElementById('doneTransfer').checked = true;
                    }
                    document.getElementById('filePathName').href = "{{ url('storage') }}" + '/' + obj
                        .imagePathFile;
                    document.getElementById('filePathName').innerHTML = obj.imagePathFile;
                    document.getElementById('statusSetoran').innerHTML = setoranStatus;
                    document.getElementById('tanggalSetoran').innerHTML = obj.date;
                    document.getElementById('namaPengirim').innerHTML = obj.namaRekeningPengirim;
                    document.getElementById('bankPengirim').innerHTML = obj.bankPengirim;
                    document.getElementById('rekeningPengirim').innerHTML = obj.nomorRekeningPengirim;
                    document.getElementById('setoranPengirim').innerHTML = obj.qty.toLocaleString().replaceAll(
                        ',', '.');
                    // document.getElementById('')
                    setPengirim(obj.idPenerima);
                    transferCheck();
                    $('#exampleModalCenter').modal('toggle');
                },
                error: function(req, err) {}
            })
        }

        function setPengirim(id) {
            document.getElementById('listPenerima').value = id;
        }

        function transferCheck() {
            if (document.getElementById('doneTransfer').checked) {
                document.getElementById('listPenerima').disabled = false;
                document.getElementById('bankPenerima').style.color = "black";
                document.getElementById('rekeningPenerima').style.color = "black";
            } else {
                document.getElementById('listPenerima').disabled = true;
                document.getElementById('bankPenerima').style.color = "darkgrey";
                document.getElementById('rekeningPenerima').style.color = "darkgrey";
            }
        }

        function getAllPenerima() {
            $.ajax({
                url: "{{ url('setoran/penerima/show') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataJenis = '';
                    console.log(obj);
                    objPenerima = obj;
                    var listPenerima = '';
                    for (var i = 0; i < obj.penerimaListArray.length; i++) {
                        listPenerima += '<option value="' + obj.penerimaListArray[i].id;
                        listPenerima += '" data-index="' + i + '" >' + obj.penerimaListArray[i].namaRekening;
                        listPenerima += '</option>';
                    }
                    $('#listPenerima').empty().append(listPenerima);
                    refreshListPenerima(0);
                },
                error: function(req, err) {}
            })
        }

        function refreshListPenerima(index) {
            // var valueSelectList = document.getElementById('listPenerima').getAttribute('data-index');

            // console.log(index);
            document.getElementById('bankPenerima').innerHTML = objPenerima.penerimaListArray[index].bank;
            document.getElementById('rekeningPenerima').innerHTML = objPenerima.penerimaListArray[index]
                .nomorRekening;
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

        function backDeleteClick() {
            $('#exampleModalCenter').modal('show');
            $('#deleteModalCenter').modal('hide');
        }

        function deleteTabClick() {
            $('#exampleModalCenter').modal('hide');
            $('#deleteModalCenter').modal('show');

        }
    </script>
@endsection
