@extends('accountingControl.setoranTunai.css')

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
    </div>
    <div style="height: 10px;"></div>
    <div style="overflow-x: auto">
        <table class="table table-striped" id="statusInputTabel">
            <thead>
                <tr>
                    <td>Tanggal</td>
                    <td>Jumlah Transfer</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Setoran Tunai Outlet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-5">Status</div>
                        <div class="col-7">: <span id="statusSetoran"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Tanggal</div>
                        <div class="col-7">: <span id="tanggalSetoran"></span></div>
                    </div>
                    <div style="border-bottom: 1px dotted rgb(0, 0, 0);"></div>
                    <div class="row">
                        <div class="col-5">Nama Pengirim</div>
                        <div class="col-7">: <span id="namaPengirim"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Bank Pengirim</div>
                        <div class="col-7">: <span id="bankPengirim"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Rekening Pengirim</div>
                        <div class="col-7">: <span id="rekeningPengirim"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Jumlah Setoran</div>
                        <div class="col-7">: <span id="setoranPengirim">0</span></div>
                    </div>
                    <div style="border-bottom: 1px dotted rgb(0, 0, 0);"></div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="doneTransfer" onchange="transferCheck();">
                        <label class="form-check-label" for="doneTransfer">
                            Sudah Diterima
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-5">Nama Penerima</div>
                        <div class="col-7">
                            <div class="d-flex justify-content-start">
                                <div style="width: 10px;">: </div>
                                <select class="form-select" id="listPenerima" style="width: 100%;"
                                    onchange="refreshListPenerima(this.options[this.selectedIndex].getAttribute('data-index'))"
                                    disabled></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-5">Bank Penerima</div>
                        <div class="col-7">: <span style="color: darkgrey" id="bankPenerima"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-5">Rekening Penerima</div>
                        <div class="col-7">: <span style="color: darkgrey" id="rekeningPenerima"></span></div>
                    </div>
                    <div style="border-bottom: 1px dotted rgb(0, 0, 0);"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="kirimTransfer();">Kirim</button>
                </div>
            </div>
        </div>
    </div>
@endsection
