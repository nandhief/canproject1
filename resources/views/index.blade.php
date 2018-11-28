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
                            <span class="info-box-text">PENGGUNA</span>
                            <span class="info-box-number">{{ $customers->count() }} <small>Customer</small></span>
                            <span class="info-box-number">{{ $brokers->count() }} <small>Broker</small></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-folder-open"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">PENGAJUAN</span>
                            <span class="info-box-number">90 <small>Tabungan</small></span>
                            <span class="info-box-number">90 <small>Kredit</small></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">CPU Traffic</span>
                            <span class="info-box-number">90<small>%</small></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">CPU Traffic</span>
                            <span class="info-box-number">90<small>%</small></span>
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
					<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							@foreach ($slider as $slide)
							<div class="item {{ $loop->iteration == 1 ? 'active' : '' }}">
								<img src="{!! $slide->image !!}" alt="" class="img-responsive">
							</div>
							@endforeach
						</div>
						<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
							<span class="fa fa-angle-left"></span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
							<span class="fa fa-angle-right"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
    </div>
@endsection
