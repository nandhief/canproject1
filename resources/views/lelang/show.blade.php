@extends('layouts.lte')

@section('title')
	Detail Lelang
@endsection

@section('content-header')
	<h1>
		Lelang
		<small>Detail Lelang {{ $lelang->name }}</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Detail Lelang {{ $lelang->name }}</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered">
							<tr>
								<th>NAMA</th>
								<td>{{ $lelang->name }}</td>
							</tr>
							<tr>
								<th>TERBIT</th>
								<td>
									{!! $lelang->status ? '<span class="label label-success">Terbit</span>' : '<span class="label label-warning">Draf</span>' !!}
								</td>
							</tr>
							<tr>
								<th>GAMBAR</th>
								<td><img src="{!! $lelang->image !!}" alt="{{ $lelang->name }}" class="img-responsive"></td>
							</tr>
							<tr>
								<th>KETERANGAN SINGKAT</th>
								<td>{{ $lelang->short_desc }}</td>
							</tr>
							<tr>
								<th>KETERANGAN</th>
								<td>{!! $lelang->description !!}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<a href="{{ route('lelang.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
			<a href="{{ route('lelang.edit', $lelang->id) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i> Edit</a>
			{{ Form::open(['route' => ['lelang.destroy', $lelang->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) }}
				<button type="submit" class="btn btn-flat btn-danger" onclick="return confirm('Yakin Hapus Data')"><i class="fa fa-trash"></i> Hapus</button>
			{{ Form::close() }}
		</div>
	</div>
@endsection
