@extends('adminControl.common.index')

@section('commonJS')
    @yield('subCommonJS')
    <script>
        var dataIdBrand = [];
        $(document).ready(function() {
            document.getElementById("brandSubMenu").classList.add("active");
            getAllBrandTable();
        })

        function editItem(index){
            var namaBrand = document.getElementsByName('brandEdit')[index].value;
            var keteranganBrand = document.getElementsByName('keteranganEdit')[index].value;
            var logoBrand = document.getElementsByName('logoEdit')[index].value;

            // console.log(namaBrand + keteranganBrand + logoBrand);
            $.ajax({
                url: "{{ url('common/brand/update') }}" + '/' + dataIdBrand[index],
                type: 'get',
                data: {
                    namaBrand: namaBrand,
                    keterangan: keteranganBrand,
                    logoBrand: logoBrand
                },
                success: function(response) {
                    getAllBrandTable();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendAddItem(){
            var namaBrand = document.getElementById('namaBrand').value;
            var keteranganBrand = document.getElementById('keteranganBrand').value;
            var logoBrand = document.getElementById('logoBrand').value;

            // console.log(namaBrand + keteranganBrand + logoBrand);
            $.ajax({
                url: "{{ url('common/brand/store') }}",
                type: 'get',
                data: {
                    namaBrand: namaBrand,
                    keterangan: keteranganBrand,
                    logoBrand: logoBrand
                },
                success: function(response) {
                    getAllBrandTable();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getAllBrandTable() {
            dataIdBrand.length =0;
            $.ajax({
                url: "{{ url('common/brand/show') }}",
                type: 'get',
                success: function(response) {
                    // document.getElementById('addItemSalesOnType').value = "";
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    console.log(obj);
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.dataItem[i].id;
                        dataIdBrand.push(obj.dataItem[i].id);
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].brand;
                        dataTable += '" name="brandEdit">';
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].keterangan;
                        dataTable += '" name="keteranganEdit">';
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].logo;
                        dataTable += '" name="logoEdit">';
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<img src="' + "{{ url('') }}" + obj.dataItem[i].logo +
                            '" style="height: 20px;" alt="">';
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editItem(' + i +
                            ');">Edit</button>';
                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
