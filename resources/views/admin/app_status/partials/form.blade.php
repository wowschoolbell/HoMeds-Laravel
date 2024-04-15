<div id="category-render">
    <div class="modal-header">
        <h5 class="modal-title" id="slideRightModalLabel"> {{ $title }} </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        {{ Form::model($model, ['route' => [$route, @$routeIds], 'class' => 'ajax_form', 'method' => $method, 'files' => true]) }}
            <div class="form-row">
                {{ Form::hidden('id', @$model['app_status']->id, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Category Name']) }}
                <div class="form-group col-md-12">
                    <label for="inputEmail4">Name *</label>
                    {{ Form::text('app_status[name]', old('app_status[name]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Category Name']) }}
                </div>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-primary">{{ @$model['app_status']->id ? 'Update' : 'Create'}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        {{ Form::close() }}
    </div>
</div>