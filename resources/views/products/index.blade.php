@extends('layouts.lte')

@section('title')
	Daftar Produk Dana & Kredit
@endsection

@section('content-header')
	<h1>
		Produk Dana & Kredit
		<small>Daftar Produk Dana & Kredit</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<span><strong>DANA</strong></span><a href="{{ route('products.create') }}?category=dana" class="btn btn-sm btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Tambah</a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered {{ count($dana) > 0 ? 'datatables':'' }}" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>NAMA</th>
									<th>KONTEN</th>
									<th>PUBLISH</th>
									<th data-orderable="false" data-searchable="false">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@if (count($dana) < 1)
									<tr>
										<td colspan="10">Tidak Ada Data</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<span><strong>KREDIT</strong></span><a href="{{ route('products.create') }}?category=kredit" class="btn btn-sm btn-primary btn-flat pull-right"><i class="fa fa-plus"></i> Tambah</a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered {{ count($kredit) > 0 ? 'datatables':'' }}" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>NAMA</th>
									<th>KONTEN</th>
									<th>PUBLISH</th>
									<th data-orderable="false" data-searchable="false">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@if (count($kredit) < 1)
									<tr>
										<td colspan="10">Tidak Ada Data</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('css_up')
	<link rel="stylesheet" href="{{ asset('plugins') }}/datatables/dataTables.bootstrap.css">
	<style>
		.box-header>span {
			font-size: 18px;
		}
	</style>
@endsection

@section('js')
	<script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
	<script src="{{ asset('plugins') }}/datatables/dataTables.yajra.min.js"></script>
	<script>
		$(document).ready(function () {
			$('.dana').dataTable({
				ajax: "{{ route('products.index') }}",
                "deferRender": true,
                columns: [
                	{ data: 'id' },
                	{
                		data: null,
                		render: function (data) {
                			return '<a href="{{ url('') }}/' + data.slug + '" target="_blank">' + data.name + '</a>';
                		}
                	},
                	{ data: 'short_desc' },
                	{
                		data: null,
                		render: function (data) {
                			return data.status == 0 ? '<span class="label label-warning">Draf</span>' : '<span class="label label-info">Terbit</span>';
                		}
                	},
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="{{ route('products.index') }}/' + data.id + '" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Lihat</a> <a href="{{ route('products.index') }}/' + data.id + '/edit" class="btn btn-xs btn-flat btn-info"><i class="fa fa-edit"></i> Edit</a> <form method="POST" action="{{  route('products.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
			$('.kredit').dataTable({
				ajax: "{{ route('products.index') }}",
                "deferRender": true,
                columns: [
                	{ data: 'id' },
                	{
                		data: null,
                		render: function (data) {
                			return '<a href="{{ url('') }}/' + data.slug + '" target="_blank">' + data.name + '</a>';
                		}
                	},
                	{ data: 'short_desc' },
                	{
                		data: null,
                		render: function (data) {
                			return data.status == 0 ? '<span class="label label-warning">Draf</span>' : '<span class="label label-info">Terbit</span>';
                		}
                	},
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="{{ route('products.index') }}/' + data.id + '" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Lihat</a> <a href="{{ route('products.index') }}/' + data.id + '/edit" class="btn btn-xs btn-flat btn-info"><i class="fa fa-edit"></i> Edit</a> <form method="POST" action="{{  route('products.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
		});
	</script>
@endsection
