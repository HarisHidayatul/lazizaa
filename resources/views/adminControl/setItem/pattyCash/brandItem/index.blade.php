@extends('adminControl.setItem.pattyCash.brandItem.css')

@section('subSetItemHTML')
<form>
    <div class="form-row">
        <div class="form-group col-4">
            <select class="form-control" id="showBrandItem">
            </select>
        </div>
        <div class="form-group">
            <button type="button" onclick="getItemBrand();" class="btn btn-secondary">Tampilkan</button>
        </div>
        <div class="form-group col-4">
            <select class="form-control" id="showAllItem">
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
            <th>Item Sales</th>
            <th>Satuan</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection