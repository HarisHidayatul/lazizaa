@extends('adminControl.setItem.index')

@section('setItemJS')
    @yield('subSetItemJS')
    <script>
        $(document).ready(function() {
            var topNavBar = [
                ["List Item", "{{ url('admin/pattyCash/item') }}"],
                ["Brand Item", "{{ url('admin/pattyCash/brandItem') }}"],
                ["Pending Item","{{ url('admin/pattyCash/pendingItem') }}"]
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
            document.getElementById("pattyCashSubMenu").classList.add("active");
        })
    </script>
@endsection