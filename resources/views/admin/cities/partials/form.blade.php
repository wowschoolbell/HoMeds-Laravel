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
                {{ Form::hidden('id', @$model['cities']->id, ['class' => "form-control", 'autocomplete' => 'off']) }}
                
                <div class="form-group col-md-12">
                    <label for="inputEmail4">Area *</label>
                    {{ Form::text('cities[area]', old('cities[area]'), ['class' => "form-control", 'autocomplete' => 'off', 'required'=>true, 'placeholder' => 'Area Name']) }}
                </div>
                <div class="form-group col-md-12">
                    <label for="inputEmail4">City *</label>
                    {{ Form::text('cities[city]', old('cities[city]'), ['class' => "form-control", 'autocomplete' => 'off', 'required'=>true, 'placeholder' => 'City Name']) }}
                </div>
                <div class="form-group col-md-12">
                    <label for="inputEmail4">State *</label>
                    {{ Form::select('cities[state_id]', $states, old('cities[city]'), ['class' => 'form-control  select2-wos', 'required'=>true, 'placeholder'=>'Select State']) }}
                </div>
                <div class="form-group col-md-12">
                    <label for="inputEmail4">Pincode *</label>
                    {{ Form::text('cities[pincode]', old('cities[pincode]'), ['class' => "form-control", 'autocomplete' => 'off', 'required'=>true, 'placeholder' => 'Pincode']) }}
                </div>
            </div>
            <div class="form-group text-right">
                <button class="btn btn-primary">{{ @$model['cities']->id ? 'Update' : 'Create'}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        {{ Form::close() }}
    </div>
</div>