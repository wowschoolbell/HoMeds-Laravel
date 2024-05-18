<div class="container">
    <div class=" p-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 m-b-20">
                    <div class="card">
                        <div class="card-header bg-soft-dark">
                            <h5 class="m-b-0">{{ __('Store Logo') }}</h5>
                        </div>
                        <div class="card-body m-b-70">
                            <div class="form-group col-md-15 text-center avatar-profile d-block">
                                <label class="avatar-input m-t-20">
                                    <span class="avatar avatar-xxl" title="Click and Upload Photo">
                                        <img src="{{(@$model['store']->store_logo) }}"
                                                alt="Store Logo" class="avatar-img rounded-circle">
                                        <span class="avatar-input-icon rounded-circle">
                                            <i class="mdi mdi-upload mdi-24px"></i>
                                        </span>
                                    </span>
                                    <input type="file" class="avatar-file-picker" id="upload" name="store[store_logo]">
                                </label>
                            </div>
                            <div class="profile d-none text-center">
                                <div id="upload-profile"></div>
                                <a href="#" class="btn btn-success upload-result-done" title="Done"><i class="mdi mdi-check"></i></a>
                                <a href="#" class="btn btn-danger upload-result-cancel" title="Cancel"><i class="mdi mdi-close"></i></a>
                            </div>
                            {{ Form::hidden('store[cropImage]',null,['class' => "cropImage"])}}
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <div class="card m-b-30">
                        <div class="card-header bg-soft-dark">
                            <h5 class="m-b-0">{{ __('Personal Informations') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[store_name]', __('Store Name').'*') }}
                                    {{ Form::text('store[name]', @$model['store']->name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Store Name']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[Contact Person Name]', __('Contact Person Name')) }}
                                    {{ Form::text('store[contact_person_name]', @$model['store']->contact_person_name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Contact Name']) }}
                                </div>
                            </div>
                            <div class="form-row">
                                    <div class="form-group col-md-4">
                                    {{ Form::label('user[phone]', __('Phone number').'*') }}
                                    {{ Form::number('user[phone]', @$model['user']->phone, ['class' => "form-control","id"=>"phone_number", 'autocomplete' => 'off', 'placeholder' => 'phone', "pattern"=>"[0-9]{4}[0-9]{4-10}"]) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('user[email]', __('Email').'*') }}
                                    {{ Form::email('user[email]', @$model['user']->email, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Email']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('store[mobile_number]', __('Mobile Number').'*') }}
                                    {{ Form::number('store[mobile_number]', @$model['store']->mobile_number, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Mobile Number']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('store[status_id]', __('Status').'*') }}
                                    {{ Form::select('store[status_id]', $statuses ,@$model['store']->status, ['class' => 'form-control  select2-wos', 'placeholder'=>'Select Status']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('store[app_status_id]', __('App status').'*') }}
                                    {{ Form::select('store[app_status_id]', $app_statuses, @$model['store']->app_status_id, ['class' => 'form-control  select2-wos', 'placeholder'=>'Select Status']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <span>Store Image *</span>
                                    {{ Form::file("store[store_image]",['class' => 'custom-file-input','id' => 'inputGroupFile02']) }}
                                    <label for="inputGroupFile02" class="custom-file-label" style="margin-top: 10%;">Choose File</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-soft-dark">
                            <h5 class="m-b-0">{{ __('Document Proof') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[gst_number]', __('GST Number').'*') }}
                                    {{ Form::text('store[gst_number]', @$model['store']->gst_number, ['class' => "form-control uppercase", 'autocomplete' => 'off', 'placeholder' => 'GST Number']) }}
                                </div>
                                <div class="form-group col-md-6">
                                        {{ Form::label('store[drug_licence]', __('Drug Licence').'*') }}
                                    {{ Form::text('store[drug_licence]', @$model['store']->drug_licence, ['class' => "form-control uppercase", 'autocomplete' => 'off', 'placeholder' => 'Drug Licence',"maxlength"=>"12"]) }}
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-soft-dark">
                            <h5 class="m-b-0">{{ __('Bank Details') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    {{ Form::label('store[bank_name]', __('Bank Name')) }}
                                    {{ Form::text('store[bank_name]', old('store[bank_name]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('store[ifsc]', __('IFSC')) }}
                                    {{ Form::text('store[ifsc]', old('store[ifsc]'), ['class' => "form-control uppercase" ]) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('store[bank_account_number]', __('Account Number').'*') }}
                                    {{ Form::text('store[bank_account_number]', old('store[bank_account_number]'), ['class' => "form-control is_numeric" ]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-soft-dark">
                            <h5 class="m-b-0">{{ __('Address Details') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[store_location]', __('Store Location')) }}
                                    {{ Form::text('store[location]', @$model['store']->location, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'location']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[longtitude]', __('Longtitude')) }}
                                    {{ Form::text('store[longtitude]', @$model['store']->longtitude, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'longtitude']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[latitude]', __('Latitude')) }}
                                        {{ Form::text('store[latitude]', @$model['store']->latitude, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'latitude']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[address]', __('Address')) }}
                                    {{ Form::text('store[address]',@$model['store']->address, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'address']) }}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[area]', __('Area')) }}
                                    {{ Form::text('store[area]', old('store[area]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[city]', __('City')) }}
                                    {{ Form::text('store[city]', old('store[city]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[state]', __('State')) }}
                                    {{ Form::text('store[state]', old('store[state]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[pincode]', __('Pincode')) }}
                                    {{ Form::text('store[pincode]', old('store[pincode]'), ['class' => "form-control is_numeric" ]) }}
                                </div>
                            </div>
                                <div class="form-row">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{ route('admin.store.index') }}" class="btn btn-danger">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- @include('layouts.partials.cropImageScript') -->
@push('stylesheets')
<style>
    .modal-body {
        margin-top: -38px !important;
    }
</style>


