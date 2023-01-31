@extends('accountingControl.setItem.sales.index')

@section('subSetItemJS')
    <script>
        var idTypeArray = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Set Type";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Sales Harian / Set Type";
        })
        $(document).ready(function() {
            getAllType();
        })

        function sendAddType() {
            $.ajax({
                url: "{{ url('typeSales/store') }}",
                type: 'get',
                data: {
                    NamaType: document.getElementById('tambahTypeSales').value,
                },
                success: function(response) {
                    getAllType();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getAllType() {
            $.ajax({
                url: "{{ url('typeSales/show/item/eachtype') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataTable = '';
                    var countLoop = 0;
                    idTypeArray.length = 0;
                    for (var i = 0; i < obj.listType.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.listType[i].id;
                        dataTable += '</td>';

                        idTypeArray.push(obj.listType[i].id);

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.listType[i].type;
                        dataTable += '" name="typeEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';

                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editType(' +
                            countLoop +
                            ');">Edit</button>';

                        dataTable += '</td>';

                        dataTable += '</tr>';

                        countLoop++;
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function editType(index) {
            $.ajax({
                url: "{{ url('typeSales/type/update') }}" + "/" + idTypeArray[index],
                type: 'get',
                data: {
                    type: document.getElementsByName('typeEdit')[index].value
                },
                success: function(response) {
                    getAllType();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
