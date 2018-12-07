@extends('layouts.lte')

@section('title')
	Daftar Customer dan Broker
@endsection

@section('content-header')
	<h1>
		Customer dan Broker
		<small>Daftar Customer dan Broker</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
            <div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#broker" data-toggle="tab" aria-expanded="false">Broker</a></li>
					<li class=""><a href="#customer" data-toggle="tab" aria-expanded="false">Customer</a></li>
					<li class="pull-right header"><i class="fa fa-users"></i> Customer & Broker</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="broker">
						<div class="">
							<table class="table table-hover tabler-bordered brokers" style="width: 100%;">
								<thead>
									<tr>
										<th data-searchable="false">#</th>
										<th>NAMA</th>
										<th>EMAIL</th>
										<th>NO HP</th>
										<th data-orderable="false" data-searchable="false">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									@if (count($brokers) < 1)
										<tr>
											<td colspan="10">Tidak Ada Data</td>
										</tr>
									@endif
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="customer">
						<div class="">
							<table class="table table-hover tabler-bordered customers" style="width: 100%;">
								<thead>
									<tr>
										<th data-searchable="false">#</th>
										<th>FOTO</th>
										<th>NAMA</th>
										<th>EMAIL</th>
										<th>NO HP</th>
										<th>ALAMAT</th>
										<th>PENGAJUAN</th>
										<th data-orderable="false" data-searchable="false">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
									@if (count($customers) < 1)
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
			$('.brokers').dataTable({
				ajax: {
					dataSrc: 'databrokers'
				},
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ 
                		data: null,
                		render: function (data) {
                			return data.name;
                		}
                	},
                	{ 
                		data: null,
                		render: function (data) {
                			return data.email;
                		}
                	},
                	{ 
                		data: null,
                		render: function (data) {
                			return data.phone;
                		}
                	},
                    { 
                        data: null,
                        render: function (data) {
                            return '<a href="{{ route('users.index') }}/' + data.id + '" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Lihat</a> <form method="POST" action="{{  route('users.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
			$('.customers').dataTable({
				ajax: {
					dataSrc: 'datacustomers'
				},
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ 
                		data: null,
                		render: function (data) {
                			return '<img src="' + data.foto + '" width="100px">';
                		}
                	},
                	{ 
                		data: null,
                		render: function (data) {
                			return data.name;
                		}
                	},
                	{ 
                		data: null,
                		render: function (data) {
                			return data.email;
                		}
                	},
                	{ 
                		data: null,
                		render: function (data) {
                			return data.phone;
                		}
                	},
                	{ 
                		data: null,
                		render: function (data) {
                			return data.customer.alamat;
                		}
                	},
                	{ 
                		data: null,
                		render: function (data) {
                			return (data.customer.tabungan_status == 0 ? '' : '<span class="label label-success">Tabungan</span> ') + (data.customer.credit_status == 0 ? '' : ' <span class="label label-info">Kredit</span>');
                		}
                	},
                    { 
                        data: null,
                        render: function (data) {
                            return '<a href="{{ route('users.index') }}/' + data.id + '" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Lihat</a> <form method="POST" action="{{  route('users.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
		});
	</script>
@endsection
