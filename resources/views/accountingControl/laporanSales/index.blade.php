@extends('accountingControl.laporanSales.css')

@section('fillBody')
<div class="d-flex justify-content-between">
    <div>
        <select name="" id="selOutlet"></select>
        <select name="" id="selAccess">
            <option value="0">Semua</option>
            <option value="1">Surplus Setoran</option>
            <option value="2">Minus Setoran</option>
        </select>
    </div>
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
<button type="button" class="btn btn-secondary float-right" onclick="downloadCSV();">Download CSV</button>
<div style="height: 50px;"></div>
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
</div>
@endsection