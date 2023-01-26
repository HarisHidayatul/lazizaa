@extends('adminControl.setItem.index')

@section('setItemJS')
    @yield('subSetItemJS')
    <script>
        $(document).ready(function() {
            document.getElementById("satuanSubMenu").classList.add("active");
        })
    </script>
@endsection
