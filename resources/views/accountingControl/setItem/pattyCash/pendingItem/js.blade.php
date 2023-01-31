@extends('accountingControl.setItem.pattyCash.index')

@section('subSetItemJS')
    <script>
        var listPattyCashEdit = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Pending Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Patty Cash Harian / Pending Item";

            getListAllRevision();
        })

        function acceptItem(index){
            var idReqPattyCash = listPattyCashEdit[index];
            var item = document.getElementsByName('itemEdit')[index].value;
            var idSatuan = document.getElementsByName('dropDownEdit')[index].value;
            processAcceptDel('1',idReqPattyCash,item,idSatuan);
        }

        function deleteItem(index){
            var idReqPattyCash = listPattyCashEdit[index];
            var item = document.getElementsByName('itemEdit')[index].value;
            var idSatuan = document.getElementsByName('dropDownEdit')[index].value;
            processAcceptDel('2',idReqPattyCash,item,idSatuan);
        }
        $(document).on("click", "[id^=b]", function(event, ui) {
            //function for delete (when clicked)
            var idClickDelete = this.id.substring(1);
            // alert(idClickDelete+'b');
            processAcceptDel('2', idClickDelete);
        });

        function processAcceptDel(status, idRev,item,idSatuan) {
            $.ajax({
                url: "{{ url('pattyCash/items/store/revision/request') }}",
                type: 'get',
                data: {
                    status: status,
                    idRev: idRev,
                    item: item,
                    idSatuan: idSatuan
                },
                success: function(response) {
                    getListAllRevision();
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
                    console.log(obj);
                    var satuanAll = [];
                    var dataDropdown = '';
                    listPattyCashEdit.length = 0;
                    for (var i = 0; i < obj.satuan.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.satuan[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.satuan[i].satuan;
                        dataDropdown += '</option>';

                        satuanAll.push([obj.satuan[i].id, obj.satuan[i].satuan]);
                    }
                    for (var i = 0; i < obj.listPattyCash.length; i++) {
                        order_data += '<tr>';
                        order_data += '<td>';
                        order_data += '<input type="text" class="form-control" value="';
                        order_data += obj.listPattyCash[i].Item;
                        order_data += '" name="itemEdit">';
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += '<select class="form-control" name="dropDownEdit">';
                        order_data += dataDropdown;
                        order_data += '</select>';
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += obj.listPattyCash[i].Outlet;
                        order_data += '</td>';
                        order_data += '<td>';
                        order_data += obj.listPattyCash[i].Brand;
                        order_data += '</td>';
                        order_data +=
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Accept" onClick="acceptItem(' +
                            i + ');">&#xe5ca;</i></a></td>';
                        order_data +=
                            '<td><a href="#" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" onClick="deleteItem(' +
                            i + ');">&#xe14c;</i></a></td>';
                        
                        order_data += '</tr>';
                        listPattyCashEdit.push(obj.listPattyCash[i].id);
                    }
                    $('#revisionTable>tbody').empty().append(order_data);

                    var elementDropDown = document.getElementsByName('dropDownEdit');
                    for (var i = 0; i < obj.listPattyCash.length; i++) {
                        elementDropDown[i].value = obj.listPattyCash[i].idSatuan;
                    }
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
    </script>
@endsection
