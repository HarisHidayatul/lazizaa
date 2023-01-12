@extends('accountingControl.revisi.css')

@section('fillBody')
    <div class="d-flex justify-content-between">
        <div class="d-flex justify-content-left">
            <a onclick="setTable(0)" style="cursor: pointer">To Do (</a>
            <div id="toDoCount"></div>
            <a>)/</a>
            <a onclick="setTable(1)" style="cursor: pointer">Done (</a>
            <div id="doneCount"></div>
            <a>)</a>
        </div>
        <div class="d-flex justify-content-right">
            <div>Start Date : </div>
            <input type="date" id="startDate">
            <div>End Date : </div>
            <input type="date" id="stopDate">
            {{-- <button type="button" class="btn btn-secondary" onclick="setDate()">Filter Date</button> --}}
        </div>
    </div>
    <div id="setTable" style="overflow-x: auto;"></div>


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

    @yield('revisi')
@endsection
