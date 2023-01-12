@extends('accountingControl.revisi.so.css')

@section('revisi')
    <button type="button" class="btn btn-secondary" id="revisiAllButton" onclick="revisiAllClick();">Revisi Semua</button>
    <div id="revisiAccept" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Revisi Data </h4>
                    <h4 class="modal-title" id="editTanggal"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    {{-- <h4 id="editItem"></h4>
                    <div class="input-group">
                        <input type="number" id="editQty" class="form-control" placeholder="0">
                        <div class="input-group-append">
                            <span class="input-group-text" id="satuan"></span>
                        </div>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="button" class="btn btn-info" value="Submit" onclick="submitRevSo()">
                </div>
            </div>
        </div>
    </div>
@endsection
