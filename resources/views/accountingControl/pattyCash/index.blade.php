@extends('accountingControl.pattyCash.css')

@section('fillBody')
    <div class="d-flex justify-content-between">
        <div style="display: flex">
            <select name="" id="selOutlet" style="width: 300px;"></select>
            <select name="" id="selDate">
                <option value="today">Hari Ini</option>
                <option value="7day">7 Hari Terakhir</option>
                <option value="30day">30 Hari Terakhir</option>
                <option value="all">Semua</option>
            </select>
            <button type="button" class="btn btn-secondary" onclick="getListAllFilter()">Filter Date</button>
        </div>
    </div>
    <div style="height: 10px;"></div>
    <div style="overflow-x: auto">
        <table class="table table-striped" id="statusInputTabel">
            <thead>
                <tr>
                    <td>Tanggal</td>
                    <td>Item</td>
                    <td>Qty</td>
                    <td>Satuan</td>
                    <td>Total</td>
                    <td>Saldo Patty Cash</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
        Launch demo modal
    </button> --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reimburse Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">Status</div>
                        <div class="col-7">: <span id="statusReimburse"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Tanggal</div>
                        <div class="col-7">: <span id="tanggalReimburse"></span></div>
                    </div>
                    <div style="border-bottom: 1px dotted rgb(0, 0, 0);"></div>
                    <div class="row">
                        <div class="col-5">Nama Penerima</div>
                        <div class="col-7">: <span id="namaPenerima"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Bank Penerima</div>
                        <div class="col-7">: <span id="bankPenerima"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Rekening Penerima</div>
                        <div class="col-7">: <span id="rekeningPenerima"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Jumlah Reimburse</div>
                        <div class="col-7">: <span id="reimbursePenerima">0</span></div>
                    </div>
                    <div style="border-bottom: 1px dotted rgb(0, 0, 0);"></div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="doneTransfer" onchange="transferCheck();">
                        <label class="form-check-label" for="doneTransfer">
                          Sudah Ditransfer
                        </label>
                      </div>
                    <div class="row">
                        <div class="col-5">Nama Pengirim</div>
                        <div class="col-7">
                            <div class="d-flex justify-content-start">
                                <div style="width: 10px;">: </div>
                                <select class="form-select" id="listPenerima" style="width: 100%;" onchange="refreshListPenerima()" disabled></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">Bank Pengirim</div>
                        <div class="col-7">: <span style="color: darkgrey" id="bankPengirim"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Rekening Pengirim</div>
                        <div class="col-7">: <span style="color: darkgrey" id="rekeningPengirim"></span></div>
                    </div>
                    <div style="border-bottom: 1px dotted rgb(0, 0, 0);"></div>
                    <div class="row">
                        <div class="col-5">Pesan</div>
                        <div class="col-7">
                            <div class="d-flex justify-content-start">
                                <div style="width: 10px;">: </div>
                                <textarea id="pesanPenerima" rows="4" cols="35">
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="kirimTransfer();">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
