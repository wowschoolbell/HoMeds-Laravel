@extends('layouts.master')
@section('title', '')

@section('content')
<div class="bg-dark">
    <div class="container-fluid p-b-100">
        <div class="row p-t-40">
                <div class="col-md-8 text-left text-white">
                    <h4 class="">
                        <span class="btn btn-white-translucent">
                        <i class="mdi mdi-book-open-page-variant"></i></span> Events
                    </h4>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{route('sa.events.create')}}" class="btn btn-primary btn-advance"><i class="mdi mdi-plus"></i>Create Event</a>
                    <a class="btn btn-primary btn-advance" id="advance-search-btn" data-toggle="collapse" href="#collapseAdvanced" role="button" aria-expanded="false" aria-controls="collapseAdvanced">
                        <i class="mdi mdi-table-search"></i>
                    </a>
                </div>
                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="collapse {{ @request()->category ? 'show' : '' }}" id="collapseAdvanced">
                            <div class="card-header bg-primary">
                                <h5 class="m-b-0 text-white"><i class="mdi mdi-magnify"></i> Advanced search</h5>
                            </div>
                            <div class="card-body ">
                                {{ Form::open(['route' => [ "sa.events.index"], 'class' => 'form-horizontal courses-search','method' => 'GET','id'=>'courses-search']) }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="">Event Categories</label>
                                        {{ Form::select('category', $categories, @request()->category, ['class' => "form-control"]) }}
                                    </div>
                                    <div class="form-group col-md-6 m-t-30">
                                        <button type="submit" class="btn btn-success" title="Search">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                        <a href="{{route('sa.events.index')}}" class="btn btn-danger reset" title="Reset"><i class="mdi mdi-loop"></i></a>
                                    </div>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="datatable-buttons" class='table'>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>category</th>
                                {{-- <th>Course</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                                <tr>
                                    <td>
                                        <a href="{{route('sa.events.show', $event->id())}}" class="text-success">
                                            {{@$event->data()['title']}}
                                        </a>
                                    </td>
                                    <td>
                                        @php
                                            $model = app('firebase.firestore')->database()->collection('event categories')->document(@$event->data()['category_id'])->snapshot();
                                        @endphp
                                        {{@$model->data()['name']}}
                                    </td>
                                    {{-- <td>
                                        @php
                                            @$model = app('firebase.firestore')->database()->collection('courses')->document(@$event->data()['recommended_course'])->snapshot();
                                        @endphp
                                        {{@$model->data()['title']}}
                                    </td> --}}
                                    <td>
                                        <a href="{{ route('sa.events.edit', @$event->id()) }}" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;&nbsp;
                                        <button class="btn btn-sm btn-danger record-delete" type="button" data-url="{{route('sa.events.destroy', @$event->id())}}" data-redirect="{{route('sa.events.index')}}" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@php
    $create_route = route('sa.events.create');
@endphp
@include('layouts.partials.datatable_scripts')
@include('layouts.partials.dropify_scripts')
