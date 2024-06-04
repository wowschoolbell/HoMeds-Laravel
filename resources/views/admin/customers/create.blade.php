@extends('layouts.master')
@section('title','Add Customers')
@section('content')
    {{ Form::model($model, ['route' => [ "admin.customers.store"],'files' => true,'class' => 'popup_form','method' => 'POST']) }}
    @include('admin.customers.partials.form')
    {{ Form::close() }}
@endsection
