@extends('accountingControl.reimburse.css')

@section('fillBody')
<div class="d-flex justify-content-between">
    <div>
        <select name="" id="selOutlet"></select>
        <select name="" id="selFilterStatus">
            <option value="0">Semua Status</option>
            <option value="1">Pending</option>
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
<div class="d-flex justify-content-between">
    <div></div>
    <div>
        <button type="button" class="btn btn-secondary" onclick="">Auto Generate</button>
    </div>
</div>
<div style="overflow-x: auto;">
    <div style="width: 1500px">
        <table class="table table-striped" id="statusInputTabel">
            <thead>
                <tr>
                    <td>Tanggal</td>
                    <td>Outlet</td>
                    <td>Item Kas</td>
                    <td>Debit</td>
                    <td>Status</td>
                    <td>Mutasi</td>
                    <td>Delete Mutasi</td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
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
                            <select class="form-select" id="listPenerima" style="width: 100%;"
                                onchange="refreshListPenerima(this.options[this.selectedIndex].getAttribute('data-index'))"
                                disabled></select>
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
                <div class="row">
                    <div class="col-5">Bukti Pembayaran</div>
                    <div class="col-7">:
                        <span style="color: darkgrey" id="buktiPengirim">
                            <form id="formUploadImage">
                                <label for="image" class="d-flex justify-content-center align-items-center">
                                    <img src="{{ url('img/icon/uploadCamera.png') }}" alt=""
                                        style="height: 30px;">
                                    <div>Upload bukti pembayaran</div>
                                </label>
                                <input type="file" class="form-control" id="image" name="image"
                                    style="display: none" onchange="uploadFileImage();">
                            </form>
                            <div id="wrapImageUpload">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex justify-content-start">
                                        <img src="{{ url('img/icon/linkPath.png') }}" alt=""
                                            style="height: 20px;">
                                        <div style="margin-left: 15px;">
                                            <a target="_blank" rel="noopener noreferrer" href="#"
                                                id="filePathName"></a>
                                        </div>
                                    </div>
                                    <img src="{{ url('img/icon/trash.png') }}" alt="" style="height: 20px;"
                                        onclick="deleteTempImg();">
                                </div>
                            </div>
                        </span>
                    </div>
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
                {{-- <button type="button" class="btn btn-danger" onclick="deleteTabClick();">Delete</button> --}}
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="kirimTransfer();">Kirim</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Delete Reimburse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>Apakah yakin untuk menghapus request reimburse?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="backDeleteClick();">Back</button>
                {{-- <button type="button" class="btn btn-primary" onclick="deleteTransfer();">Delete</button> --}}
            </div>
        </div>
    </div>
</div>
@endsection