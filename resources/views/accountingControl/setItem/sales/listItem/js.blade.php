@extends('accountingControl.setItem.sales.index')

@section('subSetItemJS')
    <script>
        var dropDownTypeEdit = '';
        var dropDownIdEdit = [];
        var arrayIdItemSales = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "List Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Sales Harian / List Item";
            getListAllType();
            // getListAllItem();
        })

        function sendAddItem() {
            $.ajax({
                url: "{{ url('typeSales/item/store') }}",
                type: 'get',
                data: {
                    idType: $('#selType').val(),
                    NamaItem: document.getElementById('addItemSalesOnType').value,
                },
                success: function(response) {
                    // setType();
                    document.getElementById('addItemSalesOnType').value = "";
                    getListAllItem();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getListAllType() {
            $.ajax({
                url: "{{ url('typeSales/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.typeSales.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.typeSales[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.typeSales[i].type;
                        dataDropdown += '</option>';
                    }
                    dropDownTypeEdit = dataDropdown;
                    $('#selType').empty().append(dataDropdown);
                    getListAllItem();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getListAllItem() {
            $.ajax({
                url: "{{ url('typeSales/show/item/eachtype') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataTable = '';
                    var countLoop = 0;
                    dropDownIdEdit.length = 0;
                    arrayIdItemSales.length = 0;
                    for (var i = 0; i < obj.listType.length; i++) {
                        for (var j = 0; j < obj.listType[i].listSales.length; j++) {
                            dataTable += '<tr>';
                            dataTable += '<td>';
                            dataTable += obj.listType[i].listSales[j].id;
                            dataTable += '</td>';
                            arrayIdItemSales.push(obj.listType[i].listSales[j].id);

                            dataTable += '<td>';
                            dataTable += '<input type="text" class="form-control" value="';
                            dataTable += obj.listType[i].listSales[j].sales;
                            dataTable += '" name="inputEdit">';
                            dataTable += '</td>';

                            dataTable += '<td>';
                            dataTable += '<select class="form-control" name="dropDownTypeEdit">';
                            dataTable += dropDownTypeEdit;
                            dataTable += '</select>';
                            dataTable += '</td>';

                            dataTable += '<td class="d-flex justify-content-center">';
                            dataTable +=
                                '<input class="form-check-input" name="checkBoxVerif" type="checkbox" ';
                            if (obj.listType[i].listSales[j].verif != '0') {
                                dataTable += ' checked';
                            }
                            dataTable += '>';
                            dataTable += '</td>';

                            dataTable += '<td>';
                            dataTable += '<input type="text" class="form-control" value="';
                            dataTable += obj.listType[i].listSales[j].keywoardBee;
                            dataTable += '" name="keywoardBee">';
                            dataTable += '</td>';

                            dataTable += '<td>';
                            dataTable += '<input type="text" class="form-control" value="';
                            dataTable += obj.listType[i].listSales[j].itemBee;
                            dataTable += '" name="itemBee">';
                            dataTable += '</td>';

                            dataTable += '<td>';
                            dataTable += '<button type="button" class="btn btn-secondary" onClick="editItem(' +
                                countLoop +
                                ');">Edit</button>';
                            dataTable += '</td>';

                            dataTable += '</tr>';

                            dropDownIdEdit.push(obj.listType[i].id);
                            countLoop++;
                        }
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);

                    var elementDropDownItem = document.getElementsByName('dropDownTypeEdit');

                    for (var i = 0; i < dropDownIdEdit.length; i++) {
                        elementDropDownItem[i].value = dropDownIdEdit[i];
                    }
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function editItem(index) {
            var butuhVerifikasi = '0';
            if (document.getElementsByName('checkBoxVerif')[index].checked) {
                butuhVerifikasi = '1';
            }
            $.ajax({
                url: "{{ url('typeSales/item/outlet/update') }}" + "/" + arrayIdItemSales[index],
                type: 'get',
                data: {
                    typeSales: document.getElementsByName('dropDownTypeEdit')[index].value,
                    sales: document.getElementsByName('inputEdit')[index].value,
                    keywoardBee: document.getElementsByName('keywoardBee')[index].value,
                    itemBee: document.getElementsByName('itemBee')[index].value,
                    butuhVerifikasi: butuhVerifikasi
                },
                success: function(response) {
                    getListAllItem();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
