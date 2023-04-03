@extends('gudangControl.layout.index')

@section('filljs')
    @yield('setItemJs')
    <script>
        $(document).ready(function() {
            document.getElementById("itemSubMenu").classList.add("active");
            document.getElementById('itemTabMenu').classList.add("menu-open");
        })
    </script>
@endsection