@extends('layouts.master')

@section('content')
    {{ Form::model($model, ['route' => ["admin.delivery_partner.update", $id] ,'class' => 'popup_form','method' => 'PUT','files' => true]) }}
    @include('admin.delivery_partner.partials.form')
    {{ Form::close() }}
@endsection