@extends('layouts.master')
@section('title','Add Customers')
@section('content')
    {{ Form::model($model, ['route' => [ "admin.items.store"],'files' => true,'class' => 'popup_form','method' => 'POST']) }}
    @include('admin.items.partials.form')
    {{ Form::close() }}
@endsection
