@extends('adminControl.setItem.so.index')

@section('subSetItemJS')
    <script>
        $("#showOutletItem").select2();
        $("#showAllType").select2();

        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Outlet Type";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "SO Harian / Outlet Type";
        })

        $(document).ready(function() {
            showOutlet();
            getListAllType();
        })

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

                    $('#showAllType').empty().append(dataDropdown);
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

        function getItemOutlet() {
            var idOutlets = $('#showOutletItem').val();
            showItemOutlet(idOutlets);
            document.getElementById('buttonAddType').disabled = false;
        }

        function showItemOutlet(id) {
            $.ajax({
                url: "{{ url('listType/soHarian/show/item/outlet/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var typeHTML = '';
                    var dataTable = '';
                    for (var i = 0; i < obj.Type.length; i++) {
                        typeHTML += '<div style="display: flex;"><div>';
                        typeHTML += obj.Type[i].type;
                        typeHTML += '</div><div style="cursor: pointer;" onClick="sendTypeDelOnOutlet(' +
                            obj.Type[i].id + ');">&#x2715;</div></div>';
                        typeHTML += '<div style="width: 10px;"></div>';
                    }

                    for (var i = 0; i < obj.DataItem.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.DataItem[i].id;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.DataItem[i].Item;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.DataItem[i].satuan;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.DataItem[i].icon;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<img src="' + "{{ url('img/soImage') }}" + '/' + obj.DataItem[i].icon +
                            '" alt="">';
                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }

                    document.getElementById('outletTypeOnItem').innerHTML = typeHTML;
                    // document.getElementById('tableAllItem').innerHTML = dataTabel;
                    $('#tableAllItem>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function sendTypeDelOnOutlet(id){
            delType(id, $('#showOutletItem').val())
        }

        function delType(idType, idOutlet) {
            $.ajax({
                url: "{{ url('listType/soHarian/delete/outletOnType') }}",
                type: 'get',
                data: {
                    idType: idType,
                    idOutlet: idOutlet,
                },
                success: function(response) {
                    // setType();
                    getItemOutlet();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
        
        function sendTypeOnOutlet(){
            sendType($('#showAllType').val(),$('#showOutletItem').val());
        }
        function sendType(idType,idOutlet){
            $.ajax({
                url: "{{ url('listType/soHarian/store/outlet') }}",
                type: 'get',
                data: {
                    idType: idType,
                    idOutlet: idOutlet,
                },
                success: function(response) {
                    getItemOutlet();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
