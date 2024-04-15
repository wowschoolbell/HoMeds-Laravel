@push('scripts')
    <a href="javascript:void(0)" class="export_all_csv hide">Export to Excel</a>
    <a href="javascript:void(0)" class="export_all_pdf hide">Export to PDF</a>
    {{-- nee to check --}}
    {{-- <script src="{{ asset('theme/light/vendor/jquery-ui/jquery-ui.min.js') }}"   ></script> --}}
    <link rel="stylesheet" href="{{ asset('theme/light/vendor/jquery-ui/jquery-ui.min.css') }}">

    <div class="modal fade" id="export_progress_modal" tabindex="-1" role="dialog" aria-labelledby="export_progress_modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>--}}
                    <h4 class="modal-title" id="myModalLabel">Export</h4>
                </div>
                <div class="modal-body">
                    <div class="export_progress-label">Starting...</div>
                    <div id="export_progressbar"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger btn-sm" type="button" id="export_cancel_send">Cancel Export</button>
                    <form method="GET" action="" id="download_form">
                        <input name="filename" type="hidden"/>
                        <input name="export" type="hidden"/>
                    </form>
                    {{--<a href="javascript:void(0)" download class="hide" id="filename">download</a>--}}
                </div>
            </div>
        </div>
    </div>
@endpush
