@extends('adminControl.setItem.sales.setType.css')

@section('subSetItemHTML')
    <form>
        <div class="form-row">
            <div class="form-group">
                <input type="text" class="form-control" id="tambahTypeSales" placeholder="Nama Type">
            </div>
            <div class="form-group">
                <button type="button" onclick="sendAddType();" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
    <table class="table table-striped" id="tableAllItem">
        <thead>
            <tr>
                <th>ID</th>
                <th>Type</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
