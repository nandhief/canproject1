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
					Daftar Lowongan Karir
                    <a href="{{ route('careers.create') }}" class="btn btn-primary btn-flat btn-sm pull-right"><i class="fa fa-plus"></i> Tambah Lowongan</a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered vacancies" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>LOWONGAN</th>
									<th>LOKASI</th>
									<th>JENIS</th>
									<th>BERAKHIR</th>
									<th data-orderable="false" data-searchable="false">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="box box-primary">
				<div class="box-header">
					Daftar Pelamar Karir
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered careers" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>NAMA</th>
									<th>EMAIL</th>
									<th>PHONE</th>
									<th>POSISI</th>
									<th>TGL DAFTAR</th>
									<th>STATUS</th>
									<th data-orderable="false" data-searchable="false">&nbsp;</th>
								</tr>
							</thead>
							<tbody>
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
			$('.vacancies').dataTable({
				ajax: {
					dataSrc: 'data_vacancies'
				},
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ data: 'name' },
                	{ data: 'lokasi' },
                	{ data: 'jenis' },
                	{ data: 'expired' },
                    {
                        data: null,
                        render: function (data) {
                            return '<a href="{{ url('careers/detail') }}/' + data.id + '" class="btn btn-xs btn-flat btn-primary"><i class="fa fa-eye"></i> Lihat</a> <a href="{{ url('careers/detail') }}/' + data.id + '/edit" class="btn btn-xs btn-flat btn-info"><i class="fa fa-edit"></i> Edit</a> <form method="POST" action="{{ url('careers/detail') }}/' + data.id + '/delete" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
			$('.careers').dataTable({
				ajax: {
					dataSrc: 'data_careers'
				},
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ data: 'name' },
                	{
                		data: null,
                		render: function (data) {
                			return '<a href="mailto:' + data.email + '">' + data.email + '</a>';
                		}
                	},
                	{ data: 'phone' },
                	{ data: 'vacancy.name' },
                	{ data: 'created_at' },
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
