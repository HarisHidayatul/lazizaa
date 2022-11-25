<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <title>Document</title>
</head>

<body>
    <h6>Nama Type Yang Tersedia : </h6>
    <div id='showType'></div>
    <h6>Tambahkan Type: </h6>
    <h7>Nama Type : </h7><input type="text" id="tambahTypeSales"><br><br>
    <button onclick="sendAddType()">Send Type</button><br><br>

    <h6>Pending Item (Request): </h6><br>
    <table class="table table-bordered" style="width: 50%" id="revisionTable">
        <thead>
            <tr>
                <th>Nama Sales</th>
                <th>Outlet</th>
                <th>Accept</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <h6>Pilih Type: </h6>
    <select id='selType' style='width: 200px;'>
    </select>
    <button onclick="setType()">Pilih Type</button><br><br>

    <h7>Nama Type : </h7><br><br>
    <div id="typeselect"></div><br>
    <h7>Item Didalam Type Ini : </h7><br><br>
    <div id="typeItem"></div><br><br>

    <h7>Tambahkan Item Didalam Tipe Ini : </h7><br><br>
    <input type="text" id="addItemSalesOnType">
    <button id="ItemAddOnType" onclick="sendAddItem()" disabled>Add Item</button><br><br>

    <br>
    <h7>Hapus Item Didalam Tipe Ini : </h7><br><br>
    <select id='delItemOnType' style='width: 200px;'>
    </select>
    <button id="ItemDelOnType" onclick="delItemOnTypeBtn()" disabled>Del Item</button><br><br>

    <h7>Pilih Outlet Untuk Menampilkan Item dan Type : </h7><br><br>
    <select id="showOutletItem" style='width: 200px;'>
    </select>
    <button onclick="setOutlet()">Pilih Outlet</button><br><br>

    <h6>Nama Outlet : </h6><br>
    <div id="selectedOutlet"></div><br>
    <h6>Item Dalam Outlet Ini</h6><br>
    <div id="itemOutlet"></div><br>

    <h7>Masukkan item pada outlet ini : </h7><br>
    <select id="allItem" style='width: 200px;'>
    </select>
    <button onclick="setItemOnOutlet()">Add Item</button><br><br>

    <h7>Delete item pada outlet ini : </h7><br>
    <select id="delItem" style='width: 200px;'>
    </select>
    <button onclick="delItemOnOutlet()">Del Item</button><br><br>

    <script>
        $(document).on("click", "[id^=a]", function(event, ui) {
            //function for accept (when clicked)
            var idClickAccept = this.id.substring(1);
            // alert(idClickAccept+'a');
            processAcceptDel('1', idClickAccept);
        });
        $(document).on("click", "[id^=b]", function(event, ui) {
            //function for delete (when clicked)
            var idClickDelete = this.id.substring(1);
            // alert(idClickDelete+'b');
            processAcceptDel('2', idClickDelete);
        });

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

        function delItemOnOutlet() {
            $.ajax({
                url: "{{ url('typeSales/item/outlet/delete') }}",
                type: 'get',
                data: {
                    idOutlet: $('#showOutletItem').val(),
                    idListSales: $('#delItem').val()

                },
                success: function(response) {
                    setOutlet();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function setItemOnOutlet() {
            $.ajax({
                url: "{{ url('typeSales/item/outlet/store') }}",
                type: 'get',
                data: {
                    idOutlet: $('#showOutletItem').val(),
                    idListSales: $('#allItem').val()

                },
                success: function(response) {
                    setOutlet();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getItemOnOutlet(id) {
            $.ajax({
                url: "{{ url('typeSales/outlet/show/item/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var listItem = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.listSales.length; i++) {
                        listItem += obj.listSales[i].sales + ' | ';
                        dataDropdown += '<option value=';
                        dataDropdown += obj.listSales[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.listSales[i].sales;
                        dataDropdown += '</option>';
                    }
                    document.getElementById("itemOutlet").innerHTML = listItem;
                    $('#delItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getAllItem() {
            $.ajax({
                url: "{{ url('typeSales/items/show') }}",
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var listItem = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.listSales.length; i++) {
                        listItem += obj.listSales[i].sales + ' | ';

                        dataDropdown += '<option value=';
                        dataDropdown += obj.listSales[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.listSales[i].sales;
                        dataDropdown += '</option>';
                    }
                    // document.getElementById("typeItem").innerHTML = listItem;
                    $('#allItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

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
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Accept" id="a' +
                            obj.reqSales[i].id + '">&#xe5ca;</i></a></td>';
                        order_data +=
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" id="b' +
                            obj.reqSales[i].id + '">&#xe14c;</i></a></td>';
                        order_data += '</tr>';
                    }
                    $('#revisionTable>tbody').empty().append(order_data);

                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function showOutlet() {
            $.ajax({
                url: "{{ url('show/outlet') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.Outlet.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.Outlet[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.Outlet[i].Outlet;
                        dataDropdown += '</option>';
                    }
                    $('#showOutletItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function setOutlet() {
            var namaOutlet = $('#showOutletItem option:selected').text();
            var typeId = $('#showOutletItem').val();
            getItemOnOutlet(typeId);
            document.getElementById('selectedOutlet').innerHTML = (namaOutlet + ' id = ' + typeId);

        }

        function setType() {
            var nameType = $('#selType option:selected').text();
            var typeId = $('#selType').val();
            document.getElementById('typeselect').innerHTML = (nameType + ' id = ' + typeId);
            document.getElementById('ItemAddOnType').disabled = false;
            document.getElementById('ItemDelOnType').disabled = false;
            getAllItem();
            getListItemOnType(typeId);
            // getTypeOutlet(typeId);
        }

        function sendAddItem() {
            $.ajax({
                url: "{{ url('typeSales/item/store') }}",
                type: 'get',
                data: {
                    idType: $('#selType').val(),
                    NamaItem: document.getElementById('addItemSalesOnType').value,
                },
                success: function(response) {
                    setType();
                    document.getElementById('addItemSalesOnType').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })

        }

        function sendAddType() {
            $.ajax({
                url: "{{ url('typeSales/store') }}",
                type: 'get',
                data: {
                    NamaType: document.getElementById('tambahTypeSales').value,
                },
                success: function(response) {
                    getListAllType();
                    document.getElementById('tambahTypeSales').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getListItemOnType(id) {
            $.ajax({
                url: "{{ url('typeSales/item/show/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var listItem = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.listSales.length; i++) {
                        listItem += obj.listSales[i].sales + ' | ';

                        dataDropdown += '<option value=';
                        dataDropdown += obj.listSales[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.listSales[i].sales;
                        dataDropdown += '</option>';
                    }
                    document.getElementById("typeItem").innerHTML = listItem;
                    $('#delItemOnType').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getListAllType() {
            $.ajax({
                url: "{{ url('typeSales/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var type = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.typeSales.length; i++) {
                        type += obj.typeSales[i].type + ' | ';

                        dataDropdown += '<option value=';
                        dataDropdown += obj.typeSales[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.typeSales[i].type;
                        dataDropdown += '</option>';
                    }
                    document.getElementById("showType").innerHTML = type;
                    $('#selType').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
        $(document).ready(function() {
            getListAllType();
            showOutlet();
            getAllItem();
            getListAllRequest();
        })
    </script>
</body>

</html>
