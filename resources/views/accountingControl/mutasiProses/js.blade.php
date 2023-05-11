@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        var dataArray = [];
        var transaksiArray = [];
        $(document).ready(function() {
            document.getElementById('mutasiProsesTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Proses Mutasi";
            document.getElementById('linkContent').innerHTML = "Proses Mutasi";
        })

        function printAllDataToTable(){
            var dataTable = '';
            for(var i=0;i<transaksiArray.length;i++){
                dataTable += '<tr>';
                    dataTable += '<td>';
                    dataTable += transaksiArray[i][0];
                    dataTable += '</td>';
                    dataTable += '<td>';
                    dataTable += transaksiArray[i][1];
                    dataTable += '</td>';
                    dataTable += '<td>';
                    dataTable += transaksiArray[i][3];
                    dataTable += '</td>';
                dataTable += '</tr>';
            }
            $('#statusInputTabel>tbody').empty().append(dataTable);
        }

        function handleFiles(files) {
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
                if(firstDataContinue){
                    firstDataContinue = false;
                    continue;
                }
                if (startParseData) {
                    transaksiArray.push(tempArray);
                }
            }
            console.log(transaksiArray);
        }
    </script>
@endsection
