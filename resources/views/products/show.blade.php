@extends('layouts.lte')

@section('title')
	Detail Produk {{ ucwords($product->category) }}
@endsection

@section('content-header')
	<h1>
		Produk {{ ucwords($product->category) }}
		<small>Detail Produk {{ ucwords($product->category) }} {{ $product->name }}</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Detail Produk {{ ucwords($product->category) }} {{ $product->name }}</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered">
							<tr>
								<th>NAMA</th>
								<td>{{ $product->name }}</td>
							</tr>
							<tr>
								<th>Terbit</th>
								<td>
									{!! $product->status ? '<span class="label label-success">Terbit</span>' : '<span class="label label-warning">Draf</span>' !!}
								</td>
							</tr>
							<tr>
								<th>Short Description</th>
								<td>{{ $product->short_desc }}</td>
							</tr>
							<tr>
								<th>Description</th>
								<td>{!! $product->description !!}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<a href="{{ route('products.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
			<a href="{{ route('products.edit', $product->id) }}" class="btn btn-flat btn-warning"><i class="fa fa-edit"></i> Edit</a>
			{{ Form::open(['route' => ['products.destroy', $product->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) }}
				<button type="submit" class="btn btn-flat btn-danger" onclick="return confirm('Yakin Hapus Data')"><i class="fa fa-trash"></i> Hapus</button>
			{{ Form::close() }}
		</div>
	</div>
@endsection
