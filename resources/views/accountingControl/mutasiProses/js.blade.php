@extends('accountingControl.layout.index')

@section('filljs')
@yield('mutasijs')
    <script>
        $(document).ready(function() {
            document.getElementById("mutasiSubMenu").classList.add("active");
            document.getElementById('mutasiTabMenu').classList.add("menu-open");
        })
    </script>
@endsection
