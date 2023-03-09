@extends('accountingControl.setItem.pattyCash.index')

@section('subSetItemJS')
    <script>
        var idJenisPattyCash = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Jenis Item";
            document.getElementById("tittleFillContent").innerHTML = "Jenis Item";
            document.getElementById("subFillContent").innerHTML = "Patty Cash Harian / Set Item";
            getAllJenis();
        })
        function sendAddJenis() {
            $.ajax({
                url: "{{ url('pattyCash/jenisItem/store') }}",
                type: 'get',
                data: {
                    namaJenis: document.getElementById('addJenisItem').value,
                    idKategori: $('#showKategoriAdd').val()
                },
                success: function(response) {
                    getAllJenis();
                    document.getElementById('addJenisItem').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
        function editJenis(index) {
            var idJenis = idJenisPattyCash[index];
            var namaJenis = document.getElementsByName('inputEdit')[index].value;
            var idKategori = document.getElementsByName('dropDownEdit')[index].value;
            $.ajax({
                url: "{{ url('pattyCash/update/jenis') }}" + "/" + idJenis,
                type: 'get',
                data: {
                    namaJenis: namaJenis,
                    idKategori: idKategori
                },
                success: function(response) {
                    getAllJenis();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
        function getAllJenis() {
            $.ajax({
                url: "{{ url('show/satuan') }}",
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';

                    var kategoriAll = [];
                    var dataDropdown = '';

                    idJenisPattyCash.length = 0;
                    for (var i = 0; i < obj.dataKategori.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.dataKategori[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.dataKategori[i].namaKategori;
                        dataDropdown += '</option>';

                        kategoriAll.push([obj.dataKategori[i].id, obj.dataKategori[i].namaKategori]);
                    }

                    for (var i = 0; i < obj.dataJenis.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.dataJenis[i].id;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataJenis[i].namaJenis;
                        dataTable += '" name="inputEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<div class="form-group">';
                        dataTable += '<select class="form-control" name="dropDownEdit">';
                        dataTable += dataDropdown;
                        dataTable += '</select>';
                        dataTable += '</div>';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editJenis(' + i +
                            ');">Edit</button>';
                        dataTable += '</td>';
                        dataTable += '</tr>';

                        idJenisPattyCash.push(obj.dataJenis[i].id);
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);
                    $('#showKategoriAdd').empty().append(dataDropdown);

                    var elementDropDown = document.getElementsByName('dropDownEdit');
                    for (var i = 0; i < obj.dataJenis.length; i++) {
                        elementDropDown[i].value = obj.dataJenis[i].idKategori;
                    }
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
