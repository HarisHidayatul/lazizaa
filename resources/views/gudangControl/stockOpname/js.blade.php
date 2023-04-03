@extends('gudangControl.layout.index')

@section('filljs')
    @yield('stockOpnameJs')
    <script>
        $(document).ready(function() {
            document.getElementById("stockSubMenu").classList.add("active");
            document.getElementById('stockTabMenu').classList.add("menu-open");
        })
    </script>
@endsection
