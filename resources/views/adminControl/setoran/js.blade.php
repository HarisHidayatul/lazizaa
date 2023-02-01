@extends('adminControl.layout.index')

@section('filljs')
    @yield('setoranJS')
    <script>
        var idPenerimaArray = [];
        $(document).ready(function() {
            document.getElementById("setoranSubMenu").classList.add("active");
            getAllBank();
            getAllPenerima();
        })

        function getAllBank() {
            $.ajax({
                url: "{{ url('setoran/bank/show/all') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataJenis = '';
                    var listPenerima = '';
                    for (var i = 0; i < obj.listBank.length; i++) {
                        listPenerima += '<option value="' + obj.listBank[i].id;
                        listPenerima += '">' + obj.listBank[i].bank;
                        listPenerima += '</option>';
                    }
                    $('#selectBankPenerima').empty().append(listPenerima);
                },
                error: function(req, err) {}
            })
        }

        function getAllPenerima() {
            $.ajax({
                url: "{{ url('setoran/penerima/show') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    console.log(obj);
                    var dataDropdown = '';
                    idPenerimaArray.length = 0;
                    for (var i = 0; i < obj.bankListArray.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.bankListArray[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.bankListArray[i].bank;
                        dataDropdown += '</option>';
                    }

                    for (var i = 0; i < obj.penerimaListArray.length; i++) {
                        idPenerimaArray.push(obj.penerimaListArray[i].id);
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.penerimaListArray[i].id;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.penerimaListArray[i].namaRekening;
                        dataTable += '" name="namaRekeningEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.penerimaListArray[i].nomorRekening;
                        dataTable += '" name="nomorRekeningEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<div class="form-group">';
                        dataTable += '<select class="form-control" name="dropDownBankEdit">';
                        dataTable += dataDropdown;
                        dataTable += '</select>';
                        dataTable += '</div>';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editItem(' +
                            i +
                            ');">Edit</button>';
                        dataTable += '</td>';

                        dataTable += '</tr>';
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);

                    var dropDownBrand = document.getElementsByName('dropDownBankEdit');
                    for (var i = 0; i < obj.penerimaListArray.length; i++) {
                        dropDownBrand[i].value = obj.penerimaListArray[i].idBank;
                    }
                },
                error: function(req, err) {}
            })
        }

        function editItem(index) {
            $.ajax({
                url: "{{ url('setoran/penerima/edit') }}",
                type: 'get',
                data: {
                    namaRekening: document.getElementsByName('namaRekeningEdit')[index].value,
                    nomorRekening: document.getElementsByName('nomorRekeningEdit')[index].value,
                    idBank: document.getElementsByName('dropDownBankEdit')[index].value,
                    idPenerima: idPenerimaArray[index]
                },
                success: function(response) {
                    getAllPenerima();
                },
                error: function(req, err) {}
            })
        }

        function createIDPenerima() {
            $.ajax({
                url: "{{ url('setoran/penerima/createID') }}",
                type: 'get',
                data: {
                    namaRekening: document.getElementById('namaRekeningPenerima').value,
                    nomorRekening: document.getElementById('nomorRekeningPenerima').value,
                    idBank: $('#selectBankPenerima').val(),
                },
                success: function(response) {
                    document.getElementById('namaRekeningPenerima').value = '';
                    document.getElementById('nomorRekeningPenerima').value = '';
                    getAllPenerima();
                },
                error: function(req, err) {}
            })
        }
    </script>
@endsection
