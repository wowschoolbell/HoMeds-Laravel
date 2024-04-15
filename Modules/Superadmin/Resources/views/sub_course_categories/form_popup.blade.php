<div class="modal-header">
    <h5 class="modal-title" id="slideRightModalLabel">{{ $title }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    {{ Form::open(['route' => [$routename, $id], 'class' => 'popup_form', 'enctype' => "multipart/form-data", 'method' => $method]) }}
    <div class="form-group">
        {{ Form::label('category_id', __('Category').'*') }}
        {{ Form::select('category_id', @$course_categories, @$category_id, ['class' => "form-control amhl-select2-ws", 'disabled' => true, 'autocomplete' => 'off', 'placeholder' => '-- Choose Course Category --']) }}
        {{ Form::hidden('category_id', @$category_id, ['class' => "form-control",'autocomplete' => 'off']) }}

    </div>
    <div class="form-group">
        {{ Form::label('name', __('Name').'*') }}
        {{ Form::select('name', $sub_categories, @$name, ['class' => "form-control",'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('thumbnail', __('Thumbnail').'*') }}
        <div class="col-sm-9">
            <input name="thumbnail" type="file" accept="image/*" class="dropify" data-show-remove="false" data-default-file="{{ @$thumbnail }}">
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    {{ Form::close() }}
</div>