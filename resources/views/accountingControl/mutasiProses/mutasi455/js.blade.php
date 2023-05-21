@extends('accountingControl.mutasiProses.index')

@section('mutasijs')
    <script>
        $(document).ready(function() {
            // document.getElementById('mutasiProsesTabMenu').classList.add("active");
            document.getElementById("mutasi455SubMenu").classList.add("active");

            document.getElementById('tittleContent').innerHTML = "Mutasi 455";
            document.getElementById('linkContent').innerHTML = "Mutasi 455";
        })
    </script>
@endsection
