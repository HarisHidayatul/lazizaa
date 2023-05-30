@extends('accountingControl.beeCloudRobot.mutasi455Pembayaran.css')

@section('robotBody')
<div class="d-flex justify-content-between">
    <div>
        <select name="" id="selPenerima"></select>
        <select name="" id="selFilter">
            <option value="0">Semua</option>
            <option value="1">Pending</option>
            <option value="2">Sukses</option>
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
<div style="height: 50px;"></div>
<div style="overflow-x: auto">
    <table class="table table-striped" id="statusInputTabel">
        <thead>
            <tr>
                <td>Tanggal</td>
                <td>Keterangan</td>
                <td>Klasifikasi</td>
                <td>Debet</td>
                <td>Kredit</td>
                <td>Cabang</td>
                <td>Status</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection