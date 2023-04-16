@extends('accountingControl.beeCloudRobot.pembelian.css')

@section('robotBody')
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
<div style="height: 50px;"></div>
<div style="overflow-x: auto">
    <table class="table table-striped" id="statusInputTabel">
        <thead>
            <tr>
                <td>Tanggal</td>
                <td>Outlet</td>
                <td>Sesi</td>
                <td>Item HPP</td>
                <td>Qty</td>
                <td>Satuan</td>
                <td>Harga Satuan</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection