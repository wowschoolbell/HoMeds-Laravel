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
                                <div class="form-group col-md-4">
                                    {{ Form::label('delivery_partner[gender]', __('Gender').'*') }}
                                    {{ Form::select('delivery_partner[gender]', $gender, old('delivery_partner[gender]'), ['class' => 'form-control  select2-wos', 'placeholder'=>'Select Gender']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-soft-dark">
                            <h5 class="m-b-0">{{ __('Aadhar Proof') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[aadhar]', __('Aadhar Number').'*') }}
                                    {{ Form::number('delivery_partner[aadhar]', old('delivery_partner[aadhar]'), ['class' => "form-control" ]) }}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <span>Aadhar Front Side Document *</span>
                                    {{ Form::file("delivery_partner[aadhar_front_image]",['class' => 'custom-file-input','id' => 'inputGroupFile02']) }}
                                    <label for="inputGroupFile02" class="custom-file-label" style="margin-top: 5%;">Choose File</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <span>Aadhar back Side Document *</span>
                                    {{ Form::file("delivery_partner[aadhar_back_image]",['class' => 'custom-file-input','id' => 'inputGroupFile03']) }}
                                    <label for="inputGroupFile03" class="custom-file-label" style="margin-top: 5%;">Choose File</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-soft-dark">
                            <h5 class="m-b-0">{{ __('Driving Licence Proof') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[driving_licence]', __('Driving Licence Number').'*') }}
                                    {{ Form::text('delivery_partner[driving_licence]', old('delivery_partner[driving_licence]'), ['class' => "uppercase form-control" ]) }}
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <span>Driving Licence Front Side Document *</span>
                                    {{ Form::file("delivery_partner[driving_licence_front_image]",['class' => 'custom-file-input','id' => 'inputGroupFile04']) }}
                                    <label for="inputGroupFile04" class="custom-file-label" style="margin-top: 5%;">Choose File</label>
                                </div>
                                <div class="form-group col-md-6">
                                    <span>Driving Licence back Side Document *</span>
                                    {{ Form::file("delivery_partner[driving_licence_back_image]",['class' => 'custom-file-input','id' => 'inputGroupFile05']) }}
                                    <label for="inputGroupFile05" class="custom-file-label" style="margin-top: 5%;">Choose File</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card m-b-30">
                        <div class="card-header bg-soft-dark">
                            <h5 class="m-b-0">{{ __('PAN Card Proof') }}</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('delivery_partner[pan]', __('PAN Number').'*') }}
                                    {{ Form::text('delivery_partner[pan]', old('delivery_partner[pan]'), ['class' => "form-control uppercase" ]) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <span>PAN Card Document *</span>
                                    {{ Form::file("delivery_partner[pan_image]",['class' => 'custom-file-input','id' => 'inputGroupFile06']) }}
                                    <label for="inputGroupFile06" class="custom-file-label" style="margin-top: 5%;">Choose File</label>
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
                                    {{ Form::label('delivery_partner[bank_acc_number]', __('Account Number').'*') }}
                                    {{ Form::number('delivery_partner[bank_acc_number]', old('delivery_partner[bank_account_number]'), ['class' => "form-control" ]) }}
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
                            <div class="form-group col-md-12">
                                {{ Form::label('delivery_partner[area]', __('Address')) }}
                                {{ Form::text('delivery_partner[address]', old('delivery_partner[address]'), ['class' => "form-control"]) }}
                            </div>
                            <div class="form-row can-append-address-fetch">
                                <div class="form-group input-group col-md-6" style="margin-top: 34px;">
                                    {{ Form::text('delivery_partner[pincode]', @$city->pincode, ['class' => "form-control isnumeric", 'id' => 'address-pincode', 'placeholder' => 'Pincode']) }}
                                    <div class="input-group-append">
                                    <button class="btn btn-sm btn-danger btn-delete" id="remove-address-pincode" type="button" title="Delete" ><i class="mdi mdi-trash-can-outline"></i></button>
                                    </div>
                                </div>

                                @if(@$city)
                                <div class="form-group col-md-6 can-hide">
                                    {{ Form::label('delivery_partner[area]', __('Area')) }}
                                    {{ Form::text('delivery_partner[area]', $city->area, ['class' => "form-control", 'disabled' => 'true']) }}
                                    {{ Form::text('city_id', $city->id, ['class' => "form-control", 'hidden' => 'true']) }}
                                </div>
                                <div class="form-group col-md-6 can-hide">
                                    {{ Form::label('delivery_partner[city]', __('City')) }}
                                    {{ Form::text('delivery_partner[city]', $city->city, ['class' => "form-control", 'disabled' => 'true' ]) }}
                                </div>
                                <div class="form-group col-md-6 can-hide">
                                    {{ Form::label('delivery_partner[state]', __('State')) }}
                                    {{ Form::text('delivery_partner[state]', $city->state->name, ['class' => "form-control", 'disabled' => 'true' ]) }}
                                </div>
                                @endif

                            </div>
                            <div class="fetch-address-details">
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
                            <span> Pilot Selected Area </span>
                            <div class="table-responsive">
                                <table class="table table-hover align-td-middle">
                                    <thead>
                                    <tr>
                                        <th>Area</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Pincode</th>
                                        <th>Action</th>
                                    </tr>
                                        @if (@$model['delivery_partner']->drop_city_id)
                                            <?php $i = 0; 
                                            $cities = json_decode($model['delivery_partner']->drop_city_id)
                                            ?>
                                            @foreach($cities as $city_id)
                                            <?php
                                                $city = \App\Models\City::find($city_id);
                                            ?>
                                            <tr class="<?php echo "drop-address-row-".$city->id ?>">
                                                <td>{{ $city->area }}</td>
                                                <td>{{ $city->city }}</td>
                                                <td>{{ $city->state->name }}</td>
                                                <td>{{ $city->pincode }}</td>
                                                <td>
                                                    {{ Form::text("delivery_partner[drop_city_id][$i]", $city->id, ['class' => "form-control drop-city-id", 'hidden' => 'true']) }}
                                                    <button class="btn btn-sm btn-danger remove-drop-address" type="button" title="Delete" ><i class="mdi mdi-trash-can-outline"></i></button>
                                                </td>
                                            </tr>
                                            <?php ++$i ?>
                                            @endforeach
                                        @endif
                                    </thead>
                                    <tbody class="fetch-append-address-details"></tbody>
                                </table>
                            </div>
                            
                            <div class="form-row can-append-drop-address-fetch">
                                <div class="form-group input-group col-md-6">
                                    {{ Form::text('pincode', '', ['class' => "form-control isnumeric", 'id' => 'drop-address-pincode', 'placeholder' => 'Pincode']) }}
                                    <div class="input-group-append">
                                    <button class="btn btn-sm btn-danger btn-delete" id="remove-address-pincode" type="button" title="Delete" ><i class="mdi mdi-trash-can-outline"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="fetch-drop-address-details"></div>
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
@include('layouts.partials.cropImageScript')

@push('stylesheets')
<style>
    .modal-body {
        margin-top: -38px !important;
    }
</style>
@endpush
