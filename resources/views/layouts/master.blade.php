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
    @include('layouts.partials.css')
    <div class="loader"></div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.21.1/sweetalert2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.21.1/sweetalert2.min.js"></script>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.js"></script> --}}
</head>
<!--body with default sidebar pinned -->
<body class="sidebar-pinned">
    <!--sidebar Begins-->
        @include('sweetalert::alert')
        @include('layouts.partials.admin.left_sidebar')
    <!--sidebar Ends-->

    <main class="admin-main media-ml10">
        <!--site header begins-->
            @include('layouts.partials.admin.header')
        <!--site header ends -->

        <section class="admin-content">
            <!-- BEGIN PlACE PAGE CONTENT HERE -->
            {{-- @include('sweetalert::cdn')
            @include('sweetalert::view') --}}
            <!-- @include('layouts.partials.admin.breadcrumb') -->
            @yield('content')
            <!-- END PLACE PAGE CONTENT HERE -->
        </section>
    </main>

    @include('layouts.partials.script')
</body>

</html>
