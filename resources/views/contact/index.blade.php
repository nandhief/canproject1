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
	<div class="row"><div class="col-xs-12">
            <div class="box box-primary collapsed-box">
                <div class="box-header">
                    Sosial Media
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                {{ Form::open(['route' => 'settings.social', 'class' => 'social', 'files' => true]) }}
                <div class="box-body">
                    @foreach ($socials as $key => $social)
                        @php
                            $social_id = $loop->iteration;
                        @endphp
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group col-md-2">
                                    <h4 style="padding-top: 15px;font-weight:700;">{{ strtoupper($key) }}</h4>
                                    {{ Form::hidden('social[]', $key) }}
                                </div>
                                <div class="col-md-10">
                                    <div class="row">
                                        <input type="hidden" name="social_id[]" value="{{ $loop->iteration }}">
                                        <div class="form-group col-sm-10">
                                            <label for="">Icon Sosial Media</label>
                                            <input type="file" name="icon[]" class="form-control {{ $key }}">
                                        </div>
                                        <div class="form-group col-sm-2">
                                            <img src="{!! $social->icon !!}" alt="" class="img-responsive icon-{{ $key }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-sm-6">
                                            <label for="">Nama Akun</label>
                                            <input type="text" name="name[]" class="form-control" value="{{ $social->name }}" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="">URL</label>
                                            <input type="text" name="url[]" class="form-control" value="{{ $social->url }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="box-footer">
                    <button class="btn btn-sm btn-flat btn-primary pull-right social-save"><i class="fa fa-save"></i> Simpan</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
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
									<th>PIMPINAN</th>
									<th>DAERAH</th>
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
            var readURL = function (input, target) {
                if (input[0].files && input[0].files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        target.attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input[0].files[0]);
                }
            }
            $('input.facebook').change(function () {
                readURL($(this), $('.icon-facebook'))
            })
            $('input.instagram').change(function () {
                readURL($(this), $('.icon-instagram'))
            })
            $('input.linkedin').change(function () {
                readURL($(this), $('.icon-linkedin'))
            })
            $('input.twitter').change(function () {
                readURL($(this), $('.icon-twitter'))
            })
            $('.datatables').dataTable({
				ajax: "{{ route('contacts.index') }}",
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ data: 'posisi' },
                	{ data: 'kepala' },
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
