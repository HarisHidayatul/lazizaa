@extends('accountingControl.layout.index')

@section('filljs')
    @yield('robotjs')
    <script>
        $(document).ready(function() {
            document.getElementById("robotSubMenu").classList.add("active");
            document.getElementById('robotTabMenu').classList.add("menu-open");
        })
    </script>
@endsection
