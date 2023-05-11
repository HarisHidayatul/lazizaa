@extends('accountingControl.mutasiProses.css')

@section('fillBody')
    <input type="file" id="fileInput" onchange="handleFiles(this.files)">
    <div class="d-flex justify-content-start">
        <div>Nomer Rekening = </div>
        <div id="nomorRekening"></div>
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
