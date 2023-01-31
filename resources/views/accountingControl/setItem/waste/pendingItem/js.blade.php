@extends('accountingControl.setItem.waste.index')

@section('subSetItemJS')
    <script>
        var idRequest = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Pending Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Waste Harian / Pending Item";

            getListAllRequest();
        })

        // $(document).on("click", "[id^=a]", function(event, ui) {
        //     //function for accept (when clicked)
        //     var idClickAccept = this.id.substring(1);
        //     // alert(idClickAccept+'a');
        //     processAcceptDel('1', idClickAccept);
        // });
        // $(document).on("click", "[id^=b]", function(event, ui) {
        //     //function for delete (when clicked)
        //     var idClickDelete = this.id.substring(1);
        //     // alert(idClickDelete+'b');
        //     processAcceptDel('2', idClickDelete);
        // });

        function acceptItem(index) {
            var item = document.getElementsByName('itemEdit')[index].value;
            var satuan = document.getElementsByName('dropDownSatuanEdit')[index].value;
            var jenis = document.getElementsByName('dropDownJenisEdit')[index].value;
            var idReq = idRequest[index];
            processAcceptDel('1', idReq, item, satuan, jenis);
        }
        function deleteItem(index){
            var idReq = idRequest[index];
            processAcceptDel('2', idReq, '', '', '');
        }

        function processAcceptDel(status, idRev, item, satuan, jenis) {
            $.ajax({
                url: "{{ url('waste/items/store/revision/request') }}",
                type: 'get',
                data: {
                    status: status,
                    idRev: idRev,
                    item: item,
                    idSatuan: satuan,
                    idJenisBahan: jenis
                },
                success: function(response) {
                    getListAllRequest();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getListAllRequest() {
            $.ajax({
                url: "{{ url('waste/items/show/req') }}",
                type: 'get',
                success: function(response) {
                    var order_data = '';
                    var obj = JSON.parse(JSON.stringify(response));
                    console.log(obj);
                    var dropDownSatuan = '';
                    var dropDownJenis = '';
                    var order_data = '';
                    idRequest.length = 0;
                    for (var i = 0; i < obj.satuan.length; i++) {
                        dropDownSatuan += '<option value=';
                        dropDownSatuan += obj.satuan[i].id;
                        dropDownSatuan += '>';
                        dropDownSatuan += obj.satuan[i].satuan;
                        dropDownSatuan += '</option>';
                    }
                    for (var i = 0; i < obj.jenis.length; i++) {
                        dropDownJenis += '<option value=';
                        dropDownJenis += obj.jenis[i].id;
                        dropDownJenis += '>';
                        dropDownJenis += obj.jenis[i].jenis;
                        dropDownJenis += '</option>';
                    }
                    for (var i = 0; i < obj.listWaste.length; i++) {
                        idRequest.push(obj.listWaste[i].id);

                        order_data += '<tr>';
                        order_data += '<td>';

                        order_data += '<input type="text" class="form-control" value="';
                        order_data += obj.listWaste[i].Item;
                        order_data += '" name="itemEdit">';

                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += '<select class="form-control" name="dropDownSatuanEdit">';
                        order_data += dropDownSatuan;
                        order_data += '</select>';
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += '<select class="form-control" name="dropDownJenisEdit">';
                        order_data += dropDownJenis;
                        order_data += '</select>';
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += obj.listWaste[i].Outlet;
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += obj.listWaste[i].Brand;
                        order_data += '</td>';
                        order_data +=
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Accept" onclick="acceptItem(' +
                            i + ');">&#xe5ca;</i></a></td>';
                        order_data +=
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" onclick="deleteItem(' +
                            i + ');">&#xe14c;</i></a></td>';
                        order_data += '</tr>';
                    }
                    $('#revisionTable>tbody').empty().append(order_data);

                    var elementSatuan = document.getElementsByName('dropDownSatuanEdit');
                    var elementJenis = document.getElementsByName('dropDownJenisEdit');
                    for (var i = 0; i < obj.listWaste.length; i++) {
                        elementSatuan[i].value = obj.listWaste[i].idSatuan;
                        elementJenis[i].value = obj.listWaste[i].idJenis;
                    }
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
