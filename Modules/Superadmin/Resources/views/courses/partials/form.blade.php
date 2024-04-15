<div class="form-row">
    <div class="form-group col-md-4">
        {{ Form::label('title', __('Course Name').'*') }}
        {{ Form::text('title', @$title, ['class' => "form-control"]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('author', __('Author').'*') }}
        {{ Form::text('author', @$author, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('course', __('Course Suggestions').'*') }}
        {{ Form::select('course', @$courses, @$course, ['class' => 'form-control', 'placeholder'=>'Select Course']) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        {{ Form::label('course_id', __('Course Id').'*') }}
        {{ Form::text('course_id',@$course_id, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('category_id', __('Course Category').'*') }}
        {{ Form::select('category_id', @$categories, @$category_id, ['class' => 'form-control', 'id' => 'course-category', 'placeholder'=>'Select Course Category']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('sub_category_id', __('Course Sub Category').'*') }}
        {{ Form::select('sub_category_id', @$subCategories, @$sub_category_id, ['class' => 'form-control', 'id' => 'sub-course-category', 'placeholder'=>'Select Sub Course Category']) }}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        {{ Form::label('video_hours', __('Duration').'*') }}
        {{ Form::text('video_hours', @$video_hours, ['class' => "form-control isnumeric"]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('quizzes', __('Quizzes').'*') }}
        {{ Form::text('quizzes', @$quizzes, ['class' => "form-control isnumeric"]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('assignments', __('Assignments').'*') }}
        {{ Form::text('assignments', @$assignments, ['class' => "form-control isnumeric"]) }}
    </div>
</div>
<table class="table table-striped" >
    <tr>
        <td colspan="2">Using comma to separate the languages , <b>Ex: Firebase, Sql, Sequal Ace </b></td>
    </tr>
    <tr>
        <td>
            <div class="form-group">
                {{ Form::label('language', __('Language').'*') }}
                {{ Form::text('language', @$language, ['class' => "form-control"]) }}
            </div>
        </td>
        <td>
            <div class="form-group">
                {{ Form::label('cc_language', __('CC Language').'*') }}
                {{ Form::text('cc_language', @$cc_language, ['class' => "form-control"]) }}
            </div>
        </td>
    </tr>
</table>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('description', __('Course Description').'*') }}
        {{ Form::textarea('description', @$description, ['class' => "form-control", "rows" => '9']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('image', __('Course Thumbnail').'*') }}
        <input name="image" type="file" accept="image/*" class="dropify" data-show-remove="false" data-default-file="{{ @$image }}">
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('course_items', __('Course Items').'*') }}
        {{ Form::select('course_items', @$selectedCourseItems, @$course_items, ['class' => 'form-control', 'placeholder'=>'Select Course Item']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('tags', __('Course Tag').'*') }}
        {{ Form::text('tags', @$tags, ['class' => "form-control"]) }}
    </div>
</div>
<div class="form-group">
    <div class="card m-b-30">
        <div class="card-header bg-soft-dark">
            <div class="form-row align-center">
                <div class="form-group card-title col-md-6">
                    <i class="mdi mdi-file-upload"></i> {{ __('Benifits Details') }}
                </div>
                <div class="form-group col-md-6 m-b-0">
                    <button type="button" class="btn btn-sm btn-info float-right" id="curriculam-detail"><i class="mdi mdi-plus"></i> Add</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-row">
                @php $i=0 @endphp
                <table class="table table-striped" >
                    <tr>
                        <th>#</th>
                        <th>Action</th>
                    </tr>
                    @if(@$benefits && !empty($benefits && is_array($benefits)))
                        @foreach($benefits as $benifit)
                            <tr>
                                <td>{{ Form::text("benefits[$i][data]", @$benifit['data'], ['class' => "form-control fileName",'id' => "inputGroupFile02"]) }}</td>
                            </tr>
                            @php ++$i @endphp
                        @endforeach
                    @endif
                    <tbody class="curriculam-detail-division">
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
{{-- Fee Particulars --}}
<div class="bg-soft-dark">
    <div class="row">
        <div class="col-md-12">
            <h5 class="fee-custom">Sections</h5>

            {{-- Particulars --}}
            <div id="fee-particulars">
                @foreach ($sections as $ptkey => $section)
                    @include('superadmin::courses.partials.section')
                @endforeach
            </div>
        </div>
    </div>

    <div class="row mb-10">
        <div class="col-md-6">
            <button type="button" id="add-fee-particular" class="btn m-b-20 ml-2 mr-2 btn-warning">
                <i class="mdi mdi-plus mr-1"></i> Add Section
            </button>
        </div>
    </div>
</div>
<div class="form-group m-t-20">
    <button type="submit" class="btn btn-primary">
        {{ __('Save') }}
    </button>
    <a class="btn btn-secondary" href="{{ route("sa.courses.index") }}">Cancel</a>
</div>
@include('layouts.partials.dropify_scripts')
@push('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.tmpl.js') }}"></script>
    <script id="faqDetailTemplate" type="text/x-jquery-tmpl">
        <tr>
             <td> {!! Form::text('faq[${faqKey}][question]',' ', ['class' => 'form-control fileName']) !!}</td>
             <td> {!! Form::text('faq[${faqKey}][answer]',' ', ['class' => 'form-control link']) !!}</td>
            
            <td> <button class="btn btn-sm btn-danger row-delete" type="button" id="row-delete" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button></td>
        </tr>
    </script>
    <script id="curriculamDetailTemplate" type="text/x-jquery-tmpl">
        <tr>
             <td> {!! Form::text('benefits[${curriculamKey}][data]',' ', ['class' => 'form-control fileName']) !!}</td>
            <td> <button class="btn btn-sm btn-danger row-delete" type="button" id="row-delete" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button></td>
        </tr>
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
                var curriculamKey= {{ $i + 1 }};
                $('#curriculam-detail').click(function () {
                    var validation = 0;
                    $(`tbody tr`).each(function(){
                        let $tr = $(this).closest('tr');
                    });
                    var formfields = [{
                        curriculamKey: curriculamKey++
                        }];
                    $("#curriculamDetailTemplate").tmpl(formfields).appendTo(".curriculam-detail-division");
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
