<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('Name', __('Name').'*') }}
        {{ Form::text('name', @$name, ['class' => "form-control"]) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('course_id', __('Course Suggestions').'*') }}
        {{ Form::select('course_id', @$courses, @$course_id, ['class' => 'form-control', 'placeholder'=>'Select Course']) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::label('about', __('About').'*') }}
        {{ Form::textarea('about', @$about, ['class' => "form-control", "rows" => '4']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('related_courses', __('Related Videos').'*') }}
        {{ Form::select('related_courses[]', @$courses, @$related_courses, ["multiple data-live-search" =>"true", 'class' => 'form-control multiple-select']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('related_podcasts', __('Related Podcasts').'*') }}
        {{ Form::select('related_podcasts[]', @$courses, @$related_podcasts, ["multiple data-live-search" =>"true", 'class' => 'form-control multiple-select']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('intro_video', __('Intro Video').'*') }}
        {{ Form::select('intro_video', @$courses, @$intro_video, ['class' => 'form-control']) }}
    </div>
</div>
<div class="form-group">
    <div class="card m-b-30">
        <div class="card-header bg-soft-dark">
            <div class="form-row align-center">
                <div class="form-group card-title col-md-6">
                    <i class="mdi mdi-file-upload"></i> {{ __('Announcements') }}
                </div>
                <div class="form-group col-md-6 m-b-0">
                    <button type="button" class="btn btn-sm btn-info float-right" id="announcement-detail"><i class="mdi mdi-plus"></i> Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-row">
                @php $amV = 0 @endphp
                <table class="table table-striped" >
                    <tr>
                        <th>Date *</th>
                        <th>File *</th>
                    </tr>
                    @foreach($announcements as $announcement)
                        <tr>
                            <td>{{ Form::text("announcements[$amV][date]", @$announcement['question'], ['class' => "form-control input-daterange-timepicker"]) }}</td>
                            <td>
                                {{ Form::hidden("announcements[$amV][image]", @$announcement['image'], ['class' => "form-control"]) }}
                                <input name="announcements[{{$amV}}][image]" type="file" accept="image/*" class="" data-show-remove="false" data-default-file="{{ @$image }}">
                            </td>
                        </tr>
                        @php ++$amV @endphp
                    @endforeach
                    <tbody class="announcement-detail-division">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="card m-b-30">
        <div class="card-header bg-soft-dark">
            <div class="form-row align-center">
                <div class="form-group card-title col-md-6">
                    <i class="mdi mdi-file-upload"></i> {{ __('FAQ') }}
                </div>
                <div class="form-group col-md-6 m-b-0">
                    <button type="button" class="btn btn-sm btn-info float-right" id="faq-detail"><i class="mdi mdi-plus"></i> Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-row">
                @php $j=0 @endphp
                <table class="table table-striped" >
                    <tr>
                        <th>Question *</th>
                        <th>Answer *</th>
                    </tr>
                    @foreach($faqs as $faq)
                        <tr>
                            <td>{{ Form::text("faq[$j][question]", @$faq['question'], ['class' => "form-control",'id' => "inputGroupFile02"]) }}</td>
                            <td>{{ Form::text("faq[$j][answer]", @$faq['answer'], ['class' => "form-control",'id' => "inputGroupFile03"]) }}</td>
                        </tr>
                        @php ++$j @endphp
                    @endforeach
                    <tbody class="faq-detail-division">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="card m-b-30">
        <div class="card-header bg-soft-dark">
            <div class="form-row align-center">
                <div class="form-group card-title col-md-6">
                    <i class="mdi mdi-file-upload"></i> {{ __('Resources') }}
                </div>
                <div class="form-group col-md-6 m-b-0">
                    <button type="button" class="btn btn-sm btn-info float-right" id="resource-detail"><i class="mdi mdi-plus"></i> Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-row">
                @php $resourceKey=0 @endphp
                <table class="table table-striped" >
                    <tr>
                        <th>Name *</th>
                        <th>Url *</th>
                    </tr>
                    @foreach($resources as $resource)
                        <tr>
                            <td>{{ Form::text("resources[$resourceKey][name]", @$resource['name'], ['class' => "form-control"]) }}</td>
                            <td>{{ Form::text("resources[$resourceKey][url]", @$resource['url'], ['class' => "form-control"]) }}</td>
                            
                        </tr>
                        @php ++$resourceKey @endphp
                    @endforeach
                    <tbody class="resource-detail-division">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="form-group m-t-20">
    <button type="submit" class="btn btn-primary">
        {{ __('Save') }}
    </button>
    <a class="btn btn-secondary" href="{{ route("sa.petals.index") }}">Cancel</a>
</div>
@include('layouts.partials.dropify_scripts')
@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="{{ asset('js/jquery.tmpl.js') }}"></script>
    <script id="faqDetailTemplate" type="text/x-jquery-tmpl">
        <tr>
             <td> {!! Form::text('faq[${faqKey}][question]',' ', ['class' => 'form-control fileName']) !!}</td>
             <td> {!! Form::text('faq[${faqKey}][answer]',' ', ['class' => 'form-control link']) !!}</td>
            
            <td> <button class="btn btn-sm btn-danger row-delete" type="button" id="row-delete" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button></td>
        </tr>
    </script>
    <script id="announcementDetailTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td> {!! Form::text('announcements[${announcementKey}][date]','', ['class' => "form-control input-daterange-timepicker"]) !!}</td>
            <td> <input name="announcements[${announcementKey}][image]" type="file" accept="image/*" class="dropify" data-show-remove="false" data-default-file="{{ @$image }}"></td>
           
           <td> <button class="btn btn-sm btn-danger row-delete" type="button" id="row-delete" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button></td>
       </tr>
    </script>
    <script id="resourceDetailTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td> {!! Form::text('resources[${resKey}][name]',' ', ['class' => 'form-control']) !!}</td>
            <td> {!! Form::text('resources[${resKey}][url]',' ', ['class' => 'form-control']) !!}</td>
           
           <td> <button class="btn btn-sm btn-danger row-delete" type="button" id="row-delete" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button></td>
       </tr>
    </script>
    <script type="text/javascript">
        $('.multiple-select').selectpicker();
        $(document).ready(function () {
            $('.input-daterange-timepicker').daterangepicker({
                timePicker: true,
                singleDatePicker: true,
                locale: {format: 'DD-MM-Y hh:ss A'}
            });
        });
        
        $(document).ready(function () {
            var faqKey= {{ $j + 1 }};
            $('#faq-detail').click(function () {
                var validation = 0;
                $(`tbody tr`).each(function(){
                    let $tr = $(this).closest('tr');
                });
                var formfields = [{
                    faqKey: faqKey++
                    }];
                $("#faqDetailTemplate").tmpl(formfields).appendTo(".faq-detail-division");
            });
        });
        
        $(document).ready(function () {
            var announcementKey= {{ $amV + 1 }};
            $('#announcement-detail').click(function () {
                var validation = 0;
                $(`tbody tr`).each(function(){
                    let $tr = $(this).closest('tr');
                });
                var formfields = [{
                    announcementKey: announcementKey++
                    }];
                $("#announcementDetailTemplate").tmpl(formfields).appendTo(".announcement-detail-division");
                $('.input-daterange-timepicker').daterangepicker({
                    timePicker: true,
                    singleDatePicker: true,
                    locale: {format: 'DD-MM-Y hh:ss A'}
                });
            });
        });
        $(document).ready(function () {
            var resKey= {{ $resourceKey + 1 }};
            $('#resource-detail').click(function () {
                var validation = 0;
                $(`tbody tr`).each(function(){
                    let $tr = $(this).closest('tr');
                });
                var formfields = [{
                    resKey: resKey++
                    }];
                $("#resourceDetailTemplate").tmpl(formfields).appendTo(".resource-detail-division");
            });
        });
        
        $(document).on("change", "#course-category", function (event) {
            var value = $(this).val();
            var url = "{{ route('sa.sub_course_category.course_category') }}?category_id="+value;
            $('#sub-course-category').html('');

            if(value)
            {
                $.ajax({
                    url: url,
                    type: "GET",
                    dataType: "json",
                    success:function(data){
                        $('#sub-course-category').empty();
                        $.each(data, function(key, value)
                        {
                            $('#sub-course-category').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }
            else{
                $('#sub-course-category').empty();
            }
        });

    </script>
@endpush
@push('scripts')
<script type="text/javascript">
    //Add Particular
    var add_particular	= function(){
        var ptrow = parseInt($("#fee-particulars .fee-particular").last().data('row')) + 1;
        $.ajax({
            url: "{{ route('sa.courses.addparticular') }}",
            type:'GET',
            data:{ ptrow:ptrow },
            dataType: "json",
            success: function(response){
                if(response.success){
                    var data = $(response.html);
                    $("#fee-particulars").append(data);

                    //scroll to new particular
                    $('html,body').animate({
                        scrollTop: data.offset().top
                    }, 'fast');

                    setup_actions();
                } else {
                    swal("Can't add particular");
                }
            }
        });
    }

    //Add Particular Access
    var add_access = function(that){
        var ptrow = parseInt($(that).data('row'));
        var acrow = parseInt($("#particular-accesses-" + ptrow + " .particular-access").last().data("row")) + 1;
        $.ajax({
            url: "{{ route('sa.courses.addaccess') }}",
            type: "GET",
            dataType: "json",
            data:{ ptrow:ptrow, acrow:acrow },
            success: function(response){
                if(response.success){
                    var data = $(response.html);
                    $("#particular-accesses-" + ptrow).append(data);

                    //scroll to new particular
                    $('html,body').animate({
                        scrollTop: data.offset().top
                    }, 'fast');
                    setup_actions();
                }
                else {
				    swal("Can't add access");
			    }
            }
        });

    }

    //Remove Particular
    var remove_particular = function(that){
        var particular = "";
        var particularElem = $(that).closest('.fee-particular').find('input.particular-name[type="text"]');
        if(particularElem.length > 0 && particularElem.val()!=""){
            particular = "`" + particularElem.val() + "`";
        }
        $(that).closest('.fee-particular').remove();
    }

    //Remove Access
    var remove_access = function(that){
        var row = parseInt($(that).data('row'));
        $(that).closest('.particular-access').remove();
    }

    var setup_actions = function(){
        //remove link for all particular
        $(".remove-particular").unbind('click').click(function(e) {
            var that = this;
            $(this).tooltip('hide');
            remove_particular(that);
        });

        //add access
        $(".add-particular-access").unbind('click').click(function(e) {
            var that = this;
            var validation = 0;

        $(`tbody tr`).each(function(){
            let $tr = $(this).closest('tr');

            if ( $tr.find(`.batchId`).val() == 0 ||  $tr.find(`.amount`).val() == 0)
            {
                validation = 1
                return false;
            }
        });

        if(validation == 1) {
            swal("Empty Row", "Some fields are empty", "warning");
        } else {
            add_access(that);
        }
        });

        //remove access
        $(".remove-access").unbind('click').click(function(e) {
            var that = this;
            $(this).tooltip('hide');
            remove_access(that);
        });

        $('.multiplebatches').multiselect({
            nonSelectedText: 'Select Batches',
            buttonWidth: '100%',
            enableClickableOptGroups: true,
            buttonClass: 'btn btn-light',
            maxHeight: 350,
        });
    }

    $('#add-fee-particular').click(function(e) {
        var validation = 0;

        $(`tbody tr`).each(function(){
            let $tr = $(this).closest('tr');

            if ( $tr.find(`.particular-name`).val() == 0 || $tr.find(`.batchId`).val() == 0 ||  $tr.find(`.amount`).val() == 0)
            {
                validation = 1
                return false;
            }
        });

        if(validation == 1) {
            swal("Empty Row", "Some fields are empty", "warning");
        } else {
            add_particular();
        }
    });

    setup_actions();
    //END

    $(document).ready(function () {

        $("body").on('submit', '.fee_form', function (e) {
            e.preventDefault();
            var formEl = $(this);
            var submitButton = formEl.find(':submit');
            var submitHtml = submitButton.html();

            $.ajax({
                method: formEl.attr('method'),
                url: formEl.attr('action'),
                data: formEl.serialize(),
                beforeSend: function () {
                    submitButton.prop('disabled', 'disabled').html('Please wait...');
                },
                complete: function () {
                    submitButton.prop('disabled', false).html(submitHtml);
                },
                success: function (data) {
                    swal({
                        title: data.title,
                        text: data.message,
                        buttons: true,
                    })
                    .then((success_result) => {
                        if (success_result.value) {
                            if(typeof data.redirect != 'undefined')
                            {
                                window.location = data.redirect;
                            }
                            else
                            {
                                location.reload();
                            }
                        }
                    });
                },
                error: function (data) {
                    var errors = '';
                    for(datos in data.responseJSON['message']){
                        errors += data.responseJSON['message'][datos] + '<br>';
                    }
                    swal("Validation Error", errors, "error");
                }
            });

        });
    });
</script>
@endpush
