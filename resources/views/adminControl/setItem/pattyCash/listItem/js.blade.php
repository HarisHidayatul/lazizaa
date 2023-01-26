@extends('adminControl.setItem.pattyCash.index')

@section('subSetItemJS')
    <script>
        idItemPattyCash = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "List Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Patty Cash Harian / List Item";
            getListAllItem();
            getAllSatuan();
            // getListAllItem();
        })

        function sendAddItem(){
            $.ajax({
                url: "{{ url('pattyCash/items/store') }}",
                type: 'get',
                data: {
                    item: document.getElementById('addItemSalesOnType').value,
                    idSatuan: $('#showSatuanAdd').val(),
                },
                success: function(response) {
                    getListAllItem();
                    document.getElementById('addItemSalesOnType').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getListAllItem() {
            $.ajax({
                url: "{{ url('pattyCash/items/show') }}",
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';

                    var satuanAll = [];
                    var dataDropdown = '';

                    idItemPattyCash.length = 0;
                    for (var i = 0; i < obj.satuan.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.satuan[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.satuan[i].satuan;
                        dataDropdown += '</option>';

                        satuanAll.push([obj.satuan[i].id, obj.satuan[i].satuan]);
                    }
                    for (var i = 0; i < obj.listPattyCash.length; i++) {
                        // item += obj.listPattyCash[i].Item + ' ' + obj.listPattyCash[i].Satuan + ' | ';
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.listPattyCash[i].id;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.listPattyCash[i].Item;
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
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editItem(' + i +
                            ');">Edit</button>';
                        dataTable += '</td>';
                        dataTable += '</tr>';

                        idItemPattyCash.push(obj.listPattyCash[i].id);
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);

                    var elementDropDown = document.getElementsByName('dropDownEdit');
                    for (var i = 0; i < obj.listPattyCash.length; i++) {
                        elementDropDown[i].value = obj.listPattyCash[i].idSatuan;
                    }
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function editItem(index){
            var idPattyCash = idItemPattyCash[index];
            var item = document.getElementsByName('inputEdit')[index].value;
            var idSatuan = document.getElementsByName('dropDownEdit')[index].value;
            $.ajax({
                url: "{{ url('pattyCash/update/item') }}" + "/" + idPattyCash,
                type: 'get',
                data: {
                    Item: item,
                    idSatuan: idSatuan
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
    </script>
@endsection
