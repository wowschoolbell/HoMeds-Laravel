@extends('layouts.master')
@section('title','users')
@section('content')
    <div class="container">
        <div class="row p-t-20">
            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-header bg-secondary">
                        <h5 class="m-b-0">{{ __('Edit User') }}</h5>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route' => ["sa.users.update", $id] ,'class' => 'popup_form','method' => 'PUT']) }}
                            @include('superadmin::users.partials.form')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
