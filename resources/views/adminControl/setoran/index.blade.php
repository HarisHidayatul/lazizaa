@extends('adminControl.setoran.css')

@section('fillBody')
    @yield('setoranHTML')
    {{-- <div>adfas</div> --}}
    <form>
        <div class="form-row">
            <div class="form-group">
                <input type="text" class="form-control" id="namaRekeningPenerima" placeholder="Nama Rekening">
            </div>
            <div class="form-group">
                <input type="number" class="form-control" id="nomorRekeningPenerima" placeholder="Nomor Rekening">
            </div>
            <div class="form-group col-sm-2">
                <select class="form-control" id="selectBankPenerima">
                </select>
            </div>
            <div class="form-group">
                <button type="button" onclick="createIDPenerima();" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
    <table class="table table-striped" id="tableAllItem">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Rekening</th>
                <th>Nomor Rekening</th>
                <th>Bank</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
