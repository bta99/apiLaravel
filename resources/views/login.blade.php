<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Blank Page</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('css/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body style="display:flex;justify-content: center;align-items: center">
    <div class="form-login" style="background-color: gainsboro;padding:30px;border-radius:10px">
        <h3 class="text-center text-info">Đăng Nhập</h3>
        <form action="{{ route('login-post') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="" class="form-control" style="width:300px"
                    placeholder="tên đăng nhập">
                @if ($errors->has('email'))
                    <h5 class="text-danger"> {{ $errors->first('email') }}</h5>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="" class="form-control" placeholder="mật khẩu">
                @if ($errors->has('password'))
                    <h5 class="text-danger"> {{ $errors->first('password') }}</h5>
                @endif
            </div>

            <div class="form-group">
                <label for="remember">remember</label>
                <input type="checkbox" name="remember">
            </div>

            @if ($errors->has('faild'))
                <h5 class="text-danger"> {{ $errors->first('faild') }}</h5>
            @endif
            <button class="btn btn-xl btn-primary">Login</button>
        </form>
    </div>
</body>

</html>
