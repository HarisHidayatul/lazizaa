@extends('accountingControl.dataDiIsi.css')

@section('fillBody')
    <div class="d-flex justify-content-right">
        <div>Start Date : </div>
        <input type="date" id="startDate">
        <div>End Date : </div>
        <input type="date" id="stopDate">
        <button type="button" class="btn btn-secondary" onclick="getAllDataExist()">Filter Date</button>
    </div>
    <div style="overflow-x: auto">
        <table class="table table-striped" id="statusInputTabel">
            <thead>
                <tr>
                    <td>Tanggal</td>
                    <td>Outlet</td>
                    <td></td>
                    <td>SO Harian</td>
                    <td></td>
                    <td></td>
                    <td>Sales Harian</td>
                    <td></td>
                    <td></td>
                    <td>Patty Cash</td>
                    <td></td>
                    <td></td>
                    <td>Waste</td>
                    <td></td>
                    <td>Reimburse</td>
                    <td>Setoran</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>HO</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection
