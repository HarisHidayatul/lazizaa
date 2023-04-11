@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        $(document).ready(function() {
            document.getElementById('saldoPattyCashsTabMenu').classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Saldo Patty Cash";
            document.getElementById('linkContent').innerHTML = "Saldo Patty Cash";

            getListAllFilter();
        })

        function refreshData() {
            $('#statusInputTabel>tbody').empty();
            $.ajax({
                url: "{{ url('reimburse/update/history/allOutlet') }}",
                type: 'get',
                success: function(response) {
                    // $("#deleteModalCenter").modal('hide');
                    getListAllFilter();
                },
                error: function(req, err) {
                    console.log(err);
                }
            });
        }
        
        function getListAllFilter() {
            var urlAll = "{{ url('reimburse/show/history/outlet/0/today/0/0') }}";
            $.ajax({
                url: urlAll,
                type: 'get',
                success: function(response) {
                    var objAllData = JSON.parse(JSON.stringify(response));
                    var historyAll = "";
                    console.log(objAllData);

                    for (var i = 0; i < objAllData.allData.length; i++) {
                        historyAll += '<tr>';
                        historyAll += '<td>';
                        historyAll += objAllData.allData[i].outlet;
                        historyAll += '</td>';
                        historyAll += '<td>';
                        historyAll += objAllData.allData[i].saldoPattyCash.toLocaleString();
                        historyAll += '</td>';
                        historyAll += '</tr>';
                    }
                    $('#statusInputTabel>tbody').empty().append(historyAll);
                },
                error: function(req, err) {
                    console.log(err);
                }
            })
        }
    </script>
@endsection
