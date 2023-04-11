@extends('accountingControl.saldoPattyCash.css')

@section('fillBody')
<div class="float-right">
    <div class="d-flex justify-content-start">
        <button type="button" class="btn btn-secondary" onclick="refreshData();">Refresh Data</button>
    </div>
</div>
<div style="overflow-x: auto">
    <table class="table table-striped" id="statusInputTabel">
        <thead>
            <tr>
                <td>Outlet</td>
                <td>Saldo</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
@endsection