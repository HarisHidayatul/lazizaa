@extends('adminControl.setItem.index')

@section('setItemJS')
    @yield('subSetItemJS')
    <script>
        var idSatuanArray = [];
        $(document).ready(function() {
            document.getElementById("satuanSubMenu").classList.add("active");
            showSatuan();
        })

        function editSatuan(index){
            var satuanInput = document.getElementsByName('satuanEdit')[index].value;
            var idSatuan = idSatuanArray[index];
            $.ajax({
                url: "{{ url('common/satuan/update') }}" + '/' + idSatuan,
                type: 'get',
                data: {
                    satuan: satuanInput,
                },
                success: function(response) {
                    showSatuan();
                    document.getElementById('tambahNamaItem').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendAddItem(){
            var satuanInput = document.getElementById('tambahNamaItem').value;
            $.ajax({
                url: "{{ url('common/satuan/store') }}",
                type: 'get',
                data: {
                    satuan: satuanInput,
                },
                success: function(response) {
                    showSatuan();
                    document.getElementById('tambahNamaItem').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function showSatuan() {
            $.ajax({
                url: "{{ url('common/satuan/show') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataTable = '';
                    idSatuanArray.length =0;
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.dataItem[i].id;
                        dataTable += '</td>';
                        idSatuanArray.push(obj.dataItem[i].id);

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].Satuan;
                        dataTable += '" name="satuanEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable +=
                            '<button type="button" class="btn btn-secondary" onClick="editSatuan(' + i +
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
