<div class="container">
    <div class=" p-t-20">
        <div class="col-md-12">
        </div>
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-3 m-b-20">
                <div class="card">
                    <div class="card-header bg-soft-dark">
                        <h5 class="m-b-0">{{ __('Profile') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group col-md-15 text-center avatar-profile d-block">
                            <label class="avatar-input m-t-20">
                                <span class="avatar avatar-xxl" title="Click and Upload Photo">
                                    <img src="{{(@$model['delivery_partner']->photo) }}"
                                            alt="profile image" class="avatar-img rounded-circle">
                                    <span class="avatar-input-icon rounded-circle">
                                        <i class="mdi mdi-upload mdi-24px"></i>
                                    </span>
                                </span>
                                <input type="file" class="avatar-file-picker" id="upload" name="delivery_partner[photo]">
                            </label>
                        </div>
                        <div class="profile d-none text-center">
                            <div id="upload-profile"></div>
                            <a href="#" class="btn btn-success upload-result-done" title="Done"><i class="mdi mdi-check"></i></a>
                            <a href="#" class="btn btn-danger upload-result-cancel" title="Cancel"><i class="mdi mdi-close"></i></a>
                        </div>
                        {{ Form::hidden('delivery_partner[cropImage]',null,['class' => "cropImage"])}}
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
                                <div class="form-group col-md-4">
                                    {{ Form::label('delivery_partner[first_name]', __('First Name').'*') }}
                                    {{ Form::text('delivery_partner[first_name]', old('delivery_partner[first_name]'), ['class' => "form-control"]) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('delivery_partner[middle_name]', __('Middle Name')) }}
                                    {{ Form::text('delivery_partner[middle_name]', old('delivery_partner[middle_name]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('delivery_partner[last_name]', __('Last Name').'*') }}
                                    {{ Form::text('delivery_partner[last_name]', old('delivery_partner[last_name]'), ['class' => "form-control" ]) }}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    {{ Form::label('user[email]', __('Email').'*') }}
                                    {{ Form::text('user[email]', old('user[email]'), ['class' => "form-control"]) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('delivery_partner[phone]', __('Phone').'*') }}
                                    {{ Form::text('delivery_partner[phone]', old('delivery_partner[phone]'), ['class' => "form-control isnumeric" ]) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('delivery_partner[app_statuses_id]', __('Status').'*') }}
                                    {{ Form::select('delivery_partner[app_statuses_id]', $statuses, old('delivery_partner[app_statuses_id]'), ['class' => 'form-control  select2-wos', 'placeholder'=>'Select Status']) }}
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
                                    {{ Form::label('delivery_partner[aadhar]', __('Aadhar Number').'*') }}
                                    {{ Form::text('delivery_partner[aadhar]', old('delivery_partner[aadhar]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <span>Aadhar Document *</span>
                                    {{ Form::file("delivery_partner[aadhar_image]",['class' => 'custom-file-input','id' => 'inputGroupFile02']) }}
                                    <label for="inputGroupFile02" class="custom-file-label" style="margin-top: 5%;">Choose File</label>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[driving_licence]', __('Driving Licence Number').'*') }}
                                    {{ Form::text('delivery_partner[driving_licence]', old('delivery_partner[driving_licence]'), ['class' => "form-control uppercase" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <span>Driving Licence Document *</span>
                                    {{ Form::file("delivery_partner[driving_licence_image]",['class' => 'custom-file-input','id' => 'inputGroupFile02']) }}
                                    <label for="inputGroupFile02" class="custom-file-label" style="margin-top: 5%;">Choose File</label>
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
                                    {{ Form::label('delivery_partner[bank_name]', __('Bank Name')) }}
                                    {{ Form::text('delivery_partner[bank_name]', old('delivery_partner[bank_name]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('delivery_partner[ifsc]', __('IFSC')) }}
                                    {{ Form::text('delivery_partner[ifsc]', old('delivery_partner[ifsc]'), ['class' => "form-control uppercase" ]) }}
                                </div>
                                <div class="form-group col-md-4">
                                    {{ Form::label('delivery_partner[bank_account_number]', __('Account Number').'*') }}
                                    {{ Form::text('delivery_partner[bank_account_number]', old('delivery_partner[bank_account_number]'), ['class' => "form-control is_numeric" ]) }}
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
                                    {{ Form::label('delivery_partner[area]', __('Area')) }}
                                    {{ Form::text('delivery_partner[area]', old('delivery_partner[area]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[city]', __('City')) }}
                                    {{ Form::text('delivery_partner[city]', old('delivery_partner[city]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[state]', __('State')) }}
                                    {{ Form::text('delivery_partner[state]', old('delivery_partner[state]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[pincode]', __('Pincode')) }}
                                    {{ Form::text('delivery_partner[pincode]', old('delivery_partner[pincode]'), ['class' => "form-control is_numeric" ]) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-soft-dark">
                            <h5 class="m-b-0">{{ __('Delivery Location') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[area_mapping_area]', __('Area')) }}
                                    {{ Form::text('delivery_partner[area_mapping_area]', old('delivery_partner[area_mapping_area]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[area_mapping_city]', __('City')) }}
                                    {{ Form::text('delivery_partner[area_mapping_city]', old('delivery_partner[area_mapping_city]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[area_mapping_state]', __('State')) }}
                                    {{ Form::text('delivery_partner[area_mapping_state]', old('delivery_partner[area_mapping_state]'), ['class' => "form-control" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[area_mapping_pincode]', __('Pincode')) }}
                                    {{ Form::text('delivery_partner[area_mapping_pincode]', old('delivery_partner[area_mapping_pincode]'), ['class' => "form-control is_numeric" ]) }}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{ route('admin.delivery_partner.index') }}" class="btn btn-danger">
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

