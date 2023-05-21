@extends('accountingControl.mutasiProses.upload.css')

@section('mutasiBody')
<div class="d-flex justify-content-between">
    <input type="file" id="fileInput" onchange="handleFiles(this.files)">
    <div class="d-flex justify-content-start">
        <input type="number" id="inputYear" name="inputYear" min="2000" max="2099" value="2023" onchange="printAllDataToTable();">
        <button class="btn btn-secondary" onclick="sendData()">Upload Ke Database</button>
    </div>
</div>
<div class="d-flex justify-content-start">
    <div>Nomer Rekening = </div>
    <div id="nomorRekening"></div>
</div>
<div class="d-flex justify-content-start">
    <div>Jumlah Data = </div>
    <div id="countData"></div>
</div>
<div class="d-flex justify-content-start">
    <div>Data Berhasil Diupload = </div>
    <div id="uploadSuccess"></div>
</div>
<div class="d-flex justify-content-start">
    <div>Data Gagal Diupload = </div>
    <div id="uploadFail"></div>
</div>
<table class="table table-striped" id="statusInputTabel">
    <thead>
        <tr>
            <td>Tanggal</td>
            <td>Keterangan</td>
            <td>Nominal</td>
        </tr>
    </thead>
    <tbody></tbody>
</table>
@endsection