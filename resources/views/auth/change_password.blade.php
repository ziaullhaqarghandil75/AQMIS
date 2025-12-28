<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KM Procurement Contract System</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Vazirmatn", sans-serif;
            background-image: url('{{ asset('images/background1.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            margin: 0;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 0;
        }

        .card.glass-effect {
            position: relative;
            z-index: 1;
            width: 420px;
            border: none;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
            color: #fff;
            overflow: hidden;
            animation: fadeIn 0.8s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-body {
            padding: 2rem;
        }

        img {
            border-radius: 12px;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.2);
            padding: 8px;
        }

        h5 {
            color: #fff;
        }

        label {
            font-weight: 600;
            color: #fff;
        }

        input.form-control {
            border-radius: 10px;
            padding: 10px 12px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
        }

        input.form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .btn-primary {
            background: linear-gradient(45deg, #00c6ff, #0072ff);
            border: none;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #0072ff, #00c6ff);
            transform: translateY(-2px);
        }

        .alert {
            font-size: 0.9rem;
            background: rgba(255, 255, 255, 0.25);
            border: none;
            color: #fff;
        }

        ul {
            text-align: right;
        }
    </style>
</head>

<body>

    <div class="card glass-effect">
        <div class="card-body text-center">
            <a href="javascript:void(0)">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="height: 100px;">
            </a>
            @if (auth()->user()->first_login != 1)
                <h5 class="mb-3 fw-bold">تغییر رمز عبور</h5>
                <form id="msform" method="POST" action="{{ route('new.password.store') }}">
                    @method('put')
                    @csrf

                    <div class="alert alert-success" role="alert">
                        <strong>لطفاً رمز عبور خود را تعویض نمائید.</strong>
                    </div>

                    <div class="alert alert-warning text-end" role="alert">
                        <strong>نوت:</strong> رمز عبور باید شامل حروف بزرگ، کوچک، اعداد و سمبول باشد.
                    </div>

                    <div class="mb-3 text-end">
                        <label for="password" class="form-label">رمز عبور جدید</label>
                        <input type="password" id="password" name="password" placeholder="رمز عبور جدید"
                            class="form-control @error('password') is-invalid @enderror">
                    </div>

                    <div class="mb-4 text-end">
                        <label for="password_confirmation" class="form-label">تائید رمز عبور جدید</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="تائید رمز عبور جدید"
                            class="form-control @error('password_confirmation') is-invalid @enderror">
                    </div>
                    @if ($errors->any())
                        <div class="bg-danger text-end mb-3" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $key => $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary btn-lg w-100 text-white">تغییر رمز عبور</button>
                </form>
            @else
                <div class="alert alert-info text-center">
                    <h3>رمز عبور شما تغییر کرده است.</h3>
                </div>
                <a href="{{ route('dashboard') }}" class="btn btn-info rounded-pill">بازگشت داشبورد</a>
            @endif
        </div>
    </div>

</body>

</html>
