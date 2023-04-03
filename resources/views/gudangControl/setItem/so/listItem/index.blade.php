@extends('gudangControl.setItem.so.listItem.css')

@section('soHtml')
<table class="table table-striped" id="tableAllItem">
    <thead>
        <tr>
            <th>Nama Item</th>
            <th>Satuan</th>
            <th>Kategori</th>
            <th>Path Icon</th>
            <th>Image</th>
            <th>Harian</th>
            <th>Mingguan</th>
            <th>Submit</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
{{-- <button type="button" class="btn btn-secondary" onClick="editAllItem();" style="float: right;">Edit All</button> --}}
@endsection