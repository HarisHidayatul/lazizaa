@extends('adminControl.setItem.satuan.css')

@section('setItemHTML')
    @yield('subSetItemHTML')
    <form>
        <div class="form-row">
            <div class="form-group">
                <input type="text" class="form-control" id="tambahNamaItem" placeholder="Nama Satuan">
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
                <th>Satuan</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
