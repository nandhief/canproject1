@extends('layouts.lte')

@section('title')
	Daftar News
@endsection

@section('content-header')
	<h1>
		News
		<small>Daftar News</small>
	</h1>
@endsection

@section('content')
    <div class="response"></div>
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<a href="{{ route('news.create') }}" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah</a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered {{ count($news) > 0 ? 'datatables':'' }}" style="width: 100%;">
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
								@if (count($news) < 1)
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
	<script src="{{ asset('plugins') }}/datatables/plugins/fnReloadAjax.js"></script>
	<script>
		$(document).ready(function () {
			var table = $('.datatables').dataTable({
				ajax: "{{ route('news.index') }}",
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ data: 'name' },
                	{ data: 'short_desc' },
                	{
                		data: null,
                		render: function (data) {
                            var status = data.status == 0 ? '<span class="label label-warning">Draf</span>' : '<span class="label label-info">Terbit</span>'
                            var notif = data.notif == 0 ? '<button onclick="return push(' + data.id + ')" class="btn btn-xs btn-flat btn-info notif" data-toggle="tooltip" data-placement="top" title="Beritahu kesemua customer"><i class="fa fa-bell-o"></i></button>' : '<button class="btn btn-xs btn-flat btn-default" disabled data-toggle="tooltip" data-placement="top"><i class="fa fa-bell"></i></button>'
                			return status + ' ' + (data.status == 0 ? '' : notif)
                		}
                	},
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="{{ route('news.index') }}/' + data.id + '" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Lihat</a> <a href="{{ route('news.index') }}/' + data.id + '/edit" class="btn btn-xs btn-flat btn-info"><i class="fa fa-edit"></i> Edit</a> <form method="POST" action="{{  route('news.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
            window.push = function push(id) {
                $.ajax({
                    url: '{{ route('notifications') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        type: 'news',
                        id: id
                    },
                    beforeSend: function () {
                        $('.notif').attr('disabled', true);
                    },
                    success: function (result) {
                        $('.response').append(
							'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> ' + result.success + ' </div>'
						);
                        $('.notif').attr('disabled', false);
                        table.fnReloadAjax();
                    },
                    error: function (errors) {
                        var data = errors.responseJSON.errors
                        $('.response').append(
							'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> ' +  + ' </div>'
						);
                        $('.notif').attr('disabled', false);
                    }
                })
            }
		});
	</script>
@endsection
