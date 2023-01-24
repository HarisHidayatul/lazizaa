@extends('accountingControl.layout.index')

@section('filljs')
    <script>
        $(document).ready(function() {
            var today = new Date();
            var month = today.getMonth() + 1;
            var stringMonth = '';
            if (month / 10 == 0) {
                stringMonth = month;
            } else {
                stringMonth = '0' + month % 10;
            }
            document.getElementById('startDate').value = today.getFullYear() + '-' + stringMonth + '-' + today
                .getDate();
            document.getElementById('stopDate').value = today.getFullYear() + '-' + stringMonth + '-' + today
                .getDate();

            console.log(stringMonth);
            var topNav = [
                ["SO Harian", "{{ url('accounting/revisi/so') }}"],
                ["Sales Harian", "{{ url('accounting/revisi/sales') }}"],
                ["Patty Cash", "{{ url('accounting/revisi/pattyCash') }}"],
                ["Waste", "{{ url('accounting/revisi/waste') }}"]
            ];
            topNavHTML = '';
            for (var i = 0; i < topNav.length; i++) {
                topNavHTML += '<li class="nav-item d-none d-sm-inline-block">';
                topNavHTML += '<a name="topNav" href="' + topNav[i][1] + '" class="nav-link">';
                topNavHTML += topNav[i][0];
                topNavHTML += '</a></li>';
            }
            document.getElementById('topNav').innerHTML = topNavHTML;
            document.getElementById('tittleContent').innerHTML = "Revisi";
            document.getElementById('linkContent').innerHTML = "Revisi";

            document.getElementById('revisiSubMenu').classList.add("active");
            document.getElementById('revisiTabMenu').classList.add("menu-open");

        });
    </script>

    @yield('revisijs')
@endsection
