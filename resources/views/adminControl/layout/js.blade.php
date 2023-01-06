@extends('adminControl.layout.main')

@section('mainjs')
    <script>
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
                },
                success: function(response) {
                    getListAllItem();
                    document.getElementById('tambahNamaItem').value = "";
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
                url: "{{ url('itemSO/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var item = '';
                    var dataTable = '';
                    for (var i = 0; i < obj.itemSO.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.itemSO[i].item;
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += obj.itemSO[i].Satuan;
                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
