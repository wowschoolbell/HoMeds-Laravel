<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('theme/light/img/logo.png') }}"/>
    <link rel="icon" href="{{ asset('theme/light/img/logo.png') }}" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('theme/light/vendor/pace/pace.css') }}">
    <script src="{{ asset('theme/light/vendor/pace/pace.min.js') }}"></script>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600" rel="stylesheet">
    <!--Material Icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/light/fonts/materialdesignicons/materialdesignicons.min.css') }}">
    <!--Material Icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/light/fonts/feather/feather-icons.css') }}">
    <!--Bootstrap + atmos Admin CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/light/css/atmos.min.css') }}">
    <!-- Additional library for page -->
    <link href="{{ asset('css/custom.css?v='.File::lastModified('css/custom.css')) }}" id="theme" rel="stylesheet">
</head>
<body class="jumbo-page">
    @yield('content')

    <script src="{{ asset('theme/light/vendor/jquery/jquery.min.js') }}"   ></script>
    <script src="{{ asset('theme/light/vendor/bootstrap/js/bootstrap.min.js') }}"   ></script>
    <!--page specific scripts for demo-->
</body>
</html>
