@extends('adminControl.setItem.waste.listItem.css')

@section('subSetItemHTML')
<form>
    <div class="form-row">
        <div class="form-group">
            <input type="text" class="form-control" id="tambahNamaItem" placeholder="Nama Item">
        </div>
        <div class="form-group col-sm-2">
            <select class="form-control" id="showSatuanAdd">
            </select>
        </div>
        <div class="form-group col-sm-3">
            <select class="form-control" id="showJenisAdd">
            </select>
        </div>
        <div class="form-group">
            <button type="button" onclick="sendAddItem();" class="btn btn-secondary">Submit</button>
        </div>
    </div>
</form>
<table class="table table-striped" id="tableAllItem">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Item</th>
            <th>Satuan</th>
            <th>Jenis Bahan</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection