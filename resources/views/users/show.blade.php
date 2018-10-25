@extends('layouts.lte')

@section('title')
	Detail Pengguna
@endsection

@section('content-header')
	<h1>
		Pengguna
		<small>Detail Pengguna {{ $user->name }}</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Detail Data {{ $user->name }}</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered">
							<tr>
								<th>NAMA</th>
								<td>{{ $user->name }}</td>
							</tr>
							<tr>
								<th>EMAIL</th>
								<td>{{ $user->email }}</td>
                            </tr>
                            @if ($user->broker)
                                <tr>
                                    <th>ALAMAT</th>
                                    <td>{{ $user->broker->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>NO HP</th>
                                    <td>{{ $user->broker->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>FOTO KTP</th>
                                    <td>{{ $user->broker->foto_ktp }}</td>
                                </tr>
                            @endif
                            @if ($user->customer)
                                <tr>
                                    <th>ALAMAT</th>
                                    <td>{{ $user->customer->alamat }}</td>
                                </tr>
                                <tr>
                                    <th>NO HP</th>
                                    <td>{{ $user->customer->no_hp }}</td>
                                </tr>
                                <tr>
                                    <th>FOTO KTP</th>
                                    <td>{{ $user->customer->foto_ktp }}</td>
                                </tr>
                                <tr>
                                    <th>PENGAJUAN TABUNGAN</th>
                                    <td>{{ $user->customer->tabungan }}</td>
                                </tr>
                                <tr>
                                    <th>PENGAJUAN KREDIT</th>
                                    <td>{{ $user->customer->kredit }}</td>
                                </tr>
                            @endif
						</table>
					</div>
				</div>
			</div>
			<a href="{{ route('users.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
			<a href="{{ route('users.edit', $user->id) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i> Edit</a>
			{{ Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) }}
				<button type="submit" class="btn btn-flat btn-danger" onclick="return confirm('Yakin Hapus Data')"><i class="fa fa-trash"></i> Hapus</button>
			{{ Form::close() }}
		</div>
	</div>
@endsection
