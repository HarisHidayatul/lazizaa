@extends('accountingControl.setItem.sales.listItem.css')

@section('subSetItemHTML')
    <form>
        <div class="form-row">
            <div class="form-group">
                <input type="text" class="form-control" id="addItemSalesOnType" placeholder="Nama Item">
            </div>
            <div class="form-group col-sm-2">
                <select class="form-control" id="selType">
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
                <th>Item Sales</th>
                <th>Type</th>
                <th>Verifikasi</th>
                <th>keywoard bee</th>
                <th>item bee</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
