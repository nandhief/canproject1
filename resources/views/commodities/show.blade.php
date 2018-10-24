@extends('layouts.lte')

@section('title')
	Detail Commodity
@endsection

@section('content-header')
	<h1>
		Commodity
		<small>Detail Commodity {{ $commodity->name }}</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Detail Commodity {{ $commodity->name }}</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered">
							<tr>
								<th>NAMA</th>
								<td>{{ $commodity->name }}</td>
							</tr>
                            @if ($commodity->embeded)
							<tr>
								<th>YOUTUBE</th>
								<td>
                                    <iframe width="100%" height="350" src="https://www.youtube.com/embed/{{ $commodity->embeded }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </td>
                            </tr>
                            @endif
							<tr>
								<th>Terbit</th>
								<td>
									{!! $commodity->status ? '<span class="label label-success">Terbit</span>' : '<span class="label label-warning">Draf</span>' !!}
								</td>
							</tr>
							<tr>
								<th>Short Description</th>
								<td>{{ $commodity->short_desc }}</td>
							</tr>
							<tr>
								<th>Description</th>
								<td>{!! $commodity->description !!}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<a href="{{ route('commodities.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
			<a href="{{ route('commodities.edit', $commodity->id) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i> Edit</a>
			{{ Form::open(['route' => ['commodities.destroy', $commodity->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) }}
				<button type="submit" class="btn btn-flat btn-danger" onclick="return confirm('Yakin Hapus Data')"><i class="fa fa-trash"></i> Hapus</button>
			{{ Form::close() }}
		</div>
	</div>
@endsection
