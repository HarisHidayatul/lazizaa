{{-- @dd($idPengisi) --}}
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
    <h6>Nama Item Yang Tersedia : </h6>
    <div id='showItem'></div>
    <h6>Tambahkan Item (Direct): </h6>
    <h7>Nama Item : </h7><input type="text" id="tambahNamaItem"><br><br>
    <h7>Satuan : </h7><br>
    <select id="showSatuanAdd" style='width: 200px;'>
    </select><br>
    <button onclick="sendAddItem()">Send Item</button><br><br>

    <h6>Pending Item (Request): </h6><br>
    <table class="table table-bordered" style="width: 50%" id="revisionTable">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Satuan</th>
                <th>Outlet</th>
                <th>Brand</th>
                <th>Accept</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>

    <h6>Tambahkan Item (Request): </h6>
    <h7>Nama Item : </h7><input type="text" id="tambahNamaItemReq"><br><br>
    <h7>Satuan : </h7>
    <select id="showSatuanEdit" style='width: 200px;'>
    </select><br>
    <select id="showAllOutlet" style='width: 200px;'>
    </select><br><br>
    <button onclick="sendRevisiItem()">Send Item</button><br><br>

    <h7>Pilih Brand Untuk Menampilkan Item : </h7><br><br>
    <select id="showBrandItem" style='width: 200px;'>
    </select>
    <button onclick="getItemBrand()">Pilih Brand</button><br><br>
    <h6>Brand Yang Dipilih : </h6>
    <h6 id="selectedBrand"></h6><br>

    <h7>Item Yang Tersedia Di Brand Ini : </h7><br><br>
    <div id="BrandItem"></div><br><br>


    <h7>Tambahkan Item Pada Brand Ini : </h7><br>
    <select id="showAllItem" style='width: 200px;'>
    </select>
    <button onclick="sendItemOnBrand()">Add Item</button><br><br>

    <h7>Hapus Item Pada Brand Ini : </h7><br>
    <select id="showItemOnBrand" style='width: 200px;'>
    </select>
    <button onclick="sendTypeDelOnBrand()">Del Item</button><br><br>

    <script>
        // Initialize select2
        $("#showBrandItem").select2(); //css untuk dropdown
        $("#showAllItem").select2();
        $("#showItemOnBrand").select2();

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
                url: "{{ url('pattyCash/items/store/revision/request') }}",
                type: 'get',
                data: {
                    status: status,
                    idRev: idRev,
                },
                success: function(response) {
                    getListAllRevision();
                    getListAllItem();
                    getItemBrand();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getAllSatuan() {
            $.ajax({
                url: "{{ url('show/satuan') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dataDropdown = '';
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.dataItem[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.dataItem[i].Satuan;
                        dataDropdown += '</option>';
                    }
                    $('#showSatuanEdit').empty().append(dataDropdown);
                    $('#showSatuanAdd').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getItemBrand() {
            var idBrandSelect = $('#showBrandItem').val();
            document.getElementById('selectedBrand').innerHTML = $('#showBrandItem option:selected').text() + ' id= ' +
                $('#showBrandItem').val();
            $.ajax({
                url: "{{ url('pattyCash/brand/show/item') }}",
                type: 'get',
                data: {
                    idBrand: idBrandSelect,
                },
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    // console.log(obj);
                    var dataDropdown = '';
                    var items = '';
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        items += obj.dataItem[i].Item + ' | ';
                        dataDropdown += '<option value=';
                        dataDropdown += obj.dataItem[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.dataItem[i].Item;
                        dataDropdown += '</option>';
                    }
                    document.getElementById('BrandItem').innerHTML = items;
                    $('#showItemOnBrand').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendTypeDelOnBrand(){
            $.ajax({
                url: "{{ url('pattyCash/brands/item/del') }}",
                type: 'get',
                data: {
                    idBrand: $('#showBrandItem').val(),
                    idListItem: $('#showItemOnBrand').val()
                },
                success: function(response) {
                    getItemBrand();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendAddItem() {
            $.ajax({
                url: "{{ url('pattyCash/items/store') }}",
                type: 'get',
                data: {
                    item: document.getElementById('tambahNamaItem').value,
                    idSatuan: $('#showSatuanAdd').val(),
                },
                success: function(response) {
                    getListAllItem();
                    document.getElementById('tambahNamaItem').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendRevisiItem() {
            $.ajax({
                url: "{{ url('pattyCash/items/store/revision') }}",
                type: 'get',
                data: {
                    Item: document.getElementById('tambahNamaItemReq').value,
                    idSatuan: $('#showSatuanEdit').val(),
                    idOutlet: $('#showAllOutlet').val()
                },
                success: function(response) {
                    getListAllRevision();
                    document.getElementById('tambahNamaItemReq').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendItemOnBrand(){
            $.ajax({
                url: "{{ url('pattyCash/brands/store/item') }}",
                type: 'get',
                data: {
                    idBrand: $('#showBrandItem').val(),
                    idListItem: $('#showAllItem').val()
                },
                success: function(response) {
                    getItemBrand();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getListAllRevision() {
            $.ajax({
                url: "{{ url('pattyCash/items/show/revisi') }}",
                type: 'get',
                success: function(response) {
                    var order_data = '';
                    var obj = JSON.parse(JSON.stringify(response));
                    // console.log(obj);
                    for (var i = 0; i < obj.listPattyCash.length; i++) {
                        order_data += '<tr>';
                        order_data += '<td>';
                        order_data += obj.listPattyCash[i].Item;
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += obj.listPattyCash[i].Satuan;
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += obj.listPattyCash[i].Outlet;
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += obj.listPattyCash[i].Brand;
                        order_data += '</td>';
                        order_data +=
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Accept" id="a' +
                            obj.listPattyCash[i].id + '">&#xe5ca;</i></a></td>';
                        order_data +=
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" id="b' +
                            obj.listPattyCash[i].id + '">&#xe14c;</i></a></td>';
                        order_data += '</tr>';
                    }
                    $('#revisionTable>tbody').empty().append(order_data);

                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getListAllBrand() {
            $.ajax({
                url: "{{ url('pattyCash/brand/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.brand.length; i++) {
                        // console.log(obj.brand[i].Satuan);
                        dataDropdown += '<option value=';
                        dataDropdown += obj.brand[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.brand[i].namaBrand;
                        dataDropdown += '</option>';
                    }
                    $('#showBrandItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getListAllOutlet() {
            $.ajax({
                url: "{{ url('pattyCash/outlet/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataDropdown = '';
                    for (var i = 0; i < obj.Outlet.length; i++) {
                        // console.log(obj.Outlet[i].id);
                        dataDropdown += '<option value=';
                        dataDropdown += obj.Outlet[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.Outlet[i].namaOutlet;
                        dataDropdown += '</option>';
                    }
                    $('#showAllOutlet').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getListAllItem() {
            $.ajax({
                url: "{{ url('pattyCash/items/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var item = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.listPattyCash.length; i++) {
                        item += obj.listPattyCash[i].Item + ' ' + obj.listPattyCash[i].Satuan + ' | ';
                        // console.log(obj.listPattyCash[i].Satuan);

                        dataDropdown += '<option value=';
                        dataDropdown += obj.listPattyCash[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.listPattyCash[i].Item;
                        dataDropdown += '</option>';
                    }
                    document.getElementById("showItem").innerHTML = item;
                    $('#showAllItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        $(document).ready(function() {
            getListAllItem();
            getListAllBrand();
            getListAllOutlet();
            getListAllRevision();
            getAllSatuan();
        })
    </script>

</body>

</html>
