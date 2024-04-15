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
                                <th>Event Image</th>
                                <th>Name</th>
                                <th>Event Title</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                @if ($events = @$user->data()['events_enrolled'])
                                    @foreach($events as $event)
                                        <tr>
                                            <td>
                                                <div class='avatar avatar-sm'>
                                                    <img src="{{@$event['event_image'] ?: asset('theme/light/img/default_user.png')}}" class='avatar-img avatar-sm rounded-circle lazy' alt=''></div>
                                            </td>
                                            <td>{{@$user->data()['first_name'].' '.@$user->data()['last_name']}}</td>
                                            <td>{{@$event['event_title']}}</td>
                                        </tr>
                                    @endforeach
                                @endif
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
