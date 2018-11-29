@extends('layouts.lte')

@section('title')
	Daftar Pengajuan Tabungan
@endsection

@section('content-header')
	<h1>
		Pengajuan Tabungan
		<small>Daftar Pengajuan Tabungan</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					Daftar Pengajuan Tabungan
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered {{ count($tabungan) > 0 ? 'datatables':'' }}" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>NAMA</th>
									<th>TANGGAL</th>
									<th>STATUS</th>
									<th data-orderable="false" data-searchable="false">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
								@if (count($tabungan) < 1)
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
				ajax: '{{ route('tabungan.index') }}',
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ data: 'customer.user.name' },
                	{ data: 'created_at' },
                    {
                        data: null,
                        render: function (data) {
                            switch (data.status) {
                                case null:
                                    $status = '<span class="label label-warning">BARU</span>'
                                    break;
                                case 0:
                                    $status = '<span class="label label-info">PROSES</span>'
                                    break;
                                case 1:
                                    $status = '<span class="label label-success">SELESAI</span>'
                                    break;
                            }
                            return $status;
                        }
                    },
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="{{ url('tabungan') }}/' + data.id + '" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Lihat</a> <form method="POST" action="{{ url('tabungan') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.customer.user.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
		});
	</script>
@endsection
