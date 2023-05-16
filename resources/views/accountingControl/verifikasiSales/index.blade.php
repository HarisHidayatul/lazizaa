@extends('accountingControl.verifikasiSales.css')

@section('fillBody')
    <div class="d-flex justify-content-between">
        <div>
            <select name="" id="selOutlet">
            </select>
            <select name="" id="selFilterSales">
            </select>
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
    <div class="d-flex justify-content-between">
        <div></div>
        <div>
            <button type="button" class="btn btn-secondary" onclick="setGenerateTransaksi();">Auto Generate Mutasi</button>
        </div>
    </div>
    <div style="width: 100%; overflow-x: auto">
        <div style="width: 1000px;">
            <table class="table table-striped" id="statusInputTabel">
                <thead>
                    <tr>
                        <td>Tanggal</td>
                        <td>Outlet</td>
                        <td>Item Sales</td>
                        <td>Jumlah (+/-)</td>
                        <td>Mutasi Jumlah</td>
                        <td>Fee</td>
                        <td>%</td>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <button type="button" class="btn btn-secondary float-right" onclick="downloadCSV();">Download CSV</button>
    </div>
    <div class="modal fade" id="mutasiModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Select Mutasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="content: ''; width: 1000px"></div>
                    <div class="d-flex justify-content-between">
                        <select name="" id="selPenerima">
                        </select>
                        <div class="d-flex justify-content-right">
                            <div>Start Date : </div>
                            <input type="date" id="startDate2">
                            <div>End Date : </div>
                            <input type="date" id="stopDate2">
                            <button type="button" class="btn btn-secondary" onclick="getTableMutasi()">Filter
                                Date</button>
                        </div>
                    </div>
                    <div style="content: ''; height: 25px;"></div>
                    <h5>Pilih Mutasi</h5>
                    <table class="table table-striped" style="width: 750px; border-collapse: collapse; table-layout: fixed;" id="tabelMutasi" style="margin-top: -50px">
                        <thead style="position: sticky;">
                            <tr>
                                <td>Select</td>
                                <td>Tanggal</td>
                                <td>Keterangan</td>
                                <td>Nominal</td>
                            </tr>
                        </thead>
                        <tbody style="display: block; height: 300px; overflow-y: scroll; width: 750px"></tbody>
                    </table>
                    
                    <h5>Item Sales</h5>
                    <table class="table table-striped" id="tabelSalesDipilih">
                        <thead>
                            <tr>
                                <td>Tanggal</td>
                                <td>Outlet</td>
                                <td>Sesi</td>
                                <td>Item Sales</td>
                                <td>Jumlah</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>

                    <h5>Mutasi Yang Dipilih</h5>
                    <table class="table table-striped" id="tabelMutasiDipilih">
                        <thead>
                            <tr>
                                <td>Tanggal</td>
                                <td>Keterangan</td>
                                <td>Nominal</td>
                                <td>Delete</td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="setMutasiFromSales();">Apply</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
