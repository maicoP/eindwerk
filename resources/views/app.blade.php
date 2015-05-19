<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>@yield('title')</title>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link id="bootstrap-style" href="/app/css/bootstrap.min.css" rel="stylesheet">
	<link href="/app/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="/app/css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="/app/css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>	
	<link href="/lib/pickadate/themes/default.css" rel="stylesheet">
	<link href="/lib/pickadate/themes/default.date.css" rel="stylesheet">
</head>

@if (Auth::check())

<body>

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
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> {{ Auth::user()->name }} 
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="login.html"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
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
						<li><a href="/kot"><i class="icon-tasks"></i><span class="hidden-tablet"> Koten Overzicht</span></a></li>	
						<li><a href="/kot/create"><i class="icon-plus"></i><span class="hidden-tablet"> Kot Toevoegen</span></a></li>
						<li><a href="#"><i class="icon-envelope"></i><span class="hidden-tablet"> Contact</span></a></li>
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
			
				<ul class="breadcrumb">
					<li>
						<i class="icon-home"></i>
						<a href="/kot">Home</a>
						<i class="icon-angle-right"></i> 
					</li>
	@yield('content')

		<div class="clearfix"></div>
		
		<footer>
			<p><span style="text-align:left;float:left">&copy; 2015 <a href="#" alt="Bootstrap_Metro_Dashboard">Maico Paulussen &amp; Matthias Verhoeven</a></span></p>
		</footer>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="/app/js/bootstrap.min.js"></script>
		<script src="/app/js/custom.js"></script>

		<script src="/lib/pickadate/picker.js"></script>
		<script src="/lib/pickadate/picker.date.js"></script>
		<script src="/lib/pickadate/translations/nl_NL.js"></script>
		<script>
			$(document).ready(function(){
				$('.date').pickadate({
					format : 'dd-mm-yyyy',
			        formatSubmit : 'yyyy-mm-dd'
			        
			    });
			})
		</script>
</body>
@endif
</html>
