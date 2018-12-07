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
    <div class="response"></div>
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
                                    <span class="help-block">Catatan: untuk ukuran gambar slide show adalah 1188 pixel <var>x</var> 605 pixel, unduh contoh <a href="{{ asset('storage/files/slider.jpg') }}">slider</a></span>
                                </div>
                                <div class="col-md-6">
                                    <img src="" alt="" class="img-responsive path_image">
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
                    @if (request()->edit == true)
                        Edit Slide Show
                        <div class="pull-right">
                            <a href="{{ route('slide.index') }}" class="btn btn-sm btn-danger btn-flat"><i class="fa fa-reply"></i> Kembali</a>&nbsp;
                            <button class="btn btn-sm btn-primary btn-flat save"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    @else
                        Daftar Slide Show
                        <a href="?edit=true" class="btn btn-sm btn-info btn-flat pull-right"><i class="fa fa-edit"></i> Urutkan</a>
                    @endif
                </div>
                <div class="box-body">
                    @if (request()->edit == true)
                    <div class="well">
                        Untuk mengurutkan slide dengan cara drag item ke atas atau ke bawah <i class="fa fa-close pull-right order-info" style="cursor:pointer;"></i>
                    </div>
					<ul class="sortable">
						@foreach ($images->where('status', true) as $image)
							<li id="item-{{ $image->id }}">
                                <img src="{{ url('storage/files', $image->path_image) }}" alt="" class="img-responsive">
                                <h5>{{ $image->name }}</h5>
							</li>
						@endforeach
					</ul>
                    @else
                    <div class="table-responsive">
                        <table class="table table-hover datatables">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>LINK</th>
                                    <th>GAMBAR</th>
                                    <th>STATUS</th>
                                    <th data-orderable="false" data-searchable="false"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css_up')
	<link rel="stylesheet" href="{{ asset('plugins') }}/datatables/dataTables.bootstrap.css">
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
	<script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
	<script src="{{ asset('plugins') }}/datatables/dataTables.yajra.min.js"></script>
	<script src="{{ asset('plugins') }}/datatables/plugins/fnReloadAjax.js"></script>
	<script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>
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
            $('input[name="path_image"]').change(function () {
                readURL($(this), $('.path_image'))
            })
            $('.select').select2();
            $('.select').change(function () {
                $('#slide_type').val($(this).find(':selected').data('type'));
                $('#name').val($(this).find(':selected').data('name'));
            });
            $('.order-info').click(function () {
                $(this).parent().remove();
            });
            @if (request()->edit != true)
            var table = $('.datatables').dataTable({
				ajax: "{{ route('slide.index') }}",
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ data: 'name' },
                    { 
                        data: null,
                        render: function (data) {
                            return '<img src="' + data.image + '" alt="' + data.name + '" class="img-responsive">';
                        }
                    },
                	{
                		data: null,
                		render: function (data) {
                			return data.status == 0 ? '<span class="label label-warning">Tidak Aktif</span>' : '<span class="label label-info">Aktif</span>';
                		}
                	},
                    {
                        data: null,
                        render: function (data) {
                            return '<button type="button" onclick="return active(' + data.id + ', ' + (data.status == 1 ? 0 : 1) + ')" class="btn btn-xs btn-flat btn-' + (data.status == 1 ? 'warning' : 'primary') + ' active"><i class="fa fa-' + (data.status == 1 ? 'remove' : 'check') + '"></i> ' + (data.status == 1 ? 'Nonaktifkan' : 'Aktifkan') + '</button> <form method="POST" action="{{  route('slide.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
            @endif
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
                    url: '{{ route('slide.order') }}',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
                    beforeSend: function () {
                        save.attr('disabled', true);
                    },
					success: function (result) {
						$('.response').append(
							'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> ' + result.success + ' </div>'
						);
                        save.attr('disabled', false);
					}
				});
			});
            window.active = function active(id, status) {
                $.ajax({
                    data: {
                        id: id,
                        status: status
                    },
                    type: 'PUT',
                    url: '{{ route('slide.active') }}',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
                    beforeSend: function () {
                        $('.active').attr('disabled', true);
                    },
                    success: function (result) {
                        $('.response').append(
							'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> ' + result.success + ' </div>'
						);
                        $('.active').attr('disabled', false);
                        table.fnReloadAjax();
                    }
                });
            }
        })
    </script>
@endsection
