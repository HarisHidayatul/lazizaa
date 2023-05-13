@extends('accountingControl.mutasiProses.penjualan.css')

@section('mutasiBody')

<div class="d-flex justify-content-between">
    <select name="" id="selPenerima">
        {{-- <option value=""></option> --}}
    </select>
    <div class="d-flex justify-content-right">
        <div>Start Date : </div>
        <input type="date" id="startDate">
        <div>End Date : </div>
        <input type="date" id="stopDate">
        <button type="button" class="btn btn-secondary" onclick="getListAllFilter()">Filter Date</button>
    </div>
</div>
<div style="content: ''; height: 25px;"></div>
<div class="d-flex justify-content-between">
    <div></div>
    <div>
        <button type="button" class="btn btn-secondary" onclick="generateMutasi()">Auto Generate</button>
    </div>
</div>
<table class="table table-striped" id="statusInputTabel">
    <thead>
        <tr>
            <td>Tanggal</td>
            <td>Keterangan</td>
            <td>Nominal</td>
            <td>Klasifikasi</td>
            <td>Cabang</td>
            <td>Edit</td>
        </tr>
    </thead>
    <tbody></tbody>
</table>
@endsection