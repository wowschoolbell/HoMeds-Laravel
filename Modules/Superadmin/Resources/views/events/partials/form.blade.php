<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('title', __('Title').'*') }}
        {{ Form::text('title', @$title, ['class' => "form-control"]) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('category_id', __('Category').'*') }}
        {{ Form::select('category_id', @$categories, @$category_id, ['class' => 'form-control', 'placeholder'=>'Select Event Category']) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('recommended_course', __('Recommended Course').'*') }}
        {{ Form::select('recommended_course', @$courses, @$recommended_course, ['class' => 'form-control', 'placeholder'=>'Select Course']) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('start_date', __('Start Date').'*') }}
        {{ Form::text('start_date', @$start_date, ['class' => "form-control input-daterange-timepicker"]) }}
    </div>
</div>
<div class="form-group border border-dark">
    <span class="badge badge-dark m-t-5 m-l-5">Benifit - ONE</span><br><br>
    <table class="table table-bordered" id="si-table">
        <thead>
            <th>Title</th>
            <th>Sub Title</th>
            <th>Description</th>
        </thead>
        <tbody>
            <td>
                {{ Form::text('benefits_one[title]', @$benefits_one['title'], ['class' => "form-control"]) }}
            </td>
            <td>
                {{ Form::text('benefits_one[subtitle]', @$benefits_one['subtitle'], ['class' => "form-control"]) }}
            </td>
            <td>
                {{ Form::text('benefits_one[description]', @$benefits_one['description'], ['class' => "form-control"]) }}
            </td>
        </tbody>
    </table>
</div>

<div class="form-group border border-dark">
    <span class="badge badge-dark m-t-5 m-l-5">Benifit - TWO</span><br><br>
    <table class="table table-bordered" id="si-table">
        <thead>
            <th>Title</th>
            <th>Sub Title</th>
        </thead>
        <tbody>
            <td>
                {{ Form::text('benefits_two[title]', @$benefits_two['title'], ['class' => "form-control"]) }}
            </td>
            <td>
                {{ Form::text('benefits_two[description]', @$benefits_two['description'], ['class' => "form-control"]) }}
            </td>
        </tbody>
    </table>
</div>

<div class="form-group border border-dark">
    <span class="badge badge-dark m-t-5 m-l-5">Speaker</span><br><br>
    <table class="table table-bordered" id="si-table">
        <thead>
            <th>Name</th>
            <th>Description</th>
            <th>Linked In Link</th>
        </thead>
        <tbody>
            <td>
                {{ Form::text('speaker[name]', @$speaker['name'], ['class' => "form-control"]) }}
            </td>
            <td>
                {{ Form::text('speaker[description]', @$speaker['description'], ['class' => "form-control"]) }}
            </td>
            <td>
                {{ Form::text('speaker[linked_in_link]', @$speaker['linked_in_link'], ['class' => "form-control"]) }}
            </td>
        </tbody>
    </table>
</div>

<div class="form-group border border-dark">
    <span class="badge badge-dark m-t-5 m-l-5">Web Link</span><br><br>
    <table class="table table-bordered" id="si-table">
        <thead>
            <th>Name</th>
            <th>Link</th>
        </thead>
        <tbody>
            <td>
                {{ Form::text('weblink[name]', @$weblink['name'], ['class' => "form-control"]) }}
            </td>
            <td>
                {{ Form::text('weblink[link]', @$weblink['link'], ['class' => "form-control"]) }}
            </td>
        </tbody>
    </table>
</div>

<div class="form-group">
    {{ Form::label('event_details', __('Event Details').'*') }}
    {{ Form::textarea('event_details', @$event_details, ['class' => "form-control","rows" => '3']) }}
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('image', __('Image').'*') }}
        <input name="image" type="file" accept="image/*" class="dropify" data-show-remove="false" data-default-file="{{ @$image }}">
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('address', __('Address').'*') }}
        {{ Form::textarea('address', @$address, ['class' => "form-control"]) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        {{ Form::label('venue', __('Venue').'*') }}
        {{ Form::text('venue', @$venue, ['class' => "form-control"]) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('location', __('Location').'*') }}
        {{ Form::select('location', @$locations, @$location, ['class' => 'form-control location']) }}
    </div>
    <div class="form-group col-md-6 location-address">
        {{ Form::label('location_address', __('Location Address').'*') }}
        {{ Form::text('location_address', @$location_address, ['class' => "form-control"]) }}
    </div>
</div>
<div class="form-row location-details">
    <div class="form-group col-md-6">
        {{ Form::label('location_type', __('Location Type').'*') }}
        {{ Form::select('location_type', @$location_types, @$location_type, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('location_link', __('Location Link').'*') }}
        {{ Form::text('location_link', @$location_link, ['class' => "form-control"]) }}
    </div>
</div>


<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ __('Save') }}
    </button>
    <a class="btn btn-secondary" href="{{ route("sa.events.index") }}">Cancel</a>
</div>

@push('stylesheets')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css"/>
@endpush
@include('layouts.partials.dropify_scripts')
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            var location = $('.location').val();
            locationChange(location);
            $('.input-daterange-timepicker').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                locale: {format: 'DD-MM-Y hh:ss A'}
            });
        });

        $(document).on("change", ".location", function (event) {
            locationChange($(this).val());
        });

        function locationChange(location) {
            if (location == 'Physical') {
                $('.location-details').hide();
                $('.location-address').show();
            } else if (location == 'Online') {
                $('.location-details').show();
                $('.location-address').hide();
            }
        }
    </script>
@endpush
