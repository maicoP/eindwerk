<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />  

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,700,400italic,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="/css/animate.min.css" type="text/css">
    <link rel="stylesheet" href="/css/custom.css" type="text/css">
	<!-- <link href="/css/app.css" rel="stylesheet"> -->
	<link href="/lib/pickadate/themes/default.css" rel="stylesheet">
	<link href="/lib/pickadate/themes/default.date.css" rel="stylesheet">
	<script src="/js/app.js"></script>
</head>

<body id="top">
	@yield('content')
	@yield('scripts')
</body>
</html>
