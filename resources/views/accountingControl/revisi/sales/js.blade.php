@extends('accountingControl.revisi.index')

@section('revisijs')
    <script>
        var dataAllSales = []; //format : Tanggal, idCuRev, CU, idTotalRev, Total, IdSalesFill
        var clickLastEditSales = 0;
        var checkBoxAllActive = false;
        $(document).ready(function() {
            document.getElementById('salesTabMenu').classList.add("active");
            document.getElementById('subFillContent').innerHTML = "Sales Harian";
            setTable(0);
            showAllRevisionSales();
            showAllRevisionDoneSales();
        });
        function setDate(){
            clearRevSales();
        }
        function revisiAllClick() {
            var elementAll = document.getElementsByName('checkBoxRow');
            for (var i = 0; i < elementAll.length; i++) {
                if (elementAll[i].checked) {
                    // console.log(dataAllSo[i][2]);
                    if (dataAllSales[i][1] == '2') {
                        $.ajax({
                            url: "{{ url('salesHarian/edit/cu/rev/data') }}",
                            type: 'get',
                            data: {
                                cuRevisi: dataAllSales[i][2],
                                idSalesFill: dataAllSales[i][5],
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
                    if (dataAllSales[i][3] == '2') {
                        $.ajax({
                            url: "{{ url('salesHarian/edit/total/rev/data') }}",
                            type: 'get',
                            data: {
                                totalRevisi: dataAllSales[i][4],
                                idSalesFill: dataAllSales[i][5],
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
            clearRevSales();
        }

        function setTable(index) {
            if (index == 0) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTableSales">' +
                    '<thead><tr><th scope="col"><input type="checkbox" onClick="checkAll()"></th><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Sesi</th><th scope="col">Item Sales</th>' +
                    '<th scope="col">Total Sebelum</th><th scope="col">Total Revisi</th><th scope="col">Pengisi</th>' +
                    '</tr></thead><tbody></tbody></table>';
                showAllRevisionSales();
                document.getElementById('revisiAllButton').style.visibility = "visible";
            } else if (index == 1) {
                document.getElementById('setTable').innerHTML =
                    '<table class="table table-striped" id="mainTableSalesDone">' +
                    '<thead><tr><th scope="col">Tanggal</th><th scope="col">' +
                    'Outlet</th><th scope="col">Sesi</th><th scope="col">Item Sales</th>' +
                    '<th scope="col">Total</th><th scope="col">Pengisi</th>' +
                    '<th scope="col">Perevisi</th></tr></thead><tbody></tbody></table>';
                showAllRevisionDoneSales();
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

        function submitRevSales() {
            var cu = document.getElementById('editCU').value;
            var total = document.getElementById('editTotal').value;
            if (dataAllSales[clickLastEditSales][1] == '2') {
                $.ajax({
                    url: "{{ url('salesHarian/edit/cu/rev/data') }}",
                    type: 'get',
                    data: {
                        cuRevisi: cu,
                        idSalesFill: dataAllSales[clickLastEditSales][5],
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
            if (dataAllSales[clickLastEditSales][3] == '2') {
                $.ajax({
                    url: "{{ url('salesHarian/edit/total/rev/data') }}",
                    type: 'get',
                    data: {
                        totalRevisi: total,
                        idSalesFill: dataAllSales[clickLastEditSales][5],
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
            clearRevSales();
        }

        function clearRevSales() {
            // $('#mainTableSales>tbody').empty();
            showAllRevisionSales();
            showAllRevisionDoneSales();
        }

        function refreshTableRevSales(obj) {
            var dataTable = '';
            var countData = 0;
            dataAllSales.length = 0;
            for (var i = 0; i < obj?.itemSales?.length; i++) {
                var dataWrite = true;
                for (var j = 0; j < obj.itemSales[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemSales[i].Item[j].Item.length; k++) {
                        var tempData = [];
                        dataTable += '<tr onClick="checkRow(' + countData + ')">';

                        dataTable += '<td>';
                        dataTable += '<input type="checkbox" value="" name="checkBoxRow">';
                        dataTable += '</td>';

                        dataTable += '<td>';

                        if (dataWrite) {
                            dataTable += obj.itemSales[i].Tanggal.split("-").reverse().join("/");
                            dataWrite = false;
                        }

                        tempData.push(obj.itemSales[i].Tanggal.split("-").reverse().join("/"));
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Outlet;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Item[k].idSesi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Item[k].sales;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Item[k].totalSblm.toLocaleString();
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemSales[i].Item[j].Item[k].totalQty.toLocaleString();
                        tempData.push(obj.itemSales[i].Item[j].Item[k].idTotalRev);
                        tempData.push(obj.itemSales[i].Item[j].Item[k].totalQty);
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        dataTable += '</tr>';
                        tempData.push(obj.itemSales[i].Item[j].Item[k].idSalesFill);
                        dataAllSales.push(tempData);
                        // idSalesFill.push(obj.itemSales[i].Item[j].Item[k].idSalesFill);
                        countData++;
                    }
                }
            }
            document.getElementById("toDoCount").innerHTML = countData;
            // console.log(dataTable);
            $('#mainTableSales>tbody').empty().append(dataTable);
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

        function refreshTableRevSalesDone(obj) {
            var dataTable = '';
            var countData = 0;
            for (var i = 0; i < obj?.itemSales?.length; i++) {
                var dataWrite = true;
                for (var j = 0; j < obj.itemSales[i].Item.length; j++) {
                    for (var k = 0; k < obj.itemSales[i].Item[j].Item.length; k++) {
                        countData++;
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        if (dataWrite) {
                            dataTable += obj.itemSales[i].Tanggal.split("-").reverse().join("/");
                            dataWrite = false;
                        }
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Outlet;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Item[k].idSesi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Item[k].sales;
                        dataTable += '</td>';
                        dataTable += '<td ';
                        if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '2') {
                            dataTable += 'style="color:tomato;" ';
                        } else if (obj.itemSales[i].Item[j].Item[k].idTotalRev == '3') {
                            dataTable += 'style="color:rgb(30, 206, 9);" ';
                        }
                        dataTable += ' >';
                        dataTable += obj.itemSales[i].Item[j].Item[k].totalQty.toLocaleString();
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Item[k].namaPengisi;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSales[i].Item[j].Item[k].namaPerevisi;
                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }
                }
            }
            document.getElementById("doneCount").innerHTML = countData;
            // console.log(dataTable);
            $('#mainTableSalesDone>tbody').empty().append(dataTable);
        }

        function showAllRevisionSales() {
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var urlDate = "{{ url('salesHarian/show/revision/all') }}" + '/' + startDate;
            urlDate += '/' + stopDate;

            $.ajax({
                url: urlDate,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    refreshTableRevSales(obj);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function showAllRevisionDoneSales() {
            var startDate = document.getElementById('startDate').value;
            var stopDate = document.getElementById('stopDate').value;
            var urlDate = "{{ url('salesHarian/show/revision/done') }}" + '/' + startDate;
            urlDate += '/' + stopDate;

            $.ajax({
                url: urlDate,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    refreshTableRevSalesDone(obj);
                    console.log(obj);
                    // setRevSalesDone(depthRevisiSalesDone, index1RevisiSalesDone, index2RevisiSalesDone,
                    //     index3RevisiSalesDone);
                    // $('#mainTable>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
