<h5 class="modal-title m-b-10" id="slideRightModalLabel"> {{ $title }} </h5>
{{ Form::label('type', __('Type').'*') }}
<div class="form-group">
    @foreach($questionTypes as $key => $questionType)
        <div class="custom-control custom-radio custom-control-inline">
            {{ Form::radio('type', $key , @$type, ['class' => "custom-control-input question-type", "id" => $key.'-question-type']) }}
            {{ Form::label($key.'-question-type', $questionType, ['class' => "custom-control-label"]) }}
        </div>
    @endforeach
</div>
<div class="form-group question-name">
    {{ Form::label('question', __('Question').'*') }}
    {{ Form::text('question', @$question, ['class' => "form-control", 'autocomplete'=>'off']) }}
</div>
<div class="form-group">
    {{ Form::label('course', __('Course').'*') }}
    {{ Form::select('course', @$courses, @$course, ['class' => "form-control", 'id'=>'course-items', 'autocomplete'=>'off', 'disabled' => 'true', 'placeholder'=>'--- Choose yor course ---']) }}
    {{ Form::hidden('course', @$course, ['class' => "form-control", 'autocomplete'=>'off']) }}
</div>
<div class="question-type-fields si-question-type">
    <table class="table table-bordered" id="si-table">
        <thead>
            <th>Correct</th>
            <th>Options</th>
            <th>Action</th>
        </thead>
        <tbody>
            @php
                $quizOptions   = @$quizOptions ? : [null];
            @endphp
            @foreach($quizOptions as $key => $option)
                @include('superadmin::quizzes.partials.quiz_single_option')
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-sm btn-info float-right m-b-10 add-more" id="si">
        <i class="mdi mdi-plus"></i>{{ __('Add More') }}
    </button>
</div>

<div class="question-type-fields mu-question-type">
    <table class="table table-bordered" id="mu-table">
        <thead>
            <th>Correct</th>
            <th>Options</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($quizOptions as $key => $option)
                @include('superadmin::quizzes.partials.quiz_multiple_option')
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-sm btn-info m-b-10 float-right add-more" id="mu">
        <i class="mdi mdi-plus"></i>{{ __('Add More') }}
    </button>
</div>
<div class="question-type-fields mf-question-type">
    <table class="table table-bordered" id="mf-table">
        <thead>
            <th>
                {{ Form::label('question_title', __('Question Title ').'*') }}
                {{ Form::text("question_title", @$question_title, ['class' => "form-control custom-text-box"]) }}
            </th>
            <th>
                {{ Form::label('answer_title', __('Answer Title ').'*') }}
                {{ Form::text("answer_title", @$answer_title, ['class' => "form-control custom-text-box"]) }}
            </th>
            <th>Shuffled Answer</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($quizOptions as $key => $option)
                @include('superadmin::quizzes.partials.quiz_match_following')
            @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-sm btn-info m-b-10 float-right add-more" id="mf">
        <i class="mdi mdi-plus"></i>{{ __('Add More') }}
    </button>
</div>
<div class="form-group">
    {{ Form::label('point', __('Points').'*') }}
    {{ Form::text('point', @$point, ['class' => "form-control isnumeric", 'autocomplete'=>'off']) }}
</div>
<div class="row">
    <div class="form-group col-md-6">
        {{ Form::label('right_answer_feedback', __('Right Answer Feedback').'*') }}
        {{ Form::text('right_answer_feedback', @$right_answer_feedback, ['class' => "form-control", 'autocomplete'=>'off']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('wrong_answer_feedback', __('Wrong Answer Feedback').'*') }}
        {{ Form::text('wrong_answer_feedback', @$wrong_answer_feedback, ['class' => "form-control", 'autocomplete'=>'off']) }}
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
</div>

@push('scripts')
    <script type="text/javascript">
        
        $("input[name=type][value='{{$type}}']").prop("checked",true);

        // $( ".draggable" ).draggable({
        //     helper: "clone"
        // });

        // $(".sufffle-option").droppable({
        //     drop: function (event, ui) {
        //         ui.draggable.clone().appendTo($(this)).draggable();
        //     },
        // });

        // $( ".sufffle-option" ).draggable({
        //     disabled: true
        // });
        checkedOptions();
        updateSuffleOption();

        $(document).on("click", ".add-more", function (event) {
            add_more($(this));
            updateSuffleOption();
        });

        $(document).on('click', '.row-delete', function(){
            $(this).parents('tr').remove();
            updateSuffleOption();
        });

        prepareFormFields($("input[name='type']:checked").val());

        $(document).on('change', '.question-type', function(){
            prepareFormFields($(this).val());
        });

        function add_more(value){
            var addButtonId = value.attr('id');
            var row = parseInt($("#"+addButtonId+"-table tbody tr").last().data('row')) + 1;

            $.ajax({
                url: "{{ route('sa.quizzes.option') }}",
                type:'GET',
                data:{ 'row' : row, 'type' : addButtonId },
                success: function(data){
                    $("#"+addButtonId+"-table tbody").append(data);
                    checkedOptions();
                    updateSuffleOption();
                }
            });
        }

        function prepareFormFields(questionType) {
            if(questionType == 'MA') {
                $('.file').hide();
            } else {
                $('.file').show();
            }
            $('.question-type-fields').hide().prop('disabled',true).find('input').prop('disabled', true);
            $('.'+questionType+"-question-type").fadeIn('slow').find('input').prop('disabled', false);
        }

        function checkedOptions() {
            $(document).on('change', '.single-type', function() {
                $(".single-type").prop('checked', false);
                $(this).prop('checked', true);
            });
        }

        function updateSuffleOption() {

            $(".mf-no").each(function( index ) {
                $(this).empty().append(index+1);
            });
            $(".keys").each(function( index ) {
                $(this).val(index+1);
            });

            $(".sufffle-options").each(function( index ) {
                var locatePlace = $(this);
                var value = $(this).val();
                locatePlace.empty();
                locatePlace.append('<option value="">--Shuffle--</option>');
                $(".mf-no").each(function( index ) {
                    locatePlace.append('<option value="'+ $(this).text() +'">'+ $(this).text() +'</option>');
                    if($(this).text() == value) {
                        locatePlace.val(value);
                    }
                });
            });
        }
    </script>
@endpush
