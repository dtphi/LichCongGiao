<header class="app-header navbar">
	<button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
		<span class="navbar-toggler-icon"></span>
	</button><a class="navbar-brand" href="{{route('admin.dashboard')}}"></a>
	<span class="navbar-brand-name"><span class="hidden-xs">運営者向け</span><span>管理画面</span></span>
	<button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
		<span class="navbar-toggler-icon"></span>
	</button>

	<ul class="nav navbar-nav ml-auto">
		<li class="nav-item d-md-down-none mr-4 login-user">
            @if (Auth::user())
				<div>
					<i class="fas fa-user mr-2"></i><span class="login-user-name">{{Auth::user()->name}}</span>
					<!-- <p class="last-login-date">{{Auth::user()->updated_at}}</p> -->
					<p class="last-login-date">{{\Carbon\Carbon::parse(Auth::user()->last_login_at)->format('Y/m/d H:i:s')}}</p>
				</div>
            @endif
		</li>
		<li class="nav-item d-md-down-none"><a class="nav-link mr-4 sign-out" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i></a></li>
	</ul>
</header>
