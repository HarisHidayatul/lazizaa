@extends('adminControl.setItem.index')

@section('setItemJS')
    @yield('subSetItemJS')
    <script>
        $(document).ready(function() {
            var topNavBar = [
                ["List Item", "{{ url('admin/sales/item') }}"],
                ["Set Type", "{{ url('admin/sales/setType') }}"],
                ["Outlet Type", "{{ url('admin/sales/outletType') }}"],
                ["Pending Item","{{ url('admin/sales/pendingItem') }}"]
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
            document.getElementById("salesSubMenu").classList.add("active");
        })
    </script>
@endsection