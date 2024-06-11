@extends('layouts.master')

@section('content')
    {{ Form::model($model, ['route' => ["admin.items.update", $id] ,'class' => 'popup_form','method' => 'PUT','files' => true]) }}
    @include('admin.items.partials.form')
    {{ Form::close() }}
@endsection