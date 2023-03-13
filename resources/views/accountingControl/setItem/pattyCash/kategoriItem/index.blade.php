@extends('accountingControl.setItem.pattyCash.kategoriItem.css')

@section('subSetItemHTML')
<form>
    <div class="form-row">
        <div class="form-group">
            <input type="text" class="form-control" id="addKategori" placeholder="Nama Kategori">
        </div>
        <div class="form-group">
            <button type="button" onclick="sendAddKategori();" class="btn btn-secondary">Submit</button>
        </div>
    </div>
</form>
<table class="table table-striped" id="tableAllItem">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kategori</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@endsection