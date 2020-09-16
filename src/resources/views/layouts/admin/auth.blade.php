<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="UTF-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="robots" content="noｰindex, no-follow">
		<meta name="description" content="#{description}">
		<meta name="keywords" content="#{keyword}">
		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="icon" href="/favicon.ico">
		<title>{{$headerTitle}} | 121 ROUND APP</title>
		<link type="text/css" rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link type="text/css" rel="stylesheet" href="{{ asset('css/admin.min.css') }}">
	</head>
	<body>
		<!-- header-->
		<header class="before-login">
			<div class="container">
				<div class="block"><a class="navbar-brand" href="/"></a><span class="hidden-xs">{{$headerTitle}}</span></div>
			</div>
		</header>
        <!-- body-->
        <div class="app-body mt0">
			<!-- Main Contents-->
			<main class="main">
				<!-- Contents-->
                @yield('content')
			</main>
		</div>
        <!-- Footer-->
		<footer class="app-footer">
			<span>Copyright © 2020
				<script type="text/javascript">
			        var year = new Date().getFullYear();
					if(year != 2020) document.write('-' + year);
    			</script> British American Tobacco Japan All Rights Reserved.
			</span>
		</footer>
        <!-- ▼ JS Libraries ▼-->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script><!-- ▲ JS Libraries ▲-->
		<!-- ▼ JS Scripts ▼-->
		<script src="{{ asset('js/admin/const.js') }}"></script>
		<script src="{{ asset('js/admin/admin.min.js') }}"></script><!-- ▲ JS Scripts ▲-->
	</body>
</html>
