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
    <h6>Tambahkan Item: </h6>
    <h7>Nama Item : </h7><input type="text" id="tambahNamaItem"><br><br>
    <h7>Satuan : </h7><br>
    <select id="showSatuanAdd" style='width: 200px;'>
    </select><br>
    <button onclick="sendAddItem()">Send Item</button><br><br>

    <h6>Tambahkan Tipe : </h6>
    <h7>Nama Item : </h7><input type="text" id="tambahType"><br><br>
    <button onclick="sendAddType()">Send Type</button><br><br>

    <h6>Nama Type Yang Tersedia : </h6>
    <div id="showType"></div>
    <h6>Pilih Type: </h6>
    <select id='selType' style='width: 200px;'>
    </select>
    <button onclick="setType()">Pilih Type</button><br><br>

    <h7>Nama Type : </h7>
    <div id="typeselect"></div>
    <h7>Item Didalam Type Ini : </h7>
    <div id="typeItem"></div><br><br>

    <h7>Tambahkan Item Didalam Tipe Ini : </h7><br><br>
    <select id='selItemOnType' style='width: 200px;'>
    </select>
    <button id="ItemAddOnType" onclick="sendItemOnType()" disabled>Add Item</button><br><br>

    <h7>Hapus Item Didalam Tipe Ini : </h7><br><br>
    <select id='delItemOnType' style='width: 200px;'>
    </select>
    <button id="ItemDelOnType" onclick="delItemOnTypeBtn()" disabled>Del Item</button><br><br>

    <h7>Outlet Yang Menggunakan Tipe Ini : </h7><br><br>
    <div id="outletType""></div><br>
    <h7>Tambahkan Outlet Yang Menggunakan Tipe Ini : </h7><br>
    <select id="showOutlet" style='width: 200px;'>
    </select>
    <button id="buttonAddOutletType" onclick="sendOutletOnType()" disabled>Add Outlet</button><br><br>

    <h7>Hapus Outlet Yang Menggunakan Tipe Ini : </h7><br>
    <select id="showOutletDel" style='width: 200px;'>
    </select>
    <button id="buttonDelOutletType" onclick="sendOutletDelOnType()" disabled>Hapus Outlet</button><br><br>
    <br><br>
    <h7>Pilih Outlet Untuk Menampilkan Item dan Type : </h7><br><br>
    <select id="showOutletItem" style='width: 200px;'>
    </select>
    <button onclick="getItemOutlet()">Pilih Outlet</button><br><br>
    <h6>Outlet Yang Dipilih : </h6>
    <h6 id="selectedOutlet"></h6><br>

    <h7>Tipe Yang Ada Didalam Outlet Ini : </h7><br><br>
    <div id="outletTypeOnItem"></div><br>
    <h7>Item Yang Tersedia Di Outlet Ini : </h7><br><br>
    <div id="outletItem"></div><br><br>


    <h7>Tambahkan Type Pada Outlet Ini : </h7><br>
    <select id="showAllType" style='width: 200px;'>
    </select>
    <button onclick="sendTypeOnOutlet()">Add Type</button><br><br>

    <h7>Hapus Type Pada Outlet Ini : </h7><br>
    <select id="showTypeOnOutlet" style='width: 200px;'>
    </select>
    <button onclick="sendTypeDelOnOutlet()">Del Type</button><br><br>

    <script>
        // Initialize select2
        $("#selType").select2(); //css untuk dropdown
        $("#selItemOnType").select2();
        $("#delItemOnType").select2();

        function getItemOutlet() {
            var outletList = $('#showOutletItem option:selected').text();
            var outletId = $('#showOutletItem').val();
            document.getElementById("selectedOutlet").innerHTML = outletList + " id = " + outletId;

            var idOutlets = $('#showOutletItem').val();
            showItemOutlet(idOutlets);
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
                    $('#showSatuanAdd').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }


        function sendOutletDelOnType() {
            if ($('#showOutletDel').val() != null) {
                delType($('#selType').val(), $('#showOutletDel').val())
            }
        }
        function sendTypeDelOnOutlet(){
            if ($('#showTypeOnOutlet').val() != null) {
                delType($('#showTypeOnOutlet').val(), $('#showOutletItem').val())
            }
        }

        function delType(idType, idOutlet) {
            $.ajax({
                url: "{{ url('listType/soHarian/delete/outletOnType') }}",
                type: 'get',
                data: {
                    idType: idType,
                    idOutlet: idOutlet,
                },
                success: function(response) {
                    setType();
                    getItemOutlet();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function delItemOnTypeBtn() {
            if ($('#delItemOnType').val() != null) {
                $.ajax({
                    url: "{{ url('listType/soHarian/delete/itemOnType') }}",
                    type: 'get',
                    data: {
                        idType: $('#selType').val(),
                        idItem: $('#delItemOnType').val(),
                    },
                    success: function(response) {
                        setType();
                    },
                    error: function(req, err) {
                        console.log(err);
                    }
                });
            }
        }

        function showItemOutlet(id) {
            $.ajax({
                url: "{{ url('listType/soHarian/show/item/outlet/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataItem = '';
                    var dataType = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.DataItem.length; i++) {
                        dataItem += obj.DataItem[i]['Item'] + ' | ';
                    }
                    for (var j = 0; j < obj.Type.length; j++) {
                        dataType += obj.Type[j]['type'] + ' | ';

                        dataDropdown += '<option value=';
                        dataDropdown += obj.Type[j].id;
                        dataDropdown += '>';
                        dataDropdown += obj.Type[j].type;
                        dataDropdown += '</option>';
                        // console.log(obj.Type[j]);
                    }

                    $('#showTypeOnOutlet').empty().append(dataDropdown);

                    document.getElementById('outletTypeOnItem').innerHTML = dataType;
                    document.getElementById('outletItem').innerHTML = dataItem;
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
                    $('#showOutlet').empty().append(dataDropdown);
                    $('#showOutletItem').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getListAllItem() {
            $.ajax({
                url: "{{ url('itemSO/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var item = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.itemSO.length; i++) {
                        item += obj.itemSO[i].item + ' ' + obj.itemSO[i].Satuan + ' | ';
                        // console.log(obj.itemSO[i].Satuan);

                        dataDropdown += '<option value=';
                        dataDropdown += obj.itemSO[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.itemSO[i].item;
                        dataDropdown += '</option>';
                    }
                    document.getElementById("showItem").innerHTML = item;
                    $('#selItemOnType').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function getTypeOutlet(id) {
            $.ajax({
                url: "{{ url('listType/soHarian/show/outlet/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataOutlet = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.OutletData.length; i++) {
                        dataOutlet += ' | ' + obj.OutletData[i].Outlet;

                        dataDropdown += '<option value=';
                        dataDropdown += obj.OutletData[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.OutletData[i].Outlet;
                        dataDropdown += '</option>';
                    };
                    document.getElementById('outletType').innerHTML = dataOutlet;
                    $('#showOutletDel').empty().append(dataDropdown);
                }
            });
        }

        function getTypeItem(id) {
            $.ajax({
                url: "{{ url('listType/soHarian/show/item/') }}" + '/' + id,
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataItem = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.itemfso.length; i++) {
                        dataItem += ' | ' + obj.itemfso[i].Item;
                        dataDropdown += '<option value=';
                        dataDropdown += obj.itemfso[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.itemfso[i].Item;
                        dataDropdown += '</option>';
                    };
                    document.getElementById('typeItem').innerHTML = dataItem;
                    $('#delItemOnType').empty().append(dataDropdown);
                }
            });
        }

        function sendAddItem() {
            $.ajax({
                url: "{{ url('itemSO/store') }}",
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

        function sendItemOnType() {
            var idTypes = $('#selType').val();
            var idItems = $('#selItemOnType').val();
            $.ajax({
                url: "{{ url('listType/soHarian/store/item') }}",
                type: 'get',
                data: {
                    idType: idTypes,
                    idItem: idItems,
                },
                success: function(response) {
                    getTypeItem(idTypes);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendOutletOnType() {
            sendType($('#selType').val(),$('#showOutlet').val());
        }
        function sendTypeOnOutlet(){
            sendType($('#showAllType').val(),$('#showOutletItem').val());
        }
        function sendType(idType,idOutlet){
            $.ajax({
                url: "{{ url('listType/soHarian/store/outlet') }}",
                type: 'get',
                data: {
                    idType: idType,
                    idOutlet: idOutlet,
                },
                success: function(response) {
                    var typeId = $('#selType').val();
                    getTypeOutlet(typeId);
                    getItemOutlet();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }


        function getListAllType() {
            $.ajax({
                url: "{{ url('listType/soHarian/show') }}",
                type: 'get',
                success: function(response) {
                    // console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var type = '';
                    var dataDropdown = '';
                    for (var i = 0; i < obj.listType.length; i++) {
                        type += obj.listType[i].type + ' | ';
                        var listType = obj.listType[i];
                        dataDropdown += '<option value=';
                        dataDropdown += listType.id;
                        dataDropdown += '>';
                        dataDropdown += listType.type;
                        dataDropdown += '</option>';

                    }
                    $('#selType').empty().append(dataDropdown);

                    $('#showAllType').empty().append(dataDropdown);

                    document.getElementById("showType").innerHTML = type;
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function sendAddType() {
            $.ajax({
                url: "{{ url('listType/soHarian/store') }}",
                type: 'get',
                data: {
                    NamaType: document.getElementById('tambahType').value,
                },
                success: function(response) {
                    getListAllType();
                    document.getElementById('tambahType').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function setType() {
            var nameList = $('#selType option:selected').text();
            var typeId = $('#selType').val();
            document.getElementById('typeselect').innerHTML = (nameList + ' id = ' + typeId);
            document.getElementById('ItemAddOnType').disabled = false;
            document.getElementById('buttonAddOutletType').disabled = false;
            document.getElementById('ItemDelOnType').disabled = false;
            document.getElementById('buttonDelOutletType').disabled = false;
            getTypeItem(typeId);
            getTypeOutlet(typeId);
        }

        $(document).ready(function() {
            getListAllItem();
            getListAllType();
            showOutlet();
            getAllSatuan();
        })
    </script>

</body>

</html>
