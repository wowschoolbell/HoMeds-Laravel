@extends('layouts.master')
@section('title', 'Cities')

@section('content')
<div class="modal fade modal-slide-right citymodel" id="citymodel" tabindex="-1" role="dialog"
    aria-labelledby="RouteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="pop-up-modal"></div>
    </div>
</div>

<div class="container-fluid" style="margin-top: 3%;">
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
@php
    $create_route = route('admin.category.create');
@endphp
@endsection

@include('layouts.partials.datatable_scripts')
@include('layouts.partials.ajax_save_scripts')

@push('scripts')
<script src="{{ asset('theme/light/vendor/blockui/jquery.blockUI.js') }}"></script>
<script src="{{ asset('theme/light/js/blockui-data.js') }}"></script>
    <script type="text/javascript">
        $(".citymodel").on('shown.bs.modal', function (event) {
            event.preventDefault();
            var data    = event.currentTarget.dataset;
            var Url =   $(event.relatedTarget).data('url');
            console.log(Url);
            if (!Url) {
                var Url     = '{{$create_route}}';
            }

            $.ajax({
                method: 'GET',
                url: Url,
                beforeSend: function () {
                    $(".modal-dialog #pop-up-modal").block({});
                },
                success: function (data) {
                    $(".citymodel .modal-content").html(data);
                    closeModel();
                    select2_without_search();
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

            // $('.citymodel').click(function () {
            //     $('.modal-backdrop').css('display', 'none');
            // });
        }
    </script>
@endpush
