@extends('layouts.lte')

@section('title')
	Daftar Commodity
@endsection

@section('content-header')
	<h1>
		Commodity
		<small>Daftar Commodity</small>
	</h1>
@endsection

@section('content')
	<div class="response"></div>
	<div class="row">
        <div class="col-md-12">
            <div class="box box-primary collapsed-box">
                <div class="box-header">
                    Tambah Commodity
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                {{ Form::open(['route' => 'commodities.store', 'id' => 'save']) }}
                <div class="box-body">
                    <div class="form-group col-md-3">
                        <label for="name">NAMA COMMODITY</label>
                        {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="symbol">SATUAN</label>
                        {{ Form::text('symbol', old('symbol'), ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="buy">BELI</label>
                        {{ Form::text('buy', old('buy'), ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-md-3">
                        <label for="sell">JUAL</label>
                        {{ Form::text('sell', old('sell'), ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-sm btn-flat btn-primary pull-right save"><i class="fa fa-save"></i> Tambah</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered datatables" style="width: 100%;">
							<thead>
								<tr>
									<th>#</th>
									<th>NAMA COMMODITY</th>
									<th>SATUAN</th>
									<th>BELI</th>
									<th>JUAL</th>
									<th data-orderable="false" data-searchable="false">&nbsp;</th>
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
    <div class="modal fade edit" tabindex="-1" role="dialog" aria-labelledby="edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-red">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    {{ Form::open(['method' => 'PUT', 'id' => 'edit', 'class' => 'row']) }}
                        <div class="form-group col-md-6">
                            {{ Form::hidden('id') }}
                            <label for="name">NAMA COMMODITY</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="symbol">SATUAN</label>
                            <input type="text" name="symbol" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="buy">BELI</label>
                            <input type="text" name="buy" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sell">JUAL</label>
                            <input type="text" name="sell" class="form-control">
                        </div>
                    {{ Form::close() }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-flat btn-default pull-left" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-sm btn-flat btn-primary update"><i class="fa fa-save"></i>  Simpan</button>
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
	<script src="{{ asset('plugins') }}/datatables/plugins/fnReloadAjax.js"></script>
	<script>
        function objectForm(array) {
            var dataObject = {}
            for (let i = 0; i < array.length; i++) {
                dataObject[array[i]['name']] = array[i]['value'];
            }
            return dataObject
        }
        function edit(id, name, symbol, buy, sell) {
            var form = $('form#edit > div')
            form.find('input[name="id"]').val(id)
            form.find('input[name="name"]').val(name)
            form.find('input[name="symbol"]').val(symbol)
            form.find('input[name="buy"]').val(buy)
            form.find('input[name="sell"]').val(sell)
            $('.modal-title').text('EDIT COMMODITY ' + name)
            $('.edit').modal('show')
        }
		$(document).ready(function () {
			var table = $('.datatables').dataTable({
				ajax: "{{ route('commodities.index') }}",
                "deferRender": true,
                columns: [
                	{ data: 'no' },
                	{ data: 'name' },
                	{ data: 'symbol' },
                	{ data: 'beli' },
                	{ data: 'jual' },
                    {
                        data: null,
                        render: function (data) {
                            return '<button class="btn btn-xs btn-flat btn-info" onclick="return edit(' + data.id + ', \'' + data.name + '\', \'' + data.symbol + '\', ' + data.buy + ', ' + data.sell + ')"><i class="fa fa-edit"></i> Edit</button> <form method="POST" action="{{  route('commodities.index') }}/' + data.id + '" accept-charset="UTF-8" style="display: inline-block;"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="{{ csrf_token()  }}"> <button type="submit" class="btn btn-xs btn-flat btn-danger" onclick="return confirm(\'Anda Yakin Menghapus Data ' + data.name + '\')"><i class="fa fa-trash"></i> Hapus</button> </form>';
                        }
                    }
                ]
			});
            $('.save').click(function (e) {
                var data = objectForm($('form#save').serializeArray())
                $.ajax({
                    url: '{{ route('commodities.store') }}',
                    type: 'POST',
                    data: data,
                    beforeSend: function () {
                        $('.save').attr('disabled', true);
                    },
                    success: function (result) {
                        $('.response').append(
							'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> ' + result.success + ' </div>'
						);
                        $('.save').attr('disabled', false);
                        table.fnReloadAjax();
                        $('form#save')[0].reset();
                        $('form#save').parent().toggleBox();
                        $.each(data, function (i, v) {
                            var haserror = $('input[name="' + i + '"]').parent()
                            haserror.removeClass('has-error')
                            haserror.children('span').remove()
                        })
                    },
                    error: function (errors) {
                        var data = errors.responseJSON.errors
                        $.each(data, function (i, v) {
                            var haserror = $('input[name="' + i + '"]').parent()
                            haserror.addClass('has-error')
                            if (haserror.has('span').length == 0) {
                                haserror.append('<span class="help-block">' + v[0] + '</span>')
                            }
                        })
                        $('.save').attr('disabled', false);
                    }
                })
            })
            $('.update').click(function (e) {
                var data = objectForm($('form#edit').serializeArray())
                $.ajax({
                    url: '{{ route('commodities.index') }}/' + data.id,
                    type: 'PUT',
                    data: data,
                    beforeSend: function () {
                        $('.update').attr('disabled', true);
                    },
                    success: function (result) {
                        $('.response').append(
							'<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h4><i class="icon fa fa-check"></i> Berhasil!</h4> ' + result.success + ' </div>'
						);
                        $('.update').attr('disabled', false);
                        table.fnReloadAjax();
                        $('form#save')[0].reset();
                        $.each(data, function (i, v) {
                            var haserror = $('form#edit > div > input[name="' + i + '"]').parent()
                            haserror.removeClass('has-error')
                            haserror.children('span').remove()
                        })
                        $('.edit').modal('hide')
                    },
                    error: function (errors) {
                        var data = errors.responseJSON.errors
                        $.each(data, function (i, v) {
                            var haserror = $('form#edit > div > input[name="' + i + '"]').parent()
                            haserror.addClass('has-error')
                            if (haserror.has('span').length == 0) {
                                haserror.append('<span class="help-block">' + v[0] + '</span>')
                            }
                        })
                        $('.save').attr('disabled', false);
                    }
                })
            })
		});
	</script>
@endsection
