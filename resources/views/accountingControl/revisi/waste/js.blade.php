@extends('accountingControl.revisi.index')

@section('revisijs')
    <script>
        var dataAllWaste = []; //format : Tanggal, idQty, CU, idTotalRev, Total, IdWasteFill
        var clickLastEditWaste = 0;
        var checkBoxAllActive = false;

        $(document).ready(function() {
            document.getElementById('wasteTabMenu').classList.add("active");
            document.getElementById('subFillContent').innerHTML = "Waste";
            setTable(0);
            showAllRevisionWaste();
            showAllRevisionDoneWaste();
        });

        $(document).on("click", "[id^=a]", function(event, ui) {
            //function for edit (when clicked)
            var idClickEdit = this.id.substring(1);
            clickLastEditWaste = idClickEdit;
            // console.log(dataAllWaste);
            document.getElementById('editTanggal').innerHTML = dataAllWaste[idClickEdit][0];
            document.getElementById('editQty').value = dataAllWaste[idClickEdit][2];
        })

        function setTable(index) {
            if (index == 0) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTableWaste">' +
                    '<thead><tr><th scope="col"><input type="checkbox" onClick="checkAll()"></th><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Sesi</th><th scope="col">Jenis</th><th scope="col">Item Waste</th><th scope="col">' +
                    'Quantity Sebelum</th><th scope="col">Quantity Revisi</th><th scope="col">Satuan</th><th scope="col">Pengisi</th>' +
                    '</tr></thead><tbody></tbody></table>';
                showAllRevisionWaste();
            } else if (index == 1) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTableWasteDone">' +
                    '<thead><tr><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Sesi</th><th scope="col">Jenis</th><th scope="col">Item Waste</th><th scope="col">' +
                    'Quantity</th><th scope="col">Satuan</th><th scope="col">Pengisi</th>' +
                    '<th scope="col">Perevisi</th></tr></thead><tbody></tbody></table>';
                showAllRevisionDoneWaste();
            }
        }

        function revisiAllClick() {
            console.log(dataAllWaste);
            var elementAll = document.getElementsByName('checkBoxRow');
            for (var i = 0; i < elementAll.length; i++) {
                if (elementAll[i].checked) {
                    var qty = dataAllWaste[i][2];
                    if (dataAllWaste[i][1] == '2') {
                        $.ajax({
                            url: "{{ url('waste/edit/cu/rev/data') }}",
                            type: 'get',
                            data: {
                                qtyRevisi: qty,
                                idWasteFill: dataAllWaste[i][5],
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
                }
            }
            clearRevWaste();
        }

        function submitRevWaste() {
            var qty = document.getElementById('editQty').value;
            if (dataAllWaste[clickLastEditWaste][1] == '2') {
                $.ajax({
                    url: "{{ url('waste/edit/cu/rev/data') }}",
                    type: 'get',
                    data: {
                        qtyRevisi: qty,
                        idWasteFill: dataAllWaste[clickLastEditWaste][5],
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
            $('#editEmployeeModal').modal('hide');
            clearRevWaste();
        }

        function clearRevWaste() {
            // $('#mainTableWaste>tbody').empty();
            showAllRevisionWaste();
            showAllRevisionDoneWaste();
        }

        function refreshTableRevWaste(obj) {
            var dataTable = '';
            var countData = 0;
            dataAllWaste.length = 0;
            for (var i = 0; i < obj?.itemWaste?.length; i++) {
                var dataWrite = true;
                for (var j = 0; j < obj.itemWaste[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemWaste[i].Item[j].Item.length; k++) {
                        var tempData = [];

                        dataTable += '<tr onClick="checkRow(' + countData + ')">';

                        dataTable += '<td>';
                        dataTable += '<input type="checkbox" value="" name="checkBoxRow">';
                        dataTable += '</td>';


                        dataTable += '<td>';
                        if (dataWrite) {
                            dataTable += obj.itemWaste[i].Tanggal.split("-").reverse().join("/");
                            dataWrite = false;
                        }
                        tempData.push(obj.itemWaste[i].Tanggal.split("-").reverse().join("/"));
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Outlet;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].idSesi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].jenis;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].waste;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].quantitySebelum;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemWaste[i].Item[j].Item[k].idQty == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemWaste[i].Item[j].Item[k].idQty == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].quantity;
                        tempData.push(obj.itemWaste[i].Item[j].Item[k].idQty);
                        tempData.push(obj.itemWaste[i].Item[j].Item[k].quantity);
                        dataTable += '</td>';
                        tempData.push('0');
                        tempData.push('0');
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        // dataTable +=
                        //     '<td><a onclick="showEdit()" class="delete" data-toggle="modal" style="cursor: pointer"><i class="material-icons" data-toggle="tooltip" title="Accept" id="a' +
                        //     (countData - 1) + '">&#xE254;</i></a></td>';
                        dataTable += '</tr>';
                        tempData.push(obj.itemWaste[i].Item[j].Item[k].idWasteFill);
                        dataAllWaste.push(tempData);
                        countData++;
                        // idWasteFill.push(obj.itemWaste[i].Item[j].Item[k].idWasteFill);
                    }
                }
            }
            document.getElementById("toDoCount").innerHTML = countData;
            // console.log(dataTable);
            $('#mainTableWaste>tbody').empty().append(dataTable);
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

        function refreshTableRevWasteDone(obj) {
            var dataTable = '';
            var countData = 0;
            for (var i = 0; i < obj?.itemWaste?.length; i++) {
                var dataWrite = true;
                for (var j = 0; j < obj.itemWaste[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemWaste[i].Item[j].Item.length; k++) {
                        var tempData = [];
                        countData++;
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        if (dataWrite) {
                            dataTable += obj.itemWaste[i].Tanggal.split("-").reverse().join("/");
                            dataWrite = false;
                        }
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Outlet;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].idSesi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].jenis;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].waste;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemWaste[i].Item[j].Item[k].idQty == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemWaste[i].Item[j].Item[k].idQty == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].quantity;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemWaste[i].Item[j].Item[k].namaPerevisi;
                        dataTable += '</td>';
                        dataTable += '</tr>';
                        // idWasteFill.push(obj.itemWaste[i].Item[j].Item[k].idWasteFill);
                    }
                }
            }
            document.getElementById("doneCount").innerHTML = countData;
            // console.log(dataTable);
            $('#mainTableWasteDone>tbody').empty().append(dataTable);
        }

        function showAllRevisionWaste() {
            $.ajax({
                url: "{{ url('waste/show/revision/all') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    refreshTableRevWaste(obj);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function showAllRevisionDoneWaste() {
            $.ajax({
                url: "{{ url('waste/show/revision/done') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    refreshTableRevWasteDone(obj);
                    // console.log(obj);
                    // setRevWasteDone(depthRevisiWasteDone, index1RevisiWasteDone, index2RevisiWasteDone,
                    //     index3RevisiWasteDone);
                    // $('#mainTable>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
