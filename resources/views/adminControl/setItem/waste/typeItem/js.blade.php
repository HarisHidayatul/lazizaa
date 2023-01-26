@extends('adminControl.setItem.waste.index')

@section('subSetItemJS')
    <script>
        $(document).ready(function() {
            document.getElementById("tittleContent").innerHTML = "Type Item";
            document.getElementById("tittleFillContent").innerHTML = "Set Item";
            document.getElementById("subFillContent").innerHTML = "Waste Harian / Type Item";
        })
    </script>
@endsection
