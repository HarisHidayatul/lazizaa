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

    <script>
        var idSo = 0;
        var itemTable = [];

        function refreshFillTable() {
            $.ajax({
                url: 'soFill/show/' + {{ $idPengisi }},
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var table = document.getElementById('filltable');
                    var obj = JSON.parse(JSON.stringify(response));
                    // console.log(obj.itemfso.length);
                    var headTable = '<tr>';
                    var dataTable = '';
                    headTable += '<th>Tanggal</th>';
                    for (var i = 0; i < obj.itemfso.length; i++) {
                        for (var j = 0; j < obj.itemfso[i].Item.length; j++) {
                            if (!searchDataId(obj.itemfso[i].Item[j].idItem)) {
                                itemTable.push(obj.itemfso[i].Item[j].idItem);
                                headTable += '<th>';
                                headTable += obj.itemfso[i].Item[j].item;
                                headTable += '</th>';
                            }
                        }
                    }
                    headTable += '</tr>';

                    for (var i = 0; i < obj.itemfso.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.itemfso[i].Tanggal;
                        dataTable += '</td>';
                        console.log(obj.itemfso.length);
                        for (var j = 0; j < itemTable.length; j++) {
                            // console.log(obj.itemfso[i].Item.length);
                            var dataFound = false;
                            dataTable += '<td>';
                            for (var k = 0; k < obj.itemfso[i].Item.length; k++) {
                                if (itemTable[j] == obj.itemfso[i].Item[k].idItem) {
                                    dataFound = true;
                                    dataTable += obj.itemfso[i].Item[k].qty;
                                } else {
                                    // dataTable += 0;
                                }
                            }
                            if(!dataFound){
                                dataTable += 0;
                            }
                            dataTable += '</td>';
                        }
                        dataTable += '</tr>';
                    }

                    // console.log(obj.itemfso[0].Item[0].idItem);
                    // console.log(obj.itemfso[1].Tanggal);
                    $('#filltable>thead').append(headTable);
                    $('#filltable>tbody').append(dataTable);


                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function searchDataId(search) {
            for (var i = 0; i < itemTable.length; i++) {
                if (itemTable[i] == search) {
                    return true;
                }
            }
            return false;
        }
        $(document).ready(function() {
            refreshFillTable();
            $.ajax({
                'url': 'getItemSO',
                'type': 'GET',
                success: function(response) {
                    console.log(response);
                    var dataDropdown = '';
                    var obj = JSON.parse(JSON.stringify(response));
                    // console.log(obj.countItem);
                    for (var i = 0; i < obj.itemSO.length; i++) {
                        var itemSO = obj.itemSO[i];
                        dataDropdown += '<option value=';
                        dataDropdown += itemSO.id;
                        dataDropdown += ' data-id=';
                        dataDropdown += itemSO.Satuan;
                        dataDropdown += '>';
                        dataDropdown += itemSO.item;
                        dataDropdown += '</option>';
                        // console.log(itemSO.id);
                        // console.log(itemSO.item);
                    }
                    $('#selUser').append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            });

            // Initialize select2
            $("#selUser").select2(); //css untuk dropdown

            // Read selected option
            $('#but_read').click(function() {
                var nameList = $('#selUser option:selected').text();
                var userid = $('#selUser').val();
                var Satuan = $('#selUser option:selected').attr("data-id");
                var numberInput = $('#numberInput').val();
                var check_value = $('#maintable>tbody').find("tr").data('id');
                if (check_value == userid) {
                    alert("Item ini ada dalam tabel. Hapus list untuk memperbaiki data");
                } else {
                    var numberInput2 = parseInt(numberInput);
                    if (Number.isInteger(numberInput2)) {
                        addTempData(nameList, userid, Satuan, numberInput2);
                    }
                }
                document.getElementById('numberInput').value = 0;
            });
            $('#send_data').click(function() {
                $.ajax({
                    url: 'fsoh/getId',
                    type: 'get',
                    data: {
                        tanggal: document.getElementById('dateAdd').value,
                        idPengisi: {{ $idPengisi }}
                    },
                    success: function(response) {
                        // console.log(response);
                        idSo = response;
                        sendDataToServer(idSo);
                    },
                    error: function(req, err) {
                        console.log(err);
                    }
                });
            });
            $(document).on("click", "[id^=b]", function(event, ui) {
                //function for delete (when clicked)
                var id = parseInt(this.id.substring(1));
                if (Number.isInteger(id)) {
                    var table = document.getElementById('maintable');
                    var selectedDelete = 0;
                    for (var i = 0; i < table.rows.length; i += 1) {
                        // console.log(i);
                        var dataId = parseInt(table.rows[i].cells[0].getAttribute("data-id"));
                        if (Number.isInteger(dataId)) {
                            if (dataId == id) {
                                table.deleteRow(selectedDelete + 1);
                            }
                            selectedDelete += 1;
                            // console.log(dataId);
                        }
                    }
                    // console.log(id);
                }
            });
        });

        function sendDataToServer(idSo2) {
            var selectedSend = 0;
            var table = document.getElementById('maintable');
            for (var i = 0; i < table.rows.length; i += 1) {
                // console.log(i);
                var dataId = parseInt(table.rows[i].cells[0].getAttribute("data-id"));
                var isSuccess = false;
                if (Number.isInteger(dataId)) {
                    // console.log('Data id = ' + dataId + ' value = ' +
                    //     table.rows[i].cells[1].innerHTML + ' idSo = '+idSo2);
                    $.ajax({
                        url: 'soFill/store',
                        type: 'get',
                        data: {
                            idSo: idSo2,
                            idItemSo: dataId,
                            quantity: table.rows[i].cells[1].innerHTML
                        },
                        success: function(response) {
                            console.log(response);
                            isSuccess = true;
                        },
                        error: function(req, err) {
                            console.log(err);
                        }
                    });
                    table.deleteRow(selectedSend + 1);
                    selectedSend += 1;
                    // console.log(dataId);
                }
            }


        }

        function addTempData(nameList, userid, Satuan, numberInput) {
            var dataTableInput = '';
            dataTableInput += '<tr data-id='
            dataTableInput += userid;
            dataTableInput += '>';
            dataTableInput += '<td data-id=';
            dataTableInput += userid;
            dataTableInput += '>';
            dataTableInput += nameList;
            dataTableInput += '</td>';
            dataTableInput += '<td>';
            dataTableInput += numberInput;
            dataTableInput += '</td>';
            dataTableInput += '<td>';
            dataTableInput += Satuan;
            dataTableInput += '</td>';
            dataTableInput +=
                '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" id="b' +
                userid + '">&#xE872;</i></a></td>';
            dataTableInput += '</tr>';
            $('#maintable>tbody').append(dataTableInput);
            $('#result').html("id : " + userid + ", name : " + nameList + ", satuan : " + Satuan);
        }
    </script>
</head>

<body>
    <!-- Dropdown -->
    <input type="date" id="dateAdd" class="form-control" value='{{ $tanggal }}' required>

    <select id='selUser' style='width: 200px;'>
    </select>

    <input type='button' value='Seleted option' id='but_read'>
    <br />
    <input type='number' value="0" id="numberInput">
    <br />
    <div id='result'></div>
    <br />
    <table class="table table-striped table-hover" id="maintable">
        <thead>
            <tr>
                <th>Item</th>
                <th>Value</th>
                <th>Satuan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <input type='button' value='Send Data' id='send_data'>

    <table class="table table-striped table-hover" id="filltable">
        <thead>

        </thead>
        <tbody>
        </tbody>
    </table>

</body>

</html>
