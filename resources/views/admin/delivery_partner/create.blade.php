@extends('layouts.master')
@section('title','Deliery Partner')
@section('content')
    {{ Form::model($model, ['route' => [ "admin.delivery_partner.store"],'files' => true,'class' => 'popup_form','method' => 'POST']) }}
    @include('admin.delivery_partner.partials.form')
    {{ Form::close() }}
@endsection
