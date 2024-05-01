@extends('layouts.master')
@section('title', 'Add Store')

@section('content')

<div class="container " style="margin-top: 1%;">

    <div class="row">
        <div class="col-12">
            @foreach($statuses as $id => $status)
                <?php
                    $class = "btn-dark-lavender";

                    if((@request()->status == null && $id == 0)) {
                        $class = "btn-lavender";
                    }

                    if (@request()->status == $id) {
                        $class = "btn-lavender";
                    }
                
                ?>
                <a href="{{ route('admin.store.index')}}?status={{$id}}" class="btn btn-sm {{$class}}" title="Edit"><i class="mdi mdi mdi-triforce"></i> {{$status}}</a>
            @endforeach
        </div>
        <div class="col-12" style="margin-top: 2%;">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive p-t-10">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@include('layouts.partials.datatable_scripts')
@include('layouts.partials.ajax_save_scripts')


@push('stylesheets')
<style>
    .btn-dark-lavender {
        background-color: #5058A7 !important;
        color: white !important;
    }

    .btn-lavender {
        background-color: #B57EDC !important;
        color: white !important;
    }
</style>

@push('scripts')
<script src="{{ asset('theme/light/vendor/blockui/jquery.blockUI.js') }}"></script>
<script src="{{ asset('theme/light/js/blockui-data.js') }}"></script>
    <script type="text/javascript">
        $(".statusmodel").on('shown.bs.modal', function (event) {
            event.preventDefault();
            var data    = event.currentTarget.dataset;
            var Url =   $(event.relatedTarget).data('route');

            $.ajax({
                method: 'GET',
                url: Url,
                beforeSend: function () {
                    $(".modal-dialog #pop-up-modal").block({});
                },
                success: function (data) {
                    $(".statusmodel .modal-content").html(data);
                },
                error: function (jqXhr) {
                    var response = JSON.parse(jqXHR.responseText);
                }
            });
        });
    </script>
    
    
@endpush
