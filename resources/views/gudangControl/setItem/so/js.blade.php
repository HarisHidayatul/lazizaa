@extends('gudangControl.setItem.index')

@section('setItemJs')
    @yield('soJs')
    <script>
        $(document).ready(function() {
            var topNavBar = [
                ["List Item", "{{ url('gudang/so/listItem') }}"],
                ["Kategori", "{{ url('gudang/so/kategori') }}"]
            ];
            var topNavHTML = '';
            for (var i = 0; i < topNavBar.length; i++) {
                topNavHTML += '<li class="nav-item d-none d-sm-inline-block">';
                topNavHTML += '<a class="nav-link" href="';
                topNavHTML += topNavBar[i][1];
                topNavHTML += '" role="button">';
                topNavHTML += topNavBar[i][0];
                topNavHTML += '</a></li>';
            }
            document.getElementById('topNavBar').innerHTML = topNavHTML;
            document.getElementById("soSubMenu").classList.add("active");
        })
    </script>
@endsection