<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Preskool - Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.png') }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/flags/flags.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        .login-wrapper .loginbox {
            /* background-color: #fff; */
            /* border-radius: 8px; */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, .1); */
            display: flex;
            margin: 04rem auto;
            max-width: 950px;
            min-height: 500px;
            width: 100%;
        }

        .login-wrapper .loginbox .login-left {
            align-items: center;
            background: #18aefa;
            flex-direction: column;
            justify-content: flex-end;
            width: 400px;
            display: flex;
            border-radius: 20px;
            position: relative;
        }

        .login-left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(37, 3, 109, 0.50);
            border-radius: 20px;
        }

        .login-left {
            background-size: contain;
            background-repeat: no-repeat;
        }

        .login-right-wrap {
            /* display: flex; */
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            margin-right: 20px;
            /* Add spacing between logo and text */
        }

        .logo-section img {
            margin-right: 10px;
            /* Add spacing between logo and text */
        }

        .text-section {
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left"
                        style="background: url('{{ asset('assets/img/image-login.png') }}') center/cover, lightgray;">
                    </div>
                    <div class="login-right" style="margin-left: 80px;">
                        <div class="card" style="border-radius: 20px;">
                            <div class="card-body" style="padding: 43px; width: 400px;">
                                <div class="login-right-wrap">
                                    <div style="display: flex;">
                                        <div class="logo-section">
                                            <img src="{{ asset('assets/img/logo-jombang.png') }}" width="40px" />
                                        </div>
                                        <div class="text-section">
                                            <p class="p-0 m-0">Sistem Antrian Layanan</p>
                                            <h2 class="p-0 m-0">Badan Pendapatan Daerah</h2>
                                            <p class="p-0 m-0">Kabupaten Jombang</p>
                                        </div>
                                    </div>
                                    <br>
                                    <h2>Masuk</h2>
                                    @if (session('success'))
                                        <h1>{{ session('success') }}</h1>
                                    @endif
                                    {{-- Error Alert --}}
                                    @if (session('error'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ session('error') }}
                                            <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    <form action="{{ url('proses_login') }}" method="post">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label>Username <span class="login-danger">*</span></label>
                                            <input name="UserName" class="form-control" type="text">
                                            <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                            @if ($errors->has('UserName'))
                                                <span class="error">{{ $errors->first('UserName') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Password <span class="login-danger">*</span></label>
                                            <input name="password" class="form-control pass-input" type="password">
                                            <span class="profile-views feather-eye toggle-password"></span>
                                            @if ($errors->has('password'))
                                                <span class="error">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-block" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
