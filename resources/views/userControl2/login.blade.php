<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Form Lazizaa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700&display=swap');

        .login-form {
            width: 340px;
            margin: 50px auto;
            font-size: 15px;
        }

        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .login-form h2 {
            margin: 0 0 15px;
        }

        .form-control,
        .btn {
            min-height: 38px;
            border-radius: 2px;
        }

        .btn {
            font-size: 15px;
            font-weight: bold;
        }

        body {
            background-color: #B20731;
        }

        h3 {
            font-size: 34px;
            /* Semibold/XL */
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            /* or 29px */
            text-align: center;
            color: #FFFFFF;
            margin-top: -60px;
            line-height: 30px;
        }

        h1 {
            font-size: 32px;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 700;
            line-height: 120%;
            color: #27272E;
        }

        h2 {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 140%;
            color: #27272E;
        }

        .head {
            margin: auto 10%;
            /* background-color: #f7f7f7; */
        }

        img {
            margin-top: -40px;
            width: 250px;
            justify-content: center;
        }

        .bottom {
            background-color: white;
            /* border-radius: 36px 36px 36px 36px; */
            margin-top: 30px;
            height: 450px;
        }

        .wrap-form {
            padding: 26px 30px;
        }

        .border-login {
            border: 4px solid #B20731;
            width: 53px;
            margin-left: 3px;
            margin-top: -3px;
            border-radius: 2px;
        }

        form {
            margin-top: 25px;
            /* background-color: #27272E; */
        }

        .inputForm {
            background: #FFFFFF;
            border: 1px solid #F1F1F1;
            box-shadow: 0px 3px 8px rgba(28, 28, 95, 0.05);
            border-radius: 8px;
        }

        .form-group {
            margin-top: 30px;
             !important
        }

        .block {
            margin-top: 40px;
            background: #B20731;
            border-radius: 8px;
            width: 100%;
            border: none;
            padding: 14px 28px;
            cursor: pointer;
            text-align: center;
            color: white;
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
            line-height: 13px;
        }

        .btn:hover {
            background: white;
            color: #B20731;
        }

        .textSavePassword {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            /* identical to box height, or 20px */

            align-items: center;
            text-align: right;

            /* Greyscale/40 */

            color: #9C9C9C;

        }

        .checkBox {
            background: #FFFFFF;
            border: 1px solid #F1F1F1;
            box-shadow: 0px 3px 8px rgba(28, 28, 95, 0.05);
            border-radius: 8px;
        }

        .containAll {
            /* max-width: 750px; */
        }

        @media only screen and (min-width: 600px) {
            .containAll {
                /* margin-left: 25vw; */
            }

            .bottom {
                border-radius: 36px 36px 36px 36px;
            }
        }

        @media only screen and (max-width: 600px) {
            .bottom {
                border-radius: 36px 36px 0 0;
            }
        }

        .footer {
            margin-top: 50px;
            width: 100%;
            background: #B20731;
        }

        .imgFooter {
            height: 105px;
            width: 120px;
            margin-bottom: -25px;
        }

        .tittleFooter {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            text-align: center;
            color: #FFFFFF;
            padding-bottom: 20px;
        }

        .borderFooter {
            left: 30px;
            width: 85vw;
            max-width: 400px;
            border-bottom: 1px solid #FFFFFF;
        }

        .socialMediaLabel {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 14px;
            line-height: 140%;
            text-align: center;
            color: #FFFFFF;
            margin-top: 25px;
        }

        .footerLaporta {
            font-family: 'Montserrat';
            font-style: normal;
            font-weight: 600;
            font-size: 12px;
            line-height: 15px;
            /* identical to box height */

            text-align: center;

            color: #FFFFFF;

        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center containAll">
        <div>
            <div class="row justify-content-center head">
                <img src="img/lazizaaHome.png" alt="">
                <h3>Laporta</h3>
            </div>
            <div class="bottom">
                <div class="wrap-form">
                    <h1>Log in</h1>
                    <div class="border-login"></div>
                    <form action="{{ url('user/login') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <h2>Username</h2>
                            <input type="text" name="username" class="form-control inputForm"
                                placeholder="Masukkan username" autofocus>
                        </div>
                        <div class="form-group">
                            <h2>Kata Sandi</h2>
                            <input type="password" name="password" class="form-control inputForm"
                                placeholder="Masukkan kata sandi">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input checkBox" id="exampleCheck1">
                            <label class="form-check-label textSavePassword" for="exampleCheck1">Simpan kata
                                sandi?</label>
                        </div>
                        <button type="submit" class="btn block">Log in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center footer">
        <div>
            <div class="d-flex justify-content-center">
                <img class="imgFooter" src="{{ url('img/lazizaaHome.png') }}" alt="">
            </div>
            <div class="tittleFooter">PT LAZIZAA RAHMAT SEMESTA</div>
            <div class="d-flex justify-content-center borderFooter"></div>
            <div class="socialMediaLabel">Social media</div>
            <div class="d-flex justify-content-center" style="margin-top: 60px;">
                <img src="{{ url('img/icon/instagram.png') }}" alt="" style="height: 20px; width: 20px;">
                <div style="width: 40px;"></div>
                <img src="{{ url('img/icon/facebook.png') }}" alt="" style="width: 12px; height: 23px;">
                <div style="width: 40px;"></div>
                <img src="{{ url('img/icon/whatsapp.png') }}" alt="" style="width: 24px; height: 24px;">
            </div>
            <div style="height: 20px;"></div>
            <div class="footerLaporta"><span style="font-size: 16px; margin-top: 5px;">&#169;</span> 2022 - Laporta</div>
        </div>
    </div>

    </div>
    {{-- <div class="login-form">
        <form action="{{ url('user/login') }}" method="post">
            @csrf
            <h2 class="text-center">Log in</h2>
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="username" required="required">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="password" required="required">
            </div>
            @if (session('message'))
                <div class="alert alert-danger alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>x</span>
                        </button>
                        {{ session('message') }}
                    </div>
                </div>
            @endif
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Log in</button>
            </div>
        </form>
    </div> --}}
</body>

</html>
