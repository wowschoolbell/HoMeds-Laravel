@extends('layouts.master')
@section('title', 'Add Store')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

<div class="bg-dark">
    <div class="container-fluid  m-b-30">
        <div class="row">
            <div class="col-md-8 text-white p-t-40">
                <h4 class="">
                    <span class="btn btn-white-translucent">
                    <i class="mdi mdi-apps"></i></span> Store
                </h4>
            </div>
            <div class="col-md-4 text-right p-t-40 p-b-90">
                <a  class="btn btn-md btn-primary btn-add-category"  href={{ route('admin.store.create')}}  ><i class="mdi mdi-plus"></i>Add Store</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal-slide-right statusmodel" id="statusmodel" tabindex="-1" role="dialog"
    aria-labelledby="RouteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="pop-up-modal"></div>
    </div>
</div>

<div class="container-fluid pull-up">
    <div class="row">
        
        
        
                <div class="card-body">
                    <div class="col-12 ">
            <div class="card">
                <div class="col-12 pt-2">
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
                <a href="{{ route('admin.store.index')}}?status={{$id}}" class="btn btn-md {{$class}}" title="Edit"><i class="mdi mdi mdi-triforce"></i> {{$status}}</a>
            @endforeach
        </div>
                    <div class="table-responsive p-t-10 p-2">
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
