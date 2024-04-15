<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('first_name', __('First Name').'*') }}
        {{ Form::text('first_name', @$first_name, ['class' => "form-control"]) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('last_name', __('Last Name').'*') }}
        {{ Form::text('last_name', @$last_name, ['class' => "form-control"]) }}
    </div>
</div>

<div class="form-row">
    
    <div class="form-group col-md-4">
        {{ Form::label('organization', __('Organization').'*') }}
        {{ Form::text('organization', @$organization, ['class' => "form-control"]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('gender', __('Gender').'*') }}
        {{ Form::select('gender', @$genders, @$gender, ['class' => 'form-control', 'placeholder'=>'Choose Your Gender']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('age_group', __('Age Group').'*') }}
        {{ Form::select('age_group', @$age_groups, @$age_group, ['class' => 'form-control', 'placeholder'=>'Choose experience level']) }}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('username', __('User Name').'*') }}
        {{ Form::text('username', @$username, ['class' => "form-control"]) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('password', __('Password').'*') }}
        {{ Form::text('password', @$password, ['class' => "form-control"]) }}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
        {{ Form::label('email', __('Email').'*') }}
        {{ Form::text('email', @$email, ['class' => "form-control"]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('city', __('City').'*') }}
        {{ Form::text('city', @$city, ['class' => "form-control"]) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('state', __('state').'*') }}
        {{ Form::select('state', @$states, @$state, ['class' => "form-control", 'placeholder'=>'Choose state']) }}
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        {{ Form::label('experience_level', __('Experience Level').'*') }}
        {{ Form::select('experience_level', @$experience_levels, @$experience_level, ['class' => "form-control", 'placeholder'=>'Choose experience']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('mobile_number', __('Mobile Number').'*') }}
        {{ Form::text('mobile_number', @$mobile_number, ['class' => "form-control"]) }}
    </div>
</div>

<div class="card m-b-30">
    <div class="card-header bg-soft-dark">
        <div class="form-row align-center">
            <div class="form-group card-title col-md-6">
                <i class="mdi mdi-file-upload"></i> {{ __('Topics Of Interest Details') }}
            </div>
            <div class="form-group col-md-6 m-b-0">
                <button type="button" class="btn btn-sm btn-info float-right" id="addDocumentRow"><i class="mdi mdi-plus"></i> Add</button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="form-row">
            @php $i=0 @endphp
            <table class="table table-striped" id="documentTable">
                <tr>
                    <th>Topics *</th>
                    <th>Action</th>
                </tr>
                @foreach($topics_of_interests as $topicsOfInterest)
                    <tr>
                        <td>{{ Form::text("topics_of_interest[$i][name]", @$topicsOfInterest['name'], ['class' => "form-control fileName",'id' => "inputGroupFile02"]) }}</td>
                        <td> <button class="btn btn-sm btn-danger row-delete" type="button" id="row-delete" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button></td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
                <tbody class="document-add">
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">
        {{ __('Save') }}
    </button>
    <a class="btn btn-secondary" href="{{ route("sa.users.index") }}">Cancel</a>
</div>

@push('scripts')
<script type="text/javascript" src="{{ asset('js/jquery.tmpl.js') }}"></script>
    <script id="DocumentFormTemplate" type="text/x-jquery-tmpl">
        <tr>
            <td> {!! Form::text('topics_of_interest[${key}][name]',' ', ['class' => 'form-control fileName']) !!}</td>
            <td> <button class="btn btn-sm btn-danger row-delete" type="button" id="row-delete" title="Delete"><i class="mdi mdi-trash-can-outline"></i></button></td>
        </tr>
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            var key= {{ $i + 1 }};
            // sortserialnumber()

            $('#addDocumentRow').click(function () {
                var validation = 0;
                $(`tbody tr`).each(function(){
                    let $tr = $(this).closest('tr');

                    if ( $tr.find(`.fileName`).val() == 0 || $tr.find(`.link`).val() == 0 )
                    {
                        validation = 1
                        return false;
                    }
                });
                if(validation == 1) {
                    swal("Empty Row", "Some fields are empty", "warning");
                    return false;
                }

                if($('.custom-file-input').length >= 5)
                {
                    swal({
                        title: "Warning",
                        text: "Only 5 rows allowed !",
                        type: "warning",
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, got it!",
                    })
                    return false;
                }
                var formfields = [{
                        key: key++
                    }];
                $("#DocumentFormTemplate").tmpl(formfields).appendTo(".document-add");
                // sortserialnumber()
                documentname_call() //custom.js
            });
            $('body').on('click', '.row-delete', function(){
                // sortserialnumber();
            });
        });
    </script>
@endpush
