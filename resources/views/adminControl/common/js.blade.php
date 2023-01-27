@extends('adminControl.layout.index')

@section('filljs')
    @yield('commonJS')
    <script>
        $(document).ready(function() {
            document.getElementById("commonSubMenu").classList.add("active");
            document.getElementById('commonTabMenu').classList.add("menu-open");
        })
    </script>
@endsection