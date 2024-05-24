@extends('layouts.master')

@section('content')
    {{ Form::model($model, ['route' => ["admin.status.update", $id] ,'class' => 'popup_form','method' => 'PUT','files' => true]) }}
    @include('admin.status.partials.form')
    {{ Form::close() }}
@endsection