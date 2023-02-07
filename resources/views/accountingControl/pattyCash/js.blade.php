@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        var objPenerima = [];
        var indexReimburse = 0;
        var idTempImgAll = 0;

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

            document.getElementById('pattyCashsTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Patty Cash";
            document.getElementById('linkContent').innerHTML = "Patty Cash";

            showUploadView();
        })
        $(document).ready(function() {
            getAllOutlet();
            getAllPenerima();
        })

        function uploadFileImage() {
            // console.log('fasfdasdf');
            var form = $('#formUploadImage')[0];

            // Create an FormData object 
            var data = new FormData(form);
            data.append("_token", "{{ csrf_token() }}");

            $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: "{{ url('postImage') }}",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
                success: function(data) {
                    console.log(data);
                    showTempImg(data);
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }

        function showTempImg(id) {
            idTempImgAll = id;
            showBuktiTF();
            $.ajax({
                type: "GET",
                url: "{{ url('showImageTemp') }}" + '/' + id,
                success: function(data) {
                    console.log(data);
                    document.getElementById('filePathName').innerHTML = data.substring(12, 20) + '....';
                    document.getElementById('filePathName').href = "{{ url('storage') }}" + '/' + data;
                },
                error: function(e) {
                    console.log(e);
                }
            });
        }

        function deleteTempImg() {
            $.ajax({
                type: "GET",
                url: "{{ url('delImageTemp') }}" + '/' + idTempImgAll,
                success: function(data) {
                    console.log(data);
                    idTempImgAll = 0;
                    showUploadView();
                },
                error: function(e) {
                    console.log(e);
                    showUploadView();
                }
            });
        }

        function showUploadView() {
            document.getElementById('wrapImageUpload').style.display = 'none';
            document.getElementById('formUploadImage').style.display = 'block';
        }

        function showBuktiTF() {
            document.getElementById('formUploadImage').style.display = 'none';
            document.getElementById('wrapImageUpload').style.display = 'block';
        }

        function kirimTransfer() {
            var idRevisi = 2;
            var idPengirim = document.getElementById('listPenerima').value;
            var pesan = document.getElementById('pesanPenerima').value;
            if (idPengirim == 0) {
                idPengirim = 1;
            }
            if (document.getElementById('doneTransfer').checked) {
                idRevisi = 3;
                $.ajax({
                    url: "{{ url('reimburse/update/accounting/revisi') }}" + '/' + indexReimburse,
                    type: 'get',
                    data: {
                        idPengirim: idPengirim,
                        idRevisi: idRevisi,
                        pesan: pesan,
                        idImageTemp: idTempImgAll
                    },
                    success: function(response) {
                        $("#exampleModalCenter").modal('hide');
                        getListAllFilter();
                    },
                    error: function(req, err) {
                        console.log(err);
                    }
                });
            } else {
                $.ajax({
                    url: "{{ url('reimburse/update/accounting/revisi') }}" + '/' + indexReimburse,
                    type: 'get',
                    data: {
                        idPengirim: idPengirim,
                        idRevisi: idRevisi,
                        pesan: pesan
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
        }

        function setPengirim(id) {
            document.getElementById('listPenerima').value = id;
        }

        function transferCheck() {
            if (document.getElementById('doneTransfer').checked) {
                document.getElementById('listPenerima').disabled = false;
                document.getElementById('bankPengirim').style.color = "black";
                document.getElementById('rekeningPengirim').style.color = "black";
            } else {
                document.getElementById('listPenerima').disabled = true;
                document.getElementById('bankPengirim').style.color = "darkgrey";
                document.getElementById('rekeningPengirim').style.color = "darkgrey";
            }
        }

        function refreshListPenerima(index) {
            // console.log('ASDAS');
            // var valueSelectList = document.getElementById('listPenerima').value;
            document.getElementById('bankPengirim').innerHTML = objPenerima.penerimaListArray[index].bank;
            document.getElementById('rekeningPengirim').innerHTML = objPenerima.penerimaListArray[index]
                .nomorRekening;
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

        function getListAllFilter() {
            // var accessHistory = document.getElementById('selDate').value;
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var accessOutlet = document.getElementById('selOutlet').value;
            var urlAll = "{{ url('reimburse/show/history/outlet') }}" + '/' + accessOutlet + '/' + 'between' + '/' +
                startDate + '/' + stopDate;
            $.ajax({
                url: urlAll,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    var imgLaporanPembelian = "{{ url('img/dashboard/laporanPembelian.png') }}";
                    var imgPending = "{{ url('img/icon/pending.png') }}";
                    console.log(obj);

                    for (var i = 0; i < obj.dataHistory.length; i++) {
                        var tanggalActive = false;
                        for (var j = 0; j < obj.dataHistory[i].pattyCash.length; j++) {
                            var statusRevisi = 'Tidak Ada';
                            historyAll += '<tr>';
                            historyAll += '<td>';
                            if (!tanggalActive) {
                                tanggalActive = true;
                                historyAll += obj.dataHistory[i].tanggal;
                            }
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += obj.dataHistory[i].pattyCash[j].item;
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += obj.dataHistory[i].pattyCash[j].qty;
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += obj.dataHistory[i].pattyCash[j].satuan;
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += obj.dataHistory[i].pattyCash[j].total.toLocaleString()
                                .replaceAll(',', '.');
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += obj.dataHistory[i].pattyCash[j].saldo.toLocaleString()
                                .replaceAll(',', '.');
                            historyAll += '</td>';
                            historyAll += '<td ';
                            if (obj.dataHistory[i].pattyCash[j].idRevTotal == '2') {
                                historyAll += 'style="color: red;"';
                                statusRevisi = 'Revisi';
                            } else if (obj.dataHistory[i].pattyCash[j].idRevTotal == '3') {
                                historyAll += 'style="color: green;"';
                                statusRevisi = 'Sudah Revisi';
                            }
                            historyAll += '>';
                            historyAll += statusRevisi;
                            historyAll += '</td>';
                            historyAll += '</tr>';
                        }
                        for (var j = 0; j < obj.dataHistory[i].reimburse.length; j++) {
                            var statusRevisi = '';
                            historyAll += '<tr style="cursor: pointer;" onClick="clickReimburse(';
                            historyAll += obj.dataHistory[i].reimburse[j].id;
                            historyAll += ')">';
                            historyAll += '<td>';
                            historyAll += obj.dataHistory[i].tanggal;
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += 'Reimburse';
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += obj.dataHistory[i].reimburse[j].reimburse.toLocaleString().replaceAll(
                                ',', '.');
                            historyAll += '</td>';
                            historyAll += '<td>';
                            historyAll += obj.dataHistory[i].reimburse[j].saldo.toLocaleString().replaceAll(',',
                                '.');
                            historyAll += '</td>';
                            historyAll += '<td ';
                            if (obj.dataHistory[i].reimburse[j].idRev == '2') {
                                historyAll += 'style="color: red;"';
                                statusRevisi = 'PENDING';
                            } else if (obj.dataHistory[i].reimburse[j].idRev == '3') {
                                historyAll += 'style="color: green;"';
                                statusRevisi = "SUKSES";
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

        function clickReimburse(index) {
            indexReimburse = index;
            $.ajax({
                url: "{{ url('reimburse/show/detail') }}" + '/' + index,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var day = new Date(obj.tanggal);
                    var url = "{{ url('') }}"
                    console.log(obj);
                    var statusReimburse = 'Tidak Ada';
                    var elemntStatus = document.getElementById('statusReimburse');
                    document.getElementById('tanggalReimburse').innerHTML = obj.tanggal;
                    document.getElementById('pesanPenerima').value = obj.pesan;
                    document.getElementById('reimbursePenerima').innerHTML = obj.jumlahTransfer.toLocaleString()
                        .replaceAll(',', '.');

                    if (obj.idRevisi == '3') {
                        document.getElementById('doneTransfer').checked = true;
                        showBuktiTF();
                        document.getElementById('filePathName').href = "{{ url('storage') }}" + '/' + obj.imageBukti;
                        document.getElementById('filePathName').innerHTML = obj.imageBukti.substring(20,25) + '....';
                    } else {
                        document.getElementById('doneTransfer').checked = false;
                        showUploadView();
                    }

                    document.getElementById('namaPenerima').innerHTML = obj.namaPenerima;
                    document.getElementById('bankPenerima').innerHTML = obj.bankPenerima;
                    document.getElementById('rekeningPenerima').innerHTML = obj.rekeningPenerima;
                    if (obj.idRevisi == '2') {
                        statusReimburse = 'PENDING';
                    } else {
                        statusReimburse = 'Sudah Direvisi';
                    }
                    elemntStatus.innerHTML = statusReimburse;

                    transferCheck();
                    setPengirim(obj.idPengirim);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
            $('#exampleModalCenter').modal('toggle');
        }
    </script>
@endsection
