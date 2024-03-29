@extends('adminControl.common.index')

@section('commonJS')
    @yield('subCommonJS')
    <script>
        var idOutletArray = [];
        $(document).ready(function() {
            document.getElementById("outletSubMenu").classList.add("active");
            getAllBrand();
        })

        function editItem(index) {
            var namaStore = document.getElementsByName('inputEdit')[index].value;
            var alamatStore = document.getElementsByName('addressEdit')[index].value;
            var idBrand = document.getElementsByName('dropDownBrandEdit')[index].value;

            var terminBee = document.getElementsByName('terminBee')[index].value;
            var cabangBee = document.getElementsByName('cabangBee')[index].value;
            var gudangBee = document.getElementsByName('gudangBee')[index].value;
            var kasBee = document.getElementsByName('kasBee')[index].value;
            var keywoardBee = document.getElementsByName('keywoardBee')[index].value;

            var kodeShopee = document.getElementsByName('kodeShopee')[index].value;
            var kodeGoresto = document.getElementsByName('kodeGoresto')[index].value;
            var kodeSetoran = document.getElementsByName('kodeSetoran')[index].value;

            var kasSalesBee = document.getElementsByName('kasSalesBee')[index].value;

            $.ajax({
                url: "{{ url('common/outlet/update') }}" + '/' + idOutletArray[index],
                type: 'get',
                data: {
                    idBrand: idBrand,
                    namaStore: namaStore,
                    alamatStore: alamatStore,
                    terminBee: terminBee,
                    gudangBee: gudangBee,
                    cabangBee: cabangBee,
                    kasBee: kasBee,
                    keywoardBee: keywoardBee,
                    kodeShopee: kodeShopee,
                    kodeGoresto: kodeGoresto,
                    kodeSetoran: kodeSetoran,
                    kasSalesBee: kasSalesBee
                },
                success: function(response) {
                    getOutlet();
                    document.getElementById('namaStore').value = "";
                    document.getElementById('alamatStore').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function sendAddItem() {
            var idBrand = document.getElementById('dropDownBrand').value;
            var namaStore = document.getElementById('namaStore').value;
            var alamatStore = document.getElementById('alamatStore').value;
            $.ajax({
                url: "{{ url('common/outlet/store') }}",
                type: 'get',
                data: {
                    idBrand: idBrand,
                    namaStore: namaStore,
                    alamatStore: alamatStore
                },
                success: function(response) {
                    getOutlet();
                    document.getElementById('namaStore').value = "";
                    document.getElementById('alamatStore').value = "";
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getOutlet() {
            var idBrand = document.getElementById('dropDownBrand').value;
            document.getElementById('storeSubmitButton').disabled = false;
            $.ajax({
                url: "{{ url('common/outlet/show') }}" + '/' + idBrand,
                type: 'get',
                success: function(response) {
                    // document.getElementById('addItemSalesOnType').value = "";
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    var dataDropdown = '';
                    console.log(obj);
                    idOutletArray.length = 0;
                    for (var i = 0; i < obj.brand.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.brand[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.brand[i].brand;
                        dataDropdown += '</option>';
                    }

                    for (var i = 0; i < obj.dataItem.length; i++) {
                        idOutletArray.push(obj.dataItem[i].id);
                        dataTable += '<tr>';
                        dataTable += '<td>';
                        dataTable += obj.dataItem[i].id;
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].store;
                        dataTable += '" name="inputEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].alamat;
                        dataTable += '" name="addressEdit">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<div class="form-group">';
                        dataTable += '<select class="form-control" name="dropDownBrandEdit">';
                        dataTable += dataDropdown;
                        dataTable += '</select>';
                        dataTable += '</div>';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].keywoardBee;
                        dataTable += '" name="keywoardBee">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].terminBee;
                        dataTable += '" name="terminBee">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].cabangBee;
                        dataTable += '" name="cabangBee">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].gudangBee;
                        dataTable += '" name="gudangBee">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].kasBee;
                        dataTable += '" name="kasBee">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].kodeShopee;
                        dataTable += '" name="kodeShopee">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].kodeGoresto;
                        dataTable += '" name="kodeGoresto">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].kodeSetoran;
                        dataTable += '" name="kodeSetoran">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<input type="text" class="form-control" value="';
                        dataTable += obj.dataItem[i].kasSalesBee;
                        dataTable += '" name="kasSalesBee">';
                        dataTable += '</td>';

                        dataTable += '<td>';
                        dataTable += '<button type="button" class="btn btn-secondary" onClick="editItem(' +
                            i +
                            ');">Edit</button>';
                        dataTable += '</td>';

                        dataTable += '</tr>';
                    }
                    $('#tableAllItem>tbody').empty().append(dataTable);

                    var dropDownBrand = document.getElementsByName('dropDownBrandEdit');
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dropDownBrand[i].value = obj.dataItem[i].idBrand;
                    }
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }

        function getAllBrand() {
            $.ajax({
                url: "{{ url('common/brand/show') }}",
                type: 'get',
                success: function(response) {
                    // document.getElementById('addItemSalesOnType').value = "";
                    var obj = JSON.parse(JSON.stringify(response));
                    var dataTable = '';
                    console.log(obj);
                    var dataDropdown = '';
                    for (var i = 0; i < obj.dataItem.length; i++) {
                        dataDropdown += '<option value=';
                        dataDropdown += obj.dataItem[i].id;
                        dataDropdown += '>';
                        dataDropdown += obj.dataItem[i].brand;
                        dataDropdown += '</option>';
                    }
                    $('#dropDownBrand').empty().append(dataDropdown);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
