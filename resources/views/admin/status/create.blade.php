@extends('layouts.master')
@section('title','Status')
@section('content')
    {{ Form::model($model, ['route' => [ "admin.status.store"],'files' => true,'class' => 'popup_form','method' => 'POST']) }}
    @include('admin.status.partials.form')
    {{ Form::close() }}
@endsection
