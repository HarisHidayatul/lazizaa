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
    <title>Document</title>
    <style>
        .tittle {
            margin-top: 30px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 20px;
            line-height: 140%;
        }

        input {
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            height: 41px;
            width: 40vw;
            max-width: 135px;
            padding: 0 10px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 13.4367px;
            line-height: 140%;
        }

        input::placeholder {
            color: #E0E0E0;
        }

        .itemSetting {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            color: #585858;
            margin-bottom: 3px;
            margin-top: 20px;
        }

        .button {
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            border-radius: 8px;
            height: 44px;
            width: 40vw;
            max-width: 135px;

            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
        }

        .reset {
            color: #B20731;
            background: #FFACC0;
        }

        .selesai {
            color: #FFFFFF;
            background: #B20731;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center">
        <div>
            <div class="d-flex justify-content-center tittle">Setting SO</div>
            <div style="height: 15px;"></div>
            {{-- <div class="d-flex justify-content-between">
                <div>
                    <div class="itemSetting">Beras</div>
                    <input type="number" placeholder="gr">
                </div>
                <div style="width: 20px;"></div>
                <div>
                    <div class="itemSetting">Milo</div>
                    <input type="number" placeholder="gr">
                </div>
            </div> --}}
            <div id="dataAllSO"></div>
            <div style="height: 55px;"></div>
            <div class="d-flex justify-content-between">
                <div class="d-flex justify-content-center align-items-center button reset" onclick="goToSoHarian();">
                    Cancel</div>
                <div style="width: 20px;"></div>
                <div class="d-flex justify-content-center align-items-center button selesai"
                    onclick="checkAndSendItem();">Selesai</div>
            </div>
            <div style="height: 55px;"></div>
        </div>
    </div>
</body>
<script>
    var objItemSo = null;
    var objFillSo = null;
    var dataSend = [];
    var loopData = 0;
    $(document).ready(function() {
        showItemOutlet("{{ session('idOutlet') }}");
    })

    function goToSoHarian() {
        window.location.href = "{{ url('user/soHarian') }}" + '/' + "{{ $dateSelect }}";
    }

    function checkAndSendItem() {
        // do{}
        var allElementSend = [];
        loopData = 0;
        dataSend.length = 0;
        for (var i = 0; i < objItemSo.DataItem.length; i++) {
            var valueInput = document.getElementsByName('inputSO')[i]?.value;
            var j = 0;
            var datafound = false;
            for (j = 0; j < objFillSo.dataSo.length; j++) {
                if (objItemSo.DataItem[i].id == objFillSo.dataSo[j].idItem) {
                    datafound = true;
                    break;
                }
            }
            if (datafound) {
                var valueSoReq = objFillSo.dataSo[j].quantity;
                if (valueInput != valueSoReq) {
                    if (valueInput != '') {
                        dataSend.push([objItemSo.DataItem[i].id, valueInput]);
                        continue;
                    }
                }
            } else {
                if (valueInput != '') {
                    dataSend.push([objItemSo.DataItem[i].id, valueInput]);
                }
            }
        }
        console.log(dataSend);
        var countDataSend = dataSend.length;
        var i = 0;
        for (i = 0; i < countDataSend; i++) {
            allElementSend.push({
                idPengisi: "{{ session('idPengisi') }}",
                quantity: dataSend[i % countDataSend][1],
                idItemSo: dataSend[i % countDataSend][0]
            });
        }
        $.ajax({
            url: "{{ url('soHarian/setting/soBatas/store') }}" + '/' + "{{ session('idOutlet') }}",
            type: 'get',
            data: {
                allElementSend: allElementSend
            },
            success: function(response) {
                console.log(response);
                goToSoHarian();
            },
            error: function(req, err) {
                console.log(err);
            }
        });
        // console.log('.');
    }


    function showAllFillItem(id) {
        $.ajax({
            url: "{{ url('soHarian/setting/soBatas/show') }}" + '/' + id,
            type: 'get',
            success: function(response) {
                var obj = JSON.parse(JSON.stringify(response));
                console.log(obj);
                objFillSo = obj;
                for (var i = 0; i < obj.dataSo.length; i++) {
                    var j = 0;
                    var datafound = false;
                    for (j = 0; j < objItemSo.DataItem.length; j++) {
                        if (obj.dataSo[i].idItem == objItemSo.DataItem[j].id) {
                            datafound = true;
                            break;
                        }
                    }
                    if (datafound) {
                        document.getElementsByName('inputSO')[j].value = obj.dataSo[i].quantity;
                    }
                }
            },
            error: function(req, err) {
                // console.log(err);
            }
        });
    }

    function showItemOutlet(id) {
        $.ajax({
            url: "{{ url('listType/soHarian/show/item/outlet/') }}" + '/' + id,
            type: 'get',
            data: {
                tanggal: "{{ $dateSelect }}"
            },
            success: function(response) {
                var inputDataSO = '';
                var tempDataSO = '';
                var obj = JSON.parse(JSON.stringify(response));
                objItemSo = obj;
                console.log(obj);
                var i = 0;
                for (i = 0; i < obj.DataItem.length; i++) {
                    if ((i % 2) != 0) {
                        inputDataSO += '<div class="d-flex justify-content-between">';
                        inputDataSO += tempDataSO;
                        inputDataSO += '<div style="width: 20px;"></div>';
                        inputDataSO += '<div><div class="itemSetting">';
                        inputDataSO += obj.DataItem[i].Item;
                        inputDataSO += '</div><input name="inputSO" type="number" placeholder="';
                        inputDataSO += obj.DataItem[i].satuan;
                        inputDataSO += '"></div></div>';
                        tempDataSO = '';
                    } else {
                        tempDataSO += '<div><div class="itemSetting">';
                        tempDataSO += obj.DataItem[i].Item;
                        tempDataSO += '</div><input name="inputSO" type="number" placeholder="';
                        tempDataSO += obj.DataItem[i].satuan;
                        tempDataSO += '"></div>';
                    }
                }
                if ((i % 2) != 0) {
                    inputDataSO += tempDataSO;
                }
                document.getElementById('dataAllSO').innerHTML = inputDataSO;
                showAllFillItem("{{ session('idOutlet') }}");
            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }
</script>

</html>
