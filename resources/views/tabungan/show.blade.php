@extends('layouts.lte')

@section('title')
	Detail Pengajuan Tabungan
@endsection

@section('content-header')
	<h1>
		Pengajuan Tabungan
		<small>Detail Pengajuan Tabungan {{ $tabungan->customer->user->name }}</small>
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<div class="box-header">
					<h3>Detail Pengajuan Tabungan {{ $tabungan->customer->user->name }}</h3>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-hover tabler-bordered">
							<tr>
								<th>NAMA</th>
								<td>{{ $tabungan->customer->user->name }}</td>
								<th>EMAIL</th>
								<td>{{ $tabungan->customer->user->email }}</td>
                            </tr>
							<tr>
                                <th>PHONE</th>
								<td>{{ $tabungan->customer->user->phone }}</td>
								<th>FOTO KTP</th>
								<td><img src="{!! $tabungan->customer->ktp !!}" alt="{{ $tabungan->customer->user->name }}" width="200px"></td>
                            </tr>
							<tr>
								<th>STATUS</th>
								<td>
                                    @if ($tabungan->status === null)
                                        <span class="label label-warning">BARU MENGAJUKAN TABUNGAN</span>
                                    @endif
                                    @if ($tabungan->status === 0)
                                        <span class="label label-info">MASIH DALAM PROSES</span>
                                    @endif
                                    @if ($tabungan->status === 1)
                                        <span class="label label-success">PROSES PENGAJUAN SELESAI</span>
                                    @endif
								</td>
							</tr>
							<tr>
								<th>HISTORY</th>
								<td colspan="3">
                                    @foreach ($tabungan->histories as $history)
                                        <div class="well">
                                            [{{ $history->created_at }}]: {{ $history->description }}
                                        </div>
                                    @endforeach
                                </td>
							</tr>
						</table>
					</div>
				</div>
                @if ($tabungan->status != 1)
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <hr>
                            <h4>PEMBERITAHUAN KEPADA {{ strtoupper($tabungan->customer->user->name) }}</h4>
                            <hr>
                            {{ Form::model($tabungan, ['route' => ['tabungan.update', $tabungan->id], 'method' => 'PUT']) }}
                                <div class="form-group">
                                    <label for="status">STATUS</label>
                                    @php
                                        $select = [
                                            0 => 'PROSES',
                                            1 => 'SELESAI',
                                        ];
                                    @endphp
                                    {{ Form::select('status', $select, old('status'), ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    <label for="description">KETERANGAN</label>
                                    {{ Form::text('description', old('description'), ['class' => 'form-control']) }}
                                </div>
                                <div class="form-group">
                                    <label for="reply">INFORMASI KEPADA CUSTOMER</label>
                                    {{ Form::textarea('reply', old('reply'), ['class' => 'form-control text-editor']) }}
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-flat pull-right"><i class="fa fa-envelope"></i> UPDATE</button>
                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                @endif
			</div>
			<a href="{{ route('tabungan.index') }}" class="btn btn-flat btn-success"><i class="fa fa-reply"></i> Kembali</a>
			{{ Form::open(['route' => ['tabungan.destroy', $tabungan->id], 'method' => 'DELETE', 'style' => 'display: inline-block;']) }}
				<button type="submit" class="btn btn-flat btn-danger" onclick="return confirm('Yakin Hapus Data')"><i class="fa fa-trash"></i> Hapus</button>
			{{ Form::close() }}
		</div>
	</div>
@endsection

@section('css_down')
    <style>
        .well {
            padding: 5px;
            margin-bottom: 5px;
        }
    </style>
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
