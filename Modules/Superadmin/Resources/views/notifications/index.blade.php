@extends('layouts.master')
@section('title', 'Notifications')

@section('content')
<div class="bg-dark">
    <div class="container-fluid  m-b-30">
        <div class="row">
            <div class="col-md-8 text-white p-t-40 p-b-90">
                <h4 class="">
                    <span class="btn btn-white-translucent">
                    <i class="mdi mdi-counter"></i></span> Notifications
                </h4>
            </div>
            <div class="col-md-4 text-right p-t-40 p-b-90">
                <button class="btn btn-md btn-primary btn-add-category" data-toggle="modal" data-target="#notificationmodel" data-route="{{ route('sa.notifications.create')}}" type="button"><i class="mdi mdi-plus"></i>Add Notification</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-slide-right notificationmodel" id="notificationmodel" tabindex="-1" role="dialog"
    aria-labelledby="RouteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="pop-up-modal"></div>
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
                                <th>Created By</th>
                                <th>Content</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notifications as $notification)
                                <tr>
                                    <td>
                                        {{@$notification->data()['user']['name']}}
                                    </td>
                                    <td>{{@$notification->data()['text']}}</td>
                                    <td>{{carbon\Carbon::parse(@$notification->data()['createdAt'])->format('d-m-Y H:s A')}}</td>
                                    <td>
                                        <a href="javascript:void(0)" data-category_id="{{$notification->id()}}" 
                                            data-url="{{route('sa.notifications.edit',[$notification->id()])}}" 
                                            data-toggle="modal" data-target="#notificationmodel" 
                                            class="btn btn-sm btn-info" 
                                            id="trigger-content-{{$notification->id()}}" 
                                            title="Edit">
                                            <i class="mdi mdi-square-edit-outline">
                                            </i>
                                        </a>
                                        <button class="btn btn-sm btn-danger record-delete" 
                                            type="button"
                                            data-url="{{route('sa.notifications.destroy', @$notification->id())}}" 
                                            data-redirect="{{route('sa.notifications.index')}}" 
                                            title="Delete">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
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
$create_route = route('sa.notifications.create');
@endphp
@include('layouts.partials.datatable_scripts')
@include('layouts.partials.dropify_scripts')

@push('stylesheets')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/light/vendor/colorpicker/bootstrap-colorpicker.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('theme/light/vendor/blockui/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('theme/light/vendor/blockui/blockui-data.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function ()
    {
        $(".notificationmodel").on('shown.bs.modal', function (e) {
            var category_id = $(e.relatedTarget).data('category_id');

            if(!category_id)
                var Url = '{{$create_route}}';
            else
                var Url = $(e.relatedTarget).data('url');

            $.ajax({
                method: 'GET',
                url: Url,
                beforeSend: function () {
                    $(".modal-dialog #pop-up-modal").block({});
                },
                success: function (data) {
                    $(".notificationmodel .modal-content").html(data);
                    $('.dropify').dropify();
                }
            });
        });
    });

    </script>
@endpush
