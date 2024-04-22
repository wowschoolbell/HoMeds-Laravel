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
                {{ Form::hidden('id', @$model['store']->id, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Category Name']) }}
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Name *</label>
                    {{ Form::text('store[name]', old('store[name]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Store Name']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Contact Name *</label>
                    {{ Form::text('store[contact_person_name]', old('store[contact_person_name]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Contact Name']) }}
                </div>
                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Phone *</label>
                    {{ Form::text('store[phone]', old('store[phone]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'phone']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Mobile Number *</label>
                    {{ Form::text('store[mobile_number]', old('store[mobile_number]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Mobile Number']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Email *</label>
                    {{ Form::text('store[email]', old('store[email]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'email Number']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">GST Number *</label>
                    {{ Form::text('store[gst_number]', old('store[gst_number]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'GST Number']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Drug Licence *</label>
                    {{ Form::text('store[drug_licence]', old('store[drug_licence]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Drug Licence']) }}
                </div>
                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Address *</label>
                    {{ Form::text('store[address]', old('store[address]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'address']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Area *</label>
                    {{ Form::text('store[area]', old('store[area]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Area']) }}
                </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">State *</label>
                    {{ Form::text('store[state]', old('store[state]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'State']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">City *</label>
                    {{ Form::text('store[city]', old('store[city]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'City']) }}
                </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Pincode *</label>
                    {{ Form::text('store[pincode]', old('store[pincode]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Pincode']) }}
                </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Store Image *</label>
                    {{ Form::file('store[store_image]', old('store[store_image]'), ['class' => "form-control", 'autocomplete' => 'off' ]) }}
                </div>
                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Store Logo *</label>
                    {{ Form::file('store[store_logo]', old('store[store_logo]'), ['class' => "form-control", 'autocomplete' => 'off' ]) }}
                </div>
                
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Bank Name *</label>
                    {{ Form::text('store[bank_name]', old('store[bank_name]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Bank Name']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Bank Acc Number *</label>
                    {{ Form::text('store[bank_account_number]', old('store[bank_account_number]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Bank Account Number']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">IFSC Code *</label>
                    {{ Form::text('store[ifsc_code]', old('store[ifsc_code]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'IFSC Code']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">App Status *</label>
                    {{ Form::select('store[app_status]', old('store[app_status]',["HoMeds","White Label"]), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'App Status']) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Status *</label>
                    {{ Form::select('store[status]', old('store[status]',['Active','In-active','Hold','Waiting for Approval']), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Status']) }}
                </div>
                
            </div>
            <div class="form-group text-right">
                <button class="btn btn-primary">{{ @$model['store']->id ? 'Update' : 'Create'}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        {{ Form::close() }}
    </div>
</div>