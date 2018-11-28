@extends('layouts.lte')

@section('title')
	Tambah Layanan
@endsection

@section('content-header')
	<h1>
		Layanan
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Tambah Layanan</h3>
				</div>
				<div class="box-body">
					{{ Form::open(['route' => 'layanan.store', 'files' => true]) }}
					<div class="row">
						<div class="form-group col-md-12 col-sm-12 {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name">Nama *</label>
							{{ Form::text('name', old('name'), ['class' => 'form-control', 'autofocus' => true]) }}
							@if ($errors->has('name'))
								<span class="help-block">{{ $errors->first('name') }}</span>
							@endif
						</div>
						<div class="form-group col-md-6 col-sm-6 {{ $errors->has('path_image') ? 'has-error' : '' }}">
							<label for="path_image">Gambar *</label>
							{{ Form::file('path_image', ['class' => 'form-control']) }}
							@if ($errors->has('path_image'))
								<span class="help-block">{{ $errors->first('path_image') }}</span>
							@endif
                        </div>
                        <div class="form-group col-md-6 col-sm-6">
                            <div class="file"></div>
                        </div>
						<div class="form-group col-md-12 col-sm-12 {{ $errors->has('short_desc') ? 'has-error' : '' }}">
							<label for="short_desc">Short Description <span class="text-muted">(max 255 character)</span></label>
							{{ Form::textarea('short_desc', old('short_desc'), ['class' => 'form-control', 'style' => 'min-width: 100%; width: 100%; max-width: 100%; height: 100px; min-height: 100px; max-height: 100px;']) }}
							@if ($errors->has('short_desc'))
								<span class="help-block">{{ $errors->first('short_desc') }}</span>
							@endif
						</div>
						<div class="form-group col-md-12 col-sm-12 {{ $errors->has('description') ? 'has-error' : '' }}">
							<label for="description">Description *</label>
							{{ Form::textarea('description', old('description'), ['class' => 'form-control text-editor']) }}
							@if ($errors->has('description'))
								<span class="help-block">{{ $errors->first('description') }}</span>
							@endif
						</div>
						<div class="form-group col-md-12 col-sm-12 {{ $errors->has('status') ? 'has-error' : '' }}">
							<label for="status">Terbitkan</label>
							<div class="radio">
								<label><input type="radio" name="status" value="0"> Draf</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="status" value="1">Terbit</label>
							</div>
							@if ($errors->has('status'))
								<span class="help-block">{{ $errors->first('status') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12 col-sm-12">
							<a href="{{ route('layanan.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
							<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('js')
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function() {
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
