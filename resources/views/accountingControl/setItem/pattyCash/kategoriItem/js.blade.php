@extends('accountingControl.setItem.pattyCash.index')

@section('subSetItemJS')
    <script>
        var idKategoriAll = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Kategori Item";
            document.getElementById("tittleFillContent").innerHTML = "Kategori Item";
            document.getElementById("subFillContent").innerHTML = "Patty Cash Harian / Set Item";
            getAllKategori();
        })
        function sendAddKategori() {
            $.ajax({
                url: "{{ url('pattyCash/kategoriItem/store') }}",
                type: 'get',
                data: {
                    namaKategori: document.getElementById('addKategori').value
                },
                success: function(response) {
                    getAllKategori();
                    document.getElementById('addKategori').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
        function editKategori(index) {
            var idKategori = idKategoriAll[index];
            var namaKategori = document.getElementsByName('inputEdit')[index].value;
            $.ajax({
                url: "{{ url('pattyCash/update/kategori') }}" + "/" + idKategori,
                type: 'get',
                data: {
                    namaKategori: namaKategori
                },
                success: function(response) {
                    getAllKategori();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
        function getAllKategori() {
            $.ajax({
                url: "{{ url('show/satuan') }}",
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    idKategoriAll.length = 0;

                    for (var i = 0; i < obj.dataKategori.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.dataKategori[i].id;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataKategori[i].namaKategori;
                        dataTable += '" name="inputEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editKategori(' + i +
                            ');">Edit</button>';
                        dataTable += '</td>';
                        dataTable += '</tr>';

                        idKategoriAll.push(obj.dataKategori[i].id);
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
