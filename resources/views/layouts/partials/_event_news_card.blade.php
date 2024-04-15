<div class="form-group col-md-8">
    @include('partials._event_card')
</div>
<div class="form-group col-md-4">
    @include('partials._news_card')
</div>
@push('stylesheets')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/light/vendor/fullcalender/fullcalendar.min.css') }}">
<style>
    .pre-scrollable{
        max-height: 100%;
    }
    .event-card{
        height: 100%;
        padding: .75rem 1.25rem;
    }
    .news-card{
        height: 340px;
    }
</style>
@endpush

@push('scripts')
@include('layouts.partials.eventCalendarScript')
@endpush
