@extends('layouts.lte')

@section('title')
	Edit News
@endsection

@section('description-header')
	<h1>
		News
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Edit News</h3>
				</div>
				<div class="box-body">
					{{ Form::model($news, ['route' => ['news.update', $news->id], 'method' => 'PUT', 'files' => true]) }}
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
						<div class="form-group col-md-12 col-sm-12 {{ $errors->has('embeded') ? 'has-error' : '' }}">
                            <label for="embeded">Embeded Youtube </label>
                            <div class="input-group">
                                <span class="input-group-addon">https://youtube.com/watch?v=</span>
                                {{ Form::text('embeded', old('embeded'), ['class' => 'form-control']) }}
                            </div>
							@if ($errors->has('embeded'))
								<span class="help-block">{{ $errors->first('embeded') }}</span>
							@endif
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
								<label><input type="radio" name="status" value="0" {{ $news->status ? '' : 'checked' }}> Draf</label>
							</div>
							<div class="radio">
								<label><input type="radio" name="status" value="1" {{ $news->status ? 'checked' : '' }}>Terbit</label>
							</div>
							@if ($errors->has('status'))
								<span class="help-block">{{ $errors->first('status') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12 col-sm-12">
							<a href="{{ route('news.show', $news->id) }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
							<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Update</button>
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
                plugins: 'advlist autolink link image lists charmap print preview emoticons table code filemanager autoresize',
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect | bullist numlist outdent indent blockquote | emoticons image',
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
