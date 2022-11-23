<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <title>Pembelian Harian</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap');

        .header {
            height: 50px;
            background: #B20731;
        }

        .imageBack {
            height: 15px;
        }

        .menuAll {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 10px;
        }

        h4 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #FFFFFF;
        }

        .laporanMenu {
            margin-top: 4px;
        }

        .imageProfile {
            border-radius: 32px;
            height: 32px;
            width: 32px;
        }

        .containerTop {
            margin-top: 100px;
            content: "";
            height: 50px;
        }

        /* .menuSel::before{
            content: "";
            background-color: white;
            height: 35px;
            width: 25px;
            display: flex;
            margin-top: 8px;
        } */
        .col {
            text-align: center;
            vertical-align: middle;
        }

        .headerTop {
            background-color: #B20731;
            border-radius: 8px;
            width: 350px;
        }

        .menuSel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Main color/Red/50 */

            /* color: #B20731; */
            color: #B20731;
            z-index: 0;
        }

        .menuSel::before {
            content: "";
            position: absolute;
            width: 75px;
            height: 40px;
            margin-top: 0px;
            margin-left: -8px;
            z-index: -1;
            /* Greyscale/10 */

            background: #FFFFFF;
            /* shadow/Very Soft */

            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.24), 0px 1.66512px 4.44032px -0.555039px rgba(50, 50, 71, 0.05);
            border-radius: 8px;
        }

        .menuNotSel {
            /* Semibold/SM */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Greyscale/10 */

            color: #FFFFFF;
        }

        .containerBottom {
            margin-top: 75px;
            /* height: 500px; */

            background: #FCFBFB;
            box-shadow: 0px 0px 0.555039px rgba(12, 26, 75, 0.1), 0px -2.22px 11.1008px -1.11008px rgba(50, 50, 71, 0.08);
            border-radius: 32px;
        }

        h3 {
            /* Semibold/Large */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
            /* identical to box height, or 28px */

            display: flex;
            align-items: center;
            text-align: center;

        }

        label {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 17px;
            line-height: 140%;
            /* identical to box height, or 20px */
            margin-top: 10px;

            color: #000000;
        }

        .btn {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* or 22px */
            color: #FFFFFF;
            background: #B20731;
            border-radius: 6px;
            width: 96px;
            height: 44px;
            /* margin-top: 50px; */
            float: right;
        }

        input[type='radio'] {
            visibility: hidden;
            cursor: pointer;
        }

        input[type='radio']:after {
            content: '';
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: 9px;
            left: -1px;
            position: absolute;
            /* display: inline-block; */
            visibility: visible;
            /* Greyscale/30 */

            border: 2px solid #BEBEBE;
        }

        input[type='radio']:checked::before {
            /* visibility: hidden; */
            content: '';
            width: 15px;
            height: 15px;
            border-radius: 15px;
            top: 9px;
            left: -1px;
            position: absolute;
            /* display: inline-block; */
            visibility: visible;
            /* Greyscale/30 */

            border: 2px solid #B20731;
        }

        input[type='radio']:checked:after {
            width: 7px;
            height: 7px;
            /* border-radius: 15px; */
            top: 12.5px;
            left: 2.5px;
            position: absolute;
            background-color: #B20731;
            content: '';
            border: none;
            display: inline-block;
            visibility: visible;
        }

        label[type='radio'] {

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Main color/Red/50 */
            cursor: pointer;
            color: #B20731;
        }

        input[type='text']:focus {
            border: 1.0663px solid #B20731;
            box-shadow: 0px 0px 0.394561px rgba(12, 26, 75, 0.24), 0px 1.18368px 3.15649px -0.394561px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
        }

        .radioCustom:checked~label {
            color: #B20731;
        }

        .radioCustom-label {
            /* Semibold/SM */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            margin-top: 8px;
            display: flex;
            color: #BEBEBE;
        }

        .selectSatuanContainer {
            overflow-y: auto;
            height: 100px;
            width: 88%;
            position: absolute;
            background-color: white;
            margin-top: 10px;
            /* right: 25px; */
            box-shadow: 0px 0px 0.761728px rgba(12, 26, 75, 0.1), 0px 3.04691px 15.2346px -1.52346px rgba(50, 50, 71, 0.08);
            border-radius: 10.9791px;
            z-index: 99;
        }

        .selectSatuanContainer::-webkit-scrollbar {
            width: 10px;
        }

        .selectSatuanContainer::-webkit-scrollbar-track {
            /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0); */
            background: #F1F1F1;
            border-radius: 10px;
            width: 3px;
        }

        .selectSatuanContainer::-webkit-scrollbar-thumb {
            border-radius: 10px;
            background: #B20731;
            /* -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0); */
        }

        .itemSelect {
            /* Regular/base */
            font-family: 'Montserrat';
            padding-top: 3px;
            height: 30px;
            font-style: normal;
            font-weight: 400;
            font-size: 16px;
            line-height: 140%;
            color: #585858;
            padding-left: 15px;
            cursor: pointer;
            margin-left: 5px;
            margin-right: 5px;
        }

        .itemSelect:hover {
            /* Semibold/base */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;

            /* Greyscale/60 */

            color: #585858;
            background: #FFEAEF;
            border-radius: 10.9791px;
        }

        .itemShow {
            width: 100%;
            height: 40px;
            background: #FFFFFF;
            margin-top: 10px;
            padding-top: 10px;
            padding-left: 15px;
            /* Main color/Red/50 */

            border: 1px solid #E0E0E0;
            border-radius: 8px;
            box-sizing: border-box;

            /* Semibold/SM */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */
            /* Greyscale/30 */
            color: #BEBEBE;
        }

        .itemLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            margin-top: 20px;
            margin-bottom: -5px;
            margin-left: 2px;
        }

        .jumlahLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            margin-top: 20px;
            margin-bottom: -5px;
            margin-left: 2px;

            color: #585858;
        }

        .namaItemReq {
            /* border-right: none; */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */


            /* Greyscale/20 */

            color: #E0E0E0;

            /* border: 1.0663px solid #E0E0E0; */
            box-shadow: 0px 0px 0.394561px rgba(12, 26, 75, 0.24), 0px 1.18368px 3.15649px -0.394561px rgba(50, 50, 71, 0.05);
            border-radius: 5.68696px;
        }

        .requestItem {
            /* Semibold/XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            margin-top: 15px;
            /* identical to box height */


            /* Main color/Red/50 */
            color: #B20731;

            cursor: pointer;
        }

        .menuDetail {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            font-size: 14px;
            line-height: 140%;
            margin-left: 0px;
            margin-top: 8px;
        }

        .jenisDetail {
            /* Semibold/2XS */

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 10px;
            line-height: 12px;
            margin-top: 5px;

            /* Greyscale/40 */
            margin-left: -9px;
            color: #9C9C9C;
        }

        .satuanDetail {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            color: #B20731;
            margin-top: 8px;
            text-align: end;
        }

        .rowDetail {
            background: #FFFFFF;
            /* Greyscale/20 */
            height: 65px;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            align-content: center;
            margin-top: 15px;
            cursor: pointer;
        }

        .container {
            /* width: 150px; */
        }
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <div class="row">
                <div class="col-2" data-toggle="modal" data-target="#exampleModal" onclick="goToDashboard();">
                    <img src="{{ url('img/back.png') }}" alt="back icon" class="imageBack">
                </div>
                <div class="col">
                    <h4 class="laporanMenu">Laporan harian</h4>
                </div>
            </div>
            <div>
                <img src="{{ url('img/dashboard/userIcon.jpg') }}" alt="user icon" class="imageProfile">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center containerTop">
        <div class="row headerTop">
            <div class="col menuNotSel" style="margin-top: 15px">SO</div>
            <div class="col menuNotSel" style="margin-top: 15px">Sales</div>
            <div class="col menuNotSel" style="margin-top: 15px">Waste</div>
            <div class="col menuSel" style="margin-top: 5px">Pembeli an</div>
        </div>
    </div>
    <div class="d-flex justify-content-center containerBottom">
        <div class="container" style="margin-left: 5px;margin-right: 10px">
            <h3 id="dateSelected" style="margin-top: 18px">Selasa, 1 November</h3>
            <div class="jumlahLabel">Request</div>
            <div style="content: '';height: 15px"></div>
            {{-- <div class="jumlahLabel">Nama Item</div> --}}
            <div class="d-flex justify-content-center">
                <div id="radioButtonUser"></div>
            </div>
            <div class="jumlahLabel">Nama Item</div>
            <div class="input-group mb-3" style="margin-top: 10px">
                <input type="text" class="form-control namaItemReq" placeholder="Masukkan nama item"
                    id="namaItemReq">
            </div>
            <div class="itemLabel">Satuan</div>
            {{-- <input type="text"> --}}
            <div class="itemShow" id="itemShow" onclick="itemShowClick();">Pilih satuan</div>
            <div class="selectSatuanContainer" id="selectSatuan">
                {{-- <div class="itemSelect" onclick="selectIndex(0)">AAAA</div> --}}
                <div id="itemAll"></div>
            </div>

            <div style="content: ''; height: 50px"></div>
            <div class="row">
                <div class="col-6 requestItem"></div>
                <div class="col-6"><button type="button" class="btn" onclick="sendRevisiItem()">Simpan</button>
                </div>
            </div>
            <div style="content: ''; height: 25px"></div>
            <h3 id="dateSelected2" style="margin-top: 18px">Selasa, 1 November</h3>
            {{-- <div style="content: ''; height: 25px"></div> --}}
            <div id="dataDetail"></div>
            <div style="content: ''; height: 50px"></div>
        </div>
    </div>
</body>
<script>
    var dataId = [];
    var idSo = 0;
    var dateSelected = "{{ $dateSelect }}";
    var dropdownItem = true;
    var selectJenisBrand = null;
    var selectSatuanIndex = null;

    var sendOrEdit = true; // true for send and edit for false

    var idWaste = 0;

    var idJenisBrand = [];
    var objItemBrand = [];
    var objItemEdit = [];
    var indexEdit = null;

    var satuanAll = [];

    let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    let days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

    function itemShowClick() {
        if (dropdownItem) {
            dropdownItem = false;
            document.getElementById('selectSatuan').style.visibility = "hidden";
        } else {
            dropdownItem = true;
            document.getElementById('selectSatuan').style.visibility = "visible";
        }
    }

    $(document).ready(function() {
        var day = new Date(dateSelected);
        var stringDay = days[day.getDay()] + ', ' + day.getDate() + ' ' + months[day.getMonth()];
        document.getElementById('dateSelected').innerHTML = stringDay;
        document.getElementById('dateSelected2').innerHTML = stringDay;

        dataId.length = 0;
        // console.log("{{ $dateSelect }}");

        itemShowClick();
        getAllSatuan();
        refreshData();
    });

    function goToDashboard() {
        window.location.href = "{{ url('user/pattyCashHarian') }}" + '/' + dateSelected;
    }

    function selectIndex(index) {
        // console.log(selectedIndex[index]);
        document.getElementById('itemShow').innerHTML = selectedIndex[index];
        itemShowClick();
    }

    function getAllSatuan() {
        $.ajax({
            url: "{{ url('show/satuan') }}",
            type: 'get',
            success: function(response) {
                // console.log(response);
                var obj = JSON.parse(JSON.stringify(response));
                // console.log(obj);
                var dataDropdown = '';
                satuanAll = obj.dataItem;
                for (var i = 0; i < obj.dataItem.length; i++) {
                    dataDropdown += '<div class="itemSelect" onclick="setDropDownSatuan(' + i;
                    // dataDropdown += obj.dataItem[i].id;
                    dataDropdown += ')">';
                    dataDropdown += obj.dataItem[i].Satuan;
                    dataDropdown += '</div>';
                }
                document.getElementById('itemAll').innerHTML = dataDropdown;
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function setDropDownSatuan(selectIndex) {
        console.log(satuanAll[selectIndex]);
        selectSatuanIndex = satuanAll[selectIndex]?.id;
        console.log(selectSatuanIndex);
        document.getElementById('itemShow').innerHTML = satuanAll[selectIndex]?.Satuan;
        itemShowClick();
    }

    function sendRevisiItem() {
        $.ajax({
            url: "{{ url('pattyCash/items/store/revision') }}",
            type: 'get',
            data: {
                Item: document.getElementById('namaItemReq').value,
                idSatuan: selectSatuanIndex,
                idOutlet: "{{ session('idOutlet') }}"
            },
            success: function(response) {
                refreshData();
                document.getElementById('namaItemReq').value = "";
            },
            error: function(req, err) {
                console.log(err);
            }
        })
    }

    function refreshData() {
        $.ajax({
            url: "{{ url('pattyCash/items/revisi/outlet') }}" + '/' + "{{ session('idOutlet') }}",
            type: 'get',
            success: function(response) {
                console.log(response);
                var dataDetail = '';
                var obj = JSON.parse(JSON.stringify(response));
                var urlImage = '{{ url('img/dashboard/laporanPattyCash.png') }}';
                var indexLoop = 0;
                objItemEdit.length = 0;
                for (var i = 0; i < obj.listPattyCash.length; i++) {
                    dataDetail += '<div class="row rowDetail" onclick="editItem(' +
                        indexLoop +
                        ');"><div class="col-2"><img src="';
                    dataDetail += urlImage;
                    dataDetail += '" alt="waste"style="height: 40px"></div>';
                    dataDetail +=
                        '<div class="col-5" style="margin-left: -10px;"><div class="row menuDetail">';
                    dataDetail += obj.listPattyCash[i].Item;
                    dataDetail += '</div><div class="row jenisDetail">';
                    // dataDetail += obj.listPattyCash[i].jenisBahan;
                    dataDetail += '</div></div><div class="col-5 satuanDetail">';
                    // dataDetail += obj.listPattyCash[i].qty;
                    // dataDetail += ' ';
                    dataDetail += obj.listPattyCash[i].Satuan;
                    dataDetail += '</div></div>';
                    indexLoop++;
                }
                document.getElementById('dataDetail').innerHTML = dataDetail;
                document.getElementById('namaItemReq').value = '';
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }

    function radioSelBrand(selectIndex) {
        //Off kan drop down dulu
        dropdownItem = false;
        document.getElementById('selectSatuan').style.visibility = "hidden";

        if (document.getElementById("radioBrand" + selectIndex) != null) {
            document.getElementById("radioBrand" + selectIndex).checked = true;
        }
        selectJenisBrand = selectIndex;
        console.log(selectJenisBrand);
    }
</script>

</html>
