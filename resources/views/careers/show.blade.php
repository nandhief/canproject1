@extends('layouts.lte')

@section('title')
	Detail Pelamar Karir
@endsection

@section('content-header')
	<h1>
		Pelamar Karir
		<small>Detail Pelamar Karir {{ $career->name }}</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Detail Pelamar Karir {{ $career->name }}</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered">
							<tr>
								<th>NAMA</th>
								<td>{{ $career->name }}</td>
								<th>EMAIL</th>
								<td>{{ $career->email }}</td>
                            </tr>
							<tr>
								<th>POSISI</th>
								<td>{{ $career->vacancy->name }}</td>
								<th>PHONE</th>
								<td>{{ $career->phone }}</td>
                            </tr>
							<tr>
								<th>STATUS</th>
								<td>
									{!! $career->status ? '<span class="label label-success">SUDAH DI TANGGAPI</span>' : '<span class="label label-warning">BELUM DI TANGGAPI</span>' !!}
								</td>
								@if ($career->path_resume)
									<th>FILE RESUME</th>
									<td><a href="{{ url('storage/original', $career->path_resume) }}" target="_blank"><i class="fa fa-link"></i> Open</a></td>
								@endif
							</tr>
							<tr>
								<th>BIODATA</th>
								<td colspan="3">{!! $career->description !!}</td>
							</tr>
							@if ($career->keterangan)
								<tr>
									<th>KETERANGAN</th>
									<td colspan="3">{{ $career->keterangan }}</td>
								</tr>
							@endif
						</table>
					</div>
				</div>
                @empty($career->keterangan)
                    <div class="box-footer">
                        <button class="btn btn-xs btn-primary btn-flat response"><i class="fa fa-comment"></i> TANGGAPI LAMARAN</button>
                        <div class="row form-response" {!! session()->has('errors') ? '' : 'style="display: none;"' !!}>
                            <div class="col-md-12">
                                <hr>
                                <h4>TANGGAPI LAMARAN</h4>
                                <hr>
                                {{ Form::model($career, ['route' => ['careers.update', $career->id], 'method' => 'PUT']) }}
                                    <div class="form-group">
                                        <label for="keterangan">KETERANGAN</label>
                                        {{ Form::text('keterangan', old('keterangan'), ['class' => 'form-control']) }}
                                    </div>
                                    <div class="form-group">
                                        <label for="reply">BALAS PELAMAR</label>
                                        {{ Form::textarea('reply', old('reply'), ['class' => 'form-control text-editor']) }}
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-envelope"></i> BALAS</button>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                @endempty
			</div>
			<a href="{{ route('careers.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
			{{ Form::open(['route' => ['careers.destroy', $career->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) }}
				<button type="submit" class="btn btn-flat btn-danger" onclick="return confirm('Yakin Hapus Data')"><i class="fa fa-trash"></i> Hapus</button>
			{{ Form::close() }}
		</div>
	</div>
@endsection

@section('js')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.response').click(function() {
                $('.form-response').toggle('slow');
            });
            tinymce.init({
                selector: '.text-editor',
				statusbar: false,
                plugins: 'advlist autolink link image media lists charmap print preview emoticons table code filemanager autoresize',
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect | bullist numlist outdent indent blockquote | emoticons image media',
                external_filemanager_path: '{{ asset('plugins/filemanager') }}/',
                filemanager_title: 'NANDHIEF',
                filemanager_access_key: 'IzTT1OPgj2mjMXP2Bp7mO2GxZIMLeFobLSb5OxjiiYBg3lpda36NakDRjc11',
                external_plugins: {
                	'filemanager' : '{{ asset('plugins/filemanager/plugin.min.js') }}'
                }
            });
		});
	</script>
@endsection
