@extends('layouts.auth')

@section('title')
    Reset Password
@stop

@section('content')

    <div class="login-box">
        <div class="login-logo">
            Reset Password
        </div>
        <div class="login-box-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
            </form>
        </div>
    </div>
@stop
