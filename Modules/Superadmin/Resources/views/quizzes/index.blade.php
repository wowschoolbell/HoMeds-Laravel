@extends('layouts.master')
@section('content')


<div class="bg-dark">
    <div class="container-fluid p-b-100">
        <div class="row p-t-40">
                <div class="col-md-8 text-left text-white">
                    <h4 class="">
                        <span class="btn btn-white-translucent">
                        <i class="mdi mdi-book-open-page-variant"></i></span> Quizzes
                    </h4>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{route('sa.quizzes.create',['course_id' => @request()->course_id])}}" class="btn btn-primary btn-advance"><i class="mdi mdi-plus"></i>Create Quiz</a>
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
                                <th>Course</th>
                                <th>Question</th>
                                <th>Point</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                                <tr>
                                    <td>
                                        @php
                                            $model = app('firebase.firestore')->database()->collection('courses')->document(@$quiz->data()['course'])->snapshot();
                                        @endphp
                                        {{@$model->data()['title']}}
                                    </td>
                                    <td>{{@$quiz->data()['question']}}</td>
                                    <td>{{@$quiz->data()['point']}}</td>
                                    <td>
                                        <a href="{{ route('sa.quizzes.edit', [@$quiz->id(), 'course_id' => @request()->course_id]) }}" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;&nbsp;
                                        <button class="btn btn-sm btn-danger record-delete" type="button" data-url="{{route('sa.quizzes.destroy', @$quiz->id())}}" data-redirect="{{route('sa.quizzes.index')}}" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
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
@php
    $create_route = route('sa.courses.create');
@endphp
@endsection
@include('layouts.partials.datatable_scripts')