@extends('layouts.master')
@section('title', 'Store')

@section('content')

<div class="modal fade modal-slide-right statusmodel" id="statusmodel" tabindex="-1" role="dialog"
    aria-labelledby="RouteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="pop-up-modal"></div>
    </div>
</div>

<div class="container " style="margin-top: 3%;">
    <div class="row">
        <div class="col-12">
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
@php
$create_route = route('admin.store.create');
@endphp

@include('layouts.partials.datatable_scripts')
@include('layouts.partials.ajax_save_scripts')

@push('scripts')
<script src="{{ asset('theme/light/vendor/blockui/jquery.blockUI.js') }}"></script>
<script src="{{ asset('theme/light/js/blockui-data.js') }}"></script>
    <script type="text/javascript">
        $(".statusmodel").on('shown.bs.modal', function (event) {
            event.preventDefault();
            var data    = event.currentTarget.dataset;
            var Url     = '{{$create_route}}';

            $.ajax({
                method: 'GET',
                url: Url,
                beforeSend: function () {
                    $(".modal-dialog #pop-up-modal").block({});
                },
                success: function (data) {
                    $(".statusmodel .modal-content").html(data);
                    closeModel();
                },
                error: function (jqXhr) {
                    var response = JSON.parse(jqXHR.responseText);
                }
            });
        });

        function closeModel()
        {
            $('.data-dismiss').click(function () {
                $('.modal-backdrop').css('display', 'none');
            });

            // $('.statusmodel').click(function () {
            //     $('.modal-backdrop').css('display', 'none');
            // });
        }
    </script>
@endpush
