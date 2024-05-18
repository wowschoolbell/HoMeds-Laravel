@extends('layouts.master')
@section('title','Deliery Partner')
@section('content')
    {{ Form::model($model, ['route' => [ "admin.store.store"],'files' => true,'class' => 'popup_form','method' => 'POST']) }}
    @include('admin.store.partials.form')
    {{ Form::close() }}
@endsection
