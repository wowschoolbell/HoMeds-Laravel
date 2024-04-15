@extends('layouts.master')
@section('title', 'Users')

@section('content')
<div class="bg-dark">
    <div class="container-fluid  m-b-30">
        <div class="row">
            <div class="col-md-8 text-white p-t-40 p-b-90">
                <h4 class="">
                    <span class="btn btn-white-translucent">
                    <i class="mdi mdi-counter"></i></span> Users
                </h4>
            </div>
            <div class="col-md-4 text-right p-t-40 p-b-90">
                <button class="btn btn-md btn-primary btn-add-category" data-toggle="modal" data-target="#usermodel" data-route="{{ route('sa.backend_users.create')}}" type="button"><i class="mdi mdi-plus"></i>Add User</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-slide-right usermodel" id="usermodel" tabindex="-1" role="dialog"
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
                    <div class="table-responsive p-t-10">
                        {!! $dataTable->table(['class'=> 'table', 'id' => 'datatable-buttons']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@php
$create_route = route('sa.backend_users.create');
@endphp
@include('layouts.partials.datatable_scripts')

@push('scripts')
    <script src="{{ asset('theme/light/vendor/blockui/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('theme/light/vendor/blockui/blockui-data.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function ()
    {
        $(".usermodel").on('shown.bs.modal', function (e) {
            var user_id = $(e.relatedTarget).data('user_id');

            if(!user_id)
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
                    $(".usermodel .modal-content").html(data);
                }
            });
        });
    });

    </script>
@endpush
