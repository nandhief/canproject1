@extends('layouts.lte')

@section('title')
    Pengaturan
@endsection

@section('content-header')
    <h1>
        Pengaturan
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active">
                        <a href="#user" data-toggle="tab" aria-expanded="false">Profile Pengguna</a>
                    </li>
					<li class="">
                        <a href="#setting" data-toggle="tab" aria-expanded="false">Pengaturan Website</a>
                    </li>
					<li class="">
                        <a href="#history" data-toggle="tab" aria-expanded="false">History</a>
                    </li>
					<li class="pull-right header"><i class="fa fa-wrench"></i> Pengaturan</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade in active" id="user">
						<div class="">
							<table class="table table-hover tabler-bordered">
								<thead>
									<tr>
										<th>NAMA</th>
										<th>EMAIL</th>
										<th data-orderable="false" data-searchable="false">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
                                    <tr>
                                        <td colspan="10">Tidak Ada Data</td>
                                    </tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="setting">
						<div class="">
							<table class="table table-hover tabler-bordered">
								<thead>
									<tr>
										<th>NAMA</th>
										<th>EMAIL</th>
										<th data-orderable="false" data-searchable="false">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
                                    <tr>
                                        <td colspan="10">Tidak Ada Data</td>
                                    </tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class="tab-pane fade" id="history">
						<div class="">
							<table class="table table-hover tabler-bordered">
								<thead>
									<tr>
										<th>NAMA</th>
										<th>EMAIL</th>
										<th data-orderable="false" data-searchable="false">&nbsp;</th>
									</tr>
								</thead>
								<tbody>
                                    <tr>
                                        <td colspan="10">Tidak Ada Data</td>
                                    </tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection
