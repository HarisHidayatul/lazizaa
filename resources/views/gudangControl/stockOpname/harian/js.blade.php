@extends('gudangControl.stockOpname.index')

@section('stockOpnameJs')
    <script>
        $(document).ready(function() {
            document.getElementById("soHarianSubMenu").classList.add("active");
        })
        var bulanIndonesia = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
            'Oktober', 'November', 'Desember'
        ];

        $(document).ready(function() {
            // membuat objek Date untuk tanggal hari ini
            var today = new Date();

            // mendapatkan nilai tanggal, bulan, dan tahun dari objek Date
            var day = today.getDate();
            var month = today.getMonth() + 1; // bulan dimulai dari 0, jadi harus ditambah 1
            var year = today.getFullYear();

            // menambahkan nol pada bulan dan tanggal jika nilainya kurang dari 10
            if (month < 10) {
                month = '0' + month;
            }

            if (day < 10) {
                day = '0' + day;
            }

            // menggabungkan tanggal, bulan, dan tahun menjadi format yang diinginkan (yyyy-mm-dd)
            var formattedDate = year + '-' + month + '-' + day;

            document.getElementById('dateInput').value = formattedDate;

            document.getElementById('tittleContent').innerHTML = "Stock Opname";
            document.getElementById('linkContent').innerHTML = "Stock Opname Harian";
        })

        function getAllData() {
            var dateInput = document.getElementById('dateInput').value;
            $.ajax({
                url: "{{ url('soHarian/show/history2') }}",
                type: 'get',
                data: {
                    date: dateInput
                },
                success: function(response) {
                    var obj = JSON.parse(JSON.stringify(response));
                    var allData = '';
                    console.log(obj);
                    for (var i = 0; i < obj.dataSo.length; i++) {
                        allData += '<h2>';
                        allData += obj.dataSo[i].kategori;
                        allData += '</h2>';

                        allData += '<div style="width: 100%">';
                        allData += '<div style="overflow: auto">';
                        allData += '<table class="table table-striped" id="statusInputTabel">';
                        allData += '<thead>';
                        
                        allData += '<tr>';
                        allData += '<td>';
                        allData += 'Outlet';
                        allData += '</td>';
                        for(var j=0;j<obj.dataSo[i].item.length;j++){
                            allData += '<td>';
                            allData += obj.dataSo[i].item[j].item;
                            allData += ' (';
                            allData += obj.dataSo[i].item[j].satuan;
                            allData += ')';
                            allData += '</td>';
                        }
                        allData += '</tr>';

                        allData += '</thead>';
                        allData += '<tbody>';

                        for(var j=0;j<obj.dataSo[i].dataOutlet.length;j++){
                            allData += '<tr>';
                            allData += '<td>';
                            allData += obj.dataSo[i].dataOutlet[j].Outlet;
                            allData += '</td>';
                            
                            for(var k =0;k<obj.dataSo[i].dataOutlet[j].data.length;k++){
                                allData += '<td ';
                                if(obj.dataSo[i].dataOutlet[j].data[k].melebihiBatas){
                                    allData += ' style="color: red" ';
                                }
                                allData += '>';
                                allData += obj.dataSo[i].dataOutlet[j].data[k].quantity;
                                allData += '</td>';
                            }

                            allData += '</tr>';
                        }

                        allData += '</tbody>';
                        allData += '</table>';
                        allData += '</div>';
                        allData += '</div>';
                    }
                    document.getElementById('allData').innerHTML = allData;
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
