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
    <div>Pilih type bank yang tersedia : </div><br>
    <div id="typeBank"></div><br>
    <div>Bank yang terdapat dalam type ini : </div><br>
    <div id="listBank"></div><br>

    {{-- <div>Tambahkan bank di type ini : </div>
    <input type="text" placeholder="Tuliskan nama bank">
    <input type="text" placeholder="Masukkan lokasi file image bank" style="width: 100%;">
    <button>Submit</button> --}}


    <div>Tambah pengirim : </div>
    <input type="radio" id="transfer2" name="jenisTransaksi2" value="1" onclick="typeTransaksi2(1)"><label for="transfer2">transfer</label>
    <input type="radio" id="eWallet2" name="jenisTransaksi2" value="2" onclick="typeTransaksi2(2)"><label for="eWallet2">eWallet</label><br>
    <select name="" id="selectBankPengirim">
        <option value="">Select Bank</option>
    </select><br>
    <input type="text" placeholder="nama rekening">
    <input type="number" placeholder="nomer rekening"><br>
    <select name="" id="userAll">
        <option value="">Select User</option>
    </select><br>
    <button>Submit</button><br><br>

    <div>Tambah penerima : </div>
    <input type="radio" id="transfer3" name="jenisTransaksi3"><label for="transfer3">transfer</label>
    <input type="radio" id="eWallet3" name="jenisTransaksi3"><label for="eWallet3">eWallet</label><br>
    <select name="" id="">
        <option value="">Select Bank</option>
    </select><br>
    <input type="text" placeholder="nama rekening">
    <input type="number" placeholder="nomer rekening"><br>
    <button>Submit</button><br><br>

    <div>Tampilkan pengirim</div>
    <select name="" id="">
        <option value="">Nama Pengirim</option>
    </select>
    <button>Tampilkan</button>
    <div>Nama Pengisi : </div>
    <div>Nama Outlet : </div>
    <div>Bank : </div>
    <div>Nomor Rekening : </div>
    <div>ImageBank</div>
    <img src="" alt="">
</body>
<script>
    $(document).ready(function() {
        getTypeBank();
        getAllUser();
    });

    function getTypeBank() {
        $.ajax({
            url: "{{ url('setoran/bank/type/show') }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                var dataJenis = '';
                for (var i = 0; i < obj.jenis.length; i++) {
                    dataJenis += '<input type="radio" id="';
                    dataJenis += obj.jenis[i].jenis + '1';
                    dataJenis += '" name="jenisTransaksi1" value="';
                    dataJenis += obj.jenis[i].id + '"><label for="';
                    dataJenis += obj.jenis[i].jenis + '1';
                    dataJenis += '" onclick="typeTransaksi1(';
                    dataJenis += obj.jenis[i].id + ')">';
                    dataJenis += obj.jenis[i].jenis;
                    dataJenis += '</label>';
                    // console.log(obj.jenis[i]);
                }
                dataJenis += '<br>';
                document.getElementById('typeBank').innerHTML = dataJenis;
            },
            error: function(req, err) {
            }
        })
    }

    function getAllUser(){
        $.ajax({
            url: "{{ url('user/show/all') }}",
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var listUser = '';
                for (var i = 0; i < obj.user.length; i++) {
                    listUser += '<option value="' + obj.user[i].id;
                    listUser += '">' + obj.user[i].nama;
                    listUser += '</option>';
                }
                $('#userAll').empty().append(listUser);
            },
            error: function(req, err) {
            }
        })
    }
    
    function typeTransaksi1(id){
        // console.log(id);
        $.ajax({
            url: "{{ url('setoran/bank/show') }}" + '/' + id,
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var listBank = '';
                for (var i = 0; i < obj.listBank.length; i++) {
                    listBank += obj.listBank[i].bank + ' | ';
                }
                listBank += '<br>';
                document.getElementById('listBank').innerHTML = listBank;
            },
            error: function(req, err) {
            }
        })
    }

    function typeTransaksi2(id){
        $.ajax({
            url: "{{ url('setoran/bank/show') }}" + '/' + id,
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                var listBank = '';
                for (var i = 0; i < obj.listBank.length; i++) {
                    listBank += '<option value="' + obj.listBank[i].id;
                    listBank += '">' + obj.listBank[i].bank;
                    listBank += '</option>';
                }
                $('#selectBankPengirim').empty().append(listBank);
            },
            error: function(req, err) {
            }
        })
    }
</script>

</html>
