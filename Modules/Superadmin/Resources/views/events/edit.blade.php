@extends('layouts.master')
@section('title','Events')
@section('content')
    <div class="container">
        <div class="row p-t-20">
            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-header">
                        <h5 class="m-b-0">{{ __('Edit Event') }}</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route' => ["sa.events.update", @$id] ,'class' => 'popup_form','method' => 'PUT']) }}
                            @include('superadmin::events.partials.form')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
