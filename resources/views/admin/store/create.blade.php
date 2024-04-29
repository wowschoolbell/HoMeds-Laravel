
<? $view =isset($_GET['view'])?true:false;


?>

@extends('layouts.master')
@section('title', $view?"View Store":"Add Store")

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.13/js/intlTelInput-jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@section('content')




<div class="bg-dark">
    <div class="container-fluid  m-b-30">
        <div class="row">
            <div class="col-md-8 text-white p-t-40 p-b-90">
                <!--<h4 class="">-->
                    <!--<span class="btn btn-white-translucent">-->
                <!--    <i class="mdi mdi-apps"></i></span> {{$view?"View Store":"Add Store"}}-->
                <!--</h4>-->
            </div>
            <div class="col-md-4 text-right p-t-40 p-b-90">
               
                <a href={{ URL::previous() }} class="btn btn-md btn-primary btn-add-category" ><i class="mdi mdi-back"></i>Back</a>
               
            </div>
        </div>
    </div>
</div>

<div class="container-fluid pull-up">
    <div class="row">
         @if($view)
         @else
        
        @endif
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
                <div class="card-body">
                    <div class="table-responsive p-t-10">
                     {{ Form::model($model, ['route' => [$route, @$routeIds], 'class' => 'ajax_form', 'method' => $method, 'files' => true]) }}
                 <div class="form-row">
                        {{ Form::hidden('id', @$model['category']->id, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Category Name']) }}
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Name *</label>
                    {{ Form::text('store[name]', @$model['category']->name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Store Name','required'=>"true"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Contact Name *</label>
                    {{ Form::text('store[contact_person_name]', @$model['category']->contact_person_name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Contact Name','required'=>"true"]) }}
                </div>
                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Phone *</label>
                    
                      
                    {{ Form::number('store[phone]', @$model['category']->phone, ['class' => "form-control","id"=>"phone_number", 'autocomplete' => 'off', 'placeholder' => 'phone','required'=>"true","pattern"=>"[0-9]{4}[0-9]{4-10}"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Mobile Number *</label>
                    {{ Form::number('store[mobile_number]', @$model['category']->mobile_number, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Mobile Number','required'=>"true"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Email *</label>
                    {{ Form::email('store[email]', @$model['category']->email, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Email','required'=>"true"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">GST Number *</label>
                    {{ Form::text('store[gst_number]', @$model['category']->gst_number, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'GST Number','required'=>"true","pattern"=>"[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Drug Licence *</label>
                    {{ Form::text('store[drug_licence]', @$model['category']->drug_licence, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Drug Licence','required'=>"true","maxlength"=>"12"]) }}
                </div>
                <!--<div class="form-group col-md-4">-->
                <!--    <label for="inputEmail4">Password *</label>-->
                <!--    {{ Form::text('store[password]', old('store[password]'), ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'password','required'=>"true"]) }}-->
                <!--</div>-->
                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Store Location</label>
                    {{ Form::text('store[location]', @$model['category']->location, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'location']) }}
                </div>
                <div class="form-group col-md-4">
                    
                    
                    <label for="inputEmail4">longtitude *</label>
                    {{ Form::text('store[longtitude]', @$model['category']->longtitude, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'longtitude','required'=>"true"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">latitude *</label>
                    {{ Form::text('store[latitude]', @$model['category']->latitude, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'latitude','required'=>"true"]) }}
                </div>
                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Address *</label>
                    {{ Form::text('store[address]',@$model['category']->address, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'address','required'=>"true"]) }}
                </div>
                
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Area *</label>
                    {{ Form::text('store[area]',@$model['category']->area, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Area','required'=>"true"]) }}
                </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">State *</label>
                    {{ Form::text('store[state]', @$model['category']->state, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'State','required'=>"true"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">City *</label>
                    {{ Form::text('store[city]',@$model['category']->city, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'City','required'=>"true"]) }}
                </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Pincode *</label>
                    {{ Form::text('store[pincode]', @$model['category']->pincode, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Pincode','required'=>"true"]) }}
                </div>
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Store Image *</label>
                    {{ Form::file('store[store_image]', old('store[store_image]'), ['class' => "form-control", 'autocomplete' => 'off','required'=>"true" ]) }}
                </div>
                 <div class="form-group col-md-4">
                    <label for="inputEmail4">Store Logo *</label>
                    {{ Form::file('store[store_logo]', old('store[store_logo]'), ['class' => "form-control", 'autocomplete' => 'off','required'=>"true" ]) }}
                </div>
                
                  <div class="form-group col-md-4">
                    <label for="inputEmail4">Bank Name *</label>
                    {{ Form::text('store[bank_name]', @$model['category']->bank_name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Bank Name','required'=>"true"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Bank Acc Number *</label>
                    {{ Form::text('store[bank_account_number]', @$model['category']->bank_account_number, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Bank Account Number','required'=>"true"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">IFSC Code *</label>
                    {{ Form::text('store[ifsc_code]', @$model['category']->ifsc_code, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'IFSC Code','required'=>"true"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">App Status *</label>
                    {{ Form::select('store[app_status]', old(@$model['category']->app_status?$model['category']->app_status:"",["HoMeds"=>"HoMeds","White Label"=>"White_Label"]), ['class' => "form-control",'required'=>"true"]) }}
                </div>
                <div class="form-group col-md-4">
                    <label for="inputEmail4">Status *</label>
                    
                    
                {{ Form::select('store[status]', old(@$model['category']->status?@$model['category']->status:"",['active'=>'Active','in-active'=>'In-active','hold'=>'Hold','waiting_for_approval'=>'Waiting For Approval']), ['class' => "form-control",'required'=>"true"]) }}
                     
                   
                </div>
                
                
            </div>
            <div class="form-group text-right">
                <button class="btn btn-primary">{{ @$model['store']->id ? 'Update' : 'Create'}}</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        {{ Form::close() }}
                    </div>
                </div>
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

