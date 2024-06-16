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
                {{ Form::hidden('id', @$model['category']->id, ['class' => "form-control", 'autocomplete' => 'off']) }}
                
                <div class="form-group col-md-12">
                    <label for="inputEmail4">Category Name *</label>
                    {{ Form::text('cities[name]',@$model['category']->name, ['class' => "form-control", 'autocomplete' => 'off', 'required'=>true, 'placeholder' => 'Area Name']) }}
                </div>
               
                
            </div>
            <div class="form-group text-right">
                <button class="btn btn-primary">{{ @$model['category']->id ? 'Update' : 'Create'}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        {{ Form::close() }}
    </div>
</div>