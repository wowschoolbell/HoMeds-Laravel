@extends('layouts.master')

@section('content')
    {{ Form::model($model, ['route' => ["admin.customers.update", $id] ,'class' => 'popup_form','method' => 'PUT','files' => true]) }}
    @include('admin.customers.partials.form')
    {{ Form::close() }}
@endsection