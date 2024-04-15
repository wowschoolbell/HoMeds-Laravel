@php
    $route = \Request::route()->getName();
    $eventCreateAction = Modules\Core\Entities\Permission::disableLabel('events.create');
    $eventEditAction = Modules\Core\Entities\Permission::disableLabel('events.edit');
@endphp

{{-- EventCalendarScript File used for
        Admin -> calendar panel in dashboard
              -> Crud operations
        TP    -> calendar panel in dashboard
  --}}

<script src="{{ asset('theme/light/vendor/blockui/jquery.blockUI.js') }}"></script>
<script src="{{ asset('theme/light/vendor/blockui/blockui-data.js') }}"></script>
<script src="{{ asset('theme/light/vendor/jquery.touchpunch/touchpunch.min.js') }}"></script>
<script src="{{ asset('theme/light/vendor/fullcalender/fullcalendar.min.js') }}"></script>

<script type="text/javascript">

    var eventCreateAction   = "{!! @$eventCreateAction !!}";
    var eventEditAction     = "{!! @$eventEditAction !!}";
    var route               = "{!! @$route !!}";

    var firstLoad = true;
    !function ($) {
        var CalendarApp = function () {
            this.$body = $("body")
            this.$calendar = $('#calendar'),
                this.$event = ('#calendar-events div.calendar-events'),
                this.$categoryForm = $('#add-new-event form'),
                this.$extEvents = $('#calendar-events'),
                this.$modal = $('#my-event'),
                this.$saveCategoryBtn = $('.save-category'),
                this.$calendarObj = null
        };

        $('body').on('change', '.filter-button', function () {
            firstLoad = false;
            $('#calendar').fullCalendar('refetchEvents');
        });

        /* Initializing */
        CalendarApp.prototype.init = function () {
            /*  Initialize the calendar  */
            var $this = this;
            $this.$calendarObj = $this.$calendar.fullCalendar({

                themeSystem: 'bootstrap4',
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                bootstrapFontAwesome: {
                    close: ' mdi mdi-close',
                    prev: ' mdi mdi-arrow-left',
                    next: ' mdi mdi-arrow-right',
                    prevYear: ' mdi mdi-chevron-double-left',
                    nextYear: ' mdi mdi-chevron-double-right'
                },
                buttonText: {
                    today: 'today',
                    month: 'month',
                    week: 'week',
                    day: 'day'
                },
                dayRender: function (date, cell) {

                    var today = new Date();
                    if(today.getMonth() > date.get('month')){
                        cell.css("background-color", "#f5f5f5");
                    }
                },

                events: function (start, end, timezone, callback) {

                    $.ajax({
                        method: 'GET',
                        url: "{{ $eventRoute }}",
                        data: {
                            // our hypothetical feed requires UNIX timestamps
                            start: start.unix(),
                            end: end.unix(),
                            et_id: $('.eventtype').val(),
                            // filters: filterValue,
                        },
                        success: function (data) {
                            callback(data);
                        },
                        error: function (jqXhr) {
                            swalError(jqXhr);
                        }
                    });
                },
                dayClick: function(date, jsEvent, view ,calEvent ) {
                    var today = new Date().toISOString().slice(0,10);
                    var dateOne = new Date(date).toISOString().slice(0,10);
                    if(route != 'home' && route != "tp.teacherportal.index"){
                        if (today <= dateOne) {
                            if(eventCreateAction != 'disabled'){
                                window.location =  "/event/events/create?date="+date.unix();
                            }
                            // var url =  "/event/events/create?date="+date.unix();
                            // $.get(url, function (data) {
                            //     $("#addModal").html(data).modal();
                            //     datetimepickercall();
                            //     departments_batches();
                            // });
                        }
                    }
                },

                eventClick: function(event, jsEvent, view,date) {
                    // var current_date = new Date();
                    // var edit = current_date <  new Date(event.start.add(1, 'days')) ? "/edit":"";
                    // var url =  "/event/events/"+event.id+edit;
                    if(route != 'home' && route != "tp.teacherportal.index"){
                        var current_date = new Date().toISOString().slice(0,10);
                        if(current_date <  new Date(event.start).toISOString().slice(0,10))
                        {
                            if(eventEditAction != 'disabled'){
                                window.location = "/event/events/"+event.id+"/edit";
                            }
                        }else{
                                window.location = "/event/events/"+event.id;
                            // $.get("/event/events/"+event.id, function (data) {
                            //     $("#addModal").html(data).modal();
                            //     datetimepickercall();
                            //     departments_batches();
                            // });
                        }
                    }
                },
            });

            addButtons();

            function addButtons() {
                // create buttons

                var switchToIndex = route == 'home' || route == "tp.teacherportal.index" ? "" : '<div class="col"><a href="{{ route("events.index") }}" class="btn btn-md btn-danger float-right h-90">Switch To List View</a></div>' ;

                var colorDots = $("<div/>")
                .addClass("fc-button-agendaDay custombg")
                .append('<div class="ml-auto fixedhead row text-center p-b-24"><div class="col">{{ Form::select("eventtype", $eventtypes, @request()->et_id, ["class" => "form-control filter-button eventtype select2-ws", "placeholder"=>"Select event type"]) }}</div>\n\
                    '+switchToIndex+' </div>');

                var toolbar = $("<div/>")
                    .addClass("fc-toolbar")
                    .addClass("fc-header-toolbar")
                    .addClass("customPadding")
                    .append(
                        $("<div/>")
                            .addClass("fc-center")
                            .append(colorDots)
                    );
                toolbar.append($("<div/>", {"class": "fc-clear"}));

                $(".fc-header-toolbar").after(toolbar);
                select2_with_search();
            }
        },
        //init CalendarApp
        $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp

    }(window.jQuery),
        //initializing CalendarApp
        function ($) {
            "use strict";
            $.CalendarApp.init()
    }(window.jQuery);

    function departments_batches()
    {
        $('.eventfor').on("change", function () {
            var eventfor = $(this).val();
            if (eventfor == "B") {
                $("#departmentlist").hide();
                $("#batcheslist").show();
            } else if (eventfor == "D") {
                $("#departmentlist").show();
                $("#batcheslist").hide();
            } else {
                $("#departmentlist").hide();
                $("#batcheslist").hide();
            }
        });

        $('.multipledepartments').multiselect({
            nonSelectedText: 'Select Departments',
        });

        $('.multiplebatches').multiselect({
            nonSelectedText: 'Select Batches',
            enableClickableOptGroups: true,
            maxHeight: 350,
        });
    }
</script>
@push('stylesheets')
<style>
    h2{
        font-size: 1.4rem;
        text-transform: uppercase;
    }
    .fc-event{
        font-size:1em;
        line-height:1.3;
    }
    .select2-container--default .select2-selection__rendered{
        width:250px;
    }
</style>
@endpush
