@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        $(document).ready(function() {
            var topNav = [
                ["SO Harian","{{ url('accounting/revisi/so') }}"],
                ["Sales Harian","{{ url('accounting/revisi/sales') }}"],
                ["Patty Cash","{{ url('accounting/revisi/pattyCash') }}"],
                ["Waste","{{ url('accounting/revisi/waste') }}"]
            ];
            topNavHTML = '';
            for(var i =0;i<topNav.length;i++){
                topNavHTML += '<li class="nav-item d-none d-sm-inline-block">';
                topNavHTML += '<a name="topNav" href="' + topNav[i][1] + '" class="nav-link">';
                topNavHTML += topNav[i][0];
                topNavHTML += '</a></li>';
            }
            document.getElementById('topNav').innerHTML = topNavHTML;
            document.getElementById('revisiTabMenu').classList.add("active");
        });
    </script>
    @yield('revisijs')
@endsection
