@extends('adminControl.common.index')

@section('commonJS')
    @yield('subCommonJS')
    <script>
        var idUserArray = [];
        $(document).ready(function() {
            document.getElementById("userSubMenu").classList.add("active");
            getAllOutlet();
            getAllRole();
        })
        function editItem(index){
            var idUser = idUserArray[index];
            var nama = document.getElementsByName('namaEdit')[index].value;
            var username = document.getElementsByName('usernameEdit')[index].value;
            var password = document.getElementsByName('passwordEdit')[index].value;
            var email = document.getElementsByName('emailEdit')[index].value;
            var idRole = document.getElementsByName('dropDownRoleEdit')[index].value;
            var idOutlet = document.getElementsByName('dropDownOutletEdit')[index].value;
            $.ajax({
                url: "{{ url('common/user/update') }}" + '/' + idUser,
                type: 'get',
                data: {
                    namaLengkap: nama,
                    email: email,
                    username: username,
                    password: password,
                    idRole: idRole,
                    idOutlet: idOutlet
                },
                success: function(response) {
                    getUser();
                    document.getElementById('namaInput').value = "";
                    document.getElementById('usernameInput').value = "";
                    document.getElementById('passwordInput').value = "";
                    document.getElementById('emailInput').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
        function sendAddItem(){
            var nama = document.getElementById('namaInput').value;
            var username = document.getElementById('usernameInput').value;
            var password = document.getElementById('passwordInput').value;
            var email = document.getElementById('emailInput').value;
            var idRole = document.getElementById('dropDownRoleInput').value;
            var idOutlet = document.getElementById('dropDownOutlet').value;
            $.ajax({
                url: "{{ url('common/user/store') }}",
                type: 'get',
                data: {
                    namaLengkap: nama,
                    email: email,
                    username: username,
                    password: password,
                    idRole: idRole,
                    idOutlet: idOutlet
                },
                success: function(response) {
                    getUser();
                    document.getElementById('namaInput').value = "";
                    document.getElementById('usernameInput').value = "";
                    document.getElementById('passwordInput').value = "";
                    document.getElementById('emailInput').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
        function getAllRole(){
            $.ajax({
                url: "{{ url('common/role/showAll') }}",
                type: 'get',
                success: function(response) {
                    // document.getElementById('addItemSalesOnType').value = "";
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    console.log(obj);
                    var dataDropdown = '';
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.dataItem[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.dataItem[i].role;
                        dataDropdown += '</option>';
                    }
                    $('#dropDownRoleInput').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
        function getAllOutlet() {
            $.ajax({
                url: "{{ url('common/outlet/showAll') }}",
                type: 'get',
                success: function(response) {
                    // document.getElementById('addItemSalesOnType').value = "";
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    console.log(obj);
                    var dataDropdown = '';
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.dataItem[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.dataItem[i].store;
                        dataDropdown += '</option>';
                    }
                    $('#dropDownOutlet').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
        function getUser(){
            var idOutlet = document.getElementById('dropDownOutlet').value;
            console.log(idOutlet);
            $.ajax({
                url: "{{ url('common/user/show') }}" + '/' + idOutlet,
                type: 'get',
                success: function(response) {
                    // document.getElementById('addItemSalesOnType').value = "";
                    var obj = JSON.parse(JSON.stringify(response));

                    var dataTable = '';
                    console.log(obj);
                    var dataDropdownRole = '';
                    var dataDropdownOutlet = '';
                    idUserArray.length = 0;
                    for (var i = 0; i < obj.role.length; i++) {
                        dataDropdownRole += '<option value=';
                        dataDropdownRole += obj.role[i].id;
                        dataDropdownRole += '>';
                        dataDropdownRole += obj.role[i].role;
                        dataDropdownRole += '</option>';
                    }
                    for(var i =0;i<obj.outlet.length;i++){
                        dataDropdownOutlet += '<option value=';
                        dataDropdownOutlet += obj.outlet[i].id;
                        dataDropdownOutlet += '>';
                        dataDropdownOutlet += obj.outlet[i].outlet;
                        dataDropdownOutlet += '</option>';
                    }

                    for (var i = 0; i < obj.dataItem.length; i++) {
                        idUserArray.push(obj.dataItem[i].id);
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.dataItem[i].id;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].nama;
                        dataTable += '" name="namaEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].username;
                        dataTable += '" name="usernameEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].password;
                        dataTable += '" name="passwordEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].email;
                        dataTable += '" name="emailEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<div class="form-group">';
                        dataTable += '<select class="form-control" name="dropDownRoleEdit">';
                        dataTable += dataDropdownRole;
                        dataTable += '</select>';
                        dataTable += '</div>';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<div class="form-group">';
                        dataTable += '<select class="form-control" name="dropDownOutletEdit">';
                        dataTable += dataDropdownOutlet;
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

                    var elementRole = document.getElementsByName('dropDownRoleEdit');
                    var elementOutlet = document.getElementsByName('dropDownOutletEdit');
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        elementOutlet[i].value = obj.dataItem[i].idOutlet;
                        elementRole[i].value = obj.dataItem[i].idRole;
                    }
                    document.getElementById('buttonClickSubmit').disabled = false;
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
