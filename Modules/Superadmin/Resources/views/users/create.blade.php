@extends('layouts.master')

@section('title','Users')
@section('content')
    <div class="container">
        <div class="row p-t-20">
            <div class="col-sm-12">
                <div class="card m-b-30">
                    <div class="card-header bg-secondary">
                        <h5 class="m-b-0">{{ __('Create User') }}</h5>
                    </div>                    
                    <div class="card-body">
                        {{ Form::open(['route' => [ "sa.users.store" ],'class' => 'popup_form','method' => 'POST']) }}
                            @include('superadmin::users.partials.form')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
