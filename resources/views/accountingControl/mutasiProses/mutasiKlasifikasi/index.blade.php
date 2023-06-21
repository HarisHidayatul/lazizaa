@extends('accountingControl.mutasiProses.mutasiKlasifikasi.css')

@section('mutasiBody')
    <div class="d-flex justify-content-between">
        <div>
            <select name="" id="selPenerima"></select>
            <select name="" id="selKlasifikasi"></select>
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
    <div>
        <div class="d-flex justify-content-start">
            <div>Jumlah Mutasi : </div>
            <div id="jumlahMutasi"></div>
        </div>
        <div class="d-flex justify-content-start">
            <div>Jumlah Debit : </div>
            <div id="jumlahDebit"></div>
        </div>
        <div class="d-flex justify-content-start">
            <div>Jumlah Kredit : </div>
            <div id="jumlahKredit"></div>
        </div>
    </div>
    <div style="height: 10px;"></div>
    <div class="d-flex justify-content-between">
        <div></div>
        <div class="d-flex justify-content-start">
            <button onclick="downloadCSV();">Download CSV</button>
            <button onclick="generateMutasi();">Generate Mutasi</button>
        </div>
    </div>
    <div style="height: 50px;"></div>
    <div style="width: 100%">
        <div style="overflow-x: auto">
            <table class="table table-striped" id="statusInputTabel">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>ID</td>
                        <td>Tanggal</td>
                        <td>Keterangan</td>
                        <td>Klasifikasi</td>
                        <td>Debit</td>
                        <td>Kredit</td>
                        <td>Cabang</td>
                        <td>Aksi</td>
                        <td>H+</td>
                        <td>Terkait</td>
                        <td>Robot Status</td>
                        <td>Submit</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="addModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Klasifikasi Manual Mutasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">Keterangan</div>
                        <div class="col-7">: <span style="color: darkgrey" id="keteranganAdd"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Total</div>
                        <div class="col-7">: <span style="color: darkgrey" id="totalAdd"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Aksi</div>
                        <div class="col-7">: <select name="" id="aksiAdd" onchange="searchPatty();"></select></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Klasifikasi</div>
                        <div class="col-7">: <select name="" id="klasifikasiAdd" onchange="searchPatty();"></select></div>
                    </div>
                    <div id="lain2div" style="display: none;">
                        <div style="height: 15px; content: ''"></div>
                        <div class="row">
                            <div class="col-5">Lain - lain</div>
                            <div class="col-7">: <input id="lain2text" type="text" onkeyup="searchItemPatty();"></div>
                        </div>
                        <div class="row">
                            <div class="col-5"></div>
                            <div class="col-7">: <select name="" id="lain2Add" style="width: 200px"></select></div>
                        </div>
                        <div style="height: 15px; content: ''"></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Cabang</div>
                        <div class="col-7">: <select name="" id="cabangAdd"></select></div>
                    </div>
                    <div class="row">
                        <div class="col-5">H+</div>
                        <div class="col-7">: <input type="number" id="hPlusAdd" value="0"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="backMutasiClick();">Back</button>
                    <button type="button" class="btn btn-primary" onclick="sendMutasi();">Kirim</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete Klasifikasi Manual Mutasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>Apakah yakin untuk menghapus klasifikasi ini?</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="backDeleteClick();">Back</button>
                    <button type="button" class="btn btn-primary" onclick="deleteMutasi();">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection
