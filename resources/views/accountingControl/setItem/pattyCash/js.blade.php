@extends('accountingControl.setItem.index')

@section('setItemJS')
    @yield('subSetItemJS')
    <script>
        $(document).ready(function() {
            var topNavBar = [
                ["List Item", "{{ url('accounting/pattyCash/item') }}"],
                ["Jenis Item", "{{ url('accounting/pattyCash/jenisItem') }}"],
                ["Kategori Item", "{{ url('accounting/pattyCash/kategoriItem') }}"],
                ["Brand Item", "{{ url('accounting/pattyCash/brandItem') }}"],
                ["Pending Item","{{ url('accounting/pattyCash/pendingItem') }}"]
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