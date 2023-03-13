@extends('accountingControl.layout.index')

@section('filljs')
    <script>
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

            document.getElementById('startDate').value = formattedDate;
            document.getElementById('stopDate').value = formattedDate;
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
