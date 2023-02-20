@extends('accountingControl.setItem.so.listItem.css')

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
            <div class="form-group">
                <input type="text" class="form-control" id="locationItem" placeholder="Location Icon">
            </div>
            <div class="form-group">
                <button type="button" onclick="sendAddItem();" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
    <table class="table table-striped" id="tableAllItem">
        <thead>
            <tr>
                <th>Nama Item</th>
                <th>Satuan</th>
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
@endsection
