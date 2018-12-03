@extends('layouts.lte')

@section('title')
    Dashboard
@endsection

@section('content-header')
    <h1>
        Dashboard
        <small>Widget & Tools</small>
    </h1>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Customer</span>
                            <span class="info-box-number">{{ $customers->count() }} <small>Orang</small></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Broker</span>
                            <span class="info-box-number">{{ $brokers->count() }} <small>Broker</small></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-folder-open"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Tabungan</span>
                            <span class="info-box-number">{{ $tabungan->where('status', null)->count() }} <small>Baru</small></span>
                            <span class="info-box-number">{{ $tabungan->where('status', false)->count() }} <small>Proses</small></span>
                            <span class="info-box-number">{{ $tabungan->where('status', true)->count() }} <small>Selesai</small></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-folder-open"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Kredit</span>
                            <span class="info-box-number">{{ $credit->where('status', null)->count() }} <small>Baru</small></span>
                            <span class="info-box-number">{{ $credit->where('status', false)->count() }} <small>Proses</small></span>
                            <span class="info-box-number">{{ $credit->where('status', true)->count() }} <small>Selesai</small></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="col-md-6">
			<div class="box box-primary">
				<div class="box-header">
					<h3 class="box-title">SLIDE SHOW</h3>
					<div class="pull-right"><a href="{{ route('slide.index') }}" class="btn btn-flat btn-info btn-sm"><i class="fa fa-edit"></i> Edit</a></div>
				</div>
				<div class="box-body">
					<div id="slider" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							@foreach ($slider as $slide)
							<div class="item {{ $loop->iteration == 1 ? 'active' : '' }}">
								<img src="{!! $slide->image !!}" alt="" class="img-responsive">
							</div>
							@endforeach
						</div>
						<a class="left carousel-control" href="#slider" data-slide="prev">
							<span class="fa fa-angle-left"></span>
						</a>
						<a class="right carousel-control" href="#slider" data-slide="next">
							<span class="fa fa-angle-right"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
    </div>
    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-newspaper-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">News</span>
                    <span class="info-box-number">{{ $news->where('status', true)->count() }} <small>Aktif</small></span>
                    <span class="info-box-number">{{ $news->where('status', false)->count() }} <small>Draf</small></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-ticket"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Promo</span>
                    <span class="info-box-number">{{ $promo->where('status', true)->count() }} <small>Aktif</small></span>
                    <span class="info-box-number">{{ $promo->where('status', false)->count() }} <small>Draf</small></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-exchange"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Lelang</span>
                    <span class="info-box-number">{{ $lelang->where('status', true)->count() }} <small>Aktif</small></span>
                    <span class="info-box-number">{{ $lelang->where('status', false)->count() }} <small>Draf</small></span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-xs-6">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-line-chart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Informasi</span>
                    <span class="info-box-number">{{ $commodity->count() }} <small>Commodity</small></span>
                    <span class="info-box-number">{{ $valas->count() }} <small>Kurs Valas</small></span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css_down')
    <style>
    .info-box-number {
        font-size: 14px;
    }
    </style>
@endsection