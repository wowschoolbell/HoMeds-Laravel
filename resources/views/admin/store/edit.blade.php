@extends('layouts.master')

@section('content')
    {{ Form::model($model, ['route' => ["admin.store.update", $id] ,'class' => 'popup_form','method' => 'PUT','files' => true]) }}
    @include('admin.store.partials.form')
    {{ Form::close() }}
@endsection