@extends('adminControl.layout.index')

@section('filljs')
    @yield('setBankJS')
    <script>
        var idListBank = [];
        $(document).ready(function() {
            document.getElementById("setBankSubMenu").classList.add("active");
            getAllBank();
            getAllTypeBank();
            // getAllPenerima();
        })

        function createBank() {
            $.ajax({
                url: "{{ url('setoran/bank/create') }}",
                type: 'get',
                data: {
                    idJenisBank: $('#selectJenisBank').val(),
                    bank: document.getElementById('namaBank').value,
                    imageBank: document.getElementById('imageBank').value
                },
                success: function(response) {
                    document.getElementById('namaBank').value = '';
                    document.getElementById('imageBank').value = '';
                    getAllBank();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getAllTypeBank() {
            $.ajax({
                url: "{{ url('setoran/bank/type/show') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataDropdown = '';
                    for (var i = 0; i < obj.jenis.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.jenis[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.jenis[i].jenis;
                        dataDropdown += '</option>';
                    }

                    $('#selectJenisBank').empty().append(dataDropdown);
                },
                error: function(req, err) {}
            })
        }

        function getAllBank() {
            $.ajax({
                url: "{{ url('setoran/bank/show/all') }}",
                type: 'get',
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataDropdown = '';
                    var dataTable = '';
                    idListBank.length = 0;
                    for (var i = 0; i < obj.jenisBank.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.jenisBank[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.jenisBank[i].jenis;
                        dataDropdown += '</option>';
                    }

                    for (var i = 0; i < obj.listBank.length; i++) {
                        idListBank.push(obj.listBank[i].id);
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.listBank[i].id;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.listBank[i].bank;
                        dataTable += '" name="bankEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<div class="form-group">';
                        dataTable += '<select class="form-control" name="dropDownJenisEdit">';
                        dataTable += dataDropdown;
                        dataTable += '</select>';
                        dataTable += '</div>';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.listBank[i].img;
                        dataTable += '" name="imageBankEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<img src="' + "{{ url('/') }}" + '/' + obj.listBank[i].img +
                            '" alt="" style="width: 35px;">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editItem(' +
                            i +
                            ');">Edit</button>';
                        dataTable += '</td>';

                        dataTable += '</tr>';
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);

                    var dropDownBrand = document.getElementsByName('dropDownJenisEdit');
                    for (var i = 0; i < obj.listBank.length; i++) {
                        dropDownBrand[i].value = obj.listBank[i].idJenisBank;
                    };
                },
                error: function(req, err) {}
            })
        }

        function editItem(index){
            $.ajax({
                url: "{{ url('setoran/bank/update') }}" + '/' + idListBank[index],
                type: 'get',
                data: {
                    idJenisBank: document.getElementsByName('dropDownJenisEdit')[index].value,
                    bank: document.getElementsByName('bankEdit')[index].value,
                    imageBank: document.getElementsByName('imageBankEdit')[index].value
                },
                success: function(response) {
                    getAllBank();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
