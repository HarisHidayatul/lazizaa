@extends('accountingControl.revisi.index')

@section('revisijs')
    <script>
        var dataAllSo = []; //format : Tanggal, idRev, qty, Item, Satuan, IdSoFill
        var clickLastEditSo = 0;
        var checkBoxAllActive = false;
        $(document).on("click", "[id^=a]", function(event, ui) {
            //function for edit (when clicked)
            var idClickEdit = this.id.substring(1);
            clickLastEditSo = idClickEdit;
            // console.log(dataAllSo);
            document.getElementById('editTanggal').innerHTML = dataAllSo[idClickEdit][0];
            document.getElementById('editQty').value = dataAllSo[idClickEdit][2];
            document.getElementById('editItem').innerHTML = dataAllSo[idClickEdit][3];
            document.getElementById('satuan').innerHTML = dataAllSo[idClickEdit][4];
        })

        $(document).ready(function() {
            document.getElementById('soTabMenu').classList.add("active");
            document.getElementById('subFillContent').innerHTML = "SO Harian"
            setTable(0);
            showAllRevisionSo();
            showAllRevisionDoneSo();
        });

        function revisiAllClick() {
            var elementAll = document.getElementsByName('checkBoxRow');
            for (var i = 0; i < elementAll.length; i++) {
                if (elementAll[i].checked) {
                    // console.log(dataAllSo[i][2]);
                    $.ajax({
                        url: "{{ url('soHarian/edit/qty/rev/data') }}",
                        type: 'get',
                        data: {
                            qty: dataAllSo[i][2],
                            idPerevisi: "{{ session('idPengisi') }}",
                            idSoFill: dataAllSo[i][5],
                        },
                        success: function(response) {
                            // console.log(response);
                        },
                        error: function(req, err) {
                            console.log(err);
                            // return 0
                        }
                    });
                }
            }
            clearRevSo();
        }

        function setTable(index) {
            if (index == 0) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTableSo">' +
                    '<thead><tr><th scope="col"><input type="checkbox" onClick="checkAll()"></th><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Sesi</th><th scope="col">Item SO</th><th scope="col">' +
                    'Nilai Sebelum</th><th scope="col">Nilai Sesudah</th><th scope="col">Satuan</th><th scope="col">Pengisi</th>' +
                    '</tr></thead><tbody></tbody></table>';
                document.getElementById('revisiAllButton').style.visibility = "visible";
                showAllRevisionSo();
            } else if (index == 1) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTableSoDone">' +
                    '<thead><tr><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Sesi</th><th scope="col">Item SO</th><th scope="col">' +
                    'Nilai</th><th scope="col">Satuan</th><th scope="col">Pengisi</th>' +
                    '<th scope="col">Perevisi</th></tr></thead><tbody></tbody></table>';
                document.getElementById('revisiAllButton').style.visibility = "hidden";
                showAllRevisionDoneSo();
            }

        }

        function checkAll() {
            var elementAll = document.getElementsByName('checkBoxRow');
            for (var i = 0; i < elementAll.length; i++) {
                if (checkBoxAllActive) {
                    elementAll[i].checked = false;
                } else {
                    elementAll[i].checked = true;
                }
            }
            if (checkBoxAllActive) {
                checkBoxAllActive = false;
            } else {
                checkBoxAllActive = true;
            }
        }

        function submitRevSo() {

            var qty = document.getElementById('editQty').value;
            if (dataAllSo[clickLastEditSo][1] == '2') {
                console.log(dataAllSo);
                $.ajax({
                    url: "{{ url('soHarian/edit/qty/rev/data') }}",
                    type: 'get',
                    data: {
                        qty: qty,
                        idPerevisi: "{{ session('idPengisi') }}",
                        idSoFill: dataAllSo[clickLastEditSo][5],
                    },
                    success: function(response) {
                        // console.log(response);
                        clearRevSo();
                    },
                    error: function(req, err) {
                        console.log(err);
                        // return 0
                    }
                });
            }
        }

        function clearRevSo() {
            // $('#mainTableSo>tbody').empty();
            showAllRevisionSo();
            showAllRevisionDoneSo();
        }

        function refreshTableRevSo(obj) {
            var dataTable = '';
            var countData = 0;
            dataAllSo.length = 0;
            for (var i = 0; i < obj?.itemSo?.length; i++) {
                var dataWrite = true;
                for (var j = 0; j < obj.itemSo[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemSo[i].Item[j].Item.length; k++) {
                        var tempData = [];
                        dataTable += '<tr onClick="checkRow(' + countData + ')">';

                        dataTable += '<td>';
                        dataTable += '<input type="checkbox" value="" name="checkBoxRow">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        if (dataWrite) {
                            dataTable += obj.itemSo[i].Tanggal.split("-").reverse().join("/");
                            dataWrite = false;
                        }
                        tempData.push(obj.itemSo[i].Tanggal.split("-").reverse().join("/"));
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Outlet;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].idSesi;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].Item;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].qtyAwal;
                        dataTable += '</td>';

                        dataTable += '<td ';
                        if (obj.itemSo[i].Item[j].Item[k].idRev == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemSo[i].Item[j].Item[k].idRev == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemSo[i].Item[j].Item[k].qty;

                        tempData.push(obj.itemSo[i].Item[j].Item[k].idRev);
                        tempData.push(obj.itemSo[i].Item[j].Item[k].qty);
                        tempData.push(obj.itemSo[i].Item[j].Item[k].Item);
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        // dataTable +=
                        //     '<td><a  onclick="showEdit()" class="delete" data-toggle="modal" style="cursor: pointer"><i class="material-icons" data-toggle="tooltip" title="Accept" id="a' +
                        //     (countData - 1) + '">&#xE254;</i></a></td>';
                        dataTable += '</tr>';
                        tempData.push(obj.itemSo[i].Item[j].Item[k].satuan);
                        tempData.push(obj.itemSo[i].Item[j].Item[k].idSoFill);
                        dataAllSo.push(tempData);
                        // idSoFill.push(obj.itemSo[i].Item[j].Item[k].idSoFill);
                        countData++;
                    }
                }
            }
            document.getElementById("toDoCount").innerHTML = countData;
            // console.log(dataTable);
            $('#mainTableSo>tbody').empty().append(dataTable);
        }

        function checkRow(index) {
            var checkBoxElement = document.getElementsByName('checkBoxRow')[index];
            if(checkBoxElement.checked) {
                checkBoxElement.checked = false;
            } else {
                checkBoxElement.checked = true;
            }
        }

        function showEdit() {
            $('#editEmployeeModal').modal('show');
        }

        function refreshTableRevSoDone(obj) {
            var dataTable = '';
            var countData = 0;
            for (var i = 0; i < obj?.itemSo?.length; i++) {
                for (var j = 0; j < obj.itemSo[i].Item.length; j++) {
                    var dataWrite = true;
                    for (var k = 0; k < obj.itemSo[i].Item[j].Item.length; k++) {
                        countData++;
                        dataTable += '<tr>';
                        // dataTable += '<td>';
                        // dataTable += '<input type="checkbox" value="" name="checkBoxRow">';
                        // dataTable += '</td>';
                        dataTable += '<td>';
                        if (dataWrite) {
                            dataTable += obj.itemSo[i].Tanggal.split("-").reverse().join("/");
                            dataWrite = false;
                        }
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Outlet;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].idSesi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].Item;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemSo[i].Item[j].Item[k].idRev == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemSo[i].Item[j].Item[k].idRev == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemSo[i].Item[j].Item[k].qty;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSo[i].Item[j].Item[k].namaPerevisi;
                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }
                }
            }
            document.getElementById("doneCount").innerHTML = countData;
            // console.log(dataTable);
            $('#mainTableSoDone>tbody').empty().append(dataTable);
        }

        function showAllRevisionSo() {
            $.ajax({
                url: "{{ url('soHarian/show/revision/all') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    refreshTableRevSo(obj);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function showAllRevisionDoneSo() {
            $.ajax({
                url: "{{ url('soHarian/show/revision/done') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    refreshTableRevSoDone(obj);
                    console.log(obj);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
