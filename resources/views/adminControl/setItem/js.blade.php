@extends('adminControl.layout.index')

@section('filljs')
    @yield('setItemJS')
    <script>
        $(document).ready(function() {
            document.getElementById("itemSubMenu").classList.add("active");
        })
    </script>
@endsection