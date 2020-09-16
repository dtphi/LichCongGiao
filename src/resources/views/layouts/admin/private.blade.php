<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="UTF-8">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="robots" content="noｰindex, no-follow">
		<meta name="description" content="#description">
		<meta name="keywords" content="#keyword">
		<link rel="icon" href="/favicon.ico">
		<title>{{isset($title)?$title:'インデックス | 121 ROUND APP'}}</title>
		@include('layouts.admin.partials.css')
		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body class="app header-fixed sidebar-fixed aside-menu-hidden" id="top">
		<!-- header-->
		@include('layouts.admin.partials.header')
		<!-- body-->
		<div class="app-body">
			<!-- sidebar-->
			@include('layouts.admin.partials.sidebar')
			<!-- Main Contents-->
			<main class="main">
				<!-- Contents-->
				@yield('content')
			</main>
		</div>
		<!-- Footer-->
		@include('layouts.admin.partials.footer')
		@include('layouts.admin.partials.javascripts')
	</body>
</html>
