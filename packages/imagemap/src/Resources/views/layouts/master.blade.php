<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    <base href="{{asset('')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700&amp;subset=vietnamese"
          rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('packages/imagemap/css/style.css') }}">
    @yield('addCss')
</head>
<body>
<div id="loader"></div>
@include('imagemap::layouts.header')
<div class="site-content">
    @yield('imagemap::content')
</div>
@include('imagemap::layouts.footer')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
<script src="{{ asset('packages/imagemap/js/main.js ')}}"></script>
@yield('addJs')
</body>
</html>
