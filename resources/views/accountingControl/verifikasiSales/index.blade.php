@extends('accountingControl.verifikasiSales.css')

@section('fillBody')
<div class="d-flex justify-content-between">
    <select name="" id="selOutlet"></select>
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
                <td>Item</td>
                <td>Jumlah</td>
                <td>Jumlah Diterima</td>
                <td>%</td>
                <td>Submit</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection