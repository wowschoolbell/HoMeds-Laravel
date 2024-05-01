@extends('layouts.master')
@section('title', '')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@section('content')

<? $view =isset($_GET['view'])?true:false;


?>


<div class="bg-dark">
    <div class="container-fluid  m-b-30">
        <div class="row">
            <div class="col-md-8 text-white p-t-40 p-b-90">
                <h4 class="">
                    <span class="btn btn-white-translucent">
                    <i class="mdi mdi-apps"></i></span> {{$view?"View Store":"Add Store"}}
                </h4>
            </div>
            <div class="col-md-4 text-right p-t-40 p-b-90">
               
                <a href={{ URL::previous() }} class="btn btn-md btn-primary btn-add-category" ><i class="mdi mdi-back"></i>Back</a>
               
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pull-up">
    <div class="row">
        <div class="col-12">
            <div class="card">
                @if($view)
                <div class="card-body">
                     <div class="table-responsive p-t-30">
                         <div class="form-row">
                             <div class="col-md-6 text-">
                                 Name :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->name}}
                             </div>
                             <div class="col-md-6">
                                 Contact Person Name :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->contact_person_name}}
                             </div>
                             <div class="col-md-6">
                                 Phone Number :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->phone_number}}
                             </div>
                             <div class="col-md-6">
                                 Mobile :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->mobile_number}}
                             </div>
                             <div class="col-md-6">
                                 Email :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->email}}
                             </div>
                              <div class="col-md-6">
                                 Gst Number :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->gst_number}}
                             </div>
                             <div class="col-md-6">
                                Drug Licence :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->drug_licence}}
                             </div>
                             <div class="col-md-6">
                                Store Location :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->location}}
                             </div>
                             <div class="col-md-6">
                                Address :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->address}}
                             </div>
                             
                              <div class="col-md-6">
                                Area :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->area}}
                             </div>
                             <div class="col-md-6">
                                City :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->city}}
                             </div>
                              <div class="col-md-6">
                                State :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->state}}
                             </div>
                              <div class="col-md-6">
                                Pin Code :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->pincode}}
                             </div>
                             <div class="col-md-6">
                               Store Logo :
                             </div>
                             <div class="col-md-6">
                                 
                                 <img src={{$model['category']->store_logo}} width="60px" height="60px" alt="store Image"/>
                             </div>
                             <div class="col-md-6">
                                Store Image :
                             </div>
                             <div class="col-md-6">
                                 <img src={{$model['category']->store_image}} width="60px" height="60px" alt="store Image"/>
                             </div>
                             <div class="col-md-6">
                                Bank Name :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->bank_name}}
                             </div>
                             <div class="col-md-6">
                                Bank Account Number :
                             </div>
                             <div class="col-md-6">
                                {{$model['category']->bank_account_number}}
                             </div>
                             <div class="col-md-6">
                                IFSC Code :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->ifsc_code}}
                             </div>
                             <div class="col-md-6">
                                App Status 
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->app_status}}
                             </div>
                             <div class="col-md-6">
                                status :
                             </div>
                             <div class="col-md-6">
                                 {{$model['category']->status}}
                             </div>
                             
                          </div>
                     </div>
                    
                </div>
                
                @else
                
                {{ Form::model($model, ['route' => [$route, @$routeIds], 'class' => 'ajax_form', 'method' => $method, 'files' => true]) }}
                 {{ Form::hidden('id', @$model['category']->id, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Category Name']) }}
                <div class="container">
                    <div class=" p-t-20">
                    <!--<div class="col-md-12">-->
                    <!--</div>-->
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
                                                <img src="{{(@$model['category']->store_logo) }}"
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
                          <div class="col-md-3 m-b-20">
                            <div class="card">
                                <div class="card-header bg-soft-dark">
                                    <h5 class="m-b-0">{{ __('Store image ') }}</h5>
                                </div>
                                <div class="card-body m-b-70">
                                    <div class="form-group col-md-15 text-center avatar-profile d-block">
                                        <label class="avatar-input m-t-20">
                                            <span class="avatar avatar-xxl" title="Click and Upload Photo">
                                                <img src="{{(@$model['category']->store_image) }}"
                                                        alt="Store image" class="avatar-img rounded-circle">
                                                <span class="avatar-input-icon rounded-circle">
                                                    <i class="mdi mdi-upload mdi-24px"></i>
                                                </span>
                                            </span>
                                            <input type="file" class="avatar-file-picker" id="upload" name="store[store_image]">
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
                            <div class="col-md-6">
                                <div class="card m-b-30">
                                    <div class="card-header bg-soft-dark">
                                        <h5 class="m-b-0">{{ __('Personal Informations') }}</h5>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                {{ Form::label('delivery_partner[first_name]', __('First Name').'*') }}
                                                {{ Form::text('store[name]', @$model['category']->name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Store Name','required'=>"true"]) }}
                                            </div>
                                            <div class="form-group col-md-4">
                                                {{ Form::label('delivery_partner[Contact Person Name]', __('Contact Person Name')) }}
                                                {{ Form::text('store[contact_person_name]', @$model['category']->contact_person_name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Contact Name','required'=>"true"]) }}
                                            </div>
                                            <div class="form-group col-md-4">
                                                {{ Form::label('delivery_partner[phone_number]', __('Phone number').'*') }}
                                               {{ Form::number('store[phone]', @$model['category']->phone, ['class' => "form-control","id"=>"phone_number", 'autocomplete' => 'off', 'placeholder' => 'phone','required'=>"true","pattern"=>"[0-9]{4}[0-9]{4-10}"]) }}
                                            </div>
                                        </div>
            
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                {{ Form::label('user[email]', __('Email').'*') }}
                                               {{ Form::email('store[email]', @$model['category']->email, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Email','required'=>"true"]) }}
                                            </div>
                                            <div class="form-group col-md-4">
                                                {{ Form::label('delivery_partner[mobile_number]', __('Mobile Number').'*') }}
                                             {{ Form::number('store[mobile_number]', @$model['category']->mobile_number, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Mobile Number','required'=>"true"]) }}
                                            </div>
                                            <div class="form-group col-md-4">
                                                {{ Form::label('delivery_partner[app_statuses_id]', __('Status').'*') }}
                                                {{ Form::select('store[status]', $statuses,@$model['category']->status, ['class' => 'form-control  select2-wos', 'placeholder'=>'Select Status']) }}
                                            </div>
                                             <div class="form-group col-md-4">
                                                {{ Form::label('delivery_partner[status]', __('App status').'*') }}
                                                {{ Form::select('store[app_status]', ["HoMeds"=>"HoMeds","White_Label"=>"White Label"], @$model['category']->app_status, ['class' => 'form-control  select2-wos', 'placeholder'=>'Select Status']) }}
                                            </div>
                                                                                        <div class="form-group col-md-4"  style="{{ @$model['category']->id ? 'display: none' : '' }}">
                                                {{ Form::label('delivery_partner[password]', __('Password').'*') }}
                                              {{ Form::number('store[password]', @$model['category']->password, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Password','required'=>"true"]) }}
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
                                                {{ Form::label('delivery_partner[gst_number]', __('GST Number').'*') }}
                                                {{ Form::text('store[gst_number]', @$model['category']->gst_number, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'GST Number','required'=>"true","pattern"=>"[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}"]) }}
                                            </div>
                                            <div class="form-group col-md-6">
                                                 {{ Form::label('delivery_partner[drug_licence]', __('Drug Licence').'*') }}
                                                {{ Form::text('store[drug_licence]', @$model['category']->drug_licence, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Drug Licence','required'=>"true","maxlength"=>"12"]) }}
                                                
                                            </div>
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
                                                {{ Form::label('delivery_partner[store_location]', __('Store Location')) }}
                                                {{ Form::text('store[location]', @$model['category']->location, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'location']) }}
                                            </div>
                                            <div class="form-group col-md-6">
                                                {{ Form::label('delivery_partner[longtitude]', __('Longtitude')) }}
                                                {{ Form::text('store[longtitude]', @$model['category']->longtitude, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'longtitude','required'=>"true"]) }}
                                            </div>
                                            <div class="form-group col-md-6">
                                                {{ Form::label('delivery_partner[latitude]', __('Latitude')) }}
                                                 {{ Form::text('store[latitude]', @$model['category']->latitude, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'latitude','required'=>"true"]) }}
                                            </div>
                                            <div class="form-group col-md-6">
                                               {{ Form::label('delivery_partner[address]', __('Address')) }}
                                                {{ Form::text('store[address]',@$model['category']->address, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'address','required'=>"true"]) }}
                                            </div>
                                        </div>
                                        
                                            

                                        
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
                {{ Form::close() }}
                @endif
            </div>
        </div>
    </div>
</div>

@endsection


@include('layouts.partials.ajax_save_scripts')

@push('scripts')
<script src="{{ asset('theme/light/vendor/blockui/jquery.blockUI.js') }}"></script>
<script src="{{ asset('theme/light/js/blockui-data.js') }}"></script>
    <script type="text/javascript">
        $(".statusmodel").on('shown.bs.modal', function (event) {
            event.preventDefault();
            var data    = event.currentTarget.dataset;
            var Url =   $(event.relatedTarget).data('route');

            $.ajax({
                method: 'GET',
                url: Url,
                beforeSend: function () {
                    $(".modal-dialog #pop-up-modal").block({});
                },
                success: function (data) {
                    $(".statusmodel .modal-content").html(data);
                },
                error: function (jqXhr) {
                    var response = JSON.parse(jqXHR.responseText);
                }
            });
        });
    </script>
<script type="text/javascript">

$(document).ready(function () {
        $("#phone_number").intlTelInput({
            preferredCountries: ["us", "ca"],
            separateDialCode: true,
            initialCountry: ""
        }).on('countrychange', function (e, countryData) {
            $("#code").val(($("#phone_number").intlTelInput("getSelectedCountryData").dialCode));

        });
        
        


    });
    
    $(function(){
    $("#phone_number").mask("999 - 9999999999999");
});

</script>
@endpush

