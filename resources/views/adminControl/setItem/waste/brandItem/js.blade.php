@extends('adminControl.setItem.waste.index')

@section('subSetItemJS')
    <script>
        var arrayItemWaste = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Brand Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Waste Harian / Brand Item";

            getListAllBrand();
            showListAllItem();
        })

        function sendItemOnBrand() {
            $.ajax({
                url: "{{ url('waste/brands/store/item') }}",
                type: 'get',
                data: {
                    idBrand: $('#showBrandItem').val(),
                    idListItem: $('#dropDownItem').val()
                },
                success: function(response) {
                    getItemBrand();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function deleteItem(idItem) {
            $.ajax({
                url: "{{ url('waste/brands/item/del') }}",
                type: 'get',
                data: {
                    idBrand: $('#showBrandItem').val(),
                    idListItem: idItem
                },
                success: function(response) {
                    getItemBrand();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getItemBrand() {
            var idBrandSelect = $('#showBrandItem').val();
            $.ajax({
                url: "{{ url('waste/brand/show/item') }}",
                type: 'get',
                data: {
                    idBrand: idBrandSelect,
                },
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    console.log(obj);
                    for (var i = 0; i < obj.listWaste.length; i++) {
                        for (var j = 0; j < obj.listWaste[i].waste.length; j++) {
                            dataTable += '<tr>';
                            dataTable += '<td>';
                            dataTable += obj.listWaste[i].waste[j].id;
                            dataTable += '</td>';
                            dataTable += '<td>';
                            dataTable += obj.listWaste[i].waste[j].Item;
                            dataTable += '</td>';
                            dataTable += '<td>';
                            dataTable += obj.listWaste[i].waste[j].Satuan;
                            dataTable += '</td>';
                            dataTable += '<td>';
                            dataTable += obj.listWaste[i].jenisBahan;
                            dataTable += '</td>';

                            dataTable += '<td>';
                            dataTable +=
                                '<button type="button" class="btn btn-secondary" onClick="deleteItem(' +
                                obj.listWaste[i].waste[j].id +
                                ');">Delete</button>';
                            dataTable += '</td>';

                            dataTable += '</tr>';
                        }
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);
                    document.getElementById('setItemButton').disabled = false;
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function showListAllItem() {
            $.ajax({
                url: "{{ url('waste/items/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dropDownType = '';
                    arrayItemWaste.length = 0;
                    for (var i = 0; i < obj.listWaste.length; i++) {
                        dropDownType += '<option value=';
                        dropDownType += i;
                        dropDownType += '>';
                        dropDownType += obj.listWaste[i].jenisBahan;
                        dropDownType += '</option>';
                        arrayItemWaste.push(obj.listWaste[i]);
                    }
                    $('#dropDownJenis').empty().append(dropDownType);
                    refreshListItem();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function refreshListItem() {
            var dropDownType = '';
            var valDropDown = document.getElementById('dropDownJenis').value;
            for (var i = 0; i < arrayItemWaste[valDropDown].waste.length; i++) {
                dropDownType += '<option value=';
                dropDownType += arrayItemWaste[valDropDown].waste[i].id;
                dropDownType += '>';
                dropDownType += arrayItemWaste[valDropDown].waste[i].Item;
                dropDownType += '</option>';
            }
            $('#dropDownItem').empty().append(dropDownType);
        }

        function getListAllBrand() {
            $.ajax({
                url: "{{ url('pattyCash/brand/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.brand.length; i++) {
                        // console.log(obj.brand[i].Satuan);
                        dataDropdown += '<option value=';
                        dataDropdown += obj.brand[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.brand[i].namaBrand;
                        dataDropdown += '</option>';
                    }
                    $('#showBrandItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
