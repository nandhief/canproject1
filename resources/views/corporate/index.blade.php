@extends('layouts.lte')

@section('title')
	Corporate
@endsection

@section('content-header')
	<h1>
		Corporate
		<small>Daftar Corporate</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<a href="{{ url('corporate/create') }}" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah</a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>NAMA</th>
									<th>JABATAN</th>
									<th>BIODATA</th>
									<th>FOTO</th>
									<th data-orderable="false" data-searchable="false">AKSI</th>
								</tr>
							</thead>
							<tbody>
								<td></td>
								<td></td>
								<td></td>
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
	
@endsection
