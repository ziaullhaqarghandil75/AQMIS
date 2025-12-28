<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KM System</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="{{ asset('global_assets/css/icons/icomoon/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/bootstrap_limitless.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/layout.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/components.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        .glass-effect {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 0;
        }
    </style>
</head>

<body
    style="background-image: url('{{ asset('images/background.jpeg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content d-flex justify-content-center align-items-center">
                <!-- Login form -->
                <form class="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card mb-0 glass-effect">
                        <div class="card-body">
                            <div class="text-center">
                                <img src="{{ asset('images/logo.png') }}" class="rounded-circle mt-2" style="background-color: white;" width="110px"
                                    height="110px" alt="">
                                <h4 class="mb-0 mt-2 text-white">شاروالی کابل</h4>
                                <h6 class="d-block text-white">سیستم معلوماتی</h6>
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@mail.com"
                                value="{{ old('email') }}" required>
                                <div class="form-control-feedback">
                                    <i class="icon-user"></i>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback bg-whtite">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group form-group-feedback form-group-feedback-left">
                                <input type="password" name="password" id="password" class="form-control"
                                    value="{{ old('password') }}" required placeholder="رمز عبور خویش را وارد نماید!">
                                <div class="form-control-feedback">
                                    <i class="icon-lock2"></i>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback bg-whtite">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">ورود <i
                                        class="icon-circle-left2 ml-2"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
