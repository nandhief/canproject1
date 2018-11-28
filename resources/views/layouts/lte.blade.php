<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ config('app.name') }} @yield('title', 'Admin')</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    @yield('css_up')
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/lte/css/AdminLTE.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/lte/css/skins/_all-skins.min.css">
	@yield('css_down')
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-red fixed sidebar-mini">
	<div class="wrapper">

		@include('lte.header')

		@include('lte.sidebar')

		<div class="content-wrapper">
			<section class="content-header">
				@yield('content-header')
			</section>

			<section class="content">
				@include('lte.alert')
				@yield('content')
			</section>
		</div>

		@include('lte.footer')

		@include('lte.settings')

		<div class="control-sidebar-bg"></div>
	</div>

	<script src="{{ url('/') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="{{ url('/') }}/js/bootstrap.min.js"></script>
	<script src="{{ url('/') }}/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="{{ url('/') }}/plugins/fastclick/fastclick.js"></script>
	<script src="{{ url('/') }}/lte/js/app.min.js"></script>
	<script src="{{ url('/') }}/lte/js/settings.js"></script>
	@yield('js')
</body>
</html>
