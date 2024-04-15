
@push('stylesheets')
<link rel="stylesheet" href="{{ asset('theme/light/vendor/DataTables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('theme/light/vendor/DataTables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="//cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@endpush

@push('scriptsrc')
<!-- Lazyload for User avatar images -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.js"></script>
<!-- DataTables -->
<script src="{{ asset('theme/light/vendor/DataTables/datatables.min.js') }}"></script>
<script src="//cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('/vendor/datatables/buttons.server-side.js') }}"></script>

<script src="{{ asset('/vendor/datatables/buttons.server-side.js?v='.File::lastModified('js/custom.js')) }}"></script>
@endpush

@push('scripts')
<script type="text/javascript">
    var defaultCreateURL = window.location.href.replace(/\/+$/, "") + '/create';
    var defaultPrintURL = window.location.href.replace(/\/+$/, "") + '/print';
    var customCreateURL = '{{ @$create_route or '' }}';
    var customPrintURL =    '{{@$print_route}}';

    var xhr;
        var print_rows_count = print_progress_step = print_progress_count = 0;
        var row_offset = row_limit = 10;
        var filename = '', mode = '';
    (function ($, DataTable) {
        DataTable.ext.buttons.customCreate = {
            className: 'buttons-create',

            text: function (dt) {
                return '<i class="mdi mdi-plus"></i> ' + dt.i18n('buttons.create', 'Create');
            },

            action: function (e, dt, button, config) {
                window.location = (customCreateURL) ? customCreateURL : defaultCreateURL;
            }
        };
        DataTable.ext.buttons.customPrint = {
            className: 'buttons-print',
            text: function (dt) {
                return '<i class="mdi mdi-printer"></i> ' + dt.i18n('buttons.print', 'Print');
            },
        };
        DataTable.ext.buttons.export_to_excel = {
            className: 'buttons-export',
            text: function (dt) {
                return dt.i18n('buttons.export_to_excel', '<i class="mdi mdi-file-excel"></i> Excels');
            },
            action: function (e, dt, button, config) {
                $('.export_all_csv').trigger('click');
            }
        };
    })(jQuery, jQuery.fn.dataTable);

    $(document).ready(function(){

        $('#DatatableViewModal .modal-body').html($('#loader-content').html());

            $('#DatatableViewModal').on("shown.bs.modal", function (e) {
                var $relElem = $(e.relatedTarget);

                $.ajax({
                    method: "GET",
                    url: $relElem.data('url'),
                    success: function (html) {
                        $('#datatableViewContent').html(html);
                    },
                    error: function (jqXhr) {
                        $('#DatatableViewModal').modal('hide');
                        swalError(jqXhr);
                    }
                });
            }).on("hidden.bs.modal", function (e) {
                $('#DatatableViewModal .modal-body').html($('#loader-content').html());
            });

        // over all delete concept
        $('body').on('click', '.btn-delete', function(){
            $this = $(this);
            // swal({
            //     title: 'Are you sure?',
            //     type: 'warning',
            //     showCancelButton: true,
            //     confirmButtonText: "Yes, delete it!",
            //     confirmButtonColor: "#DD6B55",
            // }).then((result) => {
            //     if (result.value) {
                    $.ajax({
                        method: 'DELETE',
                        url: $this.data('delete-route'),
                        success: function (data) {
                            swal({
                                title: "Deleted!",
                                text: "Your record has been deleted.",
                                type: "success",
                            });
                            $('#datatable-buttons').DataTable().draw(false);
                        },
                        error: function (jqXhr) {
                            swalError(jqXhr);
                        }
                    });
                // }
            // });
        });

        //Activate academic year and department
        $('body').on('click', '.btn-active', function (e) {
            var id = $(this).data('id');
            var active = $(this).data('active');
            var routename = $(this).attr('route');
			$.ajax({
                method: "POST",
                url: routename,
                data: {id: id, active: active},
                dataType: 'json',
                success: function (data) {
                    if (data.status == "A") {
                        swal("Model!", " Approved Successfully", "success");
                        if(data.message == 'Academic Year')
                            location.reload();
                    } else {
                        swal("Model!", " Declined Successfully", "success");
                    }
                    $('#datatable-buttons').DataTable().draw(false);
                },
                error: function (jqXhr) {
                    swalError(jqXhr);
                }
            });
        });

        //Invoice Generate
        $('body').on('click', '.btn-generate', function (e) {
            $this = $(this);
            swal({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: "Yes, Generate it!",
                confirmButtonColor: "#DD6B55",
            }).then((result) => {
                if (result.value) {
                    var routestopfare_id = $(this).data('routestopfare_id');
                    var stu_id = $(this).data('stu_id');
                    var routename = $(this).attr('route');
                     $.ajax({
                        method: "GET",
                        url: routename,
                        data: {routestopfare_id: routestopfare_id, stu_id: stu_id},
                        dataType: 'json',
                        success: function () {
                            swal({
                                title: "Generated!",
                                text: "Invoice has been Generated.",
                                type: "success",
                            }).then((success_result) => {
                                $('#datatable-buttons').DataTable().draw(false);
                            });
                        },
                        error: function (jqXhr) {
                            swalError(jqXhr);
                        }
                    });
                }
            });
        });

        // $('body').on('click', '.btn-assign', function(){
        //     $this = $(this);
        //     swal({
        //         text: $this.data('title'),
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: "Yes, assign it!",
        //         confirmButtonColor: "#DD6B55",
        //     }).then((result) => {
        //         if (result.value) {
        //             $.ajax({
        //                 method: 'GET',
        //                 url: $this.data('assign-route'),
        //                 success: function () {
        //                     swal({
        //                         title: "Assigned!",
        //                         text: "Your record has been assigned.",
        //                         type: "success",
        //                     }).then((success_result) => {
        //                         if (success_result.value) {
        //                             if(typeof $this.data('redirect') != 'undefined')
        //                             {
        //                                 window.location = $this.data('redirect');
        //                             }
        //                             else
        //                             {
        //                                 $('#datatable-buttons').DataTable().draw(false);
        //                             }
        //                         }

    });
</script>
{!! $dataTable->scripts() !!}

<script>
    $(document).ready(function() {
        $('#datatable-buttons').DataTable();
    });
</script>
@endpush

{{-- @include('layouts.partials.datatable_export_scripts') --}}
