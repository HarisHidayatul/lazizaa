@extends('gudangControl.setItem.so.index')

@section('soJs')
    <script>
        var listItemSoArray = [];
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "List Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "SO Harian / List Item";
        })

        $(document).ready(function() {
            getListAllItem();
            getAllSatuan();
        })

        function sendAddItem() {
            $.ajax({
                url: "{{ url('itemSO/store') }}",
                type: 'get',
                data: {
                    item: document.getElementById('tambahNamaItem').value,
                    idSatuan: $('#showSatuanAdd').val(),
                    icon: document.getElementById('locationItem').value
                },
                success: function(response) {
                    getListAllItem();
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
                    $('#showSatuanAdd').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getListAllItem() {
            $.ajax({
                url: "{{ url('itemSO/showAll') }}",
                type: 'get',
                success: function(response) {
                    console.log(response);
                    var obj = JSON.parse(JSON.stringify(response));
                    var item = '';
                    var dataTable = '';
                    var kategoriAll = [];
                    var dataDropdown = '';
                    var dropDownKategori = '';
                    listItemSoArray.length = 0;
                    for (var i = 0; i < obj.satuan.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.satuan[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.satuan[i].satuan;
                        dataDropdown += '</option>';
                    }
                    for(var i =0;i<obj.kategori.length;i++){
                        dropDownKategori += '<option value=';
                        dropDownKategori += obj.kategori[i].id;
                        dropDownKategori += '>';
                        dropDownKategori += obj.kategori[i].kategori;
                        dropDownKategori += '</option>'; 
                    }
                    for (var i = 0; i < obj.itemSO.length; i++) {
                        dataTable += '<tr>';
                        dataTable += '<td>';

                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.itemSO[i].item;
                        dataTable += '" name="inputEdit" disabled>';

                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<div class="form-group">';
                        dataTable += '<select class="form-control" name="dropDownEdit" disabled>';
                        dataTable += dataDropdown;
                        dataTable += '</select>';
                        dataTable += '</div>';
                        dataTable += '</td>';
                        dataTable += '<td>';

                        dataTable += '<div class="form-group">';
                        dataTable += '<select class="form-control" name="dropDownKategoriEdit">';
                        dataTable += dropDownKategori;
                        dataTable += '</select>';
                        dataTable += '</div>';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.itemSO[i].icon;
                        dataTable += '" name="locationEdit" disabled>';
                        dataTable += '</td>';
                        dataTable += '<td>';
                        dataTable += '<img src="' + "{{ url('img/soImage') }}" + '/' + obj.itemSO[i].icon +
                            '" alt="">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<div class="d-flex justify-content-center">';
                        dataTable += '<input class="form-check-input" name="checkBoxHarian" type="checkbox" ';
                        if (obj.itemSO[i].harianItem != '0') {
                            dataTable += ' checked';
                        }
                        dataTable += '>';
                        dataTable += '</div>';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<div class="d-flex justify-content-center">';
                        dataTable += '<input class="form-check-input" name="checkBoxMingguan" type="checkbox" ';
                        if (obj.itemSO[i].mingguanItem != '0') {
                            dataTable += ' checked';
                        }
                        dataTable += ' disabled>';
                        dataTable += '</div>';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editItem(' + i +
                            ');">Edit</button>';

                        listItemSoArray.push(obj.itemSO[i].id);

                        dataTable += '</td>';
                        dataTable += '</tr>';
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);

                    var elementDropDown = document.getElementsByName('dropDownEdit');
                    var elementDropDownKategori = document.getElementsByName('dropDownKategoriEdit');
                    for (var i = 0; i < obj.itemSO.length; i++) {
                        elementDropDown[i].value = obj.itemSO[i].idSatuan;
                    }
                    for(var i =0;i<obj.itemSO.length;i++){
                        elementDropDownKategori[i].value = obj.itemSO[i].idKategori;
                    }
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }

        function editItem(index) {
            var dropdownEdit = document.getElementsByName('dropDownEdit')[index].value;
            var dropdownkategoriEdit = document.getElementsByName('dropDownKategoriEdit')[index].value;
            var itemEdit = document.getElementsByName('inputEdit')[index].value;
            var iconEdit = document.getElementsByName('locationEdit')[index].value;
            var idItem = listItemSoArray[index];
            var checkBoxMingguan = document.getElementsByName('checkBoxMingguan')[index].checked;
            var checkBoxHarian = document.getElementsByName('checkBoxHarian')[index].checked;
            var munculMingguan = '0';
            var munculHarian = '0';
            if (checkBoxMingguan) {
                munculMingguan = '1';
            }
            if (checkBoxHarian) {
                munculHarian = '1';
            }

            $.ajax({
                url: "{{ url('itemSO/update') }}" + '/' + idItem,
                type: 'get',
                data: {
                    idKategoriSo: dropdownkategoriEdit,
                    munculHarian: munculHarian
                },
                success: function(response) {
                    getListAllItem();
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function editAllItem() {
            for (var i = 0; i < 3; i++) {
                for (var j = 0; j < listItemSoArray.length; j++) {
                    var dropdownEdit = document.getElementsByName('dropDownEdit')[j].value;
                    var itemEdit = document.getElementsByName('inputEdit')[j].value;
                    var iconEdit = document.getElementsByName('locationEdit')[j].value;
                    var idItem = listItemSoArray[j];
                    var checkBoxMingguan = document.getElementsByName('checkBoxMingguan')[j].checked;
                    var checkBoxHarian = document.getElementsByName('checkBoxHarian')[j].checked;
                    var munculMingguan = '0';
                    var munculHarian = '0';
                    if (checkBoxMingguan) {
                        munculMingguan = '1';
                    }
                    if (checkBoxHarian) {
                        munculHarian = '1';
                    }

                    $.ajax({
                        url: "{{ url('itemSO/update') }}" + '/' + idItem,
                        type: 'get',
                        data: {
                            item: itemEdit,
                            idSatuan: dropdownEdit,
                            icon: iconEdit,
                            munculMingguan: munculMingguan,
                            munculHarian: munculHarian
                        },
                        success: function(response) {
                            // getListAllItem();
                        },
                        error: function(req, err) {
                            console.log(err);
                        }
                    })
                }
            }
            setTimeout(function(){
                window.location.reload();
            }, 5000)
            // window.location.reload();
        }
    </script>
@endsection