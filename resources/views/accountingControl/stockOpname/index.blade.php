@extends('accountingControl.stockOpname.css')

@section('fillBody')
<div class="d-flex justify-content-between">
    <select name="" id="selOutlet"></select>
    <div class="d-flex justify-content-right">
        <div>Start Date : </div>
        <input type="date" id="startDate">
        <div>End Date : </div>
        <input type="date" id="stopDate">
        <button type="button" class="btn btn-secondary" onclick="getAllData()">Filter Date</button>
    </div>
</div>
<table class="table table-striped" id="statusInputTabel">
    <thead>
    </thead>
    <tbody>
    </tbody>
</table>

<div style="content: '';height: 50px;"></div>
<button type="button" class="btn btn-secondary float-right" onclick="downloadCSV();">Download CSV</button>
@endsection