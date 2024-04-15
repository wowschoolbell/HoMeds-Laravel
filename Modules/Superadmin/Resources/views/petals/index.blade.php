@extends('layouts.master')
@section('title','')
@section('content')
<div class="bg-dark">
    <div class="container-fluid p-b-100">
        <div class="row p-t-40">
                <div class="col-md-8 text-left text-white">
                    <h4 class="">
                        <span class="btn btn-white-translucent">
                        <i class="mdi mdi-book-open-page-variant"></i></span> Petals
                    </h4>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{route('sa.petals.create')}}" class="btn btn-primary btn-advance"><i class="mdi mdi-plus"></i>Create Petal</a>
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
                                            <th>Name</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($petals as $petal)
                                                <tr>
                                                    <td>
                                                        {{@$petal->data()['name']}}
                                                    </td>
                                                    <td>
                                                        @php
                                                            $model = app('firebase.firestore')->database()->collection('courses')->document(@$petal->data()['course_id'])->snapshot();
                                                        @endphp
                                                        {{@$model->data()['title']}}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('sa.petals.edit', @$petal->id()) }}" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;&nbsp;
                                                        <button class="btn btn-sm btn-danger record-delete" type="button" data-url="{{route('sa.petals.destroy', @$petal->id())}}" data-redirect="{{route('sa.petals.index')}}" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
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
        </div>
    </div>
</div>
@php
    $create_route = route('sa.petals.create');
@endphp
@endsection
@include('layouts.partials.datatable_scripts')