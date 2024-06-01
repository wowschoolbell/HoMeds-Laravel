@extends('layouts.master')
@section('title', 'Customer')

@section('content')
<div class="container " style="margin-top: 3%;">

    <div class="row">
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
    $create_route = route('admin.customers.create');
@endphp
@endsection

@include('layouts.partials.datatable_scripts')
@include('layouts.partials.ajax_save_scripts')
