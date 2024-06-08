

<div class="container">
    <div class=" p-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                      
                        <div class="card-body">
                            <div class="form-row">

                               {{ Form::hidden('id', @$model['store']->id, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Name']) }}
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[name]', __('Customer Name').'*') }}
                                    {{ Form::text('store[name]', @$model['store']->name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Name']) }}
                                </div>
                                 <div class="form-group col-md-6">
                                    {{ Form::label('store[name]', __('Mobile Number ').'*') }}
                                    {{ Form::text('store[mobile_number]', @$model['store']->mobile_number, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Mobile Number']) }}
                                </div>
                                  <div class="form-group col-md-6">
                                    {{ Form::label('store[name]', __('Email ').'*') }}
                                    {{ Form::email('store[email]', @$model['store']->email, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Email']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[details]', __('Flat No ').'*') }}
                                    {{ Form::text('store[flat_no]', @$model['store']->flat_no, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Flat No']) }}
                                </div>
                                 <div class="form-group col-md-6">
                                    {{ Form::label('store[area]', __('Area').'*') }}
                                    {{ Form::text('store[area]', @$model['store']->area, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Area']) }}
                                </div>
                                  <div class="form-group col-md-6">
                                    {{ Form::label('store[area]', __('Address ').'*') }}
                                    {{ Form::text('store[address]', @$model['store']->address, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Address']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[area]', __('City ').'*') }}
                                    {{ Form::text('store[city]', @$model['store']->city, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'City']) }}
                                </div>
                                 <div class="form-group col-md-6">
                                    {{ Form::label('store[area]', __('State ').'*') }}
                                    {{ Form::text('store[state]', @$model['store']->state, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'State']) }}
                                </div>
                                 <div class="form-group col-md-6">
                                    {{ Form::label('store[landmark]', __('Landmark').'*') }}
                                    {{ Form::text('store[landmark]', @$model['store']->landmark, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Landmark ']) }}
                                </div>
                                  <div class="form-group col-md-6">
                                    {{ Form::label('store[landmark]', __('Status').'*') }}
                                     {{ Form::select('store[status]', [1=>"Active",0=>"In-Active"] ,@$model['store']->status, ['class' => 'form-control check  select2-wos', 'placeholder'=>'Select Status']) }}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{ route('admin.customers.index') }}" class="btn btn-danger">
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
<!-- @include('layouts.partials.cropImageScript') -->
@push('stylesheets')
<style>
    .modal-body {
        margin-top: -38px !important;
    }
    .hidden{
        display:none;
    }
    .m-2{
        margin-top:1rem !important;
    }
     
</style>

@push('scripts')
<script>
    $(function(){
    
    // $('.check'),trigger('change'); //change to two ? how?
    
    $('.check').change(function(){
      let status=['In Active Partner',"In Active Partner","Hold","Waiting for Approval"]
      var data= $(this).find("option:selected").text();
      if(status.includes(data)){
        $("#reason").removeClass("hidden");
          $("#reason").value("");
        
      } else {
         $("#reason").addClass("hidden");
          $("#reason").value("");

      }
      console.log(data,"data");
      

   //  var data =  $("#check :selected").text();

      //alert(data);            
    });
});
</script>

@endpush


