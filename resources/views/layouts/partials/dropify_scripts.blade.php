@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/light/css/dropify.min.css') }}">
@endpush

@push('scriptsrc')
<script src="{{ asset('theme/light/js/dropify.min.js') }}"></script>
@endpush

@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.dropify').dropify();

        $("body").on("click", '.dropify-clear', function() {
            $(this).closest('.row').find('.dropify-file-value').val(null);
        });
    });
</script>
@endpush
