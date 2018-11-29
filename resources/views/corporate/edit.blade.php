@extends('layouts.lte')

@section('title')
	Edit Corporate
@endsection

@section('content-header')
	<h1>
		Corporate
	</h1>
@endsection

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Edit Corporate</h3>
				</div>
				<div class="box-body">
					<form method="POST" action="{{ route('corporates.update', $data->id) }}" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-2">
							<label>Bagian *</label>
							<select name="bagian" id="" class="select2 form-control">
                                <option value="">Pilih Bagian</option>
                                <option value="komisaris" {{ $data->bagian == 'komisaris' ? 'selected' : '' }}>Komisaris</option>
                                <option value="direksi" {{ $data->bagian == 'direksi' ? 'selected' : '' }}>Direksi</option>
                            </select>
						</div>
						<div class="col-md-5">
							<label>Nama *</label>
							<input type="text" class="form-control" name="name" value="{{ $data->name }}">
						</div>
						<div class="col-md-5">
							<label>Jabatan *</label>
							<input type="text" class="form-control" name="jabatan" value="{{ $data->jabatan }}">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label>Foto *</label>
							<input type="file" class="form-control" name="path_foto">
                        </div>
                        <div class="col-md-4 col-md-offset-1 col-sm-6">
                            <img src="{{ $data->foto }}" alt="" class="img-responsive path_foto">
                        </div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<a href="{{ route('corporates.index') }}" class="btn btn-success btn-flat"><i class="fa fa-reply"></i> Kembali</a>
							<input type="submit" name="submit" value="Update" class="btn btn-primary btn-flat">
      						<input type="hidden" name="_method" value="PUT">
      						{{ csrf_field() }}
						</div>	
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

