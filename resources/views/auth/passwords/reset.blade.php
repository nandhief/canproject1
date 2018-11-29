@extends('layouts.auth')

@section('title')
    {{ config('app.name') }} Reset Password
@stop

@section('content')

    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('logo-MAA.png') }}" alt="BPR MAA" class="img-responsive logo-img">
        </div>
        <div class="login-box-body">
            <div class="login-title">Reset Password</div>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" placeholder="E-Mail" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat"> Reset Password </button>
            </form>
        </div>
    </div>
@endsection

@section('css')
    <style>
        .logo-img {
            margin: 0px auto;
        }
        .login-title {
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            padding-bottom: 18px;
        }
        .login-page {
            background-image: url({{ asset('lte/img/background_login.jpg') }});
            background-size: cover;
            height: 90vh;
            background-position: center;
        }
        .login-box-body, .register-box-body {
            background: rgba(0, 0, 0, 0.48);
            padding: 20px;
            border-top: 0;
            color: #fff;
        }
        a {
            color: #fff;
        }
        a:hover {
            color: #eee;
            text-decoration: underline;
        }
        .form-group.has-error .help-block {
            color: #fff;
        }
    </style>
@endsection