@extends('layouts.lte')

@section('title')
	Detail Layanan
@endsection

@section('content-header')
	<h1>
		Layanan
		<small>Detail Layanan {{ $layanan->name }}</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Detail Layanan {{ $layanan->name }}</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered">
							<tr>
								<th>NAMA</th>
								<td>{{ $layanan->name }}</td>
							</tr>
                            @if ($layanan->embeded)
							<tr>
								<th>YOUTUBE</th>
								<td>
                                    <iframe width="100%" height="350" src="https://www.youtube.com/embed/{{ $layanan->embeded }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </td>
                            </tr>
                            @endif
							<tr>
								<th>GAMBAR</th>
								<td><img src="{!! $layanan->image !!}" alt="{{ $layanan->name }}" class="img-responsive"></td>
							</tr>
							<tr>
								<th>TERBIT</th>
								<td>
									{!! $layanan->status ? '<span class="label label-success">Terbit</span>' : '<span class="label label-warning">Draf</span>' !!}
								</td>
							</tr>
							<tr>
								<th>KETERANGAN SINGKAT</th>
								<td>{{ $layanan->short_desc }}</td>
							</tr>
							<tr>
								<th>KETERANGAN</th>
								<td>{!! $layanan->description !!}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<a href="{{ route('layanan.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
			<a href="{{ route('layanan.edit', $layanan->id) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i> Edit</a>
			{{ Form::open(['route' => ['layanan.destroy', $layanan->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) }}
				<button type="submit" class="btn btn-flat btn-danger" onclick="return confirm('Yakin Hapus Data')"><i class="fa fa-trash"></i> Hapus</button>
			{{ Form::close() }}
		</div>
	</div>
@endsection
