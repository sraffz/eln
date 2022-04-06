<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Ke Luar Negara: Log Masuk</title>
    <link rel="icon" type="image/png" href="{{ asset('img/sukk.png') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte-3/dist/css/adminlte.min.css') }}">
    <style>
        body {
            background-image: url('{{ asset('/img/mabna222.png') }}');
            background-size: cover;
            background-position: top center;
            align-items: center;
        }

    </style>
</head>

<body class="hold-transition login-page" filter-color="black">

    <div class="login-box">
        <div class="login-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('img/logoKelantan.png') }}" alt="" height="30%" width="30%">
                {{-- <h3>SISTEM PERMOHONAN KE LUAR NEGARA</h3> --}}
            </a>
        </div>
        <!-- /.login-logo -->
        <div class="card card-outline card-danger">
            <div class="card-header register-card-header text-center">
                <h3>SISTEM PERMOHONAN KE LUAR NEGARA</h3>
            </div>
            @if (session('status'))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="material-icons">close</i>
                            </button>
                            <span>{{ session('status') }}</span>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card-body login-card-body">
                <p class="login-box-msg">Masukan alamat email dan kata laluan baharu.</p>
                <form method="POST" action="{{ route('password.update') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-group mb-3">
                        <input type="email" name="email"
                            class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                            placeholder="Alamat Email" value="{{ $email ?? old('email') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password"
                            class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            placeholder="Kata laluan baru" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        placeholder="Taip Semula Kata laluan baru" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class=" ">
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Reset Kata Laluan') }}
                            </button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                    {{-- <a href="{{ url('password/reset') }}">Lupa Kata laluan</a> --}}
                </p>
                <p class="mb-0">
                    <a href="{{ url('login') }}" class="text-center">Log Masuk</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>

    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte-3/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte-3/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte-3/dist/js/adminlte.min.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>
