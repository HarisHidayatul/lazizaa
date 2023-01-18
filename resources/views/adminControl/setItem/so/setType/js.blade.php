@extends('adminControl.setItem.so.index')

@section('subSetItemJS')
    <script>
        $("#selType").select2(); //css untuk dropdown
        $("#selItemOnType").select2();

        var idEdit = [];
        var idItemEdit = [];

        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Set Type";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "SO Harian / Set Type";
        })

        $(document).ready(function() {
            getTypeListTable();
            getListAllType();
            getListAllItem();
        })

        function getListAllItem() {
            $.ajax({
                url: "{{ url('itemSO/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.itemSO.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.itemSO[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.itemSO[i].item;
                        dataDropdown += '</option>';
                    }
                    $('#selItemOnType').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function sendItemOnType() {
            var idTypes = $('#selType').val();
            var idItems = $('#selItemOnType').val();
            $.ajax({
                url: "{{ url('listType/soHarian/store/item') }}",
                type: 'get',
                data: {
                    idType: idTypes,
                    idItem: idItems,
                },
                success: function(response) {
                    getTypeItem(idTypes);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendAddType() {
            $.ajax({
                url: "{{ url('listType/soHarian/store') }}",
                type: 'get',
                data: {
                    NamaType: document.getElementById('tambahType').value,
                },
                success: function(response) {
                    getTypeListTable();
                    document.getElementById('tambahType').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getListAllType() {
            $.ajax({
                url: "{{ url('listType/soHarian/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.listType.length; i++) {
                        var listType = obj.listType[i];
                        dataDropdown += '<option value=';
                        dataDropdown += listType.id;
                        dataDropdown += '>';
                        dataDropdown += listType.type;
                        dataDropdown += '</option>';

                    }
                    $('#selType').empty().append(dataDropdown);

                    // $('#showAllType').empty().append(dataDropdown);

                    // document.getElementById("showType").innerHTML = type;
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getTypeListTable() {
            $.ajax({
                url: "{{ url('listType/soHarian/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    console.log(obj);
                    idEdit.length = 0;
                    for (var i = 0; i < obj.listType.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.listType[i].id;
                        dataTable += '</td>';
                        idEdit.push(obj.listType[i].id);

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.listType[i].type;
                        dataTable += '" name="typeEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editType(' + i +
                            ');">Edit</button>';
                        dataTable += '</td>';

                        dataTable += '</tr>';
                    }
                    $('#tableEditType>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function editType(index) {
            var inputType = document.getElementsByName('typeEdit')[index].value;
            $.ajax({
                url: "{{ url('listType/soHarian/updateType') }}" + "/" + idEdit[index],
                type: 'get',
                data: {
                    NamaType: inputType,
                },
                success: function(response) {
                    getTypeListTable();
                    document.getElementById('tambahType').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function setType() {
            var typeId = $('#selType').val();
            getTypeItem(typeId);
            document.getElementById('btnTambahItem').disabled = false;
        }

        function getTypeItem(id) {
            $.ajax({
                url: "{{ url('listType/soHarian/show/item') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    idItemEdit.length = 0;
                    console.log(response);
                    for (var i = 0; i < obj.itemfso.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.itemfso[i].id;
                        idItemEdit.push(obj.itemfso[i].id);
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemfso[i].Item;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemfso[i].Satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<img src="' + "{{ url('img/soImage') }}" + '/' + obj.itemfso[i].icon +
                            '" alt="">';
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable +=
                            '<button type="button" class="btn btn-secondary" onClick="deleteItemOnType(' + i +
                            ');">Delete</button>';
                        dataTable += '</td>';
                        dataTable += '</tr>';
                    };
                    // document.getElementById('typeItem').innerHTML = dataItem;
                    $('#tableTypeItem>tbody').empty().append(dataTable);
                }
            });
        }

        function deleteItemOnType(index) {
            
            $.ajax({
                url: "{{ url('listType/soHarian/delete/itemOnType') }}",
                type: 'get',
                data: {
                    idType: $('#selType').val(),
                    idItem: idItemEdit[index],
                },
                success: function(response) {
                    setType();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
