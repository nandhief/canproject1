@extends('layouts.auth')

@section('title')
	{{ config('app.name') }} Login
@stop

@section('content')

	<div class="login-box">
		<div class="login-logo">
			Login
		</div>
		<div class="login-box-body">
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
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                            </label>
						</div>
					</div>
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
					</div>
				</div>
			</form>
			<br>
			<a href="{{ route('password.request') }}">I forgot my password</a><br>
		</div>
	</div>

@stop