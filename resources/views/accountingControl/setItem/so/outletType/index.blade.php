@extends('accountingControl.setItem.so.outletType.css')

@section('subSetItemHTML')
    <form>
        <div class="form-row">
            <div class="form-group" style="width: 30%;">
                <select class="form-select" id='showOutletItem' style="width: 100%;">
                </select>
            </div>
            <div class="form-group">
                <button type="button" onclick="getItemOutlet();" class="btn btn-secondary">Pilih Outlet</button>
            </div>
            <div style="width: 10px;"></div>
            <div class="form-group" style="width: 30%;">
                <select class="form-select" id='showAllType' style="width: 100%;">
                </select>
            </div>
            <div class="form-group">
                <button type="button" id="buttonAddType" onclick="sendTypeOnOutlet();" class="btn btn-secondary" disabled>Tambahkan Tipe</button>
            </div>
        </div>
    </form>
    <div style="display: flex;" id="outletTypeOnItem">
    </div>
    <table class="table table-striped" id="tableAllItem">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Item</th>
                <th>Satuan</th>
                <th>Path Icon</th>
                <th>Harian</th>
                <th>Mingguan</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
