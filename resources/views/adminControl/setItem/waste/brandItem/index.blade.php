@extends('adminControl.setItem.waste.brandItem.css')

@section('subSetItemHTML')
<form>
    <div class="form-row">
        <div class="form-group col-3">
            <select class="form-control" id="showBrandItem">
            </select>
        </div>
        <div class="form-group">
            <button type="button" onclick="getItemBrand();" class="btn btn-secondary">Tampilkan</button>
        </div>
        <div class="form-group col-3">
            <select class="form-control" id="dropDownJenis" onchange="refreshListItem();">
            </select>
        </div>
        <div class="form-group col-3">
            <select class="form-control" id="dropDownItem">
            </select>
        </div>
        <div class="form-group">
            <button type="button" id="setItemButton" onclick="sendItemOnBrand();" class="btn btn-secondary" disabled>Set Item</button>
        </div>
    </div>
</form>
<table class="table table-striped" id="tableAllItem">
    <thead>
        <tr>
            <th>ID</th>
            <th>Item</th>
            <th>Satuan</th>
            <th>Jenis</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection