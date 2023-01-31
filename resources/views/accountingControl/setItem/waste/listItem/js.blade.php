@extends('accountingControl.setItem.waste.index')

@section('subSetItemJS')
    <script>
        var listPattyCashID = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "List Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Waste Harian / List Item";

            getAllSatuan();
            getListAllItem();
            refreshTable();
        })

        function editItem(index){
            var item = document.getElementsByName('inputEdit')[index].value;
            var idSatuan = document.getElementsByName('dropDownSatuanEdit')[index].value;
            var idJenisBahan = document.getElementsByName('dropDownJenisEdit')[index].value;
            $.ajax({
                url: "{{ url('waste/items/update') }}" + '/' + listPattyCashID[index],
                type: 'get',
                data: {
                    item: item,
                    idSatuan: idSatuan,
                    idJenisBahan: idJenisBahan
                },
                success: function(response) {
                    refreshTable();
                    document.getElementById('tambahNamaItem').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendAddItem() {
            var item = document.getElementById('tambahNamaItem').value;
            var idSatuan = document.getElementById('showSatuanAdd').value;
            var idJenisBahan = document.getElementById('showJenisAdd').value;
            $.ajax({
                url: "{{ url('waste/items/store') }}",
                type: 'get',
                data: {
                    item: item,
                    idSatuan: idSatuan,
                    idJenisBahan: idJenisBahan
                },
                success: function(response) {
                    refreshTable();
                    document.getElementById('tambahNamaItem').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function refreshTable() {
            $.ajax({
                url: "{{ url('waste/items/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var jenisDropDown = '';
                    var satuanDropDown = '';
                    var dataTable = '';
                    listPattyCashID.length = 0;

                    for (var i = 0; i < obj.listWaste.length; i++) {
                        jenisDropDown += '<option value=';
                        jenisDropDown += obj.listWaste[i].idJenis;
                        jenisDropDown += '>';
                        jenisDropDown += obj.listWaste[i].jenisBahan;
                        jenisDropDown += '</option>';
                    }
                    for (var i = 0; i < obj.satuan.length; i++) {
                        satuanDropDown += '<option value=';
                        satuanDropDown += obj.satuan[i].id;
                        satuanDropDown += '>';
                        satuanDropDown += obj.satuan[i].satuan;
                        satuanDropDown += '</option>';
                    }

                    var countLoop = 0;
                    for (var i = 0; i < obj.listWaste.length; i++) {
                        for (var j = 0; j < obj.listWaste[i].waste.length; j++) {
                            dataTable += '<tr>';
                            dataTable += '<td>';
                            dataTable += obj.listWaste[i].waste[j].id;
                            listPattyCashID.push(obj.listWaste[i].waste[j].id);
                            dataTable += '</td>';

                            dataTable += '<td>';
                            dataTable += '<input type="text" class="form-control" value="';
                            dataTable += obj.listWaste[i].waste[j].Item;
                            dataTable += '" name="inputEdit">';
                            dataTable += '</td>';

                            dataTable += '<td>';
                            dataTable += '<div class="form-group">';
                            dataTable += '<select class="form-control" name="dropDownSatuanEdit">';
                            dataTable += satuanDropDown;
                            dataTable += '</select>';
                            dataTable += '</div>';
                            dataTable += '</td>';

                            dataTable += '<td>';
                            dataTable += '<div class="form-group">';
                            dataTable += '<select class="form-control" name="dropDownJenisEdit">';
                            dataTable += jenisDropDown;
                            dataTable += '</select>';
                            dataTable += '</div>';
                            dataTable += '</td>';
                            dataTable += '<td>';
                            dataTable += '<button type="button" class="btn btn-secondary" onClick="editItem(' +
                                countLoop +
                                ');">Edit</button>';
                            dataTable += '</td>';
                            dataTable += '</tr>';
                            countLoop++;
                        }
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);
                    var satuanElement = document.getElementsByName('dropDownSatuanEdit');
                    var jenisElement = document.getElementsByName('dropDownJenisEdit');
                    var indexLoop = 0;
                    for (var i = 0; i < obj.listWaste.length; i++) {
                        for (var j = 0; j < obj.listWaste[i].waste.length; j++) {
                            satuanElement[indexLoop].value = obj.listWaste[i].waste[j].idSatuan;
                            jenisElement[indexLoop].value = obj.listWaste[i].idJenis;
                            indexLoop++;
                        }
                    }
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getListAllItem() {
            $.ajax({
                url: "{{ url('waste/items/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataDropdown = '';
                    for (var i = 0; i < obj.listWaste.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.listWaste[i].idJenis;
                        dataDropdown += '>';
                        dataDropdown += obj.listWaste[i].jenisBahan;
                        dataDropdown += '</option>';
                    }
                    $('#showJenisAdd').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getAllSatuan() {
            $.ajax({
                url: "{{ url('show/satuan') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    // console.log(obj);
                    var dataDropdown = '';
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.dataItem[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.dataItem[i].Satuan;
                        dataDropdown += '</option>';
                    }
                    // $('#showSatuanEdit').empty().append(dataDropdown);
                    $('#showSatuanAdd').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
