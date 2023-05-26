@extends('accountingControl.mutasiProses.index')

@section('mutasijs')
    <script>
        var dataArray = [];
        var transaksiArray = [];
        var sendArray = [];
        var nomorRekening = 0;

        var logStatus = [];
        var indexClick = [];


        $(document).ready(function() {
            // document.getElementById('mutasiProsesTabMenu').classList.add("active");
            document.getElementById("uploadMutasiSubMenu").classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Upload Mutasi";
            document.getElementById('linkContent').innerHTML = "Upload Mutasi";

            document.getElementById('uploadSuccess').innerHTML = 0;
            document.getElementById('uploadFail').innerHTML = 0;
        })

        function printAllDataToTable() {
            var dataTable = '';
            var countData = 0;
            var tahun = document.getElementById('inputYear').value;
            sendArray.length = 0;
            for (var i = 0; i < transaksiArray.length; i++) {
                var keterangan = transaksiArray[i][1];
                var total = (convertToInteger(transaksiArray[i][3]) / 100);
                if (transaksiArray[i][4] == 'DB') {
                    total = (-1) * total;
                }

                keterangan += ' ' + convertToDateFormat(transaksiArray[i][0]) + '/' + tahun;
                keterangan += ' ' + total;
                // keterangan += ' ' + nomorRekening;

                dataTable += '<tr>';
                dataTable += '<td>';
                dataTable += countData + 1;
                dataTable += '</td>';
                dataTable += '<td>';
                dataTable += convertToDateFormat(transaksiArray[i][0]);
                dataTable += '</td>';
                dataTable += '<td>';
                dataTable += keterangan;
                dataTable += '</td>';
                dataTable += '<td>';
                dataTable += total.toLocaleString();
                dataTable += '</td>';
                dataTable += '<td>';
                dataTable += '<div name="uploadStatus">';
                dataTable += '</div>';
                dataTable += '</td>';
                dataTable += '</tr>';
                countData++;
                sendArray.push(
                    [
                        convertToDateFormat(transaksiArray[i][0]),
                        keterangan,
                        total
                    ]
                );
            }
            $('#statusInputTabel>tbody').empty().append(dataTable);
            document.getElementById('countData').innerHTML = countData;
        }

        function sendData() {
            document.getElementById('uploadSuccess').innerHTML = 0;
            document.getElementById('uploadFail').innerHTML = 0;
            var data = {
                tahun: document.getElementById('inputYear').value,
                nomorRekening: nomorRekening,
                data: sendArray
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: "{{ url('mutasi/upload') }}",
                type: 'POST',
                data: {
                    data: JSON.stringify(data)
                }, // kirim data sebagai JSON string
                success: function(data) {
                    var obj = JSON.parse(JSON.stringify(data));
                    logStatus = obj;
                    document.getElementById('uploadSuccess').innerHTML = obj.dataBerhasil;
                    document.getElementById('uploadFail').innerHTML = obj.dataGagal;
                    console.log(data);
                    for (var i = 0; i < obj.statusUpload.length; i++) {
                        if (obj.statusUpload[i].status == 0) {
                            document.getElementsByName("uploadStatus")[i].innerHTML =
                                '<a style="color: red; cursor: pointer;" onclick="retryMutasi(' + i +
                                ');">Gagal</a>';
                        } else {
                            document.getElementsByName("uploadStatus")[i].innerHTML = 'Sukses';
                        }
                    }
                    // alert('Data berhasil diposting!');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function retryMutasi(index) {
            indexClick = index;
            var tahun = document.getElementById('inputYear').value;
            var keterangan = transaksiArray[index][1];
            var total = (convertToInteger(transaksiArray[index][3]) / 100);
            if (transaksiArray[index][4] == 'DB') {
                total = (-1) * total;
            }

            keterangan += ' ' + convertToDateFormat(transaksiArray[index][0]) + '/' + tahun;
            keterangan += ' ' + total;
            document.getElementById('keteranganTextArea').value = keterangan;
            document.getElementById('totalModal').innerHTML = total.toLocaleString();
            document.getElementById('statusError').innerHTML = logStatus.statusUpload[index].error;
            $('#retryModalCenter').modal('show');
        }

        function kirimUlangTransaksi() {
            var kirimTemp = [];
            var keterangan = document.getElementById('keteranganTextArea').value;

            var total = (convertToInteger(transaksiArray[indexClick][3]) / 100);
            if (transaksiArray[indexClick][4] == 'DB') {
                total = (-1) * total;
            }

            kirimTemp.push(
                [
                    convertToDateFormat(transaksiArray[indexClick][0]),
                    keterangan,
                    total
                ]
            );
            var data = {
                tahun: document.getElementById('inputYear').value,
                nomorRekening: nomorRekening,
                data: kirimTemp
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            $.ajax({
                url: "{{ url('mutasi/upload') }}",
                type: 'POST',
                data: {
                    data: JSON.stringify(data)
                }, // kirim data sebagai JSON string
                success: function(data) {
                    var obj = JSON.parse(JSON.stringify(data));
                    console.log(data);
                    for (var i = 0; i < obj.statusUpload.length; i++) {
                        if (obj.statusUpload[i].status == 0) {
                            document.getElementsByName("uploadStatus")[indexClick].innerHTML =
                                '<a style="color: red; cursor: pointer;">Gagal</a>';
                        } else {
                            document.getElementsByName("uploadStatus")[indexClick].innerHTML = 'Sukses';
                        }
                    }
                    // alert('Data berhasil diposting!');
                    $('#retryModalCenter').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        function backClick() {
            // $('#exampleModalCenter').modal('show');
            $('#retryModalCenter').modal('hide');
        }

        function handleFiles(files) {
            document.getElementById('uploadSuccess').innerHTML = 0;
            document.getElementById('uploadFail').innerHTML = 0;
            var file = files[0];
            var reader = new FileReader();
            dataArray.length = 0;
            reader.readAsText(file);
            reader.onload = function(event) {
                var csvData = event.target.result;
                var rows = csvData.split("\n");
                var data = [];
                for (var i = 0; i < rows.length; i++) {
                    var cells = rows[i].split(/,(?=(?:(?:[^"]*"){2})*[^"]*$)/);
                    var row = [];
                    for (var j = 0; j < cells.length; j++) {
                        row.push(cells[j].replace(/^"(.+(?="$))"$/, '$1'));
                    }
                    data.push(row);
                }
                dataArray = data;
                console.log(data); // menampilkan data dalam bentuk array di console
                cariNomerRekening();
                cariSemuaData();
                printAllDataToTable();
            };
        }

        function cariNomerRekening() {
            var regex = /No\. rekening\s*:\s*(\d+)/i;
            for (var i = 0; i < dataArray.length; i++) {
                for (var j = 0; j < dataArray[i].length; j++) {
                    var match = dataArray[i][j].match(regex);
                    if (match) {
                        var accountNumber = match[1];
                        // console.log(accountNumber); // output: "4293500455"
                        document.getElementById('nomorRekening').innerHTML = accountNumber;
                        nomorRekening = accountNumber;
                    }
                }
            }
        }

        function cariSemuaData() {
            var startParseData = false;
            var stopParseData = false;
            var firstDataContinue = false;
            transaksiArray.length = 0;
            for (var i = 0; i < dataArray.length; i++) {
                var tempArray = [];
                for (var j = 0; j < dataArray[i].length; j++) {
                    if (!startParseData) {
                        if (dataArray[i][j].includes("Tanggal Transaksi")) {
                            //Mulai Write Ke Array Jika Ada Keywoard Data Awal Tanggal Transaksi
                            startParseData = true;
                            firstDataContinue = true;
                            break;
                        }
                    } else {
                        if (dataArray[i][j].includes("Saldo Awal")) {
                            //Akhiri parsing jika terdapat keywoard Saldo Awal
                            stopParseData = true;
                            break;
                        }
                        tempArray.push(dataArray[i][j]);
                    }
                }
                if (stopParseData) {
                    break;
                }
                if (firstDataContinue) {
                    firstDataContinue = false;
                    continue;
                }
                if (startParseData) {
                    transaksiArray.push(tempArray);
                }
            }
            console.log(transaksiArray);
        }

        function convertToDateFormat(data) {
            // cek apakah data adalah dalam format 'DD/MM'
            if (/\d{1,2}\/\d{1,2}/.test(data)) {
                return data;
            }

            // array singkatan bulan
            const months = [
                'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
            ];

            // memisahkan tanggal dan singkatan bulan
            const [date, monthStr] = data.split('-');

            // mendapatkan angka bulan dari singkatan bulan
            const monthIndex = months.findIndex((m) => m === monthStr);
            const month = (monthIndex + 1).toString().padStart(2, '0');

            // menggabungkan angka bulan dan angka tanggal dalam format MM/DD
            return `${month}/${date}`;
        }

        function convertToInteger(data) {
            // menghapus karakter selain angka dan titik desimal
            let cleanedData = data.replace(/[^\d.-]/g, '');

            // menghapus titik desimal di akhir bilangan
            if (cleanedData.endsWith('.')) {
                cleanedData = cleanedData.slice(0, -1);
            }

            // mengonversi menjadi integer
            var valueData = parseInt(cleanedData.replace('.', ''));

            if (data.endsWith('CR')) {
                return valueData;
            } else if (data.endsWith('DB')) {
                return (-1) * valueData;
            } else {
                return valueData;
            }
        }
    </script>
@endsection
