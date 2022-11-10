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
    <title>SO Harian</title>
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
            margin-top: -10px;
            margin-left: -25px;
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
            height: 500px;

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

        .imgSo {
            border-right: none;
            background-color: white;
        }

        .imgSo::after {
            content: "";
            width: 1.5px;
            height: 20px;
            position: absolute;
            left: 38px;
            background-color: #9C9C9C;
        }

        .inputSo {
            border-left: none;
            border-right: none;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            color: #BEBEBE;
        }

        .inputSo::placeholder {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            color: #BEBEBE;
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

        .unitSo {
            border-left: none;
            background-color: white;

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
        .input-so{
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="fixed-top header">
        <div class="d-flex justify-content-between menuAll">
            <div class="row">
                <div class="col-2" data-toggle="modal" data-target="#exampleModal">
                    <img src="{{ url('img/back.png') }}" alt="back icon" class="imageBack">
                </div>
                <div class="col">
                    <h4 class="laporanMenu">Laporan Harian</h4>
                </div>
            </div>
            <div>
                <img src="{{ url('img/dashboard/userIcon.jpg') }}" alt="user icon" class="imageProfile">
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center containerTop">
        <div class="row headerTop">
            <div class="col menuSel" style="margin-top: 15px">SO</div>
            <div class="col menuNotSel" style="margin-top: 15px">Sales</div>
            <div class="col menuNotSel" style="margin-top: 15px">Waste</div>
            <div class="col menuNotSel" style="margin-top: 5px">Patty Cash</div>
        </div>
    </div>
    <div class="d-flex justify-content-start containerBottom">
        <div class="container" style="margin-left: 5px;margin-right: 10px">
            <h3 style="margin-top: 18px">Selasa, 1 November</h3>
            <h3 style="margin-top: 20px">Laporan SO</h3>
            <div class="input-so">
                <label>Beras</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text imgSo"><img src="{{ url('img/soImage/beras.png') }}"
                                alt="" style="height: 22px;margin-left:-5px"></span>
                    </div>
                    <input type="text" class="form-control inputSo" placeholder="0">
                    <div class="input-group-append">
                        <span class="input-group-text unitSo">gr</span>
                    </div>
                </div>
            </div>
            <div class="input-so">
                <label>Beras</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text imgSo"><img src="{{ url('img/soImage/beras.png') }}"
                                alt="" style="height: 22px;margin-left:-5px"></span>
                    </div>
                    <input type="text" class="form-control inputSo" placeholder="0">
                    <div class="input-group-append">
                        <span class="input-group-text unitSo">gr</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    var dataId = [];
    $(document).ready(function() {
        dataId.length =0;
        showItemOutlet("{{ session('idOutlet') }}");
    });
    function showItemOutlet(id) {
        dataId.length =0;
        $.ajax({
            url: "{{ url('listType/soHarian/show/item/outlet/') }}" + '/' + id,
            type: 'get',
            success: function(response) {
                var order_data = '';
                var addOrderData = '';
                var editOrderData = '';
                var obj = JSON.parse(JSON.stringify(response));

                addOrderData += '<div class="form-group">';
                editOrderData += '<div class="form-group">';

                addOrderData += '<label>Tanggal</label>';
                editOrderData += '<label>Tanggal</label>';

                addOrderData +=
                    '<input type="date" class="form-control" id="dateAdd" value={{ $dateSelect }} required>';
                editOrderData +=
                    '<input type="date" class="form-control" id="dateEdit" value={{ $dateSelect }} readonly>';

                addOrderData += '</div>';
                editOrderData += '</div>';

                order_data += '<tr>';
                order_data += '<td>';
                order_data += 'Tanggal';
                order_data += '</td>';
                console.log(response);
                for (var i = 0; i < obj.DataItem.length; i++) {
                    dataId.push(obj.DataItem[i]['id']);
                    addOrderData += '<div class="form-group">';
                    editOrderData += '<div class="form-group">';

                    addOrderData += '<label>' + obj.DataItem[i]['Item'] + ' (' + obj.DataItem[i]['satuan'] +
                        ') ' + '</label>';
                    editOrderData += '<label>' + obj.DataItem[i]['Item'] + '</label>';

                    addOrderData += '<input type="number" name="addname" class="form-control" value="0"/>';
                    editOrderData +=
                        '<input type="number" name="editname" class="form-control" value="0"/>';

                    addOrderData += '</div>';
                    editOrderData += '</div>';

                    order_data += '<td>' + obj.DataItem[i]['Item'] + '<br>' + obj.DataItem[i]['satuan'] +
                        '</td>';
                }
                order_data += '<td>';
                order_data += 'Pengisi';
                order_data += '</td>';
                order_data += '<td>';
                order_data += 'Edit';
                order_data += '</td>';
                order_data += '</tr>';
                // $('#maintable>thead').empty().append(order_data);

                // $('#groupAddItem').empty().append(addOrderData);
                // $('#groupEditItem').empty().append(editOrderData);

            },
            error: function(req, err) {
                console.log(err);
            }
        });
    }
</script>

</html>
