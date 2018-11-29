@extends('layouts.auth')

@section('title')
	{{ config('app.name') }} Login
@stop

@section('content')
	<div class="login-box">
		<div class="login-logo">
			<img src="{{ asset('logo-MAA.png') }}" alt="BPR MAA" class="img-responsive logo-img">
		</div>
		<div class="login-box-body">
            <div class="login-title">Login</div>
			<form action="{{ route('login') }}" method="post">
				{{ csrf_field() }}
				<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
					<input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" {{ empty(old('email')) ? 'autofocus' : ($errors->has('email') ? 'autofocus' : '') }}>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					@if ($errors->has('email'))
						<span class="help-block">{{ $errors->first('email') }}</span>
					@endif
				</div>
				<div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
					<input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}" {{ $errors->has('password') ? 'autofocus' : '' }}>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					@if ($errors->has('password'))
						<span class="help-block">{{ $errors->first('password') }}</span>
					@endif
				</div>
				<div class="row">
					<div class="col-xs-8">
						<div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ingat saya
                            </label>
						</div>
					</div>
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
					</div>
				</div>
			</form>
			<br>
			<a href="{{ route('password.request') }}">Lupa kata sandi</a><br>
		</div>
	</div>
@stop

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