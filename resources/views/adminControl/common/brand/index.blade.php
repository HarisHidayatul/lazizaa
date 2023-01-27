@extends('adminControl.common.brand.css')

@section('commonHTML')
    @yield('subCommonHTML')
    <form>
        <div class="form-row">
            <div class="form-group">
                <input type="text" class="form-control" id="namaBrand" placeholder="Nama Brand">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="keteranganBrand" placeholder="Keterangan Brand">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="logoBrand" placeholder="Logo Brand">
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
                <th>Brand</th>
                <th>Keterangan</th>
                <th>Lokasi Logo</th>
                <th>Gambar</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection