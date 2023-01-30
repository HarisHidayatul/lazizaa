@extends('adminControl.common.user.css')

@section('commonHTML')
    @yield('subCommonHTML')
    <form>
        <div class="form-row">
            <div class="form-group col-4">
                <select class="form-control" id="dropDownOutlet">
                </select>
            </div>
            <div class="form-group">
                <button type="button" onclick="getUser();" class="btn btn-secondary">Filter Outlet</button>
            </div>
        </div>
    </form>
    <form>
        <div class="form-row">
            <div class="form-group">
                <input type="text" class="form-control" id="namaInput" placeholder="Nama Lengkap">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="usernameInput" placeholder="Username">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="passwordInput" placeholder="Password">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="emailInput" placeholder="Email">
            </div>
            <div class="form-group">
                <select class="form-control" id="dropDownRoleInput">
                </select>
            </div>
            <div class="form-group">
                <button type="button" id="buttonClickSubmit" onclick="sendAddItem();" class="btn btn-secondary" disabled>Submit User</button>
            </div>
        </div>
    </form>
    <table class="table table-striped" id="tableAllItem">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Role</th>
                <th>Outlet</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
@endsection
