<div id="units-render">
    <div class="modal-header">
        <h5 class="modal-title" id="slideRightModalLabel"> Add App Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        {{ Form::model($model, ['route' => ['admin.app_status.create'], 'class' => 'ajax_form', 'method' => 'put']) }}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        {{ Form::close() }}
    </div>
</div>