@extends('adminControl.setItem.sales.index')

@section('subSetItemJS')
    <script>
        var dropDownTypeEdit = '';
        var dataIdSales = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Outlet Type";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Sales Harian / Outlet Type";
        })
        $(document).ready(function() {
            showOutlet();
            getAllItem();
        })

        function getAllItem() {
            $.ajax({
                url: "{{ url('typeSales/items/show') }}",
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.listSales.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.listSales[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.listSales[i].sales;
                        dataDropdown += '</option>';
                    }
                    // document.getElementById("typeItem").innerHTML = listItem;
                    $('#allItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function setItemOnOutlet() {
            $.ajax({
                url: "{{ url('typeSales/item/outlet/store') }}",
                type: 'get',
                data: {
                    idOutlet: $('#showOutletItem').val(),
                    idListSales: $('#allItem').val()

                },
                success: function(response) {
                    setOutlet();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function showOutlet() {
            $.ajax({
                url: "{{ url('show/outlet') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.Outlet.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.Outlet[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.Outlet[i].Outlet;
                        dataDropdown += '</option>';
                    }
                    $('#showOutletItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function setOutlet() {
            var typeId = $('#showOutletItem').val();
            getItemOnOutlet(typeId);
        }

        function getItemOnOutlet(id) {
            $.ajax({
                url: "{{ url('typeSales/outlet/show/item/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    var countLoop =0;
                    dataIdSales.length = 0;
                    for (var i = 0; i < obj.listSales.length; i++) {
                        dataIdSales.push(obj.listSales[i].id);
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.listSales[i].sales;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.listSales[i].type;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="delItemOnOutlet(' +
                            countLoop +
                            ');">Delete</button>';
                        dataTable += '</td>';
                        dataTable += '</tr>';
                        countLoop++;
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);
                    document.getElementById('setItemButton').disabled = false;
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function delItemOnOutlet(index) {
            $.ajax({
                url: "{{ url('typeSales/item/outlet/delete') }}",
                type: 'get',
                data: {
                    idOutlet: $('#showOutletItem').val(),
                    idListSales: dataIdSales[index]
                },
                success: function(response) {
                    setOutlet();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
