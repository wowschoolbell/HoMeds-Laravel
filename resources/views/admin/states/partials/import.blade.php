@extends('layouts.master')
@section('title', 'States')

@section('content')

<div class="container-fluid" style="margin-top: 3%;">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body" style="text-align: center;">
                    <form action="{{ route('admin.states.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div>
                                <span>Import state File *</span>
                                {{ Form::file("file",['accept' => '.csv, .xlsx, .xls', 'class' => 'custom-file-input','id' => 'inputGroupFile02', 'required' => true]) }}
                                <label for="inputGroupFile02" class="custom-file-label import-file-page">Choose File</label>
                            </div>
                            <div class="" style="margin-top: 3%;">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('admin.states.index') }}" class="btn btn-danger">
                                    {{ __('Cancel') }}
                                </a>
                            </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection