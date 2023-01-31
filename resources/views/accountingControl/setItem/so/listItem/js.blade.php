@extends('accountingControl.setItem.so.index')

@section('subSetItemJS')
    <script>
        var listItemSoArray = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "List Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "SO Harian / List Item";
        })

        $(document).ready(function() {
            getListAllItem();
            getAllSatuan();
        })

        function sendAddItem() {
            $.ajax({
                url: "{{ url('itemSO/store') }}",
                type: 'get',
                data: {
                    item: document.getElementById('tambahNamaItem').value,
                    idSatuan: $('#showSatuanAdd').val(),
                    icon: document.getElementById('locationItem').value
                },
                success: function(response) {
                    getListAllItem();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getAllSatuan() {
            $.ajax({
                url: "{{ url('show/satuan') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataDropdown = '';
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.dataItem[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.dataItem[i].Satuan;
                        dataDropdown += '</option>';
                    }
                    $('#showSatuanAdd').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getListAllItem() {
            $.ajax({
                url: "{{ url('itemSO/showAll') }}",
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var item = '';
                    var dataTable = '';
                    var satuanAll = [];
                    var dataDropdown = '';
                    listItemSoArray.length = 0;
                    for (var i = 0; i < obj.satuan.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.satuan[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.satuan[i].satuan;
                        dataDropdown += '</option>';

                        satuanAll.push([obj.satuan[i].id, obj.satuan[i].satuan]);
                    }
                    console.log(satuanAll);
                    for (var i = 0; i < obj.itemSO.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.itemSO[i].item;
                        dataTable += '" name="inputEdit">';

                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<div class="form-group">';
                        dataTable += '<select class="form-control" name="dropDownEdit">';
                        dataTable += dataDropdown;
                        dataTable += '</select>';
                        dataTable += '</div>';
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.itemSO[i].icon;
                        dataTable += '" name="locationEdit">';
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<img src="' + "{{ url('img/soImage') }}" + '/' + obj.itemSO[i].icon +
                            '" alt="">';
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editItem(' + i +
                            ');">Edit</button>';

                        listItemSoArray.push(obj.itemSO[i].id);

                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);

                    var elementDropDown = document.getElementsByName('dropDownEdit');
                    for (var i = 0; i < obj.itemSO.length; i++) {
                        elementDropDown[i].value = obj.itemSO[i].idSatuan;
                    }

                    resetInput();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function editItem(index){
            var dropdownEdit = document.getElementsByName('dropDownEdit')[index].value;
            var itemEdit = document.getElementsByName('inputEdit')[index].value;
            var iconEdit = document.getElementsByName('locationEdit')[index].value;
            var idItem = listItemSoArray[index]
            $.ajax({
                url: "{{ url('itemSO/update') }}" + '/' + idItem,
                type: 'get',
                data: {
                    item: itemEdit,
                    idSatuan: dropdownEdit,
                    icon: iconEdit
                },
                success: function(response) {
                    getListAllItem();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function resetInput(){
            document.getElementById('locationItem').innerHTML = '';
            document.getElementById('tambahNamaItem').innerHTML = '';
        }
    </script>
@endsection
