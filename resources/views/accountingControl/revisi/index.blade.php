@extends('accountingControl.revisi.css')

@section('fillBody')
    <div class="d-flex justify-content-left">
        <a onclick="setTable(0)" style="cursor: pointer">To Do (</a>
        <div id="toDoCountSo"></div>
        <a>)/</a>
        <a onclick="setTable(1)" style="cursor: pointer">Done (</a>
        <div id="doneCountSo"></div>
        <a>)</a>
    </div>
    <div id="setTable"></div>
    @yield('revisi')
@endsection
