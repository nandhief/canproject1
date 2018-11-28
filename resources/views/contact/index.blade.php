@extends('layouts.lte')

@section('title')
	Contact
@endsection

@section('content-header')
	<h1>
		Contact
		<small>Daftar Kontak</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<a href="{{ route('contacts.create') }}" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-plus"></i> Tambah</a>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered datatables" style="width: 100%;">
							<thead>
								<tr>
									<th>NO</th>
									<th>POSISI</th>
									<th>NAMA</th>
									<th>TELP</th>
									<th>ALAMAT</th>
									<th>LAT & LONG</th>
									<th data-orderable="false" data-searchable="false">AKSI</th>
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
            $('.datatables').dataTable({
				ajax: "{{ route('contacts.index') }}",
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ data: 'posisi' },
                	{ data: 'name' },
                	{ data: 'telp' },
                	{ data: 'alamat' },
                    {
                        data: null,
                        render: function (data) {
                            return data.latitude + ', ' + data.longitude
                        }
                    },
                    {
                        data: null,
                        render: function (data) {
                            if (data.posisi.toLowerCase() == 'pusat') {
                                return '<a href="{{ route('contacts.index') }}/' + data.id + '/edit" class="btn btn-xs btn-flat btn-info"><i class="fa fa-edit"></i> Edit</a> '
                            } else {
                                return '<a href="{{ route('contacts.index') }}/' + data.id + '/edit" class="btn btn-xs btn-flat btn-info"><i class="fa fa-edit"></i> Edit</a> <form method="POST" action="{{  route('contacts.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                            }
                        }
                    }
                ]
			})
        })
    </script>
@endsection
