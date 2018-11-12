@extends('layouts.lte')

@section('title')
    Pengaturan Slide Show
@endsection

@section('content-header')
    <h1>
        Pengaturan Slide Show
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary collapsed-box">
                <div class="box-header">
                    Upload File Slide Show
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                {{ Form::open(['route' => 'slide.store', 'files' => true]) }}
                <div class="box-body">
                    <div class="form-group">
                        <div id="lists">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-addon bg-gray">GAMBAR </div> 
                                        <input type="file" name="path_image" class="form-control">
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-addon bg-gray">LINK &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div> 
                                        <select name="slide_id" class="form-control select" style="width:100%;">
                                            <option value="" data-type="" data-name="">-- PILIH --</option>
                                            @foreach ($slide as $item)
                                                <option value="{{ $item->id }}" data-type="{{ $item->type }}" data-name="{{ $item->name }}">[{{ strtoupper($item->type) }}] {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="slide_type" value="" id="slide_type">
                                        <input type="hidden" name="name" value="" id="name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="" alt="" class="img-responsive">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary pull-right"><i class="fa fa-upload"></i> Upload Gambar</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    {{ request()->edit == true ? 'Edit Slide Show' : 'Daftar Slide Show' }}
                    <button class="btn btn-sm btn-primary btn-flat save pull-right"><i class="fa fa-save"></i> Simpan</button>
                </div>
                <div class="box-body">
                    @if (request()->edit == true)
                    @else
                    @endif
					<ul class="sortable">
						@foreach ($images as $image)
							<li id="item-{{ $image->id }}">
                                <img src="{{ url('storage/files', $image->path_image) }}" alt="" class="img-responsive">
                                <h5>{{ $image->name }}</h5>
							</li>
						@endforeach
					</ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css_up')
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    <style>
	ul.sortable {
        width: 100%; 
        float: left; 
        margin: 20px 0; 
        padding: 10px 0; 
        list-style: none; 
        position: relative !important; 
        display: inline-flex; 
        justify-content: center; 
        flex-wrap: wrap;
    } 
    ul.sortable li {
        height: 200px; 
        float: left; 
        margin: 10px 7px 7px 10px; 
        border: 2px solid #fff; 
        cursor: move; 
    } 
    ul.sortable li img {
        height: 100%; 
        float: left; 
    } 
    ul.sortable li.ui-sortable-helper {
        border-color: #3498db; 
    } 
    ul.sortable li.placeholder {
        width: 375px; 
        height: 200px; 
        float: left; 
        background: #eee; 
        border: 2px dashed #bbb; 
        display: block; 
        opacity: 0.6; 
        border-radius: 2px; 
        -moz-border-radius: 2px; 
        -webkit-border-radius: 2px; 
    }
    </style>
@endsection

@section('js')
	<script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.select').select2();
            $('.select').change(function () {
                $('#slide_type').val($(this).find(':selected').data('type'));
                $('#name').val($(this).find(':selected').data('name'));
            })
            var ls = $('.sortable');
			var save = $('button.save');
			ls.sortable({
				revert: 100,
				placeholder: 'placeholder'
			});
			ls.disableSelection();
			save.on('click', function (e) {
				e.preventDefault();
				var data = ls.sortable('serialize');
				$.ajax({
					data: data,
					type: 'PUT',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
					success: function (result) {
						$('.response').append(
							'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> ' + result.info + ' </div>'
						);
					}
				});
			});
        })
    </script>
@endsection
