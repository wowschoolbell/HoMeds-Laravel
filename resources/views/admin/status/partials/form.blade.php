

<div class="container">
    <div class=" p-t-20">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card m-b-30">
                      
                        <div class="card-body">
                            <div class="form-row">

                               {{ Form::hidden('id', @$model['store']->id, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Name']) }}
                                 <div class="form-group col-md-4">
                                    {{ Form::label('store[app_status_id]', __('Plan').'*') }}
                                    {{ Form::select('store[plan_id]', $app_statuses, @$model['store']->plan_id, ['class' => 'form-control  select2-wos', 'placeholder'=>'Select Status']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[name]', __('Name').'*') }}
                                    {{ Form::text('store[name]', @$model['store']->name, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Name']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('store[details]', __('Details').'*') }}
                                    {{ Form::textarea('store[description]', @$model['store']->description, ['class' => "form-control", 'autocomplete' => 'off', 'placeholder' => 'Details']) }}
                                </div>
                                 <div class="form-group col-md-6">
                                    {{ Form::label('store[plan_type]', __('Plan Type').'*') }}
                                     {{ Form::select('store[plan_type]', ["Month"=>"month","Yearly"=>"year"], @$model['store']->plan_type, ['class' => 'form-control  select2-wos', 'placeholder'=>'Select Plan Type']) }}
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


