@extends('accountingControl.setItem.pattyCash.jenisItem.css')

@section('subSetItemHTML')
<form>
    <div class="form-row">
        <div class="form-group">
            <input type="text" class="form-control" id="addJenisItem" placeholder="Jenis Item">
        </div>
        <div class="form-group col-sm-2">
            <select class="form-control" id="showKategoriAdd">
            </select>
        </div>
        <div class="form-group">
            <button type="button" onclick="sendAddJenis();" class="btn btn-secondary">Submit</button>
        </div>
    </div>
</form>
<table class="table table-striped" id="tableAllItem">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Jenis</th>
            <th>Kode Akun</th>
            <th>Kategori</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection