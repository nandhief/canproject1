@extends('layouts.lte')

@section('title')
	Detail Lowongan Karir
@endsection

@section('content-header')
	<h1>
		Lowongan Karir
		<small>Detail Lowongan Karir {{ $vacancy->name }}</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Detail Lowongan Karir {{ $vacancy->name }}</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered">
							<tr>
								<th>NAMA</th>
								<td>{{ $vacancy->name }}</td>
								<th>LOKASI</th>
								<td>{{ $vacancy->lokasi }}</td>
                            </tr>
							<tr>
								<th>JENIS</th>
								<td>{{ $vacancy->jenis }}</td>
								<th>EXPIRED</th>
								<td>{{ $vacancy->expired }}</td>
                            </tr>
							<tr>
								<th>KUALIFIKASI</th>
								<td colspan="3">{!! $vacancy->kualifikasi !!}</td>
							</tr>
                            <tr>
                                <th>FASILITAS</th>
                                <td colspan="3">{!! $vacancy->fasilitas !!}</td>
                            </tr>
						</table>
					</div>
				</div>
			</div>
			<a href="{{ route('careers.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a> 
			<a href="{{ route('careers.vacancy.edit', $vacancy->id) }}" class="btn btn-flat btn-info"><i class="fa fa-edit"></i> Edit</a>
			{{ Form::open(['route' => ['careers.vacancy.delete', $vacancy->id], 'method' => 'DELETE', 'class' => 'pull-right']) }}
				<button type="submit" class="btn btn-flat btn-danger" onclick="return confirm('Yakin Hapus Data')"><i class="fa fa-trash"></i> Hapus</button>
			{{ Form::close() }}
		</div>
	</div>
@endsection
