@extends('layouts.admin')
@section('title', 'Activity Tag')

@section('content')
<div class="bg-dark">
    <div class="container-fluid  m-b-30">
        <div class="row">
            <div class="col-md-8 text-white p-t-40 p-b-90">
                <h4 class="">
                    <span class="btn btn-white-translucent">
                    <i class="mdi mdi-tag"></i></span> Edit - Activity Tag
                </h4>
            </div>
            <div class="col-md-4 text-right p-t-40 p-b-90">
                <a href="{{route('admin.activity_tags.index')}}" class="btn btn-secondary"><i class="mdi mdi-keyboard-backspace"></i> Back</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid pull-up">
    <div class="row">
        <div class="col-lg-12">
            <!--widget card begin-->
            <div class="card m-b-30">
                <div class="card-header">
                    <h5 class="m-b-0">
                        Activity Tag Details
                    </h5>
                </div>
                <div class="card-body">
                    {{ Form::model($model, ['route' => ["admin.activity_tags.update", $model['activity_tag']->id], 'class' => 'form-horizontal ajax_form', 'method' => 'PUT', 'files' => true]) }}
                        @include('admin.activity_tags.partials.form')
                    {{ Form::close() }}
                </div>
            </div>
            <!--widget card ends-->
        </div>
    </div>
</div>
@endsection

@include('layouts.partials.ajax_save_scripts')

