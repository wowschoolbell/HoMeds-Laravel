@extends('layouts.master')
@section('title', 'Quiz Questions')

@section('content')
<div class="bg-dark">
    <div class="container-fluid  m-b-30">
        <div class="row">
            <div class="col-md-8 text-white p-t-40 p-b-90">
                <h4 class="">
                    <span class="btn btn-white-translucent">
                    <i class="mdi mdi-comment-question-outline"></i></span> Quiz Questions
                </h4>
            </div>
            {{-- <div class="col-md-4 text-right p-t-40 p-b-90">
                <a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="mdi mdi-keyboard-backspace"></i> Back</a>
            </div> --}}
        </div>
    </div>
</div>

<div class="container-fluid pull-up">
    <div class="row">
        {{-- <div class="col-md-3">
            @include('admin.partials.quiz_template_question_steps')
        </div> --}}
        <div class="col-md-12">
            <!--widget card begin-->
            <div class="card m-b-30">
                <div class="card-body">
                    {{ Form::open(['route' => 'sa.quizzes.store', 'class' => 'popup_form', 'files' => true]) }}
                        @include('superadmin::quizzes.partials.form')    
                    {{ Form::close() }}
                </div>
            </div>
            <!--widget card ends-->
        </div>
    </div>
</div>
@endsection


