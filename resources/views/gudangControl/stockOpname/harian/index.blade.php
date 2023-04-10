@extends('gudangControl.stockOpname.harian.css')

@section('stockOpnameHtml')
    <input type="date" id="dateInput">
    <button type="button" class="btn btn-secondary" onclick="getAllData()">Filter Date</button>
    <div id="allData"></div>
    <button type="button" class="btn btn-secondary float-right" onclick="downloadExcel();">Download CSV</button>
@endsection
