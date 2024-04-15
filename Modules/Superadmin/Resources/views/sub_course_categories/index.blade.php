@extends('layouts.master')

@section('title', '')
@section('content')

<div class="bg-dark">
    <div class="container-fluid  m-b-30">
        <div class="row">
            <div class="col-md-8 text-white p-t-40 p-b-90">
                <h4 class="">
                    <span class="btn btn-white-translucent">
                    <i class="mdi mdi-counter"></i></span> Course Sub Categories
                </h4>
            </div>
            <div class="col-md-4 text-right p-t-40 p-b-90">
                <button class="btn btn-md btn-primary btn-add-category" data-toggle="modal" data-target="#subcoursecategorymodal" data-route="{{ route('sa.sub_course_categories.create')}}" type="button"><i class="mdi mdi-plus"></i>Add</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-slide-right subcoursecategorymodal" id="subcoursecategorymodal" tabindex="-1" role="dialog"
     aria-labelledby="RouteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="pop-up-modal">
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                @php
                                    $show = true;
                                    if(@request()->category && @request()->category != $category->data()['category_id']) {
                                        $show = false;
                                    }
                                @endphp
                                @if ($show)
                                <tr>
                                    <td>
                                    <a class="text-success" href="{{route('sa.courses.index').'?sub_course_category='.$category->id()}}">{{@$category->data()['name']}}
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)" data-category_id="{{$category->id()}}" 
                                            data-url="{{route('sa.sub_course_categories.edit',[$category->id()]).'?category='.@request()->category}}" 
                                            data-toggle="modal" data-target="#subcoursecategorymodal" 
                                            class="btn btn-sm btn-info" 
                                            id="trigger-content-{{$category->id()}}" 
                                            title="Edit">
                                            <i class="mdi mdi-square-edit-outline">
                                            </i>
                                        </a>
                                        <button class="btn btn-sm btn-danger record-delete" 
                                            type="button"
                                            data-url="{{route('sa.sub_course_categories.destroy', @$category->id())}}" 
                                            data-redirect="{{route('sa.sub_course_categories.index')}}" 
                                            title="Delete">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </button>
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

@stop

@php
$create_route = route('sa.sub_course_categories.create').'?category='.@request()->category;
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
        $(".subcoursecategorymodal").on('shown.bs.modal', function (e) {
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
                    $(".subcoursecategorymodal .modal-content").html(data);
                    $('.dropify').dropify();
                }
            });
        });
    });

    </script>
@endpush
