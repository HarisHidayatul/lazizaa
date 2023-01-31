@extends('accountingControl.setItem.pattyCash.index')

@section('subSetItemJS')
    <script>
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Brand Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Patty Cash Harian / Brand Item";
            
            getListAllItem();
            getListAllBrand();
        })

        function sendItemOnBrand(){
            $.ajax({
                url: "{{ url('pattyCash/brands/store/item') }}",
                type: 'get',
                data: {
                    idBrand: $('#showBrandItem').val(),
                    idListItem: $('#showAllItem').val()
                },
                success: function(response) {
                    getItemBrand();
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
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.listPattyCash.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.listPattyCash[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.listPattyCash[i].Item;
                        dataDropdown += '</option>';
                    }
                    $('#showAllItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getListAllBrand() {
            $.ajax({
                url: "{{ url('pattyCash/brand/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    // console.log(obj);
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

        function getItemBrand() {
            var idBrandSelect = $('#showBrandItem').val();
            $.ajax({
                url: "{{ url('pattyCash/brand/show/item') }}",
                type: 'get',
                data: {
                    idBrand: idBrandSelect,
                },
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataTable = '';
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.dataItem[i].Item;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.dataItem[i].Satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable +=
                            '<button type="button" class="btn btn-secondary" onClick="delItemOnOutlet(' +
                            obj.dataItem[i].id +
                            ');">Delete</button>';
                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);
                    document.getElementById('setItemButton').disabled = false;
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
        function delItemOnOutlet(id){
            $.ajax({
                url: "{{ url('pattyCash/brands/item/del') }}",
                type: 'get',
                data: {
                    idBrand: $('#showBrandItem').val(),
                    idListItem: id
                },
                success: function(response) {
                    getItemBrand();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
