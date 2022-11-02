{{-- @dd($datafso) --}}
{{-- @dd($datafso[0]['Tanggal']) --}}
{{-- @dd($date) --}}
{{-- @dd($userID) --}}
{{-- @dd($datafso[1]->dUsers[0]['Username']); --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
            font-size: 13px;
        }

        .table-responsive {
            margin: 30px 0;
        }

        .table-wrapper {
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            min-width: 1000px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .table-title {
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            min-width: 100%;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }

        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }

        .table-title .btn-group {
            float: right;
        }

        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }

        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }

        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }
        table.table tr th,
        table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }
        table.table tr th:first-child {
            width: 60px;
        }

        table.table tr th:last-child {
            width: 100px;
        }

        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }

        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }

        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }

        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }

        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }

        table.table td a:hover {
            color: #2196F3;
        }

        table.table td a.edit {
            color: #FFC107;
        }

        table.table td a.delete {
            color: #F44336;
        }

        table.table td i {
            font-size: 19px;
        }

        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }

        .pagination {
            float: right;
            margin: 0 0 5px;
        }

        .pagination li a {
            border: none;
            font-size: 13px;
            min-width: 30px;
            min-height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 2px !important;
            text-align: center;
            padding: 0 6px;
        }

        .pagination li a:hover {
            color: #666;
        }

        .pagination li.active a,
        .pagination li.active a.page-link {
            background: #03A9F4;
        }

        .pagination li.active a:hover {
            background: #0397d6;
        }

        .pagination li.disabled i {
            color: #ccc;
        }

        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }

        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }

        /* Custom checkbox */
        .custom-checkbox {
            position: relative;
        }

        .custom-checkbox input[type="checkbox"] {
            opacity: 0;
            position: absolute;
            margin: 5px 0 0 3px;
            z-index: 9;
        }

        .custom-checkbox label:before {
            width: 18px;
            height: 18px;
        }

        .custom-checkbox label:before {
            content: '';
            margin-right: 10px;
            display: inline-block;
            vertical-align: text-top;
            background: white;
            border: 1px solid #bbb;
            border-radius: 2px;
            box-sizing: border-box;
            z-index: 2;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            content: '';
            position: absolute;
            left: 6px;
            top: 3px;
            width: 6px;
            height: 11px;
            border: solid #000;
            border-width: 0 3px 3px 0;
            transform: inherit;
            z-index: 3;
            transform: rotateZ(45deg);
        }

        .custom-checkbox input[type="checkbox"]:checked+label:before {
            border-color: #03A9F4;
            background: #03A9F4;
        }

        .custom-checkbox input[type="checkbox"]:checked+label:after {
            border-color: #fff;
        }

        .custom-checkbox input[type="checkbox"]:disabled+label:before {
            color: #b8b8b8;
            cursor: auto;
            box-shadow: none;
            background: #ddd;
        }

        /* Modal styles */
        .modal .modal-dialog {
            max-width: 400px;
        }

        .modal .modal-header,
        .modal .modal-body,
        .modal .modal-footer {
            padding: 20px 30px;
        }

        .modal .modal-content {
            border-radius: 3px;
            font-size: 14px;
        }

        .modal .modal-footer {
            background: #ecf0f1;
            border-radius: 0 0 3px 3px;
        }

        .modal .modal-title {
            display: inline-block;
        }

        .modal .form-control {
            border-radius: 2px;
            box-shadow: none;
            border-color: #dddddd;
        }

        .modal textarea.form-control {
            resize: vertical;
        }

        .modal .btn {
            border-radius: 2px;
            min-width: 100px;
        }

        .modal form label {
            font-weight: normal;
        }
    </style>
    <script>
        // var valIdDel = ""; //id for Delete -> b1,b2,b3,...
        // var valIdEdt = ""; //id for Edit   -> a1,a2,a3,...

        var data = new Array();
        

        var items = [
            [' 🍚Beras ', 'Beras'],
            [' 🍟French Fries ', 'FrenchFries'],
            [' 🍶Milo ', 'Milo'],
            [' 🍞Tepung Ori ', 'TepungOri'],
            [' 🥃Minyak Padat ', 'MinyakPadat'],
            [' 🐥Ayam Reg Besar ', 'AyamRegBesar'],
            [' 🐥Ayam Reg Kecil ', 'AyamRegKecil'],
            [' 🐥Ayam Utuh ', 'AyamUtuh'],
            [' 🐥Ayam Fillet ', 'AyamFillet'],
            [' 🐥Ayam Small ', 'AyamSmall'],
            [' 🐟Dori Triming ', 'DoriTriming'],
            [' 🌶Chili Sachet ', 'ChiliSachet'],
            [' 🍅Tomat Sachet ', 'TomatSachet'],
            [' 🔥Sambal Bawang ', 'SambalBawang'],
            [' 🔥Sambal Korek ', 'SambalKorek'],
            [' 🔥Sambal Bajak ', 'SambalBajak'],
            [' ♨️️Saus BBQ ', 'SausBBQ'],
            [' ♨️️Saus BP ', 'SausBP'],
            [' 🧱Lunch Box ', 'LunchBox'],
            [' 🍿Rame Box ', 'RameBox'],
            [' 🥡Box Geprek ', 'BoxGeprek'],
            [' 🍬Bubuk Candy ', 'BubukCandy'],
            [' 🍶Buble Gum ', 'BubleGum'],
            [' 🥛SKM ', 'SKM']
        ]

        @foreach ($datafso as $varobj)
            data.push({
                id: '{{ $varobj['id'] }}',
                Tanggal: '{{ $varobj['Tanggal'] }}',
                items: [
                    '{{ $varobj['Beras'] }}',
                    '{{ $varobj['French Fries'] }}',
                    '{{ $varobj['Milo'] }}',
                    '{{ $varobj['Tepung Ori'] }}',
                    '{{ $varobj['Minyak Padat'] }}',
                    '{{ $varobj['Ayam Reg Besar'] }}',
                    '{{ $varobj['Ayam Reg Kecil'] }}',
                    '{{ $varobj['Ayam Utuh'] }}',
                    '{{ $varobj['Ayam Fillet'] }}',
                    '{{ $varobj['Ayam Small'] }}',
                    '{{ $varobj['Dori Triming'] }}',
                    '{{ $varobj['Chili Sachet'] }}',
                    '{{ $varobj['Tomat Sachet'] }}',
                    '{{ $varobj['Sambal Bawang'] }}',
                    '{{ $varobj['Sambal Korek'] }}',
                    '{{ $varobj['Sambal Bajak'] }}',
                    '{{ $varobj['Saus BBQ'] }}',
                    '{{ $varobj['Saus BP'] }}',
                    '{{ $varobj['Lunch Box'] }}',
                    '{{ $varobj['Rame Box'] }}',
                    '{{ $varobj['Box Geprek'] }}',
                    '{{ $varobj['Bubuk Candy'] }}',
                    '{{ $varobj['Buble Gum'] }}',
                    '{{ $varobj['SKM'] }}',
                ]
            });
        @endforeach

        $(document).ready(function() {
            var index = 0;
            var order_data = '';
            $.each(data, function(key, value) {
                order_data += '<tr>';
                order_data += '<td>' + value.Tanggal.split("-").reverse().join("/") + '</td>';
                $.each(value.items, function(key2, value2) {
                    order_data += '<td>' + value2 + '</td>';
                })
                order_data +=
                    '<td><a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" id="a' +
                    index +
                    '">&#xE254;</i></a><a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" id="b' +
                    index + '">&#xE872;</i></a></td>';
                index = index + 1;
            });
            $('#maintable>tbody').append(order_data);
        });
        $(document).on("click", "[id^=b]", function(event, ui) {
            //function for delete (when clicked)
            // valIdDel = data[this.id.substring(1)].id;
            document.getElementById('idDel').setAttribute('value',data[this.id.substring(1)].id);
            // alert(valIdDel);
        })
        $(document).on("click", "[id^=a]", function(event, ui) {
            //function for edit (when clicked)
            // var valIdEdt = data[this.id.substring(1)].id;
            document.getElementById('idEdit').setAttribute('value',data[this.id.substring(1)].id);
            // alert(document.getElementById('idEdit').getAttribute('value'));
            document.getElementById('TanggalEdit').value = data[this.id.substring(1)].Tanggal;
            var itemsEdit2 = document.getElementsByName('itemsEdit');
            for (var i = 0; i < itemsEdit2.length; i++) {
                var a = itemsEdit2[i];
                a.value = data[this.id.substring(1)].items[i];
            }
        })

        function submitAdd() {
            $('#addEmployeeModal').modal('hide');//fungsi untuk menutup form
            var itemsAdd2 = document.getElementsByName('itemsAdd');
            $.ajax({
                url: 'inputfso',
                type: "get",
                data:{
                    UserId:{{ $userID }},
                    dUserOutlet:{{ $outletID }},
                    Tanggal: document.getElementById("dateAdd").value,
                    Beras: itemsAdd2[0].value,
                    FrenchFries: itemsAdd2[1].value,
                    Milo: itemsAdd2[2].value,
                    TepungOri: itemsAdd2[3].value,
                    MinyakPadat: itemsAdd2[4].value,
                    AyamRegBesar: itemsAdd2[5].value,
                    AyamRegKecil: itemsAdd2[6].value,
                    AyamUtuh: itemsAdd2[7].value,
                    AyamFillet: itemsAdd2[8].value,
                    AyamSmall: itemsAdd2[9].value,
                    DoriTriming: itemsAdd2[10].value,
                    ChiliSachet: itemsAdd2[11].value,
                    TomatSachet: itemsAdd2[12].value,
                    SambalBawang: itemsAdd2[13].value,
                    SambalKorek: itemsAdd2[14].value,
                    SambalBajak: itemsAdd2[15].value,
                    SausBBQ: itemsAdd2[16].value,
                    SausBP: itemsAdd2[17].value,
                    LunchBox: itemsAdd2[18].value,
                    RameBox: itemsAdd2[19].value,
                    BoxGeprek: itemsAdd2[20].value,
                    BubukCandy: itemsAdd2[21].value,
                    BubleGum: itemsAdd2[22].value,
                    SKM: itemsAdd2[23].value,
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(req,err) {
                    console.log(req);
                    // alert("Data Exist on Table");
                    $('#dataExistModal').modal('show');//fungsi untuk menampilkan form
                }
            })
        };
        
        function submitEdit() {
            $('#editEmployeeModal').modal('hide');//fungsi untuk menutup form
            var itemsEdit2 = document.getElementsByName('itemsEdit');
            $.ajax({
                url: 'editfso/'+document.getElementById('idEdit').getAttribute('value'),
                type: "get",
                data:{
                    // Tanggal: document.getElementById("dateAdd").value,
                    Beras: itemsEdit2[0].value,
                    FrenchFries: itemsEdit2[1].value,
                    Milo: itemsEdit2[2].value,
                    TepungOri: itemsEdit2[3].value,
                    MinyakPadat: itemsEdit2[4].value,
                    AyamRegBesar: itemsEdit2[5].value,
                    AyamRegKecil: itemsEdit2[6].value,
                    AyamUtuh: itemsEdit2[7].value,
                    AyamFillet: itemsEdit2[8].value,
                    AyamSmall: itemsEdit2[9].value,
                    DoriTriming: itemsEdit2[10].value,
                    ChiliSachet: itemsEdit2[11].value,
                    TomatSachet: itemsEdit2[12].value,
                    SambalBawang: itemsEdit2[13].value,
                    SambalKorek: itemsEdit2[14].value,
                    SambalBajak: itemsEdit2[15].value,
                    SausBBQ: itemsEdit2[16].value,
                    SausBP: itemsEdit2[17].value,
                    LunchBox: itemsEdit2[18].value,
                    RameBox: itemsEdit2[19].value,
                    BoxGeprek: itemsEdit2[20].value,
                    BubukCandy: itemsEdit2[21].value,
                    BubleGum: itemsEdit2[22].value,
                    SKM: itemsEdit2[23].value,
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(req,err) {
                    console.log(req);
                    // alert("Data Exist on Table");
                    // $('#dataExistModal').modal('show');//fungsi untuk menampilkan form
                }
            })
        };
        function deleteData(){
            $.ajax({
                url: 'delfso/'+document.getElementById('idDel').getAttribute('value'),
                type: "get",
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                },
                error: function(req,err) {
                    console.log(req);
                    // alert("Data Exist on Table");
                    // $('#dataExistModal').modal('show');//fungsi untuk menampilkan form
                }
            })
        }
    </script>
</head>

<body>
    <h3>User id : {{ $userID }}</h3>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Manage <b>Data</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Data</span></a>
                            <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i
                                    class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                        </div>
                    </div>
                </div>
                <div style="overflow-x: scroll;" >
                    <table class="table table-striped table-hover" id="maintable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>🍚 Beras</th>
                                <th>🍟 French Fries</th>
                                <th>🍶 Milo</th>
                                <th>🍞 Tepung Ori</th>
                                <th>🥃 Minyak padat</th>
                                <th>🐥 Ayam Reg Besar</th>
                                <th>🐥 Ayam Reg Kecil</th>
                                <th>🐥 Ayam Utuh</th>
                                <th>🐥 Ayam Fillet</th>
                                <th>🐥 Ayam Small</th>
                                <th>🐟 Dori triming</th>
                                <th>🌶 Chili Sachet</th>
                                <th>🍅 Tomat Sachet</th>
                                <th>🔥 Sambal Bawang</th>
                                <th>🔥 Sambal Korek</th>
                                <th>🔥 Sambal Bajak</th>
                                <th>♨️️ Saus BBQ</th>
                                <th>♨️️ Saus BP</th>
                                <th>🧱 Lunch Box</th>
                                <th>🍿 Rame Box</th>
                                <th>🥡 Box Geprek</th>
                                <th>🍬 Bubuk Candy</th>
                                <th>🍶 Buble gum</th>
                                <th>🥛 SKM</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                
                <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Add Data</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" id="dateAdd" class="form-control" value='{{ $date }}' required>
                        </div>
                        <div class="form-group">
                            <label>🍚 Beras</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍟 French Fries</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍶 Milo</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍞 Tepung Ori</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🥃 Minyak padat</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Reg Besar</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Reg Kecil</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Utuh</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Fillet</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Small</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐟 Dori triming</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🌶 Chili Sachet</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍅 Tomat Sachet</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🔥 Sambal Bawang</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🔥 Sambal Korek</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🔥 Sambal Bajak</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>♨️️ Saus BBQ</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>♨️️ Saus BP</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🧱 Lunch Box</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍿 Rame Box</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🥡 Box Geprek</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍬 Bubuk Candy</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍶 Buble Gum</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🥛 SKM</label>
                            <input type="number" name="itemsAdd" class="form-control" value="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        {{-- <input type="submit" class="btn btn-success" value="Add"> --}}
                        <input type="button" class="btn btn-info" value="Add" onclick="submitAdd()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Data</h4>
                        <div id="idEdit"></div>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" id="TanggalEdit" class="form-control" disabled="disabled" required>
                        </div>
                        <div class="form-group">
                            <label>🍚 Beras</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍟 French Fries</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍶 Milo</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍞 Tepung Ori</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🥃 Minyak padat</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Reg Besar</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Reg Kecil</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Utuh</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Fillet</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐥 Ayam Small</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🐟 Dori triming</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🌶 Chili Sachet</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍅 Tomat Sachet</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🔥 Sambal Bawang</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🔥 Sambal Korek</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🔥 Sambal Bajak</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>♨️️ Saus BBQ</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>♨️️ Saus BP</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🧱 Lunch Box</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍿 Rame Box</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🥡 Box Geprek</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍬 Bubuk Candy</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🍶 Buble Gum</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                        <div class="form-group">
                            <label>🥛 SKM</label>
                            <input type="number" name="itemsEdit" class="form-control" value="0" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-info" value="Save" onclick="submitEdit()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div id="idDel"></div>
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Data</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-danger" value="Delete" onclick="deleteData()">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="dataExistModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Replace Data</h4>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Data exist on database, do you want to replace?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-danger" value="Replace">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
