@extends('layouts.master')
@section('title', 'Store')

@section('content')
<div class="container " style="margin-top: 3%;">

    <div class="row">
        <div class="col-12">
            @foreach($statuses as $id => $status)
                <?php
                    $class = "btn-dark-lavender";

                    if((@request()->status == null && $id == 0)) {
                        $class = "btn-lavender";
                    }

                    if (@request()->status == $id) {
                        $class = "btn-lavender";
                    }
                
                ?>
                <a href="{{ route('admin.delivery_partner.index')}}?status={{$id}}" class="btn btn-sm {{$class}} sort-option-button" title="Edit"><i class="mdi mdi mdi-triforce"></i> {{$status}}</a>
            @endforeach
        </div>
        <div class="col-12" style="margin-top: 2%;">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive p-t-10">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@php
    $create_route = route('admin.delivery_partner.create');
@endphp
@endsection

@include('layouts.partials.datatable_scripts')
@include('layouts.partials.ajax_save_scripts')
