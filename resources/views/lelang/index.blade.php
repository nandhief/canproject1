@extends('layouts.lte')

@section('title')
	Daftar Lelang
@endsection

@section('content-header')
	<h1>
		Lelang
		<small>Daftar Lelang</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<a href="{{ route('lelang.create') }}" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah</a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered {{ count($lelang) > 0 ? 'datatables':'' }}" style="width: 100%;">
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
								@if (count($lelang) < 1)
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
@endsection

@section('js')
	<script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
	<script src="{{ asset('plugins') }}/datatables/dataTables.yajra.min.js"></script>
	<script>
		$(document).ready(function () {
			$('.datatables').dataTable({
				ajax: "{{ route('lelang.index') }}",
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
                            return '<a href="{{ route('lelang.index') }}/' + data.id + '" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Lihat</a> <a href="{{ route('lelang.index') }}/' + data.id + '/edit" class="btn btn-xs btn-flat btn-info"><i class="fa fa-edit"></i> Edit</a> <form method="POST" action="{{  route('lelang.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
		});
	</script>
@endsection
