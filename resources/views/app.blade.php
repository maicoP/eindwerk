<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>@yield('title')</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}" /> 
	<link id="bootstrap-style" href="/app/css/bootstrap.min.css" rel="stylesheet">
	<link href="/app/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="/app/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="/app/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800%26subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>	
	<link href="/lib/pickadate/themes/default.css" rel="stylesheet">
	<link href="/lib/pickadate/themes/default.date.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="57x57" href="/icons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/icons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/icons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/icons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/icons/apple-touch-icon-120x120.png">
    <link rel="icon" type="image/png" href="/icons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/icons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/icons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/icons/manifest.json">
    <meta name="msapplication-TileColor" content="#ff0000">
    <meta name="theme-color" content="#ffffff">
</head>

@if (Auth::check())

<body>
<div class="page_wrapper">
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"><span><img src="/app/img/logo.png" alt=""></span></a>						
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						<li class="dropdown">
							<a class="btn" data-toggle="dropdown" href="#">
								{{ Auth::user()->name }} 
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid-full">
		<div class="row-fluid">
				
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						@if(Auth::user()->type == 'admin')
						<li><a href="/user"><i class="icon-user"></i><span class="hidden-tablet"> Gebruikers Beheer</span></a></li>	
						<li><a href="/manage/kot"><i class="icon-home"></i><span class="hidden-tablet"> Koten Beheer</span></a></li>	
						@endif
						<li><a href="/kot"><i class="icon-tasks"></i><span class="hidden-tablet"> Koten Overzicht</span></a></li>	
						<li><a href="/kot/create"><i class="icon-plus"></i><span class="hidden-tablet"> Kot Toevoegen</span></a></li>
						<li><a href="/help"><i class="icon-info-sign"></i><span class="hidden-tablet"> Help</span></a></li>
						<li><a href="/auth/logout"><i class="icon-signout"></i><span class="hidden-tablet"> Uitloggen</span></a></li>
					</ul>
				</div>
			</div>
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>Please enable javaScript to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">
			
	@yield('content')

		<div class="clearfix"></div>
</div>
		<footer class="site_footer">
			<p>&copy; 2015 <a href="#">Maico Paulussen &amp; Matthias Verhoeven</a></p>
		</footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="/app/js/bootstrap.min.js"></script>
		<script src="/app/js/custom.js"></script>
		<script src="/js/app.js"></script>
		<script src="/lib/pickadate/picker.js"></script>
		<script src="/lib/pickadate/picker.date.js"></script>
		<script src="/lib/pickadate/translations/nl_NL.js"></script>
		<script>
			$(document).ready(function(){
				$('.date').pickadate({
					format : 'yyyy-mm-dd',
			        formatSubmit : 'yyyy-mm-dd'
			        
			    });
			})
		</script>
</body>
@endif
</html>
