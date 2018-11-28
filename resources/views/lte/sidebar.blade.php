<aside class="main-sidebar">
	<section class="sidebar">
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
            <li class="{{ request()->is('/') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->id == 1)
            <li class="{{ request()->is('admin*') ? 'active' : '' }}">
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-users"></i> <span>Users Admin</span>
                </a>
            </li>
            @else
            <li class="{{ request()->is('users*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}">
                    <i class="fa fa-users"></i> <span>Users</span>
                </a>
            </li>
            <li class="{{ request()->is('corporate*') ? 'active' : '' }}">
                <a href="{{ route('corporates.index') }}">
                    <i class="fa fa-building"></i> <span>Corporate</span>
                </a>
            </li>
            <li class="{{ request()->is('products*') ? 'active' : '' }}">
                <a href="{{ route('products.index') }}">
                    <i class="fa fa-cubes"></i> <span>Produk</span>
                </a>
            </li>
            <li class="{{ request()->is('tabungan*') ? 'active' : '' }}">
                <a href="{{ route('tabungan.index') }}">
                    <i class="fa fa-folder-open"></i> <span>Rekening</span>
                    <span class="pull-right-container">
                        {{--  --}}
                    </span>
                </a>
            </li>
            <li class="{{ request()->is('credits*') ? 'active' : '' }}">
                <a href="{{ route('credits.index') }}">
                    <i class="fa fa-folder-open"></i> <span>Kredit</span>
                    <span class="pull-right-container">
                        {{--  --}}
                    </span>
                </a>
            </li>
            <li class="{{ request()->is('layanan*') ? 'active' : '' }}">
                <a href="{{ route('layanan.index') }}">
                    <i class="fa fa-gears"></i> <span>Layanan</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i> <span>Informasi</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is('news*') ? 'active active-sub' : '' }}">
                        <a href="{{ route('news.index') }}">
                            <i class="fa fa-newspaper-o"></i> <span>News</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('promos*') ? 'active active-sub' : '' }}">
                        <a href="{{ route('promos.index') }}">
                            <i class="fa fa-ticket"></i> <span>Promo</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('lelang*') ? 'active active-sub' : '' }}">
                        <a href="{{ route('lelang.index') }}">
                            <i class="fa fa-exchange"></i> <span>Lelang</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('valas*') ? 'active active-sub' : '' }}">
                        <a href="{{ route('valas.index') }}">
                            <i class="fa fa-line-chart"></i> <span>Valas</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('commodities*') ? 'active active-sub' : '' }}">
                        <a href="{{ route('commodities.index') }}">
                            <i class="fa fa-th"></i> <span>Commodity</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ request()->is('careers*') ? 'active' : '' }}">
                <a href="{{ route('careers.index') }}">
                    <i class="fa fa-users"></i> <span>Career</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="{{ request()->is('contacts*') ? 'active' : '' }}">
                <a href="{{ route('contacts.index') }}">
                    <i class="fa fa-address-book"></i> <span>Kontak</span>
                </a>
            </li>
            @endif
            <li class="{{ request()->is('settings*') ? 'active' : '' }}">
                <a href="{{ route('settings.index') }}">
                    <i class="fa fa-wrench"></i> <span>Pengaturan</span>
                </a>
            </li>
		</ul>
	</section>
</aside>
