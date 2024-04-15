<link rel="icon" type="image/x-icon" href="{{ asset('theme/light/img/logo.png') }}"/>
<link rel="icon" href="{{ asset('theme/light/img/logo.png') }}" type="image/png" sizes="16x16">
<link rel="stylesheet" href="{{ asset('theme/light/vendor/pace/pace.css') }}">
<script src="{{ asset('theme/light/vendor/pace/pace.min.js') }}"></script>
<!--vendors-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/light/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/light/vendor/jquery-scrollbar/jquery.scrollbar.css') }}">
<link rel="stylesheet" href="{{ asset('theme/light/vendor/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/light/vendor/jquery-ui/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/light/vendor/daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('theme/light/vendor/timepicker/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/light/vendor/croppie/croppie.css') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}">
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css"> --}}
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,600" rel="stylesheet">
<!--Material Icons-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/light/fonts/materialdesignicons/materialdesignicons.min.css') }}">
<!--Material Icons-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/light/fonts/feather/feather-icons.css') }}">
<!--Bootstrap + atmos Admin CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/light/css/atmos.min.css') }}">
<!-- Additional library for page -->
<link href="{{ asset('css/custom.css?v='.File::lastModified('css/custom.css')) }}" id="theme" rel="stylesheet">

{{-- screen loader --}}
<style>
    .loader
        {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{ asset("theme/light/img/loading.gif") }} ') 50% 50% no-repeat rgb(249,249,249);
        }
</style>
@stack('stylesheets')
