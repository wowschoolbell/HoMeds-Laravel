<div class="modal-header">
    <h5 class="modal-title" id="slideRightModalLabel">{{ $title }}</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="modal-body">
    {{ Form::open(['route' => [$routename, $id], 'class' => 'popup_form', 'method' => $method]) }}
    <div class="form-group">
        {{ Form::label('name', __('Name').'*') }}
        {{ Form::text('name', @$name, ['class' => "form-control",'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>
    {{ Form::close() }}
</div>
