<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title', config('app.name'))</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ url('') }}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ url('') }}/lte/css/AdminLTE.min.css">
	<link rel="stylesheet" href="{{ url('') }}/plugins/iCheck/square/blue.css">
	@yield('css')
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition login-page">

	@yield('content')

	<script src="{{ url('') }}/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<script src="{{ url('') }}/js/bootstrap.min.js"></script>
	<script src="{{ url('') }}/plugins/iCheck/icheck.min.js"></script>
	<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%'
			});
		});
    </script>
    @yield('js')
</body>
</html>
