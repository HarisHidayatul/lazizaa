<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Form</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <style>
        .picture{
            margin: 10px 30px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-primary">
            <div class="card-body">
                <img src="/img/loadImage.JPG" class="mb-1 picture" alt="">
                <p class="login-box-msg">Pelaporan Administrasi Outlet</p>
                <form action="#" method="post">
                    <div class="mb-1">Username</div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-white border-md border-right-0">
                                <span class="fas fa-user-alt"></span>
                            </div>
                        </div>
                        <input type="email" class="form-control bg-white border-left-0 border-md">
                    </div>
                    <div class="mb-1">Kata Sandi</div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text bg-white border-md border-right-0">
                                <span class="fas fa-key"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control bg-white border-left-0 border-md">
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-block">Masuk</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
