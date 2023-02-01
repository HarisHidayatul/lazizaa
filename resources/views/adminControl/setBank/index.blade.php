@extends('adminControl.setBank.css')

@section('fillBody')
    @yield('setBankHTML')
    <form>
        <div class="form-row">
            <div class="form-group">
                <input type="text" class="form-control" id="namaBank" placeholder="Nama Bank">
            </div>
            <div class="form-group col-sm-2">
                <select class="form-control" id="selectJenisBank">
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="imageBank" placeholder="Image Bank">
            </div>
            <div class="form-group">
                <button type="button" onclick="createBank();" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
    <table class="table table-striped" id="tableAllItem">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Bank</th>
                <th>Type</th>
                <th>Image</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
