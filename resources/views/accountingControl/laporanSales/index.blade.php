@extends('accountingControl.laporanSales.css')

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
    {{-- <div style="display: flex">
        <select name="" id="selDate">
            <option value="today">Hari Ini</option>
            <option value="7day">7 Hari Terakhir</option>
            <option value="30day">30 Hari Terakhir</option>
            <option value="all">Semua</option>
        </select>
    </div> --}}
</div>
<div style="height: 10px;"></div>
<div style="overflow-x: auto">
    <table class="table table-striped" id="statusInputTabel">
        <thead>
            <tr>
                <td>Tanggal</td>
                <td>Outlet</td>
                <td>Item Sales</td>
                <td>Jumlah (+ -)</td>
                <td></td>
                <td>Jumlah Diterima</td>
                <td>Fee E-Commerce</td>
                <td>Saldo</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <button type="button" class="btn btn-secondary float-right" onclick="downloadCSV();">Download CSV</button>
</div>
@endsection