@extends('accountingControl.verifikasiSales.css')

@section('fillBody')
<div class="d-flex justify-content-between">
    <div>
        <select name="" id="selOutlet">
        </select>
        <select name="" id="selFilterSales">
        </select>
    </div>
    <div class="d-flex justify-content-right">
        <div>Start Date : </div>
        <input type="date" id="startDate">
        <div>End Date : </div>
        <input type="date" id="stopDate">
        <button type="button" class="btn btn-secondary" onclick="getListAllFilter()">Filter Date</button>
    </div>
</div>
<div style="height: 10px;"></div>
<div style="overflow-x: auto">
    <table class="table table-striped" id="statusInputTabel">
        <thead>
            <tr>
                <td>Tanggal</td>
                <td>Outlet</td>
                <td>Item Sales</td>
                <td>Jumlah (+/-)</td>
                <td>Jumlah Diterima</td>
                <td>Fee</td>
                <td>%</td>
                <td>Submit</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <button type="button" class="btn btn-secondary float-right" onclick="downloadCSV();">Download CSV</button>
</div>
@endsection