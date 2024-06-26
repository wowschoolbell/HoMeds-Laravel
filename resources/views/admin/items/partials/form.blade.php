


<?php

$numbers="";
if(@$model['store']->id){

    $array = json_decode($model['store']->cure_disease);

    // Step 2: Convert string numbers to integers or floats
    $numbers = array_map(function($value) {
        return intval($value); // Use floatval() if you need floating-point numbers
    }, $array);
}

?>

<div class="container">
    <div class=" p-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                      
                        <div class="card-body">
                            <div class="form-row">

                               {{ Form::hidden('id', @$model['store']->id, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Name']) }}
                                <!-- <div class="form-group col-md-6">
                                    {{ Form::label('store[Code]', __('Item Code').'*') }}
                                    {{ Form::text('store[item_code]', @$model['store']->item_code, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Item Code']) }}
                                </div> -->
                                 <div class="form-group col-md-6">
                                    {{ Form::label('store[store_item_code]', __('Store Item Code').'*') }}
                                    {{ Form::text('store[store_item_code]', @$model['store']->store_item_code, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Store Item Code']) }}
                                </div>
                                 <div class="form-group col-md-6">
                                    {{ Form::label('store[item_name]', __('Item name ').'*') }}
                                    {{ Form::text('store[name]', @$model['store']->name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Name']) }}
                                </div>
                                  <div class="form-group col-md-6">
                                    {{ Form::label('store[item_category]', __('Item Category ').'*') }}
                                    {{ Form::select('store[category]',$category , @$model['store']->category, ['class' => "form-control select2-wos", 'autocomplete' => 'off']) }}
                                </div>
                               
                                 <div class="form-group col-md-6">
                                    {{ Form::label('store[chemincal_name]', __('Chemincal Name').'*') }}
                                    {{ Form::text('store[chemincal_name]', @$model['store']->chemincal_name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Chemincal Name']) }}
                                </div>
                                  <div class="form-group col-md-6">
                                    {{ Form::label('store[cure_disease]', __('Cure disease ').'*') }}
                                    {{ Form::select('store[cure_disease][]',$disease,$numbers, ['class' => "form-control  select2-wos", 'multiple'=>'multiple','autocomplete' => 'off']) }}
                                </div>

                                  <div class="form-group col-md-6">
                                    {{ Form::label('store[status]', __('Status').'*') }}
                                     {{ Form::select('store[status]', [1=>"Active",0=>"In-Active"] ,@$model['store']->status, ['class' => 'form-control check  select2-wos']) }}
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                    <a href="{{ route('admin.items.index') }}" class="btn btn-danger">
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


