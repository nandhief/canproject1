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
                            @if (auth()->id() === 1)
                            <div class="panel box box-default">
                                <div class="box-header with-border">
                                    <h4 class="box-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href="#mail" class="collapsed" aria-expanded="false">
                                        Mail Server
                                        </a>
                                    </h4>
                                </div>
                                <div id="mail" class="panel-collapse collapse" aria-expanded="false">
                                    {{ Form::open(['route' => 'settings.mail', 'class' => 'mail']) }}
                                    <div class="box-body">
                                        <div><strong>SERVER</strong></div>
                                        <div class="form-group col-sm-4">
                                            <label for="">SMTP Server</label>
                                            <input type="text" name="server_host" class="form-control" value="{{ $mails->server->host }}" required>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="">Email Akun</label>
                                            <input type="email" name="server_email" class="form-control" value="{{ $mails->server->email }}" required>
                                        </div>
                                        <div class="form-group col-sm-4">
                                            <label for="">Password</label>
                                            <input type="password" name="server_password" class="form-control" value="{{ $mails->server->password }}" required>
                                        </div>
                                    </div>
                                    <div class="box-body">
                                        <div><strong>NOTIFIKASI KE PUSAT UNTUK</strong></div>
                                        <div class="form-group col-sm-12">
                                            <label for="">Email Akun Untuk Kredit</label>
                                            <input type="hidden" name="kredit_host" value="{{ $mails->kredit->host }}">
                                            <input type="hidden" name="kredit_password" value="{{ $mails->kredit->password }}">
                                            <input type="email" name="kredit_email" class="form-control" value="{{ $mails->kredit->email }}" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="">Email Akun Untuk Tabungan</label>
                                            <input type="hidden" name="tabungan_host" value="{{ $mails->tabungan->host }}">
                                            <input type="hidden" name="tabungan_password" value="{{ $mails->tabungan->password }}">
                                            <input type="email" name="tabungan_email" class="form-control" value="{{ $mails->tabungan->email }}" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="">Email Akun Untuk Karir</label>
                                            <input type="hidden" name="career_host" value="{{ $mails->career->host }}">
                                            <input type="hidden" name="career_password" value="{{ $mails->career->password }}">
                                            <input type="email" name="career_email" class="form-control" value="{{ $mails->career->email }}" required>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button class="btn btn-sm btn-flat btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                            @endif
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
                                            {{ Form::textarea('data', $visi->data, ['class' => 'form-control text-editor', 'required' => true]) }}
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
                                            <label for="">Misi Perusahaan</label>
                                            {{ Form::textarea('data', $misi->data, ['class' => 'form-control text-editor', 'required' => true]) }}
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
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            tinymce.init({
                selector: '.text-editor',
				menubar: false,
				statusbar: false,
                plugins: 'advlist autolink link lists charmap print preview table code autoresize',
                toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect | bullist numlist outdent indent blockquote'
            })
        })
    </script>
@endsection