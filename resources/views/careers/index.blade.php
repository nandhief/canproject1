@extends('layouts.lte')

@section('title')
	Daftar Karir
@endsection

@section('content-header')
	<h1>
		Karir
		<small>Daftar Karir</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					Daftar Pelamar Karir
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered {{ count($careers) > 0 ? 'datatables':'' }}" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>NAMA</th>
									<th>EMAIL</th>
									<th>PHONE</th>
									<th>POSISI</th>
									<th>STATUS</th>
									<th data-orderable="false" data-searchable="false">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@if (count($careers) < 1)
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
    <div class="modal" id="show" tabindex="-1" role="dialog" aria-labelledby="modalShow" data-widget="modal-refresh">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Default Modal</h4>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="status" id="status" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""></label>
                            <input type="text" name="keterangan" id="keterangan" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
            window.show = function show(data) {
				$.get('{{ route('careers.index') }}/' + data, function (response) {
					$('#name').val(response.name);
					$('#email').val(response.email);
					$('#phone').val(response.phone);
				});
            }
			$('.datatables').dataTable({
				ajax: "{{ route('careers.index') }}",
                "deferRender": true,
                columns: [
                	{ data: 'id' },
                	{ data: 'name' },
                	{
                		data: null,
                		render: function (data) {
                			return '<a href="mailto:' + data.email + '">' + data.email + '</a>';
                		}
                	},
                	{ data: 'phone' },
                	{ data: 'posisi' },
                	{
                		data: null,
                		render: function (data) {
                			return data.status == 0 ? '<span class="label label-warning">BELUM DIPROSES</span>' : '<span class="label label-info">DIPROSES</span>';
                		}
                	},
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="{{ route('careers.index') }}/' + data.id + '" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Lihat</a> <form method="POST" action="{{  route('careers.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
		});
	</script>
@endsection
