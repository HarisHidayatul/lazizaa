@extends('adminControl.common.outlet.css')

@section('commonHTML')
    @yield('subCommonHTML')
    <form>
        <div class="form-row">
            <div class="form-group col-4">
                <select class="form-control" id="dropDownBrand">
                </select>
            </div>
            <div class="form-group">
                <button type="button" onclick="getOutlet();" class="btn btn-secondary">Filter Brand</button>
            </div>
        </div>
    </form>
    <form>
        <div class="form-row">
            <div class="form-group">
                <input type="text" class="form-control" id="namaStore" placeholder="Nama Store">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="alamatStore" placeholder="Alamat Lengkap">
            </div>
            <div class="form-group">
                <button type="button" id="storeSubmitButton" onclick="sendAddItem();" class="btn btn-secondary" disabled>Submit Store</button>
            </div>
        </div>
    </form>
    <table class="table table-striped" id="tableAllItem">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Store</th>
                <th>Keterangan</th>
                <th>Brand</th>
                <th>Keywoard Bee</th>
                <th>Termin Bee</th>
                <th>Cabang Bee</th>
                <th>Gudang Bee</th>
                <th>Kas Bee</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
