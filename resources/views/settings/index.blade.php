@extends('layouts.lte')

@section('title')
    Pengaturan
@endsection

@section('content-header')
    <h1>
        Pengaturan
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="{{ request()->edit == 'profile' ? 'active' : '' }}">
                        <a href="#user" data-toggle="tab" aria-expanded="false">Profile Pengguna</a>
                    </li>
					<li class="{{ request()->edit != 'profile' ? 'active' : '' }}">
                        <a href="#setting" data-toggle="tab" aria-expanded="false">Pengaturan Website</a>
                    </li>
					<li class="pull-right header"><i class="fa fa-wrench"></i> Pengaturan</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane fade{{ request()->edit == 'profile' ? ' in active' : '' }}" id="user">
                        {{ Form::model($user, ['route' => 'settings.user', 'class' => 'form-horizontal']) }}
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Ponsel</label>
                                <div class="col-sm-10">
                                    {{ Form::text('phone', old('phone'), ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Password Lama <span class="text-muted">(Kosongkan jika tidak diubah)</span></label>
                                <div class="col-sm-10">
                                    {{ Form::password('oldpassword', ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-2 control-label">Password Baru <span class="text-muted">(Kosongkan jika tidak diubah)</span></label>
                                <div class="col-sm-10">
                                    {{ Form::password('newpassword', ['class' => 'form-control']) }}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <button class="btn btn-flat btn-primary"><i class="fa fa-save"></i> Update</button>
                                </div>
                            </div>
                        {{ Form::close() }}
					</div>
					<div class="tab-pane fade{{ request()->edit != 'profile' ? ' in active' : '' }}" id="setting">
						<div class="box-group" id="accordion">
                            <div class="panel box box-default">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#social" aria-expanded="true" class="">
                                        Sosial Media
                                        </a>
                                    </h4>
                                </div>
                                <div id="social" class="panel-collapse collapse" aria-expanded="true">
                                    {{ Form::open(['route' => 'settings.social', 'class' => 'social']) }}
                                    <div class="box-body">
                                        @foreach ($socials as $key => $social)
                                            @php
                                                $social_id = $loop->iteration;
                                            @endphp
                                            <div class="row">
                                                <input type="hidden" name="social_id[]" value="{{ $loop->iteration }}">
                                                <div class="col-xs-12">
                                                    <div class="form-group col-sm-3">
                                                        <label for="">Sosial Media</label>
                                                        <input type="text" name="social[]" class="form-control" value="{{ $key }}" required>
                                                    </div>
                                                    <div class="form-group col-sm-3">
                                                        <label for="">Nama Akun</label>
                                                        <input type="text" name="name[]" class="form-control" value="{{ $social->name }}" required>
                                                    </div>
                                                    <div class="form-group col-sm-6">
                                                        <label for="">URL</label>
                                                        <input type="text" name="url[]" class="form-control" value="{{ $social->url }}" required>
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
                            <div class="panel box box-default">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#mail" class="collapsed" aria-expanded="false">
                                        Mail Server
                                        </a>
                                    </h4>
                                </div>
                                <div id="mail" class="panel-collapse collapse" aria-expanded="false">
                                    {{ Form::open(['route' => 'settings.mail', 'id' => 'mail']) }}
                                    <div class="box-body mail">
                                        <div class="form-group col-sm-4">
                                            <label for="">SMTP Server</label>
                                            <input type="text" name="server" class="form-control" value="{{ $mails->server }}" required>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="">Email Akun</label>
                                            <input type="email" name="email" class="form-control" value="{{ $mails->email }}" required>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="">Password</label>
                                            <input type="password" name="password" class="form-control" value="{{ $mails->password }}" required>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-sm btn-flat btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            {{-- <div class="panel box box-default">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#android" class="collapsed" aria-expanded="false">
                                        Notification Mobile App
                                        </a>
                                    </h4>
                                </div>
                                <div id="android" class="panel-collapse collapse" aria-expanded="false">
                                    {{ Form::open(['id' => 'android']) }}
                                    <div class="box-body android">
                                        <div class="form-group col-sm-4">
                                            <label for="">Nama Package Android</label>
                                            <input type="text" name="name" class="form-control" value="{{ $androids->name }}">
                                        </div>
                                        <div class="form-group col-sm-8">
                                            <label for="">Token</label>
                                            <input type="text" name="token" class="form-control" value="{{ $androids->token }}">
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="button" class="btn btn-sm btn-flat btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div> --}}
                            <div class="panel box box-default">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#sejarah" class="collapsed" aria-expanded="false">
                                        Sejarah
                                        </a>
                                    </h4>
                                </div>
                                <div id="sejarah" class="panel-collapse collapse" aria-expanded="false">
                                    {{ Form::open(['route' => 'settings.sejarah', 'id' => 'sejarah']) }}
                                    <div class="box-body sejarah">
                                        <div class="form-group">
                                            <label for="">Sejarah Perusahaan</label>
                                            {{ Form::textarea('data', $sejarah->data, ['class' => 'form-control', 'required' => true]) }}
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-sm btn-flat btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="panel box box-default">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#visi" class="collapsed" aria-expanded="false">
                                        Visi
                                        </a>
                                    </h4>
                                </div>
                                <div id="visi" class="panel-collapse collapse" aria-expanded="false">
                                    {{ Form::open(['route' => 'settings.visi', 'id' => 'visi']) }}
                                    <div class="box-body visi">
                                        <div class="form-group">
                                            <label for="">Visi Perusahaan</label>
                                            {{ Form::textarea('data', $visi->data, ['class' => 'form-control', 'required' => true]) }}
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-sm btn-flat btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <div class="panel box box-default">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#misi" class="collapsed" aria-expanded="false">
                                        Misi
                                        </a>
                                    </h4>
                                </div>
                                <div id="misi" class="panel-collapse collapse" aria-expanded="false">
                                    {{ Form::open(['route' => 'settings.misi', 'id' => 'misi']) }}
                                    <div class="box-body misi">
                                        <div class="form-group">
                                            <label for="">Misi Perusahaan <small class="text-muted">(Untuk memisah dengan menggunakan tanda <kbd>;</kbd>)</small></label>
                                            {{ Form::textarea('data', $misi->data, ['class' => 'form-control', 'required' => true]) }}
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-sm btn-flat btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function remove(data) {
            $(data).parent().parent().remove()
        }
        $(document).ready(function () {
            var social_id = {!! $social_id !!}
            $('.social-add').click(function () {
                social_id += 1;
                $('.social>.box-body').append('<div class="row"> <div class="col-xs-1" style="top:20px;"> <input type="hidden" name="social_id[]" value="'+social_id+'"> <button type="button" class="btn btn-flat btn-danger" onclick="return remove(this)"><i class="fa fa-trash"></i></button> </div> <div class="col-xs-11"> <div class="form-group col-sm-3"> <label for="">Sosial Media</label> <input type="text" name="social[]" class="form-control" required> </div> <div class="form-group col-sm-3"> <label for="">Nama Akun</label> <input type="text" name="name[]" class="form-control" required> </div> <div class="form-group col-sm-6"> <label for="">URL</label> <input type="text" name="url[]" class="form-control" required> </div> </div> </div>')
            })
        })
    </script>
@endsection
