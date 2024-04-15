@extends('layouts.master')
@section('title','Dashboard')
@section('content')
<!--  container or container-fluid as per your need  -->
<div class="container">
    <div class="m-t-20">
        <div class="row">
            
            
        </div>
    </div>
</div>
@endsection

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/light/vendor/fullcalender/fullcalendar.min.css') }}">
    <style>
        .pre-scrollable{
            max-height: 100%;
        }
        .widget-chart{
            height: 340px;
        }   
        .widget-chart.height {
            height: 606px;
        }           
    </style>
@endpush
