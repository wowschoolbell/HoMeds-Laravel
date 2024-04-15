@extends('layouts.master')
@section('title','')
@section('content')
<div class="bg-dark">
    <div class="container-fluid p-b-100">
        <div class="row p-t-40">
                <div class="col-md-8 text-left text-white">
                    <h4 class="">
                        <span class="btn btn-white-translucent">
                        <i class="mdi mdi-book-open-page-variant"></i></span> Courses
                    </h4>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{route('sa.courses.create')}}" class="btn btn-primary btn-advance"><i class="mdi mdi-plus"></i>Create Course</a>
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
                                {{ Form::open(['route' => [ "sa.courses.index"], 'class' => 'form-horizontal courses-search','method' => 'GET','id'=>'courses-search']) }}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label class="">Course Categories</label>
                                        {{ Form::select('category', $categories, @request()->category, ['class' => "form-control"]) }}
                                    </div>
                                    <div class="form-group col-md-6 m-t-30">
                                        <button type="submit" class="btn btn-success" title="Search">
                                            <i class="mdi mdi-magnify"></i>
                                        </button>
                                        <a href="{{route('sa.courses.index')}}" class="btn btn-danger reset" title="Reset"><i class="mdi mdi-loop"></i></a>
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
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive p-t-10">
                                <table id="datatable-buttons" class='table'>
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Title</th>
                                            <th>User</th>
                                            <th>Category</th>
                                            <th>Updated At</th>
                                            {{-- <th>Status</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($courses as $course)
                                            @php
                                                $show = true;
                                                if(@request()->category && @request()->category != $course->data()['category_id']) {
                                                    $show = false;
                                                }
                                            @endphp
                                            @if ($show)
                                                <tr>
                                                    <td>{{@$course->data()['course_id']}}</td>
                                                    <td>
                                                        <a href="{{route('sa.courses.show', $course->id())}}" class="text-success">
                                                            {{@$course->data()['title']}}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @php
                                                            $user = App\User::find(@$course->data()['backend_user_id'])->name;
                                                        @endphp
                                                        {{ $user }}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $model = app('firebase.firestore')->database()->collection('course categories')->document(@$course->data()['category_id'])->snapshot();
                                                        @endphp
                                                        {{@$model->data()['name']}}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $date = Carbon\Carbon::parse($course->data()['last_updated'])->format('d-m-Y H:s A');
                                                        @endphp
                                                        {{$date}}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('sa.quizzes.index').'?course_id='.$course->id() }}" class="btn btn-sm btn-primary" title="View Quiz"><i class="mdi mdi-cloud-question"></i></a>&nbsp;&nbsp;
                                                        <a href="{{ route('sa.courses.edit', @$course->id()) }}" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;&nbsp;
                                                        <button class="btn btn-sm btn-danger record-delete" type="button" data-url="{{route('sa.courses.destroy', @$course->id())}}" data-redirect="{{route('sa.courses.index')}}" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
                                                    </td>
                                                </tr>
                                            @endif
                                            
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $create_route = route('sa.courses.create');
@endphp
@endsection
@include('layouts.partials.datatable_scripts')