@extends('adminControl.setItem.so.setType.css')

@section('subSetItemHTML')
    <form>
        <div class="form-row">
            <div class="form-group" style="width: 50%;">
                <input type="text" class="form-control" id="tambahType" placeholder="Nama Type">
            </div>
            <div class="form-group" style="width: 10%;">
                <button type="button" onclick="sendAddType();" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
    <table class="table table-striped" id="tableEditType">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama Type</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <div style="height: 50px;"></div>
    <form>
        <div class="form-row">
            <div class="form-group" style="width: 20%;">
                <select class="form-select" id='selType' style="width: 100%;">
                </select>
            </div>
            <div class="form-group">
                <button type="button" onclick="setType()" class="btn btn-secondary">Pilih Type</button>
            </div>
            <div style="width: 10px;"></div>
            <div class="form-group" style="width: 20%;">
                <select class="form-select" id='selItemOnType' style="width: 100%;">
                </select>
            </div>
            <div class="form-group">
                <button type="button" id="btnTambahItem" onclick="sendItemOnType();" class="btn btn-secondary" disabled>Tambahkan Item</button>
            </div>
        </div>
    </form>
    <table class="table table-striped" id="tableTypeItem">
        <thead>
            <tr>
                <th>Id</th>
                <th>Item</th>
                <th>Satuan</th>
                <th>Image</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
