@extends('accountingControl.revisi.index')

@section('revisijs')
    <script>
        var dataAllPattyCash = []; //format : Tanggal, idQtyRev, Qty, idTotalRev, Total, IdPattyCashFill, Satuan
        var clickLastEditPattyCash = 0;
        var checkBoxAllActive = false;

        $(document).ready(function() {
            document.getElementById('pattyCashTabMenu').classList.add("active");
            document.getElementById('subFillContent').innerHTML = "Patty Cash";
            setTable(0);
            showAllRevisionPattyCash();
            showAllRevisionDonePattyCash();
        });


        function setTable(index) {
            if (index == 0) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTablePattyCash">' +
                    '<thead><tr><th scope="col"><input type="checkbox" onClick="checkAll()"></th><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Sesi</th><th scope="col">Item PattyCash</th><th scope="col">' +
                    'Qty Sebelum</th><th scope="col">Qty Revisi</th><th scope="col">Satuan</th><th scope="col">Total Sebelum</th><th scope="col">Total Revisi</th><th scope="col">Pengisi</th>' +
                    '</tr></thead><tbody></tbody></table>';
                showAllRevisionPattyCash();
                document.getElementById('revisiAllButton').style.visibility = "visible";
            } else if (index == 1) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTablePattyCashDone">' +
                    '<thead><tr><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Sesi</th><th scope="col">Item PattyCash</th><th scope="col">' +
                    'Qty</th><th scope="col">Satuan</th><th scope="col">Total</th><th scope="col">Pengisi</th>' +
                    '<th scope="col">Perevisi</th></tr></thead><tbody></tbody></table>';
                showAllRevisionDonePattyCash();
                document.getElementById('revisiAllButton').style.visibility = "hidden";
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

        function revisiAllClick() {
            var elementAll = document.getElementsByName('checkBoxRow');
            for (var i = 0; i < elementAll.length; i++) {
                if (elementAll[i].checked) {
                    var qty = dataAllPattyCash[i][2];
                    var total = dataAllPattyCash[i][4];
                    if (dataAllPattyCash[i][1] == '2') {
                        $.ajax({
                            url: "{{ url('pattyCash/edit/qty/rev/data') }}",
                            type: 'get',
                            data: {
                                qtyRevisi: qty,
                                idPattyCashFill: dataAllPattyCash[i][5],
                                idPerevisi: "{{ session('idPengisi') }}"
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
                    if (dataAllPattyCash[i][3] == '2') {
                        $.ajax({
                            url: "{{ url('pattyCash/edit/total/rev/data') }}",
                            type: 'get',
                            data: {
                                totalRevisi: total,
                                idPattyCashFill: dataAllPattyCash[i][5],
                                idPerevisi: "{{ session('idPengisi') }}"
                            },
                            success: function(response) {},
                            error: function(req, err) {
                                console.log(err);
                                // return 0
                            }
                        });
                    }
                }
            }
            clearRevPattyCash();
        }

        function submitRevPattyCash() {
            var qty = document.getElementById('editQty').value;
            var total = document.getElementById('editTotal').value;
            if (dataAllPattyCash[clickLastEditPattyCash][1] == '2') {
                $.ajax({
                    url: "{{ url('pattyCash/edit/qty/rev/data') }}",
                    type: 'get',
                    data: {
                        qtyRevisi: qty,
                        idPattyCashFill: dataAllPattyCash[clickLastEditPattyCash][5],
                        idPerevisi: "{{ session('idPengisi') }}"
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
            if (dataAllPattyCash[clickLastEditPattyCash][3] == '2') {
                $.ajax({
                    url: "{{ url('pattyCash/edit/total/rev/data') }}",
                    type: 'get',
                    data: {
                        totalRevisi: total,
                        idPattyCashFill: dataAllPattyCash[clickLastEditPattyCash][5],
                        idPerevisi: "{{ session('idPengisi') }}"
                    },
                    success: function(response) {},
                    error: function(req, err) {
                        console.log(err);
                        // return 0
                    }
                });
            }
            $('#editEmployeeModal').modal('hide');
            clearRevPattyCash();
        }

        function clearRevPattyCash() {
            // $('#mainTablePattyCash>tbody').empty();
            showAllRevisionPattyCash();
            showAllRevisionDonePattyCash();
        }

        function refreshTableRevPattyCash(obj) {
            var dataTable = '';
            var countData = 0;
            dataAllPattyCash.length = 0;
            for (var i = 0; i < obj?.itemPattyCash?.length; i++) {
                var dataWrite = true;
                for (var j = 0; j < obj.itemPattyCash[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemPattyCash[i].Item[j].Item.length; k++) {
                        var tempData = [];
                        dataTable += '<tr onClick="checkRow(' + countData + ')">';

                        dataTable += '<td>';
                        dataTable += '<input type="checkbox" value="" name="checkBoxRow">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        if (dataWrite) {
                            dataTable += obj.itemPattyCash[i].Tanggal.split("-").reverse().join("/");
                            dataWrite = false;
                        }
                        tempData.push(obj.itemPattyCash[i].Tanggal.split("-").reverse().join("/"));
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Outlet;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].idSesi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].pattyCash;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].qtyBefore;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemPattyCash[i].Item[j].Item[k].idQtyRev == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemPattyCash[i].Item[j].Item[k].idQtyRev == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].qty;
                        tempData.push(obj.itemPattyCash[i].Item[j].Item[k].idQtyRev);
                        tempData.push(obj.itemPattyCash[i].Item[j].Item[k].qty);
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].totalBefore;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemPattyCash[i].Item[j].Item[k].idTotalRev == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemPattyCash[i].Item[j].Item[k].idTotalRev == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].total.toLocaleString();
                        tempData.push(obj.itemPattyCash[i].Item[j].Item[k].idTotalRev);
                        tempData.push(obj.itemPattyCash[i].Item[j].Item[k].total);
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        // dataTable +=
                        //     '<td><a onclick="showEdit()" class="delete" data-toggle="modal" style="cursor: pointer"><i class="material-icons" data-toggle="tooltip" title="Accept" id="a' +
                        //     (countData - 1) + '">&#xE254;</i></a></td>';
                        dataTable += '</tr>';
                        tempData.push(obj.itemPattyCash[i].Item[j].Item[k].idPattyCashFill);
                        tempData.push(obj.itemPattyCash[i].Item[j].Item[k].satuan);
                        dataAllPattyCash.push(tempData);
                        countData++;
                        // idPattyCashFill.push(obj.itemPattyCash[i].Item[j].Item[k].idPattyCashFill);
                    }
                }
            }
            document.getElementById("toDoCount").innerHTML = countData;
            // console.log(dataTable);
            // console.log(dataAllPattyCash);
            $('#mainTablePattyCash>tbody').empty().append(dataTable);
        }

        function checkRow(index) {
            var checkBoxElement = document.getElementsByName('checkBoxRow')[index];

            if (checkBoxElement.checked) {
                checkBoxElement.checked = false;
            } else {
                checkBoxElement.checked = true;
            }
        }

        function showEdit() {
            $('#editEmployeeModal').modal('show');
        }

        function refreshTableRevPattyCashDone(obj) {
            var dataTable = '';
            var countData = 0;
            for (var i = 0; i < obj?.itemPattyCash?.length; i++) {
                var dataWrite = true;
                for (var j = 0; j < obj.itemPattyCash[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemPattyCash[i].Item[j].Item.length; k++) {
                        countData++;
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        if (dataWrite) {
                            dataTable += obj.itemPattyCash[i].Tanggal.split("-").reverse().join("/");
                            dataWrite = false;
                        }
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Outlet;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].idSesi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].pattyCash;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemPattyCash[i].Item[j].Item[k].idQtyRev == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemPattyCash[i].Item[j].Item[k].idQtyRev == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].qty;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].satuan;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemPattyCash[i].Item[j].Item[k].idTotalRev == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemPattyCash[i].Item[j].Item[k].idTotalRev == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].total.toLocaleString();
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemPattyCash[i].Item[j].Item[k].namaPerevisi;
                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }
                }
            }
            document.getElementById("doneCount").innerHTML = countData;
            // console.log(dataTable);
            $('#mainTablePattyCashDone>tbody').empty().append(dataTable);
        }

        function showAllRevisionPattyCash() {
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var urlDate = "{{ url('pattyCash/show/revision/all') }}" + '/' + startDate;
            urlDate += '/' + stopDate;

            $.ajax({
                url: urlDate,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    refreshTableRevPattyCash(obj);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function showAllRevisionDonePattyCash() {
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var urlDate = "{{ url('pattyCash/show/revision/done') }}" + '/' + startDate;
            urlDate += '/' + stopDate;

            $.ajax({
                url: urlDate,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    refreshTableRevPattyCashDone(obj);
                    console.log(obj);
                    // setRevPattyCashDone(depthRevisiPattyCashDone, index1RevisiPattyCashDone, index2RevisiPattyCashDone,
                    //     index3RevisiPattyCashDone);
                    // $('#mainTable>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
