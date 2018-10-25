@extends('layouts.lte')

@section('title')
	Tambah Pengguna
@endsection

@section('content-header')
	<h1>
		Pengguna
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Tambah Pengguna</h3>
				</div>
				<div class="box-body">
					{{ Form::open(['route' => 'users.store']) }}
					<div class="row">
						<div class="form-group col-md-6 col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name">Nama *</label>
							{{ Form::text('name', old('name'), ['class' => 'form-control', 'autofocus' => true]) }}
							@if ($errors->has('name'))
								<span class="help-block">{{ $errors->first('name') }}</span>
							@endif
						</div>
						<div class="form-group col-md-6 col-sm-6 {{ $errors->has('email') ? 'has-error' : '' }}">
							<label for="email">Email *</label>
							{{ Form::email('email', old('email'), ['class' => 'form-control']) }}
							@if ($errors->has('email'))
								<span class="help-block">{{ $errors->first('email') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-6 col-sm-6 {{ $errors->has('password') ? 'has-error' : '' }}">
							<label for="password">Password *</label>
							{{ Form::password('password', ['class' => 'form-control']) }}
							@if ($errors->has('password'))
								<span class="help-block">{{ $errors->first('password') }}</span>
							@endif
						</div>
						<div class="form-group col-md-6 col-sm-6 {{ $errors->has('roles') ? 'has-error' : '' }}">
							<label for="roles">Wewenang *</label>
							{{ Form::select('roles', $roles, old('roles'), ['class' => 'form-control select2']) }}
							@if ($errors->has('roles'))
								<span class="help-block">{{ $errors->first('roles') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12 col-sm-12">
							<a href="{{ route('users.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
							<button type="submit" class="btn btn-primary btn-flat">Simpan</button>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
@endsection

@section('js')
	<script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('.select2').select2();
		});
	</script>
@endsection
