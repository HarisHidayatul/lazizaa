@extends('adminControl.setItem.sales.outletType.css')

@section('subSetItemHTML')
    <form>
        <div class="form-row">
            <div class="form-group col-4">
                <select class="form-control" id="showOutletItem">
                </select>
            </div>
            <div class="form-group">
                <button type="button" onclick="setOutlet();" class="btn btn-secondary">Tampilkan</button>
            </div>
            <div class="form-group col-4">
                <select class="form-control" id="allItem">
                </select>
            </div>
            <div class="form-group">
                <button type="button" id="setItemButton" onclick="setItemOnOutlet();" class="btn btn-secondary" disabled>Set Item</button>
            </div>
        </div>
    </form>
    <table class="table table-striped" id="tableAllItem">
        <thead>
            <tr>
                <th>Item Sales</th>
                <th>Type</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
