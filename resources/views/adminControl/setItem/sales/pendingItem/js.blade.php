@extends('adminControl.setItem.sales.index')

@section('subSetItemJS')
    <script>
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Pending Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Sales Harian / Pending Item";
        })
        $(document).ready(function() {
            getListAllRequest();
        })
        function getListAllRequest() {
            $.ajax({
                url: "{{ url('salesHarian/items/show/req') }}",
                type: 'get',
                success: function(response) {
                    var order_data = '';
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    for (var i = 0; i < obj.reqSales.length; i++) {
                        order_data += '<tr>';
                        order_data += '<td>';
                        order_data += obj.reqSales[i].sales;
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += obj.reqSales[i].outlet;
                        order_data += '</td>';
                        order_data +=
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" onClick="acceptItem(' +
                            obj.reqSales[i].id + ')">&#xe5ca;</i></a></td>';
                        order_data +=
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" onClick="deleteItem(' +
                            obj.reqSales[i].id + ')">&#xe14c;</i></a></td>';
                        order_data += '</tr>';
                    }
                    $('#revisionTable>tbody').empty().append(order_data);

                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
        function acceptItem(id){
            processAcceptDel('1', id);
        }
        function deleteItem(id){
            processAcceptDel('2', id);
        }
        function processAcceptDel(status, idRev) {
            $.ajax({
                url: "{{ url('salesHarian/items/store/request') }}",
                type: 'get',
                data: {
                    status: status,
                    idRev: idRev,
                },
                success: function(response) {
                    getListAllRequest();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection