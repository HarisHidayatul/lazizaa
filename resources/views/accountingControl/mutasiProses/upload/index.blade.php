@extends('accountingControl.mutasiProses.upload.css')

@section('mutasiBody')
    <div class="d-flex justify-content-between">
        <input type="file" id="fileInput" onchange="handleFiles(this.files)">
        <div class="d-flex justify-content-start">
            <input type="number" id="inputYear" name="inputYear" min="2000" max="2099" value="2023"
                onchange="printAllDataToTable();">
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
                <td>No</td>
                <td>Tanggal</td>
                <td>Keterangan</td>
                <td>Nominal</td>
                <td>Keterangan</td>
            </tr>
        </thead>
        <tbody></tbody>
    </table>

    <div class="modal fade" id="retryModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Reimburse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">Keterangan</div>
                        <div class="col-7">:
                            <textarea id="keteranganTextArea" rows="5">
                            </textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">Total</div>
                        <div class="col-7">:
                            <div id="totalModal"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">Status Error</div>
                        <div class="col-7">:
                            <div id="statusError"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="backClick();">Back</button>
                    <button type="button" class="btn btn-primary" onclick="kirimUlangTransaksi();">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
