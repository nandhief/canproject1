@extends('layouts.lte')

@section('title')
	Tambah Lowongan Karir
@endsection

@section('content-header')
	<h1>
		Lowongan Karir {{ $vacancy->name }}
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Tambah Lowongan Karir</h3>
				</div>
				<div class="box-body">
					{{ Form::model($vacancy, ['route' => ['careers.vacancy.update', $vacancy->id], 'method' => 'PUT']) }}
					<div class="row">
						<div class="form-group col-md-4 col-sm-12 {{ $errors->has('name') ? 'has-error' : '' }}">
							<label for="name">Nama *</label>
							{{ Form::text('name', old('name'), ['class' => 'form-control', 'autofocus' => true]) }}
							@if ($errors->has('name'))
								<span class="help-block">{{ $errors->first('name') }}</span>
							@endif
						</div>
						<div class="form-group col-md-3 col-sm-12 {{ $errors->has('lokasi') ? 'has-error' : '' }}">
							<label for="lokasi">Lokasi *</label>
							{{ Form::text('lokasi', old('lokasi'), ['class' => 'form-control']) }}
							@if ($errors->has('lokasi'))
								<span class="help-block">{{ $errors->first('lokasi') }}</span>
							@endif
						</div>
						<div class="form-group col-md-3 col-sm-12 {{ $errors->has('jenis') ? 'has-error' : '' }}">
                            <label for="jenis">Jenis *</label>
                            @php
                                $jenis = [
                                    'full-time' => 'Full Time',
                                    'part-time' => 'Part Time',
                                    'freelance' => 'Freelance',
                                    'internship' => 'Internship',
                                ];
                            @endphp
							{{ Form::select('jenis', $jenis, strtolower(str_replace(' ', '-', $vacancy->jenis)), ['class' => 'form-control select']) }}
							@if ($errors->has('jenis'))
								<span class="help-block">{{ $errors->first('jenis') }}</span>
							@endif
						</div>
						<div class="form-group col-md-2 col-sm-12 {{ $errors->has('expired') ? 'has-error' : '' }}">
							<label for="expired">Expired *</label>
							{{ Form::text('expired', now()->parse($vacancy->expired)->format('d-m-Y'), ['class' => 'form-control date']) }}
							@if ($errors->has('expired'))
								<span class="help-block">{{ $errors->first('expired') }}</span>
							@endif
						</div>
						<div class="form-group col-md-12 col-sm-12 {{ $errors->has('kualifikasi') ? 'has-error' : '' }}">
							<label for="kualifikasi">Kualifikasi *</label>
							{{ Form::textarea('kualifikasi', $vacancy->kua, ['class' => 'form-control', 'style' => 'min-height: 100px; height: 100px;']) }}
							@if ($errors->has('kualifikasi'))
								<span class="help-block">{{ $errors->first('kualifikasi') }}</span>
							@endif
						</div>
						<div class="form-group col-md-12 col-sm-12 {{ $errors->has('fasilitas') ? 'has-error' : '' }}">
							<label for="fasilitas">Fasilitas *</label>
							{{ Form::textarea('fasilitas', $vacancy->fas, ['class' => 'form-control', 'style' => 'min-height: 100px; height: 100px;']) }}
							@if ($errors->has('fasilitas'))
								<span class="help-block">{{ $errors->first('fasilitas') }}</span>
							@endif
						</div>
					</div>
					<div class="row">
						<div class="form-group col-md-12 col-sm-12">
							<a href="{{ route('careers.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
							<button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Update</button>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
@endsection

@section('css_up')
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
@endsection

@section('js')
    <script src="{{ asset('plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.date').datepicker({
                format: "dd-mm-yyyy",
                weekStart: 1,
                startDate: "-infinity",
                autoclose: true
            });
            $('.select').select2();
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
