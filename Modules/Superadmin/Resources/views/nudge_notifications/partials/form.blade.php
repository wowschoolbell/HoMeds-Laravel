<div id="category-render">
    <div class="modal-header">
        <h5 class="modal-title" id="slideRightModalLabel"> {{ $title }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        {{ Form::open(['route' => [$route, @$routeIds], 'class' => 'popup_form', 'method' => $method, 'files' => true]) }}
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputEmail4">Content *</label>
                    {{ Form::textarea('content', @$content, ['class' => "form-control", 'autocomplete' => 'off']) }}
                </div>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-primary">{{ @$routeIds ? 'Update' : 'Create'}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        {{ Form::close() }}
    </div>
</div>
