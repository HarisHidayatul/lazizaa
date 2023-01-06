@extends('adminControl.layout.index')

@section('filljs')
    @yield('jsItemSoHarian')
    <script>
        $(document).ready(function() {
            var elementNavBar = document.getElementsByName("topNavbar");
            elementNavBar[0].innerHTML = "SO Harian";
            elementNavBar[0].href = "{{ url('admin/item/so') }}";

            elementNavBar[1].innerHTML = "Sales Harian";
            elementNavBar[1].href = "{{ url('admin/item/sales') }}";

            elementNavBar[2].innerHTML = "Patty Cash";
            elementNavBar[2].href = "{{ url('admin/item/pattyCash') }}";

            elementNavBar[3].innerHTML = "Waste";
            elementNavBar[2].href = "{{ url('admin/item/waste') }}";
        })
    </script>
@endsection