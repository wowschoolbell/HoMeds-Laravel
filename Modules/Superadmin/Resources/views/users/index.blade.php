@extends('layouts.master')
@section('title', '')

@section('content')
<div class="bg-dark">
    <div class="container-fluid  m-b-30">
        <div class="row">
            <div class="col-md-8 text-white p-t-40 p-b-90">
                <h4 class="">
                    <span class="btn btn-white-translucent">
                    <i class="mdi mdi-account-key"></i></span> CW App Users
                </h4>
            </div>
            <div class="col-md-4 text-right p-t-40 p-b-90">
                <a href="{{ route('sa.users.create') }}" class="btn btn-md btn-primary btn-add-category" title="Edit"><i class="mdi mdi-plus"></i>Add User</a>
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
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Organisation</th>
                                <th>Experience Level</th>
                                <th>Mobile Number</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{@$user->data()['first_name'].' '.@$user->data()['last_name']}}</td>
                                    <td>{{@$user->data()['gender']}}</td>
                                    <td>{{@$user->data()['organization']}}</td>
                                    <td>{{@$user->data()['experience_level']}}</td>
                                    <td>{{@$user->data()['mobile_number']}}</td>
                                    <td>
                                        <a href="{{ route('sa.users.edit', @$user->id()) }}" class="btn btn-sm btn-info" title="Edit"><i class="mdi mdi-square-edit-outline"></i></a>&nbsp;&nbsp;
                                        <button class="btn btn-sm btn-danger record-delete" type="button" data-url="{{route('sa.users.destroy', @$user->id())}}" data-redirect="{{route('sa.users.index')}}" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button>
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
    $create_route = route('sa.courses.create');
@endphp
@include('layouts.partials.datatable_scripts')
@include('layouts.partials.dropify_scripts')
