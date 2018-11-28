<header class="main-header">
<a href="{{ url('/') }}" class="logo">
	<span class="logo-mini"><b>MAA</b></span>
	<span class="logo-lg"><b>BPR MAA</b></span>
</a>
<nav class="navbar navbar-static-top">
	<a href="#" class="sidebar-toggle visible-xs" data-toggle="offcanvas" role="button">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</a>
	<div class="navbar-custom-menu">
		<ul class="nav navbar-nav">
			@if (auth()->check())
			<li class="dropdown user user-menu">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" class="user-image" alt="User Image">
					<span class="hidden-xs">{{ auth()->user()->name ?? 'Alexander Pierce' }}</span>
				</a>
				<ul class="dropdown-menu">
					<li class="user-header">
						<img src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" class="img-circle" alt="User Image">
						<p>
							{{ auth()->user()->name ?? 'Alexander Pierce' }}
						</p>
					</li>
					<li class="user-footer">
						<div class="pull-left">
							<a href="{{ route('settings.index', 'edit=profile') }}" class="btn btn-default btn-flat">Profile</a>
						</div>
						<div class="pull-right">
							{{ Form::open(['route' => 'logout']) }}
								<button type="submit" class="btn btn-default btn-flat">Sign out</button>
							{{ Form::close() }}
						</div>
					</li>
				</ul>
			</li>
			@endif
			<li>
				<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
			</li>
		</ul>
	</div>
</nav>
</header>

