<script type="text/javascript">
    var holidays = {!! json_encode(@$leave_days) !!};
    $(document).ready(function () {
        datepickercall();
        datetimepickercall();
        aydatepickercall();
        eventaydatepickercall();
        monthpicker();
        aymonthpicker();
        timepick();
        daterangepicker();
        timepickwithoutmeridiem();
        smsyearpicker();
    });

    function smsyearpicker()
    {
        $('.sms-yearpicker').datepicker({
         minViewMode: 2,
         format: 'yyyy',
         autoclose: true, todayHighlight: true,
       });
    }

    function datepickercall()
    {
        $('.sms-datepicker').datepicker({
            format: '{{ config('app.date_format_js') }}',
            autoclose: true,
            todayHighlight: true,
        });
    }

    function datetimepickercall()
    {
        $('.input-daterange-timepicker').daterangepicker({
            timePicker: true,
            singleDatePicker: true,
            locale: {format: '{{ config('app.date_time_format_js') }}'}
        });
    }

    // sms-ay-datepicker - enable the current academic year dates
    function aydatepickercall()
    {
        $('.sms-ay-datepicker').datepicker({
            format: '{{ config('app.date_format_js') }}',
            autoclose: true,
            todayHighlight: true,
            startDate: '{{ @$ay_starts_on }}',
            endDate: '{{ @$ay_ends_on }}',
        });
    }

    // sms-eay-datepicker - enable the current academic year dates & disable event's dates
    function eventaydatepickercall()
    {
        $('.sms-eay-datepicker').datepicker({
            format: '{{ config('app.date_format_js') }}',
            autoclose: true,
            todayHighlight: true,
            startDate: '{{ @$ay_starts_on }}',
            endDate: '{{ @$ay_ends_on }}',
            datesDisabled: holidays,
        });
    }

    function monthpicker()
    {
        $(".monthpicker").datepicker({
            format: '{{ config('app.month_format_js') }}',
            startDate: '{{ @$ay_month_starts_on }}',
            endDate: '+0m',
            viewMode: "months",
            minViewMode: "months",
            autoclose: true,

        })
    }
    function aymonthpicker()
    {
        $(".aymonthpicker").datepicker({
            format: '{{ config('app.month_format_js') }}',
            startDate: '{{ @$ay_month_starts_on }}',
            endDate: '{{ @$ay_month_ends_on }}',
            viewMode: "months",
            minViewMode: "months",
            autoclose: true,

        })
    }

    function timepick(){
        $('.timepicker').timepicker({
            showInputs: false,
            minuteStep: 5,
        });
    }

    function daterangepicker()
    {
        $('.daterange').daterangepicker({
            autoUpdateInput: false,
            opens: 'center',
            locale: {
                cancelLabel: 'Clear'
            }
        });
        $('.daterange').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
        });
        $('.daterange').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    }

    $('#start').datepicker({
        format: '{{ config('app.date_format_js') }}',
        autoclose: true, todayHighlight: true,
        startDate: '{{ @$ay_starts_on }}',
        endDate: '{{ @$ay_ends_on }}',
        datesDisabled: holidays,
    }).on('changeDate', function (ev) {
        $('#end').datepicker('setStartDate', $("#start").val());
    });

    $('#end').datepicker({
        format: '{{ config('app.date_format_js') }}',
        autoclose: true, todayHighlight: true,
        startDate: '{{ @$ay_starts_on }}',
        endDate: '{{ @$ay_ends_on }}',
        datesDisabled: holidays,
    }).on('changeDate', function (ev) {
        $('#start').datepicker('setEndDate', $("#end").val());
    });

    function timepickwithoutmeridiem()
    {
        $('.timepickwithoutmeridiem').timepicker({
            showInputs: false,
            minuteStep: 5,
            showMeridian:false
        });
    }
    // tooltip for <span>
        $('main').tooltip({
            selector: '.admin-content span',
            placement: 'top',
            trigger: 'hover',
        });

        // tooltip for <a> tag
        $('body').tooltip({
            selector: '.admin-content a',
            placement: 'top',
            trigger: 'hover',
        });
        // tooltip for <button>
        $('html').tooltip({
            selector: '.admin-content button',
            placement: 'top',
            trigger: 'hover',
        });
</script>
